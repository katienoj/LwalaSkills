<?php
include "../Config/db_conn.php";
global $conn;
$PatId = $_REQUEST['PatId'];
$PatientNames = explode(' ', PatNames($PatId));
$FirstName = $PatientNames[0];
$LastName = $PatientNames[1];
?><table width="700" border="0" bgcolor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Charge <?php echo $FirstName . " " . $LastName; ?> </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<table width="700" border="0" bgcolor="#E4E4E4">


  <td>
    <tr>
      <td align="center">
        <select align="center" name="DepartmentList" id="DepartmentList" onclick="ShowDepartmentServices()" class="form-control">
          <option class="form-control" value="" align="center">SELECT CHARGING DEPARTMENT</option>
          <?php
          $sql = mysqli_query($conn, "SELECT DepartmentId,DepartmentName FROM DepartmentTable ORDER BY DepartmentName DESC") or die(mysqli_error($conn));
          while ($recs = mysqli_fetch_array($sql)) {
            $dept = $recs['DepartmentName'];
            $Id = $recs['DepartmentId'];

          ?>
            <option class="form-control" value="<?php echo $Id; ?>"><?php echo $dept; ?></option>
          <?php
          }
          ?>
        </select>
      </td>
    </tr>

  </td>

  <td>
    <tr>
      <td>
        <div id="ShowDeptServices" style="width:100%; height:0px; max-height:0px;"></div>
      </td>
    </tr>
    <tr>
      <td>CUMULATIVE TOTAL>>><input type="text" name="totalForService" id="totalForService" readonly class="form-control" />
        <input type="button" class="btn btn-danger btn-block" name="Button" value="Add Selected Service (s) To Draft Charge Sheet" class="btn btn-info" onclick="SaveSelectedServices()" />
        <input type="hidden" id="PatientNo" name="PatientNo" value="<?php echo $PatId; ?>" />
      </td>
    </tr>

    <tr>
      <td>
        <div id="showChargeSheet">
        </div>
      </td>
    </tr>


  </td>

</table>