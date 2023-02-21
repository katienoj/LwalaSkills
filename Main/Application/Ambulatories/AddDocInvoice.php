<?php
// this script creates the form which allows the user to add a new  credit note to a selected invoice
@include '../../../Main/Config/db_conn.php';

/*$DoctorId=htmlentities($_REQUEST['DoctorId']);
$ChargeId=htmlentities($_REQUEST['ChargeId']);
    $GetRule = "Select * from ExternalDoctorsRegistration Where Id='$DoctorId'";
    $Exec1 = mysqli_query($conn, $GetRule) or die(mysqli_error($conn));
    while($Row1 = mysqli_fetch_array($Exec1))
    {
       $DocName=$Row1['LastName']." ".$Row1['MiddleName']." ".$Row1['FirstName'] ;
    }
*/
?>
<style type="text/css">
	.style1 {
		color: #FF0000
	}
	#lposearch {
		position: absolute;
		width: 700px;
		height: auto;
		z-index: 100;
		left: 220px;
		top: 165px;
		background-color: #E4E4E4;
		border: #003300 solid 1px;
		display: none;
	}
</style>
<table width="100%" border="0" bgcolor="#FFFFFF">
	<tr>
		<td colspan="4">
			<table width="100%" border="0">
				<tr>
					<td class="formtop" align="right"> <img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closethisdiv('charge_div')" style="cursor:hand" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<div id="lposearch"></div>
	<tr>
		<td valign="top">Doctor:</td>
		<td valign="top" colspan="3"><input class="form-control" type="text" name="externaldoctor" readonly="true" id="externaldoctor" onclick="ShowSearchOnDefineDoctorRelated()" />
			<input class="form-control" type="hidden" name="doctorid" id="doctorid" value="">
			<div id="SelectDoctor" style="position:absolute; z-index:100; background-color:#E4E4E4"> </div>
		</td>
	</tr>
	<tr>
		<td valign="top">Date Received :</td>
		<td valign="top" colspan="3"><input class="form-control" type="text" name="addsupinvoicedate" id="addsupinvoicedate" onclick='scwShow(this,event);' /></td>
	</tr>
	<tr>
		<td valign="top">Amount</td>
		<td width="57%" valign="top"><input class="form-control" type="text" name="addsupinvoiceamount" id="addsupinvoiceamount" /></td>
	</tr>
	<tr>
		<td height="31" valign="top">Currency :</td>
		<td valign="top"><select class="form-control" name="supinvoicecurrency" id="supinvoicecurrency" style="width:145px">
				<?php
                echo "<option class='form-control' size =30 selected> </option>";
                $GetCurrency = "Select * From CurrencyDetails";
                $sql_result = mysqli_query($conn, $GetCurrency) or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql_result)) {
                    echo "<option class='form-control' value='$row[Id]'";
                    if ($row['Id'] == 1) {
                        echo "selected=selected";
                    }
                    echo ">$row[CurrencyName] </option>";
                }
                ?>
			</select></td>
	</tr>
	<tr>
		<td class="g">Upload</h2> Invoice </td>
		<td class="g">
			<form action="Application/Uploadsupinvoice.php" method="post" enctype="multipart/form-data" target="upload" id="uploadCnote">
				<iframe src="#" name="upload" width="400" height="100" id="upload" style="display:none"> </iframe>
				<input class="form-control" type="file" id="supinvoicefile" name="supinvoicefile" />
			</form>
		</td>
	</tr>
</table>
<table width="100%" border="0" bgcolor="#FFFFFF">
	<tr>
		<td width="43%" valign="top">&nbsp;</td>
		<td width="57%" align="left" >
			<input class="btn btn-success" name="button" type="button" onClick="SaveDocInvoice()" value="Save Invoice" />
		</td>
	</tr>
</table>