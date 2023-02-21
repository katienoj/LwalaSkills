<?php
include "../../../Main/Config/db_conn.php";
$id = $_GET['value'];
?>
<select class="form-control" name="subcategory" id="subcategory" >
  <option class="form-control">Select Sub Category </option>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM StockCategory /* WHERE ParentId= '$id' */ ORDER BY CatName ASC ") or die(mysqli_error($conn));
  while ($row = mysqli_fetch_array($result)) {
      ?>
    <option class="form-control" value="<?php echo $row['Id']; ?>"><?php echo $row['CatName']; ?></option>
  <?php
  } ?>
</select>