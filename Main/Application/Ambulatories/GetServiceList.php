<?php
/*This script will load a list of all employees in a department*/
require_once '../../Config/db_conn.php';


session_start();
$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
$UserNames = $_SESSION['UserName'];
$sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result = mysqli_fetch_assoc($sql);
$SessionId = $result['Session_Id'];


//require_once '../../Include/PHPFunctions.php';
//$EmployeeId = htmlentities($_REQUEST['employeeId']);
$ServiceNameHint = htmlentities($_REQUEST['ServiceNameHint']);
$Department = htmlentities($_REQUEST['Department']);


//$SqlStatement = '';
/*Get procedure in department.*/
$SqlStatement = "SELECT * FROM HospitalServices WHERE Department ='$Department' And ApprovalStatus=1";
$ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute query" . mysqli_error($conn));
/*Chack if the query excuted succesefuly*/
if (!$ExecSqlStatement) {
	echo '0';
} else {
	/*If the query excuted seccesefull check if the result set has records.*/
?>
	<table width="100%">

		<tr>
			<td colspan="8">
				<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
					<td width="94%" class="formtop"> Services in <?php echo DepartmentName($Department); ?></td>
					<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closecontainer()" style="cursor:hand" /></td>
		</tr>
	</table>
	</td>
	</tr>




	<tr>
		<td >&nbsp;</td>
		<td >Service</td>
		<td >Description</td>
		<td >Cost</td>
	</tr>
	<?php
	$GetRowsInExecSqlStatement = mysqli_num_rows($ExecSqlStatement);
	if ($ExecSqlStatement > 0) {
		/*Get the procedure details*/
		while ($Row = mysqli_fetch_array($ExecSqlStatement)) {
	?>
			<tr>
				<td><input class="form-control" type="checkbox" id="Service<?php echo htmlentities($Row['ServiceId']); ?>" value="<?php echo htmlentities($Row['ServiceId']); ?>" name="servicesInDepartment" onchange="GetServiceDetailsOnSelecting()"></td>
				<td><?php echo htmlentities($Row['ServiceName']); ?></td>
				<td><?php echo htmlentities($Row['Comments']); ?></td>
				<td><?php echo htmlentities($Row['Amount']); ?></td>
			</tr>
		<?php
		}
	} else {
		?>
		<tr>
			<td colspan="4" valign="top" align="center">There are no services defined for this department</td>
		</tr>
	<?php
	}
	?>
	</table>
<?php
}
?>