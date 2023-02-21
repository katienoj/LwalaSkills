// JavaScript Document

function ChartOfAccounts()
{
	/*var myRequest=new ajaxObject("Application/AccountsChart.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('main_window').innerHTML=responseText; 
	}
	myRequest.update();*/
}
function GLSubAccounts()
{
	var pname='Application/SubAccounts.php';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		ShowSubAccounts();
	}
	myRequest.update();
}

function ShowSubAccounts()
{
	//This function will be used to show the dashboard.It calls the dashboard script from the database and displays it
	var myRequest=new ajaxObject("Application/SubAccountsView.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('SubAccounts').innerHTML=responseText; 
	}
	myRequest.update();
}


function SaveSubAccount()
{
	var AccountName=document.getElementById('AccountName').value;
	var AccountT=document.getElementById('AccountType');
	var AccountType=AccountT.options[AccountT.selectedIndex].value;
	var ModuleI=document.getElementById('ModuleId');
	var ModuleId= ModuleI.options[ ModuleI.selectedIndex].value;
	var LinkedToModule=document.getElementById('LinkedToModule');
	var SubAccountId=document.getElementById('SubAccountId').value;
	if(LinkedToModule.checked)
	{
		var LinkedTo=1;
	}
	else
	{
		var LinkedTo=0;
	}
	
	if(ValidateSubAccountDetails()!=false)
	{
		var pname='Application/SaveSubAccount.php?AccountName='+AccountName+'&AccountType='+AccountType+'&ModuleId='+ModuleId+'&LinkedTo='+LinkedTo+'&SubAccountId='+SubAccountId+'&';
	    var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				document.getElementById('SubAccountId').value=''; 
				document.getElementById('AccountName').value=''; 
				ShowSubAccounts();
			}
		}
		myRequest.update();
	}
}

function DeleteSelectedSubAccounts()
{
	var SubAccount=document.getElementsByName('AccountId');
	var SelectedAccounts='';
	var CountSelected=0;
	for(var i=0;i<=SubAccount.length;i++)
	{
		if(SubAccount[i].checked)
		{
			CountSelected+=1;
			SelectedAccounts+=SubAccount[i].value+':';
		}
		if(i==(SubAccount.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please Select SubAccounts to Delete");
			}
			else
			{
				Confirm_Box("You are about to delete some Sub Accounts.Are you sure of this action","ProceedDeleteSubAccount");
			}
		}
	}
}

function ProceedDeleteSubAccount()
{
	var SubAccount=document.getElementsByName('AccountId');
	var SelectedAccounts='';
	var CountSelected=0;
	for(var i=0;i<=SubAccount.length;i++)
	{
		if(SubAccount[i].checked)
		{
			CompleteDeleteSubAccount(SubAccount[i].value);
		}
	}
}

function SelectSubAccount()
{
	var SubAccount=document.getElementsByName('AccountId');
	
	for(var i=0;i<=SubAccount.length;i++)
	{
		if(SubAccount[i].checked)
		{
			LoadSubAccountInfo(SubAccount[i].value);
		}
	}
}

function LoadSubAccountInfo(SubAccountId)
{
	 var pname='Application/FetchSubAccountInfo.php?SubAccountId='+SubAccountId+'&';
	 var myRequest=new ajaxObject(pname);
	 myRequest.callback=function(responseText)
	 {
			var result=responseText.split(':');
			document.getElementById('AccountName').value=result[0];
		   var  AccountType=document.getElementById('AccountType');
		   AccountType[0]=new Option(result[2],result[1],true,true);
		   var ModuleId=document.getElementById('ModuleId');
		   ModuleId[0]=new Option(result[5],result[4],true,true);
			 var LinkedToModule=document.getElementById('LinkedToModule');
			 document.getElementById('SubAccountId').value=SubAccountId;
		   if(result[3]==1)
		   {
			   LinkedToModule.checked=true;
		   }
		   else
		   {
			   LinkedToModule.checked=false;
		   }
		
			
	 }
	 myRequest.update();
}


function CompleteDeleteSubAccount(SubAccountId)
{
	 var pname='Application/DeleteSubAccount.php?SubAccountId='+SubAccountId+'&';
	 var myRequest=new ajaxObject(pname);
	 myRequest.callback=function(responseText)
	 {
		 if(isNaN(responseText))
		 {
			 alert_box(responseText);
		 }
		 else
		 {
			 ShowSubAccounts();
			 close_alert_div();
		 }
	 }
	 myRequest.update();
}



function GLFinancialYears()
{
	var pname='Application/FinancialYears.php';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		ShowSavedFinancialYearPeriods();
	}
	myRequest.update();
}


function ShowFinancialPeriods(YearId)
{
	var pname='Application/FinancialMonths.php?YearId='+YearId+'&';
	var div=document.getElementById('popup_div_1');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='35%';
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		ShowFinancialMonths(YearId);
	}
	myRequest.update();
}
function ShowFinancialMonths(YearId)
{
	
	var pname='Application/MadeFinancialMonths.php?YearId='+YearId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		document.getElementById('FinancialMonths').innerHTML=responseText;
	}
	myRequest.update();

}
function ShowSavedFinancialYearPeriods()
{
	var pname='Application/ShowFinancialYears.php';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		document.getElementById('ShowFinancialYear').innerHTML=responseText;
	}
	myRequest.update();
}

function SaveFinancialYearPeriod()
{
	var StartDate=document.getElementById('StartDate').value;
	var EndDate=document.getElementById('EndDate').value;
	var YearNo=document.getElementById('YearNo').value;
	if(ValidateFinancialYearPeriod()!=false)
	{
		var pname='Application/SaveFinancialYear.php?StartDate='+StartDate+'&EndDate='+EndDate+'&YearNo='+YearNo+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				YearNo='';
				ShowSavedFinancialYearPeriods();
			}
		}
		myRequest.update();
	}
	
}


function SelectFinancialYear()
{
	var YearId=document.getElementsByName('YearId');
	for(var i=0;i<YearId.length;i++)
	{
		if(YearId[i].checked)
		{
			ShowYearDetails(YearId[i].value);
		}
	}
}



