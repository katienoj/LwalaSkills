<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$PackageId = $_REQUEST['PackageId'];
$StockItems = $_REQUEST['StockItems'];

?>
<table width="100%" border="0" bgColor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Items linked to the <?php echo PackageName($PackageId); ?> Packaging </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>

      <div id="LinkedItems">
        <table border="0">
          <thead>
            <tr>
              <td >StockId</td>
              <td >Stock Name </td>
              <td >Category</td>
              <td >Opening Stock </td>
              <td >Min Stock </td>
              <td >Max Stock </td>
              <td >Min Re order </td>
              <td >Max Re order </td>
            </tr>
          </thead>
          <tbody style="width:100%; height:150px; max-height:150px; overflow-x:hidden;overflow-y:auto;">
            <?php
            $count = 0;
            $StockItems = explode(':', $StockItems);
            foreach ($StockItems as $StockItem) {
              if ($StockItem != '') {
                $sql = "SELECT * FROM StockTable WHERE Id='$StockItem' AND del=0 ORDER BY Id DESC";

                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                while (list($Id, $StockName, $quantity, $VAT, $cat, $UnitId, $specs, $StockImage, $CatImage, $StockDate, $StockLastUpdate, $del, $minStock, $minReorder, $maxReorder, $maxStock, $OpeningStock, $Barcode, $Price) = mysqli_fetch_row($result)) {

                  if ($count % 2 == 0) {
                    $bg = '#E1E1FF';
                  } else {
                    $bg = '#EAEAEA';
                  }
            ?>
                  <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">

                    <td ><?php echo $Id; ?></td>
                    <td ><?php echo $StockName; ?></td>
                    <td ><?php echo CatName($cat); ?></td>
                    <td ><?php echo $OpeningStock; ?></td>
                    <td ><?php echo $minStock; ?></td>
                    <td ><?php echo $maxStock; ?></td>
                    <td ><?php echo $minReorder; ?></td>
                    <td ><?php echo $maxReorder; ?></td>

                  </tr>
            <?php
                }
                $count++;
              }
            }
            ?>
          </tbody>
        </table>






      </div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>