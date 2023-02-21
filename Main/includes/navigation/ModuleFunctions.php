<?php
session_start();
include "../../Config/db_conn.php";
global $conn;

if (isset($_SESSION["cArEFUT2010soFT"])) {

	$UserId = $_SESSION['UserId'];
	$EmployeeId = (int)$_SESSION['EmployeeId'];
	$UserNames = $_SESSION['UserName'];
	$new_session = session_id();
	if ($UserId == '') {
		$UserId = ResolveUserId(number_format($EmployeeId));
	}
	$strSQL = "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'";
	//echo $strSQL."<BR>";
	$sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
	$result = mysqli_fetch_assoc($sql);
	$SessionId = $result['Session_Id'];
	//echo "Already created".$SessionId."<br>The Session".$new_session;
	if ($SessionId != $new_session or $SessionId == '') {
		echo "reload";
	}/**/ else {

		$ModuleId = $_REQUEST['ModuleId'];


		$GroupId = GetGroup($UserId);
		//echo "Group ".$GroupId." Module ".$ModuleId."<br>";
?>

		<Table border="0" width="100%">
			<tr>
				<?php

				$parent_perms = PrevPermSubModule($GroupId, $ModuleId);
				//echo $parent_perms;
				switch ($parent_perms) {
					case "0":
						$SqlFunction = "SELECT * from ModuleFunctions WHERE parentmodule='$ModuleId' AND permission='0' ORDER BY DispOrder ASC";
						break;
					case "1":
						$SqlFunction = "SELECT * from ModuleFunctions WHERE parentmodule='$ModuleId' AND (permission='1' OR permission='0') ORDER BY DispOrder ASC";
						break;
					case "2":
						$SqlFunction = "SELECT * from ModuleFunctions WHERE parentmodule='$ModuleId' AND (permission='2' OR permission='1' OR permission='0' OR permission='3') ORDER BY DispOrder ASC";
						break;
				}
				//echo $SqlFunction;
				$sql = mysqli_query($conn, $SqlFunction) or die(mysqli_error($conn));
				//echo mysqli_num_rows($sql);
				if (mysqli_num_rows($sql) > 0) {
					while ($recs = mysqli_fetch_array($sql)) {
						$ModuleId = $recs['ModuleId'];
						$ModuleName = $recs['ModuleName'];
						$JsFunction = $recs['JsFunction'];
						$ModuleImage = $recs['ModuleImage'];

				?>
						<td>
							<table border="0">
								<tr>
									<td height="26"><img src="../Main/Layout/images/ModuleImages/<?php echo $ModuleImage; ?>" onClick="<?php echo $JsFunction; ?>()" style="cursor:hand;" width="25" height="25" /></a></td>
									<td><a href="javascript:void(0)" onClick="<?php echo $JsFunction; ?>()" style="text-decoration: none; color:#666666;"><?php echo $ModuleName; ?></a></td>
								</tr>
							</table>
						</td>
				<?php
					}
				}
				?>
				</ul>
				</div>
		<?php
	}
} else {
	echo "Reload";
}

		?>