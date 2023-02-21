<?php
//database connection
include "../../../Main/Config/db_conn.php";
//function that converts MySQL native date format to another one

//assign variables passed from AJAX script
$StockId = $_REQUEST['StockId'];
$CatId = $_REQUEST['CatId'];

//retrieve product fields using product id
$sql = "SELECT * FROM StockTable WHERE Id='$StockId'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
while (list($Id, $StockName, $quantity, $VAT, $cat, $UnitId, $specs, $StockImage, $CatImage, $StockDate, $StockLastUpdate, $del, $minStock, $minReorder, $maxReorder, $maxStock, $OpeningStock, $Barcode, $StockPrice) = mysqli_fetch_row($result)) {
  if ($StockImage == '') {
    $StockImage = 'no_img.gif';
  }

?>

  <link href="../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
    
    .style1 {
      font-weight: bold
    }
    
  </style>
  <link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
  <input class="form-control" name="img_name" id="img_name" type="hidden" value="<? echo $StockName; ?>" />

  <table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#E4E4E4" class="formborder">
    <tr>
      <td colspan="7" class="formtop">
        <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
          <tr>
            <td class="formtop"><?php echo ucwords(strtolower($StockName)); ?></td>
            <td width="19%" class="formtop"><a href="javascript:void(0)" onclick="ShowStockPackaging(<?php echo $StockId; ?>)">Item Packaging </a></td>
            <td width="21%" class="formtop"><a href="javascript:void(0)" onclick="ShowItemMfgDetails(<?php echo $StockId; ?>)">Item Mfg Details </a></td>
            <td width="5%" class="formtop"><a href="javascript:void(0)" onclick="EditStock(<?php echo $StockId; ?>)">Edit</a></td>
            <td width="7%" class="formtop"><a href="javascript:void(0)" onclick="DeleteStock('<?php echo $StockId; ?>','<?php echo $cat; ?>')">Delete</a></td>
            <td width="4%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td width="19">&nbsp;</td>
      <td width="34" align="center" valign="middle"><img src="Application/Stock/StockImages/<? echo $StockImage; ?>" class="table" width="150" height="150" /></td>
      <td valign="top" >
        <table width="100%" border="0" cellpadding="3" cellspacing="1">
          <tr>
            <td width="22%" bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Name </div>
            </td>
            <td width="21%" bgcolor="#ECECEC" ><?php echo ucwords(strtolower($StockName)); ?></td>
            <td width="26%" bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Min Re order Level </div>
            </td>
            <td width="31%" bgcolor="#ECECEC" ><?php echo ucwords(strtolower($minReorder)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Current Stock </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo "Ksh " . ucwords(strtolower($quantity)); ?></td>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Max Re order Level </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($maxReorder)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Min Stock </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($minStock)); ?></td>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Date entered </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower(dteconvert($StockDate))); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Max Stock </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($maxStock)); ?></td>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Last updated</div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower(dteconvert($StockLastUpdate))); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Barcode</div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($Barcode)); ?></td>
            <td rowspan="2" bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Stock Description </div>
            </td>
            <td rowspan="2" bgcolor="#ECECEC" ><?php echo ucwords(strtolower($specs)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" class="td_bottom">
              <div align="right">Stock Price </div>
            </td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($Barcode)); ?></td>
          </tr>

        </table>
      </td>
    </tr>

    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>

<?php
}
?>