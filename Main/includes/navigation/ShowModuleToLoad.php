<?php
session_start();
$UserId = $_SESSION['UserId'];
include "../../Config/db_conn.php";
global $conn;
$GroupId = GetGroup($UserId);
$moduleId = $_REQUEST['ModuleId'];
?>

      <?php
      $strSQL = "SELECT * FROM SystemSubModules WHERE ParentModule='$moduleId' ORDER BY DispOrder ASC";

      $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
      $sql_rows = mysqli_num_rows($sql);
      $count = 0;
      $recs = mysqli_fetch_assoc($sql);
      $module_id = $recs['SubModuleId'];
      $module_name = $recs['ModuleName'];
      $JsFunction = $recs['JsFunction'];
      $dispOrder = $recs['DispOrder'];


      $permission = GetPermission($GroupId, $module_id);
      if ($permission == '') {
          $permission = 1;
      }
      if ($permission != 0) {
          if ($count == 0) {
              echo $module_id . ":" . $JsFunction;
          }
      }

      ?>