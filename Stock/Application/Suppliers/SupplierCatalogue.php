<?
//database connection
require_once '../../../Main/Config/db_conn.php';
require_once "../../includes/StockFunctions.php";

if($_REQUEST['cat_id'] == 'undefined'){
$cat_id = 0;
}else{
$cat_id = $_REQUEST['cat_id'];
}

$getParent = mysqli_query($conn, "SELECT ParentId FROM StockCategory WHERE id = $cat_id AND del = 0")or die(mysqli_error($conn));
$resultParent = mysqli_fetch_assoc($getParent );
$parent_id = $resultParent['ParentId'];
?>
<link href="../styles/interface.css" rel="stylesheet" type="text/css" />

<style type="text/css">
  body {
    background-color: #FFFFFF;
  }
</style>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td width="16%" height="6"></td>
  </tr>
  <tr>
    <? if($cat_id == 0){ ?>
    <td class="dotted-line" align="center"><span class="contentTitle"><?php echo CatName($cat_id); ?></span></td>
    <? }else{ ?>
    <td width="16%" class="dotted-line"><input type="image" src="../Main/Layout/images/backbtn.png" width="30" height="30" alt="Go back" onclick="ViewSuppliers(<? echo $parent_id; ?>);" /></td>
    <td width="84%" class="dotted-line" align="center"><span class="contentTitle"><?php echo CatName($cat_id); ?></span></td>
    <? } ?>
  </tr>
</table>
<?

//retrieve all categories and display in list
$getCat = mysqli_query($conn, "SELECT * FROM StockCategory WHERE  ParentId = '".$cat_id."'  AND del = 0 ORDER BY CatName ASC ")or die(mysqli_error($conn));
$catRows = mysqli_num_rows($getCat);
if($catRows > 0){
?>

<table width="98%" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <?
$countCat = 0;
while($resulCat = mysqli_fetch_assoc($getCat)){
$CatImage=$resulCat['CatImage'];
if($CatImage=='')
  {
  $CatImage='folder_icon.png';
  }
?>

    <td width="52" align="center" ><a href="javascript:void(0)" onclick="ViewSuppliers(<? echo $resulCat['Id']; ?>)" style="text-decoration:none;"> <img src="Application/Stock/CatImages/<?php echo $CatImage; ?>" width="50" height="53" border="0" /></a></td>
    <td width="775" ><a href="javascript:void(0)" onclick="ViewSuppliers(<? echo $resulCat['Id']; ?>)" style="text-decoration:none;" >
        <? echo ucwords($resulCat['CatName']); ?>
      </a></td>

    <?
$countCat = $countCat + 1;

if($countCat <6){
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td height="10"></td>
  </tr>
</table>



<?

//retrieve all products and display in list
$getProd = mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE CatId = $cat_id ")or die(mysqli_error($conn));
$prodRows = mysqli_num_rows($getProd);
if($prodRows > 0){
?>

<table width="98%" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
  <tbody style="overflow-y:auto; overflow-x:hidden; height:250px; max-height:250px;">
    <tr>
      <?
$countProd = 0;
while($resulProd = mysqli_fetch_assoc($getProd)){
//echo $countProd;
$SupplierId=$resulProd['SupplierId'];
$SupplierDetails=explode(':',SupplierDetails($SupplierId));

//echo SupplierDetails($SupplierId);
?>

      <td width="20" align="center"><input type="image" src="Application/Suppliers/SupplierLogos/<?php echo $SupplierDetails[1]; ?>" width="50" height="50" onclick="ViewSupplierDetails('<? echo $resulProd['SupplierId']; ?>','<? echo $cat_id; ?>')" /></td>
      <td width="723" ><a href="javascript: void(0)" onclick="ViewSupplierDetails('<? echo $resulProd['SupplierId']; ?>','<? echo $cat_id; ?>')" style="text-decoration:none;">
          <? echo ucwords($SupplierDetails[0]); ?>
        </a></td>

      <?
$countProd = $countProd + 1;
if($countProd < 6){
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
  </tbody>
</table>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<? if($catRows == 0 && $prodRows == 0){ ?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="center" >Sorry,Lwala is not aware of any supplier for the selected catregory </td>
  </tr>
</table>
<? } ?>