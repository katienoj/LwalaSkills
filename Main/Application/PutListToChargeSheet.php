<?php
include "../Config/db_conn.php";

session_start();
$UserId=$_SESSION['UserId'];
$PatId=$_REQUEST['PatientId'];

global $conn;

$sql=mysqli_query($conn, "SELECT * FROM PatientChargeSheetTemp WHERE UserId='$UserId' AND PatientId='$PatId'") or die(mysqli_error($conn));
while ($recs=mysqli_fetch_array($sql)) {
    $ChargeId=$recs['Id'];
    $DepartmentId=$recs['DepartmentId'];
    $Particulars=$recs['ParticularsId'];
    $EpisodeNo=$recs['EpisodeNo'];
    $Cost=$recs['Cost'];
    $qty=$recs['Quantity'];
    $Amount=$recs['Amount'];
    $PatientId=$recs['PatientId'];
    $Date=$recs['Date'];
    $UserId=$recs['UserId'];
    $Currency=$recs['Currency'];
    $Service=$recs['Service'];
    $BillType=$recs['BillType'];


            
        
    InsertIntoChargeSheet($ChargeId, $DepartmentId, $Particulars, $EpisodeNo, $Cost, $qty, $Amount, $PatientId, $Date, $UserId, $Currency, $Service, $BillType);
}
echo "1";
