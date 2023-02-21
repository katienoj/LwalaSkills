<?php
$Error_Message = $_REQUEST['errorMessage'];
?>
<table width="500" border="0">
  <tr>
    <td colspan="2" class="alertsText">
      <div id="show_msg" style="width:100%; height:auto;"><?php echo $Error_Message; ?></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="Button" value="OK" id="OK_Button" onclick="HidePopUp_Auth_Error('div_ViewLwalaMesage_Main','window_ViewLwalaMesage_Main')" />
    </td>
  </tr>
</table>