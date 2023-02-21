<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
if (isset($_SESSION["cArEFUT2010soFT"])) {
    $UserId=$_SESSION['UserId'];
    $EmployeeId=$_SESSION['EmployeeId'];
    $UserNames=$_SESSION['UserName'];
    $sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $SessionId=$result['Session_Id'];
    //echo "New ".$SessionId."<br>Old".session_id();
    if ($SessionId != session_id() or $SessionId=='') {
        echo "reload";
    }/**/
    $SelectedPRQs=explode(':', $_REQUEST['SelectedPRQs']);
    $dte=date('Y-m-d', time());
    if (GetUserDepartment($UserId)==10 or GetUserDepartment($UserId)==9 or GetUserDepartment($UserId)==11 or GetUserDepartment($UserId)==21 or GetUserDepartment($UserId)==19 or stristr(DepartmentName(GetUserDepartment($UserId)), "procurement") or stristr(DepartmentName(GetUserDepartment($UserId)), "Procurement")) {
        if (CheckIfDepartmentHead($UserId)==1 or GetUserDepartment($UserId)==11) {
            foreach ($SelectedPRQs as $PRQ) {
                if ($PRQ!='') {
                    $strUpdateSQL="UPDATE ProcurementTable SET ApprovalStatus='1',Approver='$UserId',DateOfApproval='$dte' WHERE Id='$PRQ'";
                    $sqlApprovePRQ=mysqli_query($conn, $strUpdateSQL) or die(mysqli_error($conn));
                }
            }
        } else {
            echo "You are not the Head of Department for the ".DepartmentName(GetUserDepartment($UserId))." department";
        }
    } else {
        echo "You are not the relevant department that approves Procurement requests";
    }
} else {
    echo "reload";
}
