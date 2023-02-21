<?php

$StockId=$_REQUEST['StockId'];
$StockName=$_REQUEST['StockName'];

if($StockId=='' && $StockName=='')
{
$SQLString="SELECT DISTINCT * FROM StockTable";
}
else if($StockId!='' && $StockName=='')
{
$SQLString="SELECT DISTINCT * FROM StockTable WHERE Id='$StockId'";
}
else if($StockId=='' && $StockName!='')
{
$SQLString="SELECT DISTINCT * FROM StockTable WHERE StockName LIKE '%$StockName%' ";
}

else if($StockId!='' && $StockName!='')
{
$SQLString="SELECT DISTINCT * FROM StockTable WHERE StockName LIKE '%$StockId%' AND Id='$StockId'";
}


echo $SQLString;
