<?php

include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
?>

<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0">
  <?php

  $sql = mysqli_query($conn, "SELECT * FROM SetupPackaging ORDER BY PackageName DESC") or die(mysqli_error($conn));
  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td align="center" >Sorry.Lwala is not aware of any package set in the system</td>
    </tr>
  <?php
  } else {
  ?>
    <table width="100%" border="0" id="madepackaging">
      <thead>
        <tr>
          <th ><input class="form-control" type="Checkbox" name="CheckPackage" id="CheckPackage" /></th>
          <th >Package Name </th>
          <th >Items Linked to </th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <th ><input class="form-control" type="Checkbox" name="CheckPackage" id="CheckPackage" /></th>
          <th >Package Name </th>
          <th >Items Linked to </th>
        </tr>
      </tfoot>
      <tbody>
        <?php
        $count = 0;
        while ($recs = mysqli_fetch_array($sql)) {
          $Id = $recs['Id'];
          $PackageName = $recs['PackageName'];
          if ($count % 2 == 0) {
            $bg = '#E1E1FF';
          } else {
            $bg = '#EAEAEA';
          }
        ?>
          <tr>
            <td><input class="form-control" type="Checkbox" name="CheckPackage" id="CheckPackage" value="<?php echo $Id; ?>" onclick="CheckMadePackaging('<?php echo $Id; ?>')" /> </td>
            <td><?php echo $PackageName; ?></td>
            <td><?php echo  PackageLinked($Id); ?></td>
          </tr>
        <?php
          $count++;
        }
        ?>
      </tbody>
    </table>

  <?php
  }
  ?>
</table>
