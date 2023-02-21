// JavaScript Document

/*
Script Author:John Katieno
Various variables and objects will be entirely on this script.

-MyRequest:this will be used to call the AjaxObject 
-responseText:This will contain the response from the called server side script for manipulation
-aJaxObject:This is an asynchronous object that will be used to invoke server side scripts and return their results.It takes the path to the server side script plus all the variables to be passed to the script as an argument
-


*/
var inter=0;
var hh=0;
function show_dashboard()
{
	//This function will be used to show the dashboard.It calls the dashboard script from the database and displays it
	var myRequest=new ajaxObject("Main/includes/navigation/show_dashboard.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('main_window').innerHTML=responseText; 
	}
	myRequest.update();
}


function ShowModule(ModuleId,FolderName)
{
//This function is used to redirect the user to a selected module based on what the user selected
  window.location.href=FolderName+"/index.php?ModuleId="+ModuleId+"&";
}

function alert_box(msg,action_var)
{
	//This function will be used to display a customised alert box.This defaul alert box on most browsers is not only irritating but also very monotonous,so we decided to come up with ours
	//alert(action_var);
	for(var i=0;i<=20;i++)
	{
		
		 if(action_var==3)
		{
			closepopupdiv();
		}
		else
		{
			var pname='../Main/includes/alertmsg.php?msg='+msg+'&';
		    
			var div=document.getElementById('alert_div');
			var myRequest=new ajaxObject(pname);
			myRequest.callback=function(responseText)
			{
				
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='25%';
				div.style.top = '10%';
				div.style.height='auto';
				div.style.width='auto';
				//after  displaying the alert box,block all other window components by displaying some  overlat on them
				modal();
				//Put the focus on the OK button on the alert box to give the user a chance of using the Enter  key on their keyboards to exit the alert 
			
				document.getElementById('OK_Button').focus();
			}
			myRequest.update();
			break;
		}
	}
			
}

function modal(){

width = document.body.clientWidth;
height = document.body.clientHeight;

var shield_div = document.getElementById('alert_overlay');	
shield_div.style.width		=	width;
shield_div.style.height		=	height;
shield_div.style.display 	= 	'block';
}


function showPopup()
{
  modal();
  document.getElementById('alert_div').style.display='block';
  
}

function Confirm_Box(msg)
{
	//This function does exactly what the alert box will do,and more.It will give a user a confirmation area to confirm a given action
	var pname='../Main/includes/confirmmsg.php?msg='+msg+'&';

	var div=document.getElementById('alert_div');
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%';
		div.style.top = '10%';
		div.style.height='auto';
		div.style.width='auto';
		modal();
		document.getElementById('OK_Button').focus();
	}
	myRequest.update();
	return;
}

function close_alert_div()
{
	//This function is invoked when the user hits the OK on the alert box.Is it self explanatory?
	document.getElementById('alert_div').style.display='none';
	document.getElementById('alert_overlay').style.display='none';

}
function StartModule(ModuleId)
{
	//Aftter entering a module,the system needs to display a set of menus and a default display for that module
	
	//Show the menu
	ShowNav(ModuleId);
	//Load some default info for the user to see when they get into the module
	LoadModuleToShow(ModuleId);
	//CaptureDepartmentId(ModuleId);
	//alert_box(ModuleId);
}
function ShowNav(ModuleId)
{ 
//This is the function that actually shows the main menu for every module.Is it self explanatory
    var pname="../Main/includes/navigation/nav.php?ModuleId="+ModuleId+"&";
       //alert_box(pname);
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
                //alert_box(responseText);
		document.getElementById('topmenu').innerHTML=responseText; 
	}
	myRequest.update();
}

function LoadModuleToShow(ModuleId)
{
	//To load some default info when entering into the module,this is the function to call
	var pname="../Main/includes/navigation/ShowModuleToLoad.php?ModuleId="+ModuleId+"&";
       //alert_box(pname);
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
          var result=responseText.split(':');
		  //Display the submodule level functions for the submodule
		  LoadModuleFunctions(result[0]);
	}
	myRequest.update();
}
function LoadModuleFunctions(ModuleId)
{
	//Use this function to interrogate the database to extract module level menus for a given submodule
	var pname='../Main/includes/navigation/ModuleFunctions.php?ModuleId='+ModuleId+'&';
	//alert_box(pname);
	var myRequest=new ajaxObject(pname)
    myRequest.callback=function(responseText)
	{
		//alert_box(responseText);
		document.getElementById('links_div').innerHTML=responseText;
	}
	myRequest.update();
}
function showSearchDiv()
{  
   //This function is used to roll out the search window
   document.getElementById('search_bar').style.display='block';
   //The search window should be a max of 190px in height,so the following if condition confirms that
	if(hh==190)
	{
		//It the height of the window is =190,stop rolling out the div
		clearInterval(inter);
		return;
	}
	//Show the search window as rolls out
	document.getElementById('search_bar').style.visibility='visible';
	hh+=10;
	//assign the calculate height dynamically to search window
	document.getElementById('search_bar').style.height=hh+'px';
	

}

