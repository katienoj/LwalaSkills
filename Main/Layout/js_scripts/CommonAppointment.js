function CalculateDate()
{
	var StartDate = document.getElementById('startdate').value;
	var NoWeeks = document.getElementById('weekno').value;
	
	var myRequest=new ajaxObject('../Appointment/Application/CalculateEndDate.php?StartDate='+StartDate+'&NoWeeks='+NoWeeks+'&');
	myRequest.callback=function(responseText)
	{
		var EndDate = responseText;
		
		document.getElementById('enddate').value = EndDate;	
		
	}
	myRequest.update();
	
}
/*This will hide the define Repetitive field*/
function HideOrShowRepetitiveField()
{
	var RepetitiveCheckBox = document.getElementById('repetitive');
	if(RepetitiveCheckBox.checked == true)
	{
		document.getElementById('weekno').disabled = false;
	}
	else
	{
		document.getElementById('weekno').disabled = true;
	}
}
function ViewPatients()
{
	document.getElementById('SelectPatient').style.display = "block";	
	var myRequest=new ajaxObject("../Appointment/Application/ShowPatients.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('SelectPatient').innerHTML=responseText; 
	ShowPatientSearchForm();
	}
	myRequest.update();
	
}
function ShowPatientSearchForm()
{
	document.getElementById('SearchPatientInfo').style.display = "block";
	var myRequest=new ajaxObject("../Appointment/Application/PatientSearchDetails.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('SearchPatientInfo').innerHTML=responseText; 
		if(document.getElementById('SearchPatientInfo').style.display=='none' || document.getElementById('SearchPatientInfo').style.display=='')
		{
			
		document.getElementById('SearchPatientInfo').style.display='block';

		}
	}
	myRequest.update();
}
function SearchPatient()
{
	var SurName = document.getElementById('surname').value;
	var MiddleName = document.getElementById('middlename').value;
	var FirstName = document.getElementById('firstname').value;
	var Gender =document.getElementById('gender').value;
	var PatientNo =document.getElementById('patientNo').value;
	var RegDate =document.getElementById('regDate').value;
	if (SurName =="" && MiddleName =="" && FirstName =="" && Gender =="" && PatientNo =="" && RegDate =="")
	{
		alert("Please fill one or more fields to enable search");
		var values =('../Appointment/Application/SearchPatient.php?SurName='+SurName+'&MiddleName='+MiddleName+'&FirstName='+FirstName+'&Gender='+Gender+'&PatientNo='+PatientNo+'&RegDate='+RegDate+'&'+RegDate+'&');
	
		var myRequest=new ajaxObject(values);
		myRequest.callback=function(responseText)
		{
			document.getElementById('SelectPatient').innerHTML=responseText; 
		}
		myRequest.update();
	}
	else
	{
		var values =('../Appointment/Application/SearchPatient.php?SurName='+SurName+'&MiddleName='+MiddleName+'&FirstName='+FirstName+'&Gender='+Gender+'&PatientNo='+PatientNo+'&RegDate='+RegDate+'&'+RegDate+'&');
		
		var myRequest=new ajaxObject(values);
		myRequest.callback=function(responseText)
		{
			document.getElementById('SelectPatient').innerHTML=responseText; 
		}
		myRequest.update();
	}
}
function GetPatientDetails()
{
	var MyCheckbox = document.getElementsByName('patient_id');
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
	var myRequest=new ajaxObject('../Appointment/Application/GetPatientDetails.php?PatientId='+Ele_Value+'&');
	myRequest.callback=function(responseText)
	{
		
		var PatientRecord = responseText;
		var SplitRecord = PatientRecord.split("$");
		
		document.getElementById('patientnumber').value = SplitRecord[0];
		document.getElementById('patientname').value = SplitRecord[1];
		document.getElementById('SelectPatient').style.display = "none";		
	}
	myRequest.update();
}

