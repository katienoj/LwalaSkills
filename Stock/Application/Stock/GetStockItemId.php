<?php 
require_once '../../../Main/Config/db_conn.php';
require_once '../../includes/StockFunctions.php';


$ItemName=$_REQUEST['ItemName'];

$ItemId=StockId($ItemName);

echo $ItemId;
