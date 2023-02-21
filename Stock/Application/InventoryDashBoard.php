<html>
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
                      <strong>Disease prevalence This Month</strong>
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
                      <strong>Activity Highlights This Month</strong>
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
<div class="card" style="border: 0px solid #50544F; background-color: #DFFAFF; align-content: left; text-align: left;vertical-align: text-top;">

 <table class="display" style="width:100%" id="staffservices1">
        <thead>
         <tr>
           <th>SERVICES</th>
           <th>NO.</th>
           </tr>
        </thead>
        <tbody>
              

  <?php 
  $today =  date('Y-m-d'); 

$sql=mysqli_query($conn, "SELECT UsersTable.EmployeeId, PatientChargeSheet.UserId, COUNT(PatientId) AS chargingStaff FROM PatientChargeSheet JOIN UsersTable ON UsersTable.UserId = PatientChargeSheet.UserId GROUP BY UserId ORDER BY chargingStaff DESC ")or die(mysqli_error($conn));
   
           while($rec=mysqli_fetch_array($sql))
    {
      $empId = $rec['EmployeeId'];
      $uId = $rec['UserId'];
      $numbers = $rec['chargingStaff'];

  $sql2=mysqli_query($conn, "SELECT EmployeeName FROM EmployeeTable WHERE Id = '$empId'")or die(mysqli_error($conn));
            while($rec2=mysqli_fetch_array($sql2))
            {
            $e_name = $rec2['EmployeeName'];

            }

         echo "
         <tr>
        <td> $e_name</td>
        <td>$numbers</td>
        </tr>
       ";
            
    }
             
   ?>
    </tbody>
   </table>

  </b></a> </div></div>
  <div class="column"> 
  <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #DFFAFF; align-content: left; text-align: left;vertical-align: text-top;">
  <table width='100%' class='table-striped' id="staffservices2">
        <thead> <tr>
           <th>STAFF REVENUE</th>
           <th>NO.</th>

           </tr> 
        </thead>
        <tbody>          

  <?php 

  $today =  date('Y-m-d'); 

  $sql=mysqli_query($conn, "SELECT UsersTable.EmployeeId, PatientChargeSheet.UserId, SUM(Amount) AS totalAmount FROM PatientChargeSheet JOIN UsersTable ON UsersTable.UserId = PatientChargeSheet.UserId GROUP BY UserId ORDER BY totalAmount DESC ")or die(mysqli_error($conn));
   
           while($rec=mysqli_fetch_array($sql))
    {
      $empId = $rec['EmployeeId'];
      $uId = $rec['UserId'];
      $numbers = $rec['totalAmount'];
  $sql2=mysqli_query($conn, "SELECT EmployeeName FROM EmployeeTable WHERE Id = '$empId'")or die(mysqli_error($conn));
            while($rec2=mysqli_fetch_array($sql2))
            {
            $e_name = $rec2['EmployeeName'];

            }

         echo "<tr>
    <td> $e_name</td>
    <td> $numbers </td>
              </tr>";
            
    }
             
   ?>
   </tbody>
   </table>
  </b></a></div>  </div>
    
<div class="column"> 
  <div class="card"  height="100%" width="100%" style="border: 0px solid #50544F; background-color: #DFFAFF; align-content: left; text-align: left;vertical-align: text-top;">

  <table width='100%' class='table-striped' id="staffservices3">
        <thead>
         <tr>
           <th>DEPT. REVENUE</th>
           <th>NO.</th>

           </tr> 
        </thead>
        <tbody>
  <?php 
  $today =  date('Y-m-d'); 
   $sql=mysqli_query($conn, "SELECT DepartmentTable.DepartmentId, SUM(Amount) as revenueDept FROM PatientChargeSheet JOIN DepartmentTable ON DepartmentTable.DepartmentId = PatientChargeSheet.DepartmentId GROUP BY DepartmentId ORDER BY revenueDept DESC ")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
    {

      $deptId = $rec['DepartmentId'];
      $deptRevenue = $rec['revenueDept'];

            $sql2=mysqli_query($conn, "SELECT DepartmentName FROM DepartmentTable WHERE DepartmentId = '$deptId'")or die(mysqli_error($conn));
            while($rec2=mysqli_fetch_array($sql2))
            {
            $d_name = $rec2['DepartmentName'];

            }

         echo "<tr>
    <td> $d_name</td>
    <td> $deptRevenue </td>
              </tr>";
    }


?>
</tbody>
</table>
  </b></a></div>  </div>
  <div class="column"> <div class="card" style="border: 0px solid #50544F; background-color: #DFFAFF; align-content: left; text-align: left;vertical-align: text-top;">

  <table width='100%' class='table-striped' id="staffservices4">
  <thead>
         <tr>
           <th>STAFF BILLS</th>
           <th>NO.</th>

           </tr> 
           </thead>
           <tbody>
  <?php 
  $today =  date('Y-m-d'); 
           $sql=mysqli_query($conn, "SELECT EmployeeTable.EmployeeName, COUNT(PatientId) as bills FROM PatientChargeSheet JOIN EmployeeTable ON EmployeeTable.Id = PatientChargeSheet.BilledBy GROUP BY BilledBy ORDER BY bills DESC ")or die(mysqli_error($conn));
      while($rec=mysqli_fetch_array($sql))
    {

      $EmployeeName = $rec['EmployeeName'];
      $bills = $rec['bills'];

           

   echo "<tr>
    <td> $EmployeeName</td>
    <td> $bills </td>
              </tr>";
    }


?>
</tbody>
</table>   
     

</b></a> </div>

                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <!-- /.footer -->
            </div>
            <!-- /.card -->
                    <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    
                </div>
                </td>
                </tr>         </table>
</div>