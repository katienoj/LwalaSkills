<?php
include "../../Config/db_conn.php";
global $conn;
session_start();
$user_id=$_SESSION['UserId'];
$EmployeeId=$_SESSION['EmployeeId'];
if ($user_id=='') {
    $user_id=ResolveUserId(number_format($EmployeeId));
}
$group_id=GetGroup($user_id);
$CategoryId=$_REQUEST['CategoryId'];
 $strSQL="SELECT * FROM SystemModules WHERE CategoryID='$CategoryId' ORDER BY ModuleName ASC ";
    //echo $strSQL;
$sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
$rows=mysqli_num_rows($sql);
//echo $rows;
if ($rows==0) {
    echo "0";
} else {
    $countCat=0;
    while ($recs=mysqli_fetch_array($sql)) {
        $module_id=$recs['ModuleId'];

        $module_name=$recs['ModuleName'] ;
        $linkPicture=$recs['linkPicture'];
        $folderName=$recs['FolderName'];
        //echo $group_id.":".$module_id;
        $permission=getPermission($group_id, $module_id);

        if ($permission!=0) {
            $TheModule=$module_id.":".$folderName.":";
        } else {
            $TheModule=0;
        }
    }
    if ($rows>1) {
        echo "0";
    } elseif ($rows==1) {
        echo $TheModule;
    }
}
