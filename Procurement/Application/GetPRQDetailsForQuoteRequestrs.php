<?php 
require_once '../../Main/Config/db_conn.php';
require_once '../includes/ProcurementFunctions.php';

$SelectedPRQs=explode(':',$_REQUEST['SelectedPRQs']);
foreach($SelectedPRQs as $PRQ)
{
	if($PRQ!='')
	{
		$sqlTempPRQ=mysqli_query($conn, "SELECT * FROM ProcurementTable WHERE Id='$PRQ' order by Id DESC") or die(mysqli_error($conn));
		
		while($recs=mysqli_fetch_array($sqlTempPRQ))
		{
			$CatId=$recs['CatId'];
			$DateCreated=dteconvert($recs['DateCreated']);
			$RequestId=$recs['RequestId'];
                        $Id=$recs['Id'];
                        echo $CatId.":".$Id;
		}
	}
}
