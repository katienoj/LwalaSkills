<?php
session_start();
require_once '../../Main/Config/db_conn.php';
?>
<style type="text/css">
	.TableBorder {
		border: #CCCCCC solid 1px;
	}

	.TableBorder_Dark {
		border: #808080 solid 2px;
	}

	.SectionHeaders {
		font-weight: bold;
	}

	.ExpandImg:hover {
		width: 16px;
		height: 16px;
		cursor: pointer;
	}

	.MarkAsHeader {
		border: #959595 solid 1px;
		background: #F6F6F6;
		font-weight: bold;
		font-family: Arial, Helvetica, sans-serif;
	}

	.MarkAsSubHeader {
		background: #F6F6F6;
		font-family: Arial, Helvetica, sans-serif;
		text-align: right;
	}

	.MarkAsResults {
		border: #BEBEBE solid 1px;
		background: #F9F9F9;
		font: Arial, Helvetica, sans-serif;
		font-weight: bold;
	}

	.MarkAsResults_Sub {
		background: #F9F9F9;
		font: Arial, Helvetica, sans-serif;
	}
</style>
<?php
/*This script will change the user password.*/
?>
<table width="100%" bgcolor="#FFFFFF">
	<tr>
		<td valign="top" align="right" class="MarkAsSubHeader">User Name:</td>
		<td valign="top" class="MarkAsSubHeader"><input class="form-control" name="text" type="text" id="enterUserName" /></td>
		<td align="right" valign="top" style="margin:5px;" class="MarkAsResults_Sub">&nbsp;</td>
	</tr>
	<tr>
		<td width="37%" valign="top" align="right" class="MarkAsSubHeader">Email Address:</td>
		<td width="12%" valign="top" class="MarkAsSubHeader"><input class="form-control" name="text2" type="text" id="emailAddresss" /></td>
		<td width="51%" valign="top" style="margin:5px;" class="MarkAsResults_Sub"><b>Or</b></td>
	</tr>

	<tr>
		<td valign="top" align="right" class="MarkAsSubHeader">Password:</td>
		<td valign="top" class="MarkAsSubHeader"><input class="form-control" type="password" id="newPassword" /></td>
		<td valign="top" class="MarkAsResults_Sub">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" align="right" class="MarkAsSubHeader">Confirm Password:</td>
		<td valign="top" class="MarkAsSubHeader"><input class="form-control" name="text3" type="password" id="confirmPassword" /></td>
		<td valign="top" class="MarkAsResults_Sub">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" align="right" class="MarkAsSubHeader">&nbsp;</td>
		<td valign="top" class="MarkAsSubHeader"><input class="btn btn-warning" name="button" type="button" id="resetPassword" onclick="ExecChangeUserPassword()" value=" Reset Password " /></td>
		<td valign="top" class="MarkAsResults_Sub">&nbsp;</td>
	</tr>
</table>