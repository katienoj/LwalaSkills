<?php 

include "../../../Main/Config/db_conn.php";


?><link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
<?php
$sql=mysqli_query($conn, "SELECT * FROM StockCategory WHERE del=0 ORDER BY CatName ASC") or die(mysqli_error($conn));

if(mysqli_num_rows($sql)==0)
{
?>
<tr>
    <td  colspan="5">Sorry,Lwala is not aware of any defined stock categories</td>
	</tr>

<?php
}
else
{



?>
<thead>
  <tr>
    <td ><input type="checkbox" name="checkCat" id="checkCat" /></td>
    <td >Category Photo </td>
    <td >Name</td>
    <td >Description</td>
    <td >Parent Category</td>
	<td >Date Added</td>
  </tr>
  </thead>
  <tbody style="width:100%;height:320px;max-height:320px; overflow-x:hidden; oveflow-y:auto;">
  
  <?php 
  $count=0;
  while($recs=mysqli_fetch_array($sql))
  {
  $Id=$recs['Id'];
  $ParentId=$recs['ParentId'];
  $Name=$recs['CatName'];
  $CatDescription=$recs['CatDescription'];
  $CatImage=$recs['CatImage'];
  $dateAdded=$recs['DateAdded'];
  if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; } 
  if($CatImage=='')
  {
  $CatImage='folder_icon.png';
  }
  ?>
  
  <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">    
    <td valign="center"><input type="checkbox" name="CatId" id="CatId" value="<?php echo $Id; ?>" onclick="SelectCat('<?php echo $Id; ?>')"/></td>
    <td valign="center"><img src="Application/Stock/CatImages/<?php echo $CatImage; ?>" width="50" height="50" /></td>
    <td valign="center"><?php echo $Name; ?></td>
    <td valign="center"><div id="CatDesc" style="width:100%; height:50px; max-height:50px; overflow-x:hidden;overflow-y:auto; text-align:center;"> <?php echo $CatDescription; ?></div></td>
	<td valign="center"><?php echo StockCategoryName($ParentId); ?></td>
    <td valign="center"><?php echo dteconvert($dateAdded); ?></td>
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
