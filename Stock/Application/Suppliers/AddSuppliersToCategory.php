<?php 
require_once '../../../Main/Config/db_conn.php';

$CatId=$_REQUEST['CatId'];

//echo $CatId.":".$_REQUEST['Suppliers'];

$Suppliers=explode(':',$_REQUEST['Suppliers']);
$Success=0;
foreach($Suppliers as $Supplier)
{
   if($Supplier!='')
   {
      $InsertSQL=mysqli_query($conn, "INSERT INTO SupplierCategoryLink(SupplierId,CatId) VALUES('$Supplier','$CatId')") or die(mysqli_error($conn));
	  if($InsertSQL==1)
	  { 
	    $Success+=1;
	  }
	}
}
if($Success > 0)
{
echo "1";
}
else
{
echo "Suppliers not attached to category";
}
