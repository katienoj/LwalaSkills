<?php
session_start();
include "../../Config/db_conn.php";
global $conn;
$user_id = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
if ($user_id == '') {
    $user_id = ResolveUserId(number_format($EmployeeId));
}
$group_id = GetGroup($user_id);
function LoadKapic($SubCategoryId)
{
    global $conn;
    $Kapic = '';
    $strSQL = "SELECT * FROM SystemModules WHERE CategoryID='$SubCategoryId'";
    //echo $strSQL;
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    //echo mysqli_num_rows($sql);
    $rows = mysqli_num_rows($sql);
    if ($rows > 1) {
        $Kapic = "<input type='image' src='Main/Layout/images/DashboardLinks/Arrow.gif' width='15' height='10' style='float:right;'>";
    }
    return $Kapic;
}
function ThemModules($CatId, $group_id)
{
    global $conn;
    $thesubs = '';
    $strSQL = "SELECT * FROM SystemModules WHERE CategoryID='$CatId'";
    //echo $strSQL;
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    //echo mysqli_num_rows($sql);
    $rows = mysqli_num_rows($sql);
    if ($rows == 0) {
        $thesubs = '';
        return $thesubs;
    } else {
        $countCat = 0;
        while ($recs = mysqli_fetch_array($sql)) {
            $module_id = $recs['ModuleId'];
            //echo $countCat." ";
            $module_name = $recs['ModuleName'];
            $linkPicture = $recs['linkPicture'];
            $folderName = $recs['FolderName'];
            $permission = getPermission($group_id, $module_id);
            if ($permission != 0 && $rows > 1) {/**/
                /* $themenu="<a href='javascript:void(0)' onclick='ShowModule($module_id,$folderName)' style='text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#666666;/>".ucwords(strtolower($module_name))."</a>";*/
                $thesubs .= "<li><input type='button' class='btn btn-info btn-block' value='$module_name' onclick=\'ShowModule($module_id,'$folderName')\'/></li>";
                // echo $thesubs;
            }
            $countCat++;
        }
        return $thesubs;
        //echo $thesubs;
    }
}
function SubCategories($CategoryId, $group_id)
{
    global $conn;
    $thesubs = '';
    $strSQL = "SELECT * FROM ModuleCategories WHERE ParentCategory='$CategoryId' ORDER BY CategoryName ASC";
    //echo $strSQL;
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    //echo mysqli_num_rows($sql);
    if (mysqli_num_rows($sql) == 0) {
        $thesubs = 0;
        return $thesubs;
    } else {
        while ($recs = mysqli_fetch_array($sql)) {
            $SubCategoryId = $recs['Id'];
            $CategoryName = $recs['CategoryName'];
            //echo ThemModules($SubCategoryId,$group_id);
            $themenu = "<li><input type='button' class='btn btn-info btn-block' value='$CategoryName' onclick='LoadCategoryModule($SubCategoryId)'>" . LoadKapic($SubCategoryId) . "<ul>" . ThemModules($SubCategoryId, $group_id) . "</ul></li> ";
            $thesubs .= $themenu;
        }
        //echo $thesubs;
        return $thesubs;
    }
}
?>
<?php
$strSQL = "SELECT * FROM ModuleCategories WHERE ParentCategory='' OR ParentCategory is Null ORDER BY CategoryName ASC";
$sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
$sql_rows = mysqli_num_rows($sql);
$count = 0;
while ($recs = mysqli_fetch_array($sql)) {
    $CategoryId = $recs['Id'];
    $CategoryName = $recs['CategoryName'];
    $SubCategories = SubCategories($CategoryId, $group_id);
    if ($SubCategories == "0") {
        ///echo "Kubaff";
        $submenus = '';
    } else {
        //echo "Silly";
        $submenus = "<ul>" . $SubCategories . "</ul>";
    }
    //echo $submenus;?>
	<ul class="nav navbar-nav">
		<li><input type="button" class="btn btn-info btn-block" value="<?php echo $CategoryName; ?>">
			<?php echo $submenus; ?>
		</li>
	</ul>
<?php
    $count++;
}
?>
<ul class="nav navbar-nav">
	<li><input type="button" class="btn btn-info btn-block" value="LOGOUT" onclick="DashBoardLogout();"></li>
</ul>
<ul class="nav navbar-nav">
	<li><input type="button" class="btn btn-info btn-block" value="PASSWORD" onclick="ShowResetPasswordForm_2()"></li>
</ul>
<ul class="nav navbar-nav">
	<li><input type="button" class="btn btn-info btn-block" value="" onclick="BackHome()"></li>
</ul>
<ul class="nav navbar-nav">
	<li><input type="button" class="btn btn-info btn-block" value="" onclick="BackHome()"></li>
</ul>