<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">APPROVED REQUEST LOGS</td>
	</tr>
</table>
<table width="100%" border="0">

	<?php
	$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests WHERE HODApproved = 1 ORDER BY DateOfRequest DESC") or die(mysqli_error($conn));

	if (mysqli_num_rows($sql) == 0) {
	?>
		<tr>
			<td  colspan="6" align="center">No Results to display</td>
		</tr>

	<?php
	} else {
	?>
</table>
<table width="100%" border="0" id="service_table">

	<thead>
		<tr>
			<th><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th>Date made </th>
			<th>Date Expected </th>
			<th>Stock Items </th>
			<th>CHA Approval </th>
			<th>Processed </th>

		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th>Date made </th>
			<th>Date Expected </th>
			<th>Stock Items </th>
			<th>CHA Approval </th>
			<th>Processed </th>

		</tr>
	</tfoot>
	<tbody>
		<?php
		$count = 0;
		while ($recs = mysqli_fetch_array($sql)) {
			$Id = $recs['Id'];
			$DepartmentId = $recs['DepartmentId'];
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
			$ProcessedBy = $recs['ProcessedBy'];
			$DateOfProcessing = $recs['DateOfProcessing'];
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


			if ($count % 2 == 0) {
				$bg = '#E1E1FF';
			} else {
				$bg = '#EAEAEA';
			}
		?>
			<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
				<td ><input class="form-control" type="checkbox" name="RequestId" id="RequestId" value="<?php echo $Id; ?>"></td>
				<td ><?php echo dteconvert($DateOfRequest); ?></td>
				<td ><?php echo dteconvert($DateExpected); ?></td>
				<td ><input class="btn btn-success btn-block" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" value="Requested Stock"></td>
				<td ><?php echo $ApprovedByHOD; ?></td>
				<td >By <?php echo ResolveEmployeeName($ProcessedBy) . "<br> on " . dteconvert($DateOfProcessing); ?></td><input class="form-control" type="hidden" name="StockDetails<?php echo $Id; ?>" id="StockDetails<?php echo $Id; ?>" value="<?php echo $StockDetails; ?>" />
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