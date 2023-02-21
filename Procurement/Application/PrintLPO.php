<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$SelectedLPOs=explode(':', $_REQUEST['SelectedLPOs']);
$HosptalDetails=explode(':', HospitalDetails());
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<?php
foreach ($SelectedLPOs as $LPO) {
    if ($LPO!='') {
        $sql=mysqli_query($conn, "SELECT * FROM StockLPO WHERE Id='$LPO'") or die(mysqli_error($conn));
        $result=mysqli_fetch_assoc($sql);
        $SupplierId=$result['SupplierId'];
        $SupplierDetails=explode(':', SupplierDetails($SupplierId));
        $RequestTotal=0;
        $HospitalDetails=explode(':', HospitalDetails()); ?>
  <p style="page-break-before: always">
<table width="100%" border="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="244" rowspan="2" align="center"><table width="98%" border="0">
      <tr>
        <td align="center"><img src="../../Main/Layout/images/<?php echo $HospitalDetails[8]; ?>" width="100" height="100" /></td>
      </tr>
      <tr>
        <td class="contentTitle"><div align="center"><?php echo $HospitalDetails[0]; ?></div></td>
      </tr>
      <tr>
        <td>
        <?php echo "<b>Postal Address :</b> ".$HospitalDetails[1].",
        <br><b> Tel: </b>".$HospitalDetails[4]."<br><b>Email:</b>".$HospitalDetails[7]." 
        <b>Web:</b>".$HospitalDetails[6]; ?></td>
      </tr>
    </table></td>
    <td width="590" height="51" align="center">&nbsp;</td>
    <td width="249" rowspan="2" align="center"><table width="100%" border="0">
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
    <td height="107" align="center" class="contentTitle">Local Purchase Order</td>
  </tr>
  <tr>
    <td height="26" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="85" colspan="3"><table width="100%" border="1" class="showModuleName" bordercolor="#BFBFFF" bordercolorlight="#0000FF">
  <thead>
  <tr>
    <td width="3%" class="heading">&nbsp;</td>
	<td width="16%" class="heading">Item</td>
	<td width="25%" class="heading">Packaging</td>
    <td width="12%" class="heading">Quantity</td>
    <td width="24%" class="heading">Package Price </td>
    <td width="20%" class="heading">Total</td>
  </tr>
  </thead>
  <tbody>
  <?php
  $count=0;
        //echo $StockDetails;
        $Total=0;
        // echo "SELECT * FROM LPOStockDetails WHERE LPOId='$LPO'";
        $sqlLPOStock=mysqli_query($conn, "SELECT * FROM LPOStockDetails WHERE LPOId='$LPO'") or die(mysqli_error($conn));
        while ($recs=mysqli_fetch_array($sqlLPOStock)) {
            $StockItem=$recs['StockId'];
            $Packaging=$recs['Packaging'];
            $Qty=$recs['Qty'];
            $Price=$recs['Price'];
            $Total=$Price;
            $RequestTotal+=$Total;
            if ($count%2 == 0) {
                $bg = '#E1E1FF';
            } else {
                $bg = '#EAEAEA';
            } ?>
    <tr>
    <td class="printable_fields"><?php echo $count+1; ?></td>
	<td class="printable_fields"><?php echo StockName($StockItem); ?></td>
	<td class="printable_fields"><?php echo PackagingInfo($Packaging); ?></td>
    <td class="printable_fields"><?php echo  number_format($Qty); ?></td>
    <td class="printable_fields"><?php echo  number_format($Price, 2); ?></td>
    <td class="printable_fields"><?php echo number_format($Total, 2); ?>
      <div align="left"></div></td>
  </tr>
  <?php
  $count++;
        } ?>
   <tr>
      <td colspan="4" >&nbsp;</td>
      <td><div align="right"><span class="td1">LPO</span> <span class="td1">Total </span></div></td>
      <td><?php echo number_format($Total, 2); ?></td>
    </tr>
  <?php
    } ?>
  </tbody>
  </table></td>
  </tr>
  <tr>
  <td height="26" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td height="26" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  <td height="26" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
</table>
</p>
<?php
}
?>