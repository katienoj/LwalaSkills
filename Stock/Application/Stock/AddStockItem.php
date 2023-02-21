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
          <td class="table_sub_modules">Item Info </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td>*Item Name </td>
                <td><input class="form-control" name="prdct_name" type="text" id="prdct_name" size="25" onblur="normal_string(getElementById('prdct_name'),'Invalid Stock Name typed in')" /></td>
                <td>Main Category</td>
                <td>


                  <select class="form-control" name="MainCategory" id="MainCategory">

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
              </tr>
              <tr>
                <td>Category</td>
                <td>
                  <select name="Category" class="form-control" id="Category">

                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM PStockCat ORDER BY CatName DESC") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                    ?>

                      <option class="form-control" value="<?php echo $recs['CatId']; ?>"><?php echo $recs['CatName']; ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </td>

                <td>Sub-Category</td>
                <td>
                  <select class="form-control" name="SubCategory" id="SubCategory">

                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM PStockSubCat ORDER BY SubCatName DESC") or die(mysqli_error($conn));
                    while ($recs = mysqli_fetch_array($sql)) {
                    ?>

                      <option class="form-control" value="<?php echo $recs['SubCatId']; ?>"><?php echo $recs['SubCatName']; ?></option>
                    <?php
                    }
                    ?>

                  </select>
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
                <td>Item Description</td>
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
                <td width="241"><input class="form-control" name="minStock" type="text"  id="minStock" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum Stock Quantity typed in')" /></td>
                <td width="150">*Max Stock Qty </td>
                <td width="252"><input class="form-control" name="maxStock" type="text"  id="maxStock" size="25" onblur="number_string(getElementById('maxStock'),'Invalid Maximum Stock Quantity typed in')" /></td>
              </tr>
              <tr>
                <td>*Min Re order Level </td>
                <td><input class="form-control" name="minReorder" type="text" id="minReorder" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum re Order level typed in')" /></td>
                <td>*Max Re order Level </td>
                <td><input class="form-control" name="MaxReorder" type="text" id="MaxReorder" size="25" onblur="number_string(getElementById('maxReorder'),'Invalid Maxmium reorder level typed in')" /></td>
              </tr>
              <tr>
                <td>*Opening Stock Qty </td>
                <td><input class="form-control" name="OpeningStock" type="text" id="OpeningStock" size="25" onblur="number_string(getElementById('OpeningStock'),'Invalid Opening Stock Quantity typed in')" /></td>
                <td>Item Price </td>
                <td><input class="form-control" name="StockPrice" type="text" id="StockPrice" size="25" onblur="number_string(getElementById('StockPrice'),'Invalid Stock Price typed in')" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="table_sub_modules">Manufacturer Details </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0">
              <tr>
                <td>Mfg Name </td>
                <td><input class="form-control" name="MfgName" type="text" id="MfgName" /></td>
                <td>Mfg Email </td>
                <td><input class="form-control" name="MfgEmail" type="text" id="MfgEmail" /></td>
              </tr>
              <tr>
                <td>Mfg Address </td>
                <td rowspan="2"><textarea name="MfgAddress" cols="20" rows="3" id="MfgAddress" onblur="normal_string(getElementById('desc'),'Invalid Stock description typed in')"></textarea></td>
                <td>Mfg Tel </td>
                <td><input class="form-control" name="MfgTel" type="text" id="MfgTel" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    <td height="31"></td>
  </tr>
  <tr>
    <td height="104" bgcolor="#D1D1D1">*-Required field
      <input class="btn btn-success" type="button" name="save" value="Save" onclick="StoreStockItem('add');" style="float:right;" />
    </td>
  </tr>
</table>