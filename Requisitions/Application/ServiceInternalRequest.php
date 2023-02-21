<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$StockItems = $_REQUEST['StockItems'];
$RequestId = $_REQUEST['RequestId'];
$UserId = $_REQUEST['UserId'];
$UserDepartment = GetUserDepartment($UserId);
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="660" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td width="654" colspan="4">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Items in Request </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="53">
      <table width="100%" border="0">
        <thead>

          <tr>
            <th width="6%"  >Item Name</th>
            <th width="23%" >Quantity Requested</th>
            <th width="35%" >Quantity in Pharmacy</th>
            <th width="24%" >Quantity to Issue</th>
          </tr>

        </thead>

        <tfoot>

<tr>
  <th width="6%"  >Item Name</th>
  <th width="23%" >Quantity Requested</th>
  <th width="35%" >Quantity in Pharmacy</th>
  <th width="24%" >Quantity to Issue</th>
</tr>

</tfoot>

        <tbody style="width:100%;max-height:300px; height:300px; overflow-x:hidden;overflow-y:auto;">
          <?php
          $count = 0;
          $StockItemDetails = explode(':', $StockItems);
          foreach ($StockItemDetails as $ItemDetails) {
            if ($ItemDetails != '') {
              $TheDetails = explode('@', $ItemDetails);
              $Packaging = $TheDetails[1];
              $PackagingInfo = PackagingInfo($Packaging);
              $OtherDetails = explode('*', $TheDetails[0]);

              $StockItem = $OtherDetails[0];
              $Qty = $OtherDetails[1];
              $Price = PackagePrice($StockItem, $Packaging);
              $Total = $Qty * $Price;

              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
          ?>
              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                <td ><?php echo StockName($StockItem); ?></td>
                <td ><?php echo $Qty; ?>&nbsp;<?php

                                                            $stock = StockName($StockItem);
                                                            $sqlp = mysqli_query($conn, "SELECT DISTINCT StockName, MaxStock, DefaultPackaging FROM StockTable WHERE StockName='$stock'") or die(mysqli_error($conn));
                                                            $resultp = mysqli_fetch_assoc($sqlp);
                                                            $pack = $resultp['DefaultPackaging'];

                                                            $sqlx = mysqli_query($conn, "SELECT * FROM SetupPackaging WHERE Id='$pack'") or die(mysqli_error($conn));
                                                            $resultx = mysqli_fetch_assoc($sqlx);
                                                            $packx = $resultx['PackageName'];

                                                            echo $packx;



                                                            //echo $PackagingInfo; 
                                                            ?></td>
                <td ><?php

                                  $stock = StockName($StockItem);
                                  $sqlp = mysqli_query($conn, "SELECT DISTINCT StockName, MaxStock FROM StockTable WHERE StockName='$stock'") or die(mysqli_error($conn));
                                  $resultp = mysqli_fetch_assoc($sqlp);

                                  $StockAvailable = $resultp['MaxStock'];

                                  echo $StockAvailable;

                                  //echo CheckQtyInDept($StockItem,$UserDepartment); 
                                  ?>&nbsp;<?php

                                          $stock = StockName($StockItem);
                                          $sqlp = mysqli_query($conn, "SELECT DISTINCT StockName, MaxStock, DefaultPackaging FROM StockTable WHERE StockName='$stock'") or die(mysqli_error($conn));
                                          $resultp = mysqli_fetch_assoc($sqlp);
                                          $pack = $resultp['DefaultPackaging'];

                                          $sqlx = mysqli_query($conn, "SELECT * FROM SetupPackaging WHERE Id='$pack'") or die(mysqli_error($conn));
                                          $resultx = mysqli_fetch_assoc($sqlx);
                                          $packx = $resultx['PackageName'];

                                          echo $packx;
                                          //echo $PackagingInfo; 
                                          ?></td>
                <td >
                  <input class="form-control" type="text" name="SupplyQty" id="SupplyQty" onclick="number_string(getElementById('SupplyQty'),'Invalid Supply Quantity typed in' )"  />
                  <input class="form-control" type="hidden" name="StoreQty" id="StoreQty" value="<?php echo $StockAvailable; ?> " />
                </td>
              </tr>
          <?php
              $count++;
            }
          }
          ?>
        </tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td height="26">
      <input class="form-control" type="hidden" value="<?php echo $RequestId; ?>" name="RequestNumber" id="RequestNumber" />
      <input class="form-control" type="hidden" value="<?php echo $StockItems; ?>" name="TheStockDetails" id="TheStockDetails" />
      <input class="btn btn-success" type="button" name="Button" value="Complete Service Request" style="float:right;" onclick="CompleteServiceRequest()" />
    </td>
  </tr>
</table>