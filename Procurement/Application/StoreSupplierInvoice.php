<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$InvoiceNo = $_REQUEST['InvoiceNo'];
$InvoiceDate = convert_date($_REQUEST['InvoiceDate']);
$DateRecieved = convert_date($_REQUEST['DateRecieved']);
$InvoiceAmt = $_REQUEST['InvoiceAmt'];
$SelectedSupplies = $_REQUEST['SelectedSupplies'];
$LPOId = $_REQUEST['LPOId'];

$LPOSupplier = SupplierInLPO($LPOId);




$sqlInvoice = mysqli_query($conn, "INSERT INTO SupplierInvoices(InvoiceCategory,InvoiceDate,DateReceived,LPONo,Supplier,InvoiceAmount) VALUES('2','$InvoiceDate','$DateRecieved','$LPOId','$LPOSupplier','$InvoiceAmt')") or die(mysqli_error($conn));

$NewInvoiceNo = mysqli_insert_id($conn);

$TheSuppliesDetails = explode(':', $SelectedSupplies);

foreach ($TheSuppliesDetails as $SupplyDetail) {
	if ($SupplyDetail != '') {
		$sql = mysqli_query($conn, "UPDATE LPOService SET RecievedInvoice='1',InvoiceNo='$NewInvoiceNo' WHERE DeliveryNote='$SupplyDetail' ") or die(mysqli_error($conn));
	}
}
echo $sqlInvoice;
