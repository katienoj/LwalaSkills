<?php
require_once '../../Config/db_conn.php';
global $conn;
?>
<?php
$DoctorId = htmlentities($_REQUEST['DoctorId']);
/*Get Procedure details on selecting the text box while adding a procedure to charge.*/
$SqlStatement = "Select * From ExternalDoctorsRegistration Where Id = '$DoctorId'";
$ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute query");
/*Check if the query excuted succesefuly*/
if (!$ExecSqlStatement) {
	echo '0';
} else {
	/*Get the Procedure details*/
	$Id = '';
	$DocName = '';
	$Cost = '';
	while ($Row = mysqli_fetch_array($ExecSqlStatement)) {

		$DocName = htmlentities($Row['LastName']) . " " . htmlentities($Row['FirstName']) . " " . htmlentities($Row['MiddleName']);
		$Id = htmlentities($Row['Id']);
		echo $DocName . ':' . $Id;
	}
}
?>