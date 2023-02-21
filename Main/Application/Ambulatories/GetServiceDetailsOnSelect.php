<?php
require_once '../../Config/db_conn.php';
global $conn;
?>
<?php
$ServiceId = htmlentities($_REQUEST['ServiceId']);
/*Get Procedure details on selecting the text box while adding a procedure to charge.*/
$SqlStatement = "Select * From HospitalServices Where ServiceId = '$ServiceId'";
$ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute query");
/*Check if the query excuted succesefuly*/
if (!$ExecSqlStatement) {
	echo '0';
} else {
	/*Get the Procedure details*/
	$Id = '';
	$ProcName = '';
	$Cost = '';
	while ($Row = mysqli_fetch_array($ExecSqlStatement)) {

		$ProcName = htmlentities($Row['ServiceName']);
		$DoctorRelated = htmlentities($Row['DoctorRelated']);

		$Cost = htmlentities($Row['Amount']);
		$Id = htmlentities($Row['ServiceId']);
		echo $ProcName . ':' . $Cost . ':' . $Id . ':' . $DoctorRelated;
	}
}
?>