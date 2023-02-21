<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$QuoteRequestId=$_REQUEST['QuoteRequestId'];
$SupplierId=$_REQUEST['SupplierId'];
$ReplyId=$_REQUEST['ReplyId'];
$SupplierReplies=explode(':',$_REQUEST['SupplierReplies']);
$StockId='';
$Amt='';
$success=0;


foreach($SupplierReplies as $SupplierReply)
{
     if($SupplierReply!='')
	 {
	    $ReplyDetails=explode('*',$SupplierReply);
	
		    $StockId=$ReplyDetails[0];
			$Amt=$ReplyDetails[1];
	          $sqlCheckIfAlreadyReplied=mysqli_query($conn, "SELECT * FROM QuotationRequestsReplies WHERE SupplierId='$SupplierId' AND QuoteId='$QuoteRequestId' AND StockId='$StockId'") or die(mysqli_error($conn));
			  if(mysqli_num_rows($sqlCheckIfAlreadyReplied)>0)
			  {
			  $resultExisted=mysqli_fetch_assoc($sqlCheckIfAlreadyReplied);
			  $ReplyId=$resultExisted['Id'];
			 
			   $sqlInsertReplyDetails=mysqli_query($conn, "UPDATE QuotationRequestsReplies  SET Amt='$Amt' WHERE Id='$ReplyId'")  or die(mysqli_error($conn));
			  }
			  else
			  {
             $sqlInsertReplyDetails=mysqli_query($conn, "INSERT INTO QuotationRequestsReplies(QuoteId,SupplierId,StockId,Amt) VALUES('$QuoteRequestId','$SupplierId','$StockId','$Amt')") or die(mysqli_error($conn));
			 }
			 if($sqlInsertReplyDetails==1)
			 {
			 $success+=1;
			 }
	 }
	 
}

if($success>0)
{
echo "1";
}
else
{
echo "Replies not stored.PLease contact your adminisdtrator";
}
