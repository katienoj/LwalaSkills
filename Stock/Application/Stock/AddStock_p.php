<table width="800" border="0">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Add Stock</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="800" border="0">
        <tr>
          <td>Item Name </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td>Item Name </td>
                <td><input class="form-control" name="prdct_name" type="text" id="prdct_name" size="25" onblur="normal_string(getElementById('prdct_name'),'Invalid Stock Name typed in')" /></td>
                <td>Barcode</td>
                <td><input class="form-control" name="Barcode" type="text" id="Barcode" size="25" /></td>
              </tr>
              <tr>
                <td>Item Pic </td>
                <td>
                  <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
                    <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
                    <input class="form-control" name="imagefile" id="imagefile" type="file" size="25" readonly="true" onchange="UploadedPhoto_validation(getElementById('imagefile'))" />
                  </form>
                </td>
                <td>Category</td>
                <td><input class="form-control" name="category" type="text" id="category" size="25" readonly="true" />
                  <input class="form-control" name="cat" type="hidden" id="cat" />
                  <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
                  <input class="btn btn-warning" name="button" type="button" onclick="navigateCat();" value="Browse" />
                </td>
              </tr>
              <tr>
                <td>End sales unit </td>
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
                <td>Item Description </td>
                <td><textarea class="form-control" name="desc" cols="20" rows="3" id="desc" onblur="normal_string(getElementById('desc'),'Invalid Stock description typed in')"></textarea></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>Item Qties </td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td>Min Stock Qty </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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
        <tr>
          <td>Manuafacturer Details </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
include "../../../Main/Config/db_conn.php";
$PackagingId = $_REQUEST['PackagingId'];

$strSQL = "DELETE FROM StockPackaging WHERE PackagingId='$PackagingId'";

$sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));

if ($sql == 1) {
  echo "1";
} else {
  echo "Unable to delete packaging";
}
?>