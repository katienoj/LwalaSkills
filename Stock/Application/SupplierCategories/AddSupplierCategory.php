<?php
//This form captures new supplier categories details
?>
<table class="table" width="100%">
	<tr>
		<td align="right" valign="top">*Supplier Category Name:</td>
		<td valign="top"><input class="form-control" type="text" id="catname" name="catname" /></td>
	</tr>
	<tr>
		<td align="center">*-Required Fields </td>
		<td align="left">
			<input class="btn btn-success" type="button" id="addcategory" name="addcategory" value="  Save  " maxlength="255" onclick="SaveCategory()" />
		</td>
	</tr>
</table>