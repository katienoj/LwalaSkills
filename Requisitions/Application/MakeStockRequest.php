<?php
 session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
$SelectStockQties=$_REQUEST['SelectStockQties'];
$RequestFromDept=$_REQUEST['Department'];
$DateExpected=convert_date($_REQUEST['DateExpected']);
$DateOfRequest=date('Y-m-d h:m:s',time());
$DepartmentId=GetUserDepartment($UserId);

if($RequestFromDept==$DepartmentId)
{
echo "You cannot request for stock from the same department you are in";
}
else
{
$RequestTotal=RequestTotal($SelectStockQties);
$strSQL="INSERT INTO InternalStockRequests(DepartmentId,DateOfRequest,DateExpected,StockDetails,RequestTotal,RequestFromDepartment,RequestInitiator) VALUES('$DepartmentId','$DateOfRequest','$DateExpected','$SelectStockQties','$RequestTotal','$RequestFromDept','$UserId')";
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));

if($sql==1)
{
echo "1";
}
else
{
echo "Unable to make request";
}
}
