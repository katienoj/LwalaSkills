<?php 
require_once '../../../Main/Config/db_conn.php';

$SupplierId=$_REQUEST['SupplierId'];
$sql="SELECT * FROM SuppliersTable WHERE Id='$SupplierId'";


$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
while (list($Id,$SupplierNames,$PhyAddress,$PostAddress,$Email,$Phone,$Website,$Town,$Country,$CreditTerms,$CreditLimitAmount,$SupplierLogo,$DateAdded,$CreditLimitAmtCurrency) = mysqli_fetch_row($result))
{

?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="400" border="0" bgcolor="#E4E4E4" class="formborder">
  <tr>
    <td height="33" colspan="2"><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
      <tr >
        <td width="94%" class="formtop"><?php echo $SupplierNames; ?>'s Contact information</td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="35%" class="td_bottom"><div align="right">Physical Address </div></td>
    <td width="65%" ><?php echo $PhyAddress; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Postal Address </div></td>
    <td ><?php echo $PostAddress; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Telephone</div></td>
    <td ><?php echo $Phone; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Email</div></td>
    <td ><?php echo $Email; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Town</div></td>
    <td ><?php echo $Town; ?></td>
  </tr>
  <tr>
    <td class="td_bottom"><div align="right">Country</div></td>
    <td ><?php echo $Country; ?></td>
  </tr>
</table>
<?php } ?>