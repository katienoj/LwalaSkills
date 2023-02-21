<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
?>

<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
<?php 

$sql="SELECT * FROM StockTable WHERE del=0 ORDER BY Id DESC";

$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
//echo mysqli_num_rows($result);
if(mysqli_num_rows($result)==0)
{

?>
<tr>
<td  colspan="7">Sorry,Lwala is not aware of any registered stock</td>
</tr>
<?php
}
else
{
?>
<thead>
  <tr>
    <td ><input class="form-control" type="checkbox" name="CheckStock" id="CheckStock" onclick="CheckStock()"></td>
	<td >StockId</td>
    <td >Stock Name </td>
    <td >Category</td>
    <td >Opening Stock </td>
    <td >Min Stock </td>
    <td >Max Stock </td>
    <td >Min Re order </td>
    <td >Max Re order </td>
    <td >Date Added </td>
  </tr>
  </thead>
  <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
  <?php 
  $count=0;
  while (list($Id,$StockName,$quantity,$VAT,$cat,$UnitId,$specs,$StockImage,$CatImage,$StockDate,$StockLastUpdate,$del,$minStock,$minReorder,$maxReorder,$maxStock,$OpeningStock,$Barcode) = mysqli_fetch_row($result)) {
    
  if($count%2 == 0)
  { 
     if($quantity<=$minReorder)
	 {
	 $bg = '#FFBFBF';
	 }
	 else
	 {
	 $bg = '#E1E1FF';
	 }
  
  }
  else
  { 
  $bg = '#EAEAEA';
  }
 ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
    <td ><input class="form-control" type="checkbox" name="StockId" id="StockId" value="<?php echo $Id; ?>"></td>
	<td ><?php echo $Id; ?></td>
	<td ><?php echo $StockName; ?></td>
    <td ><?php echo CatName($cat); ?></td>
    <td ><?php echo $OpeningStock; ?></td>
    <td ><?php echo $minStock; ?></td>
    <td ><?php echo $maxStock; ?></td>
    <td ><?php echo $minReorder; ?></td>
    <td ><?php echo $maxReorder; ?></td>
    <td ><?php echo dteconvert($StockDate); ?></td>
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
