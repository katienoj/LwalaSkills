<?php
require_once '../../Config/db_conn.php';

global $conn;

$EmployeeId = htmlentities($_REQUEST['employeeId']);
/*Get employee details on selecting the checkbox while defining reporting hierachay.*/
$SqlStatement = "Select * From StockTable Where Id = '$EmployeeId'";
$ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute query");
/*Chack if the query excuted succesefuly*/
if(!$ExecSqlStatement)
{
	echo '0';
}
else
{
	/*Get the lincese details*/
	$Id = ''; $StockName = ''; $Cost = '';
	while($Row = mysqli_fetch_array($ExecSqlStatement))
	{
		//$Id = htmlentities($Row['Id']);
		$StockName = htmlentities($Row['StockName']);
		$Cost = htmlentities($Row['StockPrice']);
		
		echo $StockName.':'.$Cost;
	}
}
