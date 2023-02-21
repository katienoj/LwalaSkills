<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
//retrieve product fields using product id
$sql = "SELECT * FROM StockTable WHERE Id='$StockId'";
//display product fields in list
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$recs = mysqli_fetch_assoc($result);
$Id = $recs['Id'];
$StockName = $recs['StockName'];
$quantity = $recs['quantity'];
$VAT = $recs['VAT'];
$cat = $recs['CatId'];
$UnitId = $recs['UnitId'];
$specs = $recs['specs'];
$StockImage = $recs['StockImage'];
$CatImage = $recs['CatImage'];
$StockDate = $recs['StockDate'];
$StockLastUpdate = $recs['StockLastUpdate'];
$del = $recs['del'];
$minStock = $recs['MinStock'];
$minReorder = $recs['MinReorder'];
$maxReorder = $recs['MaxReorder'];
$maxStock = $recs['MaxStock'];
$OpeningStock = $recs['OpeningStock'];
$Barcode = $recs['Barcode'];
$StockPrice = $recs['StockPrice'];
$MfgName = $recs['MfgName'];
$MfgEmail = $recs['MfgEmail'];
$MfgAddress = $recs['MfgAddress'];
$MfgTel = $recs['MfgTel'];
$DefaultPackage = $recs['DefaultPackaging'];
$ExpiryDate = $recs['ExpiryDate'];
$superCat = $recs['superCat'];
$mainCategory = $recs['mainCategory'];


