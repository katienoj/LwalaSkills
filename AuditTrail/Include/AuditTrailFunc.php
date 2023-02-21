<?php
//include ('../../Main/Config/db_conn.php');
//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
//
//$conn 	= mysql_pconnect("localhost","root","fut4dm1n");
//$dbName = 'DbLwala';
//
//$db_connect = mysql_select_db($dbName, $conn);
global $conn;
function ShowDefaultFields()
{
    global $conn; ?>
	<select class="form-control" name="Field" id="Field">
		<?php
        echo "<option class='form-control'size =30 selected> - Select - </option>";
    $GetFieldName = "Select Distinct FieldName From AuditTable";
    $sql_Field = mysqli_query($conn, $GetFieldName) or die(mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($sql_Field)) {
        echo "<option class='form-control'>$row[FieldName]</option>";
    } ?>
	</select>
<?php
}
function GetUserIdName($UserId)
{
    global $conn;
    //gets the employee name who perfomed the transaction
    $GetIdSql = "SELECT EmployeeId FROM UsersTable WHERE UserId='$UserId'";
    $ExecGetIdSql = mysqli_query($conn, $GetIdSql) or die(mysqli_error($conn));
    $ResGetIdSql = mysqli_fetch_array($ExecGetIdSql);
    $EmployeeId = $ResGetIdSql['EmployeeId'];
    //getting the employee name from the employees table
    $GetUserNameSql = "SELECT EmployeeName FROM EmployeeTable WHERE Id = '$EmployeeId'";
    $ExecGetUserNameSql = mysqli_query($conn, $GetUserNameSql) or die(mysqli_error($conn));
    $ResExecGetUserNameSql = mysqli_fetch_array($ExecGetUserNameSql);
    $Name = htmlentities($ResExecGetUserNameSql['EmployeeName']);
    return $Name;
}
function AuditSession($SessionId, $UserId, $IpAddress)
{
    global $conn;
    $AuditSsnSql = "Select * FROM AuditSsn WHERE SessionId='$SessionId'";
    $Ssnresult = mysqli_query($conn, $AuditSsnSql) or die(mysqli_error($conn));
    $SsnRows = mysqli_num_rows($Ssnresult);
    if ($SsnRows == 0) {
        //global $conn;
        $Sql = "INSERT INTO `AuditSsn` (`SessionId`, `UserId`, `LoginDate`, `LoginTime`, `IpAddress` ) VALUES
			 ('$SessionId', '$UserId', CURDATE(), NOW(), '$IpAddress')";
        $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
    }
}
// function to update audit session table when system user logs out of the system
function UpdateAuditSession($SessionId)
{
    global $conn;
    //global $conn;
    $Sql = "UPDATE `AuditSsn` SET LogoutDate= CURRENT_DATE(), LogoutTime= NOW() WHERE SessionId= $SessionId";
    $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
}
// function to insert data into audit trail transaction table
function AuditTransaction($SessionId, $SqlStr)
{
    global $conn;
    //global $conn;
    $Action = "";
    $RecordChanged = "";
    //check the type of action that was executed by the transaction
    $Insert = "INSERT";
    $Update = "UPDATE";
    $Delete = "DELETE";
    //add the transaction number to the transaction table
    $Sql = " SELECT max(TranSeqNo) FROM AuditTrans WHERE SessionId='$SessionId'";
    //echo $SqlStr;
    $res = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
    $num = mysqli_fetch_array($res);
    $count =	$num[0];
    $newcount = $count + 1;
    if (stristr($SqlStr, $Insert)) {
        global $conn;
        $Action = "Insert";
        //get the table affected by the insert action
        $Table = GetTableName($SqlStr, "INSERT INTO", "(");
        $AffectedFields = GetTStringBtnTwoString($SqlStr, "(", ") VALUES");
        $FieldsAffected = GetFieldsAffected($AffectedFields);
        //$RecordChanged=GetRecordAffected($SqlStr);
        $Sql = "INSERT INTO `AuditTrans` (`SessionId`, `TranSeqNo`, `Date`, `Time`, `Action`) VALUES
		    ('$SessionId', '$newcount', CURDATE(), NOW(), '$Action')";
        $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
        AuditTable($SqlStr, $Action, $SessionId, $newcount, $Table, $FieldsAffected, $RecordChanged);
    } elseif (stristr($SqlStr, $Update)) {
        $Action = "Update";
        //get the table affected by the update Action
        $table = GetTableName($SqlStr, "UPDATE", "SET");
        $SqlFieldStr = GetTStringBtnTwoString($SqlStr, "SET", "WHERE");
        $FieldsAffected = GetFieldsAffected($SqlFieldStr);
        $RecordChanged = GetRecordAffected($SqlStr);
        $Sql = "INSERT INTO `AuditTrans` (`SessionId`, `TranSeqNo`, `Date`, `Time`, `Action`) VALUES
				('$SessionId', '$newcount', CURDATE(), NOW(), '$Action')";
        $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
        AuditTable($SqlStr, $Action, $SessionId, $newcount, $table, $FieldsAffected, $RecordChanged, $RecordChanged);
    } elseif (stristr($SqlStr, $Delete)) {
        $Action = "Delete";
        //get the table affected by the delete Action
        $table = GetTableName($SqlStr, "DELETE FROM", "WHERE");
        $SqlFieldStr = GetTStringBtnTwoString($SqlStr, "SET", "=");
        $FieldsAffected = GetFieldsAffected($SqlFieldStr);
        $RecordChanged = GetRecordAffected($SqlStr);
        $Sql = "INSERT INTO `AuditTrans` (`SessionId`, `TranSeqNo`, `Date`, `Time`, `Action`) VALUES
			('$SessionId', '$newcount', CURDATE(), NOW(), '$Action')";
        $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
        AuditTable($SqlStr, $Action, $SessionId, $newcount, $table, $FieldsAffected, $RecordChanged);
    } else {
        echo "This Transaction has not been included into System Audit Trail\n";
    }
}
function AuditLogonErrors($IpAddress, $UserId, $UserPassword)
{
    global $conn;
    $Sql = "INSERT INTO `AuditLogonErrors` (`TimeAccessed`, `DateAccessed`, `IpAddress`, `UserId`, `UserPassword`)    VALUES (NOW(), CURDATE(), '$IpAddress', '$UserId', '$UserPassword')";
    $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
}
function AuditTable($SqlStr, $Action, $Session, $TransNo, $Tabl, $Fields, $RecordChanged)
{
    global $conn;
    $i = 0;
    $OldValue = "";
    $NewValue = "";
    $list = "";
    $size = count($Fields);
    $len = strlen($RecordChanged);
    $parsed = substr($RecordChanged, 1, $len - 2);
    $RecordChanged = mysqli_real_escape_string($conn, $parsed);
    while ($i < $size) {
        if ($Action == "Insert") {
            $Str = GetTStringBtnTwoString($SqlStr, "VALUES", ")");
            //  echo $Str;
            $list = GetFieldsAffected($Str);
            $OldValue = "";
            $len = strlen($list[$i]);
            $parsed = "";
            if ($i == 0) {
                $parsed = substr($list[$i], 2, $len - 1);
            } else {
                $parsed = $list[$i];
            }
            $pos = strpos($parsed, 'URDATE(');
            if ($pos == true) {
                $parsed = date('Y-m-d');
            }
            $pos1 = strpos($parsed, 'OW(');
            if ($pos1 == true) {
                $parsed = date('h:i:s');
            }
            $NewValue = mysqli_real_escape_string($conn, $parsed);
        } elseif ($Action == "Update") {
            //echo 'Here';
            //echo $Fields[$i];
            $fields = explode("=", $Fields[$i]);
            // $NewValue=$fields[1];
            $len = strlen($fields[1]);
            $ValueToInsert = substr($fields[1], 1, $len - 2);
            $pos = strpos($ValueToInsert, 'URDATE(');
            if ($pos == true) {
                $ValueToInsert = date('Y-m-d');
            }
            $pos1 = strpos($ValueToInsert, 'OW(');
            if ($pos1 == true) {
                $ValueToInsert = date('h:i:s');
            }
            $NewValue = mysqli_real_escape_string($conn, $ValueToInsert);
            // mysqli_query($conn,  "INSERT INTO `tbl` VALUES( '{$example}' )";
            $Fields[$i] = mysqli_real_escape_string($conn, $fields[0]);
            // echo $Fields[$i];
            $Tabl = trim($Tabl);
            $Fields[$i] = trim($Fields[$i]);
            $Select = "SELECT max(RecordId) FROM AuditTable WHERE TableName='$Tabl' AND FieldName ='$Fields[$i]'";
            $Result = mysqli_query($conn, $Select) or die(mysqli_error($conn));
            $row = mysqli_fetch_array($Result);
            if ($siz = 2) {
                $OldValue = "NONE";
            } else {
                $Select1 = "SELECT NewValue FROM AuditTable WHERE RecordId='$row[0]' AND TableName='$Tabl' AND FieldName ='$Fields[$i]'";
                $Result1 = mysqli_query($conn, $Select1) or die(mysqli_error($conn));
                $row1 = mysqli_fetch_array($conn, $Result1) or die(mysqli_error($conn));
                $OldValue = mysqli_real_escape_string($conn, $row1[0]);
            }
            $OldValue = $NewValue;
            $pos = strpos($OldValue, 'URDATE(');
            if ($pos == true) {
                $OldValue = date('Y-m-d');
            }
            $pos1 = strpos($OldValue, 'OW(');
            if ($pos1 == true) {
                $OldValue = date('h:i:s');
            }
            //echo 'Here';
        } elseif ($Action == "Delete") {
            //$RecordChanged="";
            $OldValue = "";
            $NewValue = "";
        } else {
        }
        $Sql = "INSERT INTO AuditTable (`SessionId`, `TranSeqNo`, `TableName`, `RecordId`,                `FieldName`,`OldValue`,`NewValue`) VALUES ('$Session', '$TransNo', '$Tabl', '{$RecordChanged}','$Fields[$i]','$OldValue','{$NewValue}')";
        $done = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
        $i++;
    }
}
function GetTStringBtnTwoString($string, $start, $end)
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return "";
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    $parsed = substr($string, $ini, $len);
    return $parsed;
}
function GetTableName($string, $start, $end)
{
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return "";
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    $parsed = substr($string, $ini, $len);
    return $parsed;
}
function GetFieldsAffected($Sqlstr)
{
    $FieldArry = explode(",", $Sqlstr);
    return $FieldArry;
}
function GetRecordAffected($Str)
{
    $ini = strpos($Str, "WHERE");
    $len = strlen($Str);
    $parsed = substr($Str, $ini + 5, $len);
    $FieldArry = explode("=", $parsed);
    return $FieldArry[1];
}
?>