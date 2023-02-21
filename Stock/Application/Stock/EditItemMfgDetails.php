<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$DetailsId = $_REQUEST['DetailsId'];
$sql = mysqli_query($conn, "SELECT * FROM ItemMfgDetails WHERE Id='$DetailsId'") or die(mysqli_error($conn));

while ($recs = mysqli_fetch_array($sql)) {
  $DetailsId = $recs['Id'];
  $StockId = $recs['StockId'];
  $MfgName = $recs['Manufacturer'];
  $DateMfg = dteconvert($recs['DateMfg']);
  $ExprDate = dteconvert($recs['ExprDate']);
  $OtherMfgDetails = $recs['OtherDetails'];
}

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="400" border="0" bgColor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Edit <?php echo StockName($StockId); ?>'s Mfg Details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <div align="right" class="td_bottom">Manufacturer</div>
    </td>
    <td><input class="form-control" name="MfgName" type="text" id="MfgName" value="<?php echo $MfgName; ?>" onblur="normal_string(getElementById('MfgName'),'Invalid manufacturer Name typed in')" /></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Date of manufacture </div>
    </td>
    <td><input class="form-control" name="DateMfg" type="text" id="DateMfg" value="<?php echo $DateMfg; ?>" onclick='scwShow(this,event);' onfocus='scwShow(this,event);' readonly="true" onblur="normal_string(getElementById('DateMfg'),'Invalid Date of manufacture typed in')" /></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Expiry Date </div>
    </td>
    <td><input class="form-control" name="ExprDate" type="text" id="ExprDate" value="<?php echo $ExprDate; ?>" onclick='scwShow(this,event);' onfocus='scwShow(this,event);' readonly="true" onblur="normal_string(getElementById('ExprDate'),'Invalid Expiry Date typed in')" /></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Other mfg Details </div>
    </td>
    <td><textarea class="form-control" name="OtherDetails"  id="OtherDetails" onblur="normal_string(getElementById('OtherDetails'),'Invalid Other manufacture related details typed in')"><?php echo $OtherMfgDetails; ?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="form-control" name="StockId" type="hidden" id="StockId" value="<?php echo $StockId; ?>" />
      <input class="btn btn-success" type="button" name="Button" value="Save" style="float:right;" onclick="CompleteEditMfgDetails('<?php echo $DetailsId; ?>')" />
    </td>
  </tr>
</table>