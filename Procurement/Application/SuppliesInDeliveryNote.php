<?php 
include "../../Main/Config/db_conn.php";
require_once '../includes/ProcurementFunctions.php';

$DeliveryNote=$_REQUEST['DeliveryNote'];
$strSQL="SELECT * FROM LPOService WHERE DeliveryNote='$DeliveryNote'";

$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));




?>

<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0">
<thead>
  <tr>
    <th class="heading" scope="col"><input class="form-control" type="checkbox"  name="DeliverySupplyCheck" id="DeliverySupplyCheck" onclick="DeliverySupplyCheck()" /></th>
    <th class="heading" scope="col">Stock Name </th>
    <th class="heading" scope="col">Qty</th>
    <th class="heading" scope="col">Price</th>
    <th class="heading" scope="col">Total</th>
  </tr>
  </thead>
  <tbody style="width:100%;height:100px;max-height:100px; overflow-x:hidden; overflow-y:auto;">
  <?php 
  $count=0;
  while($recs=mysqli_fetch_array($sql))
  {
  $LPOId=$recs['LPOId'];
$StockId=$recs['StockId'];
  $Id=$recs['Id'];
  $BroughtInQty=SupplyBroughtInQty($StockId,$LPOId);
  $PriceDetails=explode(':',LPOPriceDetails($StockId,$LPOId));
  $ThePrice=$PriceDetails[1];
  $PackageName=$PackageName[0];
  $Total=$ThePrice * $BroughtInQty;
   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr>
    <td  ><input class="form-control" type="checkbox" name="SupplyId" id="SupplyId" value="<?php echo $Id; ?>" /></td>
    <td ><?php echo StockName($StockId); ?></td>
    <td ><?php echo $BroughtInQty; ?>&nbsp; <?php echo $PackageName; ?></td>
    <td ><?php echo CurrencyCode(1); ?> &nbsp;  <?php echo number_format($ThePrice,2); ?></td>
    <td ><?php echo CurrencyCode(1); ?> &nbsp; <?php echo  number_format($Total,2); ?></td>
  </tr>
  <?php
  $count++;
  }
  ?>
  </tbody>
</table>