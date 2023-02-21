<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';


$LPOId=$_REQUEST['LPOId'];
$DeliveryNote=$_REQUEST['DeliveryNoteNo'];

$BroughtInDetails=explode(':',$_REQUEST['BroughtInDetails']);
$Now=date('y-m-d',time());
$success=0;

foreach($BroughtInDetails as $BroughtIn)
{
   if($BroughtIn!='')
   {
     
       $BroughtInInfo=explode('*',$BroughtIn);
	   $StockId=$BroughtInInfo[0];
	   $QtyBroughtIn=$BroughtInInfo[1];
	   
	   $LPOQtyDetails=explode(':',LPOQtyDetails($StockId,$LPOId));
	   $RemainQty=$LPOQtyDetails[0];
	   $LPOPackaging=$LPOQtyDetails[1];
	   $LPOCatId=$LPOQtyDetails[2];
	   
	   $sqlCheckLastQty=mysqli_query($conn, "SELECT  ExpectedQty,BroughtInQty FROM LPOService WHERE StockId='$StockId' AND LPOId='$LPOId'") or die(mysqli_error($conn));
	  while($result=mysqli_fetch_assoc($sqlCheckLastQty))
	  {
	   $ExpectedQty=$result['ExpectedQty'];
	   $BroughtInQty=$result['BroughtInQty'];
	   }
	   if(empty($BroughtInQty) or empty($ExpectedQty))
		{
		  $LastRemainQty=$RemainQty;
		}
		else
		{
		   $LastRemainQty=$ExpectedQty-$BroughtInQty;
		}
		
      $NewRemainQty=$LastRemainQty-$QtyBroughtIn;
	  
	  $sqlInsertLPOService=mysqli_query($conn, "INSERT INTO LPOService(StockId,LPOId,ExpectedQty,BroughtInQty,RemainQty,DateOfService,DeliveryNote) VALUES('$StockId','$LPOId','$LastRemainQty','$QtyBroughtIn','$NewRemainQty','$Now','$DeliveryNote')") or die(mysqli_error($conn));
	  
	  if($sqlInsertLPOService==1)
	  {
	  WriteStockMvtIn($StockId,$QtyBroughtIn,$LPOPackaging,$LPOCatId,$Now,'10','19');
	  $success+=1;
	  }	/**/
  }
	   
}

if($success>0)
{
echo $success;
}
else
{
echo "Unable to store Quantities Brought in";
}
