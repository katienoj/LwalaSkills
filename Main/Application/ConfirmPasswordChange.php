<?php
$Confirmation_Message = $_REQUEST['confirmationMessage'];
?>
<table width="500" border="0">
  <tr>
    <td colspan="2" class="alertsText">
      <div id="show_msg" style="width:100%; height:auto;"><?php echo $Confirmation_Message; ?></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input class="btn btn-success" type="button" name="Button" value="OK" id="OK_Button" onclick="HidePopUp_Auth_Error('HidePopUp_Auth('div_ViewChangePasswordConfirmation_Main','window_ViewChangePasswordConfirmation_Main'))" />
    </td>
  </tr>
</table>