function name_string(str_exp,helpmsg)
{
    
	var nameexp=/^[a-zA-Z\ \_\+\,\.\- ]+$/;
	if(!str_exp.value.match(nameexp) && str_exp.value!="")
	{
		alert_box(helpmsg);
		str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
}
function normal_string(str_exp,helpmsg)
{
    
	var nameexp=/^[a-zA-Z0-9\ \_\+\,\.\- ]+$/;
	if(!str_exp.value.match(nameexp) && str_exp.value!="")
	{
		alert_box(helpmsg);
		str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
}
function email_string(str_exp,helpmsg)
{
	var emailexp=/^[\\wa-zA-Z0-9_\.]+@[\\wa-zA-Z0-9_\.]+.[a-zA-Z0-9_.]+$/;
	if(!str_exp.value.match(emailexp) && str_exp.value!="")
	{
	alert_box(helpmsg);
	str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
	
}
function web_string(str_exp,helpmsg)
{
	
	var webexp=/^[\\wa-zA-Z0-9_]+.[\\wa-zA-Z0-9_]+.[a-zA-Z0-9_.]+$/;
	if(!str_exp.value.match(webexp) && str_exp.value!="")
	{
	alert_box(helpmsg);
	str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
	
}
function phone_string(str_exp,helpmsg)
{
	var phoneexp=/[+]\b\d{1,3}-\d{1,3}-\d{1,7}/;
	if((!str_exp.value.match(phoneexp) && str_exp.value!="") || str_exp.value==0)
	{
	alert_box(helpmsg);
	str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
	
}
function number_string(str_exp,helpmsg)
{
	//alert(parseInt(str_exp.value));
	var phoneexp=/^[0-9\ ]+$/;
	if((!str_exp.value.match(phoneexp) && str_exp.value!='') || parseInt(str_exp.value)==0)
	{
	alert_box(helpmsg);
	str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
	
}
function numeral_string(str_exp,helpmsg)
{
	var phoneexp=/^[0-9\ \-\+]+$/;
	if((!str_exp.value.match(phoneexp) && str_exp.value!="") || str_exp.value==0)
	{
	alert_box(helpmsg);
	str_exp.value="";
	return false;
	}
	else
	{
		return true;
	}
	
}

function date_string(str_exp,helpmsg)
{
	
}
function verify_password()
{
	var pass1=document.getElementById('password1').value;
	var pass2=document.getElementById('password2').value;
	if(pass1!=pass2)
	{
		alert_box("The password fields do not match.type in matching passwords");
		document.getElementById('password').value="";
		document.getElementById('password2').value="";
	}
	
}


function UploadedPhoto_validation(loaded_photo)
{
	var patient_p=loaded_photo.value;
    var patient_passport=patient_p.substr(patient_p.lastIndexOf('\\')+1);
	if(patient_passport!='')
	{
	if(patient_passport.search('gif')==-1 && patient_passport.search('GIF')==-1 && patient_passport.search('jpg')==-1 && patient_passport.search('JPG')==-1 && patient_passport.search('PNG')==-1 && patient_passport.search('png')==-1)
	{
		var error='The file you have uploaded is not a valid photo file.Please check the extension of the file.It should be a .gif or .GIF or .jpg or .JPG or .PNG or .png';
		alert_box(error);
		loaded_photo.value='';
		
	}
	}
}