
				

function SaveDocInvoice()
{
// function to save a doctor invoice 	
	var Error;
		
		Error = "The following field(s) have a problem.<br>";
		var ErrorCounter = 0;
		
	//check if all required fields are filled	
	  if(document.getElementById('externaldoctor').value == '')
			{
				Error += '-Please select the doctor for that Invoice .<br>';
				ErrorCounter +=1;
				
			}
	  		
		if(document.getElementById('addsupinvoicedate').value == '')
			{
				Error += '-Please enter the date when the Invoice was received.<br>';
				ErrorCounter +=1;
				
			}
			
		
		if(document.getElementById('addsupinvoiceamount').value == '')
			{
				Error += '-Please enter the amount of the Invoice.<br>';
				ErrorCounter +=1;
				
			}
			else if(Isdecimal(document.getElementById('addsupinvoiceamount').value)==false)
			{
			Error += '-The amount entered is invalid.<br>';
			ErrorCounter +=1;
						
				
			}
		
         if(document.getElementById('supinvoicefile').value == '')
			{
			var NoteFile= '';	
			}


	
	   else
			{
			var NoteFile= document.getElementById('supinvoicefile').value;	
			
			}
			
			if(document.getElementById('supinvoicecurrency').value == '')
			{
				Error += '-Please select the currency.<br>';
				ErrorCounter +=1;
				
			}
		
		
		

	if(ErrorCounter==0)
	
	{
	
	document.getElementById('uploadCnote').submit();
	
	
	
	var PatientId=document.getElementById('dentalpatientchargesheetpid').value;
	var EpisodeId=document.getElementById('dentalpatientchargesheeteid').value;
	var Staff=document.getElementById('dentalpatientchargesheetdentist').value;

	
	
	var DoctorId=document.getElementById('doctorid').value;
	var ReceivedDate=document.getElementById('addsupinvoicedate').value;
	var Amount=document.getElementById('addsupinvoiceamount').value;
	var Currency=document.getElementById('supinvoicecurrency').value;

    var myRequest=new ajaxObject('../Main/Application/Ambulatories/SaveDocInvoice.php?DoctorId='+DoctorId+'&ReceivedDate='+ReceivedDate+'&Currency='+Currency+'&Amount='+Amount+'&PatientId='+PatientId+'&EpisodeId='+EpisodeId+'&Staff='+Staff+'&NoteFile='+NoteFile+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
			alert_box(responseText);
			
			AddProcedureToPatientChargeSheet(PatientId,EpisodeId);

			
			closepopupdiv();
				
			}
			
			
			
			//document.getElementById('main_window').innerHTML=responseText; 
		}
		//ShowAllInsurancePolicies();	
		myRequest.update();		
		
	}
	else
	{

	alert_box(Error);	
	}
	
	
	
	
	
	
	

}




function addDoctorInvoice()
 {
 
 var myRequest=new ajaxObject('../Main/Application/Ambulatories/AddDocInvoice.php');
					myRequest.callback=function(responseText)
					{
							//alert_box(responseText);
					var div=document.getElementById('charge_div');
			
					div.innerHTML=responseText;
					
					div.style.left='20%';
					div.style.top = '10%';
					//div.style.width='700px';
					div.style.height='auto';
							
				
					
					
					if(div.style.display=='none' || div.style.display=='')
						
						{
		
						div.style.display='block';
						  
						}
					
					
					}
					
					myRequest.update();	
 }


function ShowChargeSheetSummary(PatientId)
{
	var myRequest=new ajaxObject('Application/ChargeSheetScritps/ViewPatientChargeSheet.php?patientId='+PatientId+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('chargesheetwindow').innerHTML=responseText; 
	}
	myRequest.update();
}


function closethisdiv(div)
{
document.getElementById(div).style.display = "none";	

}


