<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';

$PackageId=$_REQUEST['PackageId'];
$PackageName=PackageName($PackageId);
echo $PackageName;
