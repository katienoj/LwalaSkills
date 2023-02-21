<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$RequestId=$_REQUEST['RequestId'];
$SupplierNo=$_REQUEST['SupplierNo'];
$sql=mysqli_query($conn, "SELECT * FROM InternalStockRequests WHERE Id='$RequestId' ") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);
$DepartmentId=$result['DepartmentId'];
//$DateOfRequest=$result['DateOfRequest'];
$DateExpected=$result['DateExpected'];
$StockDetails=$result['StockDetails'];
$RequestTotal=$result['RequestTotal'];
$date=date('Y-m-d', time());
$SupplierSQL="INSERT INTO StockLPO(DepartmentId,DateOfRequest,DateExpected,StockDetails,RequestTotal,SupplierId,InternalRequestIds) VALUES('$DepartmentId','$date','$DateExpected','$StockDetails','$RequestTotal','$SupplierNo','$RequestId')";
$sql=mysqli_query($conn, $SupplierSQL) or die(mysqli_error($conn));
if ($sql==1) {
    echo "1";
    $sqlUpdateRequest=mysqli_query($conn, "UPDATE InternalStockRequests SET LPOIssued='1' WHERE Id='$RequestId'") or die(mysqli_error($conn));
} else {
    echo "Unable to store LPO.PLease try later";
}
