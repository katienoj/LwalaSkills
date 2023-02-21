<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$SelectedLPO=$_REQUEST['SelectedLPO'];
$HosptalDetails=explode(':',HospitalDetails());
$sql=mysqli_query($conn, "SELECT * FROM StockLPO WHERE Id='".$_REQUEST['SelectedLPO']."'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);

$SupplierId=$result['SupplierId'];
$StockDetails=$result['StockDetails'];
$SupplierDetails=explode(':',SupplierDetails($SupplierId));
$RequestTotal=0;
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">

<table width="100%" border="0">
  <tr>
    <td colspan="5" align="center"><img src="../Main/Layout/Images/<?php echo $HosptalDetails[8]; ?>"> </td>
  </tr>
  <tr>
    <td colspan="5" align="center" ><?php echo "<strong>".$HosptalDetails[0]."</strong><br>".$HosptalDetails[1].",".$HosptalDetails[2]."<br>".$HosptalDetails[4].",".$HosptalDetails[5]."<br>".$HosptalDetails[6]."<br>".$HosptalDetails[7]; ?></td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="contentTitle">Stock LPO </td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><table width="100%" border="1" class="showModuleName" bordercolor="#BFBFFF" bordercolorlight="#0000FF">
  <thead>
  <tr>
    <td width="13%" >Item</td>
	<td width="23%" >Packaging</td>
    <td width="20%" >Quantity</td>
    <td width="24%" >Package Price </td>
    <td width="20%" >Total</td>
  </tr>
  </thead>
  <tbody style="width:100%;max-height:300px; height:300px; overflow-x:hidden;overflow-y:auto;">
  <?php 
  $count=0;
  //echo $StockDetails;
  $StockItemDetails=explode(':',$StockDetails);
  foreach($StockItemDetails as $ItemDetails)
  {
  if($ItemDetails!='')
  {
  $TheDetails=explode('@',$ItemDetails);
  $Packaging=$TheDetails[1];
  $PackagingInfo=PackagingInfo($Packaging);
  $OtherDetails=explode('*',$TheDetails[0]);
  $StockItem=$OtherDetails[0];
  $Qty=$OtherDetails[1];
  $Price=PackagePrice($StockItem,$Packaging);
  $Total=$Qty * $Price;
  $RequestTotal+=$Total;
   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr>
    <td class="printable_fields"><?php echo StockName($StockItem); ?></td>
	<td class="printable_fields"><?php echo $PackagingInfo; ?></td>
    <td class="printable_fields"><?php echo  number_format($Qty); ?></td>
    <td class="printable_fields"><?php echo  number_format($Price,2); ?></td>
    <td class="printable_fields"><?php echo number_format($Total,2); ?></td>
  </tr>
  <?php
  $count++;
  }
  }
  ?>
  </tbody>
  </table></td>
  </tr>
  <tr>
  <td width="8%">&nbsp;</td>
  <td width="11%">&nbsp;</td>
  <td width="11%">&nbsp;</td>
  <td width="49%" align="right" class="td_bottom">LPO Total </td>
  <td width="21%"><?php echo number_format($RequestTotal,2); ?></td>
  </tr>
</table>
