<?php 
//connect to MySQL database server 
include "../../../Main/Config/db_conn.php";
//Assign variables passed by AJAX script via REQUEST super global
$MainCat =$_REQUEST['MainCat'] ;
$CatName =$_REQUEST['CatName']; 
$Description =$_REQUEST['Description'] ;


$sql=mysqli_query($conn, "SELECT * FROM ParentStockCat WHERE ParentCatId = '$MainCat'") or die(mysqli_error($conn));
		while($recs=mysqli_fetch_array($sql))
		{

               
        $ParentCatName = $recs['ParentCatName']; 
		
		}



$dateAdded=date('Y-m-d',time());
//check whether category exists
$sql="select * from PStockCat where CatName='$CatName'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
{
echo "2";
}
else
{
$sql="insert into PStockCat(MainCat,CatName,Description) VALUES('$ParentCatName','$CatName','$Description')";
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
