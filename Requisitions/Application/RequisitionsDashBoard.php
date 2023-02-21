<?php
//Script Author:John Katieno
//This Script is used to show newly regsitered patients in the system
//Grab the main Database connection
require_once '../../Main/Config/db_conn.php';
$today =  date('Y-m-d');
$this_year= date("Y");
$this_month=date("m");
?>
<table style="height: 100%;width:100%;">
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
                      <strong>REGISTARTION STATISTICS</strong>
                    </p>
                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="piechart" style="width: 550px; height: 220px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-5" height="220" style="height: 220px;">
                    <p class="text-center">
                      <strong>Activity Highlights This Month</strong>
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

      </div><!--/. container-fluid -->
    </section>
                </div>
                </td>
                </tr>         </table>
</div>