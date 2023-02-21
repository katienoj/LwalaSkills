<?php 
session_start();
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$CurrentDepartment=GetUserDepartment($UserId);
$DateOfMvt=date('Y-m-d',time());
if($UserId=='')
{
$UserId=ResolveUserId(number_format($EmployeeId));
}

$StockDetails=explode(':',$_REQUEST['StockDetails']);
$RequestId=$_REQUEST['RequestId'];
$SupplyQties=explode(':',$_REQUEST['SupplyQties']);
$count=0;
$ifComplete='';
foreach($StockDetails as $StockDetail)
{
     if($StockDetail==' ' or empty($StockDetail))
	 {
	   echo "<br>".$StockDetail."<br> Details not found";
	 }
	 else
	 {
	   // echo "<br>".$StockDetail."<br>";
	    
		 $SupplyQty=$SupplyQties[$count];
		 $StockItems=explode('*',$StockDetail);
		 $StockId=$StockItems[0];
		
		 $OtherStockDetails=explode('@',$StockItems[1]);
		 $QtyOrdered=$OtherStockDetails[0];
		 $Packaging=$OtherStockDetails[1];
		 $RemToSupply=$QtyOrdered-$SupplyQty;
		 $DepartmentId=RequestDepartment($RequestId);
		 $QtyInDept=CheckQtyInDept($StockId,$DepartmentId);
		 $ActualQtyToSupply=QtyInPackaging($StockId,$Packaging);
		 $From=$CurrentDepartment;
		 $To=$DepartmentId;
		 if($ActualQtyToSupply > $QtyInDept)
		 {
		 echo "ActualQtyToSupply is greater than QtyInDept";
		 }
		 else
		 { 
		 $sql=mysqli_query($conn, "INSERT INTO DepartmentStock(DepartmentId,StockId,StockQtyIn,RequestId,RemToSupply,DateOfDeptStockMvt,Packaging,FromDept,ToDept) VALUES('$DepartmentId','$StockId','$SupplyQty','$RequestId','$RemToSupply','$DateOfMvt','$Packaging','$CurrentDepartment','$DepartmentId')") or die(mysqli_error($conn));
		 if($sql==1)
		 {


		  $sql2=mysqli_query($conn, "UPDATE InternalStockRequests set Processed = '1', ServiceStatus='1', ServicedBy='$UserId', ProcessedBy = '$UserId' WHERE Id = '$RequestId'") or die(mysqli_error($conn));
		


		 $IfComplete=CheckIfServiceComplete($RequestId,$_REQUEST['StockDetails']);
		 if($IfComplete==1)
		 {
                    //echo "Service Complete";
		    MarkRequestAsServiced($RequestId,$UserId);

		 }
	
		 echo "1";
		 }
		 else
		 {
		 echo "Unable to Service Request";
		 } /**/
		 }
	}
      $count++;
}
