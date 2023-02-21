<?php 
session_start();
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
if($UserId=='')
{
$UserId=ResolveUserId(number_format($EmployeeId));
}
$UserDepartment=GetUserDepartment($UserId);
$sqlGetDeptStock=mysqli_query($conn, "SELECT * FROM DepartmentStock WHERE DeptId='$UserDepartment'") or die(mysqli_error($conn));
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop">DepartmentStock</td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv_1()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
  <?php 
  if( mysqli_num_rows($sqlGetDeptStock)==0)
  {
       ?>
	   <tr>
	   <td >Sorry.Lwala is not aware of any stock allocated to  this department</td>
	   </tr>
	   <?php
  }
  else
  {
  ?>
  <tr>
    <td><table width="100%" border="0">
	<thead>
      <tr>
        <td class="heading"><input class="form-control" name="CheckStock" type="checkbox" id="CheckStock" value="checkbox" /></td>
        <td class="heading">StockId</td>
        <td class="heading">Stock Name </td>
        <td class="heading">Current Qty </td>
        <td class="heading">View Movements</td>
      </tr>
	  </thead>
	  <tbody style="width:100%;height:250px; max-height:250px; overflow-x:hidden; overflow-y:auto; ">
	  <?php 
	  $count=0;
	  $sql=mysqli_query($conn, "SELECT StockId,Sum(StockQtyIn) AS SumStockInQty FROM DepartmentStock GROUP BY StockId") or die(mysqli_error($conn));
      while ($recs=mysqli_fetch_array($sql)) {
          $StockNo=$recs['StockId'];
          $StockInQty=$recs['SumStockInQty'];
          if ($count%2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
     <td ><input class="form-control" type="checkbox" name="RequestId" id="RequestId" value="<?php echo $Id; ?>"></td>
        <td ><?php echo $StockId; ?></td>
        <td ><?php echo StockName($StockId); ?></td>
        <td ><?php echo $StockInQty; ?></td>
        <td ><a href='#' onclick="ViewStockMovements('<?php echo $StockId; ?>','<?php echo $DepartmentId; ?>')">View Movements</a></td>
      </tr>
	  </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php

  }
  ?>