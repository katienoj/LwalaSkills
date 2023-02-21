<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" bgColor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" height="33" class="formtop" align="center">PACKAGING DETAILS</td>
          <td width="6%" height="33" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><input type="button" class="btn btn-warning btn-block"  onclick="DeletePackaging()" value="Delete Packaging"></td>
  </tr>
  <tr>
    <td>
      <div id="ShowMadePackages"></div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" >
        <!-- <tr>
        <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" height="33" class="formtop" align="center">ADD PACKAGING</td>
          <td width="6%" height="33" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>

        </tr> -->
        <tr class="formtop" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
          <td colspan="2" width="100%" class="formtop" align="center">ADD PACKAGING TYPE</td>
        </tr>

        <tr>
          <td align="left" ><b>Enter Packaging Type</b></td>
          <td align="right"><input class="form-control" name="PackagingName" type="text" id="PackagingName" /></td>
        </tr>
        <tr>
          <td>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1" colspan="2">
            <input class="form-control" type="hidden" name="PackagingId" id="PackagingId" />
            <input class="btn btn-success btn-block" type="button" name="Button" value="Save Packaging Type" onclick="StorePackagingName()">
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table>