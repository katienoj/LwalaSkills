<?php
function SupplierPrevSelected($Id, $Cat)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE SupplierId='$Id' AND CatId='$Cat'") or die(mysqli_error($conn));
    if (mysqli_num_rows($sql)==0) {
        $result=0;
    } else {
        $result=1;
    }
    return $result;
}
function SupplierNames($SupplierId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT * FROM SuppliersTable WHERE Id='$SupplierId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $SupplierNames=$result['SupplierNames'];
    return $SupplierNames;
}
function SupplierDetails($SupplierId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT * FROM SuppliersTable WHERE Id='$SupplierId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $SupplierNames=$result['SupplierNames'];
    $SupplierLogo=$result['SupplierLogo'];
    $PostAddress=$result['PostAddress'];
    $Email=$result['Email'];
    $Phone=$result['Phone'];
    $Web=$result['WebSite'];
    $Town=$result['Town'];
    $Country=$result['Country'];
    if ($SupplierLogo=='') {
        $SupplierLogo='noSupplier.gif';
    }
    return $SupplierNames.':'.$SupplierLogo.':'.$Email.':'.$Phone.':'.$Web.':'.$Town.':'.$Country.':'.$PostAddress;
}
function CatName($CatId)
{
    //This function gets the name of a next of kin relationship based on the id supplied.It should be self explanatory
    global $conn;
    $sql=mysqli_query($conn, "SELECT CatName FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $name=$result['CatName'];
    if ($CatId==0) {
        $name="Main view";
    }
    return $name;
}
function PackageTypeName($PackagingTypeId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT PackageType FROM PackageType WHERE Id='$PackagingTypeId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $name=$result['PackageType'];
    return $name;
}
function PackagePrice($StockItem, $ThePackage)
{
    global $conn;
    $strSQL="SELECT Price FROM StockPackaging WHERE StockId='$StockItem' AND Id='$ThePackage'";
    // $strSQL;
    $sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    //echo $result['Price']."<br>";
    return $result['Price'];
}
function RequestTotal($SelectStockQties)
{
    global $conn;
    $SelectedStock=explode(':', $SelectStockQties);
    $Total=0;
    foreach ($SelectedStock as $Stock) {
        //echo $Stock."<br>";
        if ($Stock!='') {
            $StockDetails=explode('@', $Stock);
            $ThePackage=@$StockDetails[1];
            $OtherDetails=explode('*', $StockDetails[0]);
            $Qty=$OtherDetails[1];
            $StockItem=$OtherDetails[0];
            $PackagePrice=PackagePrice($StockItem, $ThePackage);
            $TotalForPackage=$PackagePrice * $Qty;
            $Total+=$TotalForPackage;
        }
    }
    return $Total;
}
function StockCategoryName($CatId)
{
    //This function gets the name of a next of kin relationship based on the id supplied.It should be self explanatory
    global $conn;
    $sql=mysqli_query($conn, "SELECT CatName FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $name=$result['CatName'];
    if ($name=='') {
        $name="No Parent Category";
    }
    return $name;
}
function RequestDepartment($RequestId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT DepartmentId FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $DepartmentId=$result['DepartmentId'];
    return $DepartmentId;
}
function CategorySuppliers($Cat)
{
    global $conn;
    $Suppliers='';
    $sql=mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE  CatId='$Cat'") or die(mysqli_error($conn));
    if (mysqli_num_rows($sql)==0) {
        $result=0;
    } else {
        while ($recs=mysqli_fetch_array($sql)) {
            $SupplierId=$recs['SupplierId'];
            $Suppliers.=$SupplierId.":";
            $result=$Suppliers;
        }
    }
    return $result;
}
function CleanPRQTempTable($UserId)
{
    global $conn;
    $sql=mysqli_query($conn, "DELETE FROM PRQTemp WHERE UserId='$UserId'") or die(mysqli_error($conn));
    if ($sql==1) {
        $result=1;
    } else {
        $result=0;
    }
    return $result;
}
function SupplierReplyDetails($SupplierId, $StockId, $QuoteRequestId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT Amt FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId' AND (StockId='$StockId' AND SupplierId='$SupplierId')") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $amt=$result['Amt'];
    return $amt;
}
function SupplierReplyTotals($Supplier, $QuoteRequestId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT Sum(Amt) AS SumAmt FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId' AND  SupplierId='$Supplier' ") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $SumAmt=$result['SumAmt'];
    return $SumAmt;
}
function LPOTotal($Id)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT SUM(Price) AS SumPrice FROM LPOStockDetails WHERE LPOId='$Id' ") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $Price=$result['SumPrice'];
    return $Price;
}
function LPOQtyDetails($StockId, $LPOId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT Qty,Packaging,CatId FROM LPOStockDetails WHERE LPOId='$LPOId' AND StockId='$StockId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $Qty=$result['Qty'];
    $Packaging=$result['Packaging'];
    $CatId=$result['CatId'];
    $QtyDetails=$Qty.':'.$Packaging.':'.$CatId;
    return $QtyDetails;
}
function WriteStockMvtIn($StockId, $QtyIn, $Packaging, $CatId, $DateMvt, $From, $To)
{
    global $conn;
    // echo "Stocck Id ".$StockId." Qty In ".$QtyIn." Packaging ".$Packaging." Category ".$CatId." Date Mvt ".$DateMvt." From ".$From." To ".$To."<br>";
    $sql=mysqli_query($conn, "INSERT INTO StockMovementTable(StockId,QtyIn,Packaging,CatId,DateOfMvt,FromDept,ToDept) VALUES('$StockId','$QtyIn','$Packaging','$CatId','$DateMvt','$From','$To')") or die(mysqli_error($conn));
    if ($sql==1) {
        echo "1";
    } else {
        echo "Unable to insert Stock Movement";
    }
}
function LPOStockPackaging($LPOId)
{
    global $conn;
    $sqlPackaging=mysqli_query($conn, "SELECT Packaging FROM LPOStockDetails WHERE LPOId='$LPOId'") or die(mysqli_error($conn));
    $resultPackaging=mysqli_fetch_assoc($sqlPackaging);
    $Packaging=$resultPackaging['Packaging'];
    return $Packaging;
}
function DeliverySupplier($DeliveryNote)
{
    global $conn;
    $sqlLPOStock=mysqli_query($conn, "SELECT LPOId FROM LPOService WHERE DeliveryNote='$DeliveryNote'") or die(mysqli_error($conn));
    $resultLPO=mysqli_fetch_assoc($sqlLPOStock);
    $LPOId=$resultLPO['LPOId'];
    $sqlSupplier=mysqli_query($conn, "SELECT SupplierId FROM StockLPO WHERE Id='$LPOId'") or die(mysqli_error($conn));
    $resultSupplier=mysqli_fetch_assoc($sqlSupplier);
    $SupplierId=$resultSupplier['SupplierId'];
    return $SupplierId;
}
function SupplyBroughtInQty($StockId, $LPOId)
{
    global $conn;
    //echo "SELECT  BroughtInQty FROM LPOService WHERE StockId='$StockId' AND LPOId='$LPOId'";
    $sqlBroughtInQty=mysqli_query($conn, "SELECT  BroughtInQty FROM LPOService WHERE StockId='$StockId' AND LPOId='$LPOId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sqlBroughtInQty);
    $BroughtInQty=$result['BroughtInQty'];
    return $BroughtInQty;
}
function LPOPriceDetails($StockId, $LPOId)
{
    global $conn;
    $sqlBroughtInQty=mysqli_query($conn, "SELECT Packaging,Price FROM LPOStockDetails WHERE StockId='$StockId' AND LPOId='$LPOId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sqlBroughtInQty);
    $Packaging=$result['Packaging'];
    $Price=$result['Price'];
    $PackageName= PackagingInfo($Packaging);
    $result=$PackageName.':'.$Price;
    return $result;
}
function SupplierInLPO($LPOId)
{
    global $conn;
    $sqlSupplier=mysqli_query($conn, "SELECT SupplierId FROM StockLPO WHERE Id='$LPOId'") or die(mysqli_error($conn));
    $resultSupplier=mysqli_fetch_assoc($sqlSupplier);
    $SupplierId=$resultSupplier['SupplierId'];
    $SupplierName=SupplierNames($SupplierId);
    return $SupplierName;
}
function DecreaseStockAmt($StockId, $SupplyQty)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT quantity FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $qty=$result['quantity'];
    $RemStock=$qty-$SupplyQty;
    $sql=mysqli_query($conn, "UPDATE StockTable SET quantity='$RemStock' WHERE Id='$StockId'") or die(mysqli_error($conn));
}
function CheckIfServiceComplete($RequestId, $StockDetails)
{
    global $conn;
    $ifComplete=0;
    $count=0;
    $Completed=0;
    $TheStock=explode(':', $StockDetails);
    foreach ($TheStock as $StockDetail) {
        if ($StockDetail!='' or !empty($StockDetail)) {
            $StockInfo=explode('*', $StockDetail);
            $StockId=$StockInfo[0];
            $OtherDetails=explode('@', $StockInfo[1]);
            $Qty=$OtherDetails[0];
            $Packaging=$OtherDetails[1];
            //echo "Stock Id ".$StockId." QTY ".$Qty." Packaging ".$Packaging."<br>";
            $SuppliedQty=CheckSuppliedQty($RequestId, $StockId);
            //echo "Supplied Qty ".$SuppliedQty." Requested Qty ".$Qty."<br>";
            if ($SuppliedQty>=$Qty) {
                $ifComplete+=1;
            }
        }
        $count++;
        //echo "<br>Count ".$count." ifComplete ".$ifComplete."<br>";
    }
    //echo "Complete ".$ifComplete." Stock Count ".count($TheStock)."<br>";
    if (($ifComplete!=0 && count($TheStock)!=0) &&  $ifComplete==(count($TheStock)-1)) {
        $Completed=1;
    } else {
        $Completed=0;
    }
    return $Completed;
}
function MarkRequestAsServiced($RequestId, $UserId)
{
    global $conn;
    $strSQL="UPDATE InternalStockRequests SET ServiceStatus='1',ServicedBy='$UserId' WHERE Id='$RequestId'";
    echo $strSQL;
    $sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
}
function WriteStockMvtOut()
{
    
}