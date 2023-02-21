<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
?>
 <table border="0"  bgcolor="#E4E4E4" class="formborder" width="1000">
  <tr>
    <td colspan="2"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop"   onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Quotation Request Details</td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
<?php
$SelectedPRQs=explode(':',$_REQUEST['SelectedPRQs']);

?>
<tr>
<td><table border="0" width="100%">
<thead>
<tr>
<td class="heading"><input class="form-control" type="checkbox" name="CheckPRQs" id="CheckPRQs" onclick="CheckPRQs()" /> </td
><td class="heading">PRQ Id</td>
<td class="heading">IRQ Id</td>
<td class="heading">Category</td>
<td class="heading">Date of Request</td>
<td class="heading">Department</td>
<td class="heading">Suppliers</td>
<td class="heading">Items to Request </td>
</tr>
</thead>
<tbody style="width:100%;height:450px;max-height:450px; overflow-x:hidden; overflow-y:auto;">
<?php 
$count=0;
foreach($SelectedPRQs as $PRQ)
{
if($PRQ!='')
{
$sqlTempPRQ=mysqli_query($conn, "SELECT * FROM ProcurementTable WHERE Id='$PRQ' order by Id DESC") or die(mysqli_error($conn));

while($recs=mysqli_fetch_array($sqlTempPRQ))
{
$CatId=$recs['CatId'];
$DateCreated=dteconvert($recs['DateCreated']);
$RequestId=$recs['RequestId'];
$Id=$recs['Id'];
 if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">  
 <td >	<input class="form-control" type="checkbox" name="PRQNo" id="PRQNo"  value="<?php echo $CatId."+".$Id; ?>"/></td>
<td width="6%" ><?php echo $Id; ?></td>
  <td ><?php echo $RequestId; ?></td>
  <td ><?php echo CatName($CatId); ?></td>
  <td ><?php echo $DateCreated; ?></td>
  <td ><?php echo DepartmentName(RequestDepartment($RequestId)); ?></td>
  <td ><div id="TheSuppliers<?php echo $CatId; ?><?php echo $Id; ?>" style="width:200px;height:200px; text-align:center;"><a href="#" onclick="SelectSuppliersToRequest('<?php echo $CatId; ?>','<?php echo $Id; ?>')">Select Suppliers</a></div></td> 
  <td ><div id="TheItems<?php echo $CatId; ?><?php echo $Id; ?>" style="width:250px;height:200px; text-align:center;"><a href="#" onclick="AddItemsAmtsInQuotation('<?php echo $CatId; ?>','<?php echo $Id; ?>','<?php echo $Id; ?>')">The Items</a></div>
    <input class="form-control" name="SelectedSuppliers<?php echo $CatId; ?><?php echo $Id; ?>" type="hidden" id="SelectedSuppliers<?php echo $CatId; ?><?php echo $Id; ?>" />
	<input class="form-control" name="ItemAmts<?php echo $CatId; ?><?php echo $Id; ?>" type="hidden" id="ItemAmts<?php echo $CatId; ?><?php echo $Id; ?>" /></td>
  </tr>
<?php
$count++;
}
}
}
?>
</tbody>
</table>
<?php

?>
<input class="btn btn-warning" type="button" name="Button" value="Proceed &gt;&gt;" onclick="CompleteGenerateQuotation()" style="float:right;"></td>
</tr>
</table>