function RegisterExternalPatient()
{
	 //This function popups up the window for adding a new patient
	var div=document.getElementById('popup_div');
	var myRequest = new ajaxObject('../Main/Application/Ambulatories/RegisterExternalRegister.php');
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

function SavePatient(ActionType)
{
	 //This function grabs a patient's details from either the Add patient or edit patient window
	 //Grab the details
	var LastName=document.getElementById('LastName').value;
	var FirstName=document.getElementById('FirstName').value;
	var MiddleName=document.getElementById('MiddleName').value;
	var IDNumber=document.getElementById('IDNumber').value;
	var PassportNumber=document.getElementById('PassPortNumber').value;
	var DateOfBirth=document.getElementById('DateOfBirth').value;
	var se=document.getElementById('sex');
	var sex=se.options[se.selectedIndex].value;
	var Nationality=document.getElementById('Nationality').value;
	var R=document.getElementById('Religion');
	var Religion=R.options[R.selectedIndex].value;
	var PhyAddress=document.getElementById('PhyAddress').value;
	var MobileNo=document.getElementById('MobileNo').value;
	var PhoneNo=document.getElementById('PhoneNo').value;
	var Email=document.getElementById('Email').value;
	var Barcode='';
	var NHIFNo=document.getElementById('NHIFNo').value;
	var MaritalS=document.getElementById('MaritalStatus');
	var MaritalStatus=MaritalS.options[MaritalS.selectedIndex].value;
	var NextOfKin=document.getElementById('NextOfKin').value;
	var NextOfKinPhone=document.getElementById('NextOfKinPhone').value;
	var NextOfKinEmail=document.getElementById('NextOfKinEmail').value;
	var NextOfKinR=document.getElementById('NextOfKinRelationship');
	var NextOfKinRelationship=NextOfKinR.options[NextOfKinR.selectedIndex].value;
	var NextOfKinAddress=document.getElementById('NextOfKinAddress').value;
	var Estate=document.getElementById('Estate').value;
	var HouseNumber=document.getElementById('HouseNumber').value;
	var PostalAddress=document.getElementById('PostalAddress').value;
	var asthma=document.getElementById('asthma');
	var hypertension=document.getElementById('hypertension');
	var cardiacArrest=document.getElementById('cardiacArrest');
	var diabetes=document.getElementById('diabetes');
	var BreastCancer=document.getElementById('BreastCancer');
	var OtherChronic=document.getElementById('OtherChronic').value;
    var EmployerDetails=document.getElementById('EmployerDetails').value;
	var patient_p=document.getElementById('patient_passport').value;
    var patient_passport=patient_p.substr(patient_p.lastIndexOf('\\')+1);
	var PatientT=document.getElementById('PatientType');
	var PatientType=PatientT.options[PatientT.selectedIndex].value;
	
	
	if(asthma.checked)
	{
		asthma=1;
	}
	if(hypertension.checked)
	{
		hypertension=1;
	}
	if(cardiacArrest.checked)
	{
		cardiacArrest=1;
	}
	if(diabetes.checked)
	{
		diabetes=1;
	}
	if(BreastCancer.checked)
	{
		BreastCancer=1;
	}
	
	
	//Validate the data first before sending it to the server
   if(ValidatePatientInfo()!=false)
   {
	//If the action that invoked this function had an add argument,its going to add the patient to the system,else its going to edit an existing patient's details
	   if(ActionType=='add')
	   {
	 
			var pname='../Main/Application/Ambulatories/SaveExternalPatient.php?LastName='+LastName+'&FirstName='+FirstName+'&MiddleName='+MiddleName+'&IDNumber='+IDNumber+'&PassPortNumber='+PassportNumber+'&sex='+sex+'&Nationality='+Nationality+'&Religion='+Religion+'&PhyAddress='+PhyAddress+'&MobileNo='+MobileNo+'&PhoneNo='+PhoneNo+'&Email='+Email+'&Barcode='+Barcode+'&NHIFNo='+NHIFNo+'&MaritalStatus='+MaritalStatus+'&NextOfKin='+NextOfKin+'&NextOfKinPhone='+NextOfKinPhone+'&NextOfKinEmail='+NextOfKinEmail+'&NextOfKinRelationship='+NextOfKinRelationship+'&NextOfKinAddress='+NextOfKinAddress+'&Estate='+Estate+'&HouseNumber='+HouseNumber+'&PostalAddress='+PostalAddress+'&asthma='+asthma+'&hypertension='+hypertension+'&cardiacArrest='+cardiacArrest+'&diabetes='+diabetes+'&BreastCancer='+BreastCancer+'&OtherChronic='+OtherChronic+'&EmployerDetails='+EmployerDetails+'&DateOfBirth='+DateOfBirth+'&patient_passport='+patient_passport+'&PatientType='+PatientType+'&';
			//Upload the patient's passport photo
						document.getElementById('pass_upload').submit();

	   }
	   else
	   {
		   var PatientId=document.getElementById('PatientId').value;
		   var prev_photo=document.getElementById('prev_photo').value;
		   if(prev_photo!=patient_passport && patient_passport!='')
		   {
			 document.getElementById('pass_upload').submit();
            var new_photo=patient_passport;
		   }
		   else
		   {
			   var new_photo=prev_photo;
		   }
		   var pname='../Main/Application/Ambulatories/SavePatientChanges.php?LastName='+LastName+'&FirstName='+FirstName+'&MiddleName='+MiddleName+'&IDNumber='+IDNumber+'&PassPortNumber='+PassportNumber+'&sex='+sex+'&Nationality='+Nationality+'&Religion='+Religion+'&PhyAddress='+PhyAddress+'&MobileNo='+MobileNo+'&PhoneNo='+PhoneNo+'&Email='+Email+'&Barcode='+Barcode+'&NHIFNo='+NHIFNo+'&MaritalStatus='+MaritalStatus+'&NextOfKin='+NextOfKin+'&NextOfKinPhone='+NextOfKinPhone+'&NextOfKinEmail='+NextOfKinEmail+'&NextOfKinRelationship='+NextOfKinRelationship+'&NextOfKinAddress='+NextOfKinAddress+'&Estate='+Estate+'&HouseNumber='+HouseNumber+'&PostalAddress='+PostalAddress+'&asthma='+asthma+'&hypertension='+hypertension+'&cardiacArrest='+cardiacArrest+'&diabetes='+diabetes+'&BreastCancer='+BreastCancer+'&OtherChronic='+OtherChronic+'&EmployerDetails='+EmployerDetails+'&DateOfBirth='+DateOfBirth+'&patient_passport='+new_photo+'&PatientId='+PatientId+'&PatientType='+PatientType+'&';
	   }
	//alert(pname);
	
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
		alert_box(responseText);
		}
		else
		{
			alert_box("Action successful");
			closepopupdiv();
			ShowPatients();
			
		}
		
	}
	myRequest.update();
   }/**/
 
}
	
