<?php
session_start();

require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$RequestId = $_REQUEST['RequestId'];
$sql = mysqli_query($conn, "SELECT * FROM InternalStockRequests WHERE HODApproved='1' ORDER BY DateOfRequest DESC") or die(mysqli_error($conn));
$recs = mysqli_fetch_assoc($sql);
$Id = $recs['Id'];
$DepartmentId = $recs['DepartmentId'];
$DateOfRequest = $recs['DateofRequest'];
$DateExpected = $recs['DateExpected'];
$StockDetails = $recs['StockDetails'];
$Total = $recs['RequestTotal'];

$currentBudgetAllocationBalance = 1000000000000;

if ($Total <= $currentBudgetAllocationBalance) {
  $proceed = "<input class='btn btn-warning' type='Button' name='ProceedToApprove' value='Proceed To Approve' onclick='ProceedToApprovePROCRequest($RequestId)'>";
} else {
  $proceed = "Sorry,The Request figure seems to larger than the amount balance left for the Department";
}


?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">

<table width="550" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Approve Stock Request</td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="44%" class="td_bottom">Department Name</td>
    <td width="56%"><?php echo DepartmentName($DepartmentId); ?></td>
  </tr>
  <tr>
    <td class="td_bottom">Total Budget balance for Department </td>
    <td><?php echo number_format($currentBudgetAllocationBalance); ?> </td>
  </tr>
  <tr>
    <td class="td_bottom">Total for this Request</td>
    <td><?php echo number_format($Total); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" class="td_bottom"><?php echo $proceed; ?></td>
  </tr>
</table>