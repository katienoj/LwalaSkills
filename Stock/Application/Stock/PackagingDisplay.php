<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="300" border="0" bgColor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Packaging Details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td> </td>
  </tr>
  <tr>
    <td>
      <div id="ShowMadePackages"></div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <tr>
          <td>
            <div align="right"></div>
          </td>
          <td>
            <div align="right"></div>
          </td>
        </tr>
        <tr>
          <td>
            <div align="right"></div>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1"><input class="form-control" type="hidden" name="PackagingId" id="PackagingId" /></td>
        </tr>
      </table>
    </td>
  </tr>

</table>