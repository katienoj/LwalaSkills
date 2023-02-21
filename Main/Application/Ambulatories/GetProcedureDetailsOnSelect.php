<?php
require_once '../../Config/db_conn.php';
?>
<?php
$ProcedureId = htmlentities($_REQUEST['ProcedureId']);
/*Get Procedure details on selecting the text box while adding a procedure to charge.*/
$SqlStatement = "Select * From Procedures Where ProcedureId = '$ProcedureId'";
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

		$ProcName = htmlentities($Row['ProcedureName']);
		$Cost = htmlentities($Row['Cost']);

		echo $ProcName . ':' . $Cost;
	}
}
?>