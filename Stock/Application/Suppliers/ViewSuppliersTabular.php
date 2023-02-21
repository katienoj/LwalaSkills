<?php
require_once '../../../Main/Config/db_conn.php';
$sql = "SELECT * FROM SuppliersTable WHERE del = Null OR del=0 ORDER BY Id DESC";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">LIST OF SUPPLIERS</td>
	</tr>
</table>
<table width="100%" border="0">
  <?php
  //display product fields in list
  //echo mysqli_num_rows($result);
  if (mysqli_num_rows($result) == 0) {
      ?>
    <tr>
      <td  colspan="7" align="center">Sorry,Lwala is not aware of any registered Suppliers</td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table width="100%" border="0" id="service_table">
  <thead>
    <tr>
      <th ><input type="checkbox" name="CheckSupplier" id="CheckSupplier" value="" onclick="CheckTheSuppliers()"></th>
      <th >Supplier Id</th>
      <th >Supplier Names</th>
      <th >Suplier Contacts</th>
      <th >Credit Terms</th>
      <th >Credit Limit</th>
      <th >Date Added</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th ><input type="checkbox" name="CheckSupplier" id="CheckSupplier" value="" onclick="CheckTheSuppliers()"></th>
      <th >Supplier Id</th>
      <th >Supplier Names</th>
      <th >Suplier Contacts</th>
      <th >Credit Terms</th>
      <th >Credit Limit</th>
      <th >Date Added</th>
    </tr>
  </tfoot>
  <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
    <?php
    $count = 0;
      while (list($Id, $SupplierNames, $PhyAddress, $PostAddress, $Email, $Phone, $Website, $Town, $Country, $CreditTerms, $CreditLimitAmount, $SupplierLogo, $DateAdded, $CreditLimitAmtCurrency) = mysqli_fetch_row($result)) {
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
      <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
        <td ><input type="checkbox" name="SupplierId" id="SupplierId" value="<?php echo $Id; ?>"></td>
        <td ><?php echo $Id; ?></td>
        <td ><?php echo $SupplierNames; ?></td>
        <td ><a href="#" onclick="SupplierContacts('<?php echo $Id; ?>')">Contacts</a></td>
        <td ><?php echo $CreditTerms; ?></td>
        <td ><?php echo $CreditLimitAmount; ?></td>
        <td ><?php echo dteconvert($DateAdded); ?></td>
      </tr>
    <?php
      $count++;
      } ?>
  </tbody>
<?php
  }
?>
</table>