function ShowYearDetails(YearId)
{
	var pname='Application/FetchYearDetails.php?YearId='+YearId+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		var result=responseText.split(':');
		document.getElementById('StartDate').value=result[0];
		document.getElementById('EndDate').value=result[1];
		document.getElementById('YearNo').value=YearId;
	}
	myRequest.update();
}



function DeleteSelectedYears()
{
	var YearId=document.getElementsByName('YearId');
	var SelectedYears='';
	var CountSelected=0;
	for(var i=0;i<=YearId.length;i++)
	{
		if(YearId[i].checked)
		{
			CountSelected+=1;
			SelectedYears+=YearId[i].value+':';
		}
		if(i==(YearId.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please Select Financial Years to Delete");
			}
			else
			{
				Confirm_Box("You are about to delete some Finanacial Years.Are you sure of this action","ProceedDeleteFinancialYear");
			}
		}
	}

}


function ProceedDeleteFinancialYear()
{
	var YearId=document.getElementsByName('YearId');
	var SelectedYears='';
	var CountSelected=0;
	for(var i=0;i<=YearId.length;i++)
	{
		if(YearId[i].checked)
		{
			CompleteDeleteFinancialYear(YearId[i].value);
		}
	}
}


function CompleteDeleteFinancialYear(YearId)
{
	var pname='Application/DeleteFinancialYear.php?YearId='+YearId+'&';
	 var myRequest=new ajaxObject(pname);
	 myRequest.callback=function(responseText)
	 {
		 if(isNaN(responseText))
		 {
			 alert_box(responseText);
		 }
		 else
		 {
			ShowSavedFinancialYearPeriods();
			 close_alert_div();
		 }
	 }
	 myRequest.update();
}


function LoadSubAccounts(AccountId)
{
	var pname='Application/ShowSubAccounts.php?AccountId='+AccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		document.getElementById('ShowTheSubAccounts'+AccountId).innerHTML=responseText;
		document.getElementById('ShowTheSubAccounts'+AccountId).style.display='block';
	}
	myRequest.update();
	
}

function EditChartDetails(AccountId)
{
	var pname='Application/EditChartOfAccount.php?AccountId='+AccountId+'&';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
	    CloseAccountsMenu();
		CheckIfModuleisConnected();
		CheckTypeOfAccountRadios();
		CheckBudgetControl();
	}
	myRequest.update();
}


function AddChartOfAccount(ParentAccountId)
{
	if( ParentAccountId=='undefined') 
	{
		 ParentAccountId=0;
	}
	var pname='Application/AddChartOfAccount.php?ParentAccountId='+ParentAccountId+'&';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
	    CloseAccountsMenu();
		CheckIfModuleisConnected();
		CheckTypeOfAccountRadios();
		CheckBudgetControl();
		
	}
	myRequest.update();
}

function CheckIfModuleisConnected()
{
	var prevLinkedTo=document.getElementById('prevLinkedTo').value;
	if(prevLinkedTo!='')
	{
		document.getElementById('LinkedToModule').checked=true;
		document.getElementById('ShowModule').style.display='block';
	}
}

function CheckTypeOfAccountRadios()
{
	var TypeAccVal=document.getElementById('TypeAccVal').value;
	var TypeOfAcc=document.getElementsByName('TypeOfAccount');
	for(var i=0;i<=TypeOfAcc.length;i++)
	{
		
		var TypeAcc=TypeOfAcc[i].value;
	//	alert("Type Account Val "+TypeAccVal+' TypeAcc '+TypeAcc);
		if(TypeAccVal==TypeAcc)
		{
			TypeOfAcc[i].checked=true;
		}
	}
	
	
	
}
function CheckBudgetControl()
{
	var BudgetaryControl=document.getElementsByName('BudgetaryControl'); 
	var BudgetControVal=document.getElementById('BudgetControlVal');
	for(var i=0;i<=BudgetaryControl.length;i++)
	{
		var BControl=BudgetaryControl[i].value;
		if(BControl==BudgetControVal.value)
		{
			BudgetaryControl[i].checked=true;
		}
	}
}
function LoadAccounts()
{
	var AccountT=document.getElementById('AccountType');
	var AccountType=AccountT.options[AccountT.selectedIndex].value;
	
	var pname='Application/FetchAccountsInType.php?TypeId='+AccountType+'&'
    var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		document.getElementById('Accounts').innerHTML=responseText;
		 LoadSubAccountsInAccount();
	}
	myRequest.update();
}

function LoadSubAccountsInAccount()
{
	var AccountT=document.getElementById('AccountsInType');
	var Accounts=AccountT.options[AccountT.selectedIndex].value;
	
	var pname='Application/FetchSubAccountsInAccount.php?AccountId='+Accounts+'&'
    var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		document.getElementById('SubAccounts').innerHTML=responseText;
	}
	myRequest.update();
}


function LoadDeptId()
{
	var Dept=document.getElementById('DeptName');
	document.getElementById('DeptId').value=Dept.value;
}

function ShowModuleDropDown()
{
	var LinkedTo=document.getElementById('LinkedToModule');
	if(LinkedTo.checked)
	{
		document.getElementById('ShowModule').style.display='block';
	}
	else
	{
		document.getElementById('ShowModule').style.display='none';
	}
		
}


