<?php
/*This script will load a list of all employees in a department*/
require_once '../../Config/db_conn.php';
global $conn;
//require_once '../../Include/PHPFunctions.php';
//$EmployeeId = htmlentities($_REQUEST['employeeId']);
$EmployeeName = htmlentities($_REQUEST['employeeNameHint']);

/*Get employee department id.*/
$SqlStatement = "Select * From StockTable";

$SqlStatement = '';
if (!empty($EmployeeName)) {
	/*Get employee is the department.*/
	$SqlStatement = "SELECT * FROM StockTable WHERE StockName Like '$EmployeeName%'  And PriceApprovalStatus=1 Order By StockName Asc";
} else {
	/*Get employee is the department.*/
	$SqlStatement =  "SELECT * FROM StockTable Where PriceApprovalStatus=1 ";
}
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
					<td width="94%" class="formtop"> Items </td>
					<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closecontainer()" style="cursor:hand" /></td>
		</tr>
	</table>
	</td>
	</tr>



	<tr>
		<td >&nbsp;</td>
		<td >Stock Name</td>
		<td >Description</td>
		<td >Stock Price</td>
	</tr>
	<?php
	$GetRowsInExecSqlStatement = mysqli_num_rows($ExecSqlStatement);
	if ($ExecSqlStatement > 0) {
		/*Get the lincese details*/
		while ($Row = mysqli_fetch_array($ExecSqlStatement)) {
	?>
			<tr>
				<td><input class="form-control" type="checkbox" id="employee<?php echo htmlentities($Row['Id']); ?>" value="<?php echo htmlentities($Row['Id']); ?>" name="employeesInDepartment" onchange="GetItemDetailsOnSelecting()"></td>
				<td><?php echo htmlentities($Row['StockName']); ?></td>
				<td><?php echo htmlentities($Row['specs']); ?></td>
				<td><?php echo htmlentities($Row['StockPrice']); ?></td>
			</tr>
		<?php
		}
	} else {
		?>
		<tr>
			<td colspan="4" valign="top" align="center">There are no items to display</td>
		</tr>
	<?php
	}
	?>
	</table>
<?php
}
?>