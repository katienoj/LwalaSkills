<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$SupplierId=$_REQUEST['SupplierId'];
$QuoteId=$_REQUEST['QuoteId'];
$SupplierPrice=$_REQUEST['SupplierPrice'];


$sqlUpdateReply=mysqli_query($conn, "UPDATE GeneratedQuotationRequests SET SupplierPrice='$SupplierPrice',ResponseStatus='1' WHERE Id='$QuoteId'") or die(mysqli_error($conn));
if($sqlUpdateReply==1)
{
   
echo "1";
}
