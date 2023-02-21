<?php 
//connect to MySQL database server
include "../../../Main/Config/db_conn.php"; 
//Assign variables that have passed from the AJAX script via the REQUEST method
/*'Application/Stock/StoreProduct.php?prdct_name='+prdct_name+'&cat='+cat+'&desc='+desc+'&filename='+filename+'&barcode='+barcode+'&minReorder='+minReorder+'&maxReorder='+maxReorder+'&minStock='+minStock+'&maxStock='+maxStock+'&OpeningStock='+OpeningStock+'&'*/
$names=$_REQUEST['prdct_name']; 
$cat=$_REQUEST['cat'];
$desc=$_REQUEST['desc'];
$minReOrder=$_REQUEST['minReorder'];
$maxReOrder=$_REQUEST['maxReorder'];
$minStock=$_REQUEST['minStock'];
$maxStock=$_REQUEST['maxStock'];
$OpeningStock=$_REQUEST['OpeningStock'];
$filename=$_REQUEST['filename'];
$barcode=$_REQUEST['barcode'];
$StockId=$_REQUEST['StockId'];
$StockPrice=$_REQUEST['StockPrice'];
$MfgName=$_REQUEST['MfgName'];
$MfgEmail=$_REQUEST['MfgEmail'];
$MfgAddress=$_REQUEST['MfgAddress'];
$MfgTel=$_REQUEST['MfgTel'];
$DefaultPackaging=$_REQUEST['DefaultPackaging'];

$tme=time();
$dte=date('Y-m-d',$tme);
	//check whether name exists in database
	$checkIfProd = mysqli_query($conn, "SELECT StockName FROM StockTable WHERE StockName='".$names."' AND Id!='".$StockId."' AND del=0") or die(mysqli_error($conn));
	
	$ifProdRows = mysqli_num_rows($checkIfProd);
	if($ifProdRows  >0 ){
	echo $names." is already in use by another stock item.";
	}else{	
	//add product details to database
		
	$storeProduct="UPDATE StockTable SET StockImage='$filename',StockName='$names',minStock='$minStock',maxStock='$maxStock',minReorder='$minReOrder',maxReorder='$maxReOrder',OpeningStock='$OpeningStock',CatId='$cat',specs='$desc',Barcode='$barcode',StockLastUpdate='$dte',quantity='$OpeningStock',StockPrice='$StockPrice',MfgName='$MfgName',MfgEmail='$MfgEmail',MfgAddress='$MfgAddress',MfgTel='$MfgTel' WHERE Id='$StockId'";
	$sql=mysqli_query($conn, $storeProduct) or die(mysqli_error($conn));

	echo "1";
	
	}
