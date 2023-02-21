<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$SelectedStock = explode(':', $_REQUEST['SelectedStock']);
$UserId = $_REQUEST['UserId'];
$DeptId = GetUserDepartment($UserId);
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" id="selected_stock">
	<thead>
		<tr>
			<th >Stock Name </th>
			<th >Qty in the Store</th>
			<th >Qty in this Department</th>
			<th ></th>
			<th >Request Qty </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th >Stock Name </th>
			<th >Qty in the Store</th>
			<th >Qty in this Department</th>
			<th ></th>
			<th >Request Qty </th>
		</tr>
	</tfoot>
	<tbody style="width:100%; height:280px; max-height:280px; overflow-x:hidden; overflow:auto; ">
		<?php
		$count = 0;
		foreach ($SelectedStock as $StockItem) {
			if ($StockItem != '') {
				$sql = mysqli_query($conn, "SELECT * FROM StockTable WHERE Id='$StockItem'") or die(mysqli_error($conn));
				$result = mysqli_fetch_assoc($sql);

				if ($count % 2 == 0) {
					$bg = '#E1E1FF';
				} else {
					$bg = '#EAEAEA';
				}
		?>
				<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
					<input class="form-control" type="checkbox" name="SelectedStockId" id="SelectedStockId" value="<?php echo $StockItem; ?>" style="display:none;" />
					<td ><?php echo $result['StockName']; ?></td>
					<td ><?php 
					   echo $result['MaxStock'];
						//echo CheckQtyInStore($StockItem); 
						?>&nbsp; <?php

									$pack = $result['DefaultPackaging'];
									$sqlp = mysqli_query($conn, "SELECT * FROM SetupPackaging WHERE Id='$pack'") or die(mysqli_error($conn));
									$resultp = mysqli_fetch_assoc($sqlp);
									echo $resultp['PackageName'];
									//  echo $package;

									//echo ItemEndSalesUnit($StockItem); 
									?></td>
					<td ><?php echo CheckQtyInDept($StockItem, $DeptId); ?>&nbsp; <?php
									$pack = $result['DefaultPackaging'];

									$sqlp = mysqli_query($conn, "SELECT * FROM SetupPackaging WHERE Id='$pack'") or die(mysqli_error($conn));
									$resultp = mysqli_fetch_assoc($sqlp);
									echo $resultp['PackageName'];
									//	echo ItemEndSalesUnit($StockItem); 
									?></td>
					<td ><?php
									$packagelist = "<select hidden id='PackagingType$StockItem' name='PackagingType$StockItem' class='form-control'>";
									$packagelist .= "<option hidden value='' class='form-control'>--Please select--</option>";
									$sSqlWrk = "SELECT `Id`, `PackagingId` FROM `StockPackaging`  WHERE StockId='$StockItem' AND PackageTypeId='3' order by Id DESC ";
									$rswrk = mysqli_query($conn, $sSqlWrk) or die("Failed to execute query at line " . __LINE__ . ": " . mysqli_error($conn) . '<br>SQL:' . $sSqlWrk);
									if ($rswrk) {
										$rowcntwrk = 0;
										while ($datawrk = mysqli_fetch_array($rswrk)) {
											$packagelist .= "<option hidden class='form-control' value=\"" . htmlspecialchars($datawrk[0]) . "\"";
											if ($datawrk["PackagingId"] == @$x_country) {
												$packagelist .= " selected";
											}
											$packagelist .= ">" . PackageName($datawrk["PackagingId"]) . "</option>";
											$rowcntwrk++;
										}
									}
									@mysqli_free_result($rswrk);
									$packagelist .= "</select>";
									echo $packagelist;
									?></td>
					<td ><input class="form-control" name="ReqAmt" type="text" id="ReqAmt<?php echo $StockItem; ?>" size="10" >
						<input class="form-control" type="hidden" name="SelectedStock" id="SelectedStock" value="<?php echo $SelectedStock; ?>">
					</td>
				</tr>
		<?php
				$count++;
			}
		}
		?>
	</tbody>
</table>