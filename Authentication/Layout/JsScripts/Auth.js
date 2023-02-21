/*
Various variables and objects will be entirely on this script.

-MyRequest:this will be used to call the AjaxObject 
-responseText:This will contain the response from the called server side script for manipulation
-aJaxObject:This is an asynchronous object that will be used to invoke server side scripts and return their results.It takes the path to the server side script plus all the variables to be passed to the script as an argument
-
*/
function ExecChangeUserPassword()
{
	var UserName = document.getElementById('usr').value;
	var EmailAddress = document.getElementById('emailAddresss').value;
	var Password = document.getElementById('newPassword').value;
	var ConfirmPassword = document.getElementById('confirmPassword').value;
	var Error_Message = "The following error(s) have occuired.<br/>";
	var Error_Count = 0;
	//var TestPassword = /^[A-Za-z0-9]+$/;
	var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	if(UserName == '' && EmailAddress == '')
	{
		Error_Message += "-Please enter your user name or your email address.<br/>";
		Error_Count += 1;
	}
	else
	{
		if(EmailAddress != '')
		{
			var EmailExpresion=/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
			if(!EmailExpresion.test(EmailAddress))
			{
				Error_Message += "The email address you entered is invalid.<br/>";
				Error_Count += 1;
			}
		}
	}
	if(Password == '' && ConfirmPassword == '')
	{
		Error_Message += "-Please enter the new password and the confirmation.<br/>";
		Error_Count += 1;
	}
	else
	{
		if(Password.length < 6)
		{
			Error_Message += "-The password you entered is too short, password must be more than six characters long.<br/>";
			Error_Count += 1;
		}
		if(!mediumRegex.test(Password))
		{
			Error_Message += "-The password must contain both numbers and characters.<br/>";
			Error_Count += 1;
		}
		else
		{
			if(Password != ConfirmPassword)
			{
				Error_Message += "-The password and the confirmation do not match.<br/>";
				Error_Count += 1;
			}
		}
	}
	if(Error_Count > 0)
	{
		alert_box(Error_Message);
	}
	else
	{
		var myRequest=new ajaxObject('Application/ExecChangeUserPassword.php?enterUserName='+UserName+'&emailAddresss='+EmailAddress+'&newPassword='+Password+'&confirmPassword='+ConfirmPassword+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				alert_box("The password has been reset.Please login with the new password.");
				HidePopUp_Auth('div_ResetPasswordDiv','window_ResetPasswordDiv');
			}
		}
		myRequest.update();	
	}
}
function ShowResetPasswordForm_2()
{
	
	var myRequest=new ajaxObject('Main/Application/ChangePasswordForm.php');
	myRequest.callback=function(responseText)
	{
		HidePopUp_Auth('div_ViewPasswordChangeNotification','window_ViewPasswordChangeNotification');
		document.getElementById('div_ResetPasswordDiv_Main').innerHTML=responseText; 
		ShowPopUp_Auth('div_ResetPasswordDiv_Main','window_ResetPasswordDiv_Main');
	}
	myRequest.update();
}
function ShowResetPasswordForm()
{
	var myRequest=new ajaxObject('Application/ChangePasswordForm.php');
	myRequest.callback=function(responseText)
	{
		document.getElementById('div_ResetPasswordDiv_Main').innerHTML=responseText; 
		ShowPopUp_Auth('div_ResetPasswordDiv_Main','window_ResetPasswordDiv_Main');
	}
	myRequest.update();
}
function ShowChangePasswordForm(EmpUsrName)
{
	//This function will be invoke to display the password change window
	//Specify the div that will be used to hold the window
	var div=document.getElementById('PasswordChangeDiv');
	//Invoke the ajax Object and pass the path of the change password window script as an argument
	var myRequest=new ajaxObject('Application/ChangePasswordForm.php');
	//Grab the response from the script('The processed script code)

	myRequest.callback=function(responseText)
	{
		//Show the script
		div.style.display='block';
		div.innerHTML=responseText;
		div.style.width=500;
		div.style.height='auto';
		div.style.position='absolute';
		div.style.left='60%';
		div.style.top = '10%';
		div.style.zIndex = 100000000;
		document.getElementById('usr').value = EmpUsrName;
	}
	myRequest.update();
	//To show the window in a modular display,block all the other parts of the screen from access by displaying an overlay using this function
    put_overlay();
}

