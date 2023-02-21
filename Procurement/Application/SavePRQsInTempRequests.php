<?php 
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

	$UserId=$_SESSION['UserId'];
	$EmployeeId=$_SESSION['EmployeeId'];
	$UserNames=$_SESSION['UserName'];
	$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$SessionId=$result['Session_Id'];
	//echo "New ".$SessionId."<br>Old".session_id();
	
    $SelectedPRQs=explode(':',$_REQUEST['SelectedPRQs']);
	$dte=date('Y-m-d',time());

$success=0;
        foreach($SelectedPRQs as $PRQ)
		  {
		      if($PRQ!='')
			  {
			      $sqlGetThePRQ=mysqli_query($conn, "SELECT * FROM ProcurementRequest WHERE Id='$PRQ'") or die(mysqli_error($conn));
				  $recs=mysqli_fetch_assoc($sqlGetThePRQ);
					$StockId=$recs['StockId'];
					$Qty=$recs['Qty'];
					$Packaging=$recs['Packaging'];
					$CatId=$recs['CatId'];
					$DateOfRequest=$recs['DateOfRequest'];
					$RequestId=$recs['RequestId'];
					$PRQId=$recs['Id'];
					$CategorySuppliers=explode(':',CategorySuppliers($CatId));
					foreach($CategorySuppliers as $Supplier)
					{
						 if($Supplier!='')
						 {
							 $sql=mysqli_query($conn, "INSERT INTO GeneratedQuotationRequests(SupplierId,StockId,CatId,Packaging,PRQDateOfRequest,RequestId,PRQId,Qty,UserId,DateOfQuotationRequest) VALUES('$Supplier','$StockId','CatId','$Packaging','$DateOfRequest','$RequestId','$PRQId','$Qty','$UserId','$dte')") or die(mysqli_error($conn));
							 if($sql==1)
							 {
							    $success+=1;
							 }
						  }
				   }
				   $sqlMarkPRQAsProcessed=mysqli_query($conn, "UPDATE ProcurementRequest SET ProcessedStatus='1' ,ProcessedBy='$UserId',DateOfProcessing='$dte' WHERE Id='$PRQ'") or die(mysqli_error($conn));
				   

			  }
		  }
		  if($success>0)
		  {
		      echo "1";
		  }
		  else
		  {
		     echo "Unable to store the Quotation Requests";
		  }
