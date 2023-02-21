<?php
include "../../Main/Config/db_conn.php";
global $conn;
//Logging out a user
//Start a session

session_start();
$UserId = $_SESSION['UserId']; //$_SESSION['UserId']
//Grab the session id of the created session
$session_id = session_id();
//Check out if the session created is called cArEFUT2010soFT
if (isset($_SESSION[$sessionvar])) {
	//Grab the session ID stored in the database for this user
	$session_string = GetRegSession($UserId);

	$user_add = $_SERVER['REMOTE_ADDR'];
	//If the session registered goes by the above mentioned name,match the session ID against what is stored for that use in the databasse

	if ($session_id == $session_string) {
		//If a match is found,destroy the session and usnset the session variable that stores that user's ID 
		session_destroy();
		unset($_SESSION['UserId']);
		//Update the status of that user as logged out in the database.Also delete the copy of the session stored in the database when the user logged in from the database 
		$sql = mysqli_query($conn, ("UPDATE UsersTable SET Session_id='$user_add',UserIP='',LoginStatus='0' WHERE UserId='$UserId'") or die(mysqli_error($sql)));
		//Tell the browser to force the user to login automagically 
		echo "1";
	} else {
		$sql = mysqli_query($conn, ("UPDATE UsersTable SET Session_id='$user_add',UserIP='',LoginStatus='0' WHERE UserId='$UserId'") or die(mysqli_error($sql)));
		//Tell the browser to force the user to login automagically 
		//If the user does not have a copy of the session stored in the database ,still force the user to login ,what tha fuck is he doin here anyway!!!
		echo "1";
	}
} else {
	$sql = mysqli_query($conn, ("UPDATE UsersTable SET Session_id='$user_add',UserIP='',LoginStatus='0' WHERE UserId='$UserId'") or die(mysqli_error($sql)));
	//Tell the browser to force the user to login automagically 
	//If the session was not regsitered ,seriously force the user to login ,what tha fuck is he doin here anyway!!!
	echo "1";
}
