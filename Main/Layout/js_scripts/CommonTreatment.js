/* Treatment functions: If you make any changes please indiacte then.*/
/* Functions to display  (sections ) divs of the treatment form */
function closepopupdiv_2() {
	document.getElementById('popup_div_2').style.display = 'none';
}
function load_complaints_div() {
	document.getElementById('div_complaints').style.display = 'block';
	document.getElementById('div_history_illness').style.display = 'none';
	document.getElementById('div_medical_history').style.display = 'none';
	document.getElementById('div_food_drug_allergy').style.display = 'none';
	document.getElementById('div_family_socialhistory').style.display = 'none';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_complaints', 'patientComplains.php');
}
function load_history_illness_div() {
	document.getElementById('div_complaints').style.display = 'none';
	document.getElementById('div_history_illness').style.display = 'block';
	document.getElementById('div_medical_history').style.display = 'none';
	document.getElementById('div_food_drug_allergy').style.display = 'none';
	document.getElementById('div_family_socialhistory').style.display = 'none';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_history_illness', 'prevailingIllnesses.php');
}
function load_medical_history_div() {
	document.getElementById('div_complaints').style.display = 'none';
	document.getElementById('div_history_illness').style.display = 'none';
	document.getElementById('div_medical_history').style.display = 'block';
	document.getElementById('div_food_drug_allergy').style.display = 'none';
	document.getElementById('div_family_socialhistory').style.display = 'none';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_medical_history', 'medicalHistory.php');
}
function load_food_drug_allergy_div() {
	document.getElementById('div_complaints').style.display = 'none';
	document.getElementById('div_history_illness').style.display = 'none';
	document.getElementById('div_medical_history').style.display = 'none';
	document.getElementById('div_food_drug_allergy').style.display = 'block';
	document.getElementById('div_family_socialhistory').style.display = 'none';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_food_drug_allergy', 'patientFoodDrugAllergy.php');
}
function load_family_social_history_div() {
	document.getElementById('div_complaints').style.display = 'none';
	document.getElementById('div_history_illness').style.display = 'none';
	document.getElementById('div_medical_history').style.display = 'none';
	document.getElementById('div_food_drug_allergy').style.display = 'none';
	document.getElementById('div_family_socialhistory').style.display = 'block';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_family_socialhistory', 'patientFamilySocialHistory.php');
}
function load_differential_diagnostics_div() {
	document.getElementById('div_complaints').style.display = 'none';
	document.getElementById('div_history_illness').style.display = 'none';
	document.getElementById('div_medical_history').style.display = 'none';
	document.getElementById('div_food_drug_allergy').style.display = 'none';
	document.getElementById('div_family_socialhistory').style.display = 'none';
	document.getElementById('div_examination').style.display = 'none';
	document.getElementById('div_differentioal_diagnostics').style.display = 'block';
	display_treatment_divcontents('div_examination', 'patientExamination.php');
}
function display_treatment_divcontents(div_name, file_name) {
	// Display the relevant contents of the treatment sections  (divs)
	var div = document.getElementById(div_name)
	var myRequest = new ajaxObject('../Treatment/Application/' + file_name);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function hide_treatment_div(div_name) {
	document.getElementById(div_name).style.display = 'none';
}
function view_treatment_medical_history_details() {
}
function treat_viewpatientdetails() {
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_treatment_patient_details();
	}
	else {
		display_treatment_patient_details_2();
	}
}
function display_treatment_patient_details() {
	var filename = 'treatmentPatientDetails.php';
	// Function to display patient details
	var div = document.getElementById('popup_div')
	var episode_ids = document.getElementsByName('episode_id')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var myRequest = new ajaxObject("../Treatment/Application/treatmentPatientDetails.php?episode_id=" + episode_ids[z].value + '&');
			myRequest.callback = function (responseText) {
				div.innerHTML = responseText;
				div.style.display = 'block';
				div.style.position = 'absolute';
				div.style.left = '20%';
				div.style.top = '10%';
				div.style.width = '65%';
			}
			myRequest.update();
			break;
		}
	}
}
function display_treatment_patient_details_2() {
	var div = document.getElementById('popup_div')
	var episode_id = document.getElementById('episode_id').value;
	var myRequest = new ajaxObject("../Treatment/Application/treatmentPatientDetails.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '65%';
	}
	myRequest.update();
}
function treat_medicalfiles()
//alert ("doctor and nurse notes");
{
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_medicalfiles();
	}
	else {
		display_medicalfiles_2();
	}
}
function display_medicalfiles() {
	//alert ("doctor and nurse notes");
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episodeid = document.getElementById(docitem + z).value;
			//alert(episodeid);
			var myRequest = new ajaxObject("../Treatment/Application/frm_docctorExaminationAndDiagnosis.php?episode_id=" + episodeid + '&');
			myRequest.callback = function (responseText) {
				//alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function display_medicalfiles_2() {
	var episode_id = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/frm_docctorExaminationAndDiagnosis.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function treat_diagnosis() {
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_diagnosis();
	}
	else {
		display_diagnosis_2();
	}
}
function display_diagnosis() {
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episodeid = document.getElementById(docitem + z).value;
			var myRequest = new ajaxObject("../Treatment/Application/frm_DiagnosisExams.php?episode_id=" + episodeid[z].value + '&');
			myRequest.callback = function (responseText) {
				//			alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function display_diagnosis_2() {
	var episode_id = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/frm_DiagnosisExams.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function showBarcode_Treatment(show_text) {
	var img_format = '';
	var img_quality = 100;
	var img_width = 200;
	var img_height = 200;
	var img_type = 1;
	var img_barcode = show_text;
	var the_response = '';
	var pname = '../Treatment/Application/barcode_show.php?text=' + 1 + '&format=' + img_format + '&quality=' + img_quality + '&width=' + img_width + '&height=' + img_height + '&type=' + img_type + '&barcode=' + img_barcode + '&';
	//alert(pname);
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		document.getElementById('treatment_patient_barcode').innerHTML = responseText;
	}
	myRequest.update();/**/
}
function SetupTreatment() {
}
function view_treatment_medical_history_details() {
	var episode_id = document.getElementById('episode_id').value;
	load_summery_window(episode_id);
	var x = setTimeout("Show_Admission_Summery()", 1000);
	var x = setTimeout("Show_Prescription_Summery()", 1000);
	var x = setTimeout("Show_Labtest_Summery()", 1000);
}
function load_summery_window(episode_id) {
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject("../Treatment/Application/medicalHistoryDetails.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '65%';
	}
	myRequest.update();
}
function Show_Prescription_Summery() {
	var episode_id = document.getElementById('episode_id').value;
	var div = document.getElementById('prescription_summery')
	var myRequest = new ajaxObject("../Treatment/Application/Summery/prescriptionSummery.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
function Show_Admission_Summery() {
	var episode_id = document.getElementById('episode_id').value;
	var div = document.getElementById('admission_summery')
	var myRequest = new ajaxObject("../Treatment/Application/Summery/admissionSummery.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
function Show_Labtest_Summery() {
	var episode_id = document.getElementById('episode_id').value;
	var div = document.getElementById('labtests_summery')
	var myRequest = new ajaxObject("../Treatment/Application/Summery/labtestsSummery.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
function Show_Diagnosis_Summery() {
	var episode_id = document.getElementById('episode_id').value;
	var div = document.getElementById('diagnosis_summery')
	var myRequest = new ajaxObject("../Treatment/Application/medicalHistoryDetails.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
/* Script that manages  the setup of the treatment module*/
// alert("Oh HAPPY DAYS");
function SetupDoctorsNotesTypes() {
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject('../Treatment/Application/Setup/setup_treatment_types.php');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '40%';
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function SetupDosage() {
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject('../Treatment/Application/Setup/setup_dosage_units.php');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '40%';
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function save_setup_dosage() {
	var unit_type = document.getElementById('txt_unit_type').value;
	var unit_parent = document.getElementById('unit_parent').value;
	var myRequest = new ajaxObject('../Treatment/Application/Setup/save_dosagesetup.php?unit_type=' + unit_type + '&unit_parent=' + unit_parent + '&');
	myRequest.callback = function (responseText) {
		if (isNaN(responseText) == false) {
			SetupDosage();
		}
		else {
			alert('There was an error setting up dosage units');
		}
	}
	myRequest.update();
}
function save_setup_consuption_mode() {
	var consuption_mode_name = document.getElementById('consuption_mode_name').value;
	var myRequest = new ajaxObject('../Treatment/Application/Setup/save_consuptionmodesetup.php?consuption_mode_name=' + consuption_mode_name + '&');
	myRequest.callback = function (responseText) {
		if (isNaN(responseText) == false) {
			SetupDosage();
		}
		else {
			//	alert(responseText);	
			alert('There was an error setting up dosage units');
		}
	}
	myRequest.update();
}
function SetupAllergies() {
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject('../Treatment/Application/Setup/setup_allergies.php');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '40%';
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function set_allergy_id() {
	var checked_index = '';
	var edit_allergy_id = document.getElementById('edit_allergy_id');
	var allergies = document.getElementsByName('allergies');
	for (var x = 0; x < allergies.length; x++) {
		if (allergies[x].checked == true) {
			edit_allergy_id.value = allergies[x].value;
			checked_index = x;
			set_arrivalmode_edit_changes(allergies[x].value);
			break;
		}
		//break;
	}
	for (var x = 0; x < arrival_modes.length; x++) {
		if (x != checked_index) {
			allergies[x].checked = false;
		}
	}
}
function set_allergy_edit() {
	var txt_allergy_name = document.getElementById('txt_allergy_name');
	var txt_allergy_description = document.getElementById('txt_allergy_description');
	var edit_mode = document.getElementById('edit_mode');
	edit_mode.value = "1";
	txt_allergy_name.value = "";
	txt_allergy_description.value = "";
}
function save_allergy() {
	alert("Saving Allergies");
	var name = document.getElementById('txt_allergy_name').value;
	var description = document.getElementById('txt_allergy_description').value;
	// var enable = document.getElementById('arrivalmode_disable').value;
	var edit_mode = document.getElementById('edit_mode').value;
	if (edit_mode == "1") {
		Save_Allergy_Mode_New(name, description);
		load_allergy_list();
	}
	else {
		Save_Allergy_Mode_Edit(name, description);
		load_allergy_list();
	}
}
function set_allergies_edit_changes(id) {
	var txt_allergy_name = document.getElementById('txt_allergy_name');
	var txt_allergy_description = document.getElementById('txt_allergy_description');
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject("../Treatment/Application/GetArrivalModeDetails.php?id=" + id + "&");
	myRequest.callback = function (responseText) {
		var details = responseText.split(":");
		var edit_mode = document.getElementById('edit_mode');
		edit_mode.value = "0";
		txt_allergy_name.value = details[1];
		txt_allergy_description.value = details[2];
	}
	myRequest.update();
}
function Save_Allegy_New(name, description) {
	var myRequest = new ajaxObject('../Treatment/Application/SaveNewArrivalMode.php?name=' + name + '&description=' + description + '&');
	myRequest.callback = function (responseText) {
		if (!isNaN(responseText) == true) {
			alert('Allergy has been added');
			load_allergy_list();
		}
		else {
			alert(responseText);
		}
	}
	myRequest.update();
}
function Save_Allergy_Edit(name, description) {
	var id = document.getElementById('edit_allergy_id').value;
	var myRequest = new ajaxObject('../Treatment/Application/SaveEditArrivalMode.php?name=' + name + '&description=' + description + '&id=' + id + '&');
	myRequest.callback = function (responseText) {
		if (!isNaN(responseText) == true) {
			alert('Allergy changes succesfully made');
			load_allergy_list();
		}
		else {
			alert(responseText);
		}
	}
	myRequest.update();
}
function load_allergy_list() {
	var div = document.getElementById('allergy_list');
	var myRequest = new ajaxObject("../Treatment/Application/ArrivalModeList.php");
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function display_treatment_procedures() {
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episodeid = document.getElementById(docitem + z).value;
			var myRequest = new ajaxObject("../Treatment/Application/Procedures/frm_patientProcedure.php?episode_id=" + episodeid + '&');
			myRequest.callback = function (responseText) {
				//			alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function display_treatment_procedures_2() {
	//alert('Mode 2');
	var episode_id = document.getElementById('episode').value;
	//			alert(episode_id);
	var myRequest = new ajaxObject("../Treatment/Application/Procedures/frm_patientProcedure.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
//////////////////////////////////////
function load_procedurerequest_div() {
	//document.getElementById('div_investigations').style.display='none';
	document.getElementById('div_procedurerequest').style.display = 'block';
	//document.getElementById('div_otherrequests').style.display='none';
	//document.getElementById('div_finaldiagnostics').style.display='none';
	//document.getElementById('div_patientstreatment').style.display='none';
	//display_investigation_divcontents(div_name , file_name);
	display_investigation_divcontents('div_procedurerequest', '../Procedures/procedureHistory.php');
	//show_procedures_by_department();
}
function show_procedure_search() {
	var div = document.getElementById('popup_div_2')
	var myRequest = new ajaxObject("../Treatment/Application/Procedures/procedureRequest.php");
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '40%';
	}
	myRequest.update();
	var x = setTimeout("show_procedures_by_department()", 500)
}
function show_procedures_by_department() {
	// this shows the procedure by department
	var procedure_search = document.getElementById('search_procedure_text').value;
	var procedure_department = document.getElementById('procedure_department').value;
	var div = document.getElementById('procedures_list')
	var myRequest = new ajaxObject("../Treatment/Application/Procedures/prcedureByDepartment.php?procedure_search=" + procedure_search + "&department_id=" + procedure_department + "&");
	myRequest.callback = function (responseText) {
		// alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
function Save_Procedure_Requests() {
	//alert('Saving Procedure');
	var save_status = '';
	var icd_10_diagnosis_add = '';
	var checked_codes = document.getElementsByName('selected_procedures')
	for (var i = 0; i < checked_codes.length; i++) {
		if (checked_codes[i].checked == true) {
			//	alert('Item selected -- > '+checked_codes[i].value);
			var notes_id = 'txt_procedure_request_' + checked_codes[i].value;
			var ProcedureNotes = document.getElementById(notes_id).value;
			var department_id = "procedure_department_" + checked_codes[i].value;
			var procedure_department = document.getElementById(department_id).value;
			var old_icd = icd_10_diagnosis_add;
			icd_10_diagnosis_add = checked_codes[i].value + ":" + old_icd;
			var myRequest = new ajaxObject("../Treatment/Application/Procedures/SaveProcedureRequsest.php?procedure_type=" + checked_codes[i].value + "&Notes=" + ProcedureNotes + "&department_id=" + procedure_department + "&");
			myRequest.callback = function (responseText) {
				//alert(responseText);
				if (!isNaN(responseText)) {
					alert("Procedure has been saved succesfully");
				}
				else {
					alert(responseText);
				}
			}
			myRequest.update();
			break;
		}
	}
	closepopupdiv_2();
	var y = setTimeout("load_procedurerequest_div()", 500);
}
function display_procedure_notes_div(id) {
	//	alert(id);
	var div_id = 'div_ procedure_requestnotes_' + id;
	var text_id = 'txt_procedure_request_' + id;
	var selected_div = document.getElementById(div_id);
	selected_div.style.display = 'block';
}
/* Prescription and pharmacy module functions: If you make any changes please indiacte then.*/
/* Functions to display  (sections ) divs of the treatment form */
function treat_pharmacy() {
	// Display Prescription and pharmacy
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_prescription();
	}
	else {
		display_prescription_2();
	}
}
function display_prescription() {
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episodeid = document.getElementById(docitem + z).value;
			var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/frm_prescriptionPharmacy.php?episode_id=" + episodeid[z].value + '&');
			myRequest.callback = function (responseText) {
				//			alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function display_prescription_2() {
	var episode_id = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/frm_prescriptionPharmacy.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function load_prescription_div() {
	/*document.getElementById('div_complaints').style.display='none';
	document.getElementById('div_history_illness').style.display='none';
	document.getElementById('div_medical_history').style.display='none';
	document.getElementById('div_food_drug_allergy').style.display='none';*/
	document.getElementById('div_prescription').style.display = 'block';
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_prescription', 'patientPrescriptionHistory.php');
}
function show_prescripton_details_2(id) {
	var div = document.getElementById('popup_div')
	var detail_field = 'detail_field_' + id;
	var details = document.getElementById(detail_field).value;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/prescriptionDetailWindow.php?details=" + details + "&id=" + id + "&");
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
	}
	myRequest.update();
}
/*function show_prescripton_details(id)
{
   var	divid = "div_presc_det"+id;
   var	hiddenid = "hidden_presc"+id;
   var tr = 'tr'+id;
//	alert(tr);
   //var row = document.getElementById(tr)
   var div = document.getElementById(divid)
   var hidden_field = document.getElementById(hiddenid)
   var hiddenfield_value = hidden_field.value;
   //alert( hiddenfield_value );
	   if (parseInt(hiddenfield_value)==0)
		   {
				 div.style.display='block';
			   div.style.height='200px';
			   //row.style.height ='200px';
				 hidden_field.value='1';
		   }
	   if (parseInt(hiddenfield_value)==1)
		   {
				 div.style.display='none';
				 hidden_field.value='0';
		   }
} */
function load_make_prescription_div() {
	var div = document.getElementById('popup_div')
	var episode_id = document.getElementById('episode_id').value;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/prescriptionWindow.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '65%';
	}
	myRequest.update();
}
function display_pharmacy_items(id) {
	var select_pharmacy_items = document.getElementById('select_pharmacy_items')
	select_pharmacy_items.length = 0;
	var pharm_items = 10;
	var pharm_array = '';
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/getpharmacyItems.php?category=" + id + '&');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		var itemslist = responseText;
		//	alert(itemslist);
		var items = itemslist.split(':');
		for (var J = 0; J < items.length - 1; J++) {
			var item_details = items[J].split('#');
			var optn = document.createElement("OPTION");
			optn.text = item_details[0];
			optn.value = item_details[1];
			select_pharmacy_items.options.add(optn);
		}
	}
	myRequest.update();
	/*
	for (var x=0 ; x < pharm_items ; x++ )
		{
				var optn = document.createElement("OPTION");
					optn.text = "Dingbat" + x;
					optn.value = x;
					select_pharmacy_items.options.add(optn);				//.options[x] = pharm_array; 
		}*/
}
function transfar_pharmacy_item() {
	var select_pharmacy_items = document.getElementById('select_pharmacy_items')
	var item_selected = select_pharmacy_items.options[select_pharmacy_items.selectedIndex].value
		;
	check_item_quantity_instock(item_selected);
}
function execute_transfar_pharmacy_item() {
	var select_pharmacy_items = document.getElementById('select_pharmacy_items')
	var item_selected = select_pharmacy_items.options[select_pharmacy_items.selectedIndex].value
		;
	select_pharmacy_items.options[select_pharmacy_items.selectedIndex] = null;
	//alert(item_selected);
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/getselectedpharmacyItems.php?item_selected=" + item_selected + '&');
	myRequest.callback = function (responseText) {
		// alert(responseText)
		var item_details = responseText.split('#');
		var selected_pharmacy_items = document.getElementById('selected_pharmacy_items')
		var optn = document.createElement("OPTION");
		optn.text = item_details[0];
		optn.value = item_details[1];
		selected_pharmacy_items.options.add(optn);
	}
	myRequest.update();
}
function remove_pharmacy_item() {
	var selected_pharmacy_items = document.getElementById('selected_pharmacy_items')
	var item_selected = selected_pharmacy_items.options[selected_pharmacy_items.selectedIndex].value;
	selected_pharmacy_items.options[selected_pharmacy_items.selectedIndex] = null;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/getselectedpharmacyItems.php?item_selected=" + item_selected + '&');
	myRequest.callback = function (responseText) {
		// alert(responseText)
		var item_details = responseText.split('#');
		var select_pharmacy_items = document.getElementById('select_pharmacy_items')
		var optn = document.createElement("OPTION");
		optn.text = item_details[0];
		optn.value = item_details[1];
		select_pharmacy_items.options.add(optn);
	}
	myRequest.update();
}
function show_dosage_window() {
	var selected_pharmacy_items = document.getElementById('selected_pharmacy_items')
	var item_selected = selected_pharmacy_items.options[selected_pharmacy_items.selectedIndex].value;
	var div = document.getElementById('popup_div_2')
	var episode_id = document.getElementById('episode_id').value;
	var dosage_instance = document.getElementById('dosage_instance').value;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/dosageWindow.php?item_selected=" + item_selected + '&dosage_instance=' + dosage_instance + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '25%';
		div.style.top = '10%';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function save_dosagespecification() {
	var dosage_instance = document.getElementById('dosage_instance').value;
	var item_id = document.getElementById('item_id').value;
	var dosage_totalquantity = document.getElementById('dosage_totalquantity').value;
	var dosage_toconsume = document.getElementById('dosage_toconsume').value;
	var dosage_consuptionfrequency = document.getElementById('dosage_consuptionfrequency').value;
	var dosage_modeconsuption = document.getElementById('dosage_modeconsuption').value;
	var dosage_special_notes = document.getElementById('dosage_special_notes').value;
	var dosage_totalquantity_units = document.getElementById('dosage_totalquantity_units').value;
	var dosage_consuption_units = document.getElementById('dosage_consuption_units').value;
	var dosage_frequency_units = document.getElementById('dosage_consuptionfrequency').value;
	var consuption_frequency = document.getElementById('consuption_frequency').value;
	var myRequest = new ajaxObject('../Treatment/Application/PrescriptionPharmacy/saveDosageSpecification.php?dosage_totalquantity=' + dosage_totalquantity + '&dosage_toconsume=' + dosage_toconsume + '&dosage_consuptionfequency=' + dosage_consuptionfrequency + '&dosage_modeconsuption=' + dosage_modeconsuption + '&dosage_special_notes=' + dosage_special_notes + '&dosage_totalquantity_units=' + dosage_totalquantity_units + '&dosage_frequency_units=' + dosage_frequency_units + '&consuption_frequency=' + consuption_frequency + '&item_id=' + item_id + '&dosage_consuption_units=' + dosage_consuption_units + '&dosage_instance=' + dosage_instance + '&');
	myRequest.callback = function (responseText) {
		if (!isNaN(responseText)) {
			load_dosage_data(dosage_instance);
			alert('Patient Dosage has been added succesfully');
		}
		else {
			alert(dosage_instance);
			alert('There was an error. Please check your dosage specification');
			load_dosage_data(dosage_instance);
		}
		/*			
				div.innerHTML=responseText;
				div.style.display='block';
				div.style.position='absolute';
				div.style.left='25%';
				div.style.top = '10%';
				div.style.width='auto'; 
		*/
	}
	myRequest.update();
}
function load_dosage_data(dosage_instance) {
	var div = document.getElementById('dosage_data')
	var episode_id = document.getElementById('episode_id').value;
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/patientDosageSpecification.php?episode_id=" + episode_id + '&dosage_instance=' + dosage_instance + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		//div.style.position='absolute';
		div.style.width = '100%';
		closepopupdiv_2();
	}
	myRequest.update();
}
function complete_prescription(dosage_instance) {
	//alert(dosage_instance);
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/SavePrescriptionSummery.php?dosage_instance=" + dosage_instance + "&");
	myRequest.callback = function (responseText) {
		//alert(responseText);
		//alert(responseText);
		/*			div.innerHTML=responseText;
					div.style.display='block';
					//div.style.position='absolute';
					div.style.width='100%'; */
		closepopupdiv();
		load_prescription_div();
	}
	myRequest.update();
}
function check_item_quantity_instock(item_selected) {
	//alert('checking item quantity lin stock');
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/CheckItemQantityInStock.php?item_selected=" + item_selected + "&");
	myRequest.callback = function (responseText) {
		//	alert(responseText);
		if (parseInt(responseText) == 1) {
			ShowItemAlternativeWindow(item_selected);
		}
		else {
			execute_transfar_pharmacy_item();
		}
	}
	myRequest.update();
}
function ShowItemAlternativeWindow(item_selected) {
	var div = document.getElementById('popup_div_2')
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/ShowItemAlternativeWindow.php?item_selected=" + item_selected + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '25%';
		div.style.top = '10%';
		div.style.width = '20%';
		div.style.height = '200px';
	}
	myRequest.update();
}
function add_alternative_item() {
	// alert('Adding Alternative Item');
	var alternative_items = document.getElementsByName('alternative_item_check')
	// alert(alternative_items.length);
	for (var z = 0; z < alternative_items.length; z++) {
		if (alternative_items[z].checked == true) {
			var item_selected = alternative_items[z].value;
			//alert(item_selected);
			execute_transfar_pharmacy_item_alternative(item_selected);
			break;
		}
	}
}
function execute_transfar_pharmacy_item_alternative(item_selected) {
	//alert(item_selected);
	var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/getselectedpharmacyItems.php?item_selected=" + item_selected + '&');
	myRequest.callback = function (responseText) {
		// alert(responseText)
		var item_details = responseText.split('#');
		var selected_pharmacy_items = document.getElementById('selected_pharmacy_items')
		var optn = document.createElement("OPTION");
		optn.text = item_details[0];
		optn.value = item_details[1];
		selected_pharmacy_items.options.add(optn);
	}
	myRequest.update();
}
function remove_dosage(dosage_instance) {
	var x = confirm("Are you sure that you want to remove the selected dosage item(s) ?")
	if (x) {
		var dosage_item = document.getElementsByName('dosage_item');
		var size = dosage_item.length;
		var dosages = new Array(size);
		for (var i = 0; i < dosage_item.length; i++) {
			if (dosage_item[i].checked == true) {
				dosages[i] = dosage_item[i].value;
			}
		}
		var myRequest = new ajaxObject("../Treatment/Application/PrescriptionPharmacy/RemoveDosageItem.php?dosages=" + dosages + '&');
		myRequest.callback = function (responseText) {
			if (!isNaN(responseText)) {
				if (parseInt(responseText) > 0) {
					var str = responseText + ' Items removed';
					alert(str)
				}
				else {
					alert('No items have been removed');
				}
			}
			load_dosage_data(dosage_instance);
		}
		myRequest.update();
	}
}
function show_labresults(labrequest_id) {
	var div = document.getElementById('popup_div_2')
	var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/patientLabResults.php?labrequest_id=" + labrequest_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = '60%';
		div.style.height = 'auto';
	}
	myRequest.update();
}
function show_labresults_2(labrequest_id, episode_id) {
	var div = document.getElementById('popup_div_2')
	var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/patientLabResults.php?labrequest_id=" + labrequest_id + '&episode_id=' + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = '60%';
		div.style.height = 'auto';
	}
	myRequest.update();
}
// Script Written by : George Mbatia
function load_investigations_div() {
	document.getElementById('div_investigations').style.display = 'block';
	//document.getElementById('div_investigations_history').style.display='block';
	//document.getElementById('div_procedurerequest').style.display='none';
	document.getElementById('div_otherrequests').style.display = 'none';
	// document.getElementById('div_finaldiagnostics').style.display='none';
	document.getElementById('div_patientstreatment').style.display = 'none';
	//display_investigation_divcontents(div_name , file_name);
	display_investigation_divcontents('div_investigations', 'investigationRequest.php');
	//display_investigation_divcontents('div_investigation_history' , 'patientLabrequests.php');
}
function load_otherrequest_div() {
	document.getElementById('div_investigations').style.display = 'none';
	//document.getElementById('div_procedurerequest').style.display='none';
	document.getElementById('div_otherrequests').style.display = 'block';
	// document.getElementById('div_finaldiagnostics').style.display='none';
	document.getElementById('div_patientstreatment').style.display = 'none';
	//display_investigation_divcontents(div_name , file_name);
	display_investigation_divcontents('div_otherrequests', 'otherRequest.php');
}
function load_patientstreatment_div() {
	document.getElementById('div_investigations').style.display = 'none';
	// document.getElementById('div_procedurerequest').style.display='none';
	document.getElementById('div_otherrequests').style.display = 'none';
	//	document.getElementById('div_finaldiagnostics').style.display='none';
	document.getElementById('div_patientstreatment').style.display = 'block';
	//display_investigation_divcontents(div_name , file_name);
	display_investigation_divcontents('div_patientstreatment', 'patientTreatment.php');
}
function proceed_investigation_diagnostics() {
	//var waiting_room_id = document.getElementById('treatment_waiting_rooms').value;
	var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/frm_investigationsAndDiagnostics.php");
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function finish_investigations_diagnostics() {
	// Finish the investigation and diagnostics process
}
function display_investigation_divcontents(div_name, file_name) {
	// Display the relevant contents of the treatment sections  (divs)
	var div = document.getElementById(div_name)
	var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/' + file_name);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
	}
	myRequest.update();
}
function submit_investigation_request() {
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var check_investigation = document.getElementsByName('check_investigation')
	for (var i = 0; i < check_investigation.length; i++) {
		if (check_investigation[i].checked == true) {
			//	alert(check_investigation[i].value);
			var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/SaveInvestigationRequsest.php?patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&employee_id=' + employee_id + '&investigation_type=' + check_investigation[i].value + '&status=' + 0 + '&');
			myRequest.callback = function (responseText) {
				// div.innerHTML=responseText;
				//	alert(responseText);
				if (isNaN(responseText) == false) {
					if (i == 0) {
						RequestLabServices_FromTreatment(responseText);
						load_investigations_div();
					}
					if (i == 1) {
						RequestImagingServices_FromTreatment(responseText);
						load_investigations_div();
					}
					if (i == 2) {
						RequestCathlabService_FromTreatment(responseText);
						load_investigations_div();
					}
				}
			}
			load_investigations_div();
			myRequest.update();
			break;
		}
	}
}
function submit_procedure_request() {
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var check_procedure = document.getElementsByName('check_procedure')
	for (var i = 0; i < check_procedure.length; i++) {
		if (check_procedure[i].checked == true) {
			//	alert(check_investigation[i].value);
			var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/SaveProcedureRequsest.php?patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&employee_id=' + employee_id + '&procedure_type=' + check_procedure[i].value + '&status=' + 0 + '&');
			myRequest.callback = function (responseText) {
				// div.innerHTML=responseText;
				// alert(responseText);
				if (responseText == '1') {
					alert('Procedure request sucesfully updated');
				}
				else {
					alert("Procedure request was not updated. Please contact your administrator");
					//alert(responseText);
				}
			}
			myRequest.update();
			break;
		}
	}
}
function submit_other_request() {
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var check_other = document.getElementsByName('check_otehrrequests')
	for (var i = 0; i < check_other.length; i++) {
		if (check_other[i].checked == true) {
			//	alert(check_investigation[i].value);
			var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/SaveOtherRequsest.php?patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&employee_id=' + employee_id + '&procedure_type=' + check_other[i].value + '&status=' + 0 + '&');
			myRequest.callback = function (responseText) {
				// div.innerHTML=responseText;
				// alert(responseText);
				if (responseText == '1') {
					alert('Other request sucesfully updated');
				}
				else {
					alert("Other request was not updated. Please contact your administrator");
				}
			}
			myRequest.update();
			break;
		}
	}
}
function submit_patienttreatment_request() {
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var doctor_request_notes = document.getElementById('doctors_request_notes').value;
	// alert(doctor_request_notes);
	var check_patienttreatment = document.getElementsByName('check_patienttreatment')
	var checked_value = '-1';
	for (var i = 0; i < check_patienttreatment.length; i++) {
		if (check_patienttreatment[i].checked == true) {
			checked_value = check_patienttreatment[i].value;
			break;
		}
	}
	var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/SavePatientTreatmentRequsest.php?patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&doctor_request_notes=' + doctor_request_notes + '&employee_id=' + employee_id + '&treatment_type=' + checked_value + '&status=' + 0 + '&');
	myRequest.callback = function (responseText) {
		// div.innerHTML=responseText;
		//	alert(responseText);
		if (responseText == '1') {
			alert('Patient treatment request sucesfully updated');
		}
		else {
			alert("Patient treatment request was not updated. Please contact your administrator");
		}
	}
	myRequest.update();
}
function treat_testresultsrequests() {
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_treatment_requests();
	}
	else {
		display_treatment_requests_2();
	}
}
function display_treatment_requests_2() {
	var episode_id = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/frm_investigationsAndDiagnostics.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function display_treatment_requests() {
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episode = document.getElementById(docitem + z).value;
			var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/frm_investigationsAndDiagnostics.php?episode_id=" + episode[z].value + '&');
			myRequest.callback = function (responseText) {
				//			alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function treat_procedures() {
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_treatment_procedures();
	}
	else {
		display_treatment_procedures_2();
	}
}
function save_lab_request_id(lab_request_id, id) {
	var myRequest = new ajaxObject("../Treatment/Application/InvestigationAndDiagnostics/UpdateInvestigationRequsest.php?request_ref=" + lab_request_id + '&id=' + id + '&');
	myRequest.callback = function (responseText) {
		if (isNaN(responseText) == false) {
			alert("Lab request has been created succesfully");
		}
		load_investigations_div();
	}
	myRequest.update();
}
function show_investigation_results(refno, req_type) {
	//alert(req_type);
	//alert(refno);
	if (req_type == '1') {
		ShowImagingResults(refno);
	}
	if (req_type == '2') {
		ShowCathlabResults(refno);
	}
	if (req_type == '3') {
		ShowEndoscopyResults(refno);
	}
	if (req_type == '4') {
		ShowHaemodyalisisResults(refno);
	}
}
function ShowImagingResults(refno) {
	//alert("Showing imaging results");
}
function ShowCathlabResults(refno) {
	//alert("Showing imaging results");
	DisplayCathlabResults_FromTreatment(refno);
}
function ShowEndoscopyResults(refno) {
	//alert("Showing endoscopy results");
}
function ShowHaemodyalisisResults(refno) {
	//alert("Showing haemodyalisis results");
}
// Script Written by : George Mbatia
function save_illness_history() {
	// Save notes (doctor or nurse notes)
	var employee_id = document.getElementById('employee_id').value;
	//alert(employee_id);
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var details = document.getElementById('prevailing_illness_text').value;
	if (details == '') {
		alert('You have not entered any text in the prevailing illness area \n Please enter text.');
	}
	else {
		var myRequest = new ajaxObject('../Treatment/Application/SavePrevailingIllness.php?employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&details=' + details + '&');
		myRequest.callback = function (responseText) {
			//	alert(responseText);
			if (parseInt(responseText) == 1) {
				alert("Prevailing history illness succesfully saved");
				load_history_illness_div();
			}
			else {
				alert("Complains have not been saved.\nPlease contact your administrator.");
			}
		}
		myRequest.update();
	}
}
function save_fooddrugallergy() {
	// Save notes (doctor or nurse notes)	
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var details = document.getElementById('patient_fooddrugallergy_text').value;
	if (details == '') {
		alert('You have not entered any text in the food / drug allergy area \n Please enter text.');
	}
	else {
		var myRequest = new ajaxObject('../Treatment/Application/SaveFoodDrugAllergy.php?employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&details=' + details + '&');
		myRequest.callback = function (responseText) {
			//alert(responseText);
			if (parseInt(responseText) == 1) {
				alert("Prevailing history illness succesfully saved");
				load_food_drug_allergy_div();
			}
			else {
				alert("Complains have not been saved.\nPlease contact your administrator.");
			}
		}
		myRequest.update();
	}
}
function save_familysocialhistory() {
	// Save notes (doctor or nurse notes)	
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var details = document.getElementById('patient_familysocial_text').value;
	if (details == '') {
		alert('You have not entered any text in the food / drug allergy area \n Please enter text.');
	}
	else {
		var myRequest = new ajaxObject('../Treatment/Application/SaveFamilySocialHistory.php?employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&details=' + details + '&');
		myRequest.callback = function (responseText) {
			//alert(responseText);
			if (parseInt(responseText) == 1) {
				alert("Prevailing history illness succesfully saved");
				load_family_social_history_div();
			}
			else {
				alert("Complains have not been saved.\nPlease contact your administrator.");
			}
		}
		myRequest.update();
	}
}
function load_icd10_div() {
	//document.getElementById('div_investigations').style.display='none';
	//	document.getElementById('div_investigations_history').style.display='block';
	//document.getElementById('div_procedurerequest').style.display='none';
	//document.getElementById('div_otherrequests').style.display='none';
	document.getElementById('div_examination').style.display = 'none';
	document.getElementById('div_finaldiagnostics').style.display = 'none';
	document.getElementById('div_icd_10').style.display = 'block';
	document.getElementById('display_icd_10').style.display = 'block';
	//document.getElementById('div_patientstreatment').style.display='none';
	//display_investigation_divcontents(div_name , file_name);
	load_to_diagnosis();
	display_investigation_divcontents('div_icd_10', '../icd_10/manageICD10.php');
	show_icd10_code("", "");
}
function show_icd10_code(icd_10_code_text, icd_10_description_text) {
	var div = document.getElementById('display_icd_10')
	var myRequest = new ajaxObject("../Treatment/Application/icd_10/showICD10codes.php?icd_10_code_text=" + icd_10_code_text + "&icd_10_description=" + icd_10_description_text + '&');
	myRequest.callback = function (responseText) {
		// alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
	}
	myRequest.update();
}
function search_icd10(mode) {
	if (parseInt(mode) == 1) {
		var icd_10_code_text = document.getElementById('icd10_searchcode').value;
		show_icd10_code(icd_10_code_text, "");
	}
	if (parseInt(mode) == 2) {
		var icd_10_code_description = document.getElementById('icd10_description').value;
		show_icd10_code("", icd_10_code_description);
	}
}
function expand_icd_10_code(code_category) {
	//	alert(code_category);
	var check_box_id = code_category + '.-';
	cat_checkbox = document.getElementById(check_box_id)
	if (cat_checkbox.checked == true) {
		expand_icd_10_code_expand(code_category);
	}
	if (cat_checkbox.checked == false) {
		expand_icd_10_code_collapse(code_category);
	}
}
function expand_icd_10_code_expand(code_category) {
	//	alert(code_category);
	var divsname = 'div_tree_branch_' + code_category;
	var divs = document.getElementsByName(divsname)
	for (var i = 0; i < divs.length; i++) {
		divs[i].style.display = 'block';
	}
}
function expand_icd_10_code_collapse(code_category) {
	//	alert(code_category);
	var divsname = 'div_tree_branch_' + code_category;
	var divs = document.getElementsByName(divsname)
	for (var i = 0; i < divs.length; i++) {
		divs[i].style.display = 'none';
	}
}
function load_to_diagnosis() {
	var div = document.getElementById('popup_div_2')
	var myRequest = new ajaxObject("../Treatment/Application/icd_10/icd10_diagnosis.php");
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'none';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = '35%';
	}
	myRequest.update();
}
function add_to_diagnosis() {
	var z = setTimeout("execute_add_to_diagnosis()", 5);
}
function execute_add_to_diagnosis() {
	var div = document.getElementById('popup_div_2')
	div.style.display = 'block';
	var div_icd_10_diagnosis_selected = document.getElementById('div_icd_10_diagnosis_selected')
	div_icd_10_diagnosis_selected.innerHTML = '';
	var checked_codes = document.getElementsByName('branch_checkbox')
	var icd_10_diagnosis_add = '';
	for (var i = 0; i < checked_codes.length; i++) {
		if (checked_codes[i].checked == true) {
			var old_icd = icd_10_diagnosis_add;
			icd_10_diagnosis_add = checked_codes[i].value + ":" + old_icd;
			var data = div_icd_10_diagnosis_selected.innerHTML;
			var new_data = '';
			var output = '';
			var myRequest = new ajaxObject("../Treatment/Application/icd_10/addICD10lDiagnosis.php?icd_10_diagnosis_add=" + icd_10_diagnosis_add + "&");
			myRequest.callback = function (responseText) {
				new_data = responseText;
				div_icd_10_diagnosis_selected.innerHTML = data + new_data;
			}
			myRequest.update();
		}
	}
}
function complete_icd10_diagnostics() {
	var codes = '';
	var res = 0;
	var icd_10_selected = document.getElementsByName('icd_10_selected')
	for (var i = 0; i < icd_10_selected.length; i++) {
		var old_codes = codes;
		codes = old_codes + ":" + icd_10_selected[i].value;
	}
	var myRequest = new ajaxObject("../Treatment/Application/icd_10/saveSelectedCodes.php?codes=" + codes + "&");
	myRequest.callback = function (responseText) {
		if (parseInt(responseText) == 1) {
			alert("ICD 10 diagnosis succesfully saved");
			closepopupdiv_2();
		}
		res = responseText;
	}
	myRequest.update();
}
// JavaScript Document
function start_patients() {
	show_patients_nav();
}
function show_patients_nav() {
	var pos = 0
	var myRequest = new ajaxObject("includes/navigation/PatientNav.php?pos=" + pos + "&");
	myRequest.callback = function (responseText) {
		document.getElementById('topmenu').innerHTML = responseText;
	}
	myRequest.update();
}
function show_search() {
	document.getElementById('search_bar').style.display = 'block';
	if (hh == 100) {
		clearInterval(inter);
		return;
	}
	document.getElementById('search_bar').style.visibility = 'visible';
	document.getElementById('main_window').style.width = '100%';
	hh += 30;
	document.getElementById('search_bar').style.width = hh + 'px';
	document.getElementById('search_bar_action').innerHTML = " <a href='#' onclick=\"inter=setInterval('hide_search()',3);return false;\">Hide search</a>";
}
function show_quicklinks() {
	var div = document.getElementById('').value;
}
// Script Written by : George Mbatia
function validate_patient_examination() {
	// Patiernt Examination Error Handling
	var error_counter = 0;
	var error_code = '';
	var txt_central_nervous = document.getElementById('txt_central_nervous').value;
	var txt_gastro_intestinal = document.getElementById('txt_gastro_intestinal').value;
	var txt_respiratory = document.getElementById('txt_respiratory').value;
	var txt_genital_urinary = document.getElementById('txt_genital_urinary').value;
	var txt_cardio_vascular = document.getElementById('txt_cardio_vascular').value;
	if (txt_central_nervous == '') {
		error_counter++;
		error_code += '1:';
	}
	else {
		error_code += '0:';
	}
	if (txt_gastro_intestinal == '') {
		error_counter++;
		error_code += '1:';
	}
	else {
		error_code += '0:';
	}
	if (txt_respiratory == '') {
		error_counter++;
		error_code += '1:';
	}
	else {
		error_code += '0:';
	}
	if (txt_genital_urinary == '') {
		error_counter++;
		error_code += '1:';
	}
	else {
		error_code += '0:';
	}
	if (txt_cardio_vascular == '') {
		error_counter++;
		error_code += '1';
	}
	else {
		error_code += '0';
	}
	if (error_counter != 0) {
		var error_message = 'You have ' + error_counter + ' fields without any text.\nPlease enter text in these fields \n\n';
		var errors = error_code.split(":");
		for (var x = 0; x <= 4; x++) {
			if (errors[x] == '1') {
				switch (x) {
					case 0:
						error_message += ' - Central Nervous System\n';
						break;
					case 1:
						error_message += ' - Gastrointestinal System\n';
						break;
					case 2:
						error_message += ' - Respiratory System\n';
						break;
					case 3:
						error_message += ' - Genitourinary System\n';
						break;
					case 4:
						error_message += ' - Cardiovascular System\n';
						break;
				}
			}
		}
		alert(error_message);
	}
	else {
		var examination_data = txt_central_nervous + ":" + txt_gastro_intestinal + ":" + txt_respiratory + ":" + txt_genital_urinary + ":" + txt_cardio_vascular;
		save_patient_examination(examination_data);
	}
}
function save_patient_examination(examination_data) {
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var myRequest = new ajaxObject('../Treatment/Application/SaveExaminations.php?patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&examination_data=' + examination_data + '&');
	myRequest.callback = function (responseText) {
		//	alert(responseText);
		if (parseInt(responseText) == 1) {
			alert("Examination details have been succesfully saved");
			hide_treatment_div('div_examination');
		}
		else {
			alert("Examination details have not been saved.\nPlease contact your administrator.");
		}
	}
	myRequest.update();
}
function load_finaldiagnostics_div() {
	//document.getElementById('div_investigations').style.display='none';
	//	document.getElementById('div_investigations_history').style.display='block';
	//document.getElementById('div_procedurerequest').style.display='none';
	//document.getElementById('div_otherrequests').style.display='none';
	document.getElementById('div_examination').style.display = 'none';
	document.getElementById('div_finaldiagnostics').style.display = 'block';
	document.getElementById('div_icd_10').style.display = 'none';
	document.getElementById('display_icd_10').style.display = 'none';
	//document.getElementById('div_patientstreatment').style.display='none';
	//display_investigation_divcontents(div_name , file_name);
	display_investigation_divcontents('div_finaldiagnostics', 'patientFinalDiagnosis.php');
}
function load_examination_div() {
	/*document.getElementById('div_complaints').style.display='none';
	document.getElementById('div_history_illness').style.display='none';
	document.getElementById('div_medical_history').style.display='none';
	document.getElementById('div_food_drug_allergy').style.display='none';
	document.getElementById('div_family_socialhistory').style.display='none';*/
	document.getElementById('div_icd_10').style.display = 'none';
	document.getElementById('div_finaldiagnostics').style.display = 'none';
	document.getElementById('div_examination').style.display = 'block';
	document.getElementById('display_icd_10').style.display = 'none';
	display_treatment_divcontents('div_examination', 'patientExamination.php');
}
function save_final_diagnosis() {
	// Save notes (doctor or nurse notes)
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var details = document.getElementById('txt_final_diagnosis').value;
	if (details == '') {
		alert('You have not entered any text in the diagnosis area \nPlease enter text before you save');
	}
	else {
		var myRequest = new ajaxObject('../Treatment/Application/InvestigationAndDiagnostics/SaveFinalDiagnosis.php?employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&details=' + details + '&');
		myRequest.callback = function (responseText) {
			//	alert(responseText);
			if (parseInt(responseText) == 1) {
				alert("Final Diagnosis Succesfully Saved");
				//hide_treatment_div('div_complaints');
				load_finaldiagnostics_div();
			}
			else {
				// alert(responseText);
				alert("Diagnostic notes have not been saved.\nPlease contact your administrator.");
			}
		}
		myRequest.update();
	}
}
// Script Written by : George Mbatia
function display_doctors_notes() {
	//Function to display the doctors notes input form
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject('../Treatment/Application/doctorsNotes.php');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '65%';
		/* div.style.height='auto';
		div.style.width='auto';*/
	}
	myRequest.update();
}
function display_nurses_notes() {
	//Function to display the nurses notes input form
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject('../Treatment/Application/nursesNotes.php');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '65%';
		/* div.style.height='auto';
		div.style.width='auto';*/
	}
	myRequest.update();
}
function clear_notes(i) {
	// Function to clear the notes text boxes
	var x = confirm("Are you sure that you want to clear notes ?");
	if (x == true) {
		if (i == '1') {
			document.getElementById('txt_doctors_notes').value = '';
		}
		if (i == '2') {
			document.getElementById('txt_nurses_notes').value = '';
		}
	}
}
function save_notes(type) {
	// Save notes (doctor or nurse notes)
	var notes = '';
	var notes_type = document.getElementById('doctor_notes_type').value;
	//alert(notes_type);
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	if (type == 1) {
		notes = document.getElementById('txt_doctors_notes').value;
	}
	if (type == 2) {
		notes = document.getElementById('txt_nurses_notes').value;
	}
	var myRequest = new ajaxObject('../Treatment/Application/SaveNotes.php?type=' + type + '&employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&notes=' + notes + '&notes_type=' + notes_type + '&');
	myRequest.callback = function (responseText) {
		if (parseInt(responseText) == 1) {
			alert("Notes Succesfully Saved");
			display_doctors_notes();
			if (type == 1) {
				display_doctors_notes();
			}
			if (type == 2) {
				display_nurses_notes();
			}
		}
		else {
			alert("Notes have not been saved.\nPlease check to ensure that you have entered notes \nor contact your administrator.");
		}
	}
	myRequest.update();
}
// Script Written by : George Mbatia
function save_patient_complain() {
	// Save notes (doctor or nurse notes)
	var employee_id = document.getElementById('employee_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var patient_episode = document.getElementById('patient_episode').value;
	var date = document.getElementById('date').value;
	var complains = document.getElementById('txt_patient_complains').value;
	if (complains == '') {
		alert('You have not entered any text in the complains area \nPlease enter text before you save');
	}
	else {
		var myRequest = new ajaxObject('../Treatment/Application/SaveComplains.php?employee_id=' + employee_id + '&patient_id=' + patient_id + '&patient_episode=' + patient_episode + '&date=' + date + '&complains=' + complains + '&');
		myRequest.callback = function (responseText) {
			//	alert(responseText);
			if (parseInt(responseText) == 1) {
				alert("Complains Succesfully Saved");
				hide_treatment_div('div_complaints');
				load_complaints_div();
			}
			else {
				alert("Complains have not been saved.\nPlease contact your administrator.");
			}
		}
		myRequest.update();
	}
}
// Script Written by : George Mbatia
function treat_admission() {
	var mode = document.getElementById('display_mode').value;
	if (mode == '1') {
		display_treatment_admission();
	}
	else {
		display_treatment_admission_2();
	}
}
function display_treatment_admission() {
	var episode_ids = document.getElementsByName('patientid')
	for (var z = 0; z < episode_ids.length; z++) {
		if (episode_ids[z].checked == true) {
			var docitem = 'episode';
			episodeid = document.getElementById(docitem + z).value;
			var myRequest = new ajaxObject("../Treatment/Application/admission/admission.php?episode_id=" + episodeid[z].value + '&');
			myRequest.callback = function (responseText) {
				$(document).ready(
					function () {
						$('#service_table').DataTable(
							{
								dom: 'Bfrtip',
								lengthMenu: [
									[10, 25, 50, 100, -1],
									['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
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
				//			alert(responseText);
				document.getElementById('main_window').innerHTML = responseText;
			}
			myRequest.update();
			break;
		}
	}
}
function display_treatment_admission_2() {
	var episode_id = document.getElementById('episode_id').value;
	//			alert(episode_id);
	var myRequest = new ajaxObject("../Treatment/Application/admission/admission.php?episode_id=" + episode_id + '&');
	myRequest.callback = function (responseText) {
		$(document).ready(
			function () {
				$('#service_table').DataTable(
					{
						dom: 'Bfrtip',
						lengthMenu: [
							[10, 25, 50, 100, -1],
							['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
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
		//			alert(responseText);
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function load_admissionrequest_div() {
	document.getElementById('div_admissionrequest').style.display = 'block';
	/*	document.getElementById('div_history_illness').style.display='none';
		document.getElementById('div_medical_history').style.display='none';
		document.getElementById('div_food_drug_allergy').style.display='none';
		document.getElementById('div_family_socialhistory').style.display='none'; */
	//document.getElementById('div_examination').style.display='none';
	display_treatment_divcontents('div_admissionrequest', 'admission/admissionRequest.php');
}
function save_patient_admission() {
	//alert('ADMISSION');
	save_admission_referal();
}
function save_patient_admission_table(referal_id) {
	var admission_notes = document.getElementById('txt_patient_admission').value;
	var episode_id = document.getElementById('episode_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var employee_id = document.getElementById('employee_id').value;
	//  var = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/admission/SaveAdmission.php?episode_id=" + episode_id + '&patient_id=' + patient_id + '&admission_notes=' + admission_notes + '&employee_id=' + employee_id + '&referal_id=' + referal_id + '&');
	myRequest.callback = function (responseText) {
		// alert(responseText);
		if (!isNaN(responseText)) {
			if (parseInt(responseText) == 1) {
				alert('Admission notes succesfully saved');
				load_admissionrequest_div();
			}
			if (parseInt(responseText) == 2) {
				alert('This patient has already been admitted \nand has not yet been discharged');
				load_admissionrequest_div();
			}
			if (parseInt(responseText) == 3) {
				alert('The status of this patient is unknown.Please contact ward administrator');
				load_admissionrequest_div();
			}
		}
		else {
			alert(responseText);
			alert('There was an error submitting admission request');
			load_admissionrequest_div();
		}
		//document.getElementById('main_window').innerHTML=responseText; 
	}
	myRequest.update();
}
function save_admission_referal() {
	var admission_notes = document.getElementById('txt_patient_admission').value;
	var episode_id = document.getElementById('episode_id').value;
	var patient_id = document.getElementById('patient_id').value;
	var employee_id = document.getElementById('employee_id').value;
	//  var = document.getElementById('episode').value;
	var myRequest = new ajaxObject("../Treatment/Application/admission/SaveAdmissionReferal.php?episode_id=" + episode_id + '&patient_id=' + patient_id + '&admission_notes=' + admission_notes + '&employee_id=' + employee_id + '&');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		//alert(responseText);
		if (!isNaN(responseText)) {
			if (parseInt(responseText) != 2 && parseInt(responseText) != 3) {
				// alert('passing to saving module');
				save_patient_admission_table(responseText);
			}
			if (parseInt(responseText) == 2) {
				alert('This patient has already been admitted and has not yet been discharged');
			}
			if (parseInt(responseText) == 3) {
				//alert('The admission status of this patient is unknown. Please contact ward administrator');
				save_patient_admission_table(responseText);

			}
		}
		else {
			alert(responseText);
			load_admissionrequest_div();
		}
		//document.getElementById('main_window').innerHTML=responseText; 
	}
	myRequest.update();
}
function isNumber(InString) {
	if (InString.length == 0) return (false);
	var RefString = "1234567890";
	for (Count = 0; Count < InString.length; Count++) {
		TempChar = InString.substring(Count, Count + 1);
		if (RefString.indexOf(TempChar, 0) == -1)
			return (false);
	}
	return (true);
}
function treatment_request_discharge(patient_id, episode_id) {
	//alert('Discharge Request Succesful');
	var div = document.getElementById('popup_div')
	var myRequest = new ajaxObject("../Treatment/Application/admission/dischargeRequest.php?patient_id=" + patient_id + '&episode_id=' + episode_id + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = '50%';
		div.style.height = 'auto';
	}
	myRequest.update();
}
function save_patient_discharge(episode_id, patient_id) {
	var notes = document.getElementById('txt_patient_discharge').value;
	var myRequest = new ajaxObject("../Treatment/Application/admission/SaveDischarge.php?patient_id=" + patient_id + '&episode_id=' + episode_id + '&notes=' + notes + '&');
	myRequest.callback = function (responseText) {
		//	alert(responseText);
		if (!isNaN(responseText)) {
			if (responseText == 0) {
				alert("Please confirm admission status from wards");
			}
			if (responseText == 1) {
				alert("Discharge Request Succesfull");
			}
			if (responseText == 2) {
				alert("Discharge Request was made previously - \nawaiting for confirmation");
			}
		}
		else {
			alert(responseText);
		}
	}
	myRequest.update();
	closepopupdiv();
}
