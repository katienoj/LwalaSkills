<?php
require_once '../../Main/Config/db_conn.php';

//require_once '../../Include/PPHFunctions.php';
//$GroupId=htmlentities($_REQUEST['GroupId']);
$RuleId = htmlentities($_REQUEST['RuleId']);
//$PolicyId=htmlentities($_REQUEST['PolicyId']);
$GetAllInclusions = "Select * from Inclusions Where RuleId = $RuleId";

$Exec = mysqli_query($conn, $GetAllInclusions) or die(mysqli_error($conn));

$GetRows = mysqli_num_rows($Exec);

$GetRule = "Select * from ContractRules Where RuleId='$RuleId'";
$Exec1 = mysqli_query($conn, $GetRule) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec1)) {
	$RuleName = $Row1['RuleName'];
	$Policy = $Row1['PolicyId'];
	$Insurance = $Row1['InsuranceGroupId'];
}
$GetPolicy = "Select * from InsuranceCoverPolicies Where PolicyId='$Policy'";
$Exec2 = mysqli_query($conn, $GetPolicy) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec2)) {
	$PolicyName = $Row1['PolicyName'];
}
$GetInsurance = "Select * from InsuranceGroups Where InsuranceGroupId='$Insurance'";

$Exec3 = mysqli_query($conn, $GetInsurance) or die(mysqli_error($conn));
while ($Row1 = mysqli_fetch_array($Exec3)) {
	$InsuranceName = $Row1['CompanyName'];
}


?>

<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>
<script type="text/javascript" src="Layout/InsuranceGroups.js"></script>
<script type="text/javascript" src="Layout/scw.js"></script>
<style type="text/css">
	.style1 {
		color: #FF0000
	}
</style>

<table width="100%" bgcolor="#CCCCCC">

	<tr>
		<td colspan="8">
			<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">

				<td width="94%" class="formtop"> Inclusions for <?php echo $RuleName; ?></td>
				<input class="form-control" type="hidden" id="insurancegroupname1" name="insurancegroupname1" value=" " />
				<input class="form-control" type="hidden" id="insurancegroupruleid" name="insurancegroupruleid" value="" />
				<td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv_1()" style="cursor:hand" /></td>
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

		<td  colspan="3"><span class="style1">Services Covered By <?php echo $InsuranceName; ?> for this Patient</span></td>


	</tr>
	<tr>


	<tr>
		<td > Insurance</td>
		<td  style="color:#0000FF"> <?php echo $InsuranceName; ?></td>
		<td > </td>

	</tr>
	<tr>
		<td >Policy</td>
		<td  style="color:#0000FF"> <?php echo $PolicyName; ?></td>
		<td > </td>

	</tr>

	</tr>

	<?php

	$count = 0;
	while ($Row = mysqli_fetch_array($Exec)) {
		$SerViceId = $Row['ParticularsId'];
		$Type = $Row['ParticularsType'];
		if ($Type == "Service") {

			$GetProcedureName = mysqli_query($conn, "SELECT * FROM Procedures WHERE ProcedureId='$SerViceId'");
			while ($rows = mysqli_fetch_array($GetProcedureName)) {
				$ProcedureName = $rows['ProcedureName'];
				$ServiceCategory = $rows['ServiceCategory'];
			}
		} else if ($Type == "Procedure") {

			$GetProcedureName = mysqli_query($conn, "SELECT * FROM HospitalServices WHERE ServiceId='$SerViceId'");
			while ($rows = mysqli_fetch_array($GetProcedureName)) {
				$ProcedureName = $rows['ServiceName'];
				$ServiceCategory = $rows['ServiceCategory'];
			}
		} else if ($Type == "Item") {
			$GetProcedureName = mysqli_query($conn, "SELECT * FROM StockTable WHERE Id='$SerViceId'");
			while ($rows = mysqli_fetch_array($GetProcedureName)) {
				$ProcedureName = $rows['StockName'];
				$ServiceCategory = "";
				//$rows['ServiceCategory'];
			}
		}



		if ($ServiceCategory == 0) {
			$ServiceTypeName = 'Undefined';
		} else {
			$GetService = "Select * from ServiceTypes Where ServiceTypeId='$ServiceCategory'";

			$Exec1 = mysqli_query($conn, $GetService) or die(mysqli_error($conn));
			while ($Row1 = mysqli_fetch_array($Exec1)) {
				$ServiceTypeName = $Row1['ServiceTypeName'];
			}
		}
		$i = $Row['InclusionId'];

		$bg = '#E1E1FF';
	?>
		<tr height="10%" bgcolor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF' " onMouseOut="this.bgColor='<?php echo $bg; ?>'">
			<?php
			echo ('<td><input class="form-control" type=checkbox id=Inclusions name=Inclusions value=' . $i . '></td>
				 
				  <td>' . $ServiceTypeName . '</td>');


			?>
			<td ><?php echo $ProcedureName; ?> </td>
		</tr>

		</tr>
<?php
		$count++;
	}
	echo ('</table>');
} else {
	echo 'No Inclusions for this Rule';
}

?>