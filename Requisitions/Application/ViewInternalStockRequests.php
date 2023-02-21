<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
$UserNames = $_SESSION['UserName'];
$new_session = session_id();
if ($UserId == '') {
	$UserId = ResolveUserId(number_format($EmployeeId));
}
$UserDepartment = GetUserDepartment($UserId);
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">CWH REQUISITIONS</td>
	</tr>
</table>
<table width="100%" border="0">

	<?php
	if (1 > 0) {
		$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests ORDER BY Id DESC LIMIT 50") or die(mysqli_error($conn));
	} else {
		$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests ORDER BY Id DESC LIMIT 50") or die(mysqli_error($conn));
	}

	if (mysqli_num_rows($sql) == 0) {
	?>
		<tr>
			<td  colspan="5" align="center">No Results Displayed</td>
		</tr>

	<?php
	} else {
	?>
</table>

<table width="100%" border="0" id="interanal_request">

	<thead>
		<tr>
			<th ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th >Date made </th>
			<th >Date Expected </th>
			<th >Stock Items </th>
			<th >Request Initiator </th>
			<th >CHA Approved </th>
			<th >Serviced </th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th >Date made </th>
			<th >Date Expected </th>
			<th >Stock Items </th>
			<th >Request Initiator </th>
			<th >CHA Approved </th>
			<th >Serviced </th>
		</tr>
	</tfoot>
	<tbody>
		<?php
		$count = 0;
		while ($recs = mysqli_fetch_array($sql)) {
			$Id = $recs['Id'];
			$DepartmentId = $recs['DepartmentId'];
			$RequestFromDepartment = $recs['RequestFromDepartment'];
			$DateOfRequest = $recs['DateofRequest'];
			$DateExpected = $recs['DateExpected'];
			$StockDetails = $recs['StockDetails'];
			$HODApproved = $recs['HODApproved'];
			$HODApprover = $recs['HODApprover'];
			$PROCApproved = $recs['PROCApproved'];
			$PROCApprover = $recs['PROCApprover'];
			$CEOApproved = $recs['CEOApproved'];
			$CEOApprover = $recs['CEOApprover'];
			$Total = $recs['RequestTotal'];
			$ServiceStatus = $recs['ServiceStatus'];
			$ServicedBy = $recs['ServicedBy'];
			$RequestInitiator = $recs['RequestInitiator'];

			if ($Total == '0.00') {
				$Total = RequestTotal($StockDetails);
			}
			if ($HODApproved == 1) {
				$ApprovedByHOD = "Yes<br> By " . ResolveEmployeeName($HODApprover);
			} else {
				$ApprovedByHOD = "No";
			}
			if ($PROCApproved == 1) {
				$ApprovedByPROC = "Yes<br> By " . ResolveEmployeeName($PROCApprover);
			} else {
				$ApprovedByPROC = "No";
			}
			if ($CEOApproved == 1) {
				$ApprovedByCEO = "Yes<br> By " . ResolveEmployeeName($CEOApprover);
			} else {
				$ApprovedByCEO = "No";
			}
			if ($ServiceStatus == 1) {
				$Serviced = "Yes<br>By " . ResolveEmployeeName($ServicedBy);
			} else {
				$Serviced = "No";
			}




			if ($count % 2 == 0) {
				$bg = '#E1E1FF';
			} else {
				$bg = '#EAEAEA';
			}
		?>
			<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'" valign="top">
				<td ><input class="form-control" type="checkbox" name="RequestId" id="RequestId" value="<?php echo $Id; ?>"></td>
				<td ><?php echo dteconvert($DateOfRequest); ?></td>
				<td ><?php echo dteconvert($DateExpected); ?></td>
				<td ><input class="btn btn-success btn-block" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" value="Requested Stock"></td>
				<td ><?php echo ResolveEmployeeName($RequestInitiator); ?></td>
				<td ><?php echo $ApprovedByHOD; ?></td>
				<input class="form-control" type="hidden" name="StockDetails<?php echo $Id; ?>" id="StockDetails<?php echo $Id; ?>" value="<?php echo $StockDetails; ?>" />
				<td ><?php echo $Serviced; ?></td>
			</tr>
		<?php
			$count++;
		}
		?>
	</tbody>
<?php
	}
?>

</table>