function GetServiceDetailsOnSelecting()
{

	var MyCheckbox = document.getElementsByName('servicesInDepartment');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
		else
		{
			
		}
	}
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetServiceDetailsOnSelect.php?ServiceId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		var ProcedureRecord = responseText;
		
		var SplitedProcedureRecord = ProcedureRecord.split(":");
		
		//document.getElementById('reporstToEmployeeId').value = SplitedEmployeeRecord[0];
		document.getElementById('servname').value = SplitedProcedureRecord[0];
		document.getElementById('servid').value = SplitedProcedureRecord[2];
		
		if( SplitedProcedureRecord[3]==1)
		{
			
		document.getElementById('externaldoctor').disabled=false;
		
		}
		
		


		document.getElementById('container').style.display = 'none';
	}
	myRequest.update();






	
}

function LoadChargeServiceSheet()
{


var div=document.getElementById('popup_div');
    //var Episode=document.getElementById('episodenum').value;
	var patients=document.getElementsByName('episode_id');
	
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
			   
			  
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			   		
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddServiceToChargeSheet.php?PatientId='+patientid+'&EpisodeId='+patients[i].value+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	
	
	
}




function LoadChargeProcedureSheet()
{


var div=document.getElementById('popup_div');
    //var Episode=document.getElementById('episodenum').value;
	var patients=document.getElementsByName('episode_id');
	
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
			   
			  
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			   		
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddProcedureToChargeSheet.php?PatientId='+patientid+'&EpisodeId='+patients[i].value+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	
	
	
}


function checkEpisode()
{
		
	var div=document.getElementById('popup_div');
   // var Episode=document.getElementById('episodenum').value;
	var dpatients=document.getElementsByName('episode_id');
	
	var message=0;
	var patientToRegisterEpisode=0;
	
	for(var i=0;i<=dpatients.length;i++)
		{
			if(dpatients[i].checked==true)
			{
				
			   var scheduleitem='patientscheduleid';	
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			 
			  // ScheduleId=document.getElementByName(scheduleitem).value;
			   
			   
			
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/CheckPatientEpisode.php?PatId='+patientid+'&');
				
				myRequest.callback=function(responseText)
				{
					if(responseText==2||responseText==0)
					 {
						
					   // alert('here');
						
					    alert_box('The selected Patient has no active Episode:\n An Episode will be registered for this patient');	 
						AutoRegisterEpisode(patientid);
						
						
					 }
					 else
					 {
					  message=0; 
					  	 
					 }
									
				}
				myRequest.update();  
		  }
	 }
	 
	 
	 
}
function AutoRegisterEpisode(patient)
{	
	
	var selectedPatient=patient;
	var pname='../Main/Application/Ambulatories/SaveAutoEpisode.php?selectedPatient='+selectedPatient+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box('The selected Patient has no active Episode:\n An Episode has beeen registered for this patient');			
			
		}
		else
		{
			close_alert_box();
			showTheEpisodes(selectedPatient);
		}
	}
	myRequest.update();
	
	history.go(-1);
}


function GetItemdetailsOnSelecting()
{
	var MyCheckbox = document.getElementsByName('employeesInDepartment');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
		else
		{
			
		}
	}
	var myRequest=new ajaxObject('Application/GetItemDetailsOnSelect.php?employeeId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		var EmployeeRecord = responseText;
		
		var SplitedEmployeeRecord = EmployeeRecord.split(":");
		
		//document.getElementById('reporstToEmployeeId').value = SplitedEmployeeRecord[0];
		document.getElementById('itemsname').value = SplitedEmployeeRecord[0];
		
		
		document.getElementById('container').style.display = 'none';
	}
	myRequest.update();
}

function ShowSearchOnDefineItem()
{
	var EmployeeNameHint = document.getElementById('itemsname').value;
	
	var PopUpDiv = document.getElementById('popup_div');
	var ContainerDiv = document.getElementById('details_div');
	
	var myRequest=new ajaxObject('Application/GetItemList.php?employeeNameHint='+EmployeeNameHint+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('container').style.display = 'block';
		document.getElementById('container').innerHTML=responseText; 
		
		//ContainerDiv.style.display = 'block';
		//PopUpDiv.style.display = 'block';
	}
	myRequest.update();
}



