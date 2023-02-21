<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$CatId = $_REQUEST['CatId'];
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="400" border="0" bgColor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_2', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);"><?php echo CatName($CatId); ?> Linked to Departments </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_2()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <thead>
          <tr>
            <td width="4%" ></td>
            <td width="96%" >Department</td>
          </tr>
        </thead>
        <tbody style="height:200px; max-height:200px; overflow-x:hidden; overflow-y:auto;">
          <?php
          $count = 0;
          $sql = mysqli_query($conn, "SELECT DepartmentId FROM DepartmentCategoryLink WHERE CatId='$CatId' ORDER BY DepartmentId DESC") or die(mysqli_error($conn));

          while (list($DepartmentId) = mysqli_fetch_row($sql)) {
            if ($count % 2 == 0) {
              $bg = '#E1E1FF';
            } else {
              $bg = '#EAEAEA';
            }
          ?>
            <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
              <td ><?php echo $count + 1; ?></td>
              <td ><?php echo DepartmentName($DepartmentId); ?></td>
            </tr>
          <?php
            $count++;
          }
          ?>
        </tbody>
        <?php

        ?>
      </table>
    </td>
  </tr>
  <tr>
    <td><input type="hidden" name="CatNo" id="CatNo" value="<?php echo $CatId; ?>" /></td>
  </tr>
</table>