<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <?php
  $sqlGetQuotations = mysqli_query($conn, "SELECT * FROM  QuotationRequests ORDER BY Id Desc") or die(mysqli_error($conn));
  if (mysqli_num_rows($sqlGetQuotations) == 0) {
      ?>
    <tr>
      <td  align='center'>Sorry.Lwala is not aware of any Generated Quotation requests that have not been responsed to yet</td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table border="0" width="100%" id="service_table">
  <thead>
    <tr>
      <th width="3%" class="heading">&nbsp;</th>
      <th width="13%" class="heading">Quotation Request Id </th>
      <th width="15%" class="heading">View Suppliers </th>
      <th width="14%" class="heading">Request Details </th>
      <th width="21%" class="heading">Date Made</th>
      <th width="21%" class="heading">Initator</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th width="3%" class="heading">&nbsp;</th>
      <th width="13%" class="heading">Quotation Request Id </th>
      <th width="15%" class="heading">View Suppliers </th>
      <th width="14%" class="heading">Request Details </th>
      <th width="21%" class="heading">Date Made</th>
      <th width="21%" class="heading">Initator</th>
    </tr>
  </tfoot>
  <tbody style="width:100%;height:720px;max-height:720px; overflow-x:hidden; overflow-y:auto;">
    <?php
    $count = 0;
      while ($recs = mysqli_fetch_array($sqlGetQuotations)) {
          $Id = $recs['Id'];
          $Suppliers = $recs['Suppliers'];
          $ApprovalStatus = $recs['ApprovalStatus'];
          $Approver = $recs['Approver'];
          $DateOfApproval = dteconvert($recs['DateOfApproval']);
          $UserId = $recs['UserId'];
          $QuotationDate = $recs['DateOfQuotationRequest'];
          if ($ApprovalStatus == 1) {
              $Approved = "Yes<br>By ResolveEmployeeName($Approver) On $DateOfApproval";
          } else {
              $Approved = "No";
          }
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?> <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'" valign="top">
        <td > <input class="form-control" type="checkbox" name="QuoteId" id="QuoteId" value="<?php echo $Id; ?>" /></td>
        <td ><?php echo $Id; ?></td>
        <td ><a href='#' onclick="SuppliersList('<?php echo $Suppliers; ?>','<?php echo $Id; ?>')">Suppliers List</a></td>
        <td ><a href='#' onclick="GetQuotationItems('<?php echo $Id; ?>')">View Items</a></td>
        <td ><?php echo dteconvert($QuotationDate); ?></td>
        <td ><?php echo ResolveEmployeeName($UserId); ?></td>
      </tr>
    <?php
      $count++;
      } ?>
  </tbody>
<?php
  }
?>
</table>