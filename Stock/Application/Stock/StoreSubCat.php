<?php 
//connect to MySQL database server 
include "../../../Main/Config/db_conn.php";
//Assign variables passed by AJAX script via REQUEST super global
$superCat =$_REQUEST['MainCat'] ;
$maincatId =$_REQUEST['Category']; 
$SubCatName =$_REQUEST['SubCatName'] ;
$Description =$_REQUEST['Description']; 

/*$sql1=mysqli_query($conn, "SELECT * FROM ParentStockCat WHERE ParentCatId = '$MainCat'") or die(mysqli_error($conn));
		while($recs=mysqli_fetch_array($sql1))
		{

               
        $ParentCatName = $recs['ParentCatName']; 
		
		}
		
$sql2=mysqli_query($conn, "SELECT * FROM PStockCat WHERE CatId = '$Category'") or die(mysqli_error($conn));
		while($recs=mysqli_fetch_array($sql2))
		{

               
        $CatName = $recs['CatName']; 
		
		}
				
		


$dateAdded=date('Y-m-d',time());
//check whether category exists
$sql="select * from PStockSubCat where SubCatName='$SubCatName'";
$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
$rows=mysqli_num_rows($res);
if($rows>0)
	{
	echo "2";
	}
	else
	{
		$sql="insert into PStockSubCat(MainCat,Category,SubCatName,Description) VALUES('$ParentCatName','$CatName','$SubCatName','$Description')";
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
	*/
	
	$sql="insert into StockCategory(ParentId,CatCode,CatName,CatDescription,PharmacyCategory) VALUES('$superCat','$maincatId','$SubCatName','$Description',1)";
	$res=mysqli_query($conn, $sql,$conn) or die(mysqli_error($conn));
