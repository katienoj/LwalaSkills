<?php
//this is the script for saving charges done at dental clinic
require_once '../../Config/db_conn.php';
require_once '../../../AuditTrail/Include/AuditTrailFunc.php';
session_start();
    global $conn;
    $PatientId = htmlentities($_REQUEST['PatientId']);
    $EpisodeId = htmlentities($_REQUEST['EpisodeId']);
    $Procedure = htmlentities($_REQUEST['Procedure']);
    $Staff = htmlentities($_REQUEST['Staff']);
    $Quantity = htmlentities($_REQUEST['Quantity']);
    //$Type = htmlentities($_REQUEST['Type']);
    $DepartmentId = htmlentities($_REQUEST['Department']);
    //$DepartmentId =5;
        $GetCost=mysqli_query($conn, "SELECT * FROM Procedures WHERE ProcedureName='$Procedure'");
        while ($rows=($GetCost)) {
            $Cost = $rows['Cost'];
            $Amount=$Cost;
            $ProcedureId=$rows['ProcedureId'];
        }
    $Type='Procedure';
$GetUserId=mysqli_query($conn, "SELECT * FROM EmployeeTable WHERE EmployeeName='$Staff'");
while ($rows=mysqli_fetch_array($GetUserId)) {
    $UserId = $rows['Id'];
}
$ToatalCost=$Amount*$Quantity;
 $InsertCharge ="INSERT INTO PatientChargeSheet (PatientId,ParticularsId,DepartmentId,Quantity,Cost,Amount,Date,EpisodeNo,UserId,Type) VALUES('$PatientId','$ProcedureId','$DepartmentId','$Quantity','$Amount','$ToatalCost',CURDATE(),'$EpisodeId ','$UserId','$Type')";
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
