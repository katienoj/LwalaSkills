<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';


$ItemName=$_REQUEST['ItemName'];
$ItemId=StockId($ItemName);

echo $ItemId;