?>
<link href="../styles/interface.css" rel="stylesheet" type="text/css" />
<table width="800" border="0" BgColor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Re-stock : <?php echo StockName($StockId); ?></td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="800" border="0">
        <tr>
          <td class="table_sub_modules">ITEM DETAILS </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td><label>ITEM NAME</label></td>
                <td><input readonly name="prdct_name" type="text" class="form-control" id="prdct_name" size="25" onblur="normal_string(getElementById('prdct_name'),'Invalid Stock Name typed in')" value="<?php echo $StockName; ?>" /></td>
                <td><label>BATCH NO</label></td>
                <td><input name="Barcode" type="text" class="form-control" id="Barcode" size="25" value="<?php echo $Barcode; ?>" /></td>
              </tr>
              <tr>
                <td><label>ITEM PIC</label></td>
                <td>
                  <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
                    <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
                    <input name="imagefile" id="imagefile" type="file" class="form-control" value="<?php echo $CatImage; ?>" size="25" onchange="UploadedPhoto_validation(getElementById('imagefile'))" />
                  </form>
                </td>
                <td><label>EXPIRY DATE</label></td>
                <td><input name="ExpiryDate" type="text" class="form-control" id="ExpiryDate" size="25" onfocus='scwShow(this,event);' onclick='scwShow(this,event);' value="<?php echo $ExpiryDate; ?>" /></td>
              </tr>
              <tr>
                <td><label>SUPER CATEEGORY</label></td>
                <td>
                  <select onChange="getmainCategory(value)" class="form-control" id="supercategory" name="supercategory">
                    <option class="form-control">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM ParentStockCat WHERE ParentCatId='$superCat'") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                      echo $recs['ParentCatName'];
                    }
                        ?>
                    </option>
                    
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM ParentStockCat ORDER BY ParentCatName DESC") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                        ?>
                      <option class="form-control" value="<?php echo $recs['ParentCatId']; ?>"><?php echo $recs['ParentCatName']; ?></option>
                    <?php
                    }
                    ?>                  
                  </select>
                </td>
                <td><label>MAIN CATEGORY</label></td>
                <td>
                  <div id="loadCategory">
                    <select name="maincategory" class="form-control" id="maincategory">
                      <option class="form-control" value="">
                      <?php
                    $sql = mysqli_query($conn, "SELECT * FROM PStockCat WHERE CatId='$mainCategory'") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                      echo $recs['CatName'];
                    }
                    ?>

                      </option>
                    </select>
                </td>
              </tr>
              <tr>
                <td><label>SUB-CATEGORY</label></td>
                <td>
                <div id="loadSubCategory">
                  <select name="subcategory" class="form-control" id="subcategory">
                  <option class="form-control" value="">
                  <?php
                    $sql = mysqli_query($conn, "SELECT * FROM StockCategory WHERE Id='$cat'") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                      echo $recs['CatName'];
                    }
                    ?>
                  </option>
              
                  </select>
                </td>
              </tr>
              <tr>
                <td><label>END SALES UNIT<label></td>
                <td><?php
                    $packagelist = "<select class='form-control' id='Packaging' name='Packaging' id='Packaging' class=small>";
                    $packagelist .= "<option class='form-control' value='$DefaultPackage'>" . PackageName($DefaultPackage) . "</option>";
                    $sSqlWrk = "SELECT `Id`, `PackageName` FROM `SetupPackaging` order by Id DESC ";
                    $rswrk = mysqli_query($conn, $sSqlWrk) or die("Failed to execute query at line " . __LINE__ . ": " . mysqli_error($conn) . '<br>SQL:' . $sSqlWrk);
                    if ($rswrk) {
                        $rowcntwrk = 0;
                        while ($datawrk = mysqli_fetch_array($rswrk)) {
                            $packagelist .= "<option class='form-control' value=\"" . htmlspecialchars($datawrk[0]) . "\"";
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
                <td><label>ITEM DESCRIPTION</label></td>
                <td><textarea name="desc" cols="20" rows="3" class="form-control" id="desc" onblur="normal_string(getElementById('desc'),'Invalid Stock description typed in')"><?php echo $specs; ?></textarea></td>
              </tr>
              <tr>
                <td width="139"><label>MIN STOCK QTY</label></td>
                <td width="249"><input name="minStock" type="text" class="form-control" id="minStock" size="25" value="<?php echo $minStock; ?>" /></td>
                <td width="139"><label>ADDED STOCK QTY</label></td>
                <td width="255"><input name="maxStock" type="text" class="form-control" id="maxStock" size="25" value="<?php echo $maxStock; ?>" /></td>
              </tr>
              <tr>
                <td><label>MIN REORDER LEVEL</label></td>
                <td><input name="minReorder" type="text" class="form-control" id="minReorder" size="25" value="<?php echo $minReorder; ?>" /></td>
                <td><label>MAX REORDER LEVEL</label></td>
                <td><input name="MaxReorder" type="text" class="form-control" id="MaxReorder" size="25" value="<?php echo $maxReorder; ?>" /></td>
              </tr>
              <tr>
                <td><label>OPENING STOCK QTY</label></td>
                <td><input name="OpeningStock" type="text" class="form-control" id="OpeningStock" size="25" value="<?php echo $OpeningStock; ?>" /></td>
                <td><label>ITEM PRICE</label></td>
                <td><input name="StockPrice" type="text" class="form-control" id="StockPrice" size="25" value="<?php echo $StockPrice; ?>" /></td>
              </tr>
              <input hidden name="MfgName" type="text" class="form-control" id="MfgName" />
              <input hidden name="InitialQty" type="text" class="form-control" id="InitialQty" value="<?php echo $maxStock; ?>"/>
              <input hidden name="InitialPrice" type="text" class="form-control" id="InitialPrice" value="<?php echo $StockPrice; ?>"/>
              <input hidden name="MfgEmail" type="text" class="form-control" id="MfgEmail" />
              <textarea hidden name="MfgAddress" cols="20" rows="3" class="form-control" id="MfgAddress"></textarea>
              <input hidden name="MfgTel" type="text" class="form-control" id="MfgTel" />
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1">
            <input class="btn btn-success btn-block" type="button" name="save" value="Save Changes" onclick="StoreStockItem('edit');" style="float:right;" />
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</td>
</tr>
</table>