function SaveAddAppointment()
{
	var DoctorName = document.getElementById('doctorname').value;
	var DoctorNo = document.getElementById('doctornumber').value;
	var ClinicNo = document.getElementById('clinicno').value;
	var PatientName = document.getElementById('patientname').value;
	var PatientNo = document.getElementById('patientnumber').value;
	var Notes = document.getElementById('notes').value;
	var Emergency = document.getElementById('emergency').value;
	var Email = document.getElementById('email').value;
	var SMS = document.getElementById('sms').value;
	var RoomId = document.getElementById('roomno').value;
	var Rept = document.getElementById('repetitive');
	var Repetitive = document.getElementById('repetitive').value;
	var StartDate = document.getElementById('startdate').value;
	var StartTime = document.getElementById('starttime').value;
	//gets the selected start and end date for purposes of refreshing on the interface part
	var Start_Date = document.getElementById('start_date').value;
	var End_Date = document.getElementById('end_date').value;
	var Service = document.getElementById('serviceRequested').value;
	var Localization = "None";
	var hour = document.getElementById('hour').value;
	var minute = document.getElementById('minute').value;
	var timeType = document.getElementById('timeType').value;
	
	
	//if repetitive is checked then get the end date of repetition, time and date
	var Error = "The following field(s) need to be attended to.\n";
	var ErrorCounter = 0;	
		
	if( PatientName == '')
	{
		Error += '-Please enter the patient name.\n';
		ErrorCounter +=1;
	}
	//if the clinic id is 5 then get the localization value
	if(ClinicNo==5)
	{
	var Localization = document.getElementById('localization').value;
	}
	
	if((document.getElementById('emergency')).checked == true)
	{
		Emergency = 1;
	}
	if((document.getElementById('email')).checked == true)
	{
		Email = 1;
	}
	if((document.getElementById('sms')).checked == true)
	{
		SMS = 1;
	}
	if(Rept.checked == true)
	{
	var Repetitive =1;
	var EndDate = document.getElementById('enddate').value;
	
	if((ErrorCounter == 0)) 
		{	
			
			var values = ('../Appointment/Application/SaveAppointment.php?DoctorName='+DoctorName+'&DoctorNo='+DoctorNo+'&ClinicNo='+ClinicNo+'&PatientName='+PatientName+'&PatientNo='+PatientNo+'&Notes='+Notes+'&Emergency='+Emergency+'&Email='+Email+'&SMS='+SMS+'&Repetitive='+Repetitive+'&EndDate='+EndDate+'&StartDate='+StartDate+'&StartTime='+StartTime+'&RoomId='+RoomId+'&Service='+Service+'&Localization='+Localization+'&Hour='+hour+'&Minute='+minute+'&TimeType='+timeType+'&');
				var myRequest=new ajaxObject(values);
				myRequest.callback=function(responseText)
				{
					if(isNaN(responseText))
					{
						alert(responseText);
					}
					else
					{
						alert("Appointment saved successfully");
						closepopupdiv();
						ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date,RoomId);
					}
				}
				myRequest.update();
				}
		else
		{
			alert(Error);
		}
	}
