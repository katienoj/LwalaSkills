<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">

  <?
$sql=mysqli_query($conn, "SELECT * FROM StockLPO WHERE Consolidated is Null ORDER BY Id ASC") or die(mysqli_error($conn));

if(mysqli_num_rows($sql)==0)
{
?>
  <tr>
    <td  colspan="5" align="center">Sorry, Lwala is not aware of any made but Stock LPOs so far</td>
  </tr>

  <?
}
else
{
?>
  <thead>
    <tr>
      <td ><input class="form-control" type="checkbox" name="CheckRequests" id="CheckRequests"></td>
      <td >Department</td>
      <td >Supplier</td>
      <td >Date made </td>
      <td >Date Expected </td>
      <td >Stock Items </td>
      <td >Total for Request </td>

    </tr>
  </thead>
  <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
    <?php
    $count = 0;
    while ($recs = mysqli_fetch_array($sql)) {
      $Id = $recs['Id'];
      $DepartmentId = $recs['DepartmentId'];
      $DateOfRequest = $recs['DateofRequest'];
      $DateExpected = $recs['DateExpected'];
      $StockDetails = $recs['StockDetails'];
      $SupplierId = $recs['SupplierId'];
      $Total = $recs['RequestTotal'];
      $SupplierDetails = explode(':', SupplierDetails($SupplierId));
      if ($Total == '0.00') {
        $Total = RequestTotal($StockDetails);
      }



      if ($count % 2 == 0) {
        $bg = '#E1E1FF';
      } else {
        $bg = '#EAEAEA';
      }
    ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
        <td ><input class="form-control" type="checkbox" name="LPOId" id="LPOId" value="<?php echo $Id; ?>"></td>
        <td ><?php echo DepartmentName($DepartmentId); ?></td>
        <td ><?php echo $SupplierDetails[0]; ?></td>
        <td ><?php echo dteconvert($DateOfRequest); ?></td>
        <td ><?php echo dteconvert($DateExpected); ?></td>
        <td ><a href="#" onclick="ShowTheItems('<?php echo $StockDetails; ?>')" style="text-decoration:none;">Requested Stock</a></td>
        <td ><?php echo $Total; ?></td>

      </tr>
      <?
  $count++;
  }
  ?>
  </tbody>
<?php
    }
?>

</table>