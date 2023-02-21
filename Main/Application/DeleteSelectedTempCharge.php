<?php  include "../Config/db_conn.php";
global $conn;
$ChargeId=$_REQUEST['ChargeId'];

$sql=mysqli_query($conn, "DELETE FROM PatientChargeSheetTemp WHERE Id='$ChargeId'") or die(mysqli_error($conn));
if($sql==1)
{
echo "1";
}
else
{
echo "Unable to delete charge.Please try again later";
}
