<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$QuoteRequestId = $_REQUEST['QuoteRequestId'];
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="600" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="4">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Items in Quotation Request No <?php echo $QuoteRequestId; ?></td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php

  $sql = mysqli_query($conn, "SELECT * FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteRequestId'") or die(mysqli_error($conn));


  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td align="center" >Sorry.Lwala is not aware of any Quotation request items attached to the selected quotation Request</td>
    </tr>
  <?php
  } else {
  ?>
    <tr>
      <td>
        <table border="0" width="100%">
          <thead>
            <tr>
              <td width="23%" class="heading">Stock Item </td>
              <td width="24%" class="heading">Packaging</td>
              <td width="19%" class="heading">Qty</td>

            </tr>
          </thead>
          <tbody style="width:100%; max-height:300px; height:300px; overflow-x:hidden; overflow-y:auto;">
            <?php
            $count = 0;
            while ($recs = mysqli_fetch_array($sql)) {
              $StockId = $recs['StockId'];
              $CatId = $recs['CatId'];
              $Packaging = $recs['Packaging'];
              $Qty = $recs['Qty'];


              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
            ?>
              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                <td ><?php echo StockName($StockId); ?></td>
                <td ><?php echo PackagingInfo($Packaging); ?></td>
                <td ><?php echo $Qty; ?></td>

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
</table>