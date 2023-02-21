<?php
//this is a script for allowing user to refer a patient from dental clinic. 
@include '../../Config/db_conn.php';
//@include 'Include/AuditTrailFunc.php';
//include 'Include/AuditTrailFunc.php';
session_start();
global $conn;
$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
$UserNames = $_SESSION['UserName'];
$sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result = mysqli_fetch_assoc($sql);
$SessionId = $result['Session_Id'];
//echo "New ".$SessionId."<br>Old".session_id();
$EpisodeId = htmlentities($_REQUEST['EpisodeId']);
$PatientId = htmlentities($_REQUEST['PatientId']);
$ScheduleId = htmlentities($_REQUEST['ScheduleId']);

//$EpisodeId = htmlentities($_REQUEST['EpisodeId']);

/*$EpisodeId = mysqli_query($conn, "SELECT max(Id) FROM PatientEpisodes WHERE PatientId='$PatientId' And RoomId=3 ");
$EpisodeId = mysqli_fetch_array($EpisodeId, MYSQLI_BOTH);
$EpisodeId = $EpisodeId[0];
*/

$GetPatientName = mysqli_query($conn, "SELECT * FROM Patients WHERE Id='$PatientId'");
while ($rows = mysqli_fetch_array($GetPatientName)) {
  $PatientName = $rows['LastName'] . " " . $rows['FirstName'] . " " . $rows['MiddleName'];
  $DOB = $rows['DateOfBirth'];
}

$sql = mysqli_query($conn, "SELECT * FROM EmployeeTable WHERE Id='$EmployeeId'");
while ($rows = mysqli_fetch_array($sql)) {
  $DoctorsNumber = $rows['EmployeeId'];
  $DoctorsName = $rows['EmployeeName'];
}



?>
<script type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js">
</script>
<script type="text/javascript" src="Layout/Dental.js"></script>
<script type="text/javascript" src="Layout/Time.js"></script>
<script type="text/javascript" src="Layout/scw.js"></script>
<script type="text/javascript" src="Layout/datetimepicker.js"></script>
<style type="text/css">
  .style1 {
    color: #FF0000
  }
</style>

<table width="100%" border="0" bgcolor="#E4E4E4">
  <tr>
    <td colspan="4">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <tr>
          <td width="94%" class="formtop">Patient Referal Form </td>
          <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><input name="dentalpatientreferpid" type="hidden" id="dentalpatientreferpid" value="<?php echo $PatientId; ?>" />
      <input name="dentalpatientrefereid" type="hidden" id="dentalpatientrefereid" value="<?php echo $EpisodeId; ?>" />
      <input name="thisscheduleid" type="hidden" id="thisscheduleid" value="<?php echo $ScheduleId; ?>" />
    </td>
  </tr>



  <tr>
    <td  width="275">Patient Number</td>
    <td  width="177" style="color:#0000FF"><?php echo $PatientId; ?> </td>
    <td  width="214"> Dentist No:</td>
    <td  width="193" style="color:#0000FF"> <?php echo $DoctorsNumber; ?> </td>
  </tr>
  <tr>
    <td >Patient Name :</td>
    <td  style="color:#0000FF"><?php echo $PatientName; ?> </td>
    <td >Dentist Name :</td>
    <td  style="color:#0000FF"> <?php echo $DoctorsName; ?> </td>
  </tr>
  <tr>
    <td >Age :</td>
    <td  style="color:#0000FF">
      <?php
      if ($DOB == null) {
        echo '';
      } else {
        echo GetPatientAge($DOB);
      }
      ?>
    </td>
    <td >Current Date :</td>
    <td  style="color:#0000FF"> <?php echo date("d-m-yy"); ?> </td>
  </tr>


  <tr>
    <td  colspan="4"><span class="style1">Add Referal Details</span> :</td>

  </tr>




  <tr>
    <td valign="top">Select Waiting Room :</td>
    <td><select class="form-control" onChange="" name="referfromdentaldep" id="referfromdentaldep">
        <?php
        echo "<option class='form-control' size =30 selected> </option>";
        //select procedures done only in dental clinic
        $GetTableName = "Select * From WaitingRoom";
        $sql_result = mysqli_query($conn, $GetTableName) or die(mysqli_error($conn));

        while ($row = mysqli_fetch_array($sql_result)) {
          echo "<option class='form-control' value='$row[RoomName]'>$row[RoomName]</option>";
        }
        ?>
      </select>
    </td>
  </tr>




  <tr>
    <td valign="top">Doctors Notes</td>
    <td><textarea class="form-control" name="referfromdentaldocnotes" cols="30" rows="5" id="referfromdentaldocnotes"></textarea></td>
  </tr>


  <tr>
    <td valign="top">&nbsp;</td>
    <td><input class="btn btn-warning" type="button" id="ReferPatientFromDental" name="ReferPatientFromDental" value="   Refer Patient  " onClick="ReferPatient()" /></td>
  </tr>
</table>


<?php
function GetPatientAge($DOB)
{
  global $conn;
  $Age = "";
  $StringDateOfBirth = $DOB;
  $ExplodedStringDateOfBirth = explode("-", $StringDateOfBirth);
  $GetYearOdBirth = $ExplodedStringDateOfBirth[count($ExplodedStringDateOfBirth) - 3];
  $CurrentYear = date("Y");
  $Age = $CurrentYear - $GetYearOdBirth;

  return $Age;
}
?>