<?php
include "../../../Main/Config/db_conn.php";
$PackagingId=$_REQUEST['PackagingId'];
$strSQL="DELETE FROM StockPackaging WHERE Id='$PackagingId'";
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
if ($sql==1) {
    echo "1";
} else {
    echo "Unable to delete packaging";
}