function SaveChartOfAccount()
{
	
	var LinkedTo='';
	var AccountT=document.getElementById('AccountType');
	var AccountType=AccountT.options[AccountT.selectedIndex].value;
	var AccountName=document.getElementById('AccountName').value;
	var Dept=document.getElementById('DeptId').value;
	var SeqNo=document.getElementById('SequentialNo').value;
	var TypeOfAccount=document.getElementsByName('TypeOfAccount');
	var LinkedToModule=document.getElementById('LinkedToModule');
	var Module=document.getElementById('ModuleId');
	var ModuleId=Module.options[Module.selectedIndex].value;
	var BudgetControl=document.getElementsByName('BudgetControl');
	var Tolerance=document.getElementById('BudgetTolerance').value;
	var OverRideAmt=document.getElementById('BudgetOverrideAmt').value;
    var Reversal=document.getElementById('ReversalMethod');
	var ReversalMethod=Reversal.options[Reversal.selectedIndex].value;
	var ReversalT=document.getElementById('ReversalType');
	var ReversalType=ReversalT.options[ReversalT.selectedIndex].value;
	var TypeAcc=document.getElementById('TypeAccVal').value;
	var BudgetCtrl=document.getElementById('BudgetControlVal').value;
	var ParentAccountId=document.getElementById('ParentAccountId').value;
	var ChartOfAccountId=document.getElementById('ChartOfAccountId').value;	
	if(LinkedToModule.checked)
	{
	    LinkedTo=LinkedToModule.value;
	}
	
	
	
	if(ValidateChartOfAccount()!=false)
	{
		var pname='Application/StoreChartOfAccount.php?AccountType='+AccountType+'&AccountName='+AccountName+'&Dept='+Dept+'&SeqNo='+SeqNo+'&ModuleId='+ModuleId+'&Tolerance='+Tolerance+'&OverrideAmt='+OverRideAmt+'&ReversalMethod='+ReversalType+'&TypeAcc='+TypeAcc+'&BudgetCtrl='+BudgetCtrl+'&LinkedTo='+LinkedTo+'&ReversalType='+ReversalType+'&ParentAccountId='+ParentAccountId+'&ChartOfAccountId='+ChartOfAccountId+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				ReloadWindow();
				closepopupdiv();
			}
				
		}
		myRequest.update();
	}
	
							
	
}



function GetTypeAccValue()
{
	var TypeOfAccount=document.getElementsByName('TypeOfAccount');
	for(var i=0;i<=TypeOfAccount.length;i++)
	{
		if(TypeOfAccount[i].checked)
		{
			  //alert(TypeOfAccount[i].value);
				document.getElementById('TypeAccVal').value=TypeOfAccount[i].value;
				break;
		}
	}
}



function GetBudgetAccValue()
{
	var BudgetControl=document.getElementsByName('BudgetaryControl');
	for(var i=0;i<=BudgetControl.length;i++)
	{
		if(BudgetControl[i].checked)
		{
				document.getElementById('BudgetControlVal').value=BudgetControl[i].value;
				break;
		}
	}
}


function LoadChartOfAccountsDetails(AccountId)
{
	var pname='Application/LoadChartOfAccountsDetails.php?AccountId='+AccountId+'&';
	var div=document.getElementById('popup_div');
    var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='45%';
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		CloseAccountsMenu();
	}
	myRequest.update();
}

function DeleteChartAccount(AccountId)
{
	
	 Confirm_Box("Are you sure you want to delete this Chart Account","ProceedDeleteChartAccount("+AccountId+")");
}
function ProceedDeleteChartAccount(AccountId)
{
    var pname='Application/DeleteChartOfAccount.php?AccountId='+AccountId+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			close_alert_div();
			CloseAccountsMenu();
			ReloadWindow();
		}
	}
	myRequest.update();
}
function ShowMadeAccountGroups()
{
	var myRequest=new ajaxObject('Application/MadeAccountGroups.php');
	myRequest.callback=function(responseText)
	{
		document.getElementById('ShowMadeAccountGroups').innerHTML=responseText;
	}
	myRequest.update();
	
}

function AccountGroupSetup()
{
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/AccountGroupSetup.php');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		ShowMadeAccountGroups();
	}
	myRequest.update();
}


function CheckAccountGroup()
{
	var AccountGroup=document.getElementsByName('AccountGroup');
	
	for(var i=0;i<=AccountGroup.length;i++)
	{
		if(AccountGroup[i].checked)
		{
			var pname='Application/GetAccountGroupDetails.php?AccountGroupId='+AccountGroup[i].value+'&';
			var myRequest=new ajaxObject(pname);
			myRequest.callback=function(responseText)
			{
				document.getElementById('AccountGroupName').value=responseText;
				document.getElementById('AccountGroupId').value=AccountGroup[i].value;
			}
			myRequest.update();
			break;
		}
	}
}
function DeleteAccountGroup()
{
	Confirm_Box("Are you sure you want to delete the selected Account Type(s)?","ProceedDeleteAccountGroup"); 
}
function ProceedDeleteAccountGroup()
{
	var AccountGroup=document.getElementsByName('AccountGroup');
	
	for(var i=0;i<=AccountGroup.length;i++)
	{
		if(AccountGroup[i].checked)
		{
			var pname='Application/DeleteAccountGroup.php?Id='+AccountGroup[i].value+'&';
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
					AccountGroupSetup();
					close_alert_div();
				}
			}
			myRequest.update();
		}
	}
}





function CheckAccountGroup()
{
	var AccountGroup=document.getElementsByName('AccountGroup');
	
	for(var i=0;i<=AccountGroup.length;i++)
	{
		if(AccountGroup[i].checked)
		{
			var pname='Application/GetAccountGroupDetails.php?AccountGroupId='+AccountGroup[i].value+'&';
			var myRequest=new ajaxObject(pname);
			myRequest.callback=function(responseText)
			{
				document.getElementById('AccountGroupName').value=responseText;
				document.getElementById('AccountGroupId').value=AccountGroup[i].value;
			}
			myRequest.update();
			break;
		}
	}
}
function DeleteAccountGroup()
{
	Confirm_Box("Are you sure you want to delete the selected Account Group?","ProceedDeleteAccountGroup"); 
}
function ProceedDeleteAccountGroup()
{
	var AccountGroup=document.getElementsByName('AccountGroup');
	
	for(var i=0;i<=AccountGroup.length;i++)
	{
		if(AccountGroup[i].checked)
		{
			var pname='Application/DeleteAccountGroup.php?Id='+AccountGroup[i].value+'&';
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
					AccountGroupSetup();
					close_alert_div();
				}
			}
			myRequest.update();
		}
	}
}

