<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$LPOId=$_REQUEST['LPOId'];
$sql=mysqli_query($conn, "SELECT  Id, LPOId, StockId, ExpectedQty, BroughtInQty, RemainQty, DateOfService, DeliveryNote, 
RecievedInvoice, InvoiceNo 
FROM  LPOService WHERE LPOId='$LPOId' AND (RecievedInvoice is Null  OR RecievedInvoice='') GROUP BY DeliveryNote ORDER BY DateOfService DESC;
") or die(mysqli_error($conn));
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0">
 <?php
 if (mysqli_num_rows($sql)==0) {
     ?>
  <tr>
    <td align="center" >Sorry,This LPO has no recorded supplies yet</td>
  </tr>
  <?php
 } else {
      ?>
  <tr>
    <td>
	<table border="0" width="100%">
	<thead>
	<tr>
	<td width="8%" class="heading"><input class="form-control" type="checkbox" name="checkLPOService" id="CheckLPOService" onclick="CheckLPOService()" /></td>
	<td width="28%" class="heading">Document Number</td>
	<td width="52%" class="heading">Supply inside Document No</td>
	<td width="12%" class="heading">Received Invoice</td>
  </tr>
  </thead>
  <tbody style="width:100%;height:380px;max-height:380px;overflow-x:hidden; overflow-y:auto;">
  <?php
  $count=0;
      while ($recs=mysqli_fetch_array($sql)) {
          $DeliveryNote=$recs['DeliveryNote'];
          if ($count%2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
	<td ><input class="form-control" type="checkbox" name="DNoteId" value="<?php echo $DeliveryNote; ?>" /></td> 
	<td ><?php echo $DeliveryNote; ?></td>
	<td  valign="top" style="border:solid 1px #0000FF;"><div id="DisplaySupplies<?php echo $DeliveryNote; ?>"><a href="#"  onclick="ShowSuppliesInside('<?php echo $DeliveryNote; ?>')" >Supplies Inside</a></div></td>
	<td ></td>
	</tr>
	<?php
    $count++;
      } ?>
  </tbody>
  <?php
  }
  ?>
</table>