else 
{	
		if((ErrorCounter == 0) )
		{	
		
		var values =('../Appointment/Application/SaveAppointment.php?DoctorName='+DoctorName+'&DoctorNo='+DoctorNo+'&ClinicNo='+ClinicNo+'&PatientName='+PatientName+'&PatientNo='+PatientNo+'&Notes='+Notes+'&Emergency='+Emergency+'&Email='+Email+'&SMS='+SMS+'&Repetitive='+Repetitive+'&StartDate='+StartDate+'&StartTime='+StartTime+'&RoomId='+RoomId+'&Service='+Service+'&Localization='+Localization+'&Hour='+hour+'&Minute='+minute+'&TimeType='+timeType+'&');
			var myRequest=new ajaxObject(values);
			myRequest.callback=function(responseText)
			{
				if(isNaN(responseText))
				{
					alert(responseText);
				}
				else
				{
					alert("Appointment saved successfully");
					closepopupdiv();
					ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date,RoomId);
				}
			}
			myRequest.update();
		}
		else
		{
			alert(Error);
		}

	}
}
function SaveReferralAddAppointment()
{
	var DoctorName = document.getElementById('doctorname').value;
	var DoctorNo = document.getElementById('doctornumber').value;
	var ClinicNo = document.getElementById('clinicno').value;
	var PatientName = document.getElementById('patientname').value;
	var PatientNo = document.getElementById('patientnumber').value;
	var Notes = document.getElementById('notes').value;
	var Emergency = document.getElementById('emergency').value;
	var Email = document.getElementById('email').value;
	var SMS = document.getElementById('sms').value;
	var RoomId = document.getElementById('roomno').value;
	var Rept = document.getElementById('repetitive');
	var Repetitive = document.getElementById('repetitive').value;
	var StartDate = document.getElementById('startdate').value;
	var StartTime = document.getElementById('starttime').value;
	//gets the selected start and end date for purposes of refreshing on the interface part
	var Start_Date = document.getElementById('start_date').value;
	var End_Date = document.getElementById('end_date').value;
	var Service = document.getElementById('serviceRequested').value;
	var Localization = "None";
	var hour = document.getElementById('hour').value;
	var minute = document.getElementById('minute').value;
	var timeType = document.getElementById('timeType').value;
	var ReferralId = document.getElementById('ReferralId').value;
	//if repetitive is checked then get the end date of repetition, time and date
	
	var Error = "The following field(s) need to be attended to.\n";
	var ErrorCounter = 0;	
		
	if( PatientName == '')
	{
		Error += '-Please enter the patient name.\n';
		ErrorCounter +=1;
	}
	//if the clinic id is 5 then get the localization value
	if(ClinicNo==5)
	{
	var Localization = document.getElementById('localization').value;
	}
	
	if((document.getElementById('emergency')).checked == true)
	{
		Emergency = 1;
	}
	if((document.getElementById('email')).checked == true)
	{
		Email = 1;
	}
	if((document.getElementById('sms')).checked == true)
	{
		SMS = 1;
	}
	if(Rept.checked == true)
	{
	var Repetitive =1;
	var EndDate = document.getElementById('enddate').value;
	
	if((ErrorCounter == 0)) 
		{	
			
			var values = ('../Appointment/Application/SaveReferralAppointment.php?DoctorName='+DoctorName+'&DoctorNo='+DoctorNo+'&ClinicNo='+ClinicNo+'&PatientName='+PatientName+'&PatientNo='+PatientNo+'&Notes='+Notes+'&Emergency='+Emergency+'&Email='+Email+'&SMS='+SMS+'&Repetitive='+Repetitive+'&EndDate='+EndDate+'&StartDate='+StartDate+'&StartTime='+StartTime+'&RoomId='+RoomId+'&Service='+Service+'&Localization='+Localization+'&Hour='+hour+'&Minute='+minute+'&TimeType='+timeType+'&ReferralId='+ReferralId+'&');
				var myRequest=new ajaxObject(values);
				myRequest.callback=function(responseText)
				{
					if(isNaN(responseText))
					{
						alert(responseText);
					}
					else
					{
						alert("Appointment saved successfully");
						closepopupdiv();
						ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date,RoomId);
					}
				}
				myRequest.update();
				}
		else
		{
			alert(Error);
		}
	}
