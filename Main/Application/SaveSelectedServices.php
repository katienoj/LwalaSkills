<?php 
include "../Config/db_conn.php";
global $conn;
session_start();
$UserId=stripslashes($_SESSION['UserId']);
$EmployeeId=$_SESSION['EmployeeId'];
if($UserId=='')
{
$UserId=ResolveUserId(number_format($EmployeeId));
}
$ServiceId=$_REQUEST['ServiceId'];
$qty=$_REQUEST['qty'];
$amt=$_REQUEST['amt'];
$Total=$_REQUEST['Total'];
$PatId=$_REQUEST['PatNo'];
$DeptId=$_REQUEST['DeptId'];
$dte=date('Y-m-d',time());

$PatientEpisode=PatientEpisode($PatId);

$sql_dname = mysqli_query($conn, "SELECT Max(Id) as Id FROM PatientEpisodes WHERE PatientId='$PatId' AND EpisodeNumber='$PatientEpisode'") or die(mysqli_error($conn));
    while ($rec_dname= mysqli_fetch_array($sql_dname))
      {
        
      $EpisodeId = $rec_dname['Id'];
   
      }

      $sql_pat = mysqli_query($conn, "SELECT PaymentMode FROM Patients WHERE Id='$PatId'") or die(mysqli_error($conn));
    while ($rec_pat= mysqli_fetch_array($sql_pat))
      {
        
      $Mode = $rec_pat['PaymentMode'];
   
      }


$strSQL="INSERT INTO PatientChargeSheetTemp(PatientId,ParticularsId,DepartmentId,Quantity,Cost,Amount,Date,EpisodeNo,UserId, BillType) VALUES('$PatId','$ServiceId','$DeptId','$qty','$amt','$Total','$dte','$EpisodeId','$UserId', '$Mode')";
//echo $strSQL;
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
if($sql==1)
{
echo "1";
}
else
{
echo "Unable to save selected services";
}
