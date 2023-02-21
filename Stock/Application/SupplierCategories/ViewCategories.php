<?php
require_once '../../../Main/Config/db_conn.php';
date_default_timezone_set('UTC');
?>
<table class="table" width="100%">
	<tr>
		<td ></td>
		<td >Id</td>
		<td >Supplier Category</td>
	</tr>
	<tr>
		<?php
		$GetCategory = mysqli_query($conn, "SELECT * FROM SuppliersCategories WHERE Deactivate='0'") or die(mysqli_error($conn));
		if (mysqli_num_rows($GetCategory) > 0) {
			while ($Recs = mysqli_fetch_array($GetCategory)) {
				$CategoryId = htmlentities($Recs['Id']);
		?>

	<tr>
		<td width="50"><input class="form-control" type="checkbox" name="category_id" id="category_id<?php echo $CategoryId; ?>" value="<?php echo $CategoryId; ?>" /></td>

		<td><?php echo htmlentities($Recs['Id']); ?></td>
		<td><?php echo htmlentities($Recs['Category']); ?></td>

	</tr>
<?php

			}
		} else {
			echo ("Suppliers categories not set up yet");
		}
?>

</tr>
</table>