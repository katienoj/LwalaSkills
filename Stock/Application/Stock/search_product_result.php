<?php 
include "../php_functions/db_connect.php";
$sql=stripslashes($_REQUEST['search_string']); 
$getProd = mysqli_query($conn, $sql)or die(mysqli_error($conn));
$prodRows = mysqli_num_rows($getProd);
if($prodRows > 0){
?>

<table width="98%" height="126" align="center" cellpadding="3" cellspacing="1">
 <tbody style="overflow-y:auto; overflow-x:hidden; height:250px; max-height:250px;">
<tr>
<?php
$countProd = 0;
while($resulProd = mysqli_fetch_assoc($getProd)){

?>

  <td width="20" align="center"><a href="javascript: void(0)" onclick="disp_product_details(<?php echo $resulProd['product_id']; ?>,<?php echo $resulProd['cat_id']; ?>)"><img src="assets/images/products/thumbs/<?php echo $resulProd['pd_image']; ?>" style="padding:2px; border:1px solid #004040;" /></a></td>
<td width="723" ><a href="javascript: void(0)" onclick="disp_product_details(<?php echo $resulProd['product_id']; ?>,<?php echo $resulProd['cat_id']; ?>)"><?php echo ucwords($resulProd['prdct_name']); ?></a></td>
<?php
$countProd = $countProd + 1;
if($countProd < 4){
### do nothing
}else{
?>
<tr><td>&nbsp;</td></tr>
<tr>
<?php
$countProd = 0;
}

}

}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center" >There are no products bearing the selected criteria</td>
</tr>
</table>
<?php
}
?>
</tr>
</tbody>
</table>

