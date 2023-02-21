<?php
require_once "../../Main/Config/db_conn.php";
$selectedRequests = explode(':', $_REQUEST['selectedRequests']);
$UserId = $_REQUEST['UserId'];
$UserDepartment = GetUserDepartment($UserId);
$TheStockDetails = '';
$RequestId = '';

foreach ($selectedRequests as $SelectedRequest) {
  if ($SelectedRequest != '') {
    // echo "SELECT StockDetails FROM InternalStockRequests WHERE Id='$SelectedRequest' ";
    $sqlSelected = mysqli_query($conn, "SELECT StockDetails FROM InternalStockRequests WHERE Id='$SelectedRequest'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sqlSelected);
    $result['StockDetails'];
    $StockDetails = $result['StockDetails'];
    $TheStockDetails = $StockDetails;
    $RequestId = $SelectedRequest;
  }
}

?>
<table width="500" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Action after Approval<?php echo $selectedRequests; ?> </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>

      <?php
      if (1 > 0) {
      ?>
        Select Action
        <select name="ActionApproval" id="ActionApproval" class="form-control">
          <option class="form-control" value="1">Service Internal Requests for the items</option>
          <option class="form-control" value="2">Generate Procurement Requests for the Items</option>
        </select>
        <input class="form-control" type="hidden" name="RequestNumber" id="RequestNumber" value="<?php echo $RequestId; ?>" />
        <input class="form-control" type="hidden" name="TheStockDetails" id="TheStockDetails" value="<?php echo  $TheStockDetails; ?>" />
        <input class="btn btn-info btn-block" type="button" name="Button" value="Proceed" onclick="ProceedWithActionAfterApproval('<?php echo $selectedRequests; ?>')">
      <?php
      } else {
      ?>
        Select Action
        <select name="ActionApproval" id="ActionApproval" class="form-control">
          <option class="form-control" value="1">Service Internal Requests for the items</option>
          <option class="form-control" value="2">Generate Procurement Requests for the Items</option>
        </select>
        <input class="form-control" type="hidden" name="RequestNumber" id="RequestNumber" value="<?php echo $RequestId; ?>" />
        <input class="form-control" type="hidden" name="TheStockDetails" id="TheStockDetails" value="<?php echo  $TheStockDetails; ?>" />
        <input class="btn btn-info btn-block" type="button" name="Button" value="Proceed" onclick="ProceedWithActionAfterApproval('<?php echo $selectedRequests; ?>')">
      <?php
      }
      ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>