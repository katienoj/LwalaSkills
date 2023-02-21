<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$StockId = $_REQUEST['StockId'];
$DeptId = $_REQUEST['DeptId'];

$sqlGetMvtDetails = mysqli_query($conn, "SELECT * FROM DepartmentStock WHERE StockId='$StockId' AND DepartmentId='$DeptId'") or die(mysqli_error($conn));
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="500" border="0" bgcolor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Stock movement for <?php echo StockName($StockId); ?> in the <?php echo DepartmentName($DeptId); ?> department </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
  if (mysqli_num_rows($sqlGetMvtDetails) == 0) {
  ?>
    <tr>
      <td  align="center">Sorry.No stock movement captured for this department</td>
    </tr>

  <?php
  } else {
  ?>
    <tr>
      <td>
        <table width="100%" border="0">
          <thead>
            <tr>
              <td width="3%" >&nbsp;</td>
              <td width="16%" >Stock Name </td>
              <td width="18%" >Date of Mvt </td>
              <td width="15%" >Qty In </td>
              <td width="16%" >Qty Out </td>
              <td width="16%" >Packaging </td>
              <td width="12%" >From</td>
              <td width="20%" >To</td>
            </tr>
          </thead>
          <tbody style="width:100%; height:300px; max-height:300px; overflow-x:hdden; overflow-y:auto; ">
            <?php
            $count = 0;
            while ($recs = mysqli_fetch_array($sqlGetMvtDetails)) {
              $StockId = $recs['StockId'];
              $QtyIn = $recs['StockQtyIn'];
              $QtyOut = $recs['StockQtyOut'];
              $Packaging = $recs['Packaging'];
              $From = $recs['FromDept'];
              $To = $recs['ToDept'];
              $DateMvt = $recs['DateOfDeptStockMvt'];


              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
            ?>
              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'" valign="top">
                <td ><?php  ?></td>
                <td ><?php echo StockName($StockId); ?></td>
                <td ><?php echo dteconvert($DateMvt); ?></td>
                <td ><?php echo $QtyIn; ?></td>
                <td ><?php echo $QtyOut; ?></td>
                <td ><?php echo PackagingInfo($Packaging); ?></td>
                <td ><?php echo DepartmentName($From); ?></td>
                <td ><?php echo DepartmentName($To); ?></td>

              </tr>
            <?php
              $count++;
            }
            ?>
        </table>
      </td>
    </tr>
  <?php
  }
  ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>