else 
{	
		if((ErrorCounter == 0) )
		{	
		
		var values =('../Appointment/Application/SaveReferralAppointment.php?DoctorName='+DoctorName+'&DoctorNo='+DoctorNo+'&ClinicNo='+ClinicNo+'&PatientName='+PatientName+'&PatientNo='+PatientNo+'&Notes='+Notes+'&Emergency='+Emergency+'&Email='+Email+'&SMS='+SMS+'&Repetitive='+Repetitive+'&StartDate='+StartDate+'&StartTime='+StartTime+'&RoomId='+RoomId+'&Service='+Service+'&Localization='+Localization+'&Hour='+hour+'&Minute='+minute+'&TimeType='+timeType+'&ReferralId='+ReferralId+'&');
			var myRequest=new ajaxObject(values);
			myRequest.callback=function(responseText)
			{
				if(isNaN(responseText))
				{
					alert(responseText);
				}
				else
				{
					alert("Appointment saved successfully");
					closepopupdiv();
					ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date,RoomId);
				}
			}
			myRequest.update();
		}
		else
		{
			alert(Error);
		}

	}
}
function SelectAppointmentDate()
{
var ClinicId = document.getElementsByName('clinic');
	for(i = 0; i <= ClinicId.length; i++)
	{
		if(ClinicId[i].checked == true)
			{
				Ele_Value = ClinicId[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var div=document.getElementById('popup_div');
		var myRequest=new ajaxObject('../Appointment/Application/SelectDates.php?ClinicId='+Ele_Value+'&');
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
	else
	{
		alert('Please select a Patient from the list.');
	}
}
function SelectDates()
{
var ClinicId = document.getElementsByName('selected_clinic');
	for(i = 0; i <= ClinicId.length; i++)
	{
		if(ClinicId[i].checked == true)
			{
				Ele_Value = ClinicId[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var SplitRecord = Ele_Value.split("-");
		var ClinicId = SplitRecord[0];
		var PatientId = SplitRecord[1];
		var ReferralId = SplitRecord[2];
		
		var div=document.getElementById('popup_div');
		var myRequest=new ajaxObject('../Appointment/Application/SelectReferralDates.php?ClinicId='+ClinicId+'&PatientId='+PatientId+'&ReferralId='+ReferralId+'&');
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
	else
	{
		alert('Please select a Patient from the list.');
	}
}
function ViewRoomSelectDates()
{
	var ClinicId = document.getElementsByName('clinic');
	for(i = 0; i <= ClinicId.length; i++)
	{
		if(ClinicId[i].checked == true)
			{
				Ele_Value = ClinicId[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var div=document.getElementById('popup_div');
		var myRequest=new ajaxObject('../Appointment/Application/ViewRoomSelectDates.php?ClinicId='+Ele_Value+'&');
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
	else
	{
		alert('Please select a Patient from the list.');
	}
}
function ShowSelectDates(Ele_Value)
{
	/*var ClinicId = document.getElementsByName('clinic');
	for(i = 0; i <= ClinicId.length; i++)
	{
		if(ClinicId[i].checked == true)
			{
				Ele_Value = ClinicId[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{*/
		var div=document.getElementById('popup_div');
		var myRequest=new ajaxObject('../Appointment/Application/SelectDates.php?ClinicId='+Ele_Value+'&');
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
	/*}
	else
	{
		alert('Please select a Patient from the list.');
	}*/
}
function ShowRoomSchedule(ClinicId)
{
	//var ClinicId = document.getElementById('clinic_id').value;
	var StartDate = document.getElementById('start_date').value;
	var EndDate = document.getElementById('end_date').value;
	var RoomId = document.getElementById('room_id').value;
	
	var Error = "The following field(s) need to be attended to.\n";
	var ErrorCounter = 0;	
	
	if( StartDate == '')
	{
		Error += '-Please enter the Start date.\n';
		ErrorCounter +=1;
	}
	if( RoomId == '')
	{
		Error += '-Please select a Room.\n';
		ErrorCounter +=1;
	}
	if(ErrorCounter == 0) 
	{	
		var pname = ('../Appointment/Application/ViewRoomSchedule.php?ClinicId='+ClinicId+'&StartDate='+StartDate+'&EndDate='+EndDate+'&RoomId='+RoomId+'&');
		
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
				 $(document).ready(
        function() {
         $('#service_table').DataTable(
          {
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, 100, -1 ],
        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'csv', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'pdf', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'print', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'copy', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

]
});
       
        });
			document.getElementById('main_window').innerHTML=responseText; 
			closepopupdiv();
		}
		myRequest.update();
		
	}
	else
	{
		alert(Error);
	}
}
function ShowDates(ClinicId)
{
	
	//var ClinicId = document.getElementById('clinic_id').value;
	var StartDate = document.getElementById('start_date').value;
	var EndDate = document.getElementById('end_date').value;
	var DoctorId = document.getElementById('doctor').value;
	
	var Error = "The following field(s) need to be attended to.\n";
	var ErrorCounter = 0;	
	
	if( StartDate == '')
	{
		Error += '-Please enter the Start date.\n';
		ErrorCounter +=1;
	}
	if( DoctorId == '')
	{
		Error += '-Please select a doctor.\n';
		ErrorCounter +=1;
	}
	if(ErrorCounter == 0) 
	{	
		var pname = ('../Appointment/Application/ViewSchedule.php?ClinicId='+ClinicId+'&StartDate='+StartDate+'&EndDate='+EndDate+'&DoctorId='+DoctorId+'&');
		
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
				 $(document).ready(
        function() {
         $('#service_table').DataTable(
          {
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, 100, -1 ],
        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'csv', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'pdf', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'print', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'copy', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

]
});
       
        });
			document.getElementById('main_window').innerHTML=responseText; 
			closepopupdiv();
		}
		myRequest.update();
		
	}
	else
	{
		alert(Error);
	}

	
}
function ShowReferralDates(ClinicId,PatientId,ReferralId)
{
		//var ClinicId = document.getElementById('clinic_id').value;
	var StartDate = document.getElementById('start_date').value;
	var DoctorId = document.getElementById('doctor').value;
	
	var Error = "The following field(s) need to be attended to.\n";
	var ErrorCounter = 0;	
	
	if( StartDate == '')
	{
		Error += '-Please enter the Start date.\n';
		ErrorCounter +=1;
	}
	if( DoctorId == '')
	{
		Error += '-Please select a doctor.\n';
		ErrorCounter +=1;
	}
	if(ErrorCounter == 0) 
	{	
		var pname = ('../Appointment/Application/ViewReferralSchedule.php?ClinicId='+ClinicId+'&StartDate='+StartDate+'&DoctorId='+DoctorId+'&PatientId='+PatientId+'&ReferralId='+ReferralId+'&');
		
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
				 $(document).ready(
        function() {
         $('#service_table').DataTable(
          {
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, 100, -1 ],
        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'csv', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'pdf', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'print', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'copy', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

]
});
       
        });
			document.getElementById('main_window').innerHTML=responseText; 
			closepopupdiv();
		}
		myRequest.update();
		
	}
	else
	{
		alert(Error);
	}

}
function ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date)
{
	var pname = ('../Appointment/Application/ViewSchedule.php?ClinicId='+ClinicNo+'&StartDate='+Start_Date+'&EndDate='+End_Date+'&DoctorId='+DoctorNo+'&');
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
				 $(document).ready(
        function() {
         $('#service_table').DataTable(
          {
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, 100, -1 ],
        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'csv', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'pdf', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'print', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'copy', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

]
});
       
        });
			document.getElementById('main_window').innerHTML=responseText; 
			closepopupdiv();
		}
		myRequest.update();
			
}
//show an appointment

