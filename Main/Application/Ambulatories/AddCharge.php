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
    $DepartmentId = htmlentities($_REQUEST['Department']);
    //$StartTime = htmlentities($_REQUEST['StartTime']);
   // $EndTime = htmlentities($_REQUEST['EndTime']);
    //$DepartmentId =5;
$GetCost=mysqli_query($conn, "SELECT * FROM StockTable WHERE StockName='$Procedure'");
while ($rows=mysqli_fetch_array($GetCost)) {
    $Cost = $rows['StockPrice'];
    $Amount=$Cost;
    $ProcedureId=$rows['Id'];
}
$GetUserId=mysqli_query($conn, "SELECT * FROM EmployeeTable WHERE EmployeeName='$Staff'");
while ($rows=mysqli_fetch_array($GetUserId)) {
    $UserId = $rows['Id'];
}
    /*
    $originalstr = $EndTime;
    $pieces = explode(" ",$originalstr);
    $date=$pieces[0];
    $time=$pieces[1]." ".$pieces[2];
    $datepieces = explode("-", $date);
    $date = date("Y-m-d",strtotime($datepieces[0]." ".$datepieces[1]." ".$datepieces[2]));
    $date=date("d-m-yy");*/
    $ToatalCost=$Amount*$Quantity;
    $Type='Item';
    //sql insert statement to insert charge details to database
/*
        $InsertCharge ="INSERT INTO PatientProcedureChargeSheet (PatientId,ProcedureId,Quantity,DepartmentId,UnitCost,Amount,Date,EpisodeNo,UserId) VALUES('$PatientId','$ProcedureId','$Quantity','$DepartmentId','$Amount','$ToatalCost',CURDATE(),'$EpisodeId ','$UserId')";*/
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
