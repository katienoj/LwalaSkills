<?php
session_start();
include  "Main/Config/db_conn.php";
require_once 'Stock/includes/StockFunctions.php';
$dte=date('Y-m-d');
$this_year = date("Y");
$this_month = date("m");
$display_doctors_div = "none";
$UserId = 0;
if (isset($_SESSION["cArEFUT2010soFT"])) {
    $UserId=$_SESSION['UserId'];
    $EmployeeId=$_SESSION['EmployeeId']."<br>";
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
        header("Location:index.php");
    }/**/
} else {
    if (get_userdepartment($UserId)==0 || get_userdepartment($UserId)=='0') {
        //$display_doctors_div ='block';
    }
    header("Location:index.php");
}
//echo $UserId;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" sizes="32x32" type="image/x-icon" href="Main/Layout/images/Logo.png"/>
<title><?php
$sqlx=mysqli_query($conn, "SELECT HospitalName FROM SetHospital")or die(mysqli_error($conn));
      while ($recx=mysqli_fetch_array($sqlx)) {
          $HospitalName=$recx['HospitalName'];
      }
     echo $HospitalName;
     ?></title>
<link rel="stylesheet" href="Main/Layout/styles/divs.css" />
<link rel="stylesheet" href="Main/Layout/styles/interface.css" />
<link rel="stylesheet" href="Main/Layout/styles/dashboardmenu.css" />
<script language="javascript" type="text/javascript" src="Main/Layout/js_scripts/general.js"></script>
<script language="javascript" type="text/javascript" src="Main/Layout/js_scripts/xmlhttprequest.js"></script>
<script language="javascript" type="text/javascript" src="Wards/Layout/js_scripts/MoveDiv.js"></script>
<script language="javascript" type="text/javascript" src="Authentication/Layout/JsScripts/Auth.js"></script>
    <link rel="stylesheet" href="DataTables/Bootstrap-4-4.1.1/css/bootstrap.min.css">
    <script src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script src="DataTables/Bootstrap-4-4.1.1/js/bootstrap.min.js"></script> 
        <link href="DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
         <link href="DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css" />
        <script language="javascript" type="text/javascript" src="DataTables/Buttons-1.6.1/js/dataTables.buttons.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/JSZip-2.5.0/jszip.min.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/Buttons-1.6.1/js/buttons.html5.js"></script>
        <script language="javascript" type="text/javascript" src="DataTables/Buttons-1.6.1/js/buttons.print.js"></script>
        <!--<script language="javascript" type="text/javascript" src="../DataTable/sum().js"></script>
        End--> 
        <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="admindashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="ionicons.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="admindashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="admindashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="admindashboard/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admindashboard/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="admindashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="admindashboard/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="admindashboard/plugins/summernote/summernote-bs4.min.css">
    <script>
   $(document).ready(
            function () {
                $('#dashboard').DataTable(
                    {
                        dom: 'Bfrtip',
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                        ],
                        buttons: [
                            {
                                extend: 'excel',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'copy',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            },
                            {
                                extend: 'pageLength',
                                exportOptions: {
                                    columns: ':gt(0)'
                                }
                            }
                        ]
                    });
            });
    </script>
        
<script>
 		 $(document).ready(
        function() {
         $('#staffservices1').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: '<"toolbar">frtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },


    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

],
paging: true,
sPageButtonStaticDisabled : "paginate_button_disabled",
searching: false,
destroy: true

});
$("div.toolbar").html('<b>GENERAL STATISTICS</b>');
     
        });
</script>

<script>
 		 $(document).ready(
        function() {
         $('#staffservices2').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: '<"toolbar2">frtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },


    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

],
paging: true,
searching: false,
destroy: true

});
$("div.toolbar2").html('<b>INVESTIGATIONS STATISTICS</b>');

     
        });
</script>

<script>
 		 $(document).ready(
        function() {
         $('#staffservices3').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: '<"toolbar3">frtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },


    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

],
paging: true,
searching: false,
destroy: true

});
$("div.toolbar3").html('<b>OTHER STATISTICS</b>');

        });
</script>

<script>
 		 $(document).ready(
        function() {
         $('#staffservices4').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: '<"toolbar4">frtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },


    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

],
paging: true,
searching: false,
destroy: true

});
$("div.toolbar4").html('<b>TREATMENT ROOM QUEUES</b>');

        });
