<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">

	<?php
	$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests ORDER BY DateOfRequest DESC") or die(mysqli_error($conn));

	if (mysqli_num_rows($sql) == 0) {
	?>
		<tr>
			<td  colspan="6" align="center">Sorry,Lwala is not aware of any made but unapproved internal requests so far</td>
		</tr>

	<?php
	} else {
	?>
</table>
<table width="100%" border="0" id="service_table">

	<thead>
		<tr>
			<th width="4%" ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th width="5%" >Department</th>
			<th width="6%" >IRQ ID </th>
			<th width="10%" >Date made </th>
			<th width="13%" >Date Expected </th>
			<th width="13%" >Stock Items </th>
			<th width="13%" >H.O.D Approval </th>
			<th width="11%" >Processed </th>

		</tr>
	</thead>
	<tfoot>
		<tr>
			<th width="4%" ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></th>
			<th width="5%" >Department</th>
			<th width="6%" >IRQ ID </th>
			<th width="10%" >Date made </th>
			<th width="13%" >Date Expected </th>
			<th width="13%" >Stock Items </th>
			<th width="13%" >H.O.D Approval </th>
			<th width="11%" >Processed </th>

		</tr>
	</tfoot>
	<tbody style="width:100%;max-height:720px;height:720px; overflow-x:hidden;overflow-y:auto;">
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
				<td ><?php echo DepartmentName($DepartmentId); ?></td>
				<td ><?php echo $Id; ?></td>
				<td ><?php echo dteconvert($DateOfRequest); ?></td>
				<td ><?php echo dteconvert($DateExpected); ?></td>
				<td ><a href="#" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" style="text-decoration:none;">Requested Stock</a></td>
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