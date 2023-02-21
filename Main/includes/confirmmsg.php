<?php
include  "../../Main/Config/db_conn.php";
global $conn;
$msg = $_REQUEST['msg'];
$FuncName = $_REQUEST['FuncName'];

?>


<table width="500" border="0">
  <tr>
    <td width="470" class="alertsBox" onMouseDown="javascript:getReadyToMove('alert_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">
      <?php
      $sqlx = mysqli_query($conn, "SELECT HospitalName FROM SetHospital") or die(mysqli_error($conn));
      while ($recx = mysqli_fetch_array($sqlx)) {
        $HospitalName = $recx['HospitalName'];
      }

      echo $HospitalName;
      ?></td>
    <td width="20" class="alertsBox"><img src="../Main/Layout/images/close.png" width="20" height="20" onclick="close_alert_div()"></td>
  </tr>
  <tr>
    <td colspan="2" class="alertsText">
      <div id="show_msg" style="width:100%; height:auto;"><?php echo $msg; ?></div>
    </td>
  </tr><input name="Confirm_Response" type="hidden" id="Confirm_Response" />
  <tr>
    <td colspan="2" align="center"><input type="button" class="btn btn-success" name="Button" value="Yes" id="OK_Button" onclick="<?php echo $FuncName; ?>()" />
      <input type="submit" name="Submit" value="No" class="btn btn-danger" onclick="close_alert_div()" />
    </td>
  </tr>
</table>