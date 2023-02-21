<?php
//database connection
include "../php_functions/db_connect.php";
global $parent_id;

if($_REQUEST['cat_id'] == 'undefined'){
$cat_id = 0;
}else{
$cat_id = $_REQUEST['cat_id'];
}

$getParent = mysqli_query($conn, "SELECT parent_id FROM tbl_category WHERE cat_id = $cat_id")or die(mysqli_error($conn));
$resultParent = mysqli_fetch_assoc($getParent );
$parent_id = $resultParent['parent_id'];
?>
<link href="../styles/interface.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <? if($cat_id == 0){ ?>
    <td class="dotted-line">&nbsp;</td>
    <? }else{ ?>
    <td class="dotted-line"><a href="javascript:void(0)" onclick="upOneCat(<? echo $parent_id; ?>);">up one level </a></td>
    <? } ?>
  </tr>
</table>
<?

//retrieve all categories and display in list
$getCat = mysqli_query($conn, "SELECT * FROM tbl_category WHERE del!= 'yes' AND parent_id = $cat_id ORDER BY cat_name ASC ")or die(mysqli_error($conn));
$catRows = mysqli_num_rows($getCat);
if($catRows > 0){
?>
<table width="98%" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <?
$countCat = 0;
while($resulCat = mysqli_fetch_assoc($getCat)){

?>

    <td width="52" align="center" ><a href="javascript:void(0)" onclick="catalogue(<? echo $resulCat['cat_id']; ?>)"><img src="../ordertracking/products/assets/images/icons/folder_icon.png" width="50" height="53" border="0" /></a></td>
    <td width="775" ><a href="javascript:void(0)" onclick="catalogue(<? echo $resulCat['cat_id']; ?>)">
        <? echo ucwords($resulCat['cat_name']); ?>
      </a></td>

    <?
$countCat = $countCat + 1;

if($countCat < 4){
#### do nothing
}else{
?>

  <tr>
    <?
$countCat = 0;
}
}

}
?>
  </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10"></td>
  </tr>
</table>



<?

//retrieve all products and display in list
$getProd = mysqli_query($conn, "SELECT * FROM tbl_products WHERE del!= 'yes' AND cat_id = $cat_id ORDER BY prdct_name ASC ")or die(mysqli_error($conn));
$prodRows = mysqli_num_rows($getProd);
if($prodRows > 0){
?>

<table width="98%" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <?
$countProd = 0;
while($resulProd = mysqli_fetch_assoc($getProd)){

?>

    <td width="20" align="center"><a href="javascript: void(0)" onclick="disp_product_details(<? echo $resulProd['product_id']; ?>,<? echo $cat_id; ?>)"><img src="assets/images/products/thumbs/<? echo $resulProd['pd_thumbnail']; ?>" style="padding:2px; border:1px solid #004040;" /></a></td>
    <td width="723" ><a href="javascript: void(0)" onclick="disp_product_details(<? echo $resulProd['product_id']; ?>,<? echo $cat_id; ?>)">
        <? echo ucwords($resulProd['prdct_name']); ?>
      </a></td>

    <?
$countProd = $countProd + 1;
if($countProd < 5){
### do nothing
}else{
?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <?
$countProd = 0;
}

}

}
?>
  </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<? if($catRows == 0 && $prodRows == 0){ ?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" >Sorry, no products in database. </td>
  </tr>
</table>
<? } ?>