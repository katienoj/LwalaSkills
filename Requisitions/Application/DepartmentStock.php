<?php
session_start();
$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
$SearchSQL = $_REQUEST['SearchSQL'];
if ($UserId == '') {
  $UserId = ResolveUserId(number_format($EmployeeId));
}
$UserDepartment = GetUserDepartment($UserId);
$sqlGetDeptStock = mysqli_query($conn, "SELECT * FROM DepartmentCategoryLink") or die(mysqli_error($conn));


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" class="formborder">
  <tr>
    <td>
      <table width="100%" border="0" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Stock in the <?php echo DepartmentName($UserDepartment); ?> department </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td ><input type="button" class="btn btn-warning btn-block" value="Initiate Stock Request" onclick="AddRequisition()" /></td>
  </tr>
</table>

<?php
if (mysqli_num_rows($sqlGetDeptStock) == 0) {
?>
  <tr>
    <td >Sorry. Lwala is not aware of any stock allocated to this department</td>
  </tr>

<?php
} else {
?>
  <table width="100%" border="0" id="department_stock">

    <thead>
      <tr>
        <th ><input name="CheckStock" type="checkbox" id="CheckStock" value="checkbox" /></th>
        <th >StockId</th>
        <th >Stock Name </th>
        <th >Available Qty</th>
        <th >View Movements</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th ><input name="CheckStock" type="checkbox" id="CheckStock" value="checkbox" /></th>
        <th >StockId</th>
        <th >Stock Name </th>
        <th >Available Qty</th>
        <th >View Movements</th>
      </tr>
    </tfoot>
    <tbody style="width:100%;height:250px; max-height:250px; overflow-x:hidden; overflow-y:auto; ">
      <?php
      $count = 0;

      while ($recs = mysqli_fetch_array($sqlGetDeptStock)) {

        $CatId = $recs['CatId'];
        if ($SearchSQL == '' or $SearchSQL == 'undefined') {
          $strSQL = "SELECT DISTINCT * FROM StockTable";
        } else {
          $strSQL = stripslashes($SearchSQL);
        }

        $sqlGetStockInCat = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
        while ($recs = mysqli_fetch_array($sqlGetStockInCat)) {
          $StockNo = $recs['Id'];
          $MaxStock = $recs['MaxStock'];

          if ($count % 2 == 0) {
            $bg = '#E1E1FF';
          } else {
            $bg = '#EAEAEA';
          }
      ?>
          <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
            <td ><input type="checkbox" name="StockId" id="StockId" value="<?php echo $StockNo; ?>"></td>
            <td ><?php echo $StockNo; ?></td>
            <td ><?php echo StockName($StockNo); ?></td>
            <td ><?php echo $MaxStock; ?></td>
            <td ><a href='#' onclick="ViewStockMovements('<?php echo $StockNo; ?>','<?php echo $UserDepartment; ?>')">View Movements</a></td>
          </tr>
      <?php
          $count++;
        }
      }
      ?>

    </tbody>
  </table>
<?php
}
?>