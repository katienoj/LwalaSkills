<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" height="140" border="0">
  <tr>
    <td colspan="6">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="83%" class="formtop">Search Stock </td>
          <td width="17%" class="formtop"> <input class="form-control" type="image" src="../Main/Layout/images/UpIcon.gif" width="16" height="16" style="float:right;" onclick="inter=setInterval('hideSearchDiv()',3); return false;" /><a href="#" onclick="inter=setInterval('hideSearchDiv()',3); return false;" style="cursor:hand; text-decoration:none; float:right; color:#FFFFFF">Hide</a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="13%">Stock Name </td>
    <td width="18%"><input class="form-control" name="StockName" type="text"  id="StockName"></td>
    <td width="13%">Batch No </td>
    <td width="18%"><input class="form-control" name="BarcodeNo" type="text"  id="BarcodeNo"></td>
    <td width="11%">Stock Category </td>
    <td width="27%"><input class="form-control" name="category" type="text"  id="category" size="25" readonly="true" />
      <input class="form-control" name="cat" type="hidden" id="cat" />
      <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
      <input class="form-control" name="button" type="button"  onclick="navigateCat();" value="Browse" />
    </td>
  </tr>
  <tr>
    <td>Min Reorder Level </td>
    <td><input class="form-control" name="minReorder" type="text"  id="minReorder"></td>
    <td>Max Reorder Level </td>
    <td><input class="form-control" name="MaxReorder" type="text"  id="MaxReorder"></td>
    <td>Opening Stock </td>
    <td><input class="form-control" name="OpeningStock" type="text"  id="OpeningStock"></td>
  </tr>
  <tr>
    <td>Min Stock Qty </td>
    <td><input class="form-control" name="minStock" type="text" id="minStock"></td>
    <td>Max Stock Quantity </td>
    <td><input class="form-control" name="MaxStock" type="text" id="MaxStock"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="btn btn-warning" type="submit" name="Submit" value="Search" style="float:right;" onClick="SendStockSearch()"></td>
  </tr>
</table>