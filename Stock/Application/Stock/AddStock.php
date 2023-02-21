<?php
include "../../../Main/Config/db_conn.php";
?>
<link href="../styles/interface.css" rel="stylesheet" type="text/css" />
<table width="800" border="0" BgColor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Add Stock</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="800" border="0">
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td><label>ITEM NAME</label></td>
                <td><input name="prdct_name" type="text" class="form-control" id="prdct_name" size="25" /></td>
                <td><label>BATCH NO</label></td>
                <td><input name="Barcode" type="text" class="form-control" id="Barcode" size="25" /></td>
              </tr>
              <tr>
                <td><label>ITEM PIC</label></td>
                <td>
                  <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
                    <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
                    <input name="imagefile" id="imagefile" type="file" class="form-control" size="25" onchange="UploadedPhoto_validation(getElementById('imagefile'))" />
                  </form>
                </td>
                <td><label>EXPIRY DATE</label></td>
                <td><input name="ExpiryDate" type="text" class="form-control" id="ExpiryDate" size="30" onfocus='scwShow(this,event);' onclick='scwShow(this,event);'/></td>
              </tr>
              <tr>
                <td><label>SUPER CATEGORY</label></td>
                <td>
                  <select class="form-control" onChange="getmainCategory(value)"  id="supercategory" name="supercategory">
                    <option class="form-control">Select Super Category</option>
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
                      <option class="form-control" value="">Select Main Category</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td><label>SUB-CATEGORY</label></td>
                <td>
                <div id="loadSubCategory">

                  <select name="subcategory" class="form-control" id="subcategory">
                      <option class="form-control" value="">Select Sub-Category</option>
                   </select>
                </td>
              </tr>
              <tr>
                <td><label>END SALES UNIT</label></td>
                <td align="left"><select class="form-control" name="Packaging" id="Packaging">
                    <?php
                    echo "<option class='form-control' size =30 selected> - Select - </option>";
                    $Sql = "SELECT `Id`, `PackageName` FROM `SetupPackaging` order by Id DESC ";
                    $Res = mysqli_query($conn, $Sql) or die("Could not get Package name" . mysqli_error($conn));
                    while ($Rows = mysqli_fetch_array($Res)) {
                        //echo '<option>'.html_entity_decode($Rows['CatName']).'</option>';
                        echo '<option class="form-control" value="' . $Rows['Id'] . '">' . $Rows['PackageName'] . '</option>' . "\n";
                    }
                    ?>
                  </select></td>
                <td><label>ITEM DESCRIPTION<label></td>
                <td><textarea class="form-control" name="desc" cols="20" rows="3" id="desc"></textarea></td>
              </tr>
              <tr>
                <td><label>MIN STOCK QTY</label></td>
                <td><input name="minStock" type="text" class="form-control" id="minStock" size="25" /></td>
                <td><label>ADDED STOCK QTY<label></td>
                <td><input name="maxStock" type="text" class="form-control" id="maxStock" size="25" /></td>
              </tr>
              <tr>
                <td><label>MIN REORDER LEVEL</label></td>
                <td><input name="minReorder" type="text" class="form-control" id="minReorder" size="25" /></td>
                <td><label>MAX REORDER LEVEL</label></td>
                <td><input name="MaxReorder" type="text" class="form-control" id="MaxReorder" size="25" /></td>
              </tr>
              <tr>
                <td><label>OPENING STOCK QTY</label></td>
                <td><input name="OpeningStock" type="text" class="form-control" id="OpeningStock" size="25" /></td>
                <td><label>ITEM PRICE</label></td>
                <td><input name="StockPrice" type="text" class="form-control" id="StockPrice" size="25" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1">
            <input type="button" class="btn btn-success btn-block" name="save" value="Save Item" onclick="StoreStockItem('add');" style="float:right;" />
          </td>
        </tr>
        <input hidden name="InitialQty" type="text" class="form-control" id="InitialQty" />
        <input hidden name="InitialPrice" type="text" class="form-control" id="InitialPrice" />
        <input hidden name="MfgName" type="text" class="form-control" id="MfgName" />
        <input hidden name="MfgEmail" type="text" class="form-control" id="MfgEmail" />
        <textarea hidden name="MfgAddress" cols="20" rows="3" class="form-control" id="MfgAddress"></textarea>
        <input hidden name="MfgTel" type="text" class="form-control" id="MfgTel" />
      </table>
    </td>
  </tr>
</table>