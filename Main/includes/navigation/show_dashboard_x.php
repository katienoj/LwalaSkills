<?PHP
include "../../Config/db_conn.php";
global $conn;
session_start();
$user_id = $_SESSION['UserId'];
$group_id = GetGroup($user_id);
?>



<table width="100%" border="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td valign="top">
      <hr width="100%">

      <?php
      $sql = mysqli_query($conn, "SELECT * FROM SystemModules ORDER BY ModuleName ASC ") or die(mysqli_error($conn));
      $rows = mysqli_num_rows($sql);
      if ($rows == 0) {
      ?>

        <table width="100%" border="0">
          <tr>
            <td  align="center">Sorry.No user_groups added to the system yet </td>
          </tr>
        </table>
      <?php  } else {
      ?>
        <table width="100%" align="center" cellpadding="3" cellspacing="1">
          <tbody style="height:730px;max-height:760px;overflow-x:hidden;overflow-y:auto;">
            <tr>
              <?php $countCat = 0;
              while ($recs = mysqli_fetch_array($sql)) {

                $module_id = $recs['ModuleId'];

                $module_name = $recs['ModuleName'];
                $linkPicture = $recs['linkPicture'];
                $folderName = $recs['FolderName'];
                $permission = getPermission($group_id, $module_id);
                $permission = getPermission($group_id, $module_id);

                //echo $permission;
                if ($permission != 0) {/**/
                  //echo "Kubaff";
              ?>
                  <td valign="top">
                    <table width="100%">
                      <tr>
                        <td width="70" height="70" align="center" >
                          <a href="javascript:void(0)" onclick="ShowModule('<?php echo $module_id; ?>','<?php echo $folderName; ?>')"> <img src="Main/Layout/images/DashboardLinks/<?php echo $linkPicture; ?>" width="70" height="70" border="0" align="center" /></a>
                        </td>
                      </tr>
                      <tr>
                        <td width="100"  align="center"><a href="javascript:void(0)" onclick="ShowModule('<?php echo $module_id; ?>','<?php echo $folderName; ?>')" style="text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;"><?php echo ucwords(strtolower($module_name)); ?></a></td>
                      </tr>
                    </table>
                  </td>

                  <?php $countCat = $countCat + 1;

                  if ($countCat < 6) {
                    #### do nothing
                  } else {
                  ?>

            <tr>
        <?php $countCat = 0;
                  }
                }
              }
        ?>




    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
<?php  }
?>
</tbody>
</table>