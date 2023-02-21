<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="400" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop"><?php echo StockName($StockId); ?>'s Packaging Details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>
      <div id="ShowPackages"></div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>

      </table>
    </td>
  </tr>

</table>