<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>

<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0">
  <tr>
    <td colspan="6">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="83%" class="formtop">Search Internal Requisitions </td>
          <td width="17%" class="formtop"> <input class="form-control" type="image" src="../Main/Layout/images/UpIcon.gif" width="16" height="16" style="float:right;" onclick="inter=setInterval('hideSearchDiv()',3); return false;" /><a href="#" onclick="inter=setInterval('hideSearchDiv()',3); return false;" style="cursor:hand; text-decoration:none; float:right; color:#FFFFFF">Hide</a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="11%">
      <div align="right">Department</div>
    </td>
    <td width="21%">
      <select name="Department"  id="Department">
        <option value="">--Please Select--</option>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM DepartmentTable ORDER BY DepartmentName DESC") or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_assoc($sql)) {
          $Id = $recs['DepartmentId'];
          $DepartmentName = $recs['DepartmentName'];
        ?>
          <option value="<?php echo $Id; ?>"><?php echo $DepartmentName; ?></option>
        <?php
        }
        ?>
      </select>
    </td>
    <td width="13%">
      <div align="right">Date of Request </div>
    </td>
    <td width="21%"><select name="RequestSelect"  id="RequestSelect">
        <option value="=">=</option>
        <option value="&gt;=">&gt;=</option>
        <option value="&lt;=">&lt;=</option>
      </select><input class="form-control" name="DateOfRequest" type="text" id="DateOfRequest" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' readonly /></td>
    <td width="11%">
      <div align="right">Date Expected </div>
    </td>
    <td width="23%"><select name="ExpectSelect"  id="ExpectSelect">
        <option value="=">=</option>
        <option value="&gt;=">&gt;=</option>
        <option value="&lt;=">&lt;=</option>
      </select>
      <input class="form-control" name="DateExpected" type="text" id="DateExpected" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' readonly />
    </td>
  </tr>
  <tr>
    <td>
      <div align="right">Request Total </div>
    </td>
    <td><select name="TotalSelect"  id="TotalSelect">
        <option value="=">=</option>
        <option value="&gt;=">&gt;=</option>
        <option value="&lt;=">&lt;=</option>
      </select>
      <input class="form-control" name="RequestTotal" type="text" id="RequestTotal">
    </td>
    <td>
      <div align="right">Stock Item </div>
    </td>
    <td><input class="form-control" name="ItemName" type="text" id="ItemName" style='width:235px;' onkeyup="GetItemsHint()" />
      <div id="hint" style=" display:none; width:400px; position:absolute; z-index:10000;"></div>
      <input class="form-control" type="hidden" name="ItemId" id="ItemId" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="btn btn-info" type="button" name="Button" value="Search" style="float:right" onclick="SendInternalStockRequestSearch()"></td>
  </tr>
</table>