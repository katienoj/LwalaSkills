<?php
require_once '../../../Main/Config/db_conn.php';
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <tr>
    <td colspan="6">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="83%" class="formtop">Search Suppliers</td>
          <td width="17%" class="formtop"><input class="form-control" name="image" type="image" style="float:right;" onclick="inter=setInterval('hideSearchDiv()',3); return false;" src="../Main/Layout/images/UpIcon.gif" width="16" height="16" />
            <a href="#" onclick="inter=setInterval('hideSearchDiv()',3); return false;" style="cursor:hand; text-decoration:none; float:right; color:#FFFFFF">Hide</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>Supplier Names </td>
    <td><input class="form-control" name="SupplierNames" type="text" id="SupplierNames"></td>
    <td>Telephone</td>
    <td><input class="form-control" name="Phone" type="text" id="Phone"></td>
    <td>Email</td>
    <td><input class="form-control" name="Email" type="text" id="Email"></td>
  </tr>
  <tr>
    <td>Web URL </td>
    <td><input class="form-control" name="web" type="text" id="web"></td>
    <td>Phy Address </td>
    <td><input class="form-control" name="PhyAddress" type="text" id="PhyAddress"></td>
    <td>Post Address </td>
    <td><input class="form-control" name="PostAddress" type="text" id="PostAddress"></td>
  </tr>
  <tr>
    <td>Town</td>
    <td><input class="form-control" name="Town" type="text" id="Town"></td>
    <td>Country</td>
    <td><?php
        $countrylist = "<select class='form-control' id='country' name='country' class=small>";
        $countrylist .= "<option class='form-control' value=''>--Please select--</option>";
        $sSqlWrk = "SELECT `Id`, `CountryName` FROM `country` order by CountryName ";
        $rswrk = mysqli_query($conn, $sSqlWrk) or die("Failed to execute query at line " . __LINE__ . ": " . mysqli_error($conn) . '<br>SQL:' . $sSqlWrk);
        if ($rswrk) {
          $rowcntwrk = 0;
          while ($datawrk = mysqli_fetch_array($rswrk)) {
            $countrylist .= "<option class='form-control' value=\"" . htmlspecialchars($datawrk[1]) . "\"";
            if ($datawrk["CountryName"] == @$x_country) {
              $countrylist .= " selected";
            }
            $countrylist .= ">" . $datawrk["CountryName"] . "</option>";
            $rowcntwrk++;
          }
        }
        @mysqli_free_result($rswrk);
        $countrylist .= "</select>";
        echo $countrylist;
        ?></td>
    <td>Credit Terms </td>
    <td><input class="form-control" name="CreditTerms" type="text"  id="CreditTerms"></td>
  </tr>
  <tr>
    <td>Credit Limit Amount </td>
    <td><input class="form-control" name="CreditLimitAmt" type="text"  id="CreditLimitAmt"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="btn btn-success" type="button" name="Button" value="Search" onclick="SendSearchSupplier()" style="Float:right; "></td>
  </tr>
</table>