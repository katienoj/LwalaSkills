<?php
require_once '../../../Main/Config/db_conn.php';
//This form captures the edited supplier category's  details
$CategoryId = htmlentities($_REQUEST['Category']);
$CheckCategory = mysqli_query($conn, "SELECT * FROM SuppliersCategories WHERE Id='$CategoryId'") or die(mysqli_error($conn));
$Row = mysqli_fetch_array($CheckCategory);
?>
<table class="table" width="100%">
	<tr>
		<td align="right" valign="top">*Supplier Category Name:</td>
		<td valign="top"><input class="form-control" type="text" id="catname" name="catname" value="<?php echo htmlentities($Row['Category']); ?>" /></td>
	</tr>
	<tr>
		<td align="center">*-Required Fields </td>
		<td align="left">
			<input class="form-control" type="hidden" name="CategoryId" id="CategoryId" value="<?php echo $CategoryId; ?>" />
			<input class="btn btn-success" type="button" id="addcategory" name="addcategory" value="  Save  " maxlength="255" onclick="SaveEditCategory()" />
		</td>
	</tr>
</table>