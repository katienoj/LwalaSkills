<?php
//database connection
include "../php_functions/db_connect.php";
//function that converts MySQL native date format to another one
include "../php_functions/tax_name.php";
//assign variables passed from AJAX script
$product_id = $_REQUEST['product_id'];
$cat_id = $_REQUEST['cat_id'];

//retrieve product fields using product id
$sql = "select prdct_name,selling_price,quantity,vat_tax,specs,pd_date,pd_image,pd_last_update,cat_id from tbl_products where product_id='$product_id'";

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
while (list($prdct_name, $selling_price, $quantity, $vat_tax, $specs, $pd_date, $pd_image, $pd_last_update, $cat) = mysqli_fetch_row($result)) {

  $tax = tax_name($vat_tax);
?>

  <link href="../styles/interface.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
    
    .style1 {
      font-weight: bold
    }
    
  </style>
  <input class="form-control" name="img_name" id="img_name" type="hidden" value="<? echo $prdct_name; ?>" />

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="formborder">
    <tr>
      <td colspan="9">
        <div class="drsMoveHandle">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="formtop">
              <td width="50%" class="formheading"><?php echo ucwords(strtolower($prdct_name)); ?></td>
              <td width="15%"><a href="javascript:void(0)" onclick="editproduct('<?php echo $product_id; ?>')">Edit</a></td>
              <td width="15%"><a href="javascript:void(0)" onclick="deleteproduct('<?php echo $product_id; ?>','<?php echo $cat; ?>')">Delete</a></td>
              <td width="22%" align="right"><input class="form-control" name="minimize" src="assets/images/icons/minimize.png" type="image" id="minimize" /><input class="form-control" name="close" type="image" id="close" src="assets/images/icons/close.png" onclick="closePopupDiv()" /></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td width="19">&nbsp;</td>
      <td width="34" align="center" valign="middle"><img src="assets/images/products/large/<? echo $pd_image; ?>" class="table" /></td>
      <td colspan="2" valign="top" >
        <table width="100%" border="0" cellpadding="3" cellspacing="1">
          <tr>
            <td width="34%" bgcolor="#ECECEC" >Name </td>
            <td width="66%" bgcolor="#ECECEC" ><?php echo ucwords(strtolower($prdct_name)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" >Price </td>
            <td bgcolor="#ECECEC" ><?php echo "Ksh " . ucwords(strtolower($selling_price)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" >Tax</td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($tax)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" >Specs</td>
            <td bgcolor="#ECECEC" ><?php echo ucwords(strtolower($specs)); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" >Date entered </td>
            <td bgcolor="#EFEFEF" ><?php echo ucwords(strtolower(dteconvert($pd_date))); ?></td>
          </tr>
          <tr>
            <td bgcolor="#ECECEC" >Last updated</td>
            <td bgcolor="#EFEFEF" ><?php echo ucwords(strtolower(dteconvert($pd_last_update))); ?></td>
          </tr>
        </table>
      </td>
      <td width="20" valign="top" >&nbsp;</td>
    </tr>

    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
  </table>

<?php
}
?>