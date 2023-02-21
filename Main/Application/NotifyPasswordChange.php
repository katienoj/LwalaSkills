<?php
session_start();
require_once '../Config/db_conn.php';
$UserId = htmlentities($_REQUEST['userId']);;

function DaysToPasswordAging($UserId)
{
	$ExplodeUserDetails = explode(":", GetUserDetails($UserId));
	$LastPwdChange = date("z", strtotime($ExplodeUserDetails[1]));
	$TodayInDays = date("z");
	$DaysDifference = $TodayInDays - $LastPwdChange;
	$SendNotification = false;
	$GroupPasswordAgingDays = GetPasswordAgingDays(GetPasswordAgingType($ExplodeUserDetails[0]));
	$DaysLeft = $GroupPasswordAgingDays - $DaysDifference;
	$ReturnString = '';
	if ($DaysLeft < 5) {
		$SendNotification = true;
		$ReturnString = $SendNotification . ':' . $DaysLeft;
	}
	return $ReturnString;
}
function GetPasswordAgingType($GroupId)
{
	global $conn;
	$ExecSqlStatement = mysqli_query($conn, "Select PasswordAgingType From UserGroups Where GroupId = '$GroupId'") or die(mysqli_error($conn));
	$GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
	return $GetDetails['PasswordAgingType'];
}
function GetPasswordAgingDays($AgingType)
{
	global $conn;
	$ExecSqlStatement = mysqli_query($conn, "Select AgingDays From PasswordAgingTable Where Id = '$AgingType'") or die(mysqli_error($conn));
	$GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
	return $GetDetails['AgingDays'];
}
function GetUserDetails($UserId)
{
	global $conn;
	$ExecSqlStatement = mysqli_query($conn, "Select * From UsersTable Where UserId = '$UserId'") or die(mysqli_error($conn));
	$GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
	return $GetDetails['GroupId'] . ':' . $GetDetails['LastUpdate'];
}
$ExplodeDaysToPasswordAging = explode(":", DaysToPasswordAging($UserId));
if ($ExplodeDaysToPasswordAging[0] == true) {
?>
	<table width="100%">
		<tr>
			<td valign="top" align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:28px; font-weight:bold;">
				<?php
				$DaysExpired = $ExplodeDaysToPasswordAging[1];
				if ($DaysExpired<=0){
					echo "<font color='red' align='center'>Your Password Has Expired!</font>";
				}
				else if($DaysExpired>0){
					echo "<font color='green' align='center'>Your Password will Expire in ".$ExplodeDaysToPasswordAging[1]." Days</font>";
				}
				?>
				
			</td>
		</tr>
		<tr>
			<td valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold;">
			<?php
				$DaysExpired = $ExplodeDaysToPasswordAging[1];
				if ($DaysExpired<=0){
					echo '<input type="button" class="btn btn-danger btn-block" value="Change Password" onclick="ShowResetPasswordForm_2()"/>';
				}
				else if($DaysExpired>0){
					echo '<input type="button" class="btn btn-success btn-block" value="Change Password" onclick="ShowResetPasswordForm_2()"/>';
				}
				?>
			

			</tr>
	</table>
<?php
} else {
	echo 1;
}
?>