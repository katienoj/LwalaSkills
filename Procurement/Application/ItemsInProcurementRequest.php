<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$PRQId = $_REQUEST['PRQId'];

$sql = mysqli_query($conn, "SELECT * FROM ProcurementRequest WHERE PRQId='$PRQId'") or die(mysqli_error($conn));


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" bgcolor="#E4E4E4" class="formborder" width="500">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Items in Procurement Request</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php

  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td align="center" >Sorry.Lwala does not Know any Items on the selected Request</td>
    </tr>
  <?php
  } else {
  ?>
    <tr>
      <td>
        <table border="0">
          <thead>
            <tr>
              <td class="heading">Stock Name </td>
              <td class="heading">RequestedQty</td>
              <td class="heading">Packaging</td>
              <td class="heading">Department</td>
              <td class="heading">Date of Request </td>

            </tr>
          </thead>
          <tbody style="width:100%;height:200px; max-height:200px; overflow-x:hidden; overflow-y:auto;">
            <?php
            $count = 0;
            while ($recs = mysqli_fetch_array($sql)) {
              $StockId = $recs['StockId'];
              $Qty = $recs['Qty'];
              $Packaging = $recs['Packaging'];
              $CatId = $recs['CatId'];
              $DateOfRequest = dteconvert($recs['DateOfRequest']);
              $RequestId = $recs['RequestId'];
              $Id = $recs['Id'];
              $Approver = $recs['Approver'];
              $dteApproved = $recs['DateOfApproval'];
              $ProcessedBy = $recs['ProcessedBy'];
              $DateOfProcessing = $recs['DateOfProcessing'];


              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
            ?>
              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                <td ><?php echo StockName($StockId); ?></td>
                <td ><?php echo $Qty; ?></td>
                <td ><?php echo PackagingInfo($Packaging); ?></td>
                <td ><?php echo DepartmentName(RequestDepartment($RequestId)); ?></td>
                <td ><?php echo $DateOfRequest; ?></td>

              </tr>
            <?php
              $count++;
            }

            ?>
          </tbody>
        </table>
      </td>
    </tr>
  <?php
  }
  ?>
</table>