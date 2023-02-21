<link href="../styles/interface.css" rel="stylesheet" type="text/css" />

<?php
//database connection
include "../../../Main/Config/db_conn.php";
global $parent_id;

if ($_REQUEST['cat_id'] == 'undefined') {
  $cat_id = 0;
} else {
  $cat_id = $_REQUEST['cat_id'];
}
//retrieve all categories and display in list
$getCat = mysqli_query($conn, "SELECT * FROM StockCategory WHERE ParentId = $cat_id ORDER BY CatName ASC ") or die(mysqli_error($conn));
$catRows = mysqli_num_rows($getCat);

$getParent = mysqli_query($conn, "SELECT ParentId FROM StockCategory WHERE Id = $cat_id") or die(mysqli_error($conn));
$r = mysqli_num_rows($getParent);
$resultParent = mysqli_fetch_assoc($getParent);
$parent_id = $resultParent['ParentId'];

$getCatName = mysqli_query($conn, "SELECT * FROM StockCategory WHERE Id = '" . $parent_id . "'") or die(mysqli_error($conn));
$s = mysqli_num_rows($getCatName);
$resultCatname = mysqli_fetch_assoc($getCatName);
$cat_name = $resultCatname['CatName'];

if ($r == 0 && $s == 0) {
  $parent_id = 0;
  $cat_name = 'none';
}
?>


<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <?php if ($cat_id == 0) { ?>
      <td class="dotted-line">&nbsp;</td>
    <?php } else { ?>
      <td class="dotted-line"><a href="javascript:void(0)" onclick="upOneCatLevel(<?php echo $parent_id; ?>, '<? echo $cat_name; ?>');">up one level </a></td>
    <?php } ?>
  </tr>
</table>
<table width="400" align="center" cellpadding="3" cellspacing="1" style=" height:100px;  overflow:auto;">
  <tr>
    <?php
    $countCat = 0;
    while ($resulCat = mysqli_fetch_assoc($getCat)) {
      $CatImage = $resulCat['CatImage'];
      if ($CatImage == '') {
        $CatImage = 'folder_icon.png';
      }
    ?>

      <td width="52" align="center" valign="top" ><a href="javascript: void(0)" onclick="navigateCat(<?php echo $resulCat['Id']; ?>, '<?php echo ucwords($resulCat['CatName']); ?>')" style="text-decoration:none;"> <img src="Application/Stock/CatImages/<?php echo $CatImage; ?>" border="0" width="40" height="40" /></a></td>
      <td width="400" valign="top" ><a href="javascript: void(0)" onclick="navigateCat(<?php echo $resulCat['Id']; ?>,'<?php echo ucwords($resulCat['CatName']); ?>')" style="text-decoration:none;"><?php echo ucwords($resulCat['CatName']); ?></a></td>

      <?php
      $countCat = $countCat + 1;

      if ($countCat < 4) {
        #### do nothing
      } else {
      ?>

  <tr>
<?php
        $countCat = 0;
      }
    }
?>
  </tr>
</table>
<table width="400" border="0" align="default" cellpadding="0" cellspacing="0" bgcolor="#ECE9D8">
  <tr>
    <td height="10" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="305" height="10" align="right"><input class="btn btn-danger" type="button" value="Cancel">
      &nbsp;&nbsp;&nbsp;</td>
    <td width="62" align="right"><input class="btn btn-success" type="button" value="Select" onClick="getSelectedCat();"></td>
    <td width="33" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="10" colspan="3"></td>
  </tr>
</table>