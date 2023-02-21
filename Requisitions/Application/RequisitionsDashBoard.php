<html>
<?php
//Script Author:John Katieno
//This Script is used to show newly regsitered patients in the system
//Grab the main Database connection
require_once '../../Main/Config/db_conn.php';
$today =  date('Y-m-d');
$this_year= date("Y");
$this_month=date("m");

if($this_month==1){
$previous_month = 12;
$previous_year= $this_year - 1;
}else{
$previous_month = $this_month - 1;
$previous_year = $this_year;
}
?>

<body>
<tbody>
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
        <div class="card-footer">
                  <div class="row">
                  <h5 class="description-header">SHOWING REAL TIME STATISTICS FOR THE CURRENT MONTH (<?php echo $this_month."/".$this_year; ?>)</h5>
                  <img  src="../Main/Layout/images/live.gif" alt="SoriLakeside" height="50" width="100%">
                  </div></div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">

                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="piechart" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6" height="220" style="height: 220px;">
                  
                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="donutchart" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">

                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="donutchart4" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6" height="220" style="height: 220px;">
                  
                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="donutchart3" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
                              <!-- ./card-body -->
                              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">

                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="donutchart5" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6" height="220" style="height: 220px;">
                  
                    <div>
                      <!-- Sales Chart Canvas -->
                      <div id="donutchart6" style="width: 500px; height: 350px;"></div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
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
        <div class="card-footer" align="centre">
                  <div class="row" align="centre">
                  <h5 class="description-header">SHOWING STATISTICS FOR THE PREVIOUS  MONTH (<?php echo $previous_month."/".$previous_year; ?>)</h5>
                  <img  src="../Main/Layout/images/live.gif" alt="SoriLakeside" height="50" width="100%">
                  </div></div>
        <!-- Main row -->
        <div class="row">
  <div class="column" >
<div class="card" style="border: 0px solid #50544F; background-color: #fcba03; align-content: left; text-align: left;vertical-align: text-top;">
  <table width="100%"  class='table-striped' id="staffservices1">
         <thead> 
         <tr>
            <th>DOCTOR/C.O</th>
            <th>COMPLAINTS</th>
            </tr>
         </thead>
         <tbody>
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientComplaints
             FROM PatientComplains
             JOIN EmployeeTable on EmployeeTable.Id = PatientComplains.EmployeeId
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId WHERE YEAR(PatientComplains.Date) = '$previous_year'
             AND MONTH( PatientComplains.Date ) = '$previous_month' AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientComplaints DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientComplaints=$rec['patientComplaints'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientComplaints </td>
               </tr>";
            }
    ?>
         </tbody>
    </table>
   </b></a> </div></div>
   <div class="column"> 
   <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #2de348; align-content: left; ">
   <table width="100%"  class='table-striped' id="staffservices2">
          <thead>
          <tr>
            <th>DOCTOR/C.O</th>
            <th>LAB</th>
         </tr>
          </thead>
            <tbody>
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientInvestigations FROM PatientInvestigationRequest
             JOIN EmployeeTable on EmployeeTable.Id = PatientInvestigationRequest.EmployeeId 
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId
             WHERE YEAR(PatientInvestigationRequest.Date) = '$previous_year'
             AND MONTH( PatientInvestigationRequest.Date ) = '$previous_month'
             AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientInvestigations DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientInvestigations=$rec['patientInvestigations'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientInvestigations</td>
            </tr>";
            }
    ?>
    </tbody>
    </table>  
   </b></a></div>  </div>
 <div class="column"> 
   <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #2dafe3; align-content: left; ">
   <table width="100%"  class='table-striped' id="staffservices3">
         <thead> <tr>
            <th>DOCTOR/C.O</th>
            <th>PRESCRs</th>
            </tr>
            </thead>
            <tbody>
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientPrescription FROM PatientPrescription
             JOIN EmployeeTable on EmployeeTable.Id = PatientPrescription.EmployeeId 
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId
             WHERE YEAR(PatientPrescription.Date) = '$previous_year'
             AND MONTH( PatientPrescription.Date ) = '$previous_month'
             AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientPrescription DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientPrescription=$rec['patientPrescription'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientPrescription </td>
               </tr>";
            }
    ?>
            </tbody>
    </table>
   </b></a></div>  </div> 
   <div class="column"> <div class="card" style="border: 0px solid #50544F; background-color: #e3482d; align-content: left; ">
 <table width="100%"  class='table-striped' id="staffservices4">
       <thead>   <tr>
            <th>DOCTOR/C.O</th>
            <th>ICD 10 </th>
            </tr> 
       </thead> 
       <tbody> 
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientDiagnosis FROM icd_10
             JOIN EmployeeTable on EmployeeTable.Id = icd_10.EmployeeId
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId
             WHERE YEAR(icd_10.Date) = '$previous_year'
             AND MONTH( icd_10.Date ) = '$previous_month'
             AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientDiagnosis DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientDiagnosis=$rec['patientDiagnosis'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientDiagnosis </td>
               </tr>";
            }
    ?>
       </tbody>
    </table>
 </b></a></div>  </div>

 <div class="column"> <div class="card" style="border: 0px solid #50544F; background-color: #FF33EC; align-content: left; ">
 <table width="100%"  class='table-striped' id="staffservices5">
       <thead>   <tr>
            <th>DOCTOR/C.O</th>
            <th>ADMISSION</th>
            </tr> 
       </thead> 
       <tbody> 
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientAdmission FROM PatientAdmission
             JOIN EmployeeTable on EmployeeTable.Id = PatientAdmission.EmployeeId 
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId
             WHERE YEAR(PatientAdmission.Date) = '$previous_year'
             AND MONTH( PatientAdmission.Date ) = '$previous_month'
             AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientAdmission DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientAdmission=$rec['patientAdmission'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientAdmission </td>
               </tr>";
            }
    ?>
       </tbody>
    </table>
 </b></a></div>  </div>
 
 <div class="column"> <div class="card" style="border: 0px solid #50544F; background-color: #E6FF33; align-content: left; ">
 <table width="100%"  class='table-striped' id="staffservices6">
       <thead>   <tr>
            <th>DOCTOR/C.O</th>
            <th>PROCEDURES</th>
            </tr> 
       </thead> 
       <tbody> 
   <?php
   $today =  date('Y-m-d');
            $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as patientProcedures FROM PatientProcedureRequest
             JOIN EmployeeTable on EmployeeTable.Id = PatientProcedureRequest.EmployeeId 
             JOIN UsersTable ON EmployeeTable.Id  = UsersTable.EmployeeId
             WHERE YEAR(PatientProcedureRequest.Date) = '$previous_year'
             AND MONTH( PatientProcedureRequest.Date ) = '$previous_month'
             AND UsersTable.GroupId = 3
             GROUP BY EmployeeName ORDER BY patientProcedures DESC")or die(mysqli_error($conn));
            while ($rec=mysqli_fetch_array($sql)) {
                $EmployeeName=$rec['EmployeeName'];
                $patientProcedures=$rec['patientProcedures'];
                //  echo "['".$rec['EmployeeName']."', ".$rec['patientCaptured']."],";
                echo "<tr>
     <td> $EmployeeName</td>
     <td> $patientProcedures </td>
               </tr>";
            }
    ?>
       </tbody>
    </table>
 </b></a></div>  </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
                </div>
                </td>
                </tr>         </table>
</div>
          </body>
          </html>