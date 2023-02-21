<?php
//connect to MySQL database server
include "../../../Main/Config/db_conn.php";
//Assign variables that have passed from the AJAX script via the REQUEST method
/*'Application/Stock/StoreProduct.php?prdct_name='+prdct_name+'&cat='+cat+'&desc='+desc+'&filename='+filename+'&barcode='+barcode+'&minReorder='+minReorder+'&maxReorder='+maxReorder+'&minStock='+minStock+'&maxStock='+maxStock+'&OpeningStock='+OpeningStock+'&'*/
$names=$_REQUEST['prdct_name'];
$subcategory=$_REQUEST['subcategory'];
$desc=$_REQUEST['desc'];
$minReOrder=$_REQUEST['minReorder'];
$maxReOrder=$_REQUEST['maxReorder'];
$minStock=$_REQUEST['minStock'];
$maxStock=$_REQUEST['maxStock'];
$OpeningStock=$_REQUEST['OpeningStock'];
$filename=$_REQUEST['filename'];
$barcode=$_REQUEST['barcode'];
$StockPrice=$_REQUEST['StockPrice'];
$MfgName=$_REQUEST['MfgName'];
$MfgEmail=$_REQUEST['MfgEmail'];
$MfgAddress=$_REQUEST['MfgAddress'];
$MfgTel=$_REQUEST['MfgTel'];
$DefaultPackaging=$_REQUEST['DefaultPackaging'];
$supercategory=$_REQUEST['supercategory'];
$maincategory=$_REQUEST['maincategory'];
$filename=$_REQUEST['filename'];
$ExpiryDate=$_REQUEST['ExpiryDate'];
//$pacvalue=$_REQUEST['packaging'];
$tme=time();
$dte=date('Y-m-d', $tme);
    //add product details to database
    $stroreProduct = mysqli_query($conn, "INSERT INTO StockTable(catId,UnitId,StockName,StockImage,MinReorder,MaxReorder,MinStock,MaxStock,StockPrice,MfgName,MfgEmail,MfgAddress,MfgTel,DefaultPackaging,specs,superCat,mainCategory, OpeningStock, Barcode, ExpiryDate) VALUES ('$subcategory','$names','$names','$filename',$minReOrder,$maxReOrder,$minStock,$maxStock,$StockPrice,'$MfgName','$MfgEmail','$MfgAddress','$MfgTel',$DefaultPackaging,'$desc','$supercategory','$maincategory', '$OpeningStock', '$barcode', '$ExpiryDate')") or die(mysqli_error($conn));
    $stroreProduct1 = mysqli_query($conn, "INSERT INTO DepartmentStock(StockName,StockQtyIn,StockQtyOut) VALUES ('$names',$maxStock,$minStock)") or die(mysqli_error($conn));
    $NewStockId=mysqli_insert_id($conn);
    $sqlPackaging=mysqli_query($conn, "INSERT INTO StockPackaging(StockId,PackagingId,PackageTypeId,Qty) VALUES('$NewStockId','$DefaultPackaging','1','1')") or die(mysqli_error($conn));
    if ($stroreProduct) {
        echo $names." Has Been Added Successfully To Inventory!";
		
    } else {
        echo "We could not store the product.";
    }
