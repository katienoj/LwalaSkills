<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$QuoteRequestId = $_REQUEST['QuoteRequestId'];
$EnteredItems = explode(':', $_REQUEST['EnteredItems']);
$Currency = $_REQUEST['Currency'];

foreach ($EnteredItems as $EnteredItem) {
	if ($EnteredItem != '') {
		// echo $EnteredItem."<br>";
		$TheDetails = explode('*', $EnteredItem);
		$StockId = $TheDetails[2];
		$SupplierId = $TheDetails[1];
		$Amt = $TheDetails[0];
		//echo "SELECT * FROM QuotationRequestsReplies WHERE SupplierId='$SupplierId' AND QuoteId='$QuoteRequestId' AND StockId='$StockId'";
		$sqlCheckIfAlreadyReplied = mysqli_query($conn, "SELECT * FROM QuotationRequestsReplies WHERE SupplierId='$SupplierId' AND QuoteId='$QuoteRequestId' AND StockId='$StockId'") or die(mysqli_error($conn));
		if (mysqli_num_rows($sqlCheckIfAlreadyReplied) > 0) {
			$resultExisted = mysqli_fetch_assoc($sqlCheckIfAlreadyReplied);
			$ReplyId = $resultExisted['Id'];

			$sqlInsertReplyDetails = mysqli_query($conn, "UPDATE QuotationRequestsReplies  SET Amt='$Amt',Currency='$Currency' WHERE Id='$ReplyId'")  or die(mysqli_error($conn));
		} else {
			$sqlInsertReplyDetails = mysqli_query($conn, "INSERT INTO QuotationRequestsReplies(QuoteId,SupplierId,StockId,Amt,Currency) VALUES('$QuoteRequestId','$SupplierId','$StockId','$Amt','$Currency')") or die(mysqli_error($conn));
		}
		if ($sqlInsertReplyDetails == 1) {
			$success += 1;
		}
	}
}
