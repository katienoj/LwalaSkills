<?php
require_once '../../../Main/Config/db_conn.php';
?>

<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <?php
  $SearchStr = explode(':', stripslashes($_REQUEST['SearchStr']));
  $sql = $SearchStr[0];

  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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
    <thead>
      <tr>
        <td ><input type="checkbox" name="CheckSupplier" id="CheckSupplier" value="" onclick="CheckTheSuppliers()"></td>
        <td >Supplier Id</td>
        <td >Supplier Names</td>
        <td >Suplier Contacts</td>
        <td >Credit Terms</td>
        <td >Credit Limit</td>
        <td >Date Added</td>
      </tr>
    </thead>
    <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
      <?php
      $count = 0;
      while (list($Id, $SupplierNames, $PhyAddress, $PostAddress, $Email, $Phone, $Website, $Town, $Country, $CreditTerms, $CreditLimitAmount, $SupplierLogo, $DateAdded, $CreditLimitAmtCurrency) = mysqli_fetch_row($result)) {

        if ($count % 2 == 0) {
          $bg = '#E1E1FF';
        } else {
          $bg = '#EAEAEA';
        }
      ?>
        <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
          <td ><input type="checkbox" name="SupplierId" id="SupplierId" value="<?php echo $Id; ?>"></td>
          <td ><?php echo $Id; ?></td>
          <td ><?php echo $SupplierNames; ?></td>
          <td ><a href="#" onclick="SupplierContacts('<?php echo $Id; ?>')">Contacts</a></td>
          <td ><?php echo number_format($CreditTerms, 2); ?></td>
          <td ><?php echo number_format($CreditLimitAmount, 2); ?></td>
          <td ><?php echo dteconvert($DateAdded); ?></td>
        </tr>
      <?php
        $count++;
      }
      ?>
    </tbody>
  <?php
  }
  ?>
  <tr>
    <td  colspan="7" align="center"><?php echo $SearchStr[1]; ?></td>

  </tr>
</table>