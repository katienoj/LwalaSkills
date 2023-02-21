<?php 
include "../../../Main/Config/db_conn.php";

$PackageName=$_REQUEST['PackageName'];
$PackagingId=$_REQUEST['PackagingId'];

$sql=mysqli_query($conn, "SELECT * FROM SetupPackaging WHERE PackageName='$PackageName' AND (Id != '' AND  Id!='$PackagingId')") or die(mysqli_error($conn));
if(mysqli_num_rows($sql)==0)
{
if($PackagingId=='')
{
$strSQL="INSERT INTO SetupPackaging(PackageName) VALUES('$PackageName')";
}
else
{
$strSQL="UPDATE SetupPackaging SET PackageName='$PackageName' WHERE Id='$PackagingId'";
}
$sql=mysqli_query($conn, $strSQL)or die(mysqli_error($conn));
if($sql==1)
{
echo "1";
}
else
{
echo "Unable to store package";
}
}
else
{
echo "Sorry,a different package with similar details exists in the system";
}
