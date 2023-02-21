<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
$UserNames=$_SESSION['UserName'];
$selectedRequests=explode(':', $_REQUEST['SelectedRequests']);
if ($UserId=='') {
    $UserId=ResolveUserId(number_format($EmployeeId));
}
$sqlTempPRQs=mysqli_query($conn, "SELECT * FROM PRQTemp WHERE UserId='$UserId'") or die(mysqli_error($conn));
while ($recs=mysqli_fetch_array($sqlTempPRQs)) {
    $StockId=$recs['StockId'];
    $Qty=$recs['Qty'];
    $Packaging=$recs['Packaging'];
    $CatId=$recs['CatId'];
    $RequestId=$recs['RequestId'];
    $TempId=$recs['Id'];
    $Now=date('Y-m-d', time());
    $sqlCheckIfExists=mysqli_query($conn, "SELECT * FROM ProcurementRequest WHERE CatId='$CatId' AND UserId='$UserId' AND DateOfRequest='$Now'") or die(mysqli_error($conn));
    //echo mysqli_num_rows($sqlCheckIfExists)."<br>";
    if (mysqli_num_rows($sqlCheckIfExists)==0) {
        $sqlNewPRQ=mysqli_query($conn, "INSERT INTO ProcurementTable(DateCreated,RequestId,CatId) VALUES('$Now','$RequestId','$CatId')") or die(mysqli_error($conn));
        $PRQId=mysqli_insert_id($conn);
    } else {
        $res=mysqli_fetch_assoc($sqlCheckIfExists);
        $PRQId=$res['PRQId'];
    }
    $sqlNewPRQ=mysqli_query($conn, "INSERT INTO ProcurementRequest(StockId,CatId,Packaging,RequestId,Qty,UserId,DateOfRequest,PRQId) VALUES('$StockId','$CatId','$Packaging','$RequestId','$Qty','$UserId','$Now','$PRQId')") or die(mysqli_error($conn));
    $UpdateInternalRequestAsProcessed=mysqli_query($conn, "UPDATE InternalStockRequests SET Processed='1',ProcessedBy='$UserId',DateOfProcessing='$Now'") or die(mysqli_error($conn));
    $sqlDeleteTempPRQ=mysqli_query($conn, "DELETE FROM PRQTemp WHERE Id='$TempId' ") or die(mysqli_error($conn));
}
echo "1";
