<?php
//script displays all the charges done on a selected patient during a particular episode
require_once '../../../Main/Config/db_conn.php';
session_start();
global $conn;
$UserId = $_SESSION['UserId'];
$EmployeeId = $_SESSION['EmployeeId'];
$UserNames = $_SESSION['UserName'];
$sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result = mysqli_fetch_assoc($sql);
$SessionId = $result['Session_Id'];
//echo "New ".$SessionId."<br>Old".session_id();
$PatientId = $_REQUEST['PatientId'];
$EpisodeId = $_REQUEST['EpisodeId'];
$GetPatientName = mysqli_query($conn, "SELECT * FROM Patients WHERE Id='$PatientId'");
$numrows = mysqli_num_rows($GetPatientName);
if ($numrows == 0) {
    $GetPatientName = mysqli_query($conn, "SELECT * FROM DentalQueue WHERE Id='$PatientId'");
}
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
  #container {
    position: absolute;
    width: 392px;
    height: auto;
    z-index: 100;
    left: 220px;
    top: 165px;
    background-color: #E4E4E4;
    border: #003300 solid 1px;
    display: none;
  }
  #charge_div {
    height: auto;
    z-index: 100;
    left: 220px;
    top: 165px;
    background-color: #E4E4E4;
    border: #003300 solid 1px;
    display: none;
  }
</style>
<input type="hidden" id="itemunitcost" name="itemunitcost" />
<input type="hidden" id="itemstotalunitcost" name="itemstotalunitcost" />
<input type="hidden" id="procunitcost" name="procunitcost" />
<input type="hidden" id="proctotalunitcost" name="proctotalunitcost" />
<table width="100%" border="0" bgcolor="#E4E4E4">
  <tr>
    <td colspan="8">
      <table width="100%" border="0" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
        <td width="94%" class="formtop"> Charge Sheet for <?php echo $PatientName; ?> </td>
        <td width="6%" class="formtop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onClick="closepopupdiv()" style="cursor:hand" /></td>
  </tr>
</table>
</td>
</tr>
<tr>
  <td  colspan="4"><span class="style1">Add Procedure Charge</span> :</td>
</tr>
<tr>
  <td width="31%" >Patient Number</td>
  <td width="30%"  style="color:#0000FF"><?php echo $PatientId; ?> </td>
  <td width="31%" >Dentist Number :</td>
  <td width="8%"  style="color:#0000FF"><?php echo $DoctorsNumber; ?> </td>
</tr>
<tr>
  <td >Patient Name :</td>
  <td  style="color:#0000FF"><?php echo $PatientName; ?> </td>
  <td >Dentist Name :</td>
  <td  style="color:#0000FF"><?php echo $DoctorsName; ?> </td>
</tr>
<tr>
  <td >Age :</td>
  <td  style="color:#0000FF"> <?php echo GetPatientAge($DOB); ?> </td>
  <td >Date</td>
  <td  style="color:#0000FF"> <?php echo date("d-m-yy") ?> </td>
</tr>
<tr>
  <td >What To Charge:</td>
  <td  style="color:#0000FF"><span  style="color:#0000FF"><span  style="color:#0000FF">
        <select class="form-control" id="whattochargeindentalchargesheet" name="whattochargeindentalchargesheet" onchange="loadchargediv()">
          <option class="form-control">_Select_</option>
          <option class="form-control" value="item">item</option>
          <option class="form-control" value="procedure">procedure</option>
          <option class="form-control" value="procedure">service</option>
        </select>
      </span></span></td>
  <td ></td>
  <td  style="color:#0000FF"> </td>
</tr>
</table>
<div id="charge_div"> </div>
<?php
$Sql = "SELECT * FROM PatientChargeSheet WHERE PatientId='$PatientId' AND EpisodeNo='$EpisodeId'";
$result = mysqli_query($conn, $Sql) or die(mysqli_error($conn));
?>
<table width="100%" border="0" bgcolor="#E4E4E4">
  <tr>
    <td valign="top" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="6"><span class="style1">Pending Charges</span> :</td>
  </tr>
  <tr bgcolor="#D5FFE9">
    <td ></td>
    <td >Procedure/Item </td>
    <td >Quantity </td>
    <td >Unit Cost</td>
    <td >Total Cost</td>
    <td >Payment Status</td>
  </tr>
  <tr>
    <td>
      <input name="dentalpatientchargesheetpid" type="hidden" id="dentalpatientchargesheetpid" value="<?php echo $PatientId; ?>" />
      <input name="dentalpatientchargesheeteid" type="hidden" id="dentalpatientchargesheeteid" value="<?php echo $EpisodeId; ?>" />
    </td>
    <input name="dentalpatientchargesheetdentist" type="hidden" id="dentalpatientchargesheetdentist" value="<?php echo $DoctorsName; ?>" />
    <input name="dentalpatientchargesheeteid" type="hidden" id="dentalpatientchargesheeteid" value="<?php echo $EpisodeId; ?>" /> </td>
  </tr>
  <tbody style="width:100%; height:auto; max-height:320px; overflow-x:hidden;overflow-y:auto;">
    <?php if (mysqli_num_rows($result) == 0) {
    ?>
      <tr>
        <td colspan="8" >No charges for this patient</td>
      </tr>
      <?php
} else {
        $count = 0;
        while ($recs = mysqli_fetch_array($result)) {
            $Item = $recs['ParticularsId'];
            $UnitCost = $recs['Cost'];
            $Quantity = $recs['Quantity'];
            if ($recs['PaidStatus'] == 1) {
                $PaidStatus = 'Paid';
            } else {
                $PaidStatus = 'Pending';
            }
            if ($recs['Type'] == 'Item') {
                $GetProcedureName = mysqli_query($conn, "SELECT * FROM StockTable WHERE Id='$Item'");
                while ($rows = mysqli_fetch_array($GetProcedureName)) {
                    $ProcedureName = $rows['StockName'];
                }
            } else {
                $GetProcedureName = mysqli_query($conn, "SELECT * FROM Procedures WHERE ProcedureId='$Item'");
                while ($rows = mysqli_fetch_array($GetProcedureName)) {
                    $ProcedureName = $rows['ProcedureName'];
                }
            }
            $Amount = $recs['Amount'];
            $ChargeId = $recs['Id'];
            if ($count % 2 == 0) {
                $bg = '#E1E1FF';
            } else {
                $bg = '#EAEAEA';
            } ?>
        <tr height="" bgcolor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF' " onMouseOut="this.bgColor='<?php echo $bg; ?>'">
          <td height="" ><input class="form-control" type='checkbox' name='dentalchargeitemid' value='<?php echo $ChargeId; ?>' id='dentalchargeitemid' /></td>
          <td ><?php echo $ProcedureName; ?></td>
          <td ><?php echo $Quantity; ?></td>
          <td ><?php echo $UnitCost; ?></td>
          <td ><?php echo $Amount; ?></td>
          <td ><?php echo $PaidStatus; ?></td>
        </tr>
      <?php $count++;
        } ?>
  </tbody>
<?php
    }
?>
</table>
</td>
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
<div id="container"></div>