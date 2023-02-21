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
          ['Username', 'Total Requests'],
          <?php
            $sql=mysqli_query($conn, "SELECT UsersTable.username, COUNT(InternalStockRequests.Id) as total FROM InternalStockRequests
JOIN UsersTable  ON InternalStockRequests.RequestInitiator = UsersTable.UserId
GROUP BY InternalStockRequests.RequestInitiator ORDER BY total  DESC LIMIT 20")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                echo "['".$rec['username']."', ".$rec['total']."],";
            }
           ?>
        ]);
        var options = {
          title: 'STOCK REQUEST'
        };
        var chart = new google.visualization.PieChart(document.getElementById('diagnosis'));
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
                      <strong>TEST DASHBOARD (<?php echo "MONTH: ".$this_month." / YEAR: ".$this_year;  ?>)</strong>
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
  
                      <b>
          
      
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-primary" style="width: <?php echo $receipting_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      Lab Results Pending
                      <span class="float-right">
                      
                      <b>
                  
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-danger" style="width: <?php echo $lab_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      <span class="progress-text">Imaging Results Pending</span>
                      <span class="float-right">
                      
                      <b>
              
                      </b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-success" style="width: <?php echo $imaging_width; ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                    <div class="progress-group" align="left">
                      Pending Procedures
                      <span class="float-right">
                     
                      <b></b></span>
                      <div class="progress progress">
                        <div class="progress-bar bg-warning" style="width: <?php echo $procedure_width; ?>%"></div>
                      </div>
                    </div>
                    <div class="progress-group" align="left">
                      Awaiting Admission
                      <span class="float-right">
                         
                      <b></b></span>
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
test		</td>
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
test		</td>
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