function closepopupdiv()
{
    //This function is used to close a popup called popup div
	document.getElementById('popup_div').style.display='none';
}

function hideSearchDiv()
{
	//This function behaves exaclty like the showSearchDiv() though it does the reverse
	if(hh==0)
	{
		clearInterval(inter);
		document.getElementById('main_window').style.height='760px';
		document.getElementById('search_bar').style.display='none';
		return;
	}
	
	hh-=10;
	document.getElementById('search_bar').style.height=hh+'px';
	document.getElementById('main_window').style.height='760px';
}
function LoadQuitWindow()
{
	//This function is used to display the window to display the logout window
	var pname="../Main/includes/navigation/QuitWindow.php";
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		document.getElementById('QuitWindowDiv').innerHTML=responseText; 
		document.getElementById('QuitWindowDiv').style.display='block';
		modal();
	}
	myRequest.update();
}


function Logout()
{
	
	//Logout a user
	var pname='../Authentication/Application/logout.php';
	var myRequest=new ajaxObject(pname)
    myRequest.callback=function(responseText)
	{
		if(responseText==1)
		{
			window.location.href='../index.php';
		}
		else
		{
			alert_box(responseText);
		}
	}
	myRequest.update();
}

function BackToHome()
{
	window.location.href='../MainDashBoard.php';
}

function HideQuitWindow()
{
	document.getElementById('QuitWindowDiv').style.display='none';
}

function showBarcode(show_text)
{
	var img_format='';
	var img_quality=100;
	var img_width=200;
	var img_height=60;
	var img_type=1;
	var img_barcode=show_text;
	var the_response='';
	var pname='../Main/Application/barcode_show.php?text='+1+'&format='+img_format+'&quality='+img_quality+'&width='+img_width+'&height='+img_height+'&type='+img_type+'&barcode='+img_barcode+'&';
	//alert(pname);
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		//alert(responseText);
		document.getElementById('barcode_response').value=responseText;
		
	}
	myRequest.update();/**/
	
}

function printDoc(frame_id){
parent[frame_id].focus();
parent[frame_id].print();
}
function CapturePatientPayment(PatId)
{
	var div=document.getElementById('popup_div');
	var pname='../Main/Application/ShowServices.php?PatId='+PatId+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top = '10%';
		div.style.width='700px';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
	
}

function ShowDepartmentServices()
{
	var de=document.getElementById('DepartmentList');
	var dept=de.options[de.selectedIndex].value;
	
	var pname='../Main/Application/DepartmentServices.php?DeptId='+dept+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		document.getElementById('ShowDeptServices').innerHTML=responseText;
	}
	myRequest.update();
	
}


function GetServiceToBePaid()
{
	var services=document.getElementsByName('service_id');
	var total=0;
	for(var i=0;i<=services.length;i++)
	{
		if(services[i].checked)
		{
			var ServiceId=services[i].value;
			var amt=parseFloat(document.getElementById("Total"+ServiceId).value);
			total+=amt;
			document.getElementById('totalForService').value=total;
		}
	}
}

function calcTotalForService(ServiceId)
{
	var qty=document.getElementById('Qty'+ServiceId).value;
	var amt=document.getElementById('Amt'+ServiceId).value;
	var Total=0;
	
	Total=qty*amt;
	document.getElementById('Total'+ServiceId).value=Total;
	GetServiceToBePaid();
}

function SaveSelectedServices()
{
	var services=document.getElementsByName('service_id');
	PatNo=document.getElementById('PatientNo').value;
	var de=document.getElementById('DepartmentList');
	var dept=de.options[de.selectedIndex].value;
	var success=0;
	for(var i=0;i<=services.length;i++)
	{
		//alert(i+" "+services.length);
		if(services[i].checked)
		{
			var ServiceId=services[i].value;
			var qty=document.getElementById('Qty'+ServiceId).value;
	        var amt=document.getElementById('Amt'+ServiceId).value;
			var Total=document.getElementById('Total'+ServiceId).value
			
	var pname='../Main/Application/SaveSelectedServices.php?ServiceId='+ServiceId+'&qty='+qty+'&amt='+amt+'&Total='+Total+'&PatNo='+PatNo+'&DeptId='+dept+'&';
	//alert(pname);
			var myRequest=new ajaxObject(pname);
			myRequest.callback=function(responseText)
			{
				//alert(responseText);
				if(isNaN(responseText))
				{
					alert_box(responseText);
				}
				else
				{
					success+=1;
				}	
			}
			myRequest.update();
		
		}
		if(i==services.length-1)
		{

				alert_box('Services successfully regsitered for payment');
				closepopupdiv();
		}
		
	}
}