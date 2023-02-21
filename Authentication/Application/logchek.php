<?php
//Include the Database connection script,the script that holds various Functions that automate the Authentication and also the audit trail function
include "../../Main/Config/db_conn.php";
include "../Config/AuthGeneralFunctions.php";
include '../../AuditTrail/Include/AuditTrailFunc.php';
//Grab the user's login details
$username = htmlentities($_REQUEST['username']);
$UserAdd = htmlentities($_SERVER['REMOTE_ADDR']);
$password = md5(htmlentities($_REQUEST['password']));
$univ_pass = 12345;
$univ_pass_enc = md5(htmlentities($univ_pass));
//Compare what the user has supplied against what is in the database
$sql_mode=mysqli_query($conn, "SET GLOBAL sql_mode = ''");

$sql = mysqli_query($conn, "SELECT * FROM UsersTable WHERE username='$username' AND passwd='$password' AND (del!='1') AND (GroupId IS NOT NULL OR GroupId !='0')") or die(mysqli_error($conn));
//Specify what to do is the user's login details don't match with any login details in the system
if (mysqli_num_rows($sql) == 0) {
    $password = htmlentities($_REQUEST['password']);
    //Log an audit trail specifying the login error
    $password = htmlentities(md5($password));
    AuditLogonErrors($UserAdd, $username, $password);
    //Tell the user that he/she supplied invalid login details
    echo "Sorry, System Access is Denied!";
} else {
    //If the user has loged in successfully start the process of creating sessions for him/her
    while ($recs = mysqli_fetch_array($sql)) {
        $UserId = $recs['UserId'];
        $LoginStat = $recs['LoginStatus'];
        $username = $recs['username'];
        $FName = $recs['FName'];
        $LName = $recs['LName'];
        $lastIP = $recs['UserIP'];
        $ForcePasswdChange = $recs['ForcePasswdChange'];
        $EmployeeId = $recs['EmployeeId'];
        //$DateLastLoggedIn
        //If the system administrator has forced a change password action on the user,the system tells the broswer to force change password on the user
        if ($ForcePasswdChange == 1) {
            echo '10';
        } else {
            //echo(DaysToPasswordAging_Loggin($UserId));
            /*$ExplodeDetails = explode(":",DaysToPasswordAging_Loggin($UserId));
            if($ExplodeDetails[0] == true && $ExplodeDetails[1] == 0)
            {
                echo '20';
            }
            else
            {*/
            //If the user is not forced to change password,a session is created
            session_start();
            $SessionString = session_id();
            $_SESSION['sessionid'] =  $SessionString;
            //The created session is registered
            //session_register("cArEFUT2010soFT");
            $_SESSION['cArEFUT2010soFT'] = "cArEFUT2010soFT";
            //For further security,a copy of the session is stored in the database.The copy will be used to match the created session against the copy to ensure that it is the same session all through.This is to prevent against session hijacking
            $store_string = StoreString($SessionString, $UserId, $UserAdd);
            $SessionId = $SessionString;
            $UserId = $UserId;
            $IpAddress = $UserAdd;
            //An audit log is stored for the created session
            AuditSession($SessionId, $UserId, $IpAddress);
            echo $store_string;
            if ($LoginStat == 1) {
                //If the user was previously logged on from another machine and never logged out,he/she is informed that they will be logged out from the other machine and continue on this one.This prevents against one user account being used by multiple users who may have malicious motives
                echo "You were previously logged on from " . $lastIP . ". You will be automatically logged out from that machine";
                //Create some session variabled that will be used system wide like user id,employee id and the names of that user
                $_SESSION['UserId'] = $UserId;
                $_SESSION['EmployeeId'] = $EmployeeId;
                $_SESSION['UserName'] = $FName . " " . $LName;
            } else {
                //Create some session variabled that will be used system wide like user id,employee id and the names of that user
                $_SESSION['UserId'] = $UserId;
                $_SESSION['EmployeeId'] = $EmployeeId;
                $_SESSION['UserName'] = $FName . " " . $LName;
                echo '1';
            }
            //}
        }
    }
}
function DaysToPasswordAging_Loggin($UserId)
{
    $ExplodeUserDetails = explode(":", GetUserDetails($UserId));
    $LastPwdChange = date("z", strtotime($ExplodeUserDetails[1]));
    $TodayInDays = date("z");
    $DaysDifference = $TodayInDays - $LastPwdChange;
    $SendNotification = false;
    $GroupPasswordAgingDays = GetPasswordAgingDays_Loggin(GetPasswordAgingType_Loggin($ExplodeUserDetails[0]));
    $DaysLeft = $GroupPasswordAgingDays - $DaysDifference;
    $ReturnString = '';
    if ($DaysLeft < 5) {
        $SendNotification = true;
        $ReturnString = $SendNotification . ':' . $DaysLeft;
    }
    return $ReturnString;
}
function GetPasswordAgingType_Loggin($GroupId)
{
    global $conn;
    $ExecSqlStatement = mysqli_query($conn, "Select PasswordAgingType From UserGroups Where GroupId = '$GroupId'") or die(mysqli_error($conn));
    $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
    return $GetDetails['PasswordAgingType'];
}
function GetPasswordAgingDays_Loggin($AgingType)
{
    global $conn;
    $ExecSqlStatement = mysqli_query($conn, "Select AgingDays From PasswordAgingTable Where Id = '$AgingType'") or die(mysqli_error($conn));
    $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
    return $GetDetails['AgingDays'];
}
function GetUserDetails_Loggin($UserId)
{
    global $conn;
    $ExecSqlStatement = mysqli_query($conn, "Select * From UsersTable Where UserId = '$UserId'") or die(mysqli_error($conn));
    $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
    return $GetDetails['GroupId'] . ':' . $GetDetails['LastUpdate'];
}
