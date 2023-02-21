<?php
require_once "../../Main/Config/db_conn.php";
require_once '../includes/RequisitionsFunctions.php';

$Department = $_REQUEST['Department'];
$RequestSelect = $_REQUEST['RequestSelect'];
$ExpectSelect = $_REQUEST['ExpectedSelect'];
$DateOfRequest = $_REQUEST['DateOfRequest'];
$DateExpected = $_REQUEST['DateExpected'];
$TotalSelect = $_REQUEST['TotalSelect'];
$RequestTotal = $_REQUEST['RequestTotal'];
$ItemId = $_REQUEST['ItemId'];


$SearchSQL = "";
$ShowSQL = "";
$Counter = 0;
if (empty($Department) && empty($RequestSelect) && empty($DateOfRequest) && empty($DateExpected) && empty($ItemId) && empty($RequestTotal)) {
	$SearchSQL = "SELECT * FROM InternalStockRequests ORDER BY Id DESC";
	$ShowSQL = "Display All Stock";
} else {

	$SelectPart = "SELECT * FROM InternalStockRequests";
	$ShowSelect = "Display All Stock";
	if ($Department != '') {
		if ($Counter == 0) {
			$WherePart = " WHERE DepartmentId ='$Department'";
			$ShowWhere = ' where Request came from the' . DepartmentName($Department) . ' department';
		} else {
			$WherePart .= " AND  DepartmentId ='$DepartmentId'";
			$ShowWhere .= ' and Request came from the' . DepartmentName($Department) . ' department';
		}
		$Counter++;
	}
	if ($DateOfRequest != '') {
		if ($Counter == 0) {
			$WherePart = " WHERE DateOfRequest $RequestSelect '" . convert_date($DateOfRequest);
			$ShowWhere = ' where Request\'s date of request $RequestSelect $DateOfRequest';
		} else {
			$WherePart .= " AND DateOfRequest $RequestSelect '" . convert_date($DateOfRequest);
			$ShowWhere .= ' and Request\'s date of request $RequestSelect $DateOfRequest';
		}
		$Counter++;
	}
	if ($DateExpected != '') {
		if ($Counter == 0) {
			$WherePart = " WHERE DateExpected $RequestSelect '" . convert_date($DateExpected);
			$ShowWhere = ' where date expected to service request $RequestSelect $DateOfRequest';
		} else {
			$WherePart .= " AND  DateExpected $RequestSelect '" . convert_date($DateExpected);
			$ShowWhere .= ' and date expected to service request $RequestSelect $DateOfRequest';
		}
		$Counter++;
	}
	if ($ItemId != '') {
		if ($Counter == 0) {
			$WherePart = " WHERE StockDetails LIKE '%$ItemId*%'";
			$ShowWhere = ' where one of the stock items on request is ' . StockName($ItemId);
		} else {
			$WherePart .= " AND StockDetails LIKE '%$ItemId*%'";
			$ShowWhere .= ' and one of the stock items on request is ' . StockName($ItemId);
		}
		$Counter++;
	}
	if ($RequestTotal != '') {
		if ($Counter == 0) {
			$WherePart = " WHERE RequestTotal $TotalSelect '$RequestTotal'";
			$ShowWhere = ' where the Request Total $TotalSelect $RequestTotal';
		} else {
			$WherePart .= " AND  RequestTotal $TotalSelect '$RequestTotal'";
			$ShowWhere .= ' and the Request Total $TotalSelect $RequestTotal';
		}
		$Counter++;
	}
	$SearchSQL = $SelectPart . $WherePart . " AND HODApproved='0'";
	$ShowSQL = $ShowSelect . $ShowWhere;
}

echo $SearchSQL . ":" . $ShowSQL;