</script>
<style type="text/css">
/* body {	
  background-image: url(Main/Layout/images/bg.jpg);
	background-repeat: repeat;	
  background-size:	100%;
  } */
  #alert_div_main{z-index:auto; background:#FFFFFF;}
	* {  box-sizing: border-box;}body {  font-family: Arial, Helvetica, sans-serif;}/* Float four columns side by side */.column {  float: left;  width: 25%;  padding: 0 10px;}/* Remove extra left and right margins, due to padding in columns */.row {margin: 0 -5px;}/* Clear floats after the columns */.row:after {  content: "";  display: table;  clear: both;}/* Style the counter cards */.card {  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */  padding: 0px;  text-align: center;  background-color: #f1f1f1;}/* Responsive columns - one column layout (vertical) on small screens */@media screen and (max-width: 600px) {  .column {    width: 100%;    display: block;    margin-bottom: 20px;  }}
	</style>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'No of Complaints'],
          <?php
            $sql=mysqli_query($conn, "SELECT LabTest.TestName, COUNT(TestId) as labTests FROM RequestedLabTests
JOIN LabTest ON LabTest.Id = RequestedLabTests.TestId GROUP BY TestId ORDER BY labTests DESC  limit 10")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                echo "['".$rec['TestName']."', ".$rec['labTests']."],";
            }
           ?>
        ]);
        var options = {
          title: 'TOP 10 REQUESTED LAB TESTS'
        };
        var chart = new google.visualization.PieChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Diagnosis Name (ICD 10)', 'Total Reported'],
          <?php
            $sql=mysqli_query($conn, "SELECT care_icd10_en.description, COUNT(icd_10.Id) as total FROM icd_10
JOIN care_icd10_en ON icd_10.Diagnosis_Code = care_icd10_en.diagnosis_code
WHERE YEAR(icd_10.Date) = '$this_year' AND MONTH( icd_10.Date ) = '$this_month'
 GROUP BY icd_10.Diagnosis_Code ORDER BY total  DESC LIMIT 20")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                echo "['".$rec['description']."', ".$rec['total']."],";
            }
           ?>
        ]);
        var options = {
          title: 'DIAGNOSIS'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('diagnosis'));
        chart.draw(data, options);
      }
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onLoad="ShowAllOnDashBoard();CheckPasswordChange('<?php echo $UserId;?>')" >
<div class="wrapper">
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="admindashboard/dist/img/Logo.png" alt="LwalaHMIS" height="120" width="240">
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
            <a href="#" class="nav-link" onclick="BackToHome2()" role="button">
              <i class="fa fa-home"></i>Home
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-link">
            <span class="badge badge-primary"></span>
          </i>
          Dashboards
        </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/AccountsDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Accounts Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/ClinicsDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Clinics Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/HrDashBoard.php"><input type="button" class="btn btn-default btn-block" value="HR Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/InpatientDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Inpatient Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/InvestigationsDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Lab Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/MainDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Main Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/PharmacyDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Pharmacy Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/RegistryDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Registry Dashboard"></a>
          <a class="dropdown-item" href="http://<?php echo $_SERVER['SERVER_ADDR'];?>/StoresDashBoard.php"><input type="button" class="btn btn-default btn-block" value="Stores Dashboard"></a>
        </div>
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
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="admindashboard/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="admindashboard/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Client Test
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="admindashboard/dist/img/unisex.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Client Test2
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-primary navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item"> 
            <a href="#" class="nav-link" onclick="DashBoardLogout()" role="button">
            <i class="fa fa-window-close"></i>
          </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
            <!-- END NAV BAR -->
     <!-- START SIDE BAR -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="admindashboard/index3.html" class="brand-link">
          <img src="admindashboard/dist/img/Logo.png" alt="Lwala Logo" class="brand-image img-circle elevation-3">
          <span class="brand-text font-weight-light">LwalaHMIS</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <?php
          // $getUserDash = mysqli_query($conn, "SELECT * FROM UsersTable WHERE UserId ='$UserId'");
          //                               $resUserDash = mysqli_fetch_array($getUserDash);
          //                               if ($groupDash == 0) {
          //                                   $nameCompDash = $resUserDash['username'];
          //                               } else {
          //                                   $nameDash = $resUserDash['username'];
          //                               }
          ?>
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
          <!-- Sidebar Menu -->
          <!-- <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu" align="center">
          </nav> -->
          <!-- /.sidebar-menu -->
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
	<tr bordercolor="#b4bcca">
	<td colspan="3">
	<div class="row">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-heartbeat"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Patient Visits (Today)</span>
                <span class="info-box-number">
                <?php
  $today =  date('Y-m-d');
