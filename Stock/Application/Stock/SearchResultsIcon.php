<?php 
require_once '../../../Main/Config/db_conn.php';
require_once '../../includes/StockFunctions.php';
?>


<table width="98%" height="126" align="center" cellpadding="3" cellspacing="1">
<tr><td  valign="top">
<table width="100%" border="0">
<?php 
$SearchStr=explode(':',stripslashes($_REQUEST['SearchStr']));

$sql=$SearchStr[0];
//echo $SearchStr[0]."<br>";
$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
//display product fields in list
//echo mysqli_num_rows($result);
if(mysqli_num_rows($result)==0)
{
?>
<tr>
<td  colspan="7" align="center">Sorry,Lwala is not aware of any registered stock with the Selected Search criteria</td>
</tr>
<?php
}
else
{
?>
 <tbody style="overflow-y:auto; overflow-x:hidden; height:250px; max-height:250px; vertical-align:top;">
<tr>
<?php
$countProd = 0;
while($resulProd = mysqli_fetch_assoc($result)){
$StockImage=$resulProd['StockImage'];
if($StockImage=='')
  {
  $StockImage='no_img.gif';
  }
?>

    <td width="20" align="center"><a href="javascript: void(0)" ><input type="image" src="Application/Stock/StockImages/<?php echo $StockImage; ?>" width="50" height="50" onclick="disp_product_details(<?php echo $resulProd['Id']; ?>,<?php  echo ucwords($resulProd['CatId']); ?>)"/></td>
<td width="723" ><a href="javascript: void(0)" onclick="disp_product_details(<?php echo $resulProd['Id']; ?>,<?php echo $cat_id; ?>)" style="text-decoration:none;"><?php echo ucwords($resulProd['StockName']); ?></a></td>

<?php
$countProd = $countProd + 1;
if($countProd < 6){
### do nothing
}else{
?>
<tr><td>&nbsp;</td></tr>
<tr>
<?php
$countProd = 0;
}
}
?>
</tr>
</tbody>
<?php
}
?>
</tbody>
</table>
</td>
</tr>
</table>

