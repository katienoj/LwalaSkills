<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/ProcurementFunctions.php';
$StockId = $_REQUEST['StockId'];
?>
<link href="../styles/interface.css" rel="stylesheet" type="text/css" />
<table width="800" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Edit <?php echo StockName($StockId); ?>'s details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
//retrieve product fields using product id
$sql="SELECT * FROM StockTable WHERE Id='$StockId'";
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
while (list($Id, $StockName, $quantity, $VAT, $cat, $UnitId, $specs, $StockImage, $CatImage, $StockDate, $StockLastUpdate, $del, $minStock, $minReorder, $maxReorder, $maxStock, $OpeningStock, $Barcode, $StockPrice, $MfgName, $MfgEmail, $MfgAddress, $MfgTel, $DefaultPackage) = mysqli_fetch_row($result)) {
    ?>
  <tr>
    <td>
      <table width="800" border="0">
        <tr>
          <td class="table_sub_modules">Item Info </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td>*Item Name </td>
                <td><input class="form-control" name="prdct_name" type="text" id="prdct_name" size="25" onblur="normal_string(getElementById('prdct_name'),'Invalid Stock Name typed in')" value="<?php echo $StockName; ?>" /></td>
                <td>*Barcode</td>
                <td><input class="form-control" name="Barcode" type="text" id="Barcode" size="25" value="<?php echo $Barcode; ?>" /></td>
              </tr>
              <tr>
                <td>Item Pic </td>
                <td>
                  <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
                    <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
                    <input class="form-control" name="imagefile" id="imagefile" type="file" size="25" readonly="true" onchange="UploadedPhoto_validation(getElementById('imagefile'))" />
                  </form>
                </td>
                <td>*Category</td>
                <td><input class="form-control" name="category" type="text" id="category" size="25" readonly="true" value="<?php echo CatName($cat); ?>" />
                  <input class="form-control" name="cat" type="hidden" id="cat" value="<?php echo $cat; ?>" />
                  <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
                  <input class="btn btn-warning" name="button" type="button" onclick="navigateCat();" value="Browse" />
                </td>
              </tr>
              <tr>
                <td>*End sales unit </td>
                <td><?php
                        $packagelist = "<select class='form-control' id='Packaging' name='Packaging' id='Packaging' class=small>";
    $packagelist .= "<option class='form-control' value=''>--Please select--</option>";
    $sSqlWrk = "SELECT `Id`, `PackageName` FROM `SetupPackaging` order by Id DESC ";
    $rswrk = mysqli_query($conn, $sSqlWrk) or die("Failed to execute query at line " . __LINE__ . ": " . mysqli_error($conn) . '<br>SQL:' . $sSqlWrk);
    if ($rswrk) {
        $rowcntwrk = 0;
        while ($datawrk = mysqli_fetch_array($rswrk)) {
            $packagelist .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
            if ($datawrk["PackageName"] == @$x_country) {
                $packagelist .= " selected";
            }
            $packagelist .= ">" . $datawrk["PackageName"] . "</option>";
            $rowcntwrk++;
        }
    }
    @mysqli_free_result($rswrk);
    $packagelist .= "</select>";
    echo $packagelist;
    ?></td>
                <td>Item Description </td>
                <td><textarea class="form-control" name="desc" cols="20" rows="3" id="desc" onblur="normal_string(getElementById('desc'),'Invalid Stock description typed in')"></textarea></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="table_sub_modules">Item Qties </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td width="139">*Min Stock Qty </td>
                <td width="249"><input class="form-control" name="minStock" type="text" id="minStock" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum Stock Quantity typed in')" value="<?php echo $minStock; ?>" /></td>
                <td width="139">*Max Stock Qty </td>
                <td width="255"><input class="form-control" name="maxStock" type="text" id="maxStock" size="25" onblur="number_string(getElementById('maxStock'),'Invalid Maximum Stock Quantity typed in')" value="<?php echo $maxStock; ?>" /></td>
              </tr>
              <tr>
                <td>*Min Re order Level </td>
                <td><input class="form-control" name="minReorder" type="text" id="minReorder" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum re Order level typed in')" value="<?php echo $minReorder; ?>" /></td>
                <td>*Max Re order Level </td>
                <td><input class="form-control" name="MaxReorder" type="text" id="MaxReorder" size="25" onblur="number_string(getElementById('maxReorder'),'Invalid Maxmium reorder level typed in')" value="<?php echo $maxReorder; ?>" /></td>
              </tr>
              <tr>
                <td>*Opening Stock Qty </td>
                <td><input class="form-control" name="OpeningStock" type="text" id="OpeningStock" size="25" onblur="number_string(getElementById('OpeningStock'),'Invalid Opening Stock Quantity typed in')" value="<?php echo $OpeningStock; ?>" /></td>
                <td>Item Price </td>
                <td><input class="form-control" name="StockPrice" type="text" id="StockPrice" size="25" onblur="number_string(getElementById('StockPrice'),'Invalid Stock Price typed in')" value="<?php echo $StockPrice; ?>" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="table_sub_modules">Manuafacturer Details </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td>Mfg Name </td>
                <td><input class="form-control" name="MfgName" type="text" id="MfgName" value="<?php echo $MfgName; ?>" /></td>
                <td>Mfg Email </td>
                <td><input class="form-control" name="MfgEmail" type="text" id="MfgEmail" value="<?php echo $MfgEmail ?>" /></td>
              </tr>
              <tr>
                <td>Mfg Address </td>
                <td><input class="form-control" name="MfgAddress" type="text" id="MfgAddress" value="<?php echo $MfgAddress; ?>" /></td>
                <td>Mfg Tel </td>
                <td><input class="form-control" name="MfgTel" type="text" id="MfgTel" value="<?php echo $MfgTel; ?>" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#D1D1D1">*-Required field
      <input class="btn btn-success" type="button" name="save" value="Save" onclick="StoreStockItem('add');" style="float:right;" />
    </td>
  </tr>
</table>