$sql=mysqli_query($conn, "SELECT COUNT(Id) as todayvisits FROM PatientEpisodes WHERE DATE(DateStarted) = '$today'")or die(mysqli_error($conn));
      while ($rec=mysqli_fetch_array($sql)) {
          $todayvisits=$rec['todayvisits'];
      }
      echo number_format($todayvisits);
      ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Registered Patients</span>
                <span class="info-box-number">
                  <?php
                   $sql=mysqli_query($conn, "SELECT COUNT(Id) as Patients FROM Patients")or die(mysqli_error($conn));
                   while ($rec=mysqli_fetch_array($sql)) {
                       $Patients=$rec['Patients'];
                   }
                   echo number_format($Patients);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-md"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Patients(Insurance)</span>
                <span class="info-box-number">
                  <?php
                         $sql=mysqli_query($conn, "SELECT COUNT(Id) as PatientsInsurance FROM Patients WHERE PaymentMode!='Cash'")or die(mysqli_error($conn));
                         while ($rec=mysqli_fetch_array($sql)) {
                             $PatientsInsurance=$rec['PatientsInsurance'];
                         }
                         echo number_format($PatientsInsurance);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-stethoscope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Patients (Cash)</span>
                <span class="info-box-number"><?php
                        $sql=mysqli_query($conn, "SELECT COUNT(Id) as PatientsCash FROM Patients WHERE PaymentMode='Cash'")or die(mysqli_error($conn));
                        while ($rec=mysqli_fetch_array($sql)) {
                            $PatientsCash=$rec['PatientsCash'];
                        }
                        echo number_format($PatientsCash);
                ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-7">
                    <p class="text-center">
                      <strong>TOP 20 DIAGNOSIS (<?php echo "MONTH: ".$this_month." / YEAR: ".$this_year;  ?>)</strong>
                    </p>
                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="diagnosis" height="220" style="height: 220px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-5" height="220" style="height: 220px;">
                    <p class="text-center">
                      <strong>ACTIVITY HIGHLIGHTS (<?php echo "MONTH: ".$this_month." / YEAR: ".$this_year;  ?>)</strong>
                    </p>
                    <div class="progress-group" align="left">
                      Items & Services Pending Receipting
                      <span class="float-right">
                      <?php
                        $sql_=mysqli_query($conn, "SELECT COUNT(Id) as totalservices FROM PatientChargeSheet WHERE YEAR(PatientChargeSheet.Date) = '$this_year'
                        AND MONTH( PatientChargeSheet.Date ) = '$this_month'")or die(mysqli_error($conn));
                        while ($rec_=mysqli_fetch_array($sql_)) {
                            $totalservices=$rec_['totalservices'];
                        }
                         $sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingrecipt FROM PatientChargeSheet WHERE PaidStatus=0
                         AND YEAR(PatientChargeSheet.Date) = '$this_year'
                         AND MONTH( PatientChargeSheet.Date ) = '$this_month'")or die(mysqli_error($conn));
                         while ($rec=mysqli_fetch_array($sql)) {
                             $pendingrecipt=$rec['pendingrecipt'];
                         }
                         $receipting_width = ($pendingrecipt/$totalservices)*100;
                  ?>  
                      <b>
                      <?php  if (is_nan($receipting_width)) {
                      echo number_format("0", 2)."% | ".$pendingrecipt."/".$totalservices;
                  } else {
                          echo number_format($receipting_width, 2)."% | ".$pendingrecipt."/".$totalservices;
                      }
                       ?>
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-primary" style="width: <?php echo $receipting_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      Lab Results Pending
                      <span class="float-right">
                      <?php
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as labtestrequest FROM RequestedLabTests WHERE YEAR(RequestedLabTests.DateTime) = '$this_year'
                      AND MONTH(RequestedLabTests.DateTime) = '$this_month'")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $labtestrequest=$rec['labtestrequest'];
                      }
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingtests FROM RequestedLabTests WHERE
                      YEAR(RequestedLabTests.DateTime) = '$this_year'AND MONTH(RequestedLabTests.DateTime) = '$this_month' AND
                       ConductedStatus IS NULL")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $pendingtests=$rec['pendingtests'];
                      }
                      $lab_width = ($pendingtests/$labtestrequest)*100;
                      ?>
                      <b>
                      <?php  if (is_nan($lab_width)) {
                          echo number_format("0", 2)."% | ". $pendingtests."/".$labtestrequest;
                      } else {
                          echo number_format($lab_width, 2)."% | ". $pendingtests."/".$labtestrequest;
                      }
                       ?>
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-danger" style="width: <?php echo $lab_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      <span class="progress-text">Imaging Results Pending</span>
                      <span class="float-right">
                      <?php
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as imagingtestrequest FROM RequestedImagingTests WHERE YEAR(RequestedImagingTests.DateTimeConducted) = '$this_year'
                      AND MONTH(RequestedImagingTests.DateTimeConducted) = '$this_month'")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $imagingtestrequest=$rec['imagingtestrequest'];
                      }
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingimaging FROM RequestedImagingTests WHERE
                      YEAR(RequestedImagingTests.DateTimeConducted) = '$this_year'AND MONTH(RequestedImagingTests.DateTimeConducted) = '$this_month' AND
                       ConductedStatus IS NULL")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $pendingimaging=$rec['pendingimaging'];
                      }
                      $imaging_width = ($pendingimaging/$imagingtestrequest)*100;
                      ?>
                      <b>
                      <?php  if (is_nan($imaging_width)) {
                          echo number_format("0", 2)."% | ". $pendingimaging."/". $imagingtestrequest;
                      } else {
                          echo number_format($imaging_width, 2)."% | ". $pendingimaging."/". $imagingtestrequest;
                      }
                       ?>
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-success" style="width: <?php echo $imaging_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      Pending Procedures
                      <span class="float-right">
                      <?php
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as procedurerequest FROM PatientProcedureRequest WHERE YEAR(PatientProcedureRequest.Date) = '$this_year'
                      AND MONTH(PatientProcedureRequest.Date) = '$this_month'")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $procedurerequest=$rec['procedurerequest'];
                      }
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingprocedure FROM PatientProcedureRequest WHERE
                      YEAR(PatientProcedureRequest.Date) = '$this_year'AND MONTH(PatientProcedureRequest.Date) = '$this_month' AND
                       Status=0")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $pendingprocedure=$rec['pendingprocedure'];
                      }
                      $procedure_width = ($pendingprocedure/$procedurerequest)*100;
                      ?>  
                      <b><?php  if (is_nan($procedure_width)) {
                          echo number_format("0", 2)."% | ". $pendingprocedure."/".$procedurerequest;
                      } else {
                          echo number_format($procedure_width, 2)."% | ". $pendingprocedure."/".$procedurerequest;
                      }
                       ?></b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-warning" style="width: <?php echo $procedure_width; ?>%"></div>
                      </div>
                    </div>
                    <div class="progress-group" align="left">
                      Awaiting Admission
                      <span class="float-right">
                      <?php
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as admissionrequest FROM  PatientAdmission WHERE YEAR( PatientAdmission.Date) = '$this_year'
                      AND MONTH( PatientAdmission.Date) = '$this_month'")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $admissionrequest=$rec['admissionrequest'];
                      }
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingadmission FROM  PatientAdmission WHERE
                      YEAR( PatientAdmission.Date) = '$this_year'AND MONTH( PatientAdmission.Date) = '$this_month' AND
                       DischargeStatus IS NULL")or die(mysqli_error($conn));
                      while ($rec=mysqli_fetch_array($sql)) {
                          $pendingadmission=$rec['pendingadmission'];
                      }
                      $admission_width = ($pendingadmission/$admissionrequest)*100;
                      ?>    
                      <b><?php  if (is_nan($admission_width)) {
                          echo number_format("0", 2)."% | ". $pendingadmission."/". $admissionrequest;
                      } else {
                          echo number_format($admission_width, 2)."% | ". $pendingadmission."/". $admissionrequest;
                      }
                       ?></b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-purple" style="width: <?php echo $admission_width ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">
                      <?php
                   $sql=mysqli_query($conn, "SELECT SUM(Amount) as Revenue FROM PatientChargeSheet WHERE YEAR(PatientChargeSheet.Date) = '$this_year'
                   AND MONTH( PatientChargeSheet.Date ) = '$this_month'")or die(mysqli_error($conn));
                   while ($rec=mysqli_fetch_array($sql)) {
                       $Revenue=$rec['Revenue'];
                   }
                   echo "Ksh.". number_format($Revenue, 2);
                  ?>  
                      </h5>
                      <span class="description-text">TOTAL SERVICE & ITEM COSTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">
                      <?php
                   $sql=mysqli_query($conn, "SELECT SUM(Amount) as RevenueInsurance FROM PatientChargeSheet WHERE YEAR(PatientChargeSheet.Date) = '$this_year'
                   AND MONTH( PatientChargeSheet.Date ) = '$this_month' AND BillType!='Cash'")or die(mysqli_error($conn));
                   while ($rec=mysqli_fetch_array($sql)) {
                       $RevenueInsurance=$rec['RevenueInsurance'];
                   }
                   echo "Ksh.". number_format($RevenueInsurance, 2);
                  ?>  
                      </h5>
                      <span class="description-text">INSURANCE CLIENT COSTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">    <?php
                   $sql=mysqli_query($conn, "SELECT SUM(Amount) as RevenueCash FROM PatientChargeSheet WHERE YEAR(PatientChargeSheet.Date) = '$this_year'
                   AND MONTH( PatientChargeSheet.Date ) = '$this_month' AND BillType='Cash'")or die(mysqli_error($conn));
                   while ($rec=mysqli_fetch_array($sql)) {
                       $RevenueCash=$rec['RevenueCash'];
                   }
                   echo "Ksh.". number_format($RevenueCash, 2);
                  ?></h5>
                      <span class="description-text">CASH CLIENTS COST</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                      <h5 class="description-header"><?php
                      $sql=mysqli_query($conn, "SELECT COUNT(Id) as totalvisits FROM PatientEpisodes")or die(mysqli_error($conn));
                     while ($rec=mysqli_fetch_array($sql)) {
                         $totalvisits=$rec['totalvisits'];
                     }
                     echo number_format($totalvisits);
                      ?></h5>
                      <span class="description-text">TOTAL CLIENT VISITS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
   
  <div class="column" >
<div class="card" style="border: 0px solid #50544F; background-color: #e3a92d; align-content: left; text-align: left;vertical-align: text-top;">
 

  <?php
      $sql=mysqli_query($conn, "SELECT COUNT(Id) as totalvisits FROM PatientEpisodes")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $totalvisits=$rec['totalvisits'];
      }
      
    $sql=mysqli_query($conn, "SELECT COUNT(Id) as Patients FROM Patients")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $Patients=$rec['Patients'];
      }

        $sql=mysqli_query($conn, "SELECT COUNT(Id) as PatientsInsurance FROM Patients WHERE PaymentMode='Insurance'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $PatientsInsurance=$rec['PatientsInsurance'];
      }
        $sql=mysqli_query($conn, "SELECT COUNT(Id) as PatientsCash FROM Patients WHERE PaymentMode='Cash'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $PatientsCash=$rec['PatientsCash'];
      }       
      
    $sql=mysqli_query($conn, "SELECT COUNT(Id) as TriageDetails FROM TriageDetails")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $TriageDetails=$rec['TriageDetails'];
      } 
      
   
  ?>

  <table width="100%"   class="table-striped" id="staffservices1">
 
