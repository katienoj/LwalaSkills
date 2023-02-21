<?php
session_start();

require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
if (1>0) {
	$UserId = $_SESSION['UserId'];
	$EmployeeId = $_SESSION['EmployeeId'];
	$UserNames = $_SESSION['UserName'];
	$sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($sql);
	$SessionId = $result['Session_Id'];
	//echo "New ".$SessionId."<br>Old".session_id();
	if ($SessionId != session_id() or $SessionId == '') {
		echo "reload";
	}/**/
	$RequestId = $_REQUEST['RequestId'];
	if (GetUserDepartment($UserId) == 10 or stristr(DepartmentName(GetUserDepartment($UserId)), "procurement") or stristr(DepartmentName(GetUserDepartment($UserId)), "Procurement")) {
		if (CheckIfDepartmentHead($UserId) == 1) {
			$sqlCheck = mysqli_query($conn, "SELECT PROCApproved FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
			$results = mysqli_fetch_assoc($sqlCheck);
			$PrevApproved = $results['PROCApproved'];
			if ($PrevApproved == 1) {
				echo "You cannot approve an already approved Request";
			} else {
				$sql = mysqli_query($conn, "UPDATE InternalStockRequests SET PROCApproved='1',PROCApprover='$UserId' WHERE Id='$RequestId'") or die(mysqli_error($conn));
			}
		} else {
			echo "You are not the Head of Department for the " . DepartmentName(GetUserDepartment($UserId)) . " department";
		}
	} else {
		echo "You are not the relevant department that approves Procurement requests";
	}
} else {
	echo "reload";
}
