<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$QuoteRequestId=$_REQUEST['QuoteRequestId'];
$CheckCurrency=mysqli_query($conn, "SELECT Currency FROM QuotationRequestsReplies WHERE QuoteId='$QuoteRequestId'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($CheckCurrency);
$Currency=$result['Currency'];
if ($Currency==1 or empty($Currency) or $Currency==0) {
    $Currency='1';
}
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="900" border="0" bgcolor="#E4E4E4" class="formborder">
 <tr>
    <td colspan="4"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop">Compare Quotation Request Replies for Quotation Request <?php echo $QuoteRequestId; ?></td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
 <tr>
 <td>
 <table border="0" width="100%">
 <td class="heading">&nbsp; </td>
<?php
$sqlGetSuppliers=mysqli_query($conn, "SELECT Suppliers FROM QuotationRequests WHERE Id='$QuoteRequestId'") or die(mysqli_error($conn));
$resultGetSuppliers=mysqli_fetch_assoc($sqlGetSuppliers);
$Suppliers=explode(':', $resultGetSuppliers['Suppliers']);
foreach ($Suppliers as $Supplier) {
    if ($Supplier!='') {
        ?>
	   <td width="583" class="heading"><?php echo SupplierNames($Supplier); ?></td>
	   <?php
    }
}
?>
</tr> <tr>
   <td class="heading">Reply Currency</td>
   <td class="heading"><select name="Currency"  id="Currency">
     <option value="<?php echo $Currency; ?>"><?php echo CurrencyCode($Currency); ?></option>
     <?php
        $sql=mysqli_query($conn, "SELECT * FROM CurrencyDetails WHERE Active is Null") or die(mysqli_error($conn));
        while ($recs=mysqli_fetch_array($sql)) {
            ?>
     <option value="<?php echo $recs['Id']; ?>"><?php echo $recs['Code']; ?></option>
     <?php
        }
        ?>
   </select></td>
 </tr>
<?php
$count=0;
$sqlGetStockItems=mysqli_query($conn, "SELECT StockId FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteRequestId'") or die(mysqli_error($conn));
while ($recs=mysqli_fetch_array($sqlGetStockItems)) {
    $StockId=$recs['StockId'];
    if ($count%2 == 0) {
        $bg = '#E1E1FF';
    } else {
        $bg = '#EAEAEA';
    } ?>
<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'"  valign="top"> 
<td class="heading" width="250"><?php echo StockName($StockId); ?>
<input class="form-control" type="hidden" name="EntryItem" id="EntryItem" value="<?php echo $count; ?>" /></td>
<?php
foreach ($Suppliers as $Supplier) {
    if ($Supplier!='') {
        ?>
	    <td >
      <input class="form-control" type="hidden" name="ItemNo<?php echo $count; ?>" id="ItemNo<?php echo $count; ?>" value="<?php echo $StockId; ?>" />
      <input class="form-control" type="hidden" name="SupplierNo<?php echo $count; ?>" id="SupplierNo" value="<?php echo $Supplier; ?>" />
      <input class="form-control" type="text" name="SupplierPrice+<?php echo $Supplier; ?>+<?php echo $StockId; ?>+<?php echo $count; ?>" id="SupplierPrice+<?php echo $Supplier; ?>+<?php echo $StockId; ?>+<?php echo $count; ?>" value="<?php echo number_format(SupplierReplyDetails($Supplier, $StockId, $QuoteRequestId, 0)); ?>" /></td>
	   <?php
    }
} ?>
</tr>
<?php
$count++;
}
?>
<tr>
<td class="heading">Totals :</td>
<?php
foreach ($Suppliers as $Supplier) {
    if ($Supplier!='') {
        ?>
	    <td  bgcolor="#BABABA"><strong><?php echo SupplierReplyTotals($Supplier, $QuoteRequestId, 1); ?></strong></td>
	   <?php
    }
}
?>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="4">
  <input class="form-control" type="hidden" name="QuoteRequestId" id="QuoteRequestId" value="<?php echo $QuoteRequestId; ?>" />
  <input class="form-control" type="text" name="ReplyId"  id="RepyId" value=""  style="display:none;"/>
  <input class="btn btn-success" type="button" name="Button" value="Save"  style="float:right; " onclick="SaveSupplierReply()"/></td>
</tr>
</table>