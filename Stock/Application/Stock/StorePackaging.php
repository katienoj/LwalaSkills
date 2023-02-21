<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
session_start();
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
if($UserId=='')
{
$UserId=ResolveUserId(number_format($EmployeeId));
}

/*Packaging='+Packaging+'&qty='+qty+'&price='+price+'&PackagingType='+PackagingType+'&PackagingId='+PackagingId+'&StockId='+StockId+'&';*/
$Packaging=$_REQUEST['Packaging'];
$qty=$_REQUEST['qty'];
$price=$_REQUEST['price'];
$PackagingType=$_REQUEST['PackagingType'];
$PackagingId=$_REQUEST['PackagingId'];
$StockId=$_REQUEST['StockId'];
$barcode=$_REQUEST['barcode'];

/*$sqlCheck=mysqli_query($conn, "SELECT PackageBarcode FROM StockPackaging WHERE PackageBarcode='$barcode'") or die(mysqli_error($conn));
if(mysqli_num_rows($sqlCheck)>0 and $PackagingId=='')
{
echo "Barcode typed in is in use by another packaging";
}
else
{*/
$sqlCheck=mysqli_query($conn, "SELECT PackageBarcode FROM StockPackaging WHERE StockId='$StockId' AND PackagingId='$Packaging' AND PackageTypeId='$PackagingType' AND Id!='$PackagingId'") or die(mysqli_error($conn));
if(mysqli_num_rows($sqlCheck)>0)
{
echo PackageName($Packaging)." for ".StockName($StockId)." for ".PackageTypeName($PackagingType)." had been done before";
}
else
{

if($PackagingId=='')
{
$strSQL="INSERT INTO StockPackaging(StockId,PackagingId,Qty,Price,PackageTypeId,PackageBarcode) VALUES('$StockId','$Packaging','$qty','$price','$PackagingType','$barcode')";
}
else
{
$strSQL="UPDATE StockPackaging SET StockId='$StockId',PackagingId='$Packaging',Qty='$qty',Price='$price',PackageTypeId='$PackagingType',PackageBarcode='$barcode' WHERE Id='$PackagingId'";
}
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
if($sql==1)
{
 echo "1";
 if(!empty($price))
{
UpdatePriceChangeHistory($StockId,$Packaging,$price,$UserId);
}

}
else
{

echo "Unable to store packaging";
}
}
/*}
*/
