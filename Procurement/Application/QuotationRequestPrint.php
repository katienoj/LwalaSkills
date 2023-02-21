<?php
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
@$SelectedQuotes=explode(':', $_REQUEST['SelectedQuotes']);
@$UserId=$_SESSION['UserId'];
@$EmployeeId=$_SESSION['EmployeeId'];
@$UserNames=$_SESSION['UserName'];
$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);
$SessionId=$result['Session_Id'];
//echo "New ".$SessionId."<br>Old".session_id();
if ($SessionId != session_id() or $SessionId=='') {
    echo "You are logged out.Please login again";
} else {
    foreach ($SelectedQuotes as $QuoteId) {
        if ($QuoteId!='') {
            $sqlQuoteInfo=mysqli_query($conn, "SELECT Suppliers FROM QuotationRequests WHERE Id='$QuoteId'") or die(mysqli_error($conn));
            $resultQuoteInfo=mysqli_fetch_assoc($sqlQuoteInfo);
            $SelectedSuppliers=explode(':', $resultQuoteInfo['Suppliers']);
            foreach ($SelectedSuppliers as $SupplierId) {
                if ($SupplierId!=' ') {
                    $SupplierDetails=explode(':', SupplierDetails($SupplierId));
                    $HospitalDetails=explode(':', HospitalDetails()); ?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />
<p style="page-break-before: always">
<table width="100%" border="0">
  <tr>
    <td rowspan="2"><table width="100%" border="0">
      <tr>
        <td align="center"><img src="../../Main/Layout/images/<?php echo $HospitalDetails[8]; ?>" width="100" height="100" /></td>
      </tr>
      <tr>
        <td class="contentTitle"><div align="center"><?php echo $HospitalDetails[0]; ?></div></td>
      </tr>
      <tr>
        <td><?php echo "<b>Postal Address :</b> ".$HospitalDetails[1].",<br><b> Tel: </b>".$HospitalDetails[4]."<br><b>Email :</b> ".$HospitalDetails[7]." <b>Web:</b>".$HospitalDetails[6]; ?></td>
      </tr>
    </table></td>
    <td width="28%" height="113">&nbsp;</td>
    <td width="39%" rowspan="2"><table width="100%" border="0">
      <tr>
        <td align="center"><img src="../../Stock/Application/Suppliers/SupplierLogos/<?php echo $SupplierDetails[1]; ?>" width="100" height="100"></td>
      </tr>
      <tr>
        <td class="contentTitle"><div align="center"><?php echo $SupplierDetails[0]; ?></div></td>
      </tr>
      <tr>
        <td><?php echo "<b>Postal Address : </b>".$SupplierDetails[7].",<br><b> Tel: </b>".$SupplierDetails[3]."<br><b>Email : </b>".$SupplierDetails[2]."<br><b>Web:</b>".$SupplierDetails[4]; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<table width="100%" border="0">
	<tr>
   <td align="center" class="contentTitle"><u>Request for Quotation </u></td>
   </tr>
     <?php
$sql=mysqli_query($conn, "SELECT * FROM QuotationRequestDetails WHERE QuoteRequestId='$QuoteId'") or die(mysqli_error($conn));
                    if (mysqli_num_rows($sql)==0) {
                        ?>
   <tr>
     <td align="center" >Sorry.Lwala is not aware of any Quotation request items attached to the selected Quotation Requests</td>
   </tr>
   <?php
                    } else {
                        ?>
<tr>
<td>
<table border="1" width="100%">
<thead>
  <tr>
    <td width="5%" class="heading">No</td>
    <td width="25%" class="heading">Stock Item </td>
    <td width="21%" class="heading">Packaging</td>
    <td width="24%" class="heading">Qty</td>
    <td width="25%" class="heading">Your Price </td>
  </tr>
  </thead>
  <tbody style="width:100%;">
  <?php
  $count=0;
                        while ($recs=mysqli_fetch_array($sql)) {
                            $StockId=$recs['StockId'];
                            $CatId=$recs['CatId'];
                            $Packaging=$recs['Packaging'];
                            $Qty=$recs['Qty'];
                            if ($count%2 == 0) {
                                $bg = '#E1E1FF';
                            } else {
                                $bg = '#EAEAEA';
                            } ?>
    <tr >
    <td class="printable_fields"><?php echo $count+1; ?></td>
    <td class="printable_fields"><?php echo StockName($StockId); ?></td>
    <td class="printable_fields"><?php echo PackagingInfo($Packaging); ?></td>
    <td class="printable_fields"><?php echo $Qty; ?></td>
    <td class="printable_fields">........................</td>
    </tr>
  <?php
  $count++;
                        } ?>
  </tbody>
  </table>  </td>
  </tr>
  <?php
                    } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2" class="table_sub_modules">Ambusely Hospital - Namanga</td>
        </tr>
      <tr>
        <td width="39%" class="td_bottom">Approver</td>
        <td width="61%"><?php echo ResolveEmployeeName($UserId); ?></td>
        </tr>
      <tr>
        <td class="td_bottom">Signature</td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
    <td>&nbsp;</td>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2" class="table_sub_modules"><?php echo $SupplierDetails[0]; ?></td>
      </tr>
      <tr>
        <td width="39%" class="td_bottom">Approver</td>
        <td width="61%">&nbsp;</td>
      </tr>
      <tr>
        <td class="td_bottom">Signature</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</p>
<?php
                }
            }
        }
    }
}
?>