<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$LPOId = $_REQUEST['LPOId'];
$SelectedSupplies = $_REQUEST['SelectedNotes'];
$ModuleId = $_REQUEST['ModuleId'];
$Total = 0;
$GrandTotal = 0;
$SupplyDetails = explode(':', $SelectedSupplies);
foreach ($SupplyDetails as $SupplyDetail) {
  if ($SupplyDetail != '') {

    $strSQL = "SELECT * FROM LPOService WHERE DeliveryNote='$SupplyDetail'";

    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
      $LPOId = $recs['LPOId'];
      $StockId = $recs['StockId'];
      $Id = $recs['Id'];

      $BroughtInQty = SupplyBroughtInQty($StockId, $LPOId);
      $PriceDetails = explode(':', LPOPriceDetails($StockId, $LPOId));
      $ThePrice = $PriceDetails[1];
      $PackageName = $PackageName[0];
      $Total = $ThePrice * $BroughtInQty;
      $GrandTotal += $Total;
    }
  }
}

?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" bgcolor="#E4E4E4">
  <tr>
    <th scope="col">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onmousedown="javascript:getReadyToMove('popup_div_1', event);" onmouseup="javascript:dropLoadedObject(event)" onclick="javascript:dropLoadedObject(event);">Invoice in LPO Number <?php echo $LPOId; ?></td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </th>
  </tr>
  <tr>
    <th scope="row">
      <table width="100%" border="0">
        <tr>
          <td>Invoice Number </td>
          <td><input class="form-control" name="InvNo" type="text" id="InvNo" /></td>
        </tr>
        <tr>
          <td>Invoice Date </td>
          <td><input class="form-control" name="InvDate" type="text" id="InvDate" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' readonly="true" onblur="" /></td>
        </tr>
        <tr>
          <td>Date Received </td>
          <td><input class="form-control" name="DateRecieved" type="text" id="DateRecieved" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' readonly="true" onblur="" value="<?php echo date('d M Y', time()); ?>" /></td>
        </tr>
        <tr>
          <td>Amount on Invoice </td>
          <td><input class="form-control" name="InvAmt" type="text" id="InvAmt" value="<?php echo CurrencyCode(1) . ' ' . number_format($GrandTotal, 2); ?>" readOnly="true"><input class="form-control" type="hidden" name="InvoiceAmt" id="InvoiceAmt" value="<?php echo $GrandTotal; ?>" /></td>
        </tr>
        <tr>
          <td>Account to record</td>


          <td>
            <input class="form-control" type="text" name="CategoryChart" id="CategoryChart" value="<?php echo "13"; ?>" />
          </td>
        </tr>
        <tr>
          <th scope="row">&nbsp;</th>
          <td><input class="form-control" type="hidden" name="SelectedSupplies" id="SelectedSupplies" value="<?php echo $SelectedSupplies; ?>" />
            <input class="form-control" type="hidden" name="LPOId" id="LPOId" value="<?php echo $LPOId; ?>" />
          </td>
        </tr>
      </table>
    </th>
  </tr>
  <tr>
    <th scope="row"><input class="btn btn-warning" type="button" name="Button" value="Proceed" style="float:right;" onclick="SendInvoiceToAccountsPayable()" /></th>
  </tr>
</table>