<?php 
session_start();

require_once '../../Main/Config/db_conn.php';
require_once '../includes/RequisitionsFunctions.php';
if(1>0)
{
	$UserId=$_SESSION['UserId'];
	$EmployeeId=$_SESSION['EmployeeId'];
	$UserNames=$_SESSION['UserName'];
	$Now=date('Y-m-d',time());
	$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$SessionId=$result['Session_Id'];
	//echo "New ".$SessionId."<br>Old".session_id();
	if($SessionId != session_id() or $SessionId=='')
	{
	echo "reload";
	}/**/
    $SelectedRequests=explode(':',$_REQUEST['SelectedRequests']);
	//if(CheckIfDepartmentHead($UserId)==1)
	if(1>0)
	{
	$success=0;
	foreach($SelectedRequests as $RequestId)
	{
	    if($RequestId!='')
		{
	       $sqlCheck=mysqli_query($conn, "SELECT HODApproved,RequestFromDepartment FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
		   $results=mysqli_fetch_assoc($sqlCheck);
		   $PrevApproved=$results['HODApproved'];
		   $RequestFromDepartment=$results['RequestFromDepartment'];
		   
		   if($PrevApproved==1)
		   {
		   echo "The Internal Requisition is Approved!";
		   }
		   else
		   {
		      if(1>0)
			  {
			  $strSQL="UPDATE InternalStockRequests SET HODApproved='1',HODApprover='$UserId',DateOfApproval='$Now',Processed='1',ProcessedBy='$UserId',DateOfProcessing='$Now' WHERE Id='$RequestId'";
			  }
			  else
			  {
			  $strSQL="UPDATE InternalStockRequests SET HODApproved='1',HODApprover='$UserId',DateOfApproval='$Now' WHERE Id='$RequestId'";	 
			  }
			  // echo $strSQL;
			   $sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
			  // echo "SQL". $sql;
				$success+=1;
		   }
		   
		 }
		
	}
	if($success >0)
	{
	echo "1";
	}
	}
	else
	{
	echo "You are not the Head of Department for the ".DepartmentName(GetUserDepartment($UserId))." department";
	}
		
}
else
{
echo "reload";
}

?>
