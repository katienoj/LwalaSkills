<?php 
include "../../../Main/Config/db_conn.php";

$MfgName=$_REQUEST['MfgName'];
$DateMfg=convert_date($_REQUEST['DateMfg']);
$ExprDate=convert_date($_REQUEST['ExprDate']);
$OtherDetails=$_REQUEST['OtherDetails'];
$DetailsId=$_REQUEST['DetailsId'];
$StockId=$_REQUEST['StockId'];
if($ExprDate < $DateMfg)
{
//echo "DATE MFG ".$DateMfg."<br>".$ExprDate;
 echo "It appears the Expiry date is earlier than the Mfg Date.Correct this anomaly to reflect a more realistic date of Mfg/Expiry difference";
}
else
{
$strSQL="UPDATE ItemMfgDetails SET Manufacturer='$MfgName',DateMfg='$DateMfg',ExprDate='$ExprDate',OtherDetails='$OtherDetails',StockId='$StockId' WHERE Id='$DetailsId'";

$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));

if($sql==1)
{
echo "1";
}
else
{
echo "Unable to record the Mfg Details";
}
}
