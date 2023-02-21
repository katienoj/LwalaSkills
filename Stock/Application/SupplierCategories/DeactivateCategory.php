<?php 
session_start();
require_once '../../../Main/Config/db_conn.php';
require_once '../../../AuditTrail/Include/AuditTrailFunc.php'; 

$CategoryId=htmlentities($_REQUEST['CategoryId']);

//update suppliers categories
		$sql= "UPDATE SuppliersCategories SET Deactivate ='1' WHERE Id ='$CategoryId'";
		$res=mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if(!$res)
			{
			echo $res;
			}
			else
			{ 
			$SessionString = session_id();
			$SqlStr = $sql;
			AuditTransaction($SessionString,$SqlStr);		
			}
