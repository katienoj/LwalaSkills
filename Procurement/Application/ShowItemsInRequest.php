<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$StockItems=$_REQUEST['StockItems'];


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="500" border="0" bgcolor="#E4E4E4" class="formborder">
   <tr>
    <td colspan="4"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop">Items in Internal Request</td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
  <tr><td>
  <table width="100%" border="0">
  <thead>
  <tr>
    <td class="heading">Item</td>
	<td class="heading">Packaging</td>
    <td class="heading">Quantity</td>
    <td class="heading">Package Price </td>
    <td class="heading">Total</td>
  </tr>
  </thead>
  <tbody style="width:100%;max-height:300px; height:300px; overflow-x:hidden;overflow-y:auto;">
  <?php 
  $count=0;
  $StockItemDetails=explode(':',$StockItems);
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

   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
    <td ><?php echo StockName($StockItem); ?></td>
	<td ><?php echo $PackagingInfo; ?></td>
    <td ><?php echo $Qty; ?></td>
    <td ><?php echo $Price; ?></td>
    <td ><?php echo $Total; ?></td>
  </tr>
  <?php
  $count++;
  }
  }
  ?>
  </tbody>
  </table>
  </td>
  </tr>
</table>
