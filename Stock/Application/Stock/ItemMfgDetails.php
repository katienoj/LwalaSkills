<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];

$sql = mysqli_query($conn, "SELECT * FROM ItemMfgDetails WHERE StockId='$StockId'") or die(mysqli_error($conn));

if (mysqli_num_rows($sql) == 0) {
  $MfgName = 'No details';
  $DateMfg = 'No details';
  $ExprDate = 'No details';
  $OtherMfgDetails = 'No details';
  $sqlNew = "INSERT INTO ItemMfgDetails(Manufacturer,DateMfg,ExprDate,OtherDetails) VALUES('','','','')";
  $SQL = mysqli_query($conn, $sqlNew) or die(mysqli_error($conn));
  $DetailsId = mysqli_insert_id($conn);
} else {
  while ($recs = mysqli_fetch_array($sql)) {
    $DetailsId = $recs['Id'];
    $MfgName = $recs['Manufacturer'];
    $DateMfg = dteconvert($recs['DateMfg']);
    $ExprDate = dteconvert($recs['ExprDate']);
    $OtherMfgDetails = $recs['OtherDetails'];
  }
}

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="400" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop"><?php echo StockName($StockId); ?>'s Mfg Details</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <div align="right" class="td_bottom">Manufacturer</div>
    </td>
    <td ><?php echo $MfgName; ?></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Date of manufacture </div>
    </td>
    <td ><?php echo $DateMfg; ?></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Expiry Date </div>
    </td>
    <td ><?php echo $ExprDate; ?></td>
  </tr>
  <tr>
    <td class="td_bottom">
      <div align="right">Other mfg Details </div>
    </td>
    <td ><?php echo $OtherMfgDetails; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-warning" type="button" name="Button" value="Edit These Details" style="float:right;" onclick="EditMfgDetails('<?php echo $DetailsId; ?>')" /></td>
  </tr>
</table>