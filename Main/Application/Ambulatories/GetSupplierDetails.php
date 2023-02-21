<?php
require_once '../../Config/db_conn.php';
?>
<?php
$SupplierId = htmlentities($_REQUEST['SupplierId']);
/*Get Procedure details on selecting the text box while adding a procedure to charge.*/
$SqlStatement = "Select * From SuppliersTable Where Id = '$SupplierId'";
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

		$SupplierName = htmlentities($Row['Suppliernames']);
		$Id = htmlentities($Row['Id']);
		echo $SupplierName . ':' . $Id;
	}
}
?>