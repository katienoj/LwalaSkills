<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$TempId=$_REQUEST['TempId'];
$QtyRequested=$_REQUEST['QtyRequested'];

$sqlUpdateStockAmts=mysqli_query($conn, "UPDATE PRQTemp SET Qty='$QtyRequested' WHERE Id='$TempId'") or die(mysqli_error($conn));
if($sqlUpdateStockAmts==1)
{
echo "1";
}
