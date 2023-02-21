<?php
include "../../Config/db_conn.php";
global $conn;

$PatId = $_REQUEST['PatId'];
?>
<?php

$EpisodeId = mysqli_query($conn, "SELECT max(Id) FROM PatientEpisodes WHERE PatientId='$PatId' ");
$EpisodeId = mysqli_fetch_array($EpisodeId, MYSQLI_BOTH);
$EpisodeId = $EpisodeId[0];
if ($EpisodeId[0] == Null) {
	$EpisodeId = 0;

	echo '2';
} else {
	$sql = mysqli_query($conn,"SELECT * FROM PatientEpisodes WHERE PatientId='$PatId' And Id='$EpisodeId' And DateEnded is Null") or die(mysqli_error($conn));
	if (mysqli_num_rows($sql) == 0) {
		echo '0';
	} else {
		echo '1';
	}
}
?>
