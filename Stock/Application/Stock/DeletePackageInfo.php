<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';

$PackageId=$_REQUEST['PackageId'];

$PackageLinked=PackageLinked($PackageId);

if($PackageLinked!='Not Linked')
{
echo PackageName($PackageId)." is linked to some stock items therefore undeleteable";
}
else
{
$sql=mysqli_query($conn, "DELETE FROM SetupPackaging WHERE Id='$PackageId'") or die(mysqli_error($conn));
if($sql==1)
{
echo "1";
}
else
{
echo "Unable to remove package";
}
}
