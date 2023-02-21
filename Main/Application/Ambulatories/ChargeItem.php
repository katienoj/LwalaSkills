<?php
//script displays all the charges done on a selected patient during a particular episode
require_once '../../Config/db_conn.php';
$WhatToCharge = $_REQUEST['WhatToCharge'];
?>
<table width="100%" bgcolor="#FFFFFF" class="table">
  <tr>
    <td colspan="4" valign="top" class="heading style1">Charge Item</td>
  </tr>
  <tr>
    <td > Item:</td>
    <td ><input class="form-control" type="text" name="itemsname" id="itemsname" onclick="ShowSearchOnDefineItem()" /></td>
    <td >Quantity :<input class="form-control" type="text" id="dentalpatientchargesheetquantity" name="dentalpatientchargesheetquantity" onchange="checkifnumber()" /></td>
    <td >
      <input class="btn btn-info" type="button" id="AddCharge" name="AddCharge" value="   Add Charge  " onclick="SaveCharge()" style="width:150px" />
    </td>
  </tr>
</table>