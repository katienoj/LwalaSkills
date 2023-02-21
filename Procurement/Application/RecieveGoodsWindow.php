<?php 
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$LPOId=$_REQUEST['LPOId'];

$sql=mysqli_query($conn, "SELECT * FROM LPOStockDetails WHERE LPOId='$LPOId'") or die(mysqli_error($conn));


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" width="700" class="formborder" bgcolor="#E4E4E4" >
 <tr>
    <td colspan="4"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Items in LPO Number <?php echo $LPOId; ?></td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
 </tr>
<?php 

if(mysqli_num_rows($sql)==0)
{
?>
<tr>
<td align="center" >Sorry.Lwala does not Know any Items on the selected Quotation Request</td>
</tr>
<?php
}
else
{
?>
<tr>
<td >Enter Delivery Note No</td>
<td ><input class="form-control" name="DeliveryNoteNo" type="text" id="DeliveryNoteNo" size="15" /></td>
<td ></td>
</tr>
<tr>
<td colspan="2">
<table border="0" width="100%">
<thead>
  <tr>
    <td class="heading">Stock Name </td>
    <td class="heading">Expected Qty</td>
	 <td class="heading">Packaging</td>
    <td class="heading">Brought in Qty</td>
	
  </tr>
  </thead>
  <tbody style="width:100%;height:150px; max-height:150px; overflow-x:hidden; overflow-y:auto;">
  <?php 
 $count=0;
 while($recs=mysqli_fetch_array($sql))
 {
		$StockId=$recs['StockId'];
		$Qty=$recs['Qty'];
		$Packaging=$recs['Packaging'];
		$CatId=$recs['CatId'];
		$Price=$recs['Price'];
		$Total=$Price;
        $DetailId=$recs['Id'];
	$sqlCheckLastQty=mysqli_query($conn, "SELECT  ExpectedQty,BroughtInQty FROM LPOService WHERE StockId='$StockId' AND LPOId='$LPOId'") or die(mysqli_error($conn));
	  while($result=mysqli_fetch_assoc($sqlCheckLastQty))
	  {
	   $ExpectedQty=$result['ExpectedQty'];
	   $BroughtInQty=$result['BroughtInQty'];
	   }
	   if(empty($BroughtInQty) or empty($ExpectedQty))
		{
		  $LastRemainQty=$Qty;
		}
		else
		{
		   $LastRemainQty=$ExpectedQty-$BroughtInQty;
		}

   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'"> 
	<input class="form-control" name="DetailId" type="hidden" id="DetailId "  value="<?php echo $DetailId; ?>"/>
    <td ><?php echo StockName($StockId); ?>
    <input class="form-control" name="StockId<?php echo $DetailId; ?>" type="hidden"  id="StockId<?php echo $DetailId; ?>"  value="<?php echo $StockId; ?>"/></td>
    <td ><?php echo $LastRemainQty; ?></td>
    <td ><?php echo PackagingInfo($Packaging); ?></td>
    <td >
    <input class="form-control" name="BroughtIn" type="text" id="BroughtIn<?php echo $DetailId; ?>" size="15" value="" onblur="number_string(getElementById('BroughtIn<?php echo $DetailId; ?>'),'Invalide Qty Brought in value')" /></td>
    </tr>
  <?php
  $count++;
  }

  ?>
</tbody>
</table>
</td>
</tr>
<?php
}
?>
<tr>
<td><input class="form-control" name="LPONumber" type="hidden" id="LPONumber"  value="<?php echo $LPOId; ?>"/>
<input class="btn btn-info" type="button" name="Button" value="Recieve the Goods" style="float:right; "  onclick="ProceedReceiveGoods()"/>
  </table></td>
</tr>
 