function ShowLinkedItems(PackageId,StockItems)
{
	var div=document.getElementById('popup_div_1');
	myRequest = new ajaxObject('Application/Stock/ShowLinkedItems.php?PackageId='+PackageId+'&StockItems='+StockItems+'&');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='45%';
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
	
}


function StoreAccountGroup()
{
	var AccountGroupName=document.getElementById('AccountGroupName').value;
	var AccountGroupId=document.getElementById('AccountGroupId').value;
	if(AccountGroupName=='')
	{
		alert_box("Please type in the name of the Account Group you want to setup");
	}
	else
	{
		var pname='Application/StoreAccountGroupSetup.php?AccountGroupName='+AccountGroupName+'&AccountGroupId='+AccountGroupId+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				AccountGroupSetup();
			}
		}
		myRequest.update();
	}
	
}

function ShowMadeAccounts()
{
	var myRequest=new ajaxObject('Application/MadeAccounts.php');
	myRequest.callback=function(responseText)
	{
		document.getElementById('ShowMadeAccounts').innerHTML=responseText;
	}
	myRequest.update();
	
}

function FinancialAccountsSetup()
{
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/FinancialAccountsSetup.php');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%';
		div.style.top='15%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
		ShowMadeAccounts();
	}
	myRequest.update();
}

function StoreAccount()
{
	var AccountGroupName=document.getElementById('AccountName').value;
	var AccountT=document.getElementById('AccountType');
	var AccountType=AccountT.options[AccountT.selectedIndex].value;
	var AccountId=document.getElementById('AccountId').value;
	if(AccountGroupName=='')
	{
		alert_box("Please type in the name of the Account Group you want to setup");
	}
	else
	{
		var pname='Application/StoreAccountSetup.php?AccountName='+AccountGroupName+'&AccountId='+AccountId+'&AccountType='+AccountType+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				FinancialAccountsSetup();
			}
		}
		myRequest.update();
	}
	
}

function CheckAccount()
{
	var FinAccount=document.getElementsByName('FinancialAccount');
	var AccountT=document.getElementById('AccountType');
	for(var i=0;i<=FinAccount.length;i++)
	{
		if(FinAccount[i].checked)
		{
			var pname='Application/GetAccountDetails.php?FinAccount='+FinAccount[i].value+'&';
			var myRequest=new ajaxObject(pname);
			myRequest.callback=function(responseText)
			{
				var result=responseText.split(':');
				document.getElementById('AccountName').value=result[0];
				AccountT.options[0]=new Option(result[2],result[1],true,true);
				document.getElementById('AccountId').value=FinAccount[i].value;
				
			}
			myRequest.update();
			break;
		}
	}

	
}


function DeleteFinancialAccount()
{
	Confirm_Box("Are you sure you want to delete the selected Account?","ProceedDeleteFinancialAccount"); 
}
function ProceedDeleteFinancialAccount()
{
	var FinancialAccount=document.getElementsByName('FinancialAccount');
	
	for(var i=0;i<=FinancialAccount.length;i++)
	{
		if(FinancialAccount[i].checked)
		{
			var pname='Application/DeleteFinancialAccount.php?Id='+FinancialAccount[i].value+'&';
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
					FinancialAccountsSetup();
					close_alert_div();
				}
			}
			myRequest.update();
		}
	}
}



function GetDaysInMonth()
{
	var FinancialM=document.getElementById('FinancialMonth');
	var FinancialMonth=FinancialM.options[FinancialM.selectedIndex].value;
	var MonthStartDate=document.getElementById('MonthStartDate');
	var MonthEndDate=document.getElementById('MonthEndDate');
    MonthStartDate.options.length=0;
	MonthEndDate.options.length=0;
	var myRequest=new ajaxObject('Application/GetDaysInMonth.php?MonthOfYear='+FinancialMonth+'&');								
	myRequest.callback=function(responseText)
	{
		
		for(var i=1;i<=responseText;i++)
		{
			if(i<=responseText)
			{
			MonthStartDate.options[i-1]=new Option(i,i,true,true);
			MonthEndDate.options[i-1]=new Option(i,i,true,true);
			}
		}
	}
	myRequest.update();
}

function SaveFinancialMonthDates()
{
	var MonthStartD=document.getElementById('MonthStartDate');
	var MonthStartDate=MonthStartD.options[MonthStartD.selectedIndex].value; 
	var MonthEndD=document.getElementById('MonthEndDate');
	var MonthEndDate=MonthEndD.options[MonthEndD.selectedIndex].value; 
	var FinancialM=document.getElementById('FinancialMonth');
	var FinancialMonth=FinancialM.options[FinancialM.selectedIndex].value; 
	var YearId=document.getElementById('YearId').value;
	var MonthId=document.getElementById('MonthId').value;
	if(MonthStartDate>MonthEndDate)
	{
		alert_box("Month End Date appears to be smaller than month Start Date");
	}
	else
    {
		var pname='Application/SaveFinancialMonthDates.php?MonthStartDate='+MonthStartDate+'&MonthEndDate='+MonthEndDate+'&FinancialMonth='+FinancialMonth+'&YearId='+YearId+'&MonthId='+MonthId+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				 ShowFinancialMonths(YearId);
			}
		}
		myRequest.update();
		
	}
}

function SelectFinancialMonth()
{
	var MonthId=document.getElementsByName('MonthId');
	var MonthStartD=document.getElementById('MonthStartDate');
	var MonthEndD=document.getElementById('MonthEndDate');
	var FinancialM=document.getElementById('FinancialMonth');
     GetDaysInMonth();
	for(var i=0;i<=MonthId.length;i++)
	{ 
	     if(MonthId[i].checked)
		 {
			 var pname='Application/GetFinancialMonthDetails.php?MonthId='+MonthId[i].value+'&';
			 var myRequest=new ajaxObject(pname);
			 myRequest.callback=function(responseText)
			 {
				 var result=responseText.split(':');
				 MonthStartD.options[0]=new Option(result[1],result[1],true,true);
				 MonthEndD.options[0]=new Option(result[2],result[2],true,true);
				 FinancialM.options[0]=new Option(result[0],result[0],true,true);
				 document.getElementById('MonthId').value=MonthId[i].value;
			 }
		    myRequest.update();
		 }
	}
}


