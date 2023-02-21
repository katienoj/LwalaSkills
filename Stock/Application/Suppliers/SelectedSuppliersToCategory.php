<?php
require_once '../../../Main/Config/db_conn.php';
require_once '../../includes/StockFunctions.php';
$CatId = $_REQUEST['CatId'];
$sql = "SELECT * FROM SuppliersTable WHERE del is Null OR del=0 ORDER BY Id DESC";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Suppliers attached to the <?php echo CatName($CatId); ?> category </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
  $Selected = 0;
  $TheSQL = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  while ($rec = mysqli_fetch_array($TheSQL)) {
    $Id = $rec['Id'];
    $Names = $rec['SupplierNames'];
    $prevSelected = SupplierPrevSelected($Id, $CatId);
    if ($prevSelected == 1) {
      $Selected += 1;
    }
  }
  $Selected;
  if ($Selected > 0) {
  ?>
    <tr>
      <td>
        <table width="100%" border="0">
          <thead>

            <tr>
              <td ><input type="checkbox" name="checkbox" value="SupplierCheck" onClick="SelectSuppliers()"></td>
              <td >Supplier</td>
              <td >Phy Address</td>
              <td >Post Address</td>
              <td >Telephone</td>
            </tr>
          </thead>
          <tbody style="width:100%;max-height:300px;overflow-x:hidden;overflow-y:auto;">
            <?php
            $count = 0;
            while ($recs = mysqli_fetch_array($result)) {
              $Id = $recs['Id'];
              $Names = $recs['SupplierNames'];
              $PhyAddress = $recs['PhyAddress'];
              $PostAddress = $recs['PostAddress'];
              $Phone = $recs['Phone'];

              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
              $prevSelected = SupplierPrevSelected($Id, $CatId);
              if ($prevSelected == 0) {
              } else {
            ?>
                <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                  <td ><input type="checkbox" name="SupplierNo" id="SupplierNo" value="<?php echo $Id; ?>"></td>
                  <td ><?php echo $Names; ?></td>
                  <td ><?php echo $PhyAddress; ?></td>
                  <td ><?php echo $PostAddress; ?></td>
                  <td ><?php echo $Phone; ?></td>
                </tr>
            <?php
              }
              $count++;
            }
            ?>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center"><input class='btn btn-warning' type="button" name="inputButton" id='inputButton' value="Remove Suppliers" onclick="RemoveSuppliersFromCategory()" />
      </td>
    </tr>
  <?php
  } else {
    echo "No suppliers selected to service this category";
  }
  ?>
</table>