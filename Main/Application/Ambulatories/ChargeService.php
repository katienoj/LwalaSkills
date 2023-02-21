<?php
//script displays all the charges done on a selected patient during a particular episode
require_once '../../Config/db_conn.php';
$WhatToCharge = $_REQUEST['WhatToCharge'];
?>
<table width="100%" bgcolor="#FFFFFF" class="table">
  <td >Service :
    <input class="form-control" type="text" name="servname" id="servname" onclick="ShowSearchOnDefineService()" />
    <input class="form-control" type="hidden" name="servid" id="servid" value="" />
  </td>
  </td>
  <td >Times/Number :
    <input class="form-control" type="text" id="dentalpatientchargesheetprocquantity" name="dentalpatientchargesheetprocquantity" onchange="checkifprocquantityisnumber()" />
  </td>
  <td >Doctor To Pay
    <input class="form-control" type="text" name="externaldoctor" disabled="disabled" id="externaldoctor" onclick="ShowSearchOnDefineDoctorRelated()" />
  </td>
  <div id="SelectDoctor" style="position:absolute; z-index:100; background-color:#E4E4E4"> </div>
  <input class="form-control" type="hidden" name="doctorid" id="doctorid" value="">
  <td align="justify"  style="color:#0000FF"><span  style="color:#0000FF">
      <input class="btn btn-info" type="button" id="AddCharge" name="AddCharge" value="   Add Charge  " onclick="AddServiceCharge()" style="width:150px" />
    </span></td>
  </tr>
</table>