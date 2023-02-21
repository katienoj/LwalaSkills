<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$PackageId=$_REQUEST['PackageId'];
$sql=mysqli_query($conn, "SELECT * FROM StockPackaging WHERE Id='$PackageId'") or die(mysqli_error($conn));
while(list($Id,$StockId,$PackagingId,$Qty,$Price,$PackageTypeId,$PackageBarcode)=mysqli_fetch_row($sql))
{
if($Qty=='')
{
$Qty='0';
}
if($Price=='')
{
$Price='0';
}
$results=$PackagingId.":".PackageName($PackagingId).":".$Qty.":".$Price.":".$PackageTypeId.":".PackageTypeName($PackageTypeId).":".$PackageBarcode;
echo $results;
}
