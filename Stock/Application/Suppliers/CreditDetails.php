<?php 
require_once '../../../Main/Config/db_conn.php';

$SupplierId=$_REQUEST['SupplierId'];

$sql="SELECT * FROM SuppliersTable WHERE Id='$SupplierId' ORDER BY Id DESC";

$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
while (list($Id,$SupplierNames,$PhyAddress,$PostAddress,$Email,$Phone,$Website,$Town,$Country,$CreditTerms,$CreditLimitAmount,$SupplierLogo,$DateAdded,$CreditLimitAmtCurrency) = mysqli_fetch_row($result))
{
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" bgColor="#E4E4E4">
  <tr>
    <th scope="col"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);"><?php echo $SupplierNames; ?>'s Credit details</td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <th scope="row"><table width="100%" border="0">
      <tr>
        <td>Credit Limit Period(No of Days) </td>
        <td><input class="form-control" name="CreditPeriod" type="text" id="CreditPeriod"  value="<?php echo $CreditTerms; ?>"/></td>
      </tr>
      <tr>
        <td>Credit Limit Amount(No of Days) </td>
        <td><select class="form-control" name="Currency"  id="Currency">
          <option class="form-control" value="<?php echo $CreditLimitAmtCurrency; ?>"><?php echo CurrencyCode($CreditLimitAmtCurrency); ?></option>
          <?php 
		$sql=mysqli_query($conn, "SELECT * FROM CurrencyDetails WHERE Active is Null") or die(mysqli_error($conn));
		while($recs=mysqli_fetch_array($sql))
		{
		?>
          <option class="form-control" value="<?php echo $recs['Id']; ?>"><?php echo $recs['Code']; ?></option>
          <?php
		}
		?>
        </select>
          <input class="form-control" name="CreditAmt" type="text" id="CreditAmt" value="<?php echo $CreditLimitAmt; ?>"/></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><input class="btn btn-success" type="button" name="Button" value="Save" onClick="SaveCreditPeriod()" style="float:right;" /></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <th scope="row"><input class="form-control" name="SupplierNo" type="hidden" id="SupplierNo" value="<?php echo $SupplierId; ?>"></th>
  </tr>
</table>
<?php
}?>
