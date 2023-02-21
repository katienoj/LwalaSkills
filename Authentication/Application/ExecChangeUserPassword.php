<?php
include "../../Main/Config/db_conn.php";
global $conn;
$UsrName = htmlentities($_REQUEST['enterUserName']);
$EmialAddress = htmlentities($_REQUEST['emailAddresss']);
$NewPassword = htmlentities($_REQUEST['newPassword']);

$UserId;

$CheckAccountExists = "Select UserId from UsersTable Where username = '$UsrName'";
$ExecCheckAccountExists = mysqli_query($conn, $CheckAccountExists) or die("Could not get account informationn" . mysqli_error($conn));
$GetRowInExecCheckAccountExists = mysqli_num_rows($ExecCheckAccountExists);

if ($GetRowInExecCheckAccountExists <= 0) {
	echo ('The user name you entered does not exists.');
} else {
	//Get UserId for account if account exists

	while ($Row = mysqli_fetch_array($ExecCheckAccountExists)) {
		$UserId = htmlentities($Row['UserId']);
	}

	$Md5Password = htmlentities(md5($NewPassword));
	$UpdateUserInformation = "Update UsersTable SET passwd = '$Md5Password', LastUpdate = CURDATE(),DateOfLastPasswordChange = CURDATE() Where UserId = '$UserId' ";
	$ExecUpdateUserInformation = mysqli_query($conn, $UpdateUserInformation) or die("Could not update user information " . mysqli_error($conn));

	if (!$ExecUpdateUserInformation) {
		echo ("Failed to excuted the query");
	} else {
		$UpdateForcePassword = "Update UsersTable SET ForcePasswdChange = 0, DateOfLastPasswordChange = CURDATE() Where UserId = '$UserId'";
		$ExecUpdateForcePassword = mysqli_query($conn, $UpdateForcePassword) or die("Could not update password " . mysqli_error($conn));
		if (!$ExecUpdateForcePassword) {
			echo ("Update force password failed");
		} else {
			echo '1';
		}
	}
}
