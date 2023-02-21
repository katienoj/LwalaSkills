<?php
session_start();
include  "../Config/db_conn.php";


//echo $new_session;

if (1>0) {

	global $conn;
	$UserId = $_SESSION['UserId'];
	$EmployeeId = $_SESSION['EmployeeId'];
	$UserNames = $_SESSION['UserName'];
	$new_session = session_id();
	if ($UserId == '') {
		$UserId = ResolveUserId(number_format($EmployeeId));
	}
	$strSQL = "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'";
	//echo $strSQL."<BR>";
	$sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($sql);
	$SessionId = $result['Session_Id'];
	//echo "Already created".$SessionId."<br>The Session".$new_session;
	if ($SessionId != $new_session or $SessionId == '') {
		echo 0;
	}/**/
} else {

	echo 0;
}


?>



?>