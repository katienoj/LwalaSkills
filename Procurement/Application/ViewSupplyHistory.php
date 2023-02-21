<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$LPOId = $_REQUEST['LPOId'];
?>
<table width="800" border="0" bgColor="#E4E4E4">
  <tr>
    <td colspan="4">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Received Notes in LPO Number <?php echo $LPOId; ?></td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><a href="#" onclick="EnterInvoiceForSupplies()">Enter Invoice for selected Supplies</td>
  </tr>
  <tr>
    <td>
      <div id="ShowLPODeliveries" style="width:100%;height:400px;max-height:400px;"></div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <input class="form-control" type="hidden" name="LPONo" id="LPONo" value="<?php echo $LPOId; ?>" />
  </tr>
</table>