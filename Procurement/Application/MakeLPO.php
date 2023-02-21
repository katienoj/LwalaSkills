<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$QuoteRequestId=$_REQUEST['QuoteRequestId'];
$SupplierId=$_REQUEST['SupplierId'];
$Now=date('Y-m-d',time());
$sqlCheckIfLPOMade=mysqli_query($conn, "SELECT * FROM StockLPO where QuoteRequestId='$QuoteRequestId'") or die(mysqli_error($conn));
if(mysqli_num_rows($sqlCheckIfLPOMade)>0)
{
 echo "An LPO has already been made for the selected Quotation Request";
}
else
{
$TotalAmt=0;

$sqlReplyDetails=mysqli_query($conn, "SELECT Amt,StockId FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId' AND SupplierId='$SupplierId'") or die(mysqli_error($conn));

while($result=mysqli_fetch_array($sqlReplyDetails))
{
$StockId=$result['StockId'];
$Amt=$result['Amt'];
$TotalAmt+=$Amt;
}

 if($TotalAmt==0)
 {
 echo "Replies to the selected Quotation Request to the supplier total to zero.The LPO cannot have a zero  total";
 }
 else
{
$sqlInsertLPO=mysqli_query($conn, "INSERT INTO StockLPO(SupplierId,DateOfLPO,QuoteRequestId) VALUES('$SupplierId','$Now','$QuoteRequestId')") or die(mysqli_error($conn));

$NewLPOId=mysqli_insert_id($conn);


$sqlReplyDetails=mysqli_query($conn, "SELECT * FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId' AND SupplierId='$SupplierId'") or die(mysqli_error($conn));

while($result=mysqli_fetch_array($sqlReplyDetails))
{
$StockId=$result['StockId'];
$Amt=$result['Amt'];
$Currency=$result['Currency'];
 
 $sqlQuotationRequestDetails=mysqli_query($conn, "SELECT * FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteRequestId' AND StockId='$StockId'") or die(mysqli_error($conn));
 
$resultQuotation=mysqli_fetch_assoc($sqlQuotationRequestDetails);
 $CatId=$resultQuotation['CatId'];
 $Packaging=$resultQuotation['Packaging'];
 $Qty=$resultQuotation['Qty'];
 
 
 $sqlInsertLPODetails=mysqli_query($conn, "INSERT INTO LPOStockDetails(StockId,CatId,Packaging,Price,LPOId,Qty,Currency) VALUES('$StockId','$CatId','$Packaging','$Amt','$NewLPOId','$Qty','$Currency')") or die(mysqli_error($conn));
 if($sqlInsertLPODetails==1)
 {
 echo "1";
 }
 else
 {
   echo "Unable to insert LPO";
 }
 }
 }
 }
