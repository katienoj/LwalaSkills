<?PHP
include "../../Config/db_conn.php";
global $conn;
session_start();
$user_id = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
if ($user_id == '') {
  $user_id = ResolveUserId(number_format($EmployeeId));
}
$group_id = GetGroup($user_id);
$CategoryId = $_REQUEST['CategoryId'];
?>



<table width="100%" border="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td align="left" valign="top">


      <?php
      $strSQL = "SELECT * FROM SystemModules WHERE CategoryID='$CategoryId' ORDER BY ModuleName ASC ";
      //echo $strSQL;
      $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
      $rows = mysqli_num_rows($sql);
      //echo $rows;
      if ($rows == 0) {
      ?>

        <table width="100%" border="1">
          <tr>
            <td  align="center">Sorry.No modules added to the selected categoery yet </td>
          </tr>
        </table>
      <?php  } else {
      ?>
        <table width="100%" align="left" cellpadding="3" cellspacing="1" border="0">
          <tbody style="height:100px;max-height:100px;">
            <tr>
              <?php $countCat = 0;
              while ($recs = mysqli_fetch_array($sql)) {

                $module_id = $recs['ModuleId'];

                $module_name = $recs['ModuleName'];
                $linkPicture = $recs['linkPicture'];
                $folderName = $recs['FolderName'];

                $permission = getPermission($group_id, $module_id);

                if ($permission != 0) {/**/
                  //echo "Kubaff";
              ?>
                  <td valign="top" width="100">
                    <table width="100%">
                      <tr>
                        <td width="70" height="70" align="left"  width="100" style="background:url(Main/Layout/images/ModuleBg1.png);background-repeat:no-repeat;" onmouseover="ChangeModuleMenuBackground(this)" onmouseout="ReturnOriginalBackground(this)">
                          <a href="javascript:void(0)" onclick="ShowModule('<?php echo $module_id; ?>','<?php echo $folderName; ?>')"> <img src="Main/Layout/images/DashboardLinks/<?php echo $linkPicture; ?>" width="50" height="50" border="0" align="left" /></a>
                        </td>
                      </tr>
                      <tr>
                        <td width="60"  align="left"><a href="javascript:void(0)" onclick="ShowModule('<?php echo $module_id; ?>','<?php echo $folderName; ?>')" style="text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;"><?php echo ucwords(strtolower($module_name)); ?></a></td>
                      </tr>
                    </table>
                  </td>

                  <?php $countCat = $countCat + 1;

                  if ($countCat < 6) {
                    #### do nothing
                  } else {
                  ?>

            <tr>
        <?php exit;
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