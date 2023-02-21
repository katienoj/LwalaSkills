<?php
include "../Config/db_conn.php";
global $conn;
session_start();
$UserId = $_SESSION['UserId'];
$PatId = $_REQUEST['PatId'];
?>
<link href="../Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
    <tr>
      <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Selected Services to be added to Patient ChargeSheet</td>
      <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="0" height="0" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
    </tr>
  </table>
  <?php

  $sql = mysqli_query($conn, "SELECT * FROM PatientChargeSheetTemp WHERE UserId='$UserId' AND PatientId='$PatId'") or die(mysqli_error($conn));
  $rows = mysqli_num_rows($sql);
  if ($rows == 0) {
  ?>
    <tr>
      <td colspan="7" align="center"></td>
    </tr>
  <?php
  } else {
  ?>

</table>


<tr>
  <td colspan="7">
    <table width="100%" border="0" id="service_table1">
      <thead>
        <tr>
          <th width="4%" >
            <!----<input type="checkbox" name="SelectCharge" id="SelectCharge" value="checkbox" onclick="SelectCharges()" >------>
          </th>
          <th width="14%" >Department</th>
          <th width="8%" >Visit No</th>
          <th width="24%" >Particulars Id</th>
          <th width="17%" >Unit Cost </th>
          <th width="14%" >Qty</th>
          <th width="19%" >Total</th>
        </tr>
      </thead>

      <tbody style="height:150px; max-height:150px; overflow-x:hidden; overflow-y:auto;">
        <?php
        $count = 0;
        $CumTotal = 0;
        while ($recs = mysqli_fetch_array($sql)) {
          $ChargeId = $recs['Id'];
          $DepartmentId = $recs['DepartmentId'];
          $Particulars = $recs['ParticularsId'];
          $EpisodeNo = $recs['EpisodeNo'];
          $Cost = $recs['Cost'];
          $qty = $recs['Quantity'];
          $Amount = $recs['Amount'];
          $CumTotal += $Amount;
          if ($count % 2 == 0) {
            $bg = '#E1E1FF';
          } else {
            $bg = '#EAEAEA';
          }

        ?>
          <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
            <td><input class="form-control" type="checkbox" id="CheckCharge" name="CheckCharge" value="<?php echo $ChargeId; ?>"></td>
            <td><?php echo DepartmentName($DepartmentId); ?></td>
            <td align="center"><?php echo $EpisodeNo; ?></td>
            <td><?php echo $Particulars; ?></td>
            <td><input class="form-control" type="type" readonly value="<?php echo number_format($Cost, 2); ?>" id="<?php echo number_format($Cost, 2); ?>" name="<?php echo number_format($Cost, 2); ?>" /></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo number_format($Amount, 2); ?></td>
          </tr>
        <?php
          $count++;
        }
        ?>
      </tbody>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="3">
          <div align="right"><span class="td_bottom">Cumulative Total </span></div>
        </td>
        <td colspan="2" class="td_bottom"><?php echo number_format($CumTotal, 2); ?></td>

      </tr>

      <tr>
        <td colspan="4">
          <input type="button" class="btn btn-warning btn-block" name="RemoveCharges" id="RemoveCharges" value="Remove Selected Service" onclick="RemoveSelectedCharge()" />
        </td>
        <td colspan="3">
          <input type="button" class="btn btn-success btn-block" name="AddToChargeSheet" id="AddToChargeSheet" value="Confirm Service Addition" onclick="CompletePutToChargeSheet()" />
        </td>

      </tr>
    </table>

  <?php
  }
  ?>
  <