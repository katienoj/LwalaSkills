<?php
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';
$StockId = $_REQUEST['StockId'];
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<table border="0">
  <?
$sql=mysqli_query($conn, "SELECT StockAlternatives FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));

$result=mysqli_fetch_assoc($sql);

if(stristr($result['StockAlternatives'],':'))
{

?>
  <link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />

  <table width="100%" border="0">
    <thead>
      <tr>
        <td width="3%" ><input class="form-control" type="checkbox" name="AlternateCheck" id="AlternateCheck" onclick="CheckAlternates()" /></td>
        <td width="15%" >Stock Item </td>
        <td width="20%" >Opening Stock </td>
        <td width="19%" >Min Stock Level </td>
        <td width="13%" >Max Stock Level </td>
        <td width="14%" >Min Reorder </td>
        <td width="16%" >Max Reorder </td>
      </tr>
    </thead>
    <tbody style="height:300px; max-height:300px; overflow-x:hidden; overflow-y:auto;">
      <?
  $TheAlternatives=explode(':',$result['StockAlternatives']);
  $count=0;
  foreach($TheAlternatives as $Alternative)
  {
   if(!empty($Alternative))
   {
      $sql=mysqli_query($conn, "SELECT * FROM StockTable WHERE Id='$Alternative' AND del=0 ORDER BY Id DESC") or die(mysqli_error($conn));
      while (list($Id,$StockName,$quantity,$VAT,$cat,$UnitId,$specs,$StockImage,$CatImage,$StockDate,$StockLastUpdate,$del,$minStock,$minReorder,$maxReorder,$maxStock,$OpeningStock,$Barcode,$Price) = mysqli_fetch_row($sql))
	   {
	   if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
       ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
        <td ><input class="form-control" type="checkbox" name="AlternateId" id="AlternateId" value="<?php echo $Id; ?>"></td>
        <td ><?php echo $StockName; ?></td>
        <td ><?php echo $OpeningStock; ?></td>
        <td ><?php echo $minStock; ?></td>
        <td ><?php echo $maxStock; ?></td>
        <td ><?php echo $minReorder; ?></td>
        <td ><?php echo $maxReorder; ?></td>
      </tr>
      <?
	}
	$count++;
	}
	}
	?>
    </tbody>
  </table>
  <?
}
else
{

?>
  <tr>
    <td align="center" >Sorry, Lwala is not aware of any stock items marked as alternatives to <?php echo StockName($StockId); ?></td>
  </tr>
  <?
}
?>