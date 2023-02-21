<?php
$selectedRequests = $_REQUEST['selectedRequests'];
?>
<table width="500" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Action after Approval </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  
  <tr>
    <td>Select Action
      <select class="form-control" name="ActionApproval" id="ActionApproval">
        <option class="form-control" value="1">Service Request Items</option>
        <option class="form-control" value="2">Generate Procurement Requests for the Items</option>
      </select>
      <input class="btn btn-success" type="button" name="Button" value="Go" onclick="ProceedWithActionAfterApproval('<?php echo $selectedRequests; ?>')">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>