function LoadChartSubMenu(AccountId,e)
{
	var div=document.getElementById('Submenu_div');
	//alert("X "+e.clientX+" Y "+e.clientY);
	myRequest = new ajaxObject('Application/AccountsMenu.php?AccountId='+AccountId+'&');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left=e.clientX ;
		div.style.top=e.clientY;
		div.style.width='auto';
		div.style.height='auto';
		
	}
	myRequest.update();

}

function CloseAccountsMenu()
{
	 document.getElementById('Submenu_div').style.display='none';
}

function CheckCoords(e)
{
	alert("X coord "+e.clientX+" Y coord "+e.clientY);
}
function silentErrorHandler() 
{
	return true;
}

function ReloadWindow()
{
	history.go(0);
}


function SalesSQLGenerator()
{
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/SalesSQLGenerator.php');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
		ShowMappedModuleTables();
	}
	myRequest.update();

}


function SaveModuleTableMap()
{
	var ModuleI=document.getElementById('ModuleId');
	var ModuleId=ModuleI.options[ModuleI.selectedIndex].value;
	
	var DataT=document.getElementById('Datatables');
	var Datatable=DataT.options[DataT.selectedIndex].value;
	
	var FieldT=document.getElementById('FieldInTable');
	var FieldInTable=FieldT.options[FieldT.selectedIndex].value;
	
	var MapId=document.getElementById('MapNo').value;
	var DataSourceName=document.getElementById('DataSourceName').value;
	if(ValidateModuleTableMap()!=false)
	{
		var pname='Application/SaveModuleTableMap.php?ModuleId='+ModuleId+'&Datatable='+Datatable+'&MapId='+MapId+'&DataSourceName='+DataSourceName+'&FieldInTable='+FieldInTable+'&';
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				document.getElementById('MapNo').value='';
				document.getElementById('DataSourceName').value='';
			   ModuleI.options[0]=new Option('--Please select--','',true,true);
			   DataT.options[0]=new Option('--Please select--','',true,true);
			  FieldT.options[0]=new Option('--Please select--','',true,true)
				ShowMappedModuleTables();
			}
		}
		myRequest.update();
	}
}



function ShowMappedModuleTables()
{
	var myRequest=new ajaxObject('Application/MappedModuleTables.php');
	myRequest.callback=function(responseText)
	{
		document.getElementById('ShowMappedModuleTables').innerHTML=responseText;
	}
	myRequest.update();
}


function LoadModuleMapDetails(MapNo)
{
	var pname='Application/FetchMapDetails.php?MapId='+MapNo+'&';
	var ModuleI=document.getElementById('ModuleId');	
	var DataT=document.getElementById('Datatables');
	var FieldT=document.getElementById('FieldInTable');
	var MapId=document.getElementById('MapNo').value;
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		var result=responseText.split(':');
		ModuleI.options[0]=new Option(result[1],result[0],true,true);
		DataT.options[0]=new Option(result[2],result[2],true,true);
		document.getElementById('DataSourceName').value=result[3];
		FieldT.options[0]=new Option(result[4],result[4],true,true);
		document.getElementById('MapNo').value=MapNo;
	}
	myRequest.update();
	
	
}


function DeleteSelectedMap()
{
	var MapId=document.getElementsByName('MapId');
	var CountSelected=0
	for(var i=0;i<=MapId.length;i++)
	{
		if(MapId[i].checked)
		{
			 CountSelected+=1;
		}
		if(i==(MapId.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please select a Map Delete");
			}
			else
			{
				Confirm_Box("Are you sure you want to delete the selected Module to Tablew mappings","proceedDeleteMap");
			}
		}
	}
	
}


function proceedDeleteMap()
{
	var MapId=document.getElementsByName('MapId');
	var SelectedMaps='';
	for(var i=0;i<=MapId.length;i++)
	{
		if(MapId[i].checked)
		{
			SelectedMaps+=MapId[i].value+':';
		}
		if(i==(SelectedMaps.length-1))
		{
			CompleteDeleteMap(SelectedMaps);
		}
	}
}


function CompleteDeleteMap(SelectedMaps)
{
	var pname='Application/DeleteSelectedModuleToTableMap?SelectedMaps='+SelectedMaps+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			ShowMappedModuleTables();
			close_alert_div();
		}
	}
	myRequest.update();
	
}



function SelectDatasource()
{
	var ModuleI=document.getElementById('ModuleId');
	var ModuleId=ModuleI.options[ModuleI.selectedIndex].value;
	
	var DataS=document.getElementById('DataSourceName');
	
	var pname='Application/ShowModuleDataSources.php?ModuleId='+ModuleId+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		var result=responseText.split(':');
		DataS.options.length=0;
		for(var i=0;i<=result.length;i++)
		{
			if(result[i]=='undefined' || result[i].length==0)
			{
				//alert("Kubaff");
			}
			else
			{
	       DataS.options[i]=new Option(result[i],result[i],true,true);
			}
		}
	}
	myRequest.update();
}



function MapToModuleTransactions(ChartAccountId)
{
	var div=document.getElementById('popup_div');
	var pname='Application/ChartModuleMap.php?ChartAccountId='+ChartAccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
	    CloseAccountsMenu();
		ShowChartModuleSalesConfig(ChartAccountId);
	}
	myRequest.update();

}


function SaveChartModuleMap()
{
	var ModuleI=document.getElementById('ModuleId');
	var ModuleId=ModuleI.options[ModuleI.selectedIndex].value;
	
	var DataS=document.getElementById('DataSourceName'); 
	var DataSourceName=DataS.options[DataS.selectedIndex].value;
	var ChartAccountId=document.getElementById('ChartAccountId').value;
	var SalesConfigId=document.getElementById('SalesConfigId').value
	if(validateChartModuleMap()!=false)
	{
		var pname='Application/SaveChartModuleSalesConfig.php?ModuleId='+ModuleId+'&DataSourceName='+DataSourceName+'&ChartAccountId='+ChartAccountId+'&SalesConfigId='+SalesConfigId+'&';
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
			     document.getElementById('SalesConfigId').value='';
				 document.getElementById('ChartAccountId').value='';
	             DataS.options[0]=new Option('--Please select --','',true,true);
				 ModuleI.options[0]=new Option('--Please select--','',true,true);
				 ShowChartModuleSalesConfig(ChartAccountId);
				
				 
			}
		}
		myRequest.update();
	}
}

