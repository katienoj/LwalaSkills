<?php
//script displays all the charges done on a selected patient during a particular episode
require_once '../../Config/db_conn.php';
$WhatToCharge = $_REQUEST['WhatToCharge'];
?>
<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>
<script type="text/javascript" src="Layout/Dental.js"></script>
<script type="text/javascript" src="Layout/Time.js"></script>
<script type="text/javascript" src="Layout/scw.js"></script>
<script type="text/javascript" src="Layout/datetimepicker.js"></script>
<table width="100%" border="0" bgcolor="#E4E4E4">
  <tr bgcolor="#FFFFFF" class="table">
    <td width="204" >Procedure :</td>
    <td width="204" ><input tclass="form-control" ype="text" name="procname" id="procname" onclick="ShowSearchOnDefineProcedure()"> </td>
    <td >Times/Number :
      <input class="form-control" type="text" id="dentalpatientchargesheetprocquantity" name="dentalpatientchargesheetprocquantity" onchange="checkifprocquantityisnumber()" />
    </td>
    <td ><input class="btn btn-info" type="button" id="AddCharge" name="AddCharge" value="   Add Charge  " onclick="AddProcCharge()" style="width:150px" /> </td>
  </tr>
</table>