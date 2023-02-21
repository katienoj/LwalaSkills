<?php
session_start();
$UserId = $_SESSION['UserId'];
include "../../Config/db_conn.php";
global $conn;
$GroupId = GetGroup($UserId);
$moduleId = $_REQUEST['ModuleId'];
?>
<ul id="topmenu">
  <?php
  // echo $moduleId;
  $strSQL = "SELECT * FROM SystemSubModules WHERE ParentModule='$moduleId' OR ParentModule='100000000' ORDER BY DispOrder ASC";
  //echo $strSQL;

  $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
  $sql_rows = mysqli_num_rows($sql);
  $count = 0;
  while ($recs = mysqli_fetch_array($sql)) {
      $module_id = $recs['SubModuleId'];
      $module_name = $recs['ModuleName'];
      $JsFunction = $recs['JsFunction'];
      $dispOrder = $recs['DispOrder'];


      $permission = GetPermission($GroupId, $module_id);
      if ($permission == '') {
          $permission = 1;
      }
      if ($permission != 0) {/**/
          //echo "Kubaff";
          if ($count == 0) {
          } ?>
      <li class="nav-item"><a href="javascript:void(0)" onclick="LoadModuleFunctions('<?php echo $module_id; ?>');<?php echo $JsFunction; ?>();LoadQuickLinks('<?php echo $module_id; ?>')"><?php echo $module_name; ?></a></li>
  <?php
      }
      $count++;
  }


  ?>
</ul>
</tbody>
</table>