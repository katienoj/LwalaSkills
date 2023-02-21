<?php
require_once '../../Main/Config/db_conn.php';
include '../Include/AuditTrailFunc.php';
//include 'Include/AuditTrailFunc.php';
?>
<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>
<script type="text/javascript" src="Layout/AuditTrail.js"></script>
<script type="text/javascript" src="Layout/scw.js"></script>

<table width="100%">
  <tr>
    <td width="12%" height="31" valign="top">Start Date </td>
    <td width="16%"><input class="form-control" name="FromDate" type="text" id="FromDate" size="20" onclick='scwShow(this,event);' /></td>
    <td width="14%" height="31" valign="top">End Date </td>
    <td width="28%"> <input class="form-control" name="ToDate" type="text" id="ToDate" size="20" onclick='scwShow(this,event);' /></td>
    <td width="12%" valign="top">User Name </td>
    <td width="18%" valign="top"><input class="form-control" name="UserName" type="text" id="UserName" size="20" /></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td><input type="button" class="btn btn-warning" id="SubmitSearch" name="SubmitSearch" value="   Search  " onclick="DisplayLoginErrorSearch()" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>