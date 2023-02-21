<?php 
include "../php_functions/db_connect.php";
$cat_id=$_REQUEST['cat_id']; 
$sql = "UPDATE tbl_category SET del=1 WHERE cat_id = '$cat_id'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
if($res==1)
{
$sqlprdcts="update tbl_products set cat_id='0' where cat_id='$cat_id'";
$resprdcts=mysqli_query($conn, $sqlprdcts,$conn) or die(mysqli_error($conn));
if($resprdcts==1)
{
echo "1";
}
else
{
echo "Error encountered.";
}
}
