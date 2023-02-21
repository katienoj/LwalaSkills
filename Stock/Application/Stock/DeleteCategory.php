<?php 
include "../../../Main/Config/db_conn.php";
$cat_id=$_REQUEST['CatId']; 
$sql = "UPDATE StockCategory SET del=1 WHERE Id = '$cat_id'";
//echo $sql;
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
if($res==1)
{
$sqlprdcts="UPDATE StockTable SET CatId='0' WHERE CatId='$cat_id'";
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
