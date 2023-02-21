<?php 
function SupplierPrevSelected($Id,$Cat)
{
  global $conn;
  
  $sql=mysqli_query($conn, "SELECT * FROM SupplierCategoryLink WHERE SupplierId='$Id' AND CatId='$Cat'") or die(mysqli_error($conn));
  
  if(mysqli_num_rows($sql)==0)
  {
  $result=0;
  }
  else
  {
  $result=1;
  }
  return $result;

}

function SupplierDetails($SupplierId)
{
    global $conn;
	
	$sql=mysqli_query($conn, "SELECT * FROM SuppliersTable WHERE Id='$SupplierId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$SupplierNames=$result['SupplierNames'];
	$SupplierLogo=$result['SupplierLogo'];
	$PostAddress=$result['PostAddress'];
	$Email=$result['Email'];
	$Phone=$result['Phone'];
	$Web=$result['WebSite'];
	$Town=$result['Town'];
	$Country=$result['Country'];
	if($SupplierLogo=='')
	{
	$SupplierLogo='noSupplier.gif';
	}
	return $SupplierNames.':'.$SupplierLogo.':'.$Email.':'.$Phone.':'.$Web.':'.$Town.':'.$Country;
}
function CatName($CatId)
{


    global $conn;
	
	$sql=mysqli_query($conn, "SELECT CatName FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$name=$result['CatName'];
	if($CatId==0)
	{
	  $name="Main view";
	}
	
	return $name;
}

function MainCat($CatId)
{


    global $conn;
	
	$sql=mysqli_query($conn, "SELECT MainCat FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$name=$result['MainCat'];
	//if($CatId==0)
	//{
	  //$name="Main view";
	//}
	
	return $name;
}





function PackageTypeName($PackagingTypeId)
{
    global $conn;
	$sql=mysqli_query($conn, "SELECT PackageType FROM PackageType WHERE Id='$PackagingTypeId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$name=$result['PackageType'];
	return $name;

}
function PackagePrice($StockItem,$ThePackage)
{
    global $conn;
	$strSQL="SELECT Price FROM StockPackaging WHERE StockId='$StockItem' AND Id='$ThePackage'";
	// $strSQL;
	$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	//echo $result['Price']."<br>";
	return $result['Price'];
	
}
function RequestTotal($SelectStockQties)
{
    global $conn;
	
	$SelectedStock=explode(':',$SelectStockQties);
	$Total=0;
	foreach($SelectedStock as $Stock)
	{
	//echo $Stock."<br>";
	   if($Stock!='')
	   {
	     $StockDetails=explode('@',$Stock);
		 $ThePackage=@$StockDetails[1];
		 $OtherDetails=explode('*',$StockDetails[0]);
		 $Qty=$OtherDetails[1];
		 $StockItem=$OtherDetails[0];
		 $PackagePrice=PackagePrice($StockItem,$ThePackage);
		 $TotalForPackage=$PackagePrice * $Qty;
		 $Total+=$TotalForPackage;
	   }
		  
	}
	return $Total;
}

function StockCategoryName($CatId)
{
//This function gets the name of a next of kin relationship based on the id supplied.It should be self explanatory

    global $conn;
	
	$sql=mysqli_query($conn, "SELECT CatName FROM StockCategory WHERE Id='$CatId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sql);
	$name=$result['CatName'];
	if($name=='')
	{
	$name="No Parent Category";
	}
	return $name;
}

function DepartmentPrevSelected($DepartmentId,$CatId)
{
   global $conn;
   
   $sql=mysqli_query($conn, "SELECT * FROM DepartmentCategoryLink WHERE DepartmentId='$DepartmentId' AND CatId='$CatId'") or die(mysqli_error($conn));
   if(mysqli_num_rows($sql)==0)
   {
   $result=0;
   }
   else
   {
   $result=mysqli_num_rows($sql);
   }
   return $result;
}

function UpdatePriceChangeHistory($StockId,$PackagingId,$price,$UserId)
{
    global $conn;
	$AfterPrice=0;
	$sql=mysqli_query($conn, "SELECT * FROM ItemPriceChangeLog WHERE StockId='$StockId' AND PackageId='$PackagingId'") or die(mysqli_error($conn));
	while($recs=mysqli_fetch_assoc($sql))
	{
	   $AfterPrice=$recs['AfterPrice'];  
	}
	$sql=mysqli_query($conn, "INSERT INTO ItemPriceChangeLog(StockId,PackageId,BeforePrice,AfterPrice,UserId,DateOfChange) VALUES('$StockId','$PackagingId','$AfterPrice','$price','$UserId',NOW())") or die(mysqli_error($conn));
	if($sql==1)
	{
	return "1";
	}
	else
	{
	return "0";
	}
}


function DisplayThisItem($item_id,$StockAlternatives)
{
    $StockAlternatives=explode(':',$StockAlternatives);
	$result='';
	$result=array_search($item_id,$StockAlternatives);
    
	return $result;
}
function PackageLinked($PackageId)
{
   global $conn;
   $StockItems='';
   $sql=mysqli_query($conn, "SELECT * FROM StockPackaging WHERE PackagingId='$PackageId'") or die(mysqli_error($conn));
   if(mysqli_num_rows($sql)==0)
   {
   $result='Not Linked';
   }
   else
   {
     while($recs=mysqli_fetch_array($sql))
	 {
	    $StockId=$recs['StockId'];
		$StockItems.=$StockId.'-';
	 }
	 $result="<a href='#' onclick=\"ShowLinkedItems('$PackageId','$StockItems')\">Linked Items</a>";
   }
   return $result;
}
