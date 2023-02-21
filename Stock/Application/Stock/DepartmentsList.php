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
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Link <?php echo CatName($CatId); ?> to Departments </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <thead>
          <tr>
            <td width="4%" ><input class="form-control" name="CheckDepartments" type="checkbox" id="CheckDepartments" value="checkbox" onclick="CheckDepartments()" /></td>
            <td width="96%" >Department</td>
          </tr>
        </thead>
        <tbody style="height:200px; max-height:200px; overflow-x:hidden; overflow-y:auto;">
          <?php
          $count = 0;
          $sql = mysqli_query($conn, "SELECT * FROM DepartmentTable ORDER BY DepartmentId DESC") or die(mysqli_error($conn));

          while (list($DepartmentId, $DepartmentName) = mysqli_fetch_row($sql)) {
            $PrevSelected = DepartmentPrevSelected($DepartmentId, $CatId);
            if ($PrevSelected > 0) {
            } else {
              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
          ?>
              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                <td ><input class="form-control" name="DeptId" type="checkbox" id="DeptId" value="<?php echo $DepartmentId; ?>" /></td>
                <td ><?php echo $DepartmentName; ?></td>
              </tr>
          <?php
              $count++;
            }
          }
          ?>
        </tbody>
        <?php

        ?>
      </table>
    </td>
  </tr>
  <tr>
    <td><input class="form-control" type="hidden" name="CatNo" id="CatNo" value="<?php echo $CatId; ?>" />
      <input class="btn btn-warning" type="button" name="Button" value="Link Category to Departments" style="float:right;" onclick="LinkCatToDepts()" />
    </td>
  </tr>
</table>