<?php 
//Script Author:Kirathe Dickson
//This script will be used to add a new patient to the system

include "../../Main/Config/db_conn.php";
require_once '../../AuditTrail/Include/AuditTrailFunc.php';
    //Start a new session 
    session_start();
	$SessionId = session_id();
	global $conn;
	//Grab the new patient's details
    $UserId=$_SESSION['UserId'];
	$LastName=htmlentities($_REQUEST['LastName'],ENT_QUOTES);
	$FirstName=htmlentities($_REQUEST['FirstName'],ENT_QUOTES);
	$MiddleName=htmlentities($_REQUEST['MiddleName'],ENT_QUOTES);
	$IDNumber=htmlentities($_REQUEST['IDNumber'],ENT_QUOTES);
	$PassPortNumber=htmlentities($_REQUEST['PassPortNumber'],ENT_QUOTES);
	$DateOfBirth=htmlentities(convert_date($_REQUEST['DateOfBirth']),ENT_QUOTES);
	$sex=htmlentities($_REQUEST['sex'],ENT_QUOTES);
	$Nationality=htmlentities($_REQUEST['Nationality'],ENT_QUOTES);
	$Religion=htmlentities($_REQUEST['Religion'],ENT_QUOTES);
	$PhyAddress=htmlentities($_REQUEST['PhyAddress'],ENT_QUOTES);
	$MobileNo="+".htmlentities($_REQUEST['MobileNo'],ENT_QUOTES);
	$Email=htmlentities($_REQUEST['Email'],ENT_QUOTES);
	$Barcode=htmlentities($_REQUEST['Barcode'],ENT_QUOTES);
	$NHIFNo=htmlentities($_REQUEST['NHIFNo'],ENT_QUOTES);
	$MaritalStatus=htmlentities($_REQUEST['MaritalStatus'],ENT_QUOTES);
	$NextOfKin=htmlentities($_REQUEST['NextOfKin'],ENT_QUOTES);
	$NextOfKinPhone="+".htmlentities($_REQUEST['NextOfKinPhone'],ENT_QUOTES);
	$NextOfKinEmail=htmlentities($_REQUEST['NextOfKinEmail'],ENT_QUOTES);
	$NextOfKinRelationship=htmlentities($_REQUEST['NextOfKinRelationship'],ENT_QUOTES);
	$NextOfKinAddress=htmlentities($_REQUEST['NextOfKinAddress'],ENT_QUOTES);
	$Estate=htmlentities($_REQUEST['Estate'],ENT_QUOTES);
	$HouseNumber=htmlentities($_REQUEST['HouseNumber'],ENT_QUOTES);
	$PostalAddress=htmlentities($_REQUEST['PostalAddress'],ENT_QUOTES);
	$asthma=htmlentities($_REQUEST['asthma'],ENT_QUOTES);
	$hypertension=htmlentities($_REQUEST['hypertension'],ENT_QUOTES);
	$cardiacArrest=htmlentities($_REQUEST['cardiacArrest'],ENT_QUOTES);
	$diabetes=htmlentities($_REQUEST['diabetes'],ENT_QUOTES);
	$BreastCancer=htmlentities($_REQUEST['BreastCancer'],ENT_QUOTES);
	$OtherChronic=htmlentities($_REQUEST['OtherChronic'],ENT_QUOTES);
	$PhoneNo="+".htmlentities($_REQUEST['PhoneNo'],ENT_QUOTES);
	$EmployerDetails=htmlentities($_REQUEST['EmployerDetails'],ENT_QUOTES);
	$PassPortPhoto=htmlentities($_REQUEST['patient_passport'],ENT_QUOTES);
	$PatientType=htmlentities($_REQUEST['PatientType'],ENT_QUOTES);
	$dte=date('Y-m-d',time());
	//Confirm that a patient with similar details does not exist in the system
	$sqlCheckFirst=mysqli_query($conn, "SELECT * FROM Patients WHERE (LastName='$LastName' AND FirstName='$FirstName' AND MiddleName='$MiddleName') OR IDNo='$IDNumber'") or die(mysqli_error($conn));
	if(mysqli_num_rows($sqlCheckFirst)>0)
	{
	$res=mysqli_fetch_assoc($sqlCheckFirst);
	$PatNo=$res['Id'];
	echo "A patient with similar details exists in the system with patient number ".$PatNo;
	}
	else
	{
	//If there is no patient who exists with similar details in the system,insert the new patient into the database
	$strNewPatientSQL="INSERT INTO Patients(LastName,FirstName,MiddleName,IDNo,PassportNo,DateOfBirth,Gender,Nationality,Religion,PhysicalAddress,MobileNo,PhoneNo,Email,Estate,HouseNumber,PostalAddress,Barcode,MaritalStatus,NextOfKin,NextOfKinPhone,NextOfKinAddress,NextOfKinEmail,NextOfKinRelationship,EmployerDetails,NHIFNo,asthma,HyperTension,cardiacArrest,diabetes,BreastCancer,Others,DateRegistered,PatientPassPort,UserId,PatientType) VALUES('$LastName','$FirstName','$MiddleName','$IDNumber','$PassPortNumber','$DateOfBirth','$sex','$Nationality','$Religion','$PhyAddress','$MobileNo','$PhoneNo','$Email','$Estate','$HouseNumber','$PostalAddress','$Barcode','$MaritalStatus','$NextOfKin','$NextOfKinPhone','$NextOfKinAddress','$NextOfKinEmail','$NextOfKinRelationship','$EmployerDetails','$NHIFNo','$asthma','$hypertension','$cardiacArrest','$diabetes','$BreastCancer','$OtherChronic','$dte','$PassPortPhoto','$UserId','$PatientType')";
	
	$sqlInsertPatient=mysqli_query($conn, $strNewPatientSQL) or die(mysqli_error($conn));
	if($sqlInsertPatient==1)
	{
	$NewPatientId=mysqli_insert_id($conn);
	AuditTransaction($SessionId,$strNewPatientSQL);
	//Create the first episode for this patient,since its a new patient
	
	$strNewEpisodeSQL="INSERT INTO PatientEpisodes(PatientId,DateStarted,EpisodeNumber) VALUES('$NewPatientId','$dte','1')";
    $sqlNewEpisode=mysqli_query($conn, $strNewEpisodeSQL)or die(mysqli_error($conn));
	$NewEpisode=mysqli_insert_id($conn);
	AuditTransaction($SessionId,$strNewEpisodeSQL);
	//Set a new barcode for the patient.This barcode should be the patient's new Id number
	
	$strUpdatePatient="UPDATE Patients SET Barcode='$NewPatientId',CurrentEpisode='1' WHERE Id='$NewPatientId'";
	$sqlUpdatePatient=mysqli_query($conn, $strUpdatePatient) or die(mysqli_error($conn));
	AuditTransaction($SessionId,$strUpdatePatient);
	echo $NewPatientId;
	}
	else
	{
	echo "Unable to save patient";
	}
	}
