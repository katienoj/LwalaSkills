<?php
require_once '../../../Main/Config/db_conn.php';
$sql = "SELECT PR.Id, PR.PatientId, PR.Date, PR.PaymentMode, PR.UserId, PR.ReceiptNo, PR.Banked,  PCS.ParticularsId, PCS.DepartmentId, PCS.Quantity, PCS.Cost, PCS.Amount, PCS.Type
FROM PatientReceipting PR
JOIN PatientChargeSheet PCS ON PR.BillId = PCS.Id WHERE PCS.Type='Item' ORDER BY PR.Date Desc LIMIT 200 ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">GENERATED ITEM RECEIPTS</td>
	</tr>
</table>
<table width="100%" border="0">
	<?php
    if (mysqli_num_rows($result) == 0) {
        ?>
		<tr>
			<td  colspan="11" align="center">Lwala: There are currently no receipts to be viewed</td>
		</tr>
	<?php
    } else {
        ?>
</table>
<table width="100%" border="0" id="stockitemreceipts">
	<thead>
		<tr>
			<th ><input type="checkbox" name="CheckUpdate" id="CheckUpdate" value="" onclick=""></th>
			<th >DATE</th>
			<th >P.NAME</th>
			<th >ITEM NAME</th>
			<th >QTY</th>
			<th >UNIT</th>
			<th >TOTAL</th>
			<th >RECEIPT.NO</th>
			<th >PAY.MODE</th>
			<th >RECEIPTED.BY</th>
			<th >BANKED?</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th ><input type="checkbox" name="CheckUpdate" id="CheckUpdate" value="" onclick=""></th>
			<th >DATE</th>
			<th >P.NAME</th>
			<th >ITEM NAME</th>
			<th >QTY</th>
			<th >UNIT</th>
			<th >TOTAL</th>
			<th >RECEIPT.NO</th>
			<th >PAY.MODE</th>
			<th >RECEIPTED.BY</th>
			<th >BANKED?</th>
		</tr>
	</tfoot>
	<tbody>
		<?php
        $count = 0;
        while (list($Id, $PatientId, $Date, $PaymentMode, $UserId, $ReceiptNo, $Banked, $ParticularsId, $DepartmentId, $Quantity, $Cost, $Amount, $Type) = mysqli_fetch_row($result)) {
            if ($count % 2 == 0) {
                $bg = '#E1E1FF';
            } else {
                $bg = '#EAEAEA';
            } ?>
			<tr>
				<td ><input type="checkbox" name="Id" id="Id" value="<?php echo $Id; ?>"></td>
				<td ><?php echo $Date; ?></td>
				<td ><?php
                                    $Sql = "SELECT FirstName, LastName FROM Patients WHERE Id='$PatientId'";
            $Res = mysqli_query($conn, $Sql) or die("Could not get Package name" . mysqli_error($conn));
            while ($Rows = mysqli_fetch_array($Res)) {
                $FirstName = $Rows['FirstName'];
                $LastName = $Rows['LastName'];
            }
            echo $FirstName . " " . $LastName; ?></td>
				<td ><?php
                                    $Sql = "SELECT StockName FROM StockTable WHERE Id='$ParticularsId'";
            $Res = mysqli_query($conn, $Sql) or die("Could not get Package name" . mysqli_error($conn));
            while ($Rows = mysqli_fetch_array($Res)) {
                $StockName = $Rows['StockName'];
            }
            echo $StockName; ?></td>
				<td ><?php echo $Quantity; ?></td>
				<td ><?php echo $Cost; ?></td>
				<td ><?php echo $Amount; ?></td>
				<td ><?php echo $ReceiptNo; ?></td>
				<td ><?php echo $PaymentMode; ?></td>
				<td ><?php
                                    $Sql = "SELECT EmployeeTable.EmployeeName FROM EmployeeTable join UsersTable ON
EmployeeTable.Id=UsersTable.EmployeeId WHERE UsersTable.UserId='$UserId'";
            $Res = mysqli_query($conn, $Sql) or die("Could not get Package name" . mysqli_error($conn));
            while ($Rows = mysqli_fetch_array($Res)) {
                $name = $Rows['EmployeeName'];
            }
            echo $name; ?></td>
				<td ><?php
                                    if ($Banked == 1) {
                                        echo "<font color='green'>BANKED</font>";
                                    } else {
                                        echo "<font color='red'>NOT BANKED</font>";
                                    } ?></td>
			</tr>
		<?php
            $count++;
        } ?>
	</tbody>
<?php
    }
?>
</table>