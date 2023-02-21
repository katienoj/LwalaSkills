<?php
require_once '../../../Main/Config/db_conn.php';

?>
<table class="table" width="100%">
	<tr>
		<td colspan="8">
			<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
				<tr>
					<td width="94%" class="formtop">External Doctors List </td>
					<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closethisdiv('SelectDoctor')" style="cursor:hand" /></td>
				</tr>
			</table>
		</td>
	</tr>


	<tr>
		<td colspan="8">
			<div id="SearchDoctorsInfo"> </div>

		</td>
	</tr>
	<tr>
		<td ></td>
		<td >Id</td>
		<td >Surname</td>
		<td >Other Names</td>
		<td >Mobilephone Number</td>
		<td >Hospital Name</td>
		<td >Hospital Telephone Number</td>
		<td >Staff Number</td>

	</tr>
	<tr>
		<?php
		//Get a list of all employees in the group
		$count = 0;

		$SqlStatement = "SELECT * FROM ExternalDoctorsRegistration";

		$ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Failed to get the patients list. " . mysqli_error($conn));

		$GetRows = mysqli_num_rows($ExecSqlStatement);

		if ($GetRows > 0) {

			while ($Row = mysqli_fetch_array($ExecSqlStatement)) {

				if ($count % 2 == 0) {
					$bg = '#E1E1FF';
				} else {
					$bg = '#EAEAEA';
				}

				$DoctorId = htmlentities($Row['Id']);
		?>

	<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
		<td width="50"><input class="form-control" type="checkbox" name="doctor" id="doctor_id<?php echo $DoctorId; ?>" value="<?php echo $DoctorId; ?>" onclick="GetDoctorDetails()" /></td>
		<td><?php echo htmlentities($Row['Id']); ?></td>
		<td><?php echo htmlentities($Row['LastName']); ?></td>
		<td><?php echo html_entity_decode($Row['FirstName']) . " " . html_entity_decode($Row['MiddleName']); ?></td>
		<td><?php echo html_entity_decode($Row['MobileNumber1']); ?></td>
		<td><?php echo html_entity_decode($Row['HospName']); ?></td>
		<td><?php echo html_entity_decode($Row['HospTelephone']); ?></td>
		<td><?php echo html_entity_decode($Row['StaffNumber']); ?></td>
	</tr>

<?php
				$count++;
			}
		} else {

?>
<tr>
	<td width="50"></td>
	<td><?php echo ("No External Doctors Registered"); ?></td>
	<td></td>
	<td></td>
</tr>
<?php
		}
?>

</tr>
</table>