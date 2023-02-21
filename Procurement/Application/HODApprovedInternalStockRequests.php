<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">

	<?
$sql=mysqli_query($conn, "SELECT * FROM InternalStockRequests WHERE HODApproved='1' AND Processed is Null  ORDER BY DateOfRequest DESC") or die(mysqli_error($conn));

if(mysqli_num_rows($sql)==0)
{
?>
	<tr>
		<td  colspan="6" align="center">Sorry, Lwala is not aware of any made but unapproved internal requests so far</td>
	</tr>

	<?
}
else
{
?>
	<thead>
		<tr>
			<td width="4%" class="heading"><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></td>
			<td width="5%" class="heading">Department</td>
			<td width="6%" class="heading">IRQ ID </td>
			<td width="10%" class="heading">Date made </td>
			<td width="13%" class="heading">Date Expected </td>
			<td width="13%" class="heading">Stock Items </td>
			<td width="13%" class="heading">H.O.D Approval </td>

		</tr>
	</thead>
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
			<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'" valign="top">
				<td ><input class="form-control" type="checkbox" name="RequestId" id="RequestId" value="<?php echo $Id; ?>"></td>
				<td ><?php echo DepartmentName($DepartmentId); ?></td>
				<td ><?php echo $Id; ?></td>
				<td ><?php echo dteconvert($DateOfRequest); ?></td>
				<td ><?php echo dteconvert($DateExpected); ?></td>
				<td ><a href="#" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" style="text-decoration:none;">Requested Stock</a></td>

				<td >By <?php echo ResolveEmployeeName($HODApprover); ?>
					<input class="form-control" type="hidden" name="StockDetails<?php echo $Id; ?>" id="StockDetails<?php echo $Id; ?>" value="<?php echo $StockDetails; ?>" />
				</td>
			</tr>
			<?
  $count++;
  }
  ?>
	</tbody>
<?php
		}
?>
</table>