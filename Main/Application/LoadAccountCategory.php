<?php include "../Config/db_conn.php";
session_start();
//$UserId=$_SESSION['UserId'];
$module_id = $_REQUEST['module_id'];
global $conn;
?>
<link href="../Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<input type="hidden" id="module_id_cat" value="<?php echo $module_id; ?>" />
<div id="account_category_div">
	<table width="100%" border="0" bgcolor="#E4E4E4">
		<tr>
			<td colspan="4">
				<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
					<tr>
						<td width="94%" class="formtop" onmousedown="javascript:getReadyToMove('popup_div', event);">Set Up Accounts For This Module</td>
						<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div style="background-color:#999999">
	<table border="0" width="100%">
		<tr>
			<td >Please Select Account Category To Connect to This Module</td>
		</tr>
	</table>
	<table border="0" width="100%">
		<tr>
			<td >Account Category</td>
			<td >
				<?php
				$sql = mysqli_query($conn, "SELECT * FROM AccountsCategories ORDER BY Id ASC") or die(mysqli_error($conn));
				?>
				<select class="form-control" id="account_category_id">
					<?php
					while ($rec = mysqli_fetch_array($sql)) {
						$id = $rec['Id'];
						$category_name = $rec['CategoryName'];
					?>
						<option class="form-control" value="<?php echo $id; ?>"><?php echo $category_name; ?></option>
					<?php }
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td ><input type="button" class="btn btn-warning" onclick="LinkCategoryToModule(<?php echo $module_id; ?>)" value="Link Category to this Module" />
				<input type="button"  onclick="closepopupdiv()" value="Close" />
			</td>
		</tr>
	</table>
	<div style="background-color:#FFFFFF;" id="list_of_linked_categories">
	</div>
</div>