function ChangePassWord_2()
{
	//This function will be used to capture a user's change password details
	//The details as they are on the invoked form in the ShowChangePasswordForm() function 
	var OldPassword = document.getElementById('oldpassword').value;
	var NewPassword = document.getElementById('newpassword').value;
	var ConfirmPassword = document.getElementById('confirmpassword').value;
	var MediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	var Username = document.getElementById('usr').value;
  //Do some validation 
	var Error_Message = 'The following error occuired.\n';
	var Error_Count = 0;
	//Verify that the user name is entered
	if(Username == '')
	{
		Error_Message += '-Please enter your username.\n';
		Error_Count += 1;
	}
	//Verify that the password is entered
	if(OldPassword == '')
	{
		Error_Message += '-Please enter your old password.\n';
		Error_Count += 1;
	}
	//Veryfy that the new password is entered
	if(NewPassword == '')
	{
		Error_Message += '-Please enter your new password.\n';
		Error_Count += 1;
	}
	//Verify that the new password is confirmed
	if(ConfirmPassword == '' )
	{
		Error_Message += '-Please confirm your password.\n';
		Error_Count += 1;
	}
	//If the new password confirmation and the actual password do not match,inform the user
	else if(ConfirmPassword != '' && NewPassword != '')
	{
		if(NewPassword != ConfirmPassword)
		{
			Error_Message += '-The password and the confirmation did not match.\n';
			Error_Count += 1;
		}
		else
		{
	//Verify that the password is long enough
			if(NewPassword.length <= 6)
			{
				Error_Message += '-The password you entered is too short. It must be more than 7 characters long.\n';
				Error_Count += 1;
			}
			else
			{
				if(!MediumRegex.test(NewPassword))
				{
					Error_Message += '-The password must contain both numbers and characters.\n';
					Error_Count += 1;
				}
			}
		}
	}
	//Show the errors to the user
	if(Error_Count >0)
	{
		alert_box(Error_Message);
	}
	else
	{
   //If everything went on fine,proceed to change the password 
		var div=document.getElementById('PasswordChangeDiv');
		var myRequest=new ajaxObject('Main/Application/ModifyUserPassword.php?username='+Username+'&oldpassword='+OldPassword+'&newpassword='+NewPassword+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert('Password has been change succefuly');
				HidePopUp_Auth('div_ResetPasswordDiv_Main','window_ResetPasswordDiv_Main');
				document.getElementById('overlay_div').style.display='none';
				location.reload();

			}
		
		}
		myRequest.update();
	}	
}

function ChangePassWord()
{
	//This function will be used to capture a user's change password details
	//The details as they are on the invoked form in the ShowChangePasswordForm() function 
	var OldPassword = document.getElementById('oldpassword').value;
	var NewPassword = document.getElementById('newpassword').value;
	var ConfirmPassword = document.getElementById('confirmpassword').value;
	var MediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
	var Username = document.getElementById('usr').value;
  //Do some validation 
	var Error_Message = 'The following error occuired.\n';
	var Error_Count = 0;
	//Verify that the user name is entered
	if(Username == '')
	{
		Error_Message += '-Please enter your username.\n';
		Error_Count += 1;
	}
	//Verify that the password is entered
	if(OldPassword == '')
	{
		Error_Message += '-Please enter your old password.\n';
		Error_Count += 1;
	}
	//Veryfy that the new password is entered
	if(NewPassword == '')
	{
		Error_Message += '-Please enter your new password.\n';
		Error_Count += 1;
	}
	//Verify that the new password is confirmed
	if(ConfirmPassword == '' )
	{
		Error_Message += '-Please confirm your password.\n';
		Error_Count += 1;
	}
	//If the new password confirmation and the actual password do not match,inform the user
	else if(ConfirmPassword != '' && NewPassword != '')
	{
		if(NewPassword != ConfirmPassword)
		{
			Error_Message += '-The password and the confirmation did not match.\n';
			Error_Count += 1;
		}
		else
		{
	//Verify that the password is long enough
			if(NewPassword.length <= 6)
			{
				Error_Message += '-The password you entered is too short. It must be more than 7 characters long.\n';
				Error_Count += 1;
			}
			else
			{
				if(!MediumRegex.test(NewPassword))
				{
					Error_Message += '-The password must contain both numbers and characters.\n';
					Error_Count += 1;
				}
			}
		}
	}
	//Show the errors to the user
	if(Error_Count >0)
	{
		alert_box(Error_Message);
	}
	else
	{
   //If everything went on fine,proceed to change the password 
		var div=document.getElementById('PasswordChangeDiv');
		var myRequest=new ajaxObject('Application/ModifyUserPassword.php?username='+Username+'&oldpassword='+OldPassword+'&newpassword='+NewPassword+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert('Password has been change succefuly.');
				document.getElementById('PasswordChangeDiv').style.display = 'none';
				document.getElementById('overlay_div').style.display='none';
				document.getElementById('password').value = '';
				location.reload();

			}
		
		}
		myRequest.update();
	}	
}

