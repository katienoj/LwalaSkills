<?php
function RequestDepartment($RequestId)
{
    global $conn;
    $sql=mysqli_query($conn, "SELECT DepartmentId FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $DepartmentId=$result['DepartmentId'];
    return $DepartmentId;
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
