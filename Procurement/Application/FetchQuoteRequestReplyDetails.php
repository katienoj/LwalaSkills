<?php
require_once '../../Main/Config/db_conn.php';
$QuoteRequestId=$_REQUEST['QuoteRequestId'];
$SupplierId=$_REQUEST['SupplierId'];
$responseVars='';
$StockId='';
$sql=mysqli_query($conn, "SELECT * FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId' AND SupplierId='$SupplierId'") or die(mysqli_error($conn));
while ($result=mysqli_fetch_array($sql)) {
    $StockId=$result['StockId'];
    $Amt=$result['Amt'];
    $Id=$result['Id'];
    $response=$StockId.':'.$Amt.':'.$Id;
    $responseVars.=$response.'+';
}
 echo $responseVars;
