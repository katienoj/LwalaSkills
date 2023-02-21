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
<table width="100%" border="0">

	<?php
	//echo "SELECT * FROM InternalStockRequests WHERE HODApproved='1' AND  RequestFromDepartment='$UserDepartment' ORDER BY Id DESC";

	$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests  ORDER BY Id DESC") or die(mysqli_error($conn));

	if (mysqli_num_rows($sql) == 0) {
	?>
		<tr>
			<td  colspan="5" align="center">Sorry,Lwala is not aware of any made Stock Requests to this department so far</td>
		</tr>

	<?php
	} else {
	?>
</table>

<table width="100%" border="0" id="service_table">

	<thead>
		<tr>
			<th ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th >Requesting Department</th>
			<th >Department Requested</th>
			<th >Date made </th>
			<th >Date Expected </th>
			<th >Stock Items </th>
			<th >Request Initiator </th>
			<th >H.O.D Approval </th>
			<th >Serviced </th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th >Requesting Department</th>
			<th >Department Requested</th>
			<th >Date made </th>
			<th >Date Expected </th>
			<th >Stock Items </th>
			<th >Request Initiator </th>
			<th >H.O.D Approval </th>
			<th >Serviced </th>
		</tr>
	</tfoot>
	<tbody style="width:100%;max-height:720px;height:720px; overflow-x:hidden;overflow-y:auto;">
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
				<td ><input class="form-control" type="checkbox" name="RequestId" id="RequestId" value="<?php echo $Id; ?>"><?php echo $Id; ?></td>
				<td ><?php echo DepartmentName($DepartmentId); ?></td>
				<td ><?php echo DepartmentName($RequestFromDepartment); ?></td>
				<td ><?php echo dteconvert($DateOfRequest); ?></td>
				<td ><?php echo dteconvert($DateExpected); ?></td>
				<td ><a href="#" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" style="text-decoration:none;">Requested Stock</a></td>
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