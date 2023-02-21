<?php
//database connection
require_once '../../../Main/Config/db_conn.php';
$id=$_REQUEST['StockId']; 
$sql="UPDATE StockTable SET del=1 WHERE Id='$id'";
$res=mysqli_query($conn, $sql) or die(mysqli_error($conn));
if($res==1)
{
echo $res;
}
else
{
echo "0";
}
