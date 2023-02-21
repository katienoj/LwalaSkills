
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
	var dpatients=document.getElementsByName('episode_id');
	
	for(var i=0;i<=dpatients.length;i++)
		{
			if(dpatients[i].checked==true)
			{
				
			 var docitem='treatpatientid';
			  
			   patientid=document.getElementById(docitem+i).value;
			
				var myRequest = new ajaxObject('Application/ReferPatientForm.php?PatientId='+patientid+'&EpisodeId='+dpatients[i].value+'&');
				
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
				Error += '-Please select the Waiting room to send the patient to.\n';
				ErrorCounter +=1;
				
			}
		
			
	if(document.getElementById('referfromdentaldocnotes').value == '')
			{
				Error += '-Please enter the referal notes.\n';
				ErrorCounter +=1;
				
			}		
	
	
	if(ErrorCounter==0)
	
	{
	var Notes=document.getElementById('referfromdentaldocnotes').value;
	var WaitingRoom=document.getElementById('referfromdentaldep').value;
	var EpisodeId=document.getElementById('dentalpatientrefereid').value;
	var PatientId=document.getElementById('dentalpatientreferpid').value;
	
	var div=document.getElementById('popup_div');
	alert(EpisodeId);
	
	var myRequest=new ajaxObject('Application/ReferDentalPatient.php?EpisodeId='+EpisodeId+'&Notes='+Notes+'&WaitingRoom='+WaitingRoom+'&PatientId='+PatientId+'&');

		myRequest.callback=function(responseText)
		{
			alert(responseText);
			closepopupdiv();
			ViewDentalPatients();
			
			//document.getElementById('main_window').innerHTML=responseText; 
		}
		
		
	
		myRequest.update();  
		
			
	}
	else
	{
		
	alert(Error);	
	}
	

}




function ViewPatientChargeSheet()

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
				div.style.width='700px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		  }
	 }	
	
	
	
}

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
			   		
				var myRequest = new ajaxObject('../Main/Application/Ambulatories/AddItemToChargeSheet.php?PatientId='+patientid+'&EpisodeId='+patients[i].value+'&');
				
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
				div.style.width='700px';
				div.style.height='auto';
				
				}
				myRequest.update();  
		
	
}










function ViewInsuranceDetails()
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('episode_id');
	           
			    var docitem='treatpatientid';
				

				var patientid=document.getElementsByName(docitem).value;
				var myRequest = new ajaxObject('../Patients/Application/ShowInsuranceDetails.php?PatId='+patientid+'&');
				
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
function ViewPatientDetails()
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('episode_id');
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

function AddEpisode()
{
	var div=document.getElementById('popup_div');
	var patients=document.getElementsByName('episode_id');
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
	var patients=document.getElementsByName('episode_id');
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
					
					var Staff=document.getElementById('dentalpatientchargesheetdentist').value;
					var Quantity=document.getElementById('dentalpatientchargesheetquantity').value;
					
					/*var StartTime=document.getElementById('dentalpatientchargesheetstarttime').value;
					var EndTime=document.getElementById('dentalpatientchargesheetendtime').value;*/
					
					var myRequest=new ajaxObject('../Main/Application/Ambulatories/AddCharge.php?Procedure='+Procedure+'&PatientId='+PatientId+'&Quantity='+Quantity+'&EpisodeId='+EpisodeId+'&Staff='+Staff+'&');
					
					myRequest.callback=function(responseText)
					{
							alert(responseText);
							
							AddItemToPatientChargeSheet(PatientId,EpisodeId);
							
					}
					myRequest.update();	
		  
	
}

