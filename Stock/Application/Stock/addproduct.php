<link href="../styles/interface.css" rel="stylesheet" type="text/css" />


<table width="100%" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" class="formborder">
  <tr class="formtop">
    <td colspan="8" class="divformheader">
      <div class="drsMoveHandle">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="formheading">
            <td width="83%" class="formheading"><strong>Add Product </strong></td>
            <td width="17%" align="right" class="formheading"><input name="minimize" src="assets/images/icons/minimize.png" type="image" id="minimize" onclick="" />
              <input name="close" type="image" id="close" src="assets/images/icons/close.png" onclick="closePopupDiv()" />
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="106">
      <div id="photofields" style="display:none">
        <input class="form-control" name="photos" type="text" id="photos" size="2" disabled="true" />
        <input class="form-control" name="photoz" type="text" id="photoz" size="2" disabled="true" />
      </div>
    </td>
    <td width="241" >Product Pic</td>
    <td colspan="2">
      <form name="imgupload" id="imgupload" method="post" action="products/product_upload/imageupload.php?subpage=upload" enctype="multipart/form-data" target="upload">
        <iframe name="upload" src="#" width="400" height="100" style="display:none"> </iframe>
        <input class="form-control" name="imagefile" id="imagefile" type="file" size="35" readonly="true" onchange="fileup()">
      </form>
      <!--<input class="form-control" name="pd_img" type="file"  id='pd_img' " />-->
    </td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td >Product Name</span></td>
    <td colspan="2"><input class="form-control" name="prdct_name" type="text" id="prdct_name" size="25" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Quantity</span></td>
    <td colspan="2"><input class="form-control" name="qty" type="text" id="qty" size="25" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Tax</td>

    <td colspan="2"><?php
                    include "../php_functions/db_connect.php";
                    $sql = "select * from tbl_tax";
                    $res = mysqli_query($conn, $sql, $conn) or die(mysqli_error($conn));
                    echo "<select class='form-control' name='tax' type='text' class='small' id='tax'>";
                    while ($recs = mysqli_fetch_array($res)) {
                      $id = $recs['tax_id'];
                      $tax_name = $recs['tax_name'];
                      $tax_val = $recs['tax_val'];
                      echo "<option class='form-control' value='$id'>$tax_name($tax_val%)</option>";
                    }
                    echo "</select>";
                    ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Selling Price</span></td>
    <td colspan="2"><input class="form-control" name="price" type="text" id="price" size="25" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Product Specifications</span></td>
    <td colspan="2"><textarea class="form-control" name="desc" cols="20" rows="3" id="desc"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >Category</span></td>
    <td width="144">
      <input class="form-control" name="category" type="text" id="category" size="25" readonly="true" />
      <input class="form-control" name="cat" type="hidden" id="cat" />
      <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
    </td>
    <td width="476"><input class="btn btn-warning" type="button"  value="Browse" onclick="navigateCat();" /></td>
  </tr>

  <tr>
    <td colspan="8" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#BAD6FB">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><input class="btn btn-warning" type="reset" name="Submit2" value="Reset" onclick="resetForm();" />
            &nbsp;&nbsp;
            <input class="btn btn-success" type="button" name="save" value="Save" onClick="storeproduct();" />
            &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!--return chekform('add')-->