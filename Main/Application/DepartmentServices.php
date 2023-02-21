<?php
include "../Config/db_conn.php";
global $conn;
?>
<link href="../Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
    <tr>
      <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Registered Services</td>
      <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="0" height="0" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
    </tr>
  </table>

  <?php
  $DeptId = $_REQUEST['DeptId'];

  $sql = mysqli_query($conn, "SELECT * FROM HospitalServices WHERE Department='$DeptId' ORDER BY ServiceName ASC") or die(mysqli_error($conn));

  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td  colspan="3">Sorry,no registered services for the selected Department</td>

    </tr>
  <?php
  } else {
  ?>
</table>
<table width="100%" border="0" id="service_table2">

  <thead>
    <tr>
      <th ><input class="form-control" type="checkbox" id="check_services" name="check_services" class="form-control" /></th>
      <th >Service Name</th>
      <th >Quantity</th>
      <th >Service Cost (Ksh)</th>
    </tr>
  </thead>

  <tbody style="width:100%;height:120px; max-height:120px; overflow-x:hidden; overflow-y:auto;">
    <?php
    $count = 0;
    while ($recs = mysqli_fetch_array($sql)) {
      $Id = $recs['ServiceId'];
      $ServiceName = $recs['ServiceName'];
      $Amount = $recs['Amount'];
      if ($count % 2 == 0) {
        $bg = '#E1E1FF';
      } else {
        $bg = '#EAEAEA';
      }
    ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
        <td ><input class="form-control" type='checkbox' name='service_id' value='<?php echo $Id; ?>' id='service_id' onclick="GetServiceToBePaid()" /></td>
        <td ><?php echo $ServiceName; ?> </td>
        <td ><input class="form-control" type="text" name="Qty<?php echo $Id; ?>" id="Qty<?php echo $Id; ?>" value="1" onkeyup="calcTotalForService('<?php echo $Id; ?>')" size="4"></td>
        <td ><input class="form-control" type="text" name="Total<?php echo $Id; ?>" id="Total<?php echo $Id; ?>" value="<?php echo $Amount; ?>"><input class="form-control" type="hidden" name="Amt<?php echo $Id; ?>" id="Amt<?php echo $Id; ?>" value="<?php echo $Amount; ?>"></td>
      </tr>
    <?php
      $count++;
    }
    ?>
  </tbody>
<?php
  }
?>
</table>