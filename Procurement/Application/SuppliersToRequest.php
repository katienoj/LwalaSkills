<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$CatId = $_REQUEST['CatId'];
$RecId = $_REQUEST['RecId'];
$RecNo = $RecId;
?>

<table width="100%" border="0" class="formborder" bgcolor="#E4E4E4">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Select Supplier to Request <?php echo $CatId; ?></td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
  //echo "SELECT * FROM SupplierCategoryLink WHERE CatId='$CatId'";
  $sql = mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE CatId='$CatId'") or die(mysqli_error($conn));
  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td  align="center">Sorry.No suppliers are attached to the category where this Procurement Request is in</td>
    </tr>
  <?php
  } else {
  ?>
    <tr>
      <td>
        <table width="100%">
          <thead>
            <tr>
              <td class="heading"><input class="form-control" type="checkbox" name="SupplierCheck" id="SupplierCheck" value="SupplierCheck" onclick="SelectSuppliersChecks('<?php echo $CatId; ?>','<?php echo $RecId; ?>')" /></td>
              <td class="heading">Supplier</td>
              <td class="heading">Physical Address</td>
              <td class="heading">Post Address</td>
              <td class="heading">Town</td>
              <td class="heading">Country</td>
            </tr>
          </thead>
          <tbody style="width:100%;max-height:150px; height:150px; overflow-x:hidden;overflow-y:auto;">
            <?php

            $sql = mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE CatId='$CatId'") or die(mysqli_error($conn));
            while ($recs = mysqli_fetch_array($sql)) {
              $supplier = $recs['SupplierId'];
              $SupplierSQL = "SELECT * FROM SuppliersTable WHERE Id='$supplier' GROUP BY Id";

                //echo $SupplierSQL;
              ;
              $sqlSupplier = mysqli_query($conn, $SupplierSQL) or die(mysqli_error($conn));

              $count = 0;
              while ($recs = mysqli_fetch_array($sqlSupplier)) {
                $Id = $recs['Id'];
                $Names = $recs['SupplierNames'];
                $PhyAddress = $recs['PhyAddress'];
                $PostAddress = $recs['PostAddress'];
                $Phone = $recs['Phone'];
                $Town = $recs['Town'];
                $Country = $recs['Country'];

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
                  <td ><?php echo $Town; ?></td>
                  <td ><?php echo $Country; ?></td>
                </tr>
            <?php
              }
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
    <td>
      <input class="form-control" type="hidden" name="RecId" id="RecId" value="<?php echo $RecId; ?>" />
      <input class="btn btn-warning" type="submit" name="Submit" value="Proceed &gt;&gt;" style="float:right; " Onclick="CompleteMakeQuotationRequest()" />
    </td>
  </tr>
</table>