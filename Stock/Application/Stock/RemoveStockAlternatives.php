<?php 
include "../../../Main/Config/db_conn.php";

$StockId=$_REQUEST['StockId'];
$SelectedItems=explode(':',$_REQUEST['SelectedAlternatives']);

$sql=mysqli_query($conn, "SELECT StockAlternatives FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);
$NewAlternatives='';
$TheAlternatives=explode(':',$result['StockAlternatives']);
  $count=0;
  foreach($SelectedItems as $item)
  {
     if($item!='')
	 {
	    $ItemToRemove=array_search($item,$TheAlternatives);
		unset($TheAlternatives[$ItemToRemove]);
		
	 }
  }
   foreach($TheAlternatives as $Alternative)
   {
     $NewAlternatives.=$Alternative.":";
   }
  
  
  $sql=mysqli_query($conn, "UPDATE StockTable SET StockAlternatives='$NewAlternatives' WHERE Id='$StockId'") or die(mysqli_error($conn));
  if($sql==1)
  {
  echo "1";
  }
  else
  {
  echo "Unable to alter stock Alternatives";
  }
