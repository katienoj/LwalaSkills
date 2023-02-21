<?php
include "../../../Main/Config/db_conn.php";
$id = $_GET['value'];
?>
<select onChange="getSubCategory(value)" name="maincategory" id="maincategory" class="form-control">
  <option class="form-control">Select Category</option>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM PStockCat WHERE MainCat= '$id' ORDER BY CatName ASC ") or die(mysqli_error($conn));
  while ($row = mysqli_fetch_array($result)) {
      ?>
    <option class="form-control" value="<?php echo $row['CatId']; ?>"><?php echo $row['CatName']; ?></option>
  <?php
  } ?>
</select>