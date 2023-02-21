<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
<table border="0" width="100%">
  <?php
  $sqlTempPRQ = mysqli_query($conn, "SELECT * FROM ProcurementTable WHERE ApprovalStatus='1' AND (ProcessingStatus is Null OR ProcessingStatus='') order by Id DESC") or die(mysqli_error($conn));
  if (mysqli_num_rows($sqlTempPRQ) == 0) {
      ?>
    <tr>
      <td  align="center">Sorry.Lwala is not aware of any new unapproved procurement requests made </td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table border="0" width="100%" id="service_table">
  <thead>
    <tr>
      <th width="3%" class="heading"><input class="form-control" type="checkbox" name="CheckPRQs" id="CheckPRQs" onclick="CheckPRQs()" /> </th>
      <th width="6%" class="heading">PRQ Id</th>
      <th width="6%" class="heading">IRQ Id</th>
      <th width="6%" class="heading">Category</th>
      <th width="6%" class="heading">Date Created</th>
      <th width="6%" class="heading">Items in Request</th>
      <th width="12%" class="heading">Suppliers</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th width="3%" class="heading"><input class="form-control" type="checkbox" name="CheckPRQs" id="CheckPRQs" onclick="CheckPRQs()" /> </th>
      <th width="6%" class="heading">PRQ Id</th>
      <th width="6%" class="heading">IRQ Id</th>
      <th width="6%" class="heading">Category</th>
      <th width="6%" class="heading">Date Created</th>
      <th width="6%" class="heading">Items in Request</th>
      <th width="12%" class="heading">Suppliers</th>
    </tr>
  </tfoot>
  <tbody style="width:100%;height:730px;max-height:730px; overflow-x:hidden; overflow-y:auto;">
    <?php
    $count = 0;
      while ($recs = mysqli_fetch_array($sqlTempPRQ)) {
          $CatId = $recs['CatId'];
          $DateCreated = dteconvert($recs['DateCreated']);
          $RequestId = $recs['RequestId'];
          $Id = $recs['Id'];
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'" valign="top">
        <td > <input class="form-control" type="checkbox" name="PRQId" id="PRQId" value="<?php echo $Id; ?>" /></td>
        <td width="6%" ><?php echo $Id; ?></td>
        <td ><?php echo $RequestId; ?></td>
        <td ><?php echo CatName($CatId); ?></td>
        <td ><?php echo $DateCreated; ?></td>
        <td ><a href="#" onclick="ShowItemsInProcurement('<?php echo $Id; ?>')">The Items</a></td>
        <td ><a href='#' onclick='CheckOutSuppliers(<?php echo $CatId; ?>)'>Suppliers list</a></td>
      </tr>
    <?php
      $count++;
      } ?>
  <?php
  }
  ?>
  </tbody>
</table>