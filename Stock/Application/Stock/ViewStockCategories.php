<?php
include "../../../Main/Config/db_conn.php";



?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />

<table width="750" height="408" border="0" class="formborder" bgcolor="#E4E4E4">
  <tr>
    <td colspan="4">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Stock Categories</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="29" valign="top"><a href="#" onclick="DeleteCategory()">Delete Selected Category</a></td>
    <td height="29" valign="top">&nbsp;</td>
    <td height="29" valign="top">&nbsp;</td>
    <td height="29" valign="top"><a href="#" onclick="LinkCatToDepartment()">Link Category to Department</a> </td>
  </tr>
  <tr>
    <td height="202" colspan="4" valign="top">
      <div id="showCategories" style="height:350px;"></div>
    </td>
  </tr>
  <tr>
    <td width="82"> Main Category </td>
    <td>
      <select class="form-control" name="MainCategory" id="MainCategory">

        <?php
        $sql = mysqli_query($conn, "SELECT * FROM ParentStockCat ORDER BY ParentCatName DESC") or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_array($sql)) {
        ?>

          <option class="form-control" value="<?php echo $recs['ParentCatId']; ?>"><?php echo $recs['ParentCatName']; ?></option>
        <?php
        }
        ?>

      </select>
    </td>

    <td width="82"> Category </td>
    <td>
      <select class="form-control" name="Category" id="Category">

        <?php
        $sql = mysqli_query($conn, "SELECT * FROM PStockCat ORDER BY CatName DESC") or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_array($sql)) {
        ?>

          <option class="form-control" value="<?php echo $recs['CatId']; ?>"><?php echo $recs['CatName']; ?></option>
        <?php
        }
        ?>

      </select>
    </td>

  </tr>
  <tr>

    <td width="82"> Sub Category </td>
    <td>
      <select class="form-control" name="SubCategory"  id="SubCategory">

        <?php
        $sql = mysqli_query($conn, "SELECT * FROM PStockSubCat ORDER BY SubCatName DESC") or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_array($sql)) {
        ?>

          <option class="form-control" value="<?php echo $recs['SubCatId']; ?>"><?php echo $recs['SubCatName']; ?></option>
        <?php
        }
        ?>

      </select>
    </td>

    <td width="90">Category Name </td>
    <td width="262"><input class="form-control" name="cat_name" type="text" id="cat_name" size="25" /></td>

  </tr>
  <tr>
    <td>Parent Category </td>
    <td class=""><input class="form-control" name="category" type="text" id="category" size="25" readonly />
      <input class="btn btn-warning" name="button" type="button" onclick="navigateCat();" value="Browse" />
      <div id="navigate_cat" style="position:absolute; width:auto; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
      <input class="form-control" name="cat" type="hidden" id="cat" />
    </td>
    <td class="">
      <div id="navigate_cat" style="position:absolute; width:400px; height:auto; display:block; background-color:#ffffff; border: solid 1px #408080; padding:0px; display:none;"></div>
      Category Image
    </td>
    <td>
      <form action="Application/Stock/UploadCatImage.php" method="post" enctype="multipart/form-data" name="UploaCatImage" id="UploadCatImage" target="UploadCat">
        <input class="form-control" type="file" name="file" id="file"  />
        <input class="form-control" type="hidden" name="prevCatImage" id="prevCatImage" />
        <iframe src="#" name="UploadCat" width="400" height="100" id="UploadCat" style="display:none"> </iframe>
      </form>
    </td>
  </tr>
  <tr>

    <td width="82">Category Description </td>
    <td width="296"><textarea class="form-control" name="cat_description" cols="25" rows="2" id="cat_description"></textarea></td>

  </tr>
  <tr>
    <td colspan="4"><input class="btn btn-success" type="button" name="Button" value="Save" style="float:right;" onclick="CategoryAction()" /></td>
  </tr>
</table>