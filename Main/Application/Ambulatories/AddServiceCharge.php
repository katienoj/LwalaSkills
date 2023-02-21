<?php
//this is the script for saving charges done at dental clinic
require_once '../../Config/db_conn.php';
require_once '../../../AuditTrail/Include/AuditTrailFunc.php';
session_start();
    global $conn;
    $PatientId = htmlentities($_REQUEST['PatientId']);
    $EpisodeId = htmlentities($_REQUEST['EpisodeId']);
    $ServiceId = htmlentities($_REQUEST['ServiceId']);
    $Staff = htmlentities($_REQUEST['Staff']);
    $Quantity = htmlentities($_REQUEST['Quantity']);
    $DepartmentId = htmlentities($_REQUEST['Department']);
    $DoctorRelated = htmlentities($_REQUEST['DoctorRelated']);
    $DoctorToPay = htmlentities($_REQUEST['DoctorToPay']);
    //$DoctorRelated = htmlentities($_REQUEST['DoctorRelated']);
        $GetCost=mysqli_query($conn, "SELECT * FROM HospitalServices WHERE ServiceId='$ServiceId'");
        while ($rows=mysqli_fetch_array($GetCost)) {
            $Cost = $rows['Amount'];
            $Amount=$Cost;
            $Service=$rows['ServiceName'];
            $DoctorRelated=$rows['DoctorRelated'];
        }
    $Type='Service';
    $GetUserId=mysqli_query($conn, "SELECT * FROM EmployeeTable WHERE EmployeeName='$Staff'");
    while ($rows=mysqli_fetch_array($GetUserId)) {
        $UserId = $rows['Id'];
    }
$ToatalCost=$Amount*$Quantity;
 $InsertCharge ="INSERT INTO PatientChargeSheet (PatientId,ParticularsId,DepartmentId,Quantity,Cost,Amount,Date,EpisodeNo,UserId,Type,DoctorRelated,DoctorToPay) VALUES('$PatientId','$ServiceId','$DepartmentId','$Quantity','$Amount','$ToatalCost',CURDATE(),'$EpisodeId ','$UserId','$Type','$DoctorRelated','$DoctorToPay')";
        $ExecInsertCharge= mysqli_query($conn, $InsertCharge)or die(mysqli_error($conn));
        if (!$ExecInsertCharge) {
            //notify user if Charge could not be created
            echo("Problems Occured while writing to database. Charge was not saved");
        } else {
            //notify user on successful charge creation
            $SessionId = session_id();
            //AuditTransaction($SessionId,$InsertCharge);
            echo "Charge Successfully saved";
        }
