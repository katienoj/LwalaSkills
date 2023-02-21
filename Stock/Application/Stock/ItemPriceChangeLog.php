<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
$PackageId = $_REQUEST['PackageId'];



?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" class="bordercolor2" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Item Price Change History for a <?php echo PackageName($PackageId); ?> of <?php echo StockName($StockId); ?> </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv_2()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
  $sql = mysqli_query($conn, "SELECT * FROM ItemPriceChangeLog WHERE PackageId='$PackageId' AND StockId='$StockId'") or die(mysqli_error($conn));

  if (mysqli_num_rows($sql) == 0) {
  ?>
    <tr>
      <td align="center" >Sorry.Lwala is not aware of any price changes made to the <?php echo PackageName($PackageId); ?> package of <?php echo StockName($StockId); ?></td>
    </tr>
  <?php
  } else {

  ?>
    <tr>
      <td>
        <table width="100%" border="0">
          <thead>
            <tr>
              <td >User</td>
              <td >Packaging</td>
              <td >Before Price </td>
              <td >After Price </td>
              <td >Date and Time</td>
            </tr>
          </thead>
          <tbody style="width:100%; height:100px; max-height:100px; overflow-x:hidden; overflow-y:auto;">

            <?php
            $count = 0;
            while ($recs = mysqli_fetch_array($sql)) {
              $User = $recs['UserId'];
              $BeforePrice = $recs['BeforePrice'];
              $AfterPrice = $recs['AfterPrice'];
              $DateOfChange = $recs['DateOfChange'];

              if ($count % 2 == 0) {
                $bg = '#E1E1FF';
              } else {
                $bg = '#EAEAEA';
              }
            ?>

              <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
                <td ><?php echo ResolveEmployeeName($User); ?></td>
                <td ><?php echo PackageName($PackageId); ?></td>
                <td ><?php echo number_format($BeforePrice, 2); ?></td>
                <td ><?php echo number_format($AfterPrice, 2); ?></td>
                <td ><?php echo dteconvert_advanced($DateOfChange); ?></td>
              </tr>
            <?php
              $count++;
            }
            ?>
          </tbody>
        <?php
      }
        ?>

        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
</table>