<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="700" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="4"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop"   onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Reply Items in Quotation Request </td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
<?php
$QuoteRequestId=$_REQUEST['QuoteRequestId'];
$sql=mysqli_query($conn, "SELECT * FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteRequestId'") or die(mysqli_error($conn));
$sqlSuppliers=mysqli_query($conn, "SELECT Suppliers FROM QuotationRequests WHERE Id='$QuoteRequestId'") or die(mysqli_error($conn));
$SuppliersResult=mysqli_fetch_assoc($sqlSuppliers);
$SelectedSuppliers=explode(':', $SuppliersResult['Suppliers']);
if (mysqli_num_rows($sql)==0) {
    ?>
   <tr>
   <td align="center" >Sorry.Lwala is not aware of any Quotation request items attached to the selected Quotation Requests</td>
   </tr>
   <?php
} else {
    ?>
<tr>
<td> Select Supplier
  <select class="form-control" name="SelectedSuppliers" id="SelectedSuppliers" Onclick="CheckIfRepliedBefore()">
  <?php
  foreach ($SelectedSuppliers as $SupplierId) {
      if ($SupplierId!='') {
          ?>
		  <option class="form-control" value="<?php echo $SupplierId; ?>"><?php echo SupplierNames($SupplierId); ?></option>
		  <?php
      }
  } ?>
  </select>
  </td>
</tr>
  <td colspan="2"><table border="0" width="100%">
      <thead>
        <tr>
          <td width="19%" class="heading">Stock Item </td>
          <td width="36%" class="heading">Packaging</td>
          <td width="22%" class="heading">Qty</td>
          <td width="23%" class="heading">Supplier Price </td>
        </tr>
      </thead>
      <tbody style="width:100%; max-height:300px; height:300px; overflow-x:hidden; overflow-y:auto;">
        <?php
  $count=0;
    while ($recs=mysqli_fetch_array($sql)) {
        $Id=$recs['Id'];
        $StockId=$recs['StockId'];
        $CatId=$recs['CatId'];
        $Packaging=$recs['Packaging'];
        $Qty=$recs['Qty'];
        if ($count%2 == 0) {
            $bg = '#E1E1FF';
        } else {
            $bg = '#EAEAEA';
        } ?>
        <tr bgcolor='<?php echo $bg; ?>' onmouseover="this.bgColor='#FFFFFF'" onmouseout="this.bgColor='<?php echo $bg; ?>'">
          <td ><?php echo StockName($StockId); ?></td>
          <td ><?php echo PackagingInfo($Packaging); ?></td>
          <td ><?php echo $Qty; ?></td>
          <td ><input class="form-control" type="hidden" name="StockId" id="StockId" value="<?php echo $StockId; ?>" />
		  <input class="form-control" name="SupplierPrice<?php echo $StockId; ?>" type="text" id="SupplierPrice<?php echo $StockId; ?>" size="20"></td>
        </tr>
        <?php
  $count++;
    } ?>
      </tbody>
    </table>
      </tr>
  <tr>
  <td><input class="form-control" type="hidden" name="QuoteRequestId" id="QuoteRequestId" value="<?php echo $QuoteRequestId; ?>" />
  <input class="form-control" type="text" name="ReplyId"  id="RepyId" value=""  style="display:none;"/>
  <input class="btn btn-success" type="button" name="Button" value="Save Reply" onclick="SaveSupplierReply()" style="float:right" /></td>
  </tr>
  <?php
}
  ?>
</table>
