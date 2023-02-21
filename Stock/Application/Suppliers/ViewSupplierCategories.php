<?
include "../../../Main/Config/db_conn.php";


?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />

<table width="750" height="408" border="0" style="border:solid 1px #B7B7FF; background-color:#E8E8E8;">
  <tr>
    <td height="28" colspan="3">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Supplier Categories</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="29" colspan="3" valign="top"><a href="#" onclick="ViewSuppliersUnderCategory()">View Suppliers</a> </td>
  </tr>
  <tr>
    <td height="202" colspan="3" valign="top">
      <div id="showCategories" style="height:350px;"></div>
    </td>
  </tr>
  <tr>
    <td width="232">Add Supppliers to selected category </td>
    <td width="246"><input class="btn btn-info" type="button" name="Button" value="Add Supplier" onClick="ShowUnselectedSuppliers()" />
      <input class="form-control" type="hidden" name='CatId' id='CatId' />
      <input class="form-control" type="hidden" name='cat' id='cat' />
      <input class="form-control" type="hidden" name='cat_name' id='cat_name' />
      <input class="form-control" type="hidden" name='category' id='category' />
      <input class="form-control" type="hidden" name='cat_description' id='cat_description' />
    </td>
    <td width="256">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>