/*function ShowSearchOnDefineDoctorRelated()
{
	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetExternalDocsList.php?ServiceNameHint='+ServiceNameHint+'&Department='+Department+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('container').style.display = 'block';
		document.getElementById('container').innerHTML=responseText; 
		
	
	}
	myRequest.update();
}


	
*/

function SearchExternalDoctors()
{
   var DoctorId=document.getElementById('docpaymentdocid').value;
   var DoctorName=document.getElementById('docpaymentdocname').value;
   var Department=document.getElementById('docpaymentdep').value;
   var NationalId=document.getElementById('docpaymentnationalid').value;
  	var Search = 1;
 
	
var myRequest=new ajaxObject('../Main/Application/Ambulatories/ShowExternalDocSearchRes.php?DoctorId='+DoctorId+'&DoctorName='+DoctorName+'&Department='+Department+'&NationalId='+NationalId+'&Search='+Search+'&');
myRequest.callback=function(responseText)
	{
		document.getElementById('SelectDoctor').innerHTML=responseText; 
		
	}
	myRequest.update();	

}

function GetDoctorDetails()
{
	var MyCheckbox = document.getElementsByName('doctor');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
	}	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetDoctorDetails.php?DoctorId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		
		var PatientRecord = responseText;
		var SplitRecord = PatientRecord.split(":");
		
		document.getElementById('doctorid').value = SplitRecord[1];
		document.getElementById('externaldoctor').value = SplitRecord[0];
		document.getElementById('SelectDoctor').style.display = "none";		
	}
	myRequest.update();
}



function ShowSearchOnDefineDoctorRelated()
{
	document.getElementById('SelectDoctor').style.display = "block";	
	var myRequest=new ajaxObject("../Main/Application/Ambulatories/ShowExternalDocSearchRes.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('SelectDoctor').innerHTML=responseText; 
	ShowDoctorSearchForm();
	}
	myRequest.update();
	
}
function ShowDoctorSearchForm()
{
	document.getElementById('SearchDoctorsInfo').style.display = "block";
	var myRequest=new ajaxObject("../Main/Application/Ambulatories/GetExternalDocsList.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('SearchDoctorsInfo').innerHTML=responseText; 
		if(document.getElementById('SearchDoctorsInfo').style.display=='none' || document.getElementById('SearchDoctorsInfo').style.display=='')
		{
			
		document.getElementById('SearchDoctorsInfo').style.display='block';

		}
	}
	myRequest.update();
}




function ShowSearchOnDefineService()
{
	var ServiceNameHint = document.getElementById('servname').value;
	var Department = document.getElementById('departmentforcharging').value;
	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetServiceList.php?ServiceNameHint='+ServiceNameHint+'&Department='+Department+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('container').style.display = 'block';
		document.getElementById('container').innerHTML=responseText; 
		
	
	}
	myRequest.update();
}






function ShowSearchOnDefineProcedure()
{
	var ProcedureNameHint = document.getElementById('procname').value;
	var Department = document.getElementById('departmentforcharging').value;
	
	
	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetProcedureList.php?ProcedureNameHint='+ProcedureNameHint+'&Department='+Department+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('container').style.display = 'block';
		document.getElementById('container').innerHTML=responseText; 
		
	
	}
	myRequest.update();
}


function GetProcedureDetailsOnSelecting()
{
	
	var MyCheckbox = document.getElementsByName('proceduresInDepartment');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
		else
		{
			
		}
	}
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetProcedureDetailsOnSelect.php?ProcedureId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		var ProcedureRecord = responseText;
		
		var SplitedProcedureRecord = ProcedureRecord.split(":");
		
		//document.getElementById('reporstToEmployeeId').value = SplitedEmployeeRecord[0];
		document.getElementById('procname').value = SplitedProcedureRecord[0];
		
		document.getElementById('container').style.display = 'none';
	}
	myRequest.update();
}





function GetItemDetailsOnSelecting()
{
	var MyCheckbox = document.getElementsByName('employeesInDepartment');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
		else
		{
			
		}
	}
var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetItemDetailsOnSelecting.php?employeeId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		var EmployeeRecord = responseText;
		
		var SplitedEmployeeRecord = EmployeeRecord.split(":");
		
		//document.getElementById('reporstToEmployeeId').value = SplitedEmployeeRecord[0];
		document.getElementById('itemsname').value = SplitedEmployeeRecord[0];
		
		document.getElementById('container').style.display = 'none';
	}
	myRequest.update();
}

function ShowSearchOnDefineItem()
{
	var EmployeeNameHint = document.getElementById('itemsname').value;
	
	//var PopUpDiv = document.getElementById('popup_div');
//	var ContainerDiv = document.getElementById('detailsdiv');
	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/GetItemsList.php?employeeNameHint='+EmployeeNameHint+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('container').innerHTML=responseText; 
		/*ContainerDiv.style.display = 'block';
		PopUpDiv.style.display = 'block';*/
		document.getElementById('container').style.display = 'block';
	}
	myRequest.update();
}


