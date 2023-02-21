<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
$RequestId=$_REQUEST['RequestId'];
$strSQL="SELECT * FROM InternalStockRequests WHERE Id='$RequestId' ORDER BY Id DESC";


$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);

 $StockDetails=$result['StockDetails'];

$StockInfo=explode(':',$StockDetails);
$CatIds='';
$countCat=0;
foreach($StockInfo as $StockItem)
{
    if($StockItem!='')
	{
	    $Stock=explode('*',$StockItem);
	    $Item=$Stock[0];
		$CatId=StockCategory($Item);
		$Cats=explode('+',$CatIds);
		
		$CatIds.=$CatId.'+';
	}
}
//echo $CatIds;

?><link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td colspan="2"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop">Suppliers who supply items in request </td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onClick="closepopupdiv_1()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
  <?php
  
  ?>
  <tr>
  <td>
  <table width="100%" border="0">
  <thead>
  
  <tr>
    <td ><input type="checkbox" name="checkbox" value="SupplierCheck" onClick="SelectSuppliers()"></td>
    <td >Supplier</td>
  </tr>
  </thead>
  <tbody style="width:100%;max-height:300px;overflow-x:hidden;overflow-y:auto;">
  <?php 
  $SelectedSuppliers='';
  $theSuppliers='';
  $shown=0;
  $TheCats=explode('+',$CatIds);
  
  foreach($TheCats as $Cat)
  {
	  if($Cat!='')
	  {
		  $sqlLink=mysqli_query($conn, "SELECT SupplierId FROM SupplierCategoryLink WHERE CatId='$Cat'") or die(mysqli_error($conn));
		  while($recsLink=mysqli_fetch_array($sqlLink))
		  {
		 $SupplierId=$recsLink['SupplierId'];
		  $theSuppliers.=$SupplierId.'+';
		  }
	  }
   }
// echo SanitisedIds($theSuppliers);
  $suppliers=explode(':',SanitisedIds($theSuppliers));
  
  foreach($suppliers as $supplier)
  {
  if($supplier!='')
  {
   $SupplierSQL="SELECT * FROM SuppliersTable WHERE Id='$supplier' GROUP BY Id";
  
//echo $SupplierSQL;
  
  $sqlSupplier=mysqli_query($conn, $SupplierSQL) or die(mysqli_error($conn));
  
  $count=0;
  while($recs=mysqli_fetch_array($sqlSupplier))
  {
  $Id=$recs['Id'];
  $Names=$recs['SupplierNames'];
  
  if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
 
 ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
    <td ><input type="checkbox" name="SupplierNo" id="SupplierNo" value="<?php echo $Id; ?>"></td>
    <td ><?php echo $Names; ?></td>
  </tr>
  <?php
  }
  $count++;
  }
  }  
  ?>
  </tbody>
  </table>
  </td>
  </tr>
  <tr>
  <td align="center"><input type="hidden" name="RequestId" id="RequestId" value="<?php echo $RequestId; ?>" />
  <input class="btn btn-success" type="button" name="inputButton" id='inputButton' value="Proceed to Issue LPO" onclick="IssueLPO()"/>
  </td>
  </tr>
  <?php

  ?>
</table>
