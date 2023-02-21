<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';

$CatId=$_REQUEST['CatId'];

$sql=mysqli_query($conn, "SELECT * FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));

$result=mysqli_fetch_assoc($sql);

$CatName=$result['CatName'];
$ParentId=$result['ParentId'];
$CatDesc=$result['CatDescription'];
$CatImage=$result['CatImage'];

$result=$CatName.":".CatName($ParentId).":".$CatDesc.":".$CatImage;
echo $result;
