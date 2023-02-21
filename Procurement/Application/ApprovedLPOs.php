<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <?php
$sql=mysqli_query($conn, "SELECT * FROM StockLPO WHERE LPOApproval='1' ORDER BY DateOfLPO DESC") or die(mysqli_error($conn));
if (mysqli_num_rows($sql)==0) {
    ?>
  <tr>
    <td  colspan="5" align="center">Sorry, Lwala is not aware of any made but Stock LPOs so far</td>
  </tr>
  <?php
} else {
    ?>
  <thead>
    <tr>
      <td class="heading"><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></td>
      <td class="heading">LPO ID</td>
      <td class="heading">Supplier</td>
      <td class="heading">Date made </td>
      <td class="heading">Stock Items </td>
      <td class="heading">LPO Total </td>
    </tr>
  </thead>
  <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
    <?php
    $count = 0;
    while ($recs = mysqli_fetch_array($sql)) {
        $Id = $recs['Id'];
        $DateOfLPO = $recs['DateOfLPO'];
        $SupplierId = $recs['SupplierId'];
        if ($count % 2 == 0) {
            $bg = '#E1E1FF';
        } else {
            $bg = '#EAEAEA';
        } ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
        <td ><input class="form-control" type="checkbox" name="LPOId" id="LPOId" value="<?php echo $Id; ?>"></td>
        <td ><?php echo $Id; ?></td>
        <td ><?php echo SupplierNames($SupplierId); ?></td>
        <td ><?php echo dteconvert($DateOfLPO); ?></td>
        <td ><a href="#" onclick="ShowLPOItems('<?php echo $Id; ?>')" style="text-decoration:none;">Requested Stock</a></td>
        <td colspan="3" ><?php echo LPOTotal($Id); ?></td>
      </tr>
      <?php
  $count++;
    } ?>
  </tbody>
<?php
}
?>
</table>