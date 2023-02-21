<?php
$msg = $_REQUEST['msg'];


?><table width="500" border="0">
  <tr>
    <td width="470" class="alertsBox">LwalaHMIS</td>
    <td width="20" class="alertsBox"><img src="Layout/images/close.png" width="20" height="20" onclick="close_alert_div()"></td>
  </tr>
  <tr>
    <td colspan="2" class="alertsText">
      <div id="show_msg" style="width:100%; height:auto;"><?php echo $msg; ?></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input class="btn btn-success" type="button" name="Button" value="OK" id="OK_Button" onclick="close_alert_div()" />
      <input class="btn btn-danger" type="button" name="Button" value="Cancel" />
    </td>
  </tr>
</table>