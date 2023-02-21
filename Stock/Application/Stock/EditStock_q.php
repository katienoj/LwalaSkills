<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];

?>

<link href="../styles/interface.css" rel="stylesheet" type="text/css" />
<table width="780" border="0" cellpadding="3" cellspacing="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td height="28" colspan="5">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Edit <?php echo StockName($StockId); ?>'s details </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <?php

//retrieve product fields using product id
$sql="SELECT * FROM StockTable WHERE Id='$StockId'";

$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
while (list($Id,$StockName,$quantity,$VAT,$cat,$UnitId,$specs,$StockImage,$CatImage,$StockDate,$StockLastUpdate,$del,$minStock,$minReorder,$maxReorder,$maxStock,$OpeningStock,$Barcode,$StockPrice) = mysqli_fetch_row($result)) {
?>
  <tr>
    <td width="137">
      <div align="right">Product Pic</div>
    </td>
    <td width="328">
      <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
        <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
        <input class="form-control" name="imagefile" id="imagefile" type="file"  size="25" readonly="true" onchange="UploadedPhoto_validation(getElementById('imagefile'))" />
      </form>
      <!--<input class="form-control" name="pd_img" type="file"  id='pd_img' " />-->
    </td>
    <td width="158">
      <div align="right">Barcode</div>
    </td>
    <td width="358" colspan="2"><input class="form-control" name="Barcode" type="text" id="Barcode" size="25" value="<?php echo $Barcode; ?>" /></td>
  </tr>
  <tr>
    <td height="39">
      <div align="right">*Stock Name</div>
    </td>
    <td><input class="form-control" name="prdct_name" type="text" id="prdct_name" size="25" onblur="normal_string(getElementById('prdct_name'),'Invalid Stock Name typed in')" value="<?php echo $StockName; ?>" /></td>
    <td>
      <div align="right">*Min Re-Order Level </div>
    </td>
    <td colspan="2"><input class="form-control" name="minReorder" type="text" id="minReorder" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum re Order level typed in')" value="<?php echo $minReorder; ?>" /></td>
  </tr>
  <tr>
    <td>
      <div align="right">*Min Stock Qty </div>
    </td>
    <td><input class="form-control" name="minStock" type="text" id="minStock" size="25" onblur="number_string(getElementById('minReorder'),'Invalid Minimum Stock Quantity typed in')" value="<?php echo $minStock; ?>" /></td>
    <td>
      <div align="right">*Max Reorder Level </div>
    </td>
    <td colspan="2"><input class="form-control" name="MaxReorder" type="text" id="MaxReorder" size="25" onblur="number_string(getElementById('maxReorder'),'Invalid Maxmium reorder level typed in')" value="<?php echo $maxReorder; ?>" /></td>
  </tr>
  <tr>
    <td>
      <div align="right">*Max Stock Qty </div>
    </td>
    <td><input class="form-control" name="maxStock" type="text" id="maxStock" size="25" onblur="number_string(getElementById('maxStock'),'Invalid Maximum Stock Quantity typed in')" value="<?php echo $maxStock; ?>" /></td>
    <td>
      <div align="right">*Opening Stock Qty </div>
    </td>
    <td colspan="2"><input class="form-control" name="OpeningStock" type="text" id="OpeningStock" size="25" onblur="number_string(getElementById('OpeningStock'),'Invalid Opening Stock Quantity typed in')" value="<?php echo $OpeningStock; ?>" /></td>
  </tr>
  <tr>
    <td>
      <div align="right">*Category</div>
    </td>
    <td><input class="form-control" name="category" type="text" id="category" size="25" readonly="true" value="<?php echo CatName($cat); ?>" />
      <input class="form-control" name="cat" type="hidden" id="cat" value="<?php echo $cat; ?>" />
      <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
      <input class="btn btn-warning" name="button" type="button" onclick="navigateCat();" value="Browse" />
    </td>
    <td>
      <div align="right">StockPrice</div>
    </td>
    <td colspan="2"><input class="form-control" name="StockPrice" type="text" id="StockPrice" size="25" onblur="number_string(getElementById('StockPrice'),'Invalid Stock Price typed in')" value="<?php echo $StockPrice; ?>" /></td>
  </tr>
  <tr>
    <td>
      <div align="right">Item Description </div>
    </td>
    <td><textarea name="desc" cols="20" rows="3" class="form-control" id="desc" onblur="normal_string(getElementById('desc'),'Invalid Stock description typed in')"></textarea></td>
    <td>&nbsp;</td>
    <td colspan="2"><input class="form-control" name="StockId" type="hidden" id="StockId" value="<?php echo $StockId; ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#D1D1D1">*-Required</td>
    <td colspan="4" bgcolor="#D1D1D1"><input class="btn btn-success" type="button" name="save" value="Save" onclick="StoreStockItem('edit');" style="float:right;" /></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#D1D1D1" >&nbsp;</td>
  </tr>
</table>
<?php
}
?>
<!--return chekform('add')-->