<?php
require_once "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">SETUP STOCK CATEGORIES</td>
	</tr>
</table>
<table width="100%" border="0" class="formborder" bgcolor="#E4E4E4">
  <?php
  $sql = mysqli_query($conn, "SELECT * FROM StockCategory  ORDER BY CatName ASC") or die(mysqli_error($conn));
  if (mysqli_num_rows($sql) == 0) {
      ?>
    <tr>
      <td  colspan="5">Lwala Did Not Find any defined Categories</td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table width="100%" border="0" id="stockcategories">
  <thead>
    <tr>
      <th>Super Category</th>
      <th>Main Category</th>
      <th>Sub Category</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Super Category</th>
      <th>Main Category</th>
      <th>Sub Category</th>
    </tr>
  </tfoot>
  <tbody>
    <?php
    $count = 0;
      while ($recs = mysqli_fetch_array($sql)) {
          $parentId = $recs['ParentId'];
          $Sql = "SELECT * FROM ParentStockCat WHERE  ParentCatId='$parentId'";
          $Res = mysqli_query($conn, $Sql) or die("Could not get super category details" . mysqli_error($conn));
          while ($Rows = mysqli_fetch_array($Res)) {
              $ParentCatName = $Rows['ParentCatName'];
          }
          $catCode = $recs['CatCode'];
          $Sql = "SELECT * FROM PStockCat WHERE  CatId = '$catCode'";
          $Res = mysqli_query($conn, $Sql) or die("Could not get super category details" . mysqli_error($conn));
          while ($Rows = mysqli_fetch_array($Res)) {
              $mainCatName = $Rows['CatName'];
          }
          $catName = $recs['CatName'];
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
      <tr>
        <td><?php echo $ParentCatName; ?></td>
        <td><?php echo $mainCatName; ?></td>
        <td><?php echo $catName; ?></td>
      </tr>
    <?php
      $count++;
      } ?>
  <?php
  }
  ?>
  </tbody>
</table>