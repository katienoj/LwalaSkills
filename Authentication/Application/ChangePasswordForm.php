<style type="text/css">
  .inactive {
    background-color: #EEEEEE;
    color: #000000;
    font-family: Arial, Helvetica, sans-serif;
    border: #000000 1px solid;
  }
</style>
<table width="100%" border="0">
  <tr style="background-color: red;">
    <td style="background-color: red;" colspan="2" align="center" height="33" class="alertsBox"><b>The System Administrator Requests That You Change Your Password. </b></td>
  </tr>
  <tr style="background-color: red;">
    <td style="background-color: red;" colspan="2" align="center" height="33" class="alertsBox"><b>The password should: <br>*1.Have both letters and Numbers<br>*2.Not less than 8 characters<br>Call: 0708180649 For Help</b></td>
  </tr>
  <tr>
    <td>Username: </td>
    <td><input class="form-control" type="text" id="usr" disabled="disabled" class="inactive" /></td>
  </tr>
  <tr>
    <td>Old Password:</td>
    <td><input class="form-control" type="password" id="oldpassword"></td>
  </tr>
  <tr>
    <td>New Password:</td>
    <td><input class="form-control" type="password" id="newpassword"></td>
  </tr>
  <tr>
    <td>Confirm Password:</td>
    <td><input class="form-control" type="password" id="confirmpassword"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input class="btn btn-primary" type="button" id="savepwdchange" value="  Change Password " onclick="ChangePassWord()">
    </td>
  </tr>
</table>