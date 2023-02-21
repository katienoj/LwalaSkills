<?php 
//connect to MySQL database server 
include "../../../Main/Config/db_conn.php";
//Assign variables passed by AJAX script via REQUEST super global
$cat_name =$_REQUEST['cat_name'] ;
$cat_desc =$_REQUEST['cat_desc']; 
$parent   =$_REQUEST['parent_id'];
$CatImage =$_REQUEST['CatImage'];
$ParentCatName =$_REQUEST['ParentCatName'];
$CatName2 =$_REQUEST['CatName2'];
$SubCatName =$_REQUEST['SubCatName'];

$dateAdded=date('Y-m-d',time());
//check whether category exists
$sql="select * from StockCategory where CatName='$cat_name'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
{
echo "2";
}
else
{
$sql="insert into StockCategory(CatName,CatDescription,ParentId,dateAdded,CatImage, ParentCatName, CatName2, SubCatName) VALUES('$cat_name','$cat_desc','$parent','$dateAdded','$CatImage', '$ParentCatName', '$CatName2', '$SubCatName')";
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
