//Javascript Document
function ProcurementStockRequest() {
	var pname = 'Application/HODApprovedInternalStockRequests.php';
	//alert(pname);
	myRequest = new ajaxObject(pname);
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
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function ProcurementApproveStockRequest() {
	//alert("Kubaff1");
	var RequestId = document.getElementsByName('RequestId');
	var Selected = 0;
	for (var i = 0; i <= RequestId.length; i++) {
		if (RequestId[i].checked) {
			Selected += 1;
		}
		if (i == (RequestId.length - 1)) {
			if (Selected > 0) {
				Confirm_Box("You are about to Process stock requests.Are you sure of this Action", "ProceedApproveProcurementStockRequest");
			}
			else {
				alert_box("Please select some Requests to Process");
			}
			break;
		}
	}
}
function ProceedApproveProcurementStockRequest() {
	var RequestId = document.getElementsByName('RequestId');
	var selectedRequests = '';
	for (var i = 0; i <= RequestId.length; i++) {
		if (RequestId[i].checked) {
			selectedRequests += RequestId[i].value + ':';
		}
		if (i == (RequestId.length - 1)) {
			CheckApproveProcurementRequest(selectedRequests);
		}
	}
}
function RawProcurements() {
	//alert("Kubaff");
	var pname = 'Application/MadeRawPRQs.php';
	myRequest = new ajaxObject(pname);
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
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function ApprovedPRQs() {
	//alert("Kubaff");
	var pname = 'Application/ApprovedPRQs.php';
	myRequest = new ajaxObject(pname);
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
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function CheckPRQs() {
	var CheckPRQs = document.getElementById('CheckPRQs');
	var PRQ = document.getElementsByName('PRQId');
	if (CheckPRQs.checked) {
		for (var i = 0; i <= PRQ.length; i++) {
			PRQ[i].checked = true;
		}
	}
	else {
		for (var i = 0; i <= PRQ.length; i++) {
			PRQ[i].checked = false;
		}
	}
}
function CheckOutSuppliers(CatId) {
	var pname = 'Application/CategorySuppliers.php?CatId=' + CatId + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '55%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function SuppliersList(Suppliers, QuoteRequest) {
	var pname = 'Application/SuppliersList.php?Suppliers=' + Suppliers + '&QuoteRequest=' + QuoteRequest + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '55%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function ApprovePRQs() {
	var PRQ = document.getElementsByName('PRQId');
	var SelectedPRQs = '';
	for (var i = 0; i <= PRQ.length; i++) {
		if (PRQ[i].checked) {
			SelectedPRQs += PRQ[i].value + ':';
		}
		if (i == (PRQ.length - 1)) {
			CompleteApprovePRQs(SelectedPRQs);
		}
	}
}
function CompleteApprovePRQs(SelectedPRQs) {
	var pname = 'Application/ApprovePRQs.php?SelectedPRQs=' + SelectedPRQs + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			if (responseText == 'reload') {
				history.go(0);
			}
			else {
				alert_box(responseText);
			}
		}
		else {
			RawProcurements();
			alert_box("Action successful.Procurement requests successfully approved");
		}
	}
	myRequest.update();
}
function GenerateQuotationRequest() {
	var PRQ = document.getElementsByName('PRQId');
	var SelectedPRQs = '';
	var countSelected = 0;
	for (var i = 0; i <= PRQ.length; i++) {
		if (PRQ[i].checked) {
			SelectedPRQs += PRQ[i].value + ':';
			countSelected += 1;
		}
		if (i == (PRQ.length - 1)) {
			if (countSelected > 1) {
				alert_box("You have selected more than one Procurement Request to issue quotation Requests.Quotation requests can only be issued to one PRQ at a time");
			}
			else {
				ShowQuotationDetailsWindow(SelectedPRQs);
			}
		}
	}
}
function ShowQuotationDetailsWindow(SelectedPRQs) {
	var pname = 'Application/GetPRQDetailsForQuoteRequest.php?SelectedPRQs=' + SelectedPRQs + '&';
	//alert(pname);
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		var results = responseText.split(':');
		CatId = results[0];
		RecId = results[1];
		SelectSuppliersToRequest(CatId, RecId);
	}
	myRequest.update();
}
function CompleteGenerateQuotationRequest(SelectedPRQs) {
	var pname = 'Application/SavePRQsInTempRequests.php?SelectedPRQs=' + SelectedPRQs + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			if (responseText == 'reload') {
				history.go(0);
			}
			else {
				alert_box(responseText);
			}
		}
		else {
			ApprovedPRQs();
			alert_box("Action successful.Quotation requests generated");
		}
	}
	myRequest.update();
}
ProcessedRequests
function ProcessedRequests() {
	//alert("Kubaff");
	var pname = 'Application/ProcessedPRQs.php';
	myRequest = new ajaxObject(pname);
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
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function GeneratedQuotationRequests() {
	//alert("Kubaff");
	var pname = 'Application/GeneratedUnservicedQuotationRequests.php';
	myRequest = new ajaxObject(pname);
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
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function CheckQuotes() {
	var CheckQuotes = document.getElementById('QuoteCheck');
	var Quotes = document.getElementsByName('QuoteId');
	if (CheckQuotes.checked) {
		for (var i = 0; i <= Quotes.length; i++) {
			Quotes[i].checked = true;
		}
	}
	else {
		for (var i = 0; i <= Quotes.length; i++) {
			Quotes[i].checked = false;
		}
	}
}
function PrintSelectedQuotationRequests() {
	var Quotes = document.getElementsByName('QuoteId');
	var SelectedQuotes = '';
	for (var i = 0; i <= Quotes.length; i++) {
		if (Quotes[i].checked) {
			SelectedQuotes += Quotes[i].value + ":";
		}
		if (i == (Quotes.length - 1)) {
			ViewQuotePreview(SelectedQuotes);
		}
	}
}
function ViewQuotePreview(SelectedQuotes) {
	var pname = 'Application/QuotePreview.php?SelectedQuotes=' + SelectedQuotes + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (responseText == 'reload') {
			history.go(0);
		}
		else {
			div.innerHTML = responseText;
			div.style.display = 'block';
			div.style.position = 'absolute';
			div.style.left = '20%';
			div.style.top = '10%';
			div.style.width = 'auto';
			div.style.height = 'auto';
			div.style.width = 'auto';
		}
	}
	myRequest.update();
}
function GetQuotationItems(QuoteRequestId) {
	var pname = 'Application/GetQuotationItems.php?QuoteRequestId=' + QuoteRequestId + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '55%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function EnterQuotationReply() {
	//alert("fsadfsadfasdfsdF");
	var Quote = document.getElementsByName('QuoteId');
	var SelectedQuotes = 0;
	var TheQuote = '';
	for (var i = 0; i <= Quote.length; i++) {
		if (Quote[i].checked) {
			SelectedQuotes += 1;
			TheQuote = Quote[i].value;
		}
		if (i == (Quote.length - 1)) {
			if (SelectedQuotes > 1) {
				alert_box("You have selected more than one Quotation Request to insert reply for.You can only insert replies for one quotation request one at a time");
			}
			else {
				DisplayForQuotationReply(TheQuote);
			}
		}
	}
}
function DisplayForQuotationReply(QuoteRequestId) {
	var pname = 'Application/DisplayForQuotationReply.php?QuoteRequestId=' + QuoteRequestId + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		CheckIfRepliedBefore();
	}
	myRequest.update();
}
function CompleteSaveSupplierReply(SupplierId, QuoteId, SupplierPrice) {
	//alert("Supplier Id "+SupplierId+" Quote Id "+QuoteId+" Supplier Price "+SupplierPrice);
	var pname = 'Application/SaveSupplierReply.php?SupplierId=' + SupplierId + '&QuoteId=' + QuoteId + '&SupplierPrice=' + SupplierPrice + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			alert_box("Action successful.Replies Successfully made");
			closepopupdiv();
		}
	}
	myRequest.update();
}
function SaveSupplierReply(SupplierId) {
	var QuoteReply = document.getElementsByName('QuoteReplyId');
	for (var i = 0; i <= QuoteReply.length; i++) {
		QuoteId = QuoteReply[i].value;
		var SupplierPrice = document.getElementById('SupplierPrice' + QuoteId).value;
		CompleteSaveSupplierReply(SupplierId, QuoteId, SupplierPrice);
	}
}
function CompleteGeneratePRQs() {
	var SelectedRequests = document.getElementById('SelectedPRQs').value;
	var pname = 'Application/CompleteGeneratePRQs.php?SelectedRequests=' + SelectedRequests + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			closepopupdiv();
			ProcurementStockRequest();
			alert_box("Procurements generated successfully");
		}
	}
	myRequest.update();
}
function ShowItemsInProcurement(PRQId) {
	var pname = 'Application/ItemsInProcurementRequest.php?PRQId=' + PRQId + '&';
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function SelectSuppliersToRequest(CatId, RecId) {
	var pname = 'Application/SuppliersToRequest.php?CatId=' + CatId + '&RecId=' + RecId + '&';
	div = document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function SelectSuppliersChecks(CatId, RecId) {
	var CheckSupplier = document.getElementById('SupplierCheck');
	var SupplierId = document.getElementsByName("SupplierNo");
	var SelectedSuppliers = '';
	if (CheckSupplier.checked) {
		for (var i = 0; i <= SupplierId.length; i++) {
			SupplierId[i].checked = true;
		}
	}
	else {
		for (var i = 0; i <= SupplierId.length; i++) {
			SupplierId[i].checked = false;
		}
	}
}
function GrabSelectedSupplier(CatId, RecId) {
	var SupplierId = document.getElementsByName("SupplierNo" + CatId + RecId);
	var SelectedSuppliers = '';
	for (var i = 0; i <= SupplierId.length; i++) {
		if (SupplierId[i].checked) {
			SelectedSuppliers += SupplierId[i].value + ':';
		}
		if (i == (SupplierId.length - 1)) {
			document.getElementById('SelectedSuppliers' + CatId + RecId).value = SelectedSuppliers;
		}
	}
	/**/
}
function AddItemsAmtsInQuotation(CatId, RecId, PRQId) {
	var pname = 'Application/ItemsInQuotation.php?PRQId=' + PRQId + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('TheItems' + CatId + RecId).innerHTML = responseText;
	}
	myRequest.update();
}
function CompleteGenerateQuotation() {
	var PRQ = document.getElementsByName('PRQNo');
	//alert(PRQ.length);
	var count = 0;
	for (var i = 0; i <= PRQ.length; i++) {
		//alert(count);
		if (PRQ[i].checked) {
			var QuoteDetailsInfo = PRQ[i].value;
			// alert(QuoteDetailsInfo);
			var QuoteDetail = QuoteDetailsInfo.split('+');
			var CatId = QuoteDetail[0];
			var PRQId = QuoteDetail[1];
			var SelectedSuppliers = document.getElementById('SelectedSuppliers' + CatId + PRQId).value;
			//alert("sdfcasdfasdasd"+PRQId);
			GetItemAmts(PRQId);/**/
		}
		count++;
	}
}
function GetItemAmts(PRQId) {
}
function CacheStockAmt(StockId, thisItem, CatId, RQId) {
	var RQIds = document.getElementsByName("RQId" + PRQId);
	for (var i = 0; i <= RQIds.length; i++) {
		var TheRQ = PRQIds[i].value;
		var StockId = document.getElementById('RQStockId' + TheRQ).value;
		var StockAmt = document.getElementById('QtyToRequest' + TheRQ).value;
		alert(StockId + " " + StockAmt);
	}
}
function CheckIfEmpty() {
	var TempId = document.getElementsByName('TempId');
	var EmptyFields = 0;
	for (var i = 0; i <= TempId.length; i++) {
		var TempNo = TempId[i].value;
		var QtyRequested = document.getElementById('QtyRequested' + TempNo).value;
		//alert(QtyRequested);
		if (QtyRequested == '' || QtyRequested == 0) {
			EmptyFields += 1;
			document.getElementById('GeneratePRQs').style.visibility = 'hidden';
		}
		if (i == (TempId.length - 1)) {
			if (EmptyFields == 0) {
				document.getElementById('GeneratePRQs').style.visibility = 'visible';
			}
		}
	}
}
function StoreNewRequestAmtsFirst() {
	var TempId = document.getElementsByName('TempId');
	var SuccessRates = 0;
	for (var i = 0; i <= TempId.length; i++) {
		var TempNo = TempId[i].value;
		var QtyRequested = document.getElementById('QtyRequested' + TempNo).value;
		//alert(QtyRequested);
		StoreNewValuesFirst(TempNo, QtyRequested);
		var success = document.getElementById('SuccessStoringNewAmt').value;
		SuccessRates += success;
		if (i == (TempId.length - 1)) {
			if (SuccessRates > 0) {
				CompleteGeneratePRQs();
			}
		}
	}
}
function StoreNewValuesFirst(TempId, QtyRequested) {
	var pname = 'Application/StoreNewRequestAmts.php?TempId=' + TempId + '&QtyRequested=' + QtyRequested + '&';
	//alert(pname);
	var success = 0;
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		if (isNaN(responseText)) {
			alert_box(responseText);
			success = 0;
			document.getElementById('SuccessStoringNewAmt').value = 0;
		}
		else {
			success = 1;
			document.getElementById('SuccessStoringNewAmt').value = 1;
		}
	}
	myRequest.update();
}
function CompleteMakeQuotationRequest() {
	//alert("Kubaff");
	var PRQId = document.getElementById('RecId').value;
	var SupplierId = document.getElementsByName('SupplierNo');
	var SelectedSuppliers = '';
	var CountSelected = 0;
	for (var i = 0; i < SupplierId.length; i++) {
		if (SupplierId[i].checked) {
			SelectedSuppliers += SupplierId[i].value + ':';
			CountSelected += 1;
		}
		if (i == (SupplierId.length - 1)) {
			if (CountSelected == 0) {
				alert_box("Pleease select suppliers  to send quotation requests to ");
			}
			else {
				GenerateQuotationRequests(PRQId, SelectedSuppliers);
			}
		}
	}
}
function GenerateQuotationRequests(PRQId, SelectedSuppliers) {
	var pname = 'Application/GenerateQuotationRequest.php?PRQId=' + PRQId + '&SelectedSuppliers=' + SelectedSuppliers + '&';
	var myRequest = new ajaxObject(pname)
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else if (responseText == 'reload') {
			history.go(0);
		}
		else {
			alert_box("Action Successful.Quotation Requests Generated for the Selected Suppliers");
			ApprovedPRQs();
			closepopupdiv();
		}
	}
	myRequest.update();
}
function QuotationRequestSuppliers(QuoteRequestId) {
	var pname = 'Application/SelectedSuppliers.php?QuoteRequestId=' + QuoteRequestId + '&';
	div = document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function GetQuotationRequestItems(QuoteRequestId) {
	var pname = 'Application/GetQuotationItems.php?QuoteRequestId=' + QuoteRequestId + '&';
	div = document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function CheckIfRepliedBefore() {
	var QuoteRequestId = document.getElementById('QuoteRequestId').value;
	var Su = document.getElementById('SelectedSuppliers');
	var SupplierId = Su.options[Su.selectedIndex].value;
	var resultvars = '';
	var TheVars = '';
	var pname = 'Application/FetchQuoteRequestReplyDetails.php?QuoteRequestId=' + QuoteRequestId + '&SupplierId=' + SupplierId + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		//alert(responseText);
		var result = responseText.split('+');
		for (var i = 0; i <= result.length; i++) {
			resultvars = result[i];
			TheVars = resultvars.split(':');
			document.getElementById('SupplierPrice' + TheVars[0]).value = '';
			document.getElementById('RepyId').value = '';
			document.getElementById('SupplierPrice' + TheVars[0]).value = TheVars[1];
			document.getElementById('RepyId').value = TheVars[2];/*	*/
		}
	}
	myRequest.update();
}
/*function SaveSupplierReply()
{
	var StockId=document.getElementsByName('StockId');
	var QuoteRequestId=document.getElementById('QuoteRequestId').value;
	var ReplyId=document.getElementById('RepyId').value;
	var Su=document.getElementById('SelectedSuppliers');
	var SupplierId=Su.options[Su.selectedIndex].value;
	var SupplierReplies='';
	for(var i=0;i<=StockId.length;i++)
	{
		var SupplierPrice=document.getElementById('SupplierPrice'+StockId[i].value).value;
		var StockDetails=StockId[i].value+'*'+SupplierPrice+'+';
		SupplierReplies+=StockDetails+':';
		if(i==(StockId.length-1))
		{
			CompleteSaveSupplierReply(QuoteRequestId,SupplierId,SupplierReplies,ReplyId);
		}
	}
}
*/
function SaveSupplierReply() {
	var EntryItem = document.getElementsByName('EntryItem');
	var QuoteRequestId = document.getElementById('QuoteRequestId').value;
	var Cur = document.getElementById('Currency');
	var Currency = Cur.options[Cur.selectedIndex].value;
	var ReplyId = document.getElementById('RepyId').value;
	var EnteredItems = '';
	for (var i = 0; i <= EntryItem.length; i++) {
		var CountNo = EntryItem[i].value;
		var ItemNo = document.getElementById('ItemNo' + CountNo).value;
		var SupplierNo = document.getElementsByName('SupplierNo' + CountNo);
		//alert(SupplierNo.length);
		for (var S = 0; S <= SupplierNo.length - 1; S++) {
			//alert('SupplierPrice+'+SupplierNo[S].value+'+'+ItemNo+'+'+CountNo);
			var SupplierPrice = document.getElementById('SupplierPrice+' + SupplierNo[S].value + '+' + ItemNo + '+' + CountNo).value;
			EnteredItems += SupplierPrice + '*' + SupplierNo[S].value + '*' + ItemNo + ':';
		}
		if (i == EntryItem.length - 1) {
			//alert(EnteredItems)
			CompleteSaveSupplierReply(QuoteRequestId, EnteredItems, ReplyId, Currency)
		}
	}
}
function CompleteSaveSupplierReply(QuoteRequestId, EnteredItems, ReplyId, Currency) {
	var pname = 'Application/SaveSupplierRequestReply.php?QuoteRequestId=' + QuoteRequestId + '&EnteredItems=' + EnteredItems + '&ReplyId=' + ReplyId + '&Currency=' + Currency + '&';
	alert(pname);
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			alert_box("Action Successful.Replies successfully stored");
			closepopupdiv();
		}
	}
	myRequest.update();
}
function IssueLPO() {
	//alert("fsadfsadfasdfsdF");
	var Quote = document.getElementsByName('QuoteId');
	var SelectedQuotes = 0;
	var TheQuote = '';
	for (var i = 0; i <= Quote.length; i++) {
		if (Quote[i].checked) {
			SelectedQuotes += 1;
			TheQuote = Quote[i].value;
		}
		if (i == (Quote.length - 1)) {
			if (SelectedQuotes > 1) {
				alert_box("You have selected more than one Quotation Request to Issue LPOs for.You can only issue LPOs for one quotation request one at a time");
			}
			else {
				CompareQuotationReplies(TheQuote);
			}
		}
	}
}
function CompareQuotationReplies(TheQuote) {
	var pname = 'Application/CompareQuotationRequestsReplies.php?QuoteRequestId=' + TheQuote + '&';
	div = document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function CompleteIssueLPO() {
	var QuoteRequestId = document.getElementById('QuoteRequestId').value;
	var SupplierId = document.getElementsByName('SupplierCheck');
	var CountSelected = 0;
	for (var i = 0; i <= SupplierId.length; i++) {
		if (SupplierId[i].checked) {
			var Supplier = SupplierId[i].value;
			CountSelected += 1;
			var pname = 'Application/MakeLPO.php?SupplierId=' + Supplier + '&QuoteRequestId=' + QuoteRequestId + '&';
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function (responseText) {
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					alert_box("Action successful.LPO Made to the selected supplier");
					closepopupdiv();
				}
			}
			myRequest.update();
		}
		if (i == (SupplierId.length - 1)) {
			if (CountSelected == 0) {
				alert_box("Please select a supplier to issue LPO for");
			}
		}
	}
}
function ShowTheItems(StockItems) {
	var pname = 'Application/ShowItemsInRequest.php?StockItems=' + StockItems + '&';
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function ProcurementsDashBoard() {
	//This function will be used to display patients on the browser window
	var pname = "Application/ProcurementDashBoard.php";
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
