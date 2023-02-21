<?php 
require_once '../../../Main/Config/db_conn.php';

$SupplierId=$_REQUEST['SupplierId'];
$CatId=$_REQUEST['CatId'];
$sql="SELECT * FROM SuppliersTable WHERE Id='$SupplierId'";


$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
while (list($Id,$SupplierNames,$PhyAddress,$PostAddress,$Email,$Phone,$Website,$Town,$Country,$CreditTerms,$CreditLimitAmount,$SupplierLogo,$DateAdded,$CreditLimitAmtCurrency) = mysqli_fetch_row($result))
{
if($SupplierLogo=='')
{
$SupplierLogo='noSupplier.gif';
}

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="650" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td height="33" colspan="5"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="53%" class="formtop"><?php echo $SupplierNames; ?>'s Details </td>
        <td width="17%" class="formtop"><a href="#" onclick="EditSupplier('<?php echo $SupplierId; ?>','<?php echo $CatId; ?>')">Edit</a></td>
        <td width="26%" class="formtop"><a href="#" onclick="RemoveSupplier('<?php echo $SupplierId; ?>','<?php echo $CatId; ?>')">Delete</a></td>
        <td width="4%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="15%" rowspan="6" class="td_bottom"><img src='Application/Suppliers/SupplierLogos/<?php echo $SupplierLogo; ?>' width='100' height='100'></td>
    <td width="18%" class="td_bottom"><div align="right">Names</div></td>
    <td width="17%" ><span ><?php echo $SupplierNames; ?></span></td>
    <td width="32%" class="td_bottom"><div align="right">Town</div></td>
    <td width="18%" ><?php echo $Town; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Physical Address </div></td>
    <td ><span ><?php echo $PhyAddress; ?></span></td>
    <td class="td_bottom"><div align="right">Country</div></td>
    <td ><?php echo $Country; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Postal Address </div></td>
    <td ><span ><?php echo $PostAddress; ?></span></td>
    <td class="td_bottom"><div align="right">Credit Terms </div></td>
    <td ><?php echo $CreditTerms; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Telephone</div></td>
    <td ><span ><?php echo $Phone; ?></span></td>
    <td class="td_bottom"><div align="right">Credit Limit Amount </div></td>
    <td ><?php echo $CreditLimitAmount; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Email</div></td>
    <td ><span ><?php echo $Email; ?></span></td>
    <td class="td_bottom">&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td height="22" class="td_bottom">&nbsp;</td>
    <td height="22" class="td_bottom">&nbsp;</td>
    <td class="td_bottom">&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
</table>
<?php } ?>