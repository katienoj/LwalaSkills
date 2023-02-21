<?php
include "../php_functions/db_connect.php";

$cat_id=$_REQUEST['cat_id'];
$cat_name=$_REQUEST['cat_name']; 
$cat_code=$_REQUEST['cat_code']; 
$desc=$_REQUEST['desc'];

$sql="update  tbl_category set cat_code='$cat_code',cat_name='$cat_name',cat_description='$desc' where cat_id='$cat_id'";

$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($result==1)
{
echo"Update successful";
}
else
{
echo "error";

}
