<?php 
//connect to MySQL database server 
include "../php_functions/db_connect.php";
//Assign variables passed by AJAX script via REQUEST super global
$cat_name =$_REQUEST['cat_name'] ;
$cat_desc =$_REQUEST['cat_desc']; 
$parent   =$_REQUEST['parent_id']; 

//check whether category exists
$sql="select * from tbl_category where cat_name='$cat_name'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
{
echo "2";
}
else
{
$sql="insert into tbl_category(cat_name,cat_description,parent_id) VALUES('$cat_name','$cat_desc','$parent')";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
if($res==1)
{
echo "1";
}
else
{
echo "Error in trying to store the Category";
}
}
