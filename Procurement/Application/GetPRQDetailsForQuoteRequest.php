<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$SelectedPRQs=explode(':',$_REQUEST['SelectedPRQs']);
foreach($SelectedPRQs as $PRQ)
{
	if($PRQ!='')
	{
	$sqlGetPRQParent=mysqli_query($conn, "SELECT PRQId FROM ProcurementRequest WHERE PRQId='$PRQ'") or die(mysqli_error($conn));
	$result=mysqli_fetch_assoc($sqlGetPRQParent);
	$PRQId=$result['PRQId'];
		$sqlTempPRQ=mysqli_query($conn, "SELECT * FROM ProcurementTable WHERE Id='$PRQId' order by Id DESC") or die(mysqli_error($conn));
		
		while($recs=mysqli_fetch_array($sqlTempPRQ))
		{
			$CatId=$recs['CatId'];
			$DateCreated=dteconvert($recs['DateCreated']);
			$RequestId=$recs['RequestId'];
            $Id=$recs['Id'];
            echo $CatId.":".$RequestId;
		}
	}
}
