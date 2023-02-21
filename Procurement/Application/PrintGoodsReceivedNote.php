<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$DeliveryNote=$_REQUEST['DeliveryNote'];
$HospitalDetails=explode(':', HospitalDetails());
$DeliverySupplier=DeliverySupplier($DeliveryNote);
$SupplierDetails=explode(':', SupplierDetails($DeliverySupplier));
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<?php
  ?>
  <p style="page-break-before: always">
<table width="100%" border="0">
  <tr>
    <td colspan="3" rowspan="3" align="center"><table width="100%" border="0">
      <tr>
        <td align="center"><img src="../../Main/Layout/images/<?php echo $HospitalDetails[8]; ?>" width="100" height="100" /></td>
      </tr>
      <tr>
        <td class="contentTitle"><div align="center"><?php echo $HospitalDetails[0]; ?></div></td>
      </tr>
      <tr>
        <td><?php echo "<b>Postal Address :</b> ".$HospitalDetails[1].",<br><b> Tel: </b>".$HospitalDetails[4]."<br><b>Email :</b> ".$HospitalDetails[7]." <b>Web:</b>".$HospitalDetails[6]; ?></td>
      </tr>
    </table></td>
    <td align="center">&nbsp;</td>
    <td colspan="2" rowspan="3" align="center"><table width="100%" border="0">
      <tr>
        <td align="center"><img src="../../Stock/Application/Suppliers/SupplierLogos/<?php echo $SupplierDetails[1]; ?>" width="100" height="100" /></td>
      </tr>
      <tr>
        <td class="contentTitle"><div align="center"><?php echo $SupplierDetails[0]; ?></div></td>
      </tr>
      <tr>
        <td><?php echo "<b>Postal Address : </b>".$SupplierDetails[7].",<br><b> Tel: </b>".$SupplierDetails[3]."<br><b>Email : </b>".$SupplierDetails[2]."<br><b>Web:</b>".$SupplierDetails[4]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td height="57" align="center" class="contentTitle">Delivery Note </td>
  </tr>
  <tr>
    <td class="td_bottom">Delivery Note No:</td>
    <td colspan="2"><?php echo $DeliveryNote; ?></td>
    <td>&nbsp;</td>
    <td width="15%" class="td_bottom">Date</td>
    <td width="13%" class="td_bottom">sdfasdasdasd</td>
  </tr>
  <tr>
    <td colspan="6"><table width="100%" border="1" class="showModuleName" bordercolor="#BFBFFF" bordercolorlight="#0000FF">
  <thead>
  <tr>
    <td width="3%" class="heading">&nbsp;</td>
	<td width="16%" class="heading">Item</td>
	<td width="25%" class="heading">Packaging</td>
    <td width="12%" class="heading">Expected Quantity</td>
    <td width="24%" class="heading">Brought in Qty </td>
  </tr>
  </thead>
  <tbody>
  <?php
  $count=0;
  //echo $StockDetails;
  $Total=0;
 // echo "SELECT * FROM LPOStockDetails WHERE LPOId='$LPO'";
// echo "SELECT * FROM LPOService WHERE DeliveryNote='$DeliveryNote'";
  $sqlLPOStock=mysqli_query($conn, "SELECT * FROM LPOService WHERE DeliveryNote='$DeliveryNote'") or die(mysqli_error($conn));
  while ($recs=mysqli_fetch_array($sqlLPOStock)) {
      $StockItem=$recs['StockId'];
      $ExpectedQty=$recs['ExpectedQty'];
      $BroughtInQty=$recs['BroughtInQty'];
      $LPOId=$recs['LPOId'];
      $Packaging=LPOStockPackaging($LPOId);
      if ($count%2 == 0) {
          $bg = '#E1E1FF';
      } else {
          $bg = '#EAEAEA';
      } ?>
    <tr>
    <td class="printable_fields"><?php echo $count+1; ?></td>
	<td class="printable_fields"><?php echo StockName($StockItem); ?></td>
	<td class="printable_fields"><?php echo PackagingInfo($Packaging); ?></td>
    <td class="printable_fields"><?php echo  number_format($ExpectedQty); ?></td>
    <td class="printable_fields"><?php echo  number_format($BroughtInQty); ?></td>
  </tr>
  <?php
  $count++;
  }
  ?>
  </tbody>
  </table></td>
  </tr>
  <tr>
  <td width="14%">&nbsp;</td>
  <td width="5%">&nbsp;</td>
  <td width="11%">&nbsp;</td>
  <td width="42%" align="right" class="td_bottom">&nbsp;</td>
  <td colspan="2" align="right">&nbsp;</td>
  </tr>
</table>
</p>
<?php
?>