<thead>
<th>STAT</th>
<th>NO.</th>
</thead>
<tbody>
 <tr>
    <td>Patients Registered</td>
    <td halign="right"><?php echo  "<font color = red size = 3><b>".$Patients."</font>"; ?></td>
  </tr>
  <tr>
     <td>Insurance Patients</td>
     <td ><div halign="right"><?php echo "<font color = red size = 3><b>".$PatientsInsurance."</font>"; ?></div></td>      
  </tr>  
  <tr>
     <td>Cash-Pay Patients</td>
     <td halign="right"><?php echo "<font color = red size = 3><b>".$PatientsCash."</font>"; ?></td>
  </tr>
  <tr>
    <td>Total Visits</td>
    <td halign="right"><?php echo "<font color = red size = 3><b>".$totalvisits."</font>"; ?></td>  </tr>
    <tr>
    <td>Triage Details Captured</td>
    <td halign="right"><?php echo "<font color = red size = 3><b>".$TriageDetails."</font>"; ?></td>  </tr>
 </tbody>
 
</table>


  </b></a> </div></div>
  <div class="column"> 
  <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #2de348; align-content: left; text-align: left;vertical-align: text-top;"><?php 
  $today =  date('Y-m-d'); 

$sql=mysqli_query($conn, "SELECT COUNT(Id) as todayvisits FROM PatientEpisodes WHERE DATE(DateStarted) = '$today'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $todayvisits=$rec['todayvisits'];
      }
      
      // echo "<font color = red size = 4>".$todayvisits."</font> Patient Visits Today <br>";
      
        $today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as labtestrequest FROM LabTestRequest WHERE DateReferred = '$today'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $labtestrequest=$rec['labtestrequest'];
      }
      
      // echo "<font color = red size = 4>".$labtestrequest."</font> Patients Sent to Lab.<br>";
      
            $today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingtests FROM RequestedLabTests WHERE ConductedStatus IS NULL")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $pendingtests=$rec['pendingtests'];
      }
      
      // echo "<font color = red size = 4>".$pendingtests."</font> Lab Results Pending <br>";
      
      $today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as imagingtestrequest FROM ImagingTestRequest WHERE RefDate = '$today'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $imagingtestrequest=$rec['imagingtestrequest'];
      }
      
      // echo "<font color = red size = 2>".$imagingtestrequest."</font> Radiology Requests Today.<br>";
      
