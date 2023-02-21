<?php
include "../../../Main/Config/db_conn.php";

?>

<link href="../styles/interface.css" rel="stylesheet" type="text/css" />

<table width="800" border="0" BgColor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">ADD MAIN</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="800" border="0">
        <tr>
          <td class="table_sub_modules">&nbsp;</td>
        </tr>
        <tr>
          <td>
            <table width="800" border="0">
              <tr>
                <td>Main Category</td>
                <td><input class="form-control" name="ParentCatName" type="text" id="ParentCatName" size="25" onblur="normal_string(getElementById('ParentCatName'),'Invalid Parent Category typed in')" /></td>
              </tr>
              <tr>
                <td> Description </td>
                <td><textarea class="form-control" name="Description" cols="20" rows="3"  id="Description" onblur="normal_string(getElementById('Description'),'Invalid  description typed in')"></textarea></td>
              </tr>
              <tr>

                <td bgcolor="#D1D1D1">*-Required field
                  <input class="btn btn-info" type="button" name="save" value="Save" onclick="AddMainCat('add');" style="float:right;" />
                </td>
              </tr>


            </table>
          </td>
        </tr>

        <tr>
          <td>
            <table width="100%" border="0">


              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>