function ReferPatientForm()
{
	
	var div=document.getElementById('popup_div');
   // var Episode=document.getElementById('episodenum').value;
	var dpatients=document.getElementsByName('patientid');
	
	for(var i=0;i<=dpatients.length;i++)
		{
			if(dpatients[i].checked==true)
			{
				
			   var scheduleitem='patientscheduleid';	
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			   ScheduleId=document.getElementById(scheduleitem+i).value;
			   
			   
			
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/ReferPatientForm.php?PatientId='+patientid+'&ScheduleId='+ScheduleId+'&EpisodeId='+dpatients[i].value+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='700px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	

	
}

function ReferPatient()
{

		
        var Error;
		
		Error = "The following field(s) have a problem.\n";
		var ErrorCounter = 0;
		
		
	  if(document.getElementById('referfromdentaldep').value == '')
			{
				Error += '\n-Please select the Waiting room to send the patient to.\n';
				ErrorCounter +=1;
				
			}
		
			
	if(document.getElementById('referfromdentaldocnotes').value == '')
			{
				Error += '\n-Please enter the referal notes.\n';
				ErrorCounter +=1;
				
			}		
	
	
	if(ErrorCounter==0)
	
	{
	var Notes=document.getElementById('referfromdentaldocnotes').value;
	var WaitingRoom=document.getElementById('referfromdentaldep').value;
	var EpisodeId=document.getElementById('dentalpatientrefereid').value;
	var PatientId=document.getElementById('dentalpatientreferpid').value;
	var ScheduleId=document.getElementById('thisscheduleid').value;
	var div=document.getElementById('popup_div');
	
	var myRequest=new ajaxObject('../Main/Application/Ambulatories/ReferPatient.php?EpisodeId='+EpisodeId+'&Notes='+Notes+'&ScheduleId='+ScheduleId+'&WaitingRoom='+WaitingRoom+'&PatientId='+PatientId+'&');

		myRequest.callback=function(responseText)
		{
			
			
			var ResponseMessage= responseText;
		
		    var SplitedMessage = ResponseMessage.split(":");
			alert(SplitedMessage[0]);
			var ReloadInt=SplitedMessage[1];
			
			
			if(ReloadInt==1)
			{
			ViewDentalPatients();
			}
			
			else if(ReloadInt==2)
			{
			ViewAllCCCPatients();
			}
			else if(ReloadInt==3)
			{
			ViewAllHealthScreeningPatients();
			}
			else if(ReloadInt==4)
			{
		    ViewAllNutritionPatients();
			}
			else if(ReloadInt==5)
			{
			ViewAllHeartClinicPatients();
			}
			else
			{
			
			}

	
			
			
			closepopupdiv();
			opener.location.reload(); 
			//window.opener.history.go(-1) ;
			//ViewDentalPatients();
			
			//document.getElementById('main_window').innerHTML=responseText; 
		}
		
		
	
		myRequest.update();  
		
			
	}
	else
	{
		
	alert_box(Error);	
	}
	

}

/*function GetCheckBoxValueCommonChargeSheet(CheckBoxName)
{
	var MyCheckbox = document.getElementsByName(CheckBoxName);
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
		else
		{
			
		}
	}
	return Ele_Value;
}
function LoadPatientChargeSheet()
{
	var PatientId = GetCheckBoxValueCommonChargeSheet('PatientId');
	var myRequest=new ajaxObject('../ChargeSheet/Application/ViewChargeSheetWindows.php?patientId='+PatientId+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('div_ViewPatientChargeSheet').innerHTML=responseText; 
		ShowPopUp('div_ViewPatientChargeSheet','window_ViewPatientChargeSheet');
		ShowChargeSheetSummary(PatientId);
	}
	myRequest.update();
}*/




/*function ViewPatientChargeSheet()

{
var div=document.getElementById('popup_div');
    //var Episode=document.getElementById('episodenum').value;
	var patients=document.getElementsByName('episode_id');
	
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
			   
			  
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
						var myRequest = new ajaxObject('../Main/Application/Ambulatories/ViewPatientChargeSheet.php?PatientId='+patientid+'&EpisodeId='+patients[i].value+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	
	
	
	
}*/

function AddItemToChargeSheet()

{
	
    var div=document.getElementById('popup_div');
    //var Episode=document.getElementById('episodenum').value;
	var patients=document.getElementsByName('episode_id');
	
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
			   
			  
			   var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			   		
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/ChargeSheet.php?PatientId='+patientid+'&EpisodeId='+patients[i].value+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	
	
	
}

function AddItemToPatientChargeSheet(Patient,Episode)

{
	
    var div=document.getElementById('popup_div');
   
			
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddItemToChargeSheet.php?PatientId='+Patient+'&EpisodeId='+Episode+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		
	
}

function AddProcedureToPatientChargeSheet(Patient,Episode)

{
	
    var div=document.getElementById('popup_div');
   
			
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddProcedureToChargeSheet.php?PatientId='+Patient+'&EpisodeId='+Episode+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		
	
}

function AddServiceToPatientChargeSheet(Patient,Episode)

{
	
    var div=document.getElementById('popup_div');
   
			
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddServiceToChargeSheet.php?PatientId='+Patient+'&EpisodeId='+Episode+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='900px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		
	
}







function ViewInsuranceDetails(patId)
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('episode_id');

				var myRequest = new ajaxObject('../Patients/Application/ShowInsuranceDetails.php?PatId='+patId+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='auto';
				div.style.height='auto';
					
				}
				myRequest.update();  
	
}


/*function ViewPatientDetails()
{
	alert("patients");
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('patientid');
	alert (patients);
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
				
				 var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
				var myRequest = new ajaxObject('../Patients/Application/ShowPatientDetails.php?PatId='+patientid+'&');
				
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='700px';
				div.style.height='auto';
				
				
				}
				myRequest.update();  
		  }
	 }
}
*/
function AddEpisode()
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('patientid');
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
				var docitem='treatpatientid';
				patientid=document.getElementById(docitem+i).value;
				
				//var patientid=document.getElementById('treatpatientid').value;

				var myRequest = new ajaxObject('../Patients/Application/ShowEpisodes.php?PatId='+patientid+'&');
				var selectedPatient=patientid;
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='auto';
				div.style.height='auto';
				DisplayEpisodes(selectedPatient);
				
				}
				myRequest.update();  
		  }
	 }
}



