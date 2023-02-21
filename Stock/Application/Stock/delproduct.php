<?php
include "../php_functions/db_connect.php";
@$id=$_REQUEST[$id]; 
@$sql="UPDATE tbl_products SET del=1 WHERE product_id='$id'";
@$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
if($res==1)
{
echo $res;
}
else
{
echo "0";
}
