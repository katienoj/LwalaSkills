<?php 
include "../../../Main/Config/db_conn.php";
require_once '../../includes/StockFunctions.php';

$StockName=$_REQUEST['StockName'];
$BarcodeNo=$_REQUEST['BarcodeNo'];
$Category=$_REQUEST['Category'];
$minReorder=$_REQUEST['minReorder'];
$MaxReorder=$_REQUEST['MaxReorder'];
$minStock=$_REQUEST['minStock'];
$MaxStock=$_REQUEST['MaxStock'];
$OpeningStock=$_REQUEST['OpeningStock'];
$Counter=0;

if(empty($StockName) && empty($BarcodeNo) && empty($Category) && empty($MaxReorder) && empty($minReorder) && empty($minStock) && empty($MaxStock))
{
	$SearchSQL="SELECT * FROM StockTable";
	$ShowString="Show all Stock Products";
}
else
{
  $SearchString="SELECT * FROM StockTable";
  $ShowStr="Show all Stock Products";

  if($StockName!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE StockName LIKE '%$StockName%' OR UnitId LIKE '%$StockName%' OR specs LIKE '%$StockName%'";
	  $ShowWhere=" Where Stock Name is like $StockName";
	  }
	  else
	  {
	  $WhereParts.=" AND StockName LIKE '$StockName%' OR UnitId LIKE '%$StockName%' OR specs LIKE '%$StockName%'";
	  $ShowWhere.=" AND Stock Name is Like $StockName";
	  }
	$Counter++;
  }
  if($BarcodeNo!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE Barcode ='$BarcodeNo'";
	  $ShowWhere=" Where BarcodeNo  is  $BarcodeNo";
	  }
	  else
	  {
	  $WhereParts.=" AND Barcode ='$BarcodeNo'";
	  $ShowWhere.=" AND Barcode is  $BarcodeNo";
	  }
	$Counter++;
  }
  if($Category!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE CatId='$Category'";
	  $ShowWhere=" Where Category is $Category";
	  }
	  else
	  {
	  $WhereParts.=" AND CatId='$Category%'";
	  $ShowWhere.=" AND Category is ".CatName($Category);
	  }
	$Counter++;
  }
  
   if($MaxReorder!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE MaxReorder='$MaxReorder'";
	  $ShowWhere=" Where Max Reorder level is $MaxReorder";
	  }
	  else
	  {
	  $WhereParts.=" AND MaxReorder='$MaxReorder'";
	  $ShowWhere.=" AND Max Reorder level is $MaxReorder";
	  }
	$Counter++;
  }
   if($minReorder!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE MinReorder='$minReorder'";
	  $ShowWhere=" Where min Reorder level is $minReorder";
	  }
	  else
	  {
	  $WhereParts.=" AND MinReorder='$minReorder'";
	  $ShowWhere.=" AND Min Reorder level is $minReorder";
	  }
	$Counter++;
  }
   if($MaxStock!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE MaxStock='$MaxStock'";
	  $ShowWhere=" Where Max Stock level is $MaxStock";
	  }
	  else
	  {
	  $WhereParts.=" AND MaxStock='$MaxStock";
	  $ShowWhere.=" AND Max Stock level is $MaxStock";
	  }
	$Counter++;
  }
  if($minStock!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE MinStock='$minStock'";
	  $ShowWhere=" Where Min Stock level is $minStock";
	  }
	  else
	  {
	  $WhereParts.=" AND MinStock='$MinStock";
	  $ShowWhere.=" AND Min Stock level is $minStock";
	  }
	$Counter++;
  }
   if($OpeningStock!='')
  {
      if($Counter==0)
	  {
	  $WhereParts=" WHERE OpeningStock='$OpeningStock'";
	  $ShowWhere=" Where Opening Stock is $OpeningStock";
	  }
	  else
	  {
	  $WhereParts.=" AND OpeningStock='$OpeningStock";
	  $ShowWhere.=" AND Opening Stock level is $OpeningStock";
	  }
	$Counter++;
  }
  
  $SearchSQL=$SearchString.$WhereParts;
  
  $ShowString=$ShowStr.$ShowWhere;
  
}

echo $SearchSQL.":".$ShowString;