$today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingimaging FROM RequestedImagingTests WHERE ConductedStatus IS NULL")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $pendingimaging=$rec['pendingimaging'];
      }
      
      // echo "<font color = red size = 1>".$pendingimaging."</font> Radiology Results Pending <br>";



  ?>
<table width="100%"  class="table-striped" id="staffservices2" >
 <thead>
 <th>STAT</th>
 <th>NO.</th>
 </thead>

 <tbody>

   <tr>
    <td>Patient Visits Today</td>
    <td halign="right"><?php echo  "<font color = red size = 3><b>".$todayvisits."</font>"; ?></td>
  </tr>
  <tr>
     <td>Patients Sent to Lab</td>
     <td ><div halign="right"><?php echo "<font color = red size = 3><b>".$labtestrequest."</font>"; ?></div></td>      
  </tr>  
  <tr>
     <td>Lab Results Pending</td>
     <td halign="right"><?php echo "<font color = red size = 3><b>".$pendingtests."</font>"; ?></td>
  </tr>
  <tr>
    <td>Radiology Requests Today</td>
    <td halign="right"><?php echo "<font color = red size = 3><b>".$imagingtestrequest."</font>"; ?></td>  </tr>
    <tr>
    <td>Radiology Results Pending</td>
    <td halign="right"><?php 