function ShowFiledsInTable()
{
	var DataT=document.getElementById('Datatables');
	var Datatable=DataT.options[DataT.selectedIndex].value;
	
	var FieldT=document.getElementById('FieldInTable');
	
	var pname='Application/FieldsInTable.php?TableName='+Datatable+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		var result=responseText.split(':');
		for(var i=0;i<=result.length;i++)
		{
			if(result[i]=='undefined' || result[i].length==0)
			{
			}
			else
			{
	         FieldT.options[i]=new Option(result[i],result[i],true,true);
			}
		}
	}
	myRequest.update();
}

function ShowChartModuleSalesConfig(ChartAccountId)
{
	var myRequest=new ajaxObject('Application/ShowChartModuleSalesConfig.php?ChartAccountId='+ChartAccountId+'&');
	myRequest.callback=function(responseText)
	{
		document.getElementById('ShowChartModuleSalesConfig').innerHTML=responseText;
	}
	myRequest.update();
}

function LoadSalesConfig(SalesConfigId)
{
	var myRequest=new ajaxObject('Application/FetchSalesConfigDetails.php?SalesConfigId='+SalesConfigId+'&');
	var ModuleI=document.getElementById('ModuleId');
	var DataS=document.getElementById('DataSourceName');
	var SalesConfigId=document.getElementById('SalesConfigId').value
	myRequest.callback=function(responseText)
	{
		var result=responseText.split(':');
		ModuleI.options[0]=new Option(result[1],result[0],true,true);
		DataS.options[0]=new Option(result[2],result[2],true,true);
		document.getElementById('SalesConfigId').value=SalesConfigId;
	}
	myRequest.update();
}

function AddJournalAccount()
{
	
	var div=document.getElementById('popup_div_1');
	var pname='Application/AddJournalAccount.php';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
	
	}
	myRequest.update();


	
}
function StoreJournalAccount()
{
	var TypeAcc='';
	var AccountName=document.getElementById('AccountName').value;
	var GLAccountNumber=document.getElementById('GLAccountNumber').value;
	var AccountDate=document.getElementById('AccountDate').value;
	var RefNo=document.getElementById('RefNo').value;
	var TypeOfAccount=document.getElementsByName('TypeOfAccount');
	var AccountPeriod=document.getElementById('AccountPeriod').value;
	var BudgetPeriod=document.getElementById('BudgetPeriod').value;
	var AccountRecurring=document.getElementById('AccountRecurring');
	var RecurringPeriod=document.getElementById('RecurringPeriod').value;
	var AccountDescription=document.getElementById('AccountDescription').value;
	var AccountJustification=document.getElementById('AccountJustification').value;
	var JournalAccountId=document.getElementById('JournalAccountId').value;
	var TypeAcc=document.getElementById('TypeAccVal').value;
	var ChartAccountId=document.getElementById('ChartAccountId').value;
	if(validateJournalAccount()!=false)
	{
		if(AccountRecurring.checked)
		{
			AccountRecurring=1;
		}
		else
		{
			AccountRecurring=0;
		}
		
		var pname='Application/SaveJournalAccount.php?AccountName='+AccountName+'&GLAccountNumber='+GLAccountNumber+'&AccountDate='+AccountDate+'&RefNo='+RefNo+'&TypeOfAccount='+TypeAcc+'&AccountPeriod='+AccountPeriod+'&BudgetPeriod='+BudgetPeriod+'&AccountRecurring='+AccountRecurring+'&RecurringPeriod='+RecurringPeriod+'&AccountDescription='+AccountDescription+'&AccountJustification='+AccountJustification+'&JournalAccountId='+JournalAccountId+'&ChartAccountId='+ChartAccountId+'&'
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			
				if(isNaN(responseText))
				{
				alert_box(responseText);
				}
				else
				{
					ShowJournalAccounts(ChartAccountId);
					closepopupdiv_1();
				}
			
		}
		myRequest.update();
	}
}


function CheckJournalAccount()
{
	
	var checkJournalAccount=document.getElementById('CheckJournalAccount');
	var JournalAccountId=document.getElementsByName('JournalAccount');
	
	if(checkJournalAccount.checked)
	{
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			JournalAccountId[i].checked=true;
		}
	}
	else
	{
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			JournalAccountId[i].checked=false;
		}
	}
		
	
}


function ShowJournalAccounts(ChartAccount)
{
	var div=document.getElementById('popup_div');
	var pname='Application/ShowFinancialJournalAccounts.php?ChartAccount='+ChartAccount+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
	    CloseAccountsMenu();
	}
	myRequest.update();

}
function EditJournalAccount()
{
	    var CountSelected=0;
		var SelectedAccount='';
		var JournalAccountId=document.getElementsByName('JournalAccount');
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			if(JournalAccountId[i].checked)
			{
				CountSelected+=1;
				SelectedAccount=JournalAccountId[i].value;
			}
			if(i==(JournalAccountId.length-1))
			{
				if(CountSelected>1)
				{
					alert_box("You have selected more than one account to edit.You can only edit one account at a time");
				}
				else if(CountSelected==0)
				{
					alert_box("Please Select and account to edit");
				}
				else
				{
					ProceedEditJournalAccount(SelectedAccount);
				}
			}
		}
}

function ProceedEditJournalAccount(JournalAccountId)
{
	var div=document.getElementById('popup_div_1');
	var pname='Application/EditJournalAccount.php?JournalAccountId='+JournalAccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
		CheckAccountRecurring();
	    CheckTypeOfAccountRadios();
	}
	myRequest.update();
}

