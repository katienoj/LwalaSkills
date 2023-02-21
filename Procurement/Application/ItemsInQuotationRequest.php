<?php 
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$QuoteRequestId=$_REQUEST['QuoteRequestId'];

$sql=mysqli_query($conn, "SELECT * FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteRequestId'") or die(mysqli_error($conn));


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" width="500" class="formborder">

<?php 

if(mysqli_num_rows($sql)==0)
{
?>
<tr>
<td align="center" >Sorry, Lwala does not Know any Items on the selected Quotation Request</td>
</tr>
<?php
}
else
{
?>
<tr>
<td>
<table border="0">
<thead>
  <tr>
    <td class="heading">Stock Name </td>
    <td class="heading">RequestedQty</td>
	 <td class="heading">Packaging</td>
    <td class="heading">Qty to Request </td>
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
		$DateOfRequest=dteconvert($recs['DateOfRequest']);
		$RequestId=$recs['RequestId'];
		$Id=$recs['Id'];
		$Approver=$recs['Approver'];
		$dteApproved=$recs['DateOfApproval'];
		$ProcessedBy=$recs['ProcessedBy'];
		$DateOfProcessing=$recs['DateOfProcessing'];


   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'"> 
     <input class="form-control" type="hidden" name="RQId<?php echo $PRQId; ?>" id="RQId<?php echo $Id; ?>" value="<?php echo $Id; ?>" />
    <td ><?php echo StockName($StockId); ?>
    <input class="form-control" type="hidden" name="PRQstockId<?php echo $Id; ?>" id="PRQstockId<?php echo $Id; ?>" value="PRQId<?php echo $StockId; ?>" /></td>
    <td ><?php echo $Qty; ?></td>
    <td ><?php echo PackagingInfo($Packaging); ?></td>
    <td >
      <input class="form-control" name="QtyToRequest<?php echo $Id; ?>" type="text" id="QtyToRequest<?php echo $Id; ?>" size="10" value="" OnKeyUp="CacheStockAmt('<?php echo $StockId; ?>',this,'<?php echo $CatId; ?>','<?php echo $Id; ?>')"/></td>
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

