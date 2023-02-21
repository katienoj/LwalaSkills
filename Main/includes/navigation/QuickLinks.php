<?php
session_start();
include "../../Config/db_conn.php";
global $conn;
$UserId = $_SESSION['UserId'];
$ModuleId = $_REQUEST['ModuleId'];

$GroupId = GetGroup($UserId);
?>
<link href="../../Layout/styles/interface.css" rel="stylesheet" type="text/css" />


<Table border="0" width="100%">
	<tr>
		<td class="SearchTop">
			<div align="center">Quick Links</div>
		</td>
	</tr>
	<?php

	$parent_perms = PrevPermSubModule($GroupId, $ModuleId);
	//echo $parent_perms;
	switch ($parent_perms) {
		case "0":
			$SqlFunction = "SELECT * from QuickLinks WHERE parentmodule='$ModuleId' AND permission='0' ORDER BY DispOrder ASC";
			break;
		case "1":
			$SqlFunction = "SELECT * from QuickLinks WHERE parentmodule='$ModuleId' AND (permission='1' OR permission='0') ORDER BY DispOrder ASC";
			break;
		case "2":
			$SqlFunction = "SELECT * from QuickLinks WHERE parentmodule='$ModuleId' AND (permission='2' OR permission='1' OR permission='0' OR permission='3') ORDER BY DispOrder ASC";
			break;
	}
	//echo $SqlFunction;
	$sql = mysqli_query($conn, $SqlFunction) or die(mysqli_error($conn));
	//echo mysqli_num_rows($sql);
	if (mysqli_num_rows($sql) > 0) {
		while ($recs = mysqli_fetch_array($sql)) {
			$ModuleId = $recs['LinkId'];
			$LinkName = $recs['LinkName'];
			$LinkFunction = $recs['LinkFunction'];
			$ModuleImage = $recs['ModuleImage'];

	?>
			<tr>
				<td><a href="javascript:void(0)" onclick="<?php echo $LinkFunction; ?>" style="text-decoration: none; color:#666666;"><?php echo $LinkName; ?></a></td>
			</tr>
	<?php  }
	}
	?>
</Table>