function CheckAccountRecurring()
{
	var PrevAccountRecurringChecked=document.getElementById('PrevAccountRecurringChecked').value;
	var AccountRecurring=document.getElementById('AccountRecurring');
	if(PrevAccountRecurringChecked==1)
	{
		AccountRecurring.checked=true;
	}
}

function DeleteJournalAccount()
{
	
	    var CountSelected=0;
		var SelectedAccount='';
		var JournalAccountId=document.getElementsByName('JournalAccount');
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			if(JournalAccountId[i].checked)
			{
				CountSelected+=1;
				SelectedAccount+=JournalAccountId[i].value+':';
			}
			if(i==(JournalAccountId.length-1))
			{
				if(CountSelected==0)
				{
					alert_box("Please select an Account to delete");
				}
				else
				{
					Confirm_Box("You are about to delete some journal account.Are sure of this action","ProceedDeleteJournalAccount");
					
				}
			}
		}

}
function ProceedDeleteJournalAccount()
{
        var CountSelected=0;
		var SelectedAccount='';
		var JournalAccountId=document.getElementsByName('JournalAccount');
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			if(JournalAccountId[i].checked)
			{
				CountSelected+=1;
				SelectedAccount+=JournalAccountId[i].value+':';
			}
			if(i==(JournalAccountId.length-1))
			{
				CompleteDeleteJournalAccount(SelectedAccount);
			}
		}
}
			
				
				

function CompleteDeleteJournalAccount(SelectedAccount)
{
	var pname='Application/DeleteJournalAccount.php?SelectedAccounts='+SelectedAccount+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			 ShowJournalAccounts();
			 close_alert_div();
		}
	}
	myRequest.update();	
}


function LinkJournalAccount()
{
	
	    var CountSelected=0;
		var SelectedAccount='';
		var JournalAccountId=document.getElementsByName('JournalAccount');
		for(var i=0;i<=JournalAccountId.length;i++)
		{
			if(JournalAccountId[i].checked)
			{
				CountSelected+=1;
				SelectedAccount=JournalAccountId[i].value;
			}
			if(i==(JournalAccountId.length-1))
			{
				if(CountSelected>1)
				{
					alert_box("You have selected more than one account to Link.You can only Link one account at a time");
				}
				else if(CountSelected==0)
				{
					alert_box("Please Select Accounts to link to");
				}
				else
				{
					ProceedLinkJournalAccount(SelectedAccount);
				}
			}
		}

}

function ProceedLinkJournalAccount(JournalAccountId)
{
	var div=document.getElementById('popup_div_1');
	var pname='Application/SelectAccountToLink.php?JournalAccountId='+JournalAccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%' ;
		div.style.top='5%';
		div.style.width='auto';
		div.style.height='auto';
		CheckAccountRecurring();
	    CheckTypeOfAccountRadios();
	}
	myRequest.update();
}


function CheckAllAccountsToLink()
{
	
	var CheckJournalAccountToLink=document.getElementById('CheckJournalAccountsToLink');
	var JournalAccountToLink=document.getElementsByName('JournalAccountToLink');

	if(CheckJournalAccountToLink.checked)
	{
		for(var i=0;i<=JournalAccountToLink.length;i++)
		{
			JournalAccountToLink[i].checked=true;
		}
	}
	else
	{
		for(var i=0;i<=JournalAccountToLink.length;i++)
		{
             JournalAccountToLink[i].checked=false;
		}
	}
}

function ProceedCreateAccountLink()
{
	var SelectedJournalAccountId=document.getElementById('SelectedJournalAccountId').value;
	var JournalAccountToLink=document.getElementsByName('JournalAccountToLink');
	var SelectedJournalAccounts='';
	    for(var i=0;i<=JournalAccountToLink.length;i++)
		{
			if(JournalAccountToLink[i].checked)
			{
				SelectedJournalAccounts+=JournalAccountToLink[i].value+':';
			}
			if(i==(JournalAccountToLink.length-1))
			{
				CompleteLinkJournalAccounts(SelectedJournalAccountId,SelectedJournalAccounts);
			}
		}
}
		

function CompleteLinkJournalAccounts(SelectedJournalAccountId,SelectedJournalAccounts)
{
	var pname='Application/CreateJournalAccountLinks.php?SelectedJournalAccountId='+SelectedJournalAccountId+'&SelectedJournalAccounts='+SelectedJournalAccounts+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
		   ShowJournalAccounts();
		}
		
	}
	myRequest.update();
	
}



function AccountFullDetails(JournalAccountId)
{
	var div=document.getElementById('popup_div_1');
	var pname='Application/JournalAccountsDetails.php?AccountId='+JournalAccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
		
	}
	myRequest.update();
}


function ShowLinkedJournalAccount(AccountId)
{
	var div=document.getElementById('popup_div_2');
	var pname='Application/JournalLinkedAccounts.php?AccountId='+AccountId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
		
	}
	myRequest.update();
}


function UnlinkJournalAccount(AccountId)
{
	var LinkedJournalAccount=document.getElementsByName('LinkedJournalAccount');
	var CountSelected=0;
	var SelectedAccounts='';
	for(var i=0;i<=LinkedJournalAccount.length;i++)
	{
		if(LinkedJournalAccount[i].checked)
		{
			CountSelected+=1;
			SelectedAccounts=LinkedJournalAccount[i].value+':';
		}
		if(i==(LinkedJournalAccount.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please select Linked accounts to Unlink");
			}
			else
			{
				Confirm_Box("Do you really want to unlink the selected Linked Account","ProceedUnlinkAccounts");
			}
		}
	}
}


function ProceedUnlinkAccounts()
{
	
	var LinkedJournalAccount=document.getElementsByName('LinkedJournalAccount');
	var CountSelected=0;
	var SelectedAccounts='';
	for(var i=0;i<=LinkedJournalAccount.length;i++)
	{
		if(LinkedJournalAccount[i].checked)
		{
			CountSelected+=1;
			SelectedAccounts=LinkedJournalAccount[i].value+':';
		}
		if(i==(LinkedJournalAccount.length-1))
		{
			CompleteUnlinkAccounts(SelectedAccounts);
		}
	}
}


