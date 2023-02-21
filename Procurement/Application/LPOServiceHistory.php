<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$LPOId=$_REQUEST['LPOId'];

$sqlLPOService=mysqli_query($conn, "SELECT * FROM  LPOStockDetails WHERE LPOId='$LPOId' ORDER BY Id ASC") or die(mysqli_error($conn));


?>

<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="600" border="0" bgcolor="#E4E4E4">
   <tr>
    <td colspan="4"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop"   onMouseDown="javascript:getReadyToMove('popup_div_1', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);" > LPO Number <?php echo $LPOId; ?> Service History </td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
      </tr>
    </table></td>
 </tr>
 <tr>
 <td>Delivery Notes >>
 <?php
      $sql=mysqli_query($conn, "SELECT DeliveryNote FROM LPOService WHERE LPOId='$LPOId' GROUP BY DeliveryNote") or die(mysqli_error($conn));
	  while($recs=mysqli_fetch_array($sql))
	  {
	  $DeliveryNote=$recs['DeliveryNote'];
	  ?>
	  <a href="#" onclick="PrintLPOService('<?php echo $DeliveryNote; ?>')"><?php echo $DeliveryNote; ?></a>
	  <?php
	
	  }

	  ?></td>
 </tr>
 <tr>
 <td>
  <div id="showServiceDetails" style="width:100%;height:400px; max-height:400px; overflow-x:hidden; overflow-y:auto; ">
  <table border="0" width="100%">
 

 <?php 
 
 while($result=mysqli_fetch_assoc($sqlLPOService))
 {
		$StockId=$result['StockId'];
		$CatId=$result['CatId'];
		$Packaging=$result['Packaging'];
		$Qty=$result['Qty'];
?>
  <tr >
    <td class="table_sub_modules"><?php echo $Qty." ".PackagingInfo($Packaging)."s of ".StockName($StockId); ?>	</td>
  </tr>
	<tr>
	<td><table width="100%" border="0">
	<thead>
      <tr>
        <td width="5%" class="heading">&nbsp;</td>
        <td width="19%" class="heading">Date of Service </td>
        <td width="17%" class="heading">Expected Qty </td>
		<td width="18%" class="heading">Brought in Qty </td>
        <td width="18%" class="heading">Remaining Qty </td>
		<td width="14%" class="heading">Delivery Note No</td>
       
      </tr>
	  </thead>
	  <tbody style="width:100;height:150px; max-height:150px;overflow-x:hidden; overflow-y:auto;">
	  <?php 
	  
	  $sqlServiceDetails=mysqli_query($conn, "SELECT * FROM LPOService WHERE StockId='$StockId' AND LPOId='$LPOId' ORDER BY Id ASC") or die(mysqli_error($conn));
	  $count=0;
	  while($recs=mysqli_fetch_array($sqlServiceDetails))
	  {
		  $DateOfService=$recs['DateOfService'];
		  $ExpectedQty=$recs['ExpectedQty'];
		  $BroughtInQty=$recs['BroughtInQty'];
		  $DeliveryNote=$recs['DeliveryNote'];
		  $ServiceId=$recs['Id'];
		 $RemainQty=$ExpectedQty-$BroughtInQty;
	  
       if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'"> 
        <td ><?php echo $ServiceId;?></td>
        <td ><?php echo dteconvert($DateOfService); ?></td>
        <td ><?php echo $ExpectedQty; ?></td>
        <td ><?php echo $BroughtInQty; ?></td>
		<td ><?php echo $RemainQty; ?></td>
		<td ><?php echo $DeliveryNote; ?></td>
         </tr>
	  <?php
	  $count++;
	  }
	  ?>
	  </tbody>
    </table></td>
  </tr>
  <?php
  }
  ?>
 
  </table> </div>
  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