echo "<font color = red size = 3><b>".$pendingimaging."</font>"; ?></td>  </tr>
 
</tbody>
</table>

  
  </b></a></div>  </div>

   <div class="column"> 
  <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #2dafe3; align-content: left; text-align: left;vertical-align: text-top;"><?php 
 $today =  date('Y-m-d'); 

$sql=mysqli_query($conn, "SELECT COUNT(Id) as prescribed FROM PatientChargeSheet where Type='Item'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $prescribed=$rec['prescribed'];
      }
      
      
        $today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as paid_prescribed FROM PatientChargeSheet where Type = 'Item' AND PaidStatus=1")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $paid_prescribed=$rec['paid_prescribed'];
      }
      
      
  $sql=mysqli_query($conn, "SELECT COUNT(Id) as presc_dispensed FROM PharmacyPrescriptionQueue WHERE DispenseStatus IS NOT NULL")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $presc_dispensed=$rec['presc_dispensed'];
      }
      
      // echo "<font color = red size = 4>".$pendingtests."</font> Lab Results Pending <br>";
      
      $today =  date('Y-m-d'); 
    
$sql=mysqli_query($conn, "SELECT COUNT(Id) as total_patient_presc FROM PatientPrescription")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $total_patient_presc=$rec['total_patient_presc'];
      }


$sql=mysqli_query($conn, "SELECT COUNT(Id) as total_patient_presc_piad FROM PatientPrescription WHERE PaymentStatus>0")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $total_patient_presc_piad=$rec['total_patient_presc_piad'];
      }
      
$sql=mysqli_query($conn, "SELECT COUNT(Id) as total_patient_presc_issued FROM PatientPrescription WHERE IssueStatus>0")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $total_patient_presc_issued=$rec['total_patient_presc_issued'];
      }

  ?>
<table width="100%" class="table-striped" id="staffservices3">
 <thead>
 <th>STAT</th>
 <th>NO.</th>
 </thead>
 <tbody>

 
  <tr>
    <td>Presc. Issuance Rate</td>
    <td halign="right"><?php 
    
    $issuance_rate = ($total_patient_presc_issued/$total_patient_presc)*100;
    
    
    echo "<font color = red size = 3><b>".number_format($issuance_rate,2)."%</font>";
    
     ?></td>
  </tr>
  <tr>
     <td>Presc. Payment Rate</td>
     <td ><div halign="right"><?php 
     
        
     $payment_rate = ($total_patient_presc_piad/$total_patient_presc)*100;
    
     echo "<font color = red size = 3><b>".number_format($payment_rate,2)."%</font>";  
     
      ?></div></td>      
  </tr>  
  <tr>
     <td>Lab Testing Rate</td>
     <td halign="right"><?php 
     $sql=mysqli_query($conn, "SELECT COUNT(Id) as labtestrequest FROM RequestedLabTests")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $labtestrequest=$rec['labtestrequest']-6;
      }

$sql=mysqli_query($conn, "SELECT COUNT(Id) as donetests FROM RequestedLabTests WHERE ConductedStatus=1")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $donetests=$rec['donetests']-6;
      }

$sql=mysqli_query($conn, "SELECT COUNT(Id) as pendingtests FROM RequestedLabTests WHERE ConductedStatus IS NULL")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $pendingtests=$rec['pendingtests'];
      }
      
