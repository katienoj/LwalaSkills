<?php
session_start();
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$DateOfMvt=date('Y-m-d', time());
if ($UserId=='') {
    $UserId=ResolveUserId(number_format($EmployeeId));
}
$StockDetails=explode(':', $_REQUEST['StockDetails']);
$RequestId=$_REQUEST['RequestId'];
$SupplyQties=explode(':', $_REQUEST['SupplyQties']);
$count=0;
$ifComplete='';
foreach ($StockDetails as $StockDetail) {
    if ($StockDetail==' ' or empty($StockDetail)) {
    } else {
        // echo "<br>".$StockDetail."<br>";
        $SupplyQty=$SupplyQties[$count];
        $StockItems=explode('*', $StockDetail);
        $StockId=$StockItems[0];
        $OtherStockDetails=explode('@', $StockItems[1]);
        $QtyOrdered=$OtherStockDetails[0];
        $Packaging=$OtherStockDetails[1];
        $RemToSupply=$QtyOrdered-$SupplyQty;
        $DepartmentId=RequestDepartment($RequestId);
        $QtyInStore=CheckQtyInStore($StockId);
        $ActualQtyToSupply=QtyInPackaging($StockId, $Packaging);
        $From='19';
        $To=$DepartmentId;
        if ($ActualQtyToSupply > $QtyInStore) {
        } else {
            $sql=mysqli_query($conn, "INSERT INTO DepartmentStock(DepartmentId,StockId,StockQtyIn,RequestId,RemToSupply,DateOfDeptStockMvt,Packaging,FromDept,ToDept) VALUES('$DepartmentId','$StockId','$SupplyQty','$RequestId','$RemToSupply','$DateOfMvt','$Packaging','19','$DepartmentId')") or die(mysqli_error($conn));
            if ($sql==1) {
                DecreaseStockAmt($StockId, $SupplyQty);
                WriteStockMvtOut($StockId, $Packaging, $From, $To, $DateOfMvt, $SupplyQty);
                $IfComplete=CheckIfServiceComplete($RequestId, $_REQUEST['StockDetails']);
                if ($IfComplete==1) {
                    //echo "Service Complete";
                    MarkRequestAsServiced($RequestId, $UserId);
                }
                echo "1";
            } else {
                echo "Unable to Service Request";
            } /**/
        }
    }
    $count++;
}
function CheckSuppliedQty($RequestId, $StockId)
{
    global $conn;
    $StockQtyIn=0;
    $sql=mysqli_query($conn, "SELECT StockQtyIn FROM DepartmentStock WHERE RequestId='$RequestId' AND StockId='$StockId'") or die(mysqli_error($conn));
    while ($result=mysqli_fetch_assoc($sql)) {
        $QtyIn=$result['StockQtyIn'];
        $StockQtyIn+=$QtyIn;
    }
    // echo "Stock Qty In".$StockQtyIn."<br>";
    return $StockQtyIn;
}
