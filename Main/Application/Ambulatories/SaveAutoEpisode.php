<?php
//Script Author: John Katieno
//This script will be used to end a patient Episode

include "../../Config/db_conn.php";
//Request the patient to start new Episode from the client side function that called this script
global $conn;
$PatId = $_REQUEST['selectedPatient'];
//Request for the date to start new episode
//Check if the last episode was ended or if the selected date is clashing with the last episode

$DateStopped = '';
$EpisodeNumber = '';
$sqlPrevEpisodes = mysqli_query($conn, "SELECT * FROM PatientEpisodes WHERE PatientId='$PatId'") or die(mysqli_error($conn));

while ($recs = mysqli_fetch_array($sqlPrevEpisodes)) {
   $EpisodeNumber = $recs['EpisodeNumber'];
}
//If the last episode was edned successfully,create a new episode
$NewEpisode = $EpisodeNumber + 1;
$sqlNewEpisode = mysqli_query($conn, "INSERT INTO PatientEpisodes(PatientId,DateStarted,EpisodeNumber) VALUES('$PatId',CURDATE(),'$NewEpisode')") or die(mysqli_error($conn));
if ($sqlNewEpisode == 1) {
   //Update the Patient records on the new episode number
   $strUpdatePatient = "UPDATE Patients SET CurrentEpisode='$NewEpisode' WHERE Id='$PatId'";
   $sqlUpdatePatient = mysqli_query($conn, $strUpdatePatient) or die(mysqli_error($conn));
   //Alert the user if the new episode was created successfully
   echo "New Episode was created successfully";
}
