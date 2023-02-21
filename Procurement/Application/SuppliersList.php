<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$SuppliersList = $_REQUEST['Suppliers'];
$QuoteRequestId = $_REQUEST['QuoteRequest'];
?>
<table width="100%" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Suppliers to be Requested in Quotation Request No <?php echo $QuoteRequestId; ?> </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php

  ?>
  <tr>
    <td>
      <table width="100%" border="0">
        <thead>
          <tr>
            <td class="heading"><input class="form-control" type="checkbox" name="checkbox" value="SupplierCheck" onclick="SelectSuppliers()" /></td>
            <td class="heading">Supplier</td>
            <td class="heading">Phy Address</td>
            <td class="heading">Post Address</td>
            <td class="heading">Telephone</td>
          </tr>
        </thead>
        <tbody style="width:100%;max-height:300px;overflow-x:hidden;overflow-y:auto;">
          <?php
          $suppliers = explode(':', SanitisedIds($SuppliersList));

          foreach ($suppliers as $supplier) {
            if ($supplier != '') {
              $SupplierSQL = "SELECT * FROM SuppliersTable WHERE Id='$supplier' GROUP BY Id";

              //echo $SupplierSQL;

              $sqlSupplier = mysqli_query($conn, $SupplierSQL) or die(mysqli_error($conn));

              $count = 0;
              while ($recs = mysqli_fetch_array($sqlSupplier)) {
                $Id = $recs['Id'];
                $Names = $recs['SupplierNames'];
                $PhyAddress = $recs['PhyAddress'];
                $PostAddress = $recs['PostAddress'];
                $Phone = $recs['Phone'];

                if ($count % 2 == 0) {
                  $bg = '#E1E1FF';
                } else {
                  $bg = '#EAEAEA';
                }

          ?>
                <tr bgcolor='<?php echo $bg; ?>' onmouseover="this.bgColor='#FFFFFF'" onmouseout="this.bgColor='<?php echo $bg; ?>'">
                  <td ><input class="form-control" type="checkbox" name="SupplierNo" id="SupplierNo" value="<?php echo $Id; ?>" /></td>
                  <td ><?php echo $Names; ?></td>
                  <td ><?php echo $PhyAddress; ?></td>
                  <td ><?php echo $PostAddress; ?></td>
                  <td ><?php echo $Phone; ?></td>
                </tr>
          <?php
              }
              $count++;
            }
          }
          ?>
        </tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center">
    </td>
  </tr>
  <?php

  ?>
</table>