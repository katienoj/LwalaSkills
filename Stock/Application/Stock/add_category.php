<link href="../styles/interface.css" rel="stylesheet" type="text/css" />


<table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" class="formborder">
  <tr class="formtop">
    <td colspan="9" class="divformheader">
      <div class="drsMoveHandle">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr class="formheading">
            <td class="formheading"><strong>Add Category </strong></td>
            <td align="right" class="formheading">
              <input class="form-control" name="minimize" src="assets/images/icons/minimize.png" type="image" onclick=""><input class="form-control" name="close" type="image" id="close" src="assets/images/icons/close.png" onclick="closePopupDiv()" />
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td colspan="4" >&nbsp;</td>
  </tr>
  <tr>
    <td width="65" >&nbsp;</td>
    <td width="269" >Category</td>
    <td colspan="2"><input class="form-control" name="cat_name" type="text" id="cat_name" size="35" /></td>
  </tr>
  <tr>
    <td width="65" >&nbsp;</td>
    <td width="269" >Description </td>
    <td colspan="2"><textarea class="form-control" name="cat_description" cols="25" rows="2" id="cat_description"></textarea><input class="form-control" type="hidden" name="CatId" id="CatId" value="" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Parent Category</span></td>
    <td width="239">
      <input class="form-control" name="category" type="text" id="category" size="35" readonly="true" />
      <input class="form-control" name="cat" type="hidden" id="cat" />
      <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
    </td>
    <td width="394"><input class="btn btn-warning" name="button" type="button" onclick="navigateCat();" value="Browse" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#BAD6FB">
      <table width="100%" border="0" cellspacing="0">
        <tr>
          <td align="right">
            <input class="btn btn-warning" type="button" name="Button" value="Reset" onclick="resetForm();" />
            &nbsp;&nbsp;&nbsp;
            <input class="btn btn-success" type="button" name="Submit" value="Save" onClick="CategoryAction()" />
            &nbsp;
          </td>
        </tr>
        <tr> </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
</table>