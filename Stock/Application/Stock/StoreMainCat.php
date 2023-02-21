<?php 
//connect to MySQL database server 
include "../../../Main/Config/db_conn.php";
//Assign variables passed by AJAX script via REQUEST super global
$ParentCatName =$_REQUEST['ParentCatName'] ;
$Description =$_REQUEST['Description']; 


$dateAdded=date('Y-m-d',time());
//check whether category exists
$sql="select * from ParentStockCat where ParentCatName='$ParentCatName'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
{
echo "2";
}
else
{
$sql="insert into ParentStockCat(ParentCatName,Description) VALUES('$ParentCatName','$Description')";
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
