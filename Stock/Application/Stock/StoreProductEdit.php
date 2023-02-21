<?php
//connect to MySQL database server
include "../../../Main/Config/db_conn.php";
//Assign variables that have passed from the AJAX script via the REQUEST method
/*'Application/Stock/StoreProduct.php?prdct_name='+prdct_name+'&cat='+cat+'&desc='+desc+'&filename='+filename+'&barcode='+barcode+'&minReorder='+minReorder+'&maxReorder='+maxReorder+'&minStock='+minStock+'&maxStock='+maxStock+'&OpeningStock='+OpeningStock+'&'*/
session_start();
$SessionString = session_id();
$UserId = $_SESSION['UserId'];
$names=$_REQUEST['prdct_name'];
$cat=$_REQUEST['cat'];
$desc=$_REQUEST['desc'];
$barcode=$_REQUEST['barcode'];
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
$superCat=$_REQUEST['superCat'];
$mainCategory=$_REQUEST['mainCategory'];
$filename=$_REQUEST['filename'];
$InitialQty=$_REQUEST['InitialQty'];
$InitialPrice=$_REQUEST['InitialPrice'];
$specs=$_REQUEST['specs'];
$StockImage=$_REQUEST['StockImage'];
$expiryDate=$_REQUEST['ExpiryDate'];
$superCat=$_REQUEST['superCat'];
$mainCategory=$_REQUEST['mainCategory'];
//$pacvalue=$_REQUEST['packaging'];
$tme=time();
$dte=date('Y-m-d', $tme);
    $checkIfProd = mysqli_query($conn, "SELECT StockName FROM StockTable WHERE StockName='".$names."' AND Id!='".$StockId."' AND del=0") or die(mysqli_error($conn));
    $ifProdRows = mysqli_num_rows($checkIfProd);
    if ($ifProdRows  ==0) {
        echo "Changing the an Existing Item Name Not Allowed";
    } else {
        $storeProduct="UPDATE StockTable SET CatId='$cat', UnitId='$names', specs='$specs', StockImage='$StockImage', StockName='$names', MinReorder='$minReOrder', MinStock='$minStock', MaxStock='$maxStock', MaxReorder='$maxReOrder',OpeningStock='$OpeningStock', ExpiryDate='$expiryDate', Barcode='$barcode',StockLastUpdate='$dte', DefaultPackaging='$DefaultPackaging', StockPrice='$StockPrice', superCat='$superCat', mainCategory='$mainCategory' WHERE StockName='$names'";
        $sql=mysqli_query($conn, $storeProduct) or die(mysqli_error($conn));
        echo "Stock Details Updated Successfully!";
        $saveAction="INSERT INTO StockUpdates
	(StockName, QtyAfterUpdate, MaxReorder, OpeningStock, ExpiryDate, Barcode, StockLastUpdate, DefaultPackaging, PriceAfterUpdate, UserId, InitialStock, InitialPrice)
     VALUES
	('$names', '$maxStock', '$maxReOrder', '$OpeningStock', '$expiryDate', '$barcode', '$dte', '$DefaultPackaging', '$StockPrice', '$UserId','$InitialQty', '$InitialPrice')";
        $sql2=mysqli_query($conn, $saveAction) or die(mysqli_error($conn));
        if ($sql2) {
            echo "<br>Inventory's Audit Table Updated!";
        } else {
            echo "Trail Not Found!";
        }
    }
