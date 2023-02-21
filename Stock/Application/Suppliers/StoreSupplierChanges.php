<?php 
include "../../../Main/Config/db_conn.php";



$SupplierNames=$_REQUEST['SupplierNames'];
$Phone=$_REQUEST['Phone'];
$Email=$_REQUEST['Email'];
$web=$_REQUEST['web'];
$PhyAddress=$_REQUEST['PhyAddress'];
$PostAddress=$_REQUEST['PostAddress'];
$town=$_REQUEST['town'];
$country=$_REQUEST['country'];
$CreditTerms=$_REQUEST['CreditTerms'];
$CreditLimitAmt=$_REQUEST['CreditLimitAmt'];
$filename=$_REQUEST['filename'];
$SupplierId=$_REQUEST['SupplierId'];
$dte=date('Y-m-d',time());


$sqlCheck=mysqli_query($conn, "SELECT * FROM SuppliersTable WHERE (SupplierNames='$SupplierNames' OR Email='$Email' OR WebSite='$web' OR PostAddress='$PostAddress') AND Id!='$SupplierId' AND del!=1") or die(mysqli_error($conn));

if(mysqli_num_rows($sqlCheck)>0)
{
  echo "A supplier with similar details exists in the system.You can not register two or more suppliers with similar details";
}
else
{
  
  $sqlInsert="UPDATE SuppliersTable SET SupplierNames='$SupplierNames',Email='$Email',WebSite='$web',PostAddress='$PostAddress',PhyAddress='$PhyAddress',Phone='$Phone',Town='$town',Country='$country',CreditTerms='$CreditTerms',CreditLimitAmount='$CreditLimitAmt',SupplierLogo='$filename' WHERE Id='$SupplierId'";
  
  $ExecInsert=mysqli_query($conn, $sqlInsert) or die(mysqli_error($conn));
  if($ExecInsert==1)
  {
     echo "1";
  }
  else
  {
    echo "Unable to insert Supplier details";
  }
}
