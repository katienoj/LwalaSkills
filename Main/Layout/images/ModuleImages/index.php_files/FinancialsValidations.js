// JavaScript Document
function ValidateSubAccountDetails()
{
	var reason = '';
	reason += validate_AccountName();
	reason += validate_AccountType();
	reason += validate_ModuleId();

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

function validate_AccountName(){
	var critera = document.getElementById('AccountName');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the name of Sub Account.<br>';}	
	return error;			
}
function validate_AccountType(){
	var AccountT = document.getElementById('AccountType');	
	var critera=AccountT.options[AccountT.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have selected the Parent Account.<br>';}	
	return error;			
	}

function validate_ModuleId(){
	var ModuleI = document.getElementById('ModuleId');	
	var critera=ModuleI.options[ModuleI.selectedIndex];
	var LinkedToModule=document.getElementById('LinkedToModule');
	
	if(LinkedToModule.checked)
	{
		var LinkedTo=1;
	}
	var error = '';
	
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0 && LinkedTo==1){var error = 'You have selected the Module to link this sub Account to.<br>';}	
	return error;			
}



function ValidateFinancialYearPeriod()
{
	var reason = '';
	reason += validate_StartDate();
	reason += validate_EndDate();
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


function validate_StartDate()
{
	var critera = document.getElementById('StartDate');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not Selected the Start Date for the Financial Year.<br>';}	
	return error;			
}
function validate_EndDate()
{
	var critera = document.getElementById('EndDate');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not Selected the End Date for the Financial Year.<br>';}	
	return error;			
}


function ValidateChartOfAccount()
{
	var reason = '';
	reason += validate_AccountName();
	reason += validate_AccountType();
	reason += validate_ModuleId();
	reason += validate_DeptId();
	reason += validate_SeqNo();
	reason += validate_TypeOfAccount();
/**/

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

function validate_AccountName()
{
	var critera=document.getElementById('AccountName');
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the name of the Account for the Chart.<br>';}	
	return error;		
}

function validate_AccountType()
{
	var Acc=document.getElementById('AccountType');
	var critera=Acc.options[Acc.selectedIndex];

	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not Selected the Account Type for the Chart.<br>';}	
	return error;		
}
function validate_ModuleId()
{
	var ModuleI = document.getElementById('ModuleId');	
	var critera=ModuleI.options[ModuleI.selectedIndex];
	var LinkedToModule=document.getElementById('LinkedToModule');
	
	if(LinkedToModule.checked)
	{
		var LinkedTo=1;
	}
	var error = '';
	
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0 && LinkedTo==1){var error = 'You have selected the Module to link this Chart of Account to.<br>';}	
	return error;			
}

function validate_DeptId()
{
	var critera=document.getElementById('DeptId');
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not Selected the Department for the Chart.<br>';}	
	return error;		
}
function validate_TypeOfAccount()
{
	var TypeOfAccount=document.getElementsByName('TypeOfAccount');
    var CountSelected=0;
	var error = '';
	var j=0;		
	for(var i=0;i<=TypeOfAccount.length;i++)
	{
		if(TypeOfAccount[i].checked)
		{
				CountSelected+=1;
		}
	    if(i==(TypeOfAccount.length-1))
		{
			if(CountSelected > 0){var j=1; }	
			if(j==0){var error = 'You have not Selected the Type of Account for the Chart.<br>';}	
			return error;
		}
	}	
}
function validate_SeqNo()
{
	var critera=document.getElementById('SequentialNo');
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not type in the Sequence Number for the Chart.<br>';}	
	return error;		
}


function ValidateModuleTableMap()
{
	var reason = '';
	
	reason += validate_Datatable();
	reason += validate_MapModuleId();

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


function validate_Datatable()
{
	var Datatable = document.getElementById('Datatables');	
	var critera=Datatable.options[Datatable.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected a table to link to .<br>';}	
	return error;			
}

function validate_MapModuleId()
{
	var ModuleI = document.getElementById('ModuleId');	
	var critera=ModuleI.options[ModuleI.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected the Module to link a table to.<br>';}	
	return error;			
}


function validateChartModuleMap()
{
	var reason = '';
	
	reason += validate_DataSource();
	reason += validate_ChartModuleId();

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



function validate_ChartModuleId()
{

	var ModuleI = document.getElementById('ModuleId');	
	var critera=ModuleI.options[ModuleI.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected the Module.<br>';}	
	return error;			
}

function validate_DataSource()
{

	var DataSource= document.getElementById('DataSourceName');	
	var critera=DataSource.options[DataSource.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0 || critera.value=='undefined'){var error = 'You have not selected a data source in the module.<br>';}	
	return error;			
}

function validateJournalAccount()
{
	var reason = '';
	
	reason += validate_journalAccountName();
	reason += validate_GLAccountNumber();
	reason += validate_journalAccountDate();
	reason += validate_journalRefNo();
	reason += validate_journalTypeOfAccount();
	reason += validate_journalAccountPeriod();
	reason += validate_journalRecurringPeriod();
	reason += validate_journalAccountDescription();
	reason += validate_journalAccountJustification();

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



function validate_journalAccountName()
{
	var critera = document.getElementById('AccountName');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the name of Journal Account.<br>';}	
	return error;			
}

function validate_GLAccountNumber()
{
	var critera = document.getElementById('GLAccountNumber');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the GL Account Number.<br>';}	
	return error;			
}


function validate_journalAccountDate()
{
	var critera = document.getElementById('AccountDate');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Date of Journal Account.<br>';}	
	return error;			
}


function validate_journalRefNo()
{
	var critera = document.getElementById('RefNo');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Ref Number of Journal Account.<br>';}	
	return error;			
}

function validate_journalAccountPeriod()
{
	var critera = document.getElementById('AccountPeriod');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Account Period of Journal Account.<br>';}	
	return error;			
}

function validate_journalTypeOfAccount()
{
	var TypeOfAccount=document.getElementsByName('TypeOfAccount');
    var CountSelected=0;
	var error = '';
	var j=0;		
	for(var i=0;i<=TypeOfAccount.length;i++)
	{
		if(TypeOfAccount[i].checked)
		{
				CountSelected+=1;
		}
	    if(i==(TypeOfAccount.length-1))
		{
			if(CountSelected > 0){var j=1; }	
			if(j==0){var error = 'You have not Selected the Type of Account for the Journal Account.<br>';}	
			return error;
		}
	}	

}

function validate_journalRecurringPeriod()
{
	
	var critera = document.getElementById('AccountPeriod');	
	var AccountRecurring=document.getElementById('AccountRecurring');
	var AccountRecur='';
	if(AccountRecurring.checked)
	{
		var AccountRecur=1;
	}
	var error = '';
	
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0 && AccountRecur==1){var error = 'You have not typed in the recurring Period for the Journal Account.<br>';}	
	return error;			

}


function validate_journalAccountDescription()
{
	var critera = document.getElementById('AccountDescription');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Description of the Journal Account.<br>';}	
	return error;			
}


function validate_journalAccountJustification()
{
	var critera = document.getElementById('AccountJustification');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the justification of the Journal Account.<br>';}	
	return error;			
}


function ValidatePostToAccount()
{
	
	var reason = '';
	
	reason += validate_postDescription();
	reason += validate_postAmount();
	reason += validate_postcurrency();
	reason += validate_postFinancialYear();
    reason += validate_postFinancialPeriod();
	
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

function validate_postDescription()
{
	var critera = document.getElementById('PostDescription');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Description of the Entry.<br>';}	
	return error;			
}
function validate_postcurrency()
{
	var Currency= document.getElementById('Currency');	
	var critera=Currency.options[Currency.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected the currency of the Currency<br>';}	
	return error;			
}

function validate_postAmount()
{
	var critera = document.getElementById('PostAmount');	
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not typed in the Amount of the Entry.<br>';}	
	return error;			
}


function validate_postFinancialYear()
{
	var FinancialYear= document.getElementById('FinancialYear');	
	var critera=FinancialYear.options[FinancialYear.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected the financial year for the Entry<br>';}	
	return error;			
}
function validate_postFinancialPeriod()
{
	var FinancialMonth= document.getElementById('MonthsInYear');	
	var critera=FinancialMonth.options[FinancialMonth.selectedIndex];
	var error = '';
	var j=0;		
	if(critera.value.length > 0){var j=1; }	
	if(j==0){var error = 'You have not selected the financial Period for the Entry<br>';}	
	return error;			
}