$testingrate = ($donetests/$labtestrequest)*100;
    
     echo "<font color = red size = 3><b>".number_format($testingrate,2)."%</font>";
     

     
      ?></td>
  </tr>
  <tr>
    <td>Lab Payment Rate</td>
    <td halign="right"><?php 
    
    
    $sql=mysqli_query($conn, "SELECT COUNT(Id) as lab_services FROM PatientChargeSheet WHERE Type ='Lab' AND BillType='Cash'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $lab_services=$rec['lab_services'];
      }

    $sql=mysqli_query($conn, "SELECT COUNT(Id) as paid_lab_services FROM PatientChargeSheet WHERE Type ='Lab' AND PaidStatus=1 AND BillType='Cash'")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
      {
        $paid_lab_services=$rec['paid_lab_services'];
      }

      $lab_receipting_rate=($paid_lab_services/$lab_services)*100;

     echo "<font color = red size = 3><b>".number_format($lab_receipting_rate,2)."%</font>";
    
     ?></td>  </tr>
     <tr>
<td>TBD</td>
<td halign="right">  <?php echo "<font color = red size = 3><b>0%</font>"; ?>
</td>

     </tr>

 </tbody>
   
</table>
 
  </b></a></div>  </div>
    

  <?php   $today =  date('Y-m-d'); 
?>
  <div class="column"> <div class="card" style="border: 0px solid #50544F; background-color: #e3482d; align-content: left; text-align: left;vertical-align: text-top;">
     
      <table width="100%"   class="table-striped" id="staffservices4">
 
<thead>
<th>ROOM</th>
<th>QUEUE</th>
</thead>
 <tbody>
 
<?php 
            
            
            $sql=mysqli_query($conn, "SELECT RoomId, COUNT(Id) as RoomQueue FROM PatientEpisodes WHERE DATE(DateStarted) = '$today' AND DateEnded IS NULL GROUP BY RoomId")or die(mysqli_error($conn));
                  while($rec=mysqli_fetch_array($sql))
                  {
                    $RoomQueue=$rec['RoomQueue'];
                    $RoomId=$rec['RoomId'];

            $sqlroom=mysqli_query($conn, "SELECT RoomName FROM WaitingRoom WHERE  Id= '$RoomId'")or die(mysqli_error($conn));
                  while($recroom=mysqli_fetch_array($sqlroom))
                  {
                    $RoomName=$recroom['RoomName'];
                            
                  }
                  echo "<tr>
                  <td> $RoomName</td>
                  <td> $RoomQueue</td>
                  </tr>";

                  }
                            
                  
                  ?>
  
 </tbody>
</table>

</b></a></div></div>

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
                </div>
                </td>
                </tr>         
	
    <tr bordercolor="#CAC9B4">
      <td colspan="2"><div id="alert_div"></div><div id="alert_overlay"><div id="alert_div_main"></div></div></td>
    </tr>
</table>  
<div id="loading_div" style="width:400px; display:none; position:absolute; top:300px; left:400px;">
  <div align="center">
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style="border:dotted 1px #5D5D5D;">
      <tr><td>&nbsp;</td></tr><tr><td align="center"><img src="Main/Layout/images/loading.gif" width="50" height="50"></td></tr><tr><td align="center" >Loading .... please wait.</td></tr><tr><td>&nbsp;</td></tr>
    </table>
  </div>
</div>
<div id="doctors_departments" style="display:none" ondblclick="javascript:getReadyToMove('popup_div', event);" onmouseup="javascript:dropLoadedObject(event)" onclick="javascript:dropLoadedObject(event);"><?php //echo get_waitingroom();?></div>
<?php
function get_userdepartment($userid)
  {
      global $conn;
      $sql=mysqli_query($conn, "SELECT * FROM UsersTable WHERE UserId='$userid'") or die(mysqli_error($conn));
      $rec=mysqli_fetch_assoc($sql);
      $employeeid=$rec['EmployeeId'];
      $sql=mysqli_query($conn, "SELECT * FROM EmployeeEmploymentDetailsTable WHERE EmployeeId='$employeeid'") or die(mysqli_error($conn));
      $rec=mysqli_fetch_assoc($sql);
      return $jobtitleid=$rec['JobTitleId'];
      $sql=mysqli_query($conn, "SELECT * FROM JobTitleName WHERE EmployeeId='$employeeid'") or die(mysqli_error($conn));
      $rec=mysqli_fetch_assoc($sql);
      $jobtitlename=$rec['JobTitleName'];
  }
?>
<div id="window_ResetPasswordDiv_Main" style="position:absolute; z-index:10; left:350px; top:160px;background-color:#dde3eb; width:500px; height:auto; border:1px solid #464f5a; display:none; z-index:100000; position:absolute;">
  <div style="padding-bottom:0px; width:auto; background-color:#718191; border-bottom:1px solid #464f5a; height:20px;" onMouseDown="beginDrag(this.parentNode, event);">
	<table width="100%">
	 <tr>
		<td width="60%" style="color:#EEEEEE; text-transform:uppercase; font-weight:bold;" valign="top">
			Reset User Password
		</td>
		<td align="right" valign="top">
			<img src="Main/Layout/images/close.gif" onclick="HidePopUp_Auth('div_ResetPasswordDiv_Main','window_ResetPasswordDiv_Main')"/>
		</td>
	</tr>
	</table>		
  </div>
  <div id="div_ResetPasswordDiv_Main" style="width:auto; background-color:#FFFFFF;"></div>
