<?php 
require_once '../../../Main/Config/db_conn.php';
$SupplierId=$_REQUEST['SupplierId'];
$CreditAmt=$_REQUEST['CreditAmt'];
$CreditPeriod=$_REQUEST['CreditPeriod'];
$Currency=$_REQUEST['Currency'];

//echo "UPDATE SuppliersTable SET CreditTerms='$CreditPeriod',CreditLimitAmount='$CreditAmt',CreditLimitAmtCurrency='$Currency' WHERE Id='$SupplierId' ";
$sqlUpdate=mysqli_query($conn, "UPDATE SuppliersTable SET CreditTerms='$CreditPeriod',CreditLimitAmount='$CreditAmt',CreditLimitAmtCurrency='$Currency' WHERE Id='$SupplierId' ") or die(mysqli_error($conn));
echo $sqlUpdate;
