<?php
require_once '../../Main/Config/db_conn.php';

//require_once '../../Include/PPHFunctions.php';
//$GroupId=htmlentities($_REQUEST['GroupId']);
$RuleId = htmlentities($_REQUEST['RuleId']);
//$PolicyId=htmlentities($_REQUEST['PolicyId']);
$GetAllInclusions = "Select * from Inclusions Where RuleId = $RuleId";

$Exec = mysqli_query($conn, $GetAllInclusions) or die(mysqli_error($conn));

$GetRows = mysqli_num_rows($Exec);

$GetRule = "Select * From ContractRules Where RuleId='$RuleId'";
$Exec1 = mysqli_query($conn, $GetRule) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec1)) {
	$RuleName = $Row1['RuleName'];
	$Policy = $Row1['PolicyId'];
	$Insurance = $Row1['InsuranceGroupId'];
	echo 'here';
}
$GetPolicy = "Select * From InsuranceCoverPolicies Where PolicyId='$Policy'";
$Exec2 = mysqli_query($conn, $GetPolicy) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec2)) {
	$PolicyName = $Row1['PolicyName'];
}

$GetInsurance = "Select * From InsuranceGroups Where InsuranceGroupId='$Insurance'";
$Exec3 = mysqli_query($conn, $GetPolicy) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec3)) {
	$InsuranceName = $Row1['CompanyName'];
}


?>

<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>
<script type="text/javascript" src="Layout/InsuranceGroups.js"></script>
<script type="text/javascript" src="Layout/scw.js"></script>
<table width="100%" border="0" bgcolor="#CCCCCC">
	<tr>
		<td colspan="8">
			<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">

				<td width="94%" class="formtop"> Inclusions for <?php echo $RuleName; ?></td>
				<input type="hidden" id="insurancegroupname1" name="insurancegroupname1" value=" " />
				<input type="hidden" id="insurancegroupruleid" name="insurancegroupruleid" value="" />
				<td width="6%" class="formtop"><img src="../Layout/images/close.png" width="20" height="20" align="right" onClick="closedetailsdiv()" style="cursor:hand" /></td>
	</tr>
</table>
</td>
</tr>
<tr>
	<td>
	</td>
	<td>
	</td>
</tr>



<?php

if ($GetRows > 0) {

?>

	<tr bgcolor="#D5FFE9">
		<td ></td>
		<td >Service Covered for By Insurance for this Patient</td>


	</tr>

	<?php

	$count = 0;
	while ($Row = mysqli_fetch_array($Exec)) {
		$SerViceId = $Row['ServiceTypeId'];

		$GetService = "Select * from ServiceTypes Where ServiceTypeId='$SerViceId'";

		$Exec1 = mysqli_query($conn, $GetService) or die(mysqli_error($conn));
		while ($Row1 = mysqli_fetch_array($Exec1)) {
			$ServiceTypeName = $Row1['ServiceTypeName'];
		}

		$i = $Row['InclusionId'];

		$bg = '#E1E1FF';
	?>
		<tr height="10%" bgcolor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF' " onMouseOut="this.bgColor='<?php echo $bg; ?>'">
			<?php
			echo ('<td><input type=checkbox id=Inclusions name=Inclusions value=' . $i . '></td>
				 
				  <td>' . $ServiceTypeName . '</td>');


			?>
		</tr>
<?php
		$count++;
	}
	echo ('</table>');
} else {
	echo 'No Inclusions for this Rule';
}

?>