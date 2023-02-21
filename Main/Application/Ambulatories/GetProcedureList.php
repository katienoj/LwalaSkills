<?php
/*This script will load a list of all employees in a department*/
require_once '../../Config/db_conn.php';
session_start();
global $conn;
$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
$UserNames = $_SESSION['UserName'];
$sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result = mysqli_fetch_assoc($sql);
$SessionId = $result['Session_Id'];


//require_once '../../Include/PHPFunctions.php';
//$EmployeeId = htmlentities($_REQUEST['employeeId']);
$ProcedureNameHint = htmlentities($_REQUEST['ProcedureNameHint']);
$Department = htmlentities($_REQUEST['Department']);


$SqlStatement = '';
/*if(!empty($EmployeeName))
{
*/	/*Get procedure in department.*/
$SqlStatement = "SELECT * FROM Procedures WHERE DepartmentId='$Department' And PriceApprovalStatus=1";


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
					<td width="94%" class="formtop"> Procedures in <?php echo DepartmentName($Department) ?> </td>
					<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closecontainer()" style="cursor:hand" /></td>
		</tr>
	</table>
	</td>
	</tr>





	<tr>
		<td >&nbsp;</td>
		<td >Procedure Name</td>
		<td >Description</td>
		<td >Procedure Cost</td>
	</tr>
	<?php
	$GetRowsInExecSqlStatement = mysqli_num_rows($ExecSqlStatement);
	if ($ExecSqlStatement > 0) {
		/*Get the procedure details*/
		while ($Row = mysqli_fetch_array($ExecSqlStatement)) {
	?>
			<tr>
				<td><input class="form-control" type="checkbox" id="Procedure<?php echo htmlentities($Row['ProcedureId']); ?>" value="<?php echo htmlentities($Row['ProcedureId']); ?>" name="proceduresInDepartment" onchange="GetProcedureDetailsOnSelecting()"></td>
				<td><?php echo htmlentities($Row['ProcedureName']); ?></td>
				<td><?php echo htmlentities($Row['ProcedureDescription']); ?></td>
				<td><?php echo htmlentities($Row['Cost']); ?></td>
			</tr>
		<?php
		}
	} else {
		?>
		<tr>
			<td colspan="4" valign="top" align="center">There are no other procedures in this detpartment</td>
		</tr>
	<?php
	}
	?>
	</table>
<?php
}
?>