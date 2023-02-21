<?php
	include "../Config/db_conn.php";
	global $conn;
	$UsrName = htmlentities($_REQUEST['username']);
	$OldPassword = htmlentities($_REQUEST['oldpassword']);
	$NewPassword = htmlentities($_REQUEST['newpassword']);
	
	$UserId;
	$EcyPassword = md5($OldPassword);
	$CheckAccountExists = "Select UserId from UsersTable Where username = '$UsrName' And passwd = '$EcyPassword'";
	$ExecCheckAccountExists = mysqli_query($conn, $CheckAccountExists) or die("Could not get account informationn".mysqli_error($conn));
	$GetRowInExecCheckAccountExists = mysqli_num_rows($ExecCheckAccountExists);
	
	if($GetRowInExecCheckAccountExists <=0)
	{
		echo('The account information you entered is incorrect');
	}
	else
	{
		//Get UserId for account if account exists
		
		while($Row = mysqli_fetch_array($ExecCheckAccountExists))
		{
			$UserId = htmlentities($Row['UserId']);
		}
		
		$Md5Password = htmlentities(md5($NewPassword));
		$UpdateUserInformation = "Update UsersTable SET passwd = '$Md5Password', LastUpdate = CURDATE() Where UserId = '$UserId' ";
		$ExecUpdateUserInformation = mysqli_query($conn, $UpdateUserInformation) or die("Could not update user information ".mysqli_error($conn));
		
		if(!$ExecUpdateUserInformation)
		{
			echo("failed to excuted the query");	
		}
		else
		{
			$UpdateForcePassword = "Update UsersTable SET ForcePasswdChange = 0 Where UserId = '$UserId'";
			$ExecUpdateForcePassword = mysqli_query($conn, $UpdateForcePassword) or die("Could not update password ".mysqli_error($conn));
			if(!$ExecUpdateForcePassword)
			{
				echo("Update force password failed");
			}
			else
			{
				echo'1';
			}
		}
	}
