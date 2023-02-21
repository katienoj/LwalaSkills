<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$sql = mysqli_query($conn, "SELECT * FROM SetupPackaging") or die(mysqli_error($conn));
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">STOCK PACKAGING SETUP</td>
	</tr>
</table>

<table width="100%" border="0" id="stockpackaging">
  <?php
  if (mysqli_num_rows($sql) == 0) {
      ?>
    <tr>
      <td  align="center" colspan="4">Sorry,Lwala is not aware of any packaging details for <?php echo StockName($StockId); ?></td>
    </tr>
  <?php
  } else {
      ?>
    <thead>
      <tr>
        <th><input class="form-control" type="checkbox" name="checkbox" value="CheckPackaging" /></th>
        <th>Id</th>
        <th>Packaging Name </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th><input class="form-control" type="checkbox" name="checkbox" value="CheckPackaging" /></th>
        <th>Id</th>
        <th>Packaging Name </th>
      </tr>
    </tfoot>
    <tbody style="width:100%; overflow-x:hidden; overflow-y:auto;">
      <?php
      $count = 0;
      while (list($Id, $PackageName) = mysqli_fetch_row($sql)) {
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
        <tr>
          <td><input class="form-control" type="checkbox" name="PackageId" id="PackageId" value="<?php echo $Id; ?>" onclick="LoadPackageDetailsForEdit('<?php echo $Id; ?>')" /></td>
          <td><?php echo $Id; ?></td>
          <td><?php echo $PackageName; ?></td>
        </tr>
      <?php
        $count++;
      } ?>
    </tbody>
</table>
<?php
  }
?>