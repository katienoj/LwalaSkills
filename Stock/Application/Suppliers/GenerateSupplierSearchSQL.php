<?php
include "../../../Main/Config/db_conn.php";

$SupplierNames = $_REQUEST['SupplierNames'];
$Phone = $_REQUEST['Phone'];
$Email = $_REQUEST['Email'];
$web = $_REQUEST['web'];
$PhyAddress = $_REQUEST['PhyAddress'];
$PostAddress = $_REQUEST['PostAddress'];
$town = $_REQUEST['town'];
$country = $_REQUEST['country'];
$CreditTerms = $_REQUEST['CreditTerms'];
$CreditLimitAmt = $_REQUEST['CreditLimitAmt'];
$dte = date('Y-m-d', time());

$Counter = 0;
if (empty($SupplierNames) && empty($Phone) && empty($Email) && empty($web) && empty($PhyAddress) && empty($PostAddress) && empty($town) && empty($country) && empty($CreditTerms) && empty($CreditLimitAmt)) {

	$SearchSQL = "SELECT * FROM SuppliersTable";
	$ShowSearchStr = "Show all suppliers";
} else {
	$SearchString = "SELECT * FROM SuppliersTable";
	$ShowSearch = "Show all suppliers";
	if ($SupplierNames != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE SupplierNames LIKE '%$SupplierNames%'";
			$ShowWhere = " Where Supplier names are like $SupplierNames";
		} else {
			$WhereParts .= " AND SupplierNames LIKE '%$SupplierNames%'";
			$ShowWhere .= " and Supplier names are like $SupplierNames";
		}
		$Counter++;
	}
	if ($Phone != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE Phone LIKE '%$Phone%'";
			$ShowWhere = " Where Telephone number is like $Phone";
		} else {
			$WhereParts .= " AND Phone LIKE '%$Phone%'";
			$ShowWhere .= " and Telephone number is like $Phone";
		}
		$Counter++;
	}
	if ($Email != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE Email LIKE '%$Email%'";
			$ShowWhere = " Where Email Address is like $Email";
		} else {
			$WhereParts .= " AND Email LIKE '%$Email%'";
			$ShowWhere .= " and Email Address is like $Email";
		}
		$Counter++;
	}
	if ($web != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE WebSite LIKE '%$web%'";
			$ShowWhere = " Where Web URL is like $web";
		} else {
			$WhereParts .= " AND Email LIKE '%$Email%'";
			$ShowWhere .= " and Email Address is like $Email";
		}
		$Counter++;
	}
	if ($PhyAddress != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE PhyAddress LIKE '%$PhyAddress%'";
			$ShowWhere = " Where Physical Address is like $PhyAddress";
		} else {
			$WhereParts .= " AND PhyAddress LIKE '%$PhyAddress%'";
			$ShowWhere .= " and Physical Address is like $PhyAddress";
		}
		$Counter++;
	}
	if ($PostAddress != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE PostAddress LIKE '%$PostAddress%'";
			$ShowWhere = " Where Post Address is like $PostAddress";
		} else {
			$WhereParts .= " AND PostAddress LIKE '%$PhyAddress%'";
			$ShowWhere .= " and Physical Address is like $PostAddress";
		}
		$Counter++;
	}
	if ($town != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE Town LIKE '%$town%'";
			$ShowWhere = " Where Town is like $town";
		} else {
			$WhereParts .= " AND Town LIKE '%$town%'";
			$ShowWhere .= "and Town is like $town";
		}
		$Counter++;
	}
	if ($country != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE Country LIKE '%$country%'";
			$ShowWhere = " Where Country is like $country";
		} else {
			$WhereParts .= " AND Country LIKE '%$country%'";
			$ShowWhere .= " and Country is like $country";
		}
		$Counter++;
	}
	if ($CreditTerms != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE CreditTerms = '$CreditTerms'";
			$ShowWhere = " Where Credits terms are $CreditTerms";
		} else {
			$WhereParts .= " AND CreditTerms = '$CreditTerms'";
			$ShowWhere .= " and Credits terms are $CreditTerms";
		}
		$Counter++;
	}
	if ($CreditLimitAmt != '') {
		if ($Counter == 0) {
			$WhereParts = " WHERE CreditLimitAmt = '$CreditLimitAmt'";
			$ShowWhere = " Where Credit Limit Amount is $CreditLimitAmt";
		} else {
			$WhereParts .= " AND CreditTerms = '$CreditTerms'";
			$ShowWhere .= " and Credit Limit Amount is $CreditLimitAmt";
		}
		$Counter++;
	}

	$SearchSQL = $SearchString . $WhereParts;
	$ShowSearchStr = $ShowSearch . $ShowWhere;
}

echo $SearchSQL . ":" . $ShowSearchStr;
