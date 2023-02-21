<?php
//this is a script for allowing user to refer a patient from dental clinic. 
@include '../../Config/db_conn.php';
require_once '../../../AuditTrail/Include/AuditTrailFunc.php';

session_start();
global $conn;
	$UserId=$_SESSION['UserId'];
	$EmployeeId=$_SESSION['EmployeeId'];
	$UserNames=$_SESSION['UserName'];
	$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$SessionId=$result['Session_Id'];




//@include 'Include/AuditTrailFunc.php';
//include 'Include/AuditTrailFunc.php';

$WaitingRoom = htmlentities($_REQUEST['WaitingRoom']);
$Notes = htmlentities($_REQUEST['Notes']);
$PatientId = htmlentities($_REQUEST['PatientId']);
$EpisodeId = htmlentities($_REQUEST['EpisodeId']);
$ScheduleId = htmlentities($_REQUEST['ScheduleId']);

$GetRoomId=mysqli_query($conn, "SELECT * FROM WaitingRoom WHERE RoomName='$WaitingRoom'");
while($rows=mysqli_fetch_array($GetRoomId))
{
$RoomId=$rows['Id'];
$DepartmentId=$rows['DepartmentId'];
}

if($DepartmentId==0)
{
    $DepartmentName="";

}
else
{
  	$GetDepartmentName=mysqli_query($conn, "SELECT * FROM DepartmentTable WHERE DepartmentId='$DepartmentId'");
	while($rows=mysqli_fetch_array($GetDepartmentName))
	{
	$DepartmentName=$rows['DepartmentName'];
	}


}


$GetFromRoomId=mysqli_query($conn, "SELECT * FROM AppointmentSchedule WHERE Id='$ScheduleId'");
while($rows=mysqli_fetch_array($GetFromRoomId))
{
$FromRoomId=$rows['RoomId'];
$FromClinicId=$rows['ClinicId'];

}
$GetClinic=mysqli_query($conn, "SELECT * FROM Clinic WHERE Id='$FromClinicId'");
while($rows=mysqli_fetch_array($GetClinic))
{
$FromClinic=$rows['ClinicName'];

}

$ReferDentalpatient ="UPDATE AppointmentSchedule SET Status = 1 Where Id= '$ScheduleId' ";
	
		$ExecReferDentalpatient= mysqli_query($conn, $ReferDentalpatient)or die(mysqli_error($conn));
		if(!$ExecReferDentalpatient)
		{
			echo("Problems occured while executing the referal");
		}
		else
		{
		
		
		   $InsertStatement="INSERT INTO PatientReferals (EpisodeId,PatientId,FromWaitingRoomId,ToDepartmentId,ReferalNotes,ReferedBy) VALUES ('$EpisodeId','$PatientId','$FromRoomId','$DepartmentId','$Notes','$EmployeeId')";	
$ExecInsertStatement= mysqli_query($conn, $InsertStatement)or die(mysqli_error($conn));
		if(!$ExecInsertStatement)
		{
			echo("Problems occured while executing the referal");
		}
		else
			{
			
				$SessionId = session_id();
				
				AuditTransaction($SessionId,$InsertStatement);
				echo "Patient has been refered From" ." ".$FromClinic."to"." ".$DepartmentName;
			}
			if($FromClinic=='Dental')
			{
			echo ':1';
			}
			
			else if($FromClinic=='CCC')
			{
			echo ':2';
			}
			else if($FromClinic=='Health Screening')
			{
			echo ':3';
			}
			else if($FromClinic=='Nutrition')
			{
			echo ':4';
			}
			else if($FromClinic=='Nairobi Heart Clinic')
			{
			echo ':5';
			}
			else
			{
			echo ':6';
			}

	
		
			
		}
