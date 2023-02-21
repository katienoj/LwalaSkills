<?php
function sub_modules($parent_module, $group_id, $user_id)
{
    //echo $user_id;
    global $dbconn;
    global $conn; ?>
<ul id="mainmenu" style="width:100%;">
<?php
$strSQL="SELECT * from SystemSubModules WHERE ParentModule='$parent_module' ORDER BY DispOrder ASC";
    //echo $strSQL;
    $sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    if (mysqli_num_rows($sql)>0) {
        while ($recs=mysqli_fetch_array($sql)) {
            $module_id=$recs['SubModuleId'];
            $module_name=$recs['ModuleName'] ;
            $js_function=$recs['JsFunction'];
            $permission=get_sub_permission($group_id, $module_id, $user_id);
            //echo $permission;
            /**/if ($permission!=0) {
                ?>
<li><a href="javascript:void(0)" onClick="<?php echo $js_function; ?>('<?php echo $module_id; ?>')" onblur='indicate_where("<?php echo $module_name; ?>");' onfocus="module_functions('<?php echo $module_id; ?>')"><?php echo $module_name; ?></a></li>
<?php
            }
        }
    } ?>
</ul>
<?php
}
function get_sub_permission($group_id, $module_id, $user)
{
    global $conn;
    $permission='';
    $strSQL="SELECT Permission,DeniedUsers FROM UserSubModulePermissions WHERE GroupId='$group_id' AND ModuleId='$module_id'";
    //echo $strSQL;
    $get_perm=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($get_perm);
    $permission=$result['Permission'];
    $denied_users=$result['DeniedUsers'];
    if (stristr($denied_users, ':')) {
        $users=explode(':', $denied_users);
        $x=0;
        while ($x<count($users)) {
            if ($users[$x]==$user) {
                $permission=0;
            }
            $x++;
        }
    } else {
        $permission=$result['permission'];
    }
    return "1";
}
function get_permission($group_id, $module_id)
{
    global $conn;
    $get_perm=mysqli_query($conn, "SELECT Permission FROM UserPermissions WHERE GroupId='$group_id' AND ModuleId='$module_id'") or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($get_perm);
    $permission=$result['Permission'];
    //echo $permission;
    return "1";
}
?>