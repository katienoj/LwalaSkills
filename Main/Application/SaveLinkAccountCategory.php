<?php  include "../Config/db_conn.php";
global $conn;
$module_id = $_REQUEST['module_id'];
$category_id = $_REQUEST['account_category_id'];
$sql_check = mysqli_query($conn, "SELECT * FROM ModuleAccountsCategories WHERE ModuleId='$module_id' AND CategoryId='$category_id'") or die(mysqli_error($conn));
if (mysqli_num_rows($sql_check)==0)
{
$sql = mysqli_query($conn, "INSERT INTO ModuleAccountsCategories (ModuleId, CategoryId) VALUES ('$module_id', '$category_id')") or die (mysqli_error($conn));
	if ($sql ==1)
	{
		echo "1";
	}
}
else
{	
		echo "2";	
}
