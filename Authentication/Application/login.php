<!--
This form is used to show a login screen for the user 
-->
<table width="1024" border="0">
  <tr>
    <td width="500">
      <table width="500" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF" class="formborder">
        <tr>
          <td width="100%" class="formtop">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="formheading">
                <td width="87%" class="formheading"><strong>Login</strong></td>
                <td width="13%" align="right" class="formheading">&nbsp;</td>
              </tr>
            </table>
            </div>
          </td>
        </tr>
        <tr>
          <td height="83" >
            <table width="100%" height="54" border="0">
              <tr>
                <td width="150">&nbsp;</td>
                <td width="18%">Username</td>
                <td width="54%"><input class="form-control" name="username" type="text" class="login" id="username" /></td>
                <td width="28%" rowspan="2"><img src="Layout/images/padlock2.png" alt="padlock" width="77" height="70" /></td>
              </tr>
              <tr>
                <td height="24">Password</td>
                <td><input class="form-control" name="password" type="password" class="login" id="password" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="center" bgcolor="#CBCAB5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">
                  <div align="center">
                    <input class="btn btn-warning" name="reset_client" type="button" id="reset_client" value="Reset" onclick="resetForm();">
                    &nbsp;&nbsp;
                    <input class="btn btn-success" name="save_client" type="button" id="save_client" onclick="proceed_login()" value="Login" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td width="514"><img name="" src="Layout/images/Logo.png" width="500" height="200" alt="" /></td>
  </tr>
</table>