function ShowPatientCard()
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('patientid');
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
				 var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
				//../../Patients/Application/EditPatient.php
				var myRequest = new ajaxObject('../Patients/Application/ViewPatientCard.php?PatId='+patientid+'&');
				var selectedPatient=patientid;
				myRequest.callback=function(responseText)
				{
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='20%';
				div.style.top = '10%';
				div.style.width='auto';
				div.style.height='auto';
				DisplayEpisodes(selectedPatient);
				
				}
				myRequest.update();  
		  }
	 }
}

function checkifvalueisnumber()
{

		var Quantity = document.getElementById('dentalpatientchargesheetquantity').value;	
	
		
		if(number_validation(Quantity)==false)
		{
		alert('Quantity must be a number');	
		document.getElementById('dentalpatientchargesheetquantity').value=1;	
		}
		else
		{
		
		
		}
			
		document.getElementById('itemstotalunitcost').value=document.getElementById('dentalpatientchargesheetquantity').value*document.getElementById('itemunitcost').value;	
				
	
}

function SaveCharge()

{
	    var Error;
	    Error = "The following field(s) have a problem.\n";
		var ErrorCounter = 0;
		
		if(document.getElementById('itemsname').value == '')
			{
				Error += '-Please select the item to Charge.\n';
				ErrorCounter +=1;
				
			}
		if(document.getElementById('dentalpatientchargesheetquantity').value == '')
			{
				Error += '-Please enter quantity.\n';
				ErrorCounter +=1;
				
		    }

			
					
		if (ErrorCounter==0)	
			{
				
			
			ExecSaveCharge();
			
					
			}
			else
			{
				alert(Error);	
			}	
}
					
function ExecSaveCharge()
{
	
					var PatientId=document.getElementById('dentalpatientchargesheetpid').value;
					var EpisodeId=document.getElementById('dentalpatientchargesheeteid').value;
					var Procedure=document.getElementById('itemsname').value;
					var Department=document.getElementById('departmentforcharging').value;
					var Staff=document.getElementById('dentalpatientchargesheetdentist').value;
					var Quantity=document.getElementById('dentalpatientchargesheetquantity').value;
					
					/*var StartTime=document.getElementById('dentalpatientchargesheetstarttime').value;
					var EndTime=document.getElementById('dentalpatientchargesheetendtime').value;*/
					
					var myRequest=new ajaxObject('../Main/Application/Ambulatories/AddCharge.php?Procedure='+Procedure+'&PatientId='+PatientId+'&Quantity='+Quantity+'&Department='+Department+'&EpisodeId='+EpisodeId+'&Staff='+Staff+'&');
					
					myRequest.callback=function(responseText)
					{
							alert_box(responseText);
							
							AddItemToPatientChargeSheet(PatientId,EpisodeId);
							
					}
					myRequest.update();	
		  
	
}


function AddProcCharge()

{
	    var Error;
	    Error = "The following field(s) have a problem.\n";
		var ErrorCounter = 0;
		
		if(document.getElementById('procname').value == '')
			{
				Error += '-Please select the procedure to Charge.\n';
				ErrorCounter +=1;
				
			}
		if(document.getElementById('dentalpatientchargesheetprocquantity').value == '')
			{
				Error += '-Please set the number of times the procedure is performed.\n';
				ErrorCounter +=1;
				
		    }
					
					
		if (ErrorCounter==0)	
			{
			ExecAddProcCharge();
					
			}
			else
			{
				alert(Error);	
			}	
}
					
