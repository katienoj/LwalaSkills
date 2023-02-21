<?php
session_start();
require_once '../Config/db_conn.php';
$UserId = $_SESSION['UserId'];
$ExecSqlStatement = mysqli_query($conn, "Select username From UsersTable Where UserId = '$UserId'");
$GetUserDetails = mysqli_fetch_assoc($ExecSqlStatement);
?>
<style type="text/css">
  .inactive {
    background-color: #EEEEEE;
    color: #000000;
    font-family: Arial, Helvetica, sans-serif;
    border: #000000 1px solid;
  }

  .TableBorder {
    border: #CCCCCC solid 1px;
  }

  .TableBorder_Dark {
    border: #808080 solid 2px;
  }

  .SectionHeaders {
    font-weight: bold;
  }

  .ExpandImg:hover {
    width: 16px;
    height: 16px;
    cursor: pointer;
  }

  .MarkAsHeader {
    border: #959595 solid 1px;
    background: #F6F6F6;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
  }

  .MarkAsSubHeader {
    background: #F6F6F6;
    font-family: Arial, Helvetica, sans-serif;
    text-align: right;
  }

  .MarkAsResults {
    border: #BEBEBE solid 1px;
    background: #F9F9F9;
    font: Arial, Helvetica, sans-serif;
    font-weight: bold;
  }

  .MarkAsResults_Sub {
    background: #F9F9F9;
    font: Arial, Helvetica, sans-serif;
  }
</style>
<table width="100%" border="0">

  <tr>
    <td valign="top" align="right" class="MarkAsSubHeader">Username: </td>
    <td valign="top" class="MarkAsResults_Sub"><input class="form-control" type="text" id="usr" disabled="disabled" class="inactive" value="<?php echo $GetUserDetails['username']; ?>" /></td>
  </tr>
  <tr>
    <td valign="top" align="right" class="MarkAsSubHeader">Current Password:</td>
    <td valign="top" class="MarkAsResults_Sub"><input class="form-control" type="password" id="oldpassword"></td>
  </tr>
  <tr>
    <td valign="top" align="right" class="MarkAsSubHeader">New Password:</td>
    <td valign="top" class="MarkAsResults_Sub"><input class="form-control" type="password" id="newpassword"></td>
  </tr>
  <tr>
    <td valign="top" align="right" class="MarkAsSubHeader">Confirm Password:</td>
    <td valign="top" class="MarkAsResults_Sub"><input class="form-control" type="password" id="confirmpassword"></td>
  </tr>
  <tr>
    <td class="MarkAsSubHeader">&nbsp;</td>
    <td class="MarkAsResults_Sub">
      <input class="btn btn-info" type="button" id="savepwdchange" value="  Change Password " onclick="ChangePassWord_2()">
    </td>
  </tr>
</table>