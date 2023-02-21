<?php 
session_start();
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';
$UserId=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
$UserNames=$_SESSION['UserName'];
//echo $_REQUEST['selectedRequests']."<br>";
$selectedRequests=explode(':',$_REQUEST['selectedRequests']);
if($UserId=='')
{
$UserId=ResolveUserId(number_format($EmployeeId));
}
$CleanPRQTempTable=CleanPRQTempTable($UserId);
if($CleanPRQTempTable==1)
{
foreach($selectedRequests as $RequestId)
{
if($RequestId!='')
{
$sqlCheck=mysqli_query($conn, "SELECT * FROM InternalStockRequests WHERE Id='$RequestId'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sqlCheck);
	$StockItems=$result['StockDetails'];
    $TheItems=explode(':',$StockItems);
	
   foreach($TheItems as $TheItem)
   {
        if($TheItem!=' ')
		{
		    $StockIds=explode('*',$TheItem);
			
			$StockId=$StockIds[0];
			//echo $StockId."<br>";
			if(empty($StockId))
			{
	
			}
			else
			{     // echo $StockId."<br>";
					$OtherItemDetails=explode('@',$StockIds[1]);
					$Qty=$OtherItemDetails[0];
					$Packaging=$OtherItemDetails[1];
					$CatId=StockCategory($StockId);
					
					$sqlIfExists=mysqli_query($conn, "SELECT * FROM PRQTemp WHERE StockId='$StockId' AND Packaging='$Packaging' AND UserId='$UserId'") or die(mysqli_error($conn));
					if(mysqli_num_rows($sqlIfExists) >0)
					{		 
					   $resultExists=mysqli_fetch_assoc($sqlIfExists);
					   $ExistId=$resultExists['Id'];
					   $QtyExists=$resultExists['Qty'];
					   $NewQty=$QtyExists+$Qty;
					   $UpdateExists=mysqli_query($conn, "UPDATE PRQTemp SET Qty='$NewQty' WHERE Id='$ExistId'") or die(mysqli_error($conn));
					}
					else
					{
					
					$sql=mysqli_query($conn, "INSERT INTO PRQTemp(StockId,CatId,Qty,Packaging,RequestId,UserId) VALUES('$StockId','$CatId','$Qty','$Packaging','$RequestId','$UserId')") or die(mysqli_error($conn));
					}	
		 }
		}
   }
  }
  
  }
  }
  
	$sqlTempPRQ=mysqli_query($conn, "SELECT * FROM PRQTemp WHERE UserId='$UserId'") or die(mysqli_error($conn));
	?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css" />


<table borde=r"0" bgcolor="#E4E4E4" class="formborder" width="600">
<tr>
<td><table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
  <tr >
    <td width="94%" class="formtop"   onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Generate Procurement Request</td>
    <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20"align="right" onclick="closepopupdiv()" style="cursor:hand" /></td>
  </tr>
</table></td>
</tr>
<tr>
<td>
<table border="0" width="100%">
<thead>
<tr>
<td width="28%" class="heading">Stock Name </td>
<td width="24%" class="heading">Qty Requested </td>
<td width="27%" class="heading">Packaging Requested </td>
<td width="21%" class="heading">Category</td>
</tr>
</thead>
<tbody style="width:100%;height:300px;max-height:300px; overflow-x:hidden; overflow-y:auto;">
<?php 
$count=0;
while($recs=mysqli_fetch_array($sqlTempPRQ))
{
$Id=$recs['Id'];
$StockId=$recs['StockId'];
$Qty=$recs['Qty'];
$Packaging=$recs['Packaging'];
$CatId=$recs['CatId'];
 if($count%2 == 0){ $bg = '#E1E1FF'; }else{ $bg = '#EAEAEA'; }
    ?>
    <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'"> 
	
	 <td><?php echo StockName($StockId); ?></td><input class="form-control" type="hidden" name="TempId" id="TempId" value="<?php echo $Id; ?>"  />
  <td><input class="form-control" type="text" name="QtyRequested<?php echo $Id; ?>" id="QtyRequested<?php echo $Id; ?>"  value="<?php echo $Qty; ?>"  size="10" OnKeyUp="CheckIfEmpty()"/></td>
  <td><?php echo PackagingInfo($Packaging); ?></td>
  <td colspan="2"><?php echo CatName($CatId); ?></td>
   </tr>
<?php
$count++;
}
?>
</tbody>
</table>
</td>
</tr>
<tr>
  <td><input class="form-control" type="hidden" name="SelectedPRQs" id="SelectedPRQs" value="<?php echo $selectedRequests; ?>" />
  <input class="form-control" type="hidden" name="SuccessStoringNewAmt"  id="SuccessStoringNewAmt" value="" />
  <input class="form-control" name="GeneratePRQs" type="button" id="GeneratePRQs" value="Proceed To Generate PRQs" style="float:right;"  onclick="StoreNewRequestAmtsFirst()"  /></td>
</tr>
</table>
<?php

?>