function show_login()
{
	//This function will be used to show the login window,everything is self explanatory here,just get the file that has the login and show it.
	var div=document.getElementById('popup_div');
	var myRequest=new ajaxObject('Application/login.php');
	myRequest.callback=function(responseText)
	{
		
		//alert_box(responseText);
		div.style.display='block';
		div.innerHTML=responseText;
		div.style.width=500;
		div.style.height='auto';
		div.style.position='absolute';
		div.style.left='30%';
		div.style.top = '10%';
		
	}
	myRequest.update();
    put_overlay();
		
}



function put_overlay()
{
	//This function blocks every from access apart from the window which was called with this function
	document.getElementById('overlay_div').style.visibility='visible';
}




function proceed_login()
{ 
   //This function will be used to send a user's login details for authentication
   //Grab the username and password
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	
	//Tell the user to type in the username if it is blank
	if(username=='')
	{
		alert_box('Please type in your username');
	}
	//Tell the user to type in the password if it is blank
	else if(password=='')
	{
		alert_box("Please type in your password");
	}
	else
	{
	//Create a file path to the authenication script and pass all the variables
		var pname='Application/logchek.php?username='+username+'&password='+password+'&';
		//Put the file path as an argument to the javascript ajax Object
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		//Grab the response from the authentication script

		if(responseText==1)
		{
			//If the authentication is successful,send the user to the main dashboard
			window.location.href='../MainDashBoard.php';
		}
		else if(responseText==10)
		{
			//If the system administrator has forced the user to change the password,invoke the change password function 
			ShowChangePasswordForm(username);
		}
		else if(responseText==20)
		{
			alert_box("The your account has been deactivated because your password has expiried.");
			ShowChangePasswordForm(username);
		}
		else if(responseText.substr(0,20).trim()=="You were previously")
		{
			//If the user had logged in from another machine but never logged out,inform the user that he/she will be logged out from the other machine
			alert_box(responseText);
			window.location.href='../MainDashBoard.php';
			
		}
		else
		{
			 //alert_box(responseText);
			 //alert(responseText.substr(0,20));
			 alert_box(responseText);
		}

    }

	myRequest.update();
	}
	/**/
}

/*function alert_box(msg)
{
	var pname='Include/alertmsg.php?msg='+msg+'&';
	//alert(pname);
	var div=document.getElementById('alert_div');
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.left='25%';
		div.style.top = '10%';
		div.style.height='auto';
		div.style.width='auto';
		document.getElementById('OK_Button').focus();
		document.getElementById('alert_overlay').style.display='block';
	}
	myRequest.update();
		
}*/

function close_alert_div()
{
	document.getElementById('alert_div').style.display='none';
	document.getElementById('alert_overlay').style.display='none';
}
/*Show popup windows*/
function ShowPopUp_Auth(DivId,Container)
{
	var PopUpDiv = document.getElementById(DivId);
	var ContainerDiv = document.getElementById(Container);
	ContainerDiv.style.display = 'block';
	PopUpDiv.style.display = 'block';
}
/*Action: hide the popup popup windows*/
function HidePopUp_Auth(DivId,Container)
{
	var PopUpDiv = document.getElementById(DivId);
	var ContainerDiv = document.getElementById(Container);
	ContainerDiv.style.display = 'none';
	PopUpDiv.style.display = 'none';
}

