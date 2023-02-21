<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="620" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop"><?php echo StockName($StockId); ?>'s Pricing Details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp; </td>
  </tr>
  <tr>
    <td>
      <div id="ShowPackages"></div>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0">
        <tr>
          <td>
            <div align="right">Packaging</div>
          </td>
          <td><?php
              $packagelist = "<select id='Packaging' name='Packaging' id='Packaging' class='form-control' readonly='true' disabled='disbabled'>";
              $packagelist .= "<option class='form=control' value=''>--Please select--</option>";
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
          <td>
            <div align="right">Qty</div>
          </td>
          <td><input name="PackageQty" type="text" class="form-control" id="PackageQty" readonly="true"></td>
        </tr>
        <tr>
          <td>
            <div align="right">Packaging Price </div>
          </td>
          <td><input name="PackagePrice" type="text" class="form-control" id="PackagePrice" /></td>
          <td>&nbsp;</td>
          <td><input class="form-control" name="PackagingId" type="hidden" class="alertsBox" id="PackagingId">
            <input class="form-control" name="StockId" type="hidden" class="alertsBox" id="StockNo" value="<?php echo $StockId; ?>">
            <input class="form-control" name="PackageBarcode" type="hidden" id="PackageBarcode" />
            <?php
            $packagelist = "<select id='PackagingType' name='PackagingType' class='form-control' style='display:none'>";
            $packagelist .= "<option class='form-control' value=''>--Please select--</option>";
            $sSqlWrk = "SELECT `Id`, `PackageType` FROM `PackageType` order by Id DESC ";
            $rswrk = mysqli_query($conn, $sSqlWrk) or die("Failed to execute query at line " . __LINE__ . ": " . mysqli_error($conn) . '<br>SQL:' . $sSqlWrk);
            if ($rswrk) {
              $rowcntwrk = 0;
              while ($datawrk = mysqli_fetch_array($rswrk)) {
                $packagelist .= "<option class='form-control' value=\"" . htmlspecialchars($datawrk[0]) . "\"";
                if ($datawrk["PackageType"] == @$x_country) {
                  $packagelist .= " selected";
                }
                $packagelist .= ">" . $datawrk["PackageType"] . "</option>";
                $rowcntwrk++;
              }
            }
            @mysqli_free_result($rswrk);
            $packagelist .= "</select>";
            echo $packagelist;
            ?>
          </td>
        </tr>
        <tr>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1">&nbsp;</td>
          <td bgcolor="#D1D1D1"><input class="btn btn-success" type="button" name="Button" value="Save" style="float:right" onclick="StorePackagingDetails()"></td>
        </tr>
      </table>
    </td>
  </tr>

</table>