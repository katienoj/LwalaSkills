<?php
require_once '../../../Main/Config/db_conn.php';
$sql = "SELECT * FROM StockUpdates ORDER BY StockLastUpdate DESC LIMIT 50";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">STOCK UPDATE HISTORY</td>
	</tr>
</table>
<table width="100%" border="0">
  <?php
  //display product fields in list
  //echo mysqli_num_rows($result);
  if (mysqli_num_rows($result) == 0) {
      ?>
    <tr>
      <td  colspan="9" align="center">There are currently no updates to be viewed</td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table width="100%" border="0" id="stockupdatehistory">
  <thead>
    <tr>
      <th ><input class="form-control" type="checkbox" name="CheckUpdate" id="CheckUpdate" value="" onclick=""></th>
      <th >Update Id</th>
      <th >Stock Name</th>
      <th >Qty Before</th>
      <th >Qty After</th>
      <th >Price Before</th>
      <th >Price After</th>
      <th >Date Updated</th>
      <th >Updated By</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th ><input class="form-control" type="checkbox" name="CheckUpdate" id="CheckUpdate" value="" onclick=""></th>
      <th >Update Id</th>
      <th >Stock Name</th>
      <th >Qty Before</th>
      <th >Qty After</th>
      <th >Price Before</th>
      <th >Price After</th>
      <th >Date Updated</th>
      <th >Updated By</th>
    </tr>
  </tfoot>
  <tbody>
    <?php
    $count = 0;
      while (list($Id, $StockName, $QtyAfterUpdate, $MaxReorder, $OpeningStock, $ExpiryDate, $Barcode, $StockLastUpdate, $DefaultPackaging, $PriceAfterUpdate, $UserId, $InitialStock, $InitialPrice) = mysqli_fetch_row($result)) {
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
      <tr>
        <td ><input class="form-control" type="checkbox" name="Id" id="Id" value="<?php echo $Id; ?>"></td>
        <td ><?php echo $Id; ?></td>
        <td ><?php echo $StockName; ?></td>
        <td ><?php echo $InitialStock; ?></td>
        <td ><?php echo $QtyAfterUpdate; ?></td>
        <td ><?php echo $InitialPrice; ?></td>
        <td ><?php echo $PriceAfterUpdate; ?></td>
        <td ><?php echo $StockLastUpdate; ?></td>
        <td ><?php
          $Sql = "SELECT EmployeeId FROM UsersTable WHERE UserId='$UserId'";
          $Res = mysqli_query($conn, $Sql) or die("Could not get Package name" . mysqli_error($conn));
          while ($Rows = mysqli_fetch_array($Res)) {
              $EmployeeId = $Rows['EmployeeId'];
          }
          $Sql2 = "SELECT EmployeeName FROM EmployeeTable WHERE Id='$EmployeeId'";
          $Res2 = mysqli_query($conn, $Sql2) or die("Could not get Package name" . mysqli_error($conn));
          while ($Rows2 = mysqli_fetch_array($Res2)) {
              $name = $Rows2['EmployeeName'];
          }
          echo $name; ?></td>
      </tr>
    <?php
      $count++;
      } ?>
  </tbody>
<?php
  }
?>
</table>