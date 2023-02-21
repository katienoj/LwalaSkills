<?php
session_start();
include  "../Main/Config/db_conn.php";

$ModuleId=htmlentities($_REQUEST['ModuleId'], ENT_QUOTES);
$today =  date('Y-m-d');
$this_year= date("Y");
$this_month=date("m");
//echo $new_session;
if (isset($_SESSION["cArEFUT2010soFT"])) {
    $UserId=$_SESSION['UserId'];
    $EmployeeId=$_SESSION['EmployeeId'];
    $UserNames=$_SESSION['UserName'];
    $new_session=session_id();
    if ($UserId=='') {
        $UserId=ResolveUserId(number_format($EmployeeId));
    }
    $strSQL="SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'";
    //echo $strSQL."<BR>";
    $sql=mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result=mysqli_fetch_assoc($sql);
    $SessionId=$result['Session_Id'];
    //echo "Already created".$SessionId."<br>The Session".$new_session;
    if ($SessionId != $new_session or $SessionId=='') {
        header("Location:../index.php");
    }/**/
} else {
    //echo "Kubaff";
    header("Location:../index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" sizes="32x32" type="image/x-icon" href="../Main/Layout/images/Logo.png"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php
$sqlx=mysqli_query($conn, "SELECT HospitalName FROM SetHospital")or die(mysqli_error($conn));
      while ($recx=mysqli_fetch_array($sqlx)) {
          $HospitalName=$recx['HospitalName'];
      }
     echo $HospitalName;
     ?></title>
<link rel="stylesheet" href="../Main/Layout/styles/divs.css" />
<link rel="stylesheet" href="../Main/Layout/styles/topmenu.css" />
<link rel="stylesheet" href="../Main/Layout/styles/interface.css" />
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/general.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/CommonRequistion.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/MainValidation.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/move_divs.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/scw.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js"></script>
<script language="javascript" type="text/javascript" src="Layout/js_scripts/Requisitions.js"></script>
<script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/CommonAccountsSetup.js"></script>
<link rel="stylesheet" href="../DataTables/Bootstrap-4-4.1.1/css/bootstrap.min.css">
    <script src="../DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="../DataTables/Bootstrap-4-4.1.1/js/bootstrap.min.js"></script>
        <link href="../DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
        <link href="../DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css" />
        <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/dataTables.buttons.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/JSZip-2.5.0/jszip.min.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.html5.js"></script>
        <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.print.js"></script>
        <link href="../fontawesome/css/all.css" rel="stylesheet" type="text/css"/>    
        <!--<script language="javascript" type="text/javascript" src="../DataTable/sum().js"></script>
        End--> 
        <link rel="stylesheet" href="../admindashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../admindashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../admindashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../admindashboard/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admindashboard/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../admindashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../admindashboard/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../admindashboard/plugins/summernote/summernote-bs4.min.css">
<style type="text/css">
/* body {
  background-image:url(../Main/Layout/images/bg.jpg);
  background-repeat: repeat;
  background-size: 100%;
} */
  * {  box-sizing: border-box;}body {  font-family: Arial, Helvetica, sans-serif;}/* Float four columns side by side */.column {  float: left;  width: 25%;  padding: 0 10px;}/* Remove extra left and right margins, due to padding in columns */.row {margin: 0 -5px;}/* Clear floats after the columns */.row:after {  content: "";  display: table;  clear: both;}/* Style the counter cards */.card {  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */  padding: 0px;  text-align: center;  background-color: #f1f1f1;}/* Responsive columns - one column layout (vertical) on small screens */@media screen and (max-width: 600px) {  .column {    width: 100%;    display: block;    margin-bottom: 20px;  }}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onLoad="StartModule('<?php echo $ModuleId; ?>'); RequestsDashBoard();" onmousemove="javascript:checkLoadedObjects(event);" onclick="javascript:dropLoadedObject(event);">
<div class="wrapper">
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="../admindashboard/dist/img/Logo.png" alt="SoriLakeside" height="120" width="240">
      </div>
            <!-- START NAV BAR -->
            <nav class="main-header navbar navbar-expand navbar-info navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
              Menu
            </a>
          </li>
         <li class="nav-item">
            <a href="#" class="nav-link" onclick="BackToHome()" role="button">
              <i class="fa fa-home"></i>
              Home
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
           <li class="nav-item">
        <a class="nav-link" href="#" onclick="ShowResetPasswordForm_2()">
          <i class="far fa-user-circle">
          </i>
          <?php
          $sql2=mysqli_query($conn, "SELECT username  FROM UsersTable WHERE UserId='$UserId'")or die(mysqli_error($conn));
      while ($rec2=mysqli_fetch_array($sql2)) {
          $user=$rec2['username'];
      }
          echo "Hi! ".$user;
           ?>
         </a>
      </li>
      
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search" ></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
          
          
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item"> 
            <a href="#" class="nav-link" onclick="Logout()" role="button">
            <i class="fa fa-window-close"></i>
          </a>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../admindashboard/index3.html" class="brand-link">
          <img src="../admindashboard/dist/img/Logo.png" alt="Lwala Logo" class="brand-image img-circle elevation-3">
          <span class="brand-text font-weight-light">CHA Approvals</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
      
          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" align="left">
              <!-- <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu" align="center"> -->
              <?php
              //use group id to get user permissions
              $Sql = "SELECT * from  SystemModules ORDER BY DispOrder ASC";
              //echo $Sql;
              $getModules = mysqli_query($conn, $Sql) or die("Failed to get the system modules list. " . mysqli_error($conn));
              while ($rows = mysqli_fetch_array($getModules)) {
                  $module_id = $rows['ModuleId'];
                  $module_name = $rows['ModuleName'];
                  $image = $rows['linkPicture'];
                  $folderName = $rows2['FolderName'];
                  $CategoryID = $rows['CategoryID'];
                  //  $value = $module_id . "-" . $groupId;?>
    <li class="nav-item">
   <a href="#" class="nav-link" onClick="LoadCategoryModuleQuickLinks(<?php echo $CategoryID; ?>)">
     <img src="../Main/Layout/images/<?php echo $image; ?>"  width="40" height="40" />
     <p><font color="white"><?php echo $module_name; ?></font></p>
    </a>
</li>
              <?php
              }
              ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- END SIDE BAR -->
      <div class="content-wrapper">
<table  align="center" style="background-color:#FFFFFF; height: 100%;width:100%;">
     <tr><td> <div style="height: auto;width:100%" id="topmenu" align="center"></div></td></tr>
<!--       <div style="height: auto;" id="search_bar">Search.Your search appears here</div>
 -->   
    <tr>
        <td colspan="3" valign="top">
            <div style="height: auto; border-radius: 8px;" id="links_div">
            </div>
        </td>
    </tr>
                <tr>
  <td colspan="3">
  <table border="1" width="100%">
  <tr>
  <td width="82%" valign="top">
      <div style="height: auto; width:auto; border-radius: 8px;" id="main_window"></div>
  </td>
  </tr>
  </table>
    </td></tr>
</table>
<input type="hidden" name="SearchHeight" id="SearchHeight" value="190" />
<input type="hidden" name="Search" id="SearchHeight" value="190" />
<input type="hidden" name="UserId" id="UserId" value="<?php echo $UserId; ?>" />
<input type="hidden" name="ModuleNumber" id="ModuleNumber" value="<?php echo $ModuleId; ?>" />
<div id="QuitWindowDiv" ondblclick="javascript:getReadyToMove('QuitWindowDiv', event);" onmouseup="javascript:dropLoadedObject(event)" onclick="javascript:dropLoadedObject(event);"></div>
<div id="alert_div" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)" ></div>
<div id="popup_div" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"> </div>
<div id="popup_div_1"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"></div>
<div id="popup_div_2"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"> </div>
<div id="popup_div_x"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)">  </div>
<div id="Submenu_div"></div>
<div id="alert_overlay"></div>
<div id="loading_div" style="width:400px; display:none; position:absolute; top:300px; left:400px;">
  <div align="center">
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" style="border:dotted 1px #5D5D5D;">
      <tr><td>&nbsp;</td></tr><tr><td align="center"><img src="../Main/Layout/images/loading.gif" width="50" height="50"></td></tr><tr><td align="center" >Loading .... please wait.</td></tr><tr><td>&nbsp;</td></tr>
    </table>
  </div>
</div>
    </table>
            <!-- jQuery -->
        <!-- <script src="../admindashboard/plugins/jquery/jquery.min.js"></script> -->
        <!-- jQuery UI 1.11.4 -->
        <script src="../admindashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="../admindashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="../admindashboard/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="../admindashboard/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="../admindashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="../admindashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="../admindashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="../admindashboard/plugins/moment/moment.min.js"></script>
        <script src="../admindashboard/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="../admindashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="../admindashboard/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="../admindashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="../admindashboard/dist/js/adminlte.js"></script>
        <script src="../admindashboard/dist/js/pages/dashboard.js"></script>
        <!-- <footer align="center" class="main-header">
			<strong>Copyright &copy; 2021 <a href="#">i-OGMSS</a>.</strong> All rights
			reserved.
		</footer> -->
    </div>
</div>
<footer valign="bottom">
          <strong>Copyright &copy; 2018-2035 <a href="#">John Katieno: Support - Call +254 708 180 649</a>.</strong>
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 2.30.0
          </div>
        </footer>
                              </body>
</html>
