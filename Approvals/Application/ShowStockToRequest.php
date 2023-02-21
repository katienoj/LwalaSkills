<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>

<table width="500" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="3">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Request Stock</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="align-content: center;">
      <select style="align-content: center;" class="form-control" name="DeptName" id="DeptName" >
        <option style="align-content: center;" class="form-control" value="">Please select the department to request stock from
</option>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM DepartmentTable ORDER BY DepartmentName ASC") or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_array($sql)) {
          $Id = $recs['DepartmentId'];
          $Name = $recs['DepartmentName'];
        ?>
          <option style="align-content: center;" class="form-control" value="<?php echo $Id; ?>"><?php echo $Name; ?></option>
        <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <div id="ShowStockToRequest" style="width:100%; max-height:300px; height:300px;"></div>
    </td>
  </tr>
  <tr>
    <td width="88">Date expected</td>
    <td width="353"><input class="form-control" name="DateExpected" type="text" id="DateExpected" onclick='scwShow(this,event);' onfocus='scwShow(this,event);' readonly="true" /></td>
    <td width="45">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><input class="btn btn-info btn-block" type="button" name="Button" value="Send Request" style="float:right;" onclick="getStockRequestAmts()"></td>
  </tr>
</table>