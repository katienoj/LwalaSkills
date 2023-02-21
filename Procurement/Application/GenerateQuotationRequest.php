<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
    $UserId=$_SESSION['UserId'];
    $EmployeeId=$_SESSION['EmployeeId'];
    $UserNames=$_SESSION['UserName'];
    //$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
    //$result=mysqli_fetch_assoc($sql);
    //$SessionId=$result['Session_Id'];
    //echo "New ".$SessionId."<br>Old".session_id();
        $SelectedSuppliers=$_REQUEST['SelectedSuppliers'];
        $PRQId=$_REQUEST['PRQId'];
        $Success=0 ;
        $Now=date('Y-m-d', time());
        $sqlNewQuotationDetails=mysqli_query($conn, "	INSERT INTO QuotationRequests(DateOfQuotationRequest,PRQId,UserId,Suppliers)  VALUES('$Now','$PRQId','$UserId','$SelectedSuppliers')") or  die(mysqli_error($conn));
        $NewQuoteRequestId=mysqli_insert_id($conn);
        $sqlMarkQuotationRequestAsProcessed=mysqli_query($conn, "UPDATE ProcurementTable SET ProcessingStatus='1',ProccessedBy='$UserId' WHERE Id='$PRQId'") or die(mysqli_error($conn));
        $sqlGetPRQDetails=mysqli_query($conn, "SELECT * FROM ProcurementRequest WHERE RequestId='$PRQId'") or die(mysqli_error($conn));
                 while ($recs=mysqli_fetch_array($sqlGetPRQDetails)) {
                     $StockId=$recs['StockId'];
                     $Qty=$recs['Qty'];
                     $Packaging=$recs['Packaging'];
                     $CatId=$recs['CatId'];
                     $DateOfRequest=dteconvert($recs['DateOfRequest']);
                     $RequestId=$recs['RequestId'];
                     $Id=$recs['Id'];
                     $Approver=$recs['Approver'];
                     $dteApproved=$recs['DateOfApproval'];
                     $ProcessedBy=$recs['ProcessedBy'];
                     $DateOfProcessing=$recs['DateOfProcessing'];
                     $sqlPutQuotationRequestDetails=mysqli_query($conn, "INSERT INTO QuotationRequestDetails(StockId,Qty,Packaging,CatId,QuoteRequestId) VALUES('$StockId','$Qty','$Packaging','$CatId','$NewQuoteRequestId')") or die(mysqli_error($conn));
                     if ($sqlPutQuotationRequestDetails==1) {
                         $Success+=1;
                     }
                 }
        if ($Success>0) {
            echo "1";
        }
