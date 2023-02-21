<?php 
require_once '../../../Main/Config/db_conn.php';

$SupplierId=$_REQUEST['SupplierId'];
$CatId=$_REQUEST['CatId'];

$strSQL="UPDATE SuppliersTable SET del=1 WHERE Id='$SupplierId'";
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
if($sql==1)
{
echo "1";
$sqlDeleteCatLink="DELETE FROM SupplierCategoryLink WHERE SupplierId='$SupplierId' AND CatId='$CatId'";
$sqlDeleteLink=mysqli_query($conn, $sqlDeleteCatLink) or die(mysqli_error($conn));
}
else
{
echo "Unable to delete the supplier record";
}
