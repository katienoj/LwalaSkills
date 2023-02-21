<?php
include "../php_functions/db_connect.php";
$cat_id = $_REQUEST['cat_id'];
$sql = "select * from tbl_category where cat_id='$cat_id' and del = 0";
$res = mysqli_query($conn, $sql, $conn) or die(mysqli_error($conn));
while ($recs = mysqli_fetch_array($res)) {
  $cat_name = $recs['cat_name'];
  $cat_desc = $recs['cat_description'];
}
?>

<link rel="stylesheet" href="../styles/interface.css" />



<table width="400" border="0" align="center" cellpadding="3" bgcolor="#EBF3FF" cellspacing="0" class="formborder">
  <tr class="formtop">
    <td colspan="5" class="divformheader">
      <div class="drsMoveHandle">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="formheading">
            <td width="69%" class="formheading"><strong>Edit Category </strong></td>
            <td width="31%" align="right" class="formheading">
              <input class="form-control" name="minimize" src="assets/images/icons/minimize.png" type="image" id="minimize" /><input class="form-control" name="close" type="image" id="close" src="assets/images/icons/close.png" onclick="closePopupDiv()" />
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>

  <tr>
    <td colspan="3" align="left" >&nbsp;</td>
  </tr>
  <tr>
    <td width="12" align="left" >&nbsp;</td>
    <td width="93" align="left" >Category Name </td>
    <td width="273" colspan="3" align="left" >
      <input class="form-control" name="cat_name" type="text" id="cat_name" onblur="namez(getElementById('cat_name'),'The Unit name typed in is not a valid Human  name\nHint:Remove anything like *&^%$#@!()&*<>?{}+_|>< in the category Name')" value="<?php echo $cat_name; ?>" size="35" />
    </td>
  </tr>
  <tr>
    <td align="left" >&nbsp;</td>
    <td align="left" >Description </td>
    <td colspan="3" align="left" ><label>
        <textarea class="form-control" name="cat_description" cols="25" rows="2" id="cat_description"><?php echo $cat_desc; ?></textarea>
        <input class="form-control" type="hidden" name="cat" id="cat" value="<?php echo $cat_id; ?>" />
      </label></td>
  </tr>
  <tr>
    <td colspan="3" align="left" bgcolor="#BAD6FB">
      <table width="100%" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><span >&nbsp;&nbsp;
              <input class="btn btn-warning" type="reset" name="Submit2" value="Reset" onclick="resetForm();" />
              &nbsp;&nbsp;
              <input class="btn btn-success" type="button" name="Submit" value="Save" onclick="edit_category()" />
              &nbsp;</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</form>