function Schedule(tomorrow,set_time)
{
	var ClinicId = document.getElementById('ClinicId').value;
	var DoctorId = document.getElementById('DoctorId').value;
	var FirstDate = document.getElementById('FirstDate').value;
	var LastDate = document.getElementById('LastDate').value;
	
	var div=document.getElementById('popup_div');
	var myRequest=new ajaxObject('../Appointment/Application/AddAppointment.php?tomorrow='+tomorrow+'&set_time='+set_time+'&ClinicId='+ClinicId+'&DoctorId='+DoctorId+'&FirstDate='+FirstDate+'&LastDate='+LastDate+'&');
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top='10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.display='block';
	}
	myRequest.update();
}
function ScheduleReferral(tomorrow,set_time)
{
	var PatientId = document.getElementById('PatientId').value;
	var ClinicId = document.getElementById('ClinicId').value;
	var DoctorId = document.getElementById('DoctorId').value;
	var FirstDate = document.getElementById('FirstDate').value;
	var LastDate = document.getElementById('LastDate').value;
	var ReferralId = document.getElementById('ReferralId').value;
	
	var div=document.getElementById('popup_div');
	var myRequest=new ajaxObject('../Appointment/Application/AddReferralAppointment.php?tomorrow='+tomorrow+'&set_time='+set_time+'&ClinicId='+ClinicId+'&DoctorId='+DoctorId+'&FirstDate='+FirstDate+'&LastDate='+LastDate+'&PatientId='+PatientId+'&ReferralId='+ReferralId+'&');
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top='10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.display='block';
	}
	myRequest.update();
}
//show appointment details
function ViewAppointmentDetails(ScheduleId)
{
	var div=document.getElementById('popup_div');
	var myRequest=new ajaxObject('../Appointment/Application/AppointmentDetails.php?ScheduleId='+ScheduleId+'&');
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top='10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.display='block';
		
	}
	myRequest.update();
}
function PostponeAppointment()
{
	var ClinicId = document.getElementById('ClinicId').value;
	var DoctorId = document.getElementById('DoctorId').value;
	var FirstDate = document.getElementById('FirstDate').value;
	var LastDate = document.getElementById('LastDate').value;
	var ScheduleId = document.getElementsByName('scheduleId');
	for(i = 0; i <= ScheduleId.length; i++)
	{
		if(ScheduleId[i].checked == true)
			{
				Ele_Value = ScheduleId[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var div=document.getElementById('popup_div');
		var myRequest=new ajaxObject('../Appointment/Application/PostponeAppointment.php?Id='+Ele_Value+'&ClinicId='+ClinicId+'&DoctorId='+DoctorId+'&FirstDate='+FirstDate+'&LastDate='+LastDate+'&');
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
	else
	{
		alert('Please select a Patient from the list.');
	}
}

function SavePostponeAppointment()
{
	var ScheduleId = document.getElementById('scheduleId').value;
	var StartDate = document.getElementById('startdate').value;
	var Rept = document.getElementById('repetitive');
	var Repetitive = document.getElementById('repetitive').value;
	var StartTime = document.getElementById('starttime').value;
	var Start_Date = document.getElementById('start_date').value;
	var End_Date = document.getElementById('end_date').value;
	var DoctorNo = document.getElementById('DoctorId').value;
	var ClinicNo = document.getElementById('ClinicId').value;
	
	if(Rept.checked == true)
	{
	var Repetitive =1;
	var EndDate = document.getElementById('enddate').value;
		
	var values = ('../Appointment/Application/SavePostponeAppointment.php?ScheduleId='+ScheduleId+'&Repetitive='+Repetitive+'&EndDate='+EndDate+'&StartDate='+StartDate+'&StartTime='+StartTime+'&');
	var myRequest=new ajaxObject(values);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert('Appointment postponed to '+StartDate+' '+StartTime+' successfully');
				closepopupdiv();
				ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date);
			}
		}
		myRequest.update();
	}
	else 
	{ //if repetitive has not been checked then alter the start date and start time
	var values = ('../Appointment/Application/SavePostponeAppointment.php?ScheduleId='+ScheduleId+'&Repetitive='+Repetitive+'&StartDate='+StartDate+'&StartTime='+StartTime+'&');
	var myRequest=new ajaxObject(values);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert('Appointment postponed to '+StartDate+' '+StartTime+' successfully');
				closepopupdiv();
				ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date);
			}
		}
		myRequest.update();
	}
	
}
//cancel an appointment
function CancelAppointment()
{
	var Start_Date = document.getElementById('start_date').value;
	var End_Date = document.getElementById('end_date').value;
	var DoctorNo = document.getElementById('DoctorId').value;
	var ClinicNo = document.getElementById('ClinicId').value;
	var ScheduleId = document.getElementsByName('scheduleId');
	for(i = 0; i <= ScheduleId.length; i++)
	{
		if(ScheduleId[i].checked == true)
			{
				Ele_Value = ScheduleId[i].value;
				break;
				return Ele_Value;
			}
	}
	//check if value is null
	if(Ele_Value != '')
	{
		var cancel=confirm("Are you sure you want to cancel this appointment?");
	 if (cancel==true)
	  {
	  	var myRequest=new ajaxObject('../Appointment/Application/CancelAppointment.php?ScheduleId='+Ele_Value+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert("Appointment has been cancelled");
				ShowUpdatedDates(ClinicNo,DoctorNo,Start_Date,End_Date);
			} 
		}
		myRequest.update();
	  }
	else
	  {
		  //return to schedule 
		 closepopupdiv();
	  	
	  }
	}
			
}
function ViewAvailableRooms()
{
	document.getElementById('SelectRoom').style.display = "block";	
	var ClinicId = document.getElementById('clinicno').value;
	var StartDate = document.getElementById('startdate').value;
	var StartTime = document.getElementById('starttime').value;
	var myRequest=new ajaxObject('../Appointment/Application/AvailableRooms.php?ClinicId='+ClinicId+'&StartDate='+StartDate+'&StartTime='+StartTime+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('SelectRoom').innerHTML=responseText; 
	ShowPatientSearchForm();
	}
	myRequest.update();
}
function GetRoomDetails(RoomId)
{
	/*var MyCheckbox = document.getElementsByName('room');
	var Ele_Value;
	for(i = 0; i <= MyCheckbox.length; i++)
	{
		if(MyCheckbox[i].checked == true)
		{
			Ele_Value = MyCheckbox[i].value;
			break;			
			return Ele_Value;
		}
	}	*/
	alert(RoomId);
	var myRequest=new ajaxObject('../Appointment/Application/GetRoomDetails.php?RoomId='+RoomId+'&');
	myRequest.callback=function(responseText)
	{
		
		var AvailableRoom = responseText;
		var SplitRecord = AvailableRoom.split("$");
		
		document.getElementById('roomno').value = SplitRecord[0];
		document.getElementById('roomname').value = SplitRecord[1];
		document.getElementById('SelectRoom').style.display = "none";		
	}
	myRequest.update();
}
function ViewReferrals()
{
	var myRequest=new ajaxObject("../Appointment/Application/Referrals/ViewReferralPatients.php");
	myRequest.callback=function(responseText)
	{
			 $(document).ready(
        function() {
         $('#service_table').DataTable(
          {
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, 100, -1 ],
        [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'csv', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'pdf', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },
    {
        extend: 'print', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'copy', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    },

    {
        extend: 'pageLength', 
        exportOptions: {
            columns: ':gt(0)' 
        }
    }
    

]
});
       
        });
		
			document.getElementById('main_window').innerHTML=responseText; 
	ShowPatientSearchForm();
	}
	myRequest.update();
	
}