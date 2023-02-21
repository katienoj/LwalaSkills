<?php 
require_once '../../../Main/Config/db_conn.php';
require_once '../../includes/StockFunctions.php';


$StockId=$_REQUEST['StockId'];
 $ItemId=$_REQUEST['ItemId'];

$NewStockAlternative='';
$sql=mysqli_query($conn, "SELECT StockAlternatives FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);
$OldStockAlternatives=$result['StockAlternatives'];

$NewStockAlternative.=$OldStockAlternatives.":".$ItemId.":";

$UpdateAlternative=mysqli_query($conn, "UPDATE StockTable SET StockAlternatives='$NewStockAlternative' WHERE Id='$StockId'") or die(mysqli_error($conn));
if($UpdateAlternative==1)
{
echo "1";
}
else
{
echo "Unable to add alternative";
}


?>