function ExecAddProcCharge()
{
	
					var PatientId=document.getElementById('dentalpatientchargesheetpid').value;
					var EpisodeId=document.getElementById('dentalpatientchargesheeteid').value;
					var Procedure=document.getElementById('procname').value;
					var Department=document.getElementById('departmentforcharging').value;
					var Staff=document.getElementById('dentalpatientchargesheetdentist').value;
					var Quantity=document.getElementById('dentalpatientchargesheetprocquantity').value;
					var Type='Procedure';
				
					/*var StartTime=document.getElementById('dentalpatientchargesheetstarttime').value;
					var EndTime=document.getElementById('dentalpatientchargesheetendtime').value;*/
					
					var myRequest=new ajaxObject('../Main/Application/Ambulatories/AddProcCharge.php?Procedure='+Procedure+'&PatientId='+PatientId+'&Quantity='+Quantity+'&Department='+Department+'&Type='+Type+'&EpisodeId='+EpisodeId+'&Staff='+Staff+'&');
					
					myRequest.callback=function(responseText)
					{
							alert_box(responseText);
							AddProcedureToPatientChargeSheet(PatientId,EpisodeId);
							
					}
					myRequest.update();	
		
	
}


function AddServiceCharge()

{
	    var Error;
	    Error = "The following field(s) have a problem.\n";
		var ErrorCounter = 0;
		
		if(document.getElementById('servname').value == '')
			{
				Error += '-Please select the Service to Charge.\n';
				ErrorCounter +=1;
				
			}
		if(document.getElementById('dentalpatientchargesheetprocquantity').value == '')
			{
				Error += '-Please set the number of times the Service is performed.<br>';
				ErrorCounter +=1;
				
		    }
		if(document.getElementById('externaldoctor').disabled==false)
			{
				if(document.getElementById('externaldoctor').value == '')
				{
				Error += 'You want to charge a doctor related service but you havent selected the doctor related to this charge.<br>';
				ErrorCounter +=1;
				}
				else
				{
				var DoctorRelated=1;
				var DoctorToPay=document.getElementById('doctorid').value;
					
				}
		    }
					
			else
			{
			
			}
		if (ErrorCounter==0)	
			{
			ExecAddServiceCharge();
					
			}
			else
			{
				alert_box(Error);	
			}	
}
					
function ExecAddServiceCharge()
{
	
					var PatientId=document.getElementById('dentalpatientchargesheetpid').value;
					var EpisodeId=document.getElementById('dentalpatientchargesheeteid').value;
					var ServiceId=document.getElementById('servid').value;
					var Department=document.getElementById('departmentforcharging').value;
					var Staff=document.getElementById('dentalpatientchargesheetdentist').value;
					var Quantity=document.getElementById('dentalpatientchargesheetprocquantity').value;
	
					var Type='Service';
					
					if(document.getElementById('externaldoctor').disabled==false)
					{
					var DoctorRelated=1;
				var DoctorToPay=document.getElementById('doctorid').value;
					
						
					}
					else
					{
					var DoctorRelated=0;
			         var DoctorToPay=0;
	
					}

					
					/*var StartTime=document.getElementById('dentalpatientchargesheetstarttime').value;
					var EndTime=document.getElementById('dentalpatientchargesheetendtime').value;*/
					
					var myRequest=new ajaxObject('../Main/Application/Ambulatories/AddServiceCharge.php?ServiceId='+ServiceId+'&PatientId='+PatientId+'&Department='+Department+'&Quantity='+Quantity+'&DoctorRelated='+DoctorRelated+'&DoctorToPay='+DoctorToPay+'&Type='+Type+'&EpisodeId='+EpisodeId+'&Staff='+Staff+'&');
					
					myRequest.callback=function(responseText)
					{
							alert_box(responseText);
							AddServiceToPatientChargeSheet(PatientId,EpisodeId);
							
					}
					myRequest.update();	
		  
	
}







