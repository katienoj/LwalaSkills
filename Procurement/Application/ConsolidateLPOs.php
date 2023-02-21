<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$SelectedLPOs=explode(':', $_REQUEST['SelectedLPOs']);
$Suppliers='';
$Departments='';
$Supplier='';
$ifMultiple=0;
$date=date('Y-m-d', time());
foreach ($SelectedLPOs as $LPO) {
    if ($LPO!='') {
        $sql=mysqli_query($conn, "SELECT SupplierId,DepartmentId FROM StockLPO WHERE Id='$LPO'") or die(mysqli_error($conn));
        $result=mysqli_fetch_assoc($sql);
        $Supplier=$result['SupplierId'];
        $DeptId=$result['DepartmentId'];
        $Suppliers.=$result['SupplierId'].'+';
        $Departments.=$result['DepartmentId'].'+';
    }
}
//echo $Suppliers."<br>";
$theSuppliers=explode('+', $Suppliers);
foreach ($theSuppliers as $thesupplier) {
    if ($thesupplier!=$Supplier and  $thesupplier!='') {
        echo "TO consolidate LPOs the LPOs must be to the same Supplier<br>";
        exit;
        $ifMultiple=0;
    } else {
        $ifMultiple=1;
    }
}
//echo $Departments."<br>";
$DepartmentIds=explode('+', $Departments);
foreach ($DepartmentIds as $Dept) {
    // echo "Selected ".$Dept." Department".$DeptId."<br>";
    if ($Dept!=$DeptId && $Dept!='') {
        echo "TO consolidate LPOs the LPOs must be from the Same Department";
        exit;
        $ifMultiple=0;
    } else {
        $ifMultiple=1;
    }
}
//echo $ifMultiple;
if ($ifMultiple==1) {
    $NewLPOStock='';
    $TotalRequestTotal='';
    foreach ($SelectedLPOs as $LPO) {
        if ($LPO!='') {
            $sql=mysqli_query($conn, "SELECT * FROM StockLPO WHERE Id='$LPO'") or die(mysqli_error($conn));
            $result=mysqli_fetch_assoc($sql);
            $StockDetails=$result['StockDetails'];
            $TotalRequestTotal+=$result['RequestTotal'];
            $NewLPOStock.=$StockDetails.':';
            $sqlUpdate=mysqli_query($conn, "UPDATE StockLPO SET Consolidated='1' WHERE Id='$LPO'") or die(mysqli_error($conn));
        }
    }
    $SupplierSQL="INSERT INTO StockLPO(DepartmentId,DateOfRequest,DateExpected,StockDetails,RequestTotal,SupplierId,ConsolidatedLPOs) VALUES('$DeptId','$date','','$NewLPOStock','$TotalRequestTotal','$Supplier','$SelectedLPOs')";
    $sql=mysqli_query($conn, $SupplierSQL) or die(mysqli_error($conn));
    echo $sql;
}