</div>
<div id="window_ViewLwalaMesage_Main" style="position:absolute; z-index:10; left:350px; top:160px;background-color:#dde3eb; width:500px; height:auto; border:1px solid #464f5a; display:none; z-index:100000; position:absolute;">
  <div style="padding-bottom:0px; width:auto; background-color:#718191; border-bottom:1px solid #464f5a; height:20px;" onMouseDown="beginDrag(this.parentNode, event);">
	<table width="100%">
	 <tr>
		<td width="60%" style="color:#EEEEEE; text-transform:uppercase; font-weight:bold;" valign="top">
			Chanf Community & Family Healing Services Limited Message
		</td>
		<td align="right" valign="top">
		<img src="Main/Layout/images/close.gif" onclick="HidePopUp_Auth('div_ViewLwalaMesage_Main','window_ViewLwalaMesage_Main')"/>
		</td>
	</tr>
	</table>		
  </div>
<div id="div_ViewLwalaMesage_Main" style="width:auto; background-color:#FFFFFF;"></div>   
</div>
<div id="window_ViewChangePasswordConfirmation_Main" style="position:absolute; z-index:10; left:350px; top:160px;background-color:#dde3eb; width:500px; height:auto; border:1px solid #464f5a; display:none; z-index:100000; position:absolute;">
  <div style="padding-bottom:0px; width:auto; background-color:#718191; border-bottom:1px solid #464f5a; height:20px;" onMouseDown="beginDrag(this.parentNode, event);">
	<table width="100%">
	 <tr>
		<td width="60%" style="color:#EEEEEE; text-transform:uppercase; font-weight:bold;" valign="top">
			Chanf Community & Family Healing Services Limited Message
		</td>
		<td align="right" valign="top">
		<img src="Main/Layout/images/close.gif" onclick="HidePopUp_Auth('div_ViewChangePasswordConfirmation_Main','window_ViewChangePasswordConfirmation_Main')"/>
		</td>
	</tr>
	</table>		
  </div>
<div id="div_ViewChangePasswordConfirmation_Main" style="width:auto; background-color:#FFFFFF;"></div>    
</div>
<div id="window_ViewPasswordChangeNotification" style="position:absolute; z-index:10; left:350px; top:160px;background-color:#dde3eb; width:500px; height:auto; border:1px solid #464f5a; display:none; z-index:100000; position:absolute;">
  <div style="padding-bottom:0px; width:auto; background-color:#718191; border-bottom:1px solid #464f5a; height:20px;" onMouseDown="beginDrag(this.parentNode, event);">
	<table width="100%">
	 <tr>
		<td width="60%" style="color:#EEEEEE; text-transform:uppercase; font-weight:bold;" valign="top">
			Password Change Notification
		</td>
		<td align="right" valign="top">
	<!-- 	<img src="Main/Layout/images/close.gif" onclick="HidePopUp_Auth('div_ViewPasswordChangeNotification','window_ViewPasswordChangeNotification');removeModal();"/> -->
		</td>
	</tr>
	</table>		
  </div>
<div id="div_ViewPasswordChangeNotification" style="width:auto; background-color:#FFFFFF;"></div>  
</div>
          <!-- jQuery -->
        <!-- <script src="admindashboard/plugins/jquery/jquery.min.js"></script> -->
        <!-- jQuery UI 1.11.4 -->
        <script src="admindashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="admindashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="admindashboard/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="admindashboard/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="admindashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="admindashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="admindashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="admindashboard/plugins/moment/moment.min.js"></script>
        <script src="admindashboard/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="admindashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="admindashboard/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="admindashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="admindashboard/dist/js/adminlte.js"></script>
        <script src="admindashboard/dist/js/pages/dashboard.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="admindashboard/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="admindashboard/plugins/raphael/raphael.min.js"></script>
<script src="admindashboard/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="admindashboard/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<!-- AdminLTE for demo purposes 
<script src="admindashboard/dist/js/demo.js"></script>
AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admindashboard/dist/js/pages/dashboard2.js"></script>
    <footer valign="bottom">
          <strong>Copyright &copy; 2018-2035 <a href="#">John Katieno</a>.</strong>
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 2.30.0
          </div>
        </footer>
</div>
    </body>
</html>