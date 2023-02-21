<?php
//this is a script for allowing user to refer a patient from dental clinic. 
@include '../../Config/db_conn.php';
require_once '../../AuditTrail/Include/AuditTrailFunc.php';
//@include 'Include/AuditTrailFunc.php';
//include 'Include/AuditTrailFunc.php';
global $conn;
$WaitingRoom = htmlentities($_REQUEST['WaitingRoom']);
$Notes = htmlentities($_REQUEST['Notes']);
$PatientId = htmlentities($_REQUEST['PatientId']);
$EpisodeId = htmlentities($_REQUEST['EpisodeId']);
$ScheduleId = htmlentities($_REQUEST['ScheduleId']);

$GetRoomId=mysqli_query($conn, "SELECT * FROM WaitingRoom WHERE RoomName='$WaitingRoom'");
while($rows=mysqli_fetch_array($GetRoomId))
{
$RoomId=$rows['Id'];

}

$ReferDentalpatient ="UPDATE DentalPatients SET Status = 1 Where ScheduleId= '$ScheduleId' ";
	
		$ExecReferDentalpatient= mysqli_query($conn, $ReferDentalpatient)or die(mysqli_error($conn));
		if(!$ExecReferDentalpatient)
		{
			echo("Problems occured while executing the referal");
		}
		else
		{
		
		
		   $InsertStatement="INSERT INTO PatientReferals (EpisodeId,PatientId,FromWaitingRoomId,ToWaitingRoomId,ReferalNotes) VALUES ('$EpisodeId','$PatientId',3,'$RoomId','$Notes')";	
$ExecInsertStatement= mysqli_query($conn, $InsertStatement)or die(mysqli_error($conn));
		if(!$ExecInsertStatement)
		{
			echo("Problems occured while executing the referal");
		}
		else
			{
			
				$SessionId = session_id();
				
				AuditTransaction($SessionId,$InsertStatement);
				echo "Patient has been refered to"." ".$WaitingRoom;
			}

	
		
			
		}
