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
	$DoctorRelated =1;
	$DoctorToPay = htmlentities($_REQUEST['DoctorId']);
	$Currency=htmlentities($_REQUEST['Currency']);
	//$DoctorRelated = htmlentities($_REQUEST['DoctorRelated']);
	
	


	$Amount= htmlentities($_REQUEST['Amount']);
	$Type='Service';
	
	
	$original_date = htmlentities($_REQUEST['ReceivedDate']);
    $pieces = explode(" ", $original_date);
    $new_date = date("Y-m-d",strtotime($pieces[0]." ".$pieces[1]." ".$pieces[2]));
    $InvoiceDate= $new_date ;

	
	$GetUserId=mysqli_query($conn, "SELECT * FROM EmployeeTable WHERE EmployeeName='$Staff'");
	while($rows=mysqli_fetch_array($GetUserId))
	{
	$UserId = $rows['Id'];
	}


$ToatalCost=$Amount;
	
    

 $InsertCharge ="INSERT INTO PatientChargeSheet (PatientId,DepartmentId,Amount,Date,EpisodeNo,UserId,Type,DoctorRelated,DoctorToPay) VALUES('$PatientId','$DepartmentId','$ToatalCost','$InvoiceDate','$EpisodeId ','$UserId','$Type','$DoctorRelated','$DoctorToPay')";
$ExecInsertCharge= mysqli_query($conn, $InsertCharge)or die(mysqli_error($conn));
		$Id=mysqli_insert_id($conn);
	if(!$ExecInsertCharge)
		{
		//notify user if Charge could not be created
		echo("Problems Occured while writing to database. Charge was not saved");
		}
		else
		{
	$InsertInvoice = "Insert Into DoctorPaymentInvoices (ChargeId,DoctorId,InvoiceAmount,Currency,DateGenerated,TimeGenerated,InvoiceDate) Values('$Id','$DoctorToPay','$ToatalCost','$Currency',CURDATE(),NOW(),'$InvoiceDate')";
$Exec = mysqli_query($conn, $InsertInvoice) or die(mysqli_error($conn));
	//	$Id=mysqli_insert_id($conn);

		
		//notify user on successful charge creation
		$SessionId = session_id();
			//AuditTransaction($SessionId,$InsertCharge);
		echo "Invoice Successfully saved";
		}
