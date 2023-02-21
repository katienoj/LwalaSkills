<?php 
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';

$SelectedRequests=$_REQUEST['SelectedRequests'];
if(1>0)
{
     $UserId=$_SESSION['UserId'];
	$EmployeeId=$_SESSION['EmployeeId'];
	$UserNames=$_SESSION['UserName'];
	if($UserId=='')
	{
	$UserId=ResolveUserId(number_format($EmployeeId));
	}
	$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$SessionId=$result['Session_Id'];
	if($SessionId != session_id() or $SessionId=='')
	{
	echo "reload";
	}
	else
	{
		//if(CheckIfDepartmentHead($UserId)==1)
		if(1>0)
		{
		     $TheRequests=explode(':',$SelectedRequests);
			 foreach($TheRequests as $RequestId)
			 {
                if($RequestId!=' ')
				{
				   $sqlCheck=mysqli_query($conn, "SELECT PROCApproved FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
				   $results=mysqli_fetch_assoc($sqlCheck);
				   $PrevApproved=$results['PROCApproved'];
				   if($PrevApproved==1)
				   {
				   echo "You are not able approve an already approved Request";
				   }
				   else 
				   {
				   echo "1";
				   }
				 }
			 }
		}
		else
	   {
		echo "You are not the Head of Department for the ".DepartmentName(GetUserDepartment($UserId))." department";
	   }
	}
	
}

?>

