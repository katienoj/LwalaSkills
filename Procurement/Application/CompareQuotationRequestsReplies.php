<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$QuoteRequestId=$_REQUEST['QuoteRequestId'];
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
	   <td width="583" class="heading"><?php echo SupplierNames($Supplier); ?>
     <input class="form-control" type="radio" name="SupplierCheck" id="SupplierCheck" value="<?php echo $Supplier; ?>" /></td>
	   <?php
    }
}
?>
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
<td class="heading"><?php echo StockName($StockId); ?>
</td>
<?php
foreach ($Suppliers as $Supplier) {
    if ($Supplier!='') {
        ?>
	    <td ><?php echo SupplierReplyDetails($Supplier, $StockId, $QuoteRequestId, 1); ?></td>
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
<td colspan="4"><input class="form-control" type="hidden" name="QuoteRequestId" id="QuoteRequestId" value="<?php echo $QuoteRequestId; ?>" />
<input class="btn btn-warning" type="button" name="Button" value="Proceed &gt;&gt;"  style="float:right; " onclick="CompleteIssueLPO()"/></td>
</tr>
</table>