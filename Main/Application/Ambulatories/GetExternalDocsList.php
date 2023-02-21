<?php // This form captures details to search for a patients medical report 
global $conn;
?>
<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>

<link rel="stylesheet" href="../Main/Layout/styles/divs.css" />
<link rel="stylesheet" href="../Main/Layout/styles/topmenu.css" />
<link rel="stylesheet" href="../Main/Layout/styles/interface.css" />


<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/general.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/MainValidation.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/move_divs.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/scw.js"></script>
<script language="javascript" type="text/javascript" src="Layout/DoctorPayments.js"></script>

<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js"></script>

<style type="text/css">
	.style1 {
		color: #FF0000
	}

	#doctorserachres {
		position: absolute;
		width: 392px;
		height: auto;
		z-index: 100;
		left: 220px;
		top: 165px;
		background-color: #E4E4E4;
		border: #003300 solid 1px;
		display: none;
	}
</style>





<table width="100%" class="table">
	<tr class="SearchTop">
		<td colspan="3" class="SearchTop">Seach External Doctor </td>
		<td class="SearchTop"><a href="#" onClick="inter=setInterval('hideSearchDiv()',3); return false;" style="cursor:hand; text-decoration:inherit; float:right; color:#FFFFFF">Hide Search </a></td>
	</tr>
	<tr>
		<td>Doctor No:</td>
		<td><input class="form-control" type="text" id="docpaymentdocid" name="docpaymentdocid" /></td>
		<td> Doctor Name:</td>
		<td><input class="form-control" type="text" id="docpaymentdocname" name="docpaymentdocname" /></td>
	</tr>
	<tr>
		<td>National Id/Passport :</td>
		<td><input class="form-control" type="text" id="docpaymentnationalid" name="docpaymentnationalid" /></td>
		<td>Department:</td>
		<td><input class="form-control" type="text" id="docpaymentdep" name="docpaymentdep" /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>

		<td> <input class="btn btn-warning" type="button" id="SearchPatientMedicalReport" name="SearchPatientMedicalReport" value="Search" onClick="SearchExternalDoctors()" style="width:145px" /></td>
	</tr>
	<tr>
		<td colspan="4">
		</td>
	</tr>



</table>