function CompleteUnlinkAccounts(SelectedAccounts)
{
	var AccountId=document.getElementById('SelectedJournalAccountNo').value;
	var pname='Application/UnlinkJournalAccount.php?SelectedAccounts='+SelectedAccounts+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			 ShowLinkedJournalAccount(AccountId);
			 close_alert_div();
		}
	}
	myRequest.update();	
}

function PostedChartAccountTransactions(ChartAccount)
{
	var div=document.getElementById('popup_div_x');
	var pname='Application/PostedAccountTransactions.php?ChartAccount='+ChartAccount+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='15%' ;
		div.style.top='25%';
		div.style.width='auto';
		div.style.height='auto';
		ShowPostedAccountTransactions(ChartAccount);
		CloseAccountsMenu();
	}
	myRequest.update();
}

function ShowPostedAccountTransactions(ChartAccount)
{
	var pname='Application/ShowPostedAccountTransactions.php?ChartAccount='+ChartAccount+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		document.getElementById('PostedTransactions').innerHTML=responseText;
	}
	myRequest.update();
}
function AddPostAccountEntry()
{
	var div=document.getElementById('popup_div_1');
	var pname='Application/PostToAccount.php';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
	
	}
	myRequest.update();


	
}

function ShowFinancialMonthsInYear()
{
   var FinancialY=document.getElementById('FinancialYear');
   var FinancialYear=FinancialY.options[FinancialY.selectedIndex].value;
   var FinancialMonths=document.getElementById('MonthsInYear');
   var pname='Application/FetchMonthsInYear.php?YearId='+FinancialYear+'&';
   var myRequest=new ajaxObject(pname);
   myRequest.callback=function(responseText)
   {
	   //alert(responseText);
	   if(responseText!='')
	   {
			   var result=responseText.split(':');
			   for(var x=0;x<=result.length;x++)
			   {
				   if(result[x]!='')
				   {
				   var MonthDetails=result[x].split('*');
				   FinancialMonths.options[x]=new Option(MonthDetails[1],MonthDetails[0],true,true);
				   }
			   }/**/ 
	   }
  }
   myRequest.update();
   
}

function StoreAccountPost()
{
   var FinancialY=document.getElementById('FinancialYear');
   var FinancialYear=FinancialY.options[FinancialY.selectedIndex].value;
   var FinancialMonths=document.getElementById('MonthsInYear');
   var FinancialPeriod=FinancialMonths.options[FinancialMonths.selectedIndex].value;
   var CurrencyDe=document.getElementById('Currency');
   var Currency=CurrencyDe.options[CurrencyDe.selectedIndex].value;
   var PostDescription=document.getElementById('PostDescription').value;
   var PostAmount=document.getElementById('PostAmount').value;
  var PostNo=document.getElementById('PostNo').value; 
  var ChartAccount=document.getElementById('ChartAccountId').value;
  var UserId=document.getElementById('LoggedInUser').value
   if(ValidatePostToAccount()!=false)
   {
	    var pname='Application/SaveAccountPost.php?FinancialYear='+FinancialYear+'&Currency='+Currency+'&PostAmount='+PostAmount+'&FinancialPeriod='+FinancialPeriod+'&PostDescription='+PostDescription+'&PostNo='+PostNo+'&ChartAccount='+ChartAccount+'&UserId='+UserId+'&';
		
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
		    {
				alert_box(responseText);
			}
			else
			{
				closepopupdiv_1();
				PostedChartAccountTransactions(ChartAccount);
			}
		}
		myRequest.update();
		
   }
}


function EditPostAccountEntry()
{
	var PostNo=document.getElementsByName('PostId');
	
	var CountSelected=0;
	var SelectedPosts='';
	for(var i=0;i<=PostNo.length;i++)
	{
		if(PostNo[i].checked)
		{
			CountSelected+=1;
			SelectedPosts=PostNo[i].value+':';
		}
		if(i==(PostNo.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please select and Entry to Edit");
			}
			else if(CountSelected>1)
			{
				alert_box("You have selected more than one entry.You can only edit one entry at a time");
			}
			else if(CountSelected==1)
			{
				ProceedEditPostEntry(PostNo[i].value);
			}
		}
	}

}


function ProceedEditPostEntry(PostNo)
{
	var div=document.getElementById('popup_div_1');
	var pname='Application/EditPostToAccount.php?PostNo='+PostNo+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%' ;
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
	
	}
	myRequest.update();

}


function DeletePostAccountEntry()
{
	var PostNo=document.getElementsByName('PostId');
	
	var CountSelected=0;
	var SelectedPosts='';
	for(var i=0;i<=PostNo.length;i++)
	{
		if(PostNo[i].checked)
		{
			CountSelected+=1;
			SelectedPosts=PostNo[i].value+':';
		}
		if(i==(PostNo.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please select and Entry to Delete");
			}
			
			else if(CountSelected==1)
			{
				Confirm_Box("Are you sure you want to delete the selected Post Entries","ProceedDeleteAccountEntry");
			}
		}
	}


}

function ProceedDeleteAccountEntry()
{
	var PostNo=document.getElementsByName('PostId');
	
	var CountSelected=0;
	var SelectedPosts='';
	for(var i=0;i<=PostNo.length;i++)
	{
		if(PostNo[i].checked)
		{
			CountSelected+=1;
			SelectedPosts=PostNo[i].value+':';
		}
		if(i==(PostNo.length-1))
		{
			CompleteDeleteSelectedEntries(SelectedPosts);
		}
	}
}

function CompleteDeleteSelectedEntries(SelectedPosts)
{
	 var pname='Application/DeleteSelectedPostAccounts.php?SelectedPosts='+SelectedPosts+'&';
	 var ChartAccount=document.getElementById('ChartAccountId').value;
	// alert(ChartAccount);
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			ShowPostedAccountTransactions(ChartAccount);
			close_alert_div();
		}
	}
	myRequest.update();
}
