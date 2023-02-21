<?php
//connect to MySQL database server 
include "../../../Main/Config/db_conn.php";
//Assign variables passed by AJAX script via REQUEST super global
$cat_name=$_REQUEST['cat_name'] ;
$cat_desc=$_REQUEST['cat_desc']; 
$cat_id=$_REQUEST['cat_id']; 
$CatImage=$_REQUEST['CatImage'];
//check whether category exists
$sql="select * from StockCategory where (CatName='$cat_name' AND Id!='$cat_id') AND del=0";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
{
echo "2";
}
//save category changes to database
else
{
$sql="update StockCategory set CatName='$cat_name',CatDescription='$cat_desc',CatImage='$CatImage' where Id='$cat_id'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
if($res==1)
{
echo "1";
}
else
{
echo "Error in trying to Store changes mad to the Category";
}
}
