<?php
require_once '../../../Main/Config/db_conn.php';

$SupplierId = $_REQUEST['SupplierId'];
$CatId = $_REQUEST['CatId'];
$sql = "SELECT * FROM SuppliersTable WHERE Id='$SupplierId' ORDER BY Id DESC";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while (list($Id, $SupplierNames, $PhyAddress, $PostAddress, $Email, $Phone, $Website, $Town, $Country, $CreditTerms, $CreditLimitAmount, $SupplierLogo, $DateAdded, $CreditLimitAmtCurrency) = mysqli_fetch_row($result)) {
?>
  <link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
  <table width="100%" border="0" bgcolor="#E4E4E4" class="formborder">
    <tr>
      <td colspan="4">
        <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
          <tr>
            <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Edit <?php echo $SupplierNames; ?>'s details</td>
            <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <div align="right">Supplier Names </div>
      </td>
      <td><input class="form-control" name="SupplierNames" type="text" id="SupplierNames" onblur="normal_string(getElementById('SupplierNames'),'Invalid Supplier Names typed in')" value="<?php echo $SupplierNames; ?>"></td>
      <td>
        <div align="right">Telephone<br>
          Format(+254-720-123456)</div>
      </td>
      <td><input class="form-control" name="Phone" type="text" id="Phone" onblur="phone_string(getElementById('Phone'),'Invalid Phone Number typed in')" value="<?php echo $Phone; ?>"></td>
    </tr>
    <tr>
      <td>
        <div align="right">Email</div>
      </td>
      <td><input class="form-control" name="Email" type="text" id="Email" onblur="email_string(getElementById('Email'),'Invalid Email typed in')" value="<?php echo $Email; ?>"></td>
      <td>
        <div align="right">Website</div>
      </td>
      <td><input class="form-control" name="web" type="text" id="web" onblur="web_string(getElementById('web'),'Invalid website URL typed in')" value="<?php echo $Website; ?>"></td>
    </tr>
    <tr>
      <td>
        <div align="right">Credit Terms</div>
      </td>
      <td><input class="form-control" name="Email" type="text" id="CreditTerms" value="<?php echo $CreditTerms; ?>"></td>
      <td>
        <div align="right">Credit Limit Amount</div>
      </td>
      <td><input class="form-control" name="web" type="text" id="CreditLimitAmt" value="<?php echo $CreditLimitAmount; ?>"></td>
    </tr>
    <tr>
      <td>
        <div align="right">Physical Address</div>
      </td>
      <td><textarea name="PhyAddress" id="PhyAddress" onblur="normal_string(getElementById('PhyAddress'),'Invalid Physical Address typed in')"><?php echo $PhyAddress; ?></textarea></td>
      <td>
        <div align="right">Post Address</div>
      </td>
      <td><textarea name="PostAddress" id="PostAddress" onblur="normal_string(getElementById('PostAddress'),'Invalid Postal Address typed in')"><?php echo $PostAddress; ?></textarea></td>
    </tr>
    <tr>
      <td>
        <div align="right">Town</div>
      </td>
      <td><input class="form-control" name="Town" type="text" id="Town" onblur="normal_string(getElementById('Town'),'Invalid Supplier Town typed in')" value="<?php echo $Town; ?>"></td>
      <td>
        <div align="right">Country</div>
      </td>
      <td><?php
          $countrylist = "<select id='country' name='country' class='form-control'>";
          $countrylist .= "<option class='form-control'value='$Country'>$Country</option>";
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
    </tr>
    <tr>
      <td>
        <div align="right">Supplier Logo </div>
      </td>
      <td>
        <form action="Application/Suppliers/UploadSupplierLogo.php" method="post" enctype="multipart/form-data" name="UploadSupplierLogo" target="uploadSupplier" id="UploadSupplierLogo">
          <iframe name="uploadSupplier" src="#" width="400" height="100" style="display:none"> </iframe>
          <input class="form-control" name="imagefile" id="imagefile" type="file" size="25" readonly onchange="UploadedPhoto_validation(getElementById('imagefile'))" /><input class="form-control" type="hidden" name="prevLogo" id="prevLogo" value="<?php echo $SupplierLogo; ?>">
        </form>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" bgcolor="#D7D7D7">
        <input class="form-control" type="hidden" name="SupplierId" id="SupplierId" value="<?php echo $Id; ?>">
        <input class="form-control" type="text" name="CatNo" id="CatNo" value="<?php echo $CatId; ?>">
        <input class="btn btn-success" type="button" name="Button" value="Save" style="float:right;" onclick="StoreSupplier('edit')">
      </td>
    </tr>
  </table>
<?php } ?>