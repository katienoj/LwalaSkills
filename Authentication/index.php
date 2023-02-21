  <?php
  
  $now = date('Y-m-d H:i:s');
  $dte=date('Y-m-d');
  $dte2='2025-08-31 23:59:59';
  $this_year = date("Y");
  $this_month = date("m");
  session_start();
  $sessionvar = "carefut10";
  if (isset($_SESSION[$sessionvar])) {
      header("Location:../Main/main_dashboard.html");
  } else {
      ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="shortcut icon" sizes="32x32" type="image/x-icon" href="../Main/Layout/images/Logo.png"/>
  <title>Lwala HMIS</title>
  <script language="javascript" type="text/javascript" src="Layout/JsScripts/Auth.js"></script>
  <script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/xmlhttprequest.js"></script>
  <script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/move_divs.js"></script>
  <script language="javascript" type="text/javascript" src="../Main/Layout/js_scripts/general.js"></script>
  <script language="javascript" type="text/javascript" src="../Wards/Layout/js_scripts/MoveDiv.js"></script>
  <script type="text/javascript">
  document.onkeypress=function(e){
   var unicode = e.keyCode?e.keyCode:e.charCode;
  //alert("Character: "+String.fromCharCode(e.charCode));
    if(unicode==13)
    {
        proceed_login();
    }
  }
   </script>
  <link rel="stylesheet" href="../Main/Layout/styles/divs.css"  />
  <link rel="stylesheet" href="../Main/Layout/styles/interface.css" />
      <link rel="stylesheet" href="../DataTables/Bootstrap-4-4.1.1/css/bootstrap.min.css">
      <script src="../DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
      <script src="../DataTables/Bootstrap-4-4.1.1/js/bootstrap.min.js"></script> 
           <link href="../DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
          <script type="text/javascript" src="../DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
          <script type="text/javascript" src="../DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
          <link href="../DataTables/Buttons-1.6.1/css/buttons.dataTables.min.css" />
          <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/dataTables.buttons.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.flash.min.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/JSZip-2.5.0/jszip.min.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.html5.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTables/Buttons-1.6.1/js/buttons.print.js"></script>
          <script language="javascript" type="text/javascript" src="../DataTable/sum().js"></script>
          <link href="../fontawesome/css/all.css" rel="stylesheet" type="text/css"/>
          <!--End-->  
  <style type="text/css">
  body {
  background-image:url(../Main/Layout/images/bg.jpg);
  background-repeat: repeat;
  background-size: 100%;
}
  #Layer1 {
    position:absolute;
    width:200px;
    height:115px;
    z-index:101;
    left: 285px;
  }
  #Layer2 {
    position:absolute;
    width:625px;
    height:173px;
    z-index:1;
    left: 48px;
    top: 17px;
  }
  #Layer3 {
    position:absolute;
    width:473px;
    height:119px;
    z-index:1;
    left: 91px;
    top: 22px;
  }
  .style2 {
    color: #666666;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
  }
  .style9 {font-family: Arial, Helvetica, sans-serif; color: #333333; }
  #Layer4 {
    position:absolute;
    width:102px;
    height:79px;
    z-index:102;
    top: 22px;
    left: 334px;
  }
  #apDiv1 {
    position:absolute;
    width:546px;
    height:84px;
    z-index:20001;
    left: 419px;
    top: 60px;
    color: #999;
  }
  #apDiv2 {
    position:absolute;
    width:200px;
    height:115px;
    z-index:1;
  }
  </style></head>
  <body background="../Main/Layout/images/bg.jpg">
  <div id="all">
  <table width="95%" height="95%" border="0">
    <tr>
      <td height="172" colspan="1" align="center"><div class="showModuleName" id="top_div" style="height:100px;">
        <div id="apDiv1">
          <div id="apDiv2"></div>
          <table  height="77">
          <?php
            if (($now>=$dte2)) {
                echo"<tr><td align='center'><font color='red' size='3'>The System's License Expired on Date: $dte2<br>Call:0708180649 for License Re-Activation</font></td></tr>";
            } else {
            } ?>
          </table>
        </div>
      </div></td>
    </tr>
    <tr>
    <td width="398"><div id="spacer" style="width:150px;"></div></td>
    <td width="616"><div id="Layer1"><img src="Layout/images/loginbg.jpg" width="720" height="220" />
      <div id="Layer2">
        <div id="Layer3">
          <table width="444" border="0">
            <tr>
              <td width="90" height="35">&nbsp;</td>
              <td colspan="4" valign="top"><div align="centre" class="style2"><b>SORI LAKESIDE HOSPITAL HMIS<br></b></div></td>
              <td width="60" rowspan="3"><div id="Layer4"><img src="../Main/Layout/images/Logo.png" width="94" height="100" /></div></td>
            </tr>
            <tr>
              <td><span class="style9"><b>Username<?php //echo $now;?></b></span></td>
               <?php
            if ($now>=$dte2) {
                echo  "<td colspan='2'><input class='form-control' name='username' type='text'  id='username' class='login' readonly placeholder='AutoLock!'/></td>";
            } else {
                echo  "<td colspan='2'><input class='form-control' name='username' type='text'  id='username' class='login'/></td>";
            } ?>
              </tr>
            <tr>
              <td><span class="style9"><b>Password</b></span></td>
              <?php
               if ($now>=$dte2) {
                   echo "<td colspan='2'><input class='form-control' name='password' type='password' id='password' class='login' placeholder='AutoLock!' readonly/></td>";
               } else {
                   echo "<td colspan='2'><input class='form-control' name='password' type='password' id='password' class='login' /></td>";
               } ?>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><a href="#" onclick="ShowResetPasswordForm()"></a></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td width="65"><input align="center" class="btn btn-success" name="save_client" type="button" id="save_client" onclick="proceed_login()" value="Login"/></td>
              <td width="153"><input align="center" class="btn btn-warning" type="button" name="Button" value="Clear"  onclick="resetForm()"/></td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
      </div>
    </div></td>
    </tr>
  </table>
    <div id="login_div"></div>
    <div id="overlay_div"></div>
    <div id="PasswordChangeDiv" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)" ></div>
  <div id="alert_div" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)" ></div>
  <div id="print_div" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)" ></div>
  <div id="popup_div" onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"> </div>
  <div id="popup_div_1"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"></div>
  <div id="popup_div_2"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)"> </div>
  <div id="popup_div_x"  onMouseMove="javascript:checkLoadedObjects(event);" onMouseUp="javascript:dropLoadedObject(event)">  </div>
  <div id="alert_div" ondblclick="javascript:getReadyToMove('alert_div', event);" onmouseup="javascript:dropLoadedObject(event)" onclick="javascript:dropLoadedObject(event);"></div>
  <div id="alert_overlay"></div>
  <div id="loading_div" style="width:400px; display:none; position:absolute; top:300px; left:400px;">
    <div align="center">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style="border:dotted 1px #5D5D5D;">
        <tr><td>&nbsp;</td></tr><tr><td align="center"><img src="Layout/images/loading.gif" width="50" height="50"></td></tr><tr><td align="center" >Loading .... please wait.</td></tr><tr><td>&nbsp;</td></tr>
      </table>
    </div>
  </div>
  <div id="window_ResetPasswordDiv" style="position:absolute; z-index:10; left:350px; top:160px;background-color:#dde3eb; width:500px; height:auto; border:1px solid #464f5a; display:none; z-index:100000; position:absolute;">
    <div style="padding-bottom:0px; width:auto; background-color:#718191; border-bottom:1px solid #464f5a; height:20px;" onMouseDown="beginDrag(this.parentNode, event);">
    <table width="100%">
     <tr>
      <td width="60%" style="color:#EEEEEE; text-transform:uppercase; font-weight:bold;" valign="top">
        Reset User Password
      </td>
      <td align="right" valign="top">
      <img src="../Main/Layout/images/close.gif" onclick="HidePopUp_Auth('div_ResetPasswordDiv','window_ResetPasswordDiv')"/>
      </td>
    </tr>
    </table>    
    </div>
     <div id="div_ResetPasswordDiv" style="width:auto; background-color:#FFFFFF;"></div>
  </div>
  </div>
  </body>
  </html>
  <?php
  }
  function datedifference($now, $dte2)
  {
      $difftimefunc = abs(strtotime($dte2) - strtotime($now));
      $years = floor($difftimefunc / (365*60*60*24));
      $months = floor(($difftimefunc - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $hours = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
      $minuts = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
      $seconds = floor(($difftimefunc - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
      if ($years == '0') {
          $add = '';
      } else {
          $add = $years.'years,';
      }
      if ($months == '0') {
          $addMonth = '';
      } else {
          $addMonth = $months.'Months,';
      }
      if ($days == '0') {
          $addDays = '';
      } else {
          $addDays = $days.'days,';
      }
      if ($hours == '0') {
          $addhours = '';
      } else {
          $addhours = $hours.'hrs,';
      }
      $difftimefunc = $add.$addMonth.$addDays.$addhours.$minuts.'min,'.$seconds.'sec';
      return $difftimefunc;
  }
  ?>
