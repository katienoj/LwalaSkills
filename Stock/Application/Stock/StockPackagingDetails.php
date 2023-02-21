<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';

$StockId = $_REQUEST['StockId'];
$sql = mysqli_query($conn, "SELECT * FROM StockPackaging WHERE StockId='$StockId'") or die(mysqli_error($conn));

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0">
  <?php

  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td  align="center" colspan="4">Sorry,Lwala is not aware of any packaging details for <?php echo StockName($StockId); ?></td>
    </tr>
  <?php
  } else {
  ?>
    <thead>
      <tr>
        <td width="6%" ><input class="form-control" type="checkbox" name="checkbox" value="CheckPackaging" /></td>
        <td width="32%" >Packaging</td>
        <td width="17%" >Qty in packaging </td>
        <td width="45%" >Packaging Type </td>
      </tr>
    </thead>
    <tbody style="width:100%; height:290px; max-height:290px; overflow-x:hidden; overflow-y:auto;">

      <?php
      $count = 0;
      while (list($Id, $StockId, $PackagingId, $Qty, $Price, $PackageTypeId, $PackageBarcode) = mysqli_fetch_row($sql)) {
        if ($count % 2 == 0) {
          $bg = '#E1E1FF';
        } else {
          $bg = '#EAEAEA';
        }
      ?>

        <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
          <td ><input class="form-control" type="checkbox" name="PackageId" id="PackageId" value="<?php echo $Id; ?>" onclick="LoadPackageDetailsForEdit('<?php echo $Id; ?>')" /></td>
          <td ><?php echo PackageName($PackagingId); ?></td>
          <td ><?php echo number_format($Qty); ?></td>
          <td ><?php echo PackageTypeName($PackageTypeId); ?></td>
        </tr>
      <?php
        $count++;
      }
      ?>
    </tbody>
</table>
<?php
  }

?>