function loadchargediv()
{
	if(document.getElementById('whattochargeindentalchargesheet').value == 'item')
			{ 
	                var WhatToCharge=document.getElementById('whattochargeindentalchargesheet').value;
                    var myRequest=new ajaxObject('../Main/Application/Ambulatories/ChargeItem.php?WhatToCharge='+WhatToCharge+'&');
					myRequest.callback=function(responseText)
					{
							//alert_box(responseText);
					var div=document.getElementById('charge_div');
			
					div.innerHTML=responseText;
					
					div.style.left='20%';
					div.style.top = '10%';
					//div.style.width='700px';
					div.style.height='auto';
							
				
					
					
					if(div.style.display=='none' || div.style.display=='')
						
						{
		
						div.style.display='block';
						  
						}
					
					
					}
					
					myRequest.update();	
			}
			else if(document.getElementById('whattochargeindentalchargesheet').value=='procedure')
	             {
	                
					var WhatToCharge=document.getElementById('whattochargeindentalchargesheet').value;
                    var myRequest=new ajaxObject('../Main/Application/Ambulatories/ChargeProcedure.php?WhatToCharge='+WhatToCharge+'&');
					myRequest.callback=function(responseText)
					{
							//alert_box(responseText);
					    document.getElementById('charge_div').innerHTML=responseText;
					
						if(document.getElementById('charge_div').style.display=='none' || document.getElementById('charge_div').style.display=='')
						
						{
		
						document.getElementById('charge_div').style.display='block';
						  
						}
					
					}
					
					myRequest.update();	
				}
				else if(document.getElementById('whattochargeindentalchargesheet').value=='service')
	             {
	                
					var WhatToCharge=document.getElementById('whattochargeindentalchargesheet').value;
                    var myRequest=new ajaxObject('../Main/Application/Ambulatories/ChargeService.php?WhatToCharge='+WhatToCharge+'&');
					myRequest.callback=function(responseText)
					{
							//alert_box(responseText);
					    document.getElementById('charge_div').innerHTML=responseText;
					
						if(document.getElementById('charge_div').style.display=='none' || document.getElementById('charge_div').style.display=='')
						
						{
		
						document.getElementById('charge_div').style.display='block';
						  
						}
					
					}
					
					myRequest.update();	
				}
				
				
				
				
				else 
				{
			   	
				document.getElementById('charge_div').style.display='none';
					
				
					
				}
}





function checkifprocquantityisnumber()
		
		{
		
		var Quantity = document.getElementById('dentalpatientchargesheetprocquantity').value;	
	
		
		if(number_validation(Quantity)==false)
		{
		alert('Quantity must be a number');	
		document.getElementById('dentalpatientchargesheetprocquantity').value=1;	
		}
		else
		{
		
		
		}
			
		document.getElementById('proctotalunitcost').value=document.getElementById('dentalpatientchargesheetprocquantity').value*document.getElementById('procunitcost').value;	
			
			
		}
		


function checkifnumber()
		
		{
		
		var Quantity = document.getElementById('dentalpatientchargesheetquantity').value;	
	
		
		if(number_validation(Quantity)==false)
		{
		alert('Quantity must be a number');	
		document.getElementById('dentalpatientchargesheetquantity').value=1;	
		}
		else
		{
		
		
		}
			
		document.getElementById('itemstotalunitcost').value=document.getElementById('dentalpatientchargesheetquantity').value*document.getElementById('itemunitcost').value;	
			
			
		}
		



function PatientEpisodes()
{
	
	var patients=document.getElementsByName('episode_id');
	for(var i=0;i<=patients.length;i++)
		{
			if(patients[i].checked==true)
			{
				
				
				  var scheduleitem='patientscheduleid';	
				  var docitem='treatpatientid';
				  
				  selectedPatient=document.getElementById(docitem+i).value;
				  ScheduleId=document.getElementById(scheduleitem+i).value;
					
				  //var selectedPatient=patients[i].value;
				  showTheEpisodes(selectedPatient);
			}
	    }
}

function showTheEpisodes(selectedPatient)
{
	var div=document.getElementById('popup_div');
	var myRequest = new ajaxObject('../Patients/Application/ShowEpisodes.php?PatId='+selectedPatient+'&');
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
	DisplayEpisodes(selectedPatient);
	}
	myRequest.update();  
}
function DisplayEpisodes(patient)
{
	var myRequest = new ajaxObject('../Patients/Application/DisplayEpisodes.php?PatId='+patient+'&');		
	myRequest.callback=function(responseText)
	{
	   document.getElementById('showEpisodes').innerHTML=responseText;
	}
	myRequest.update()
}

function RegisterNewEpisode()
{
	var DateStart=document.getElementById('DateStart').value;
	var selectedPatient=document.getElementById('selectedPatient').value;
	var pname='../Patients/Application/SaveNewEpisode.php?DateStart='+DateStart+'&selectedPatient='+selectedPatient+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
			
			//alert_box("Kubaff");
		}
		else
		{
			 showTheEpisodes(selectedPatient);
		}
	}
	myRequest.update();
}

function EndLastEpisode()
{
	var selectedPatient=document.getElementById('selectedPatient').value;
	var pname='../Patients/Application/EndLastEpisode.php?selectedPatient='+selectedPatient+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			 showTheEpisodes(selectedPatient);
		}
	}
	myRequest.update();
}



function closecontainer()
{

document.getElementById('container').style.display = 'none';
}


function CheckSelected(Checkbox,msg)
		{	
		   // alert(Checkbox);
			var MyCheckbox = document.getElementsByName(Checkbox);	
			//alert(MyCheckbox.length);
			var Selected=0;
		    
			for(var i = 0; i <= MyCheckbox.length; i++)
			  {
				//alert(Selected);
				if(MyCheckbox[i].checked == true)
				{
					SelectedValue = MyCheckbox[i].value;
					Selected=Selected+1;
					
					
				}
				
			    if(i<(MyCheckbox.length))
				{
					if(Selected>1)
					{
					alert_box(msg); 					
					MyCheckbox[i].checked= false
					}
					else
					{
						
					}
				
			  }
				
				
			}
			
		}
				
		