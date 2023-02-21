<?php 
//connect to MySQL database server
include "../php_functions/db_connect.php"; 
//Assign variables that have passed from the AJAX script via the REQUEST method
$p_id=$_REQUEST['p_id']; 
$names=$_REQUEST['prdct_name']; 
$qty=$_REQUEST['qty']; 
$tax=$_REQUEST['tax']; 
$price=$_REQUEST['price']; 
$cat=$_REQUEST['cat'];
$desc=$_REQUEST['desc'];
$photo=$_REQUEST['photo']; 

$tme=time();
$dte=date('Y-m-d',$tme);
$filename=$_REQUEST['filename'];
	//check whether name exists in database
	$checkIfProd = mysqli_query($conn, "SELECT prdct_name FROM tbl_products WHERE prdct_name='".$names."' AND product_id!='$p_id'") or die(mysqli_error($conn));
	
	$ifProdRows = mysqli_num_rows($checkIfProd);
	if($ifProdRows  >0 ){
	echo $names." already exists.";
	}else{	
	//add product details to database
	$stroreProduct = mysqli_query($conn, "UPDATE tbl_products SET prdct_name='$names',quantity='$qty',vat_tax='$tax',selling_price='$price',cat_id='$cat',specs='$desc',pd_last_update='$dte',pd_image='$photo' WHERE product_id='$p_id'") or die(mysqli_error($conn));
	
	echo "1";
	
	}
