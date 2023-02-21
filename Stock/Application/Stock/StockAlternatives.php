<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="620" border="0" bgColor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);"><?php echo StockName($StockId); ?>'s Alternatives </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><a href="#" onclick="RemoveAlternative()">Remove Alternative</a> </td>
  </tr>
  <tr>
    <td>
      <div id="ShowAlternatives"></div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <tr>
          <td>
            <div align="right">Get Stock Item </div>
          </td>
          <td><input class="form-control" name="ItemName" type="text" id="ItemName" onkeyup="GetAlternativeItemsHint('<?php echo $StockId; ?>')" style='width:235px;' >
            <div id="hint" style=" display:none; width:400px; position:absolute; z-index:10000;"></div><input class="form-control" type="hidden" name="ItemId" id="ItemId" />
          </td>
          <td>
            <div align="right"></div>
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <div align="right"></div>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1"><input class="form-control" type="hidden" name="StockNumba" id="StockNumba" value="<?php echo $StockId; ?>" />
            <input class="btn btn-info" type="button" name="Button" value="Add item as alternative" style="float:right" onclick="StoreItemAsAlternative('<?php echo $StockId; ?>')">
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table>