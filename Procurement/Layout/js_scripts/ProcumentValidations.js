// JavaScript Document

function ValidateSupplierInvoiceDetails()
{
	var reason = '';
	reason += validate_InvoiceNo();
	reason += validate_InvoiceDate();
	reason += validate_DateRecieved();
	reason += validate_Amt();
	
/*<!---->*/
		if (reason != '') 
		{
		
		alert_box("Please attend to the following:<br>" +reason);
		return false;
		}
		else
		{
			return true;
		}
}

function validate_InvoiceNo(){
	var critera = document.getElementById('InvNo');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in Invoice Number.<br>';}	
	return error;			
	}
	
function validate_InvoiceDate(){
	var critera = document.getElementById('InvDate');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in Date of Invoice.<br>';}	
	return error;			
	}
function validate_DateRecieved(){
	var critera = document.getElementById('DateRecieved');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in Date teh Invoice was recieved.<br>';}	
	return error;			
	}
	
function validate_Amt(){
	var critera = document.getElementById('InvAmt');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'The Selected supplies have not amount.<br>';}	
	return error;			
	}