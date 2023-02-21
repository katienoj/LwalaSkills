<?php
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
$Item = $_REQUEST['Item'];
$strSQL = "SELECT * FROM StockTable WHERE StockName LIKE '$Item%'";
//echo $strSQL;
$sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
$rows = mysqli_num_rows($sql);
if ($rows > 0) {
	echo "<select class='form-control' id='hintTxt' multiple='multiple' size='' style='width:237px;  max-height:100px; background-color:#E7E7CF; border: 1px solid #808040;' onclick='GetItemDetail()' onBlur='hideHint()'>";

	while ($recs = mysqli_fetch_array($sql)) {
		$Name = $recs['Name'];
		$item_id = $recs['Id'];
		echo "<option class='form-control'>$Name</option>";
	}
	echo "</select>";
}
