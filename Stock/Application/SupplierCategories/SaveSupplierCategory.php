<?php 
session_start();
require_once '../../../Main/Config/db_conn.php';
require_once '../../../AuditTrail/Include/AuditTrailFunc.php'; 

$Category=htmlentities($_REQUEST['Category']);

//Check if a category already exists with the same name
	$CheckCategory = mysqli_query($conn, "SELECT * FROM SuppliersCategories WHERE Category='$Category'") or die(mysqli_error($conn));
	$Row = mysqli_fetch_array($CheckCategory);
	if (mysqli_num_rows($CheckCategory) > 0)
	{
		echo "Category already exists";
	}
	else
	{
		$sql= "INSERT INTO SuppliersCategories (Category,Deactivate) VALUES ('$Category','0')";
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
	}
