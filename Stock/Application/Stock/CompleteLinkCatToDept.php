<?php 
//echo "Kubaff";
include "../../../Main/Config/db_conn.php";

$CatId=$_REQUEST['CatId'];
$Departments=explode(':',$_REQUEST['SelectedDepartments']);
$success=0;
foreach($Departments as $Dept)
{
    if($Dept!='')
	{
	   $sql=mysqli_query($conn, "INSERT INTO DepartmentCategoryLink(CatId,DepartmentId) VALUES('$CatId','$Dept')") or die(mysqli_error($conn));
	   if($sql==1)
	   {
	   $success+=1;
	   }
	}
}
if($success>0)
{
echo "1";
}
/**/
