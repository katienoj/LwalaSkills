//Javascript Document

function ShowMadeLPOs()
{
	var pname='Application/ShowMadeLPOs.php';
	myRequest=new ajaxObject(pname);
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
	}	
	myRequest.update();
}

 
 function  ApprovedLPOs()
{
	var pname='Application/ApprovedLPOs.php';
	myRequest=new ajaxObject(pname);
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
	}	
	myRequest.update();
}

function ConsolidateLPOS()
{
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=LPO[i].value+':';
		}
		if(i==(LPO.length-1))
		{
			CompleteConsolidateLPOs(SelectedLPO);
		}
		
	}	
}


function CompleteConsolidateLPOs(SelectedLPOs)
{
    var pname='Application/ConsolidateLPOs.php?SelectedLPOs='+SelectedLPOs+'&';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
	       alert_box(responseText);
		}
		else
		{
		   ShowMadeLPOs();
		}
	}	
	myRequest.update();
}

function PrintLPO()
{
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var SelectedLPOs='';
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
			SelectedLPOs+=TheCheckedLPO+":";
		}
		if(i==(LPO.length-1))
		{
			
			CompletePrintSelectedLPOs(SelectedLPOs);
		
		}
		
	}	
}


function CompletePrintSelectedLPOs(SelectedLPOs)
{
    var div=document.getElementById('print_div');
	var myRequest = new ajaxObject('Application/ViewPrintLPO.php?SelectedLPOs='+SelectedLPOs+'&');
	var div=document.getElementById('print_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='20%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
}


function  ShowLPOItems(LPOId)
{
	
	var myRequest = new ajaxObject('Application/ItemsInLPO.php?LPOId='+LPOId+'&');
	var div=document.getElementById('popup_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='55%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
}


function ReceiveGoods()
{
	
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
		}
		if(i==(LPO.length-1))
		{
			if(SelectedLPO>1)
			{
				alert_box("You can only recieve goods for Only one LPO at a time");
			}
			else
			{
			ShowRecieveGoodsWindow(TheCheckedLPO);
			}
		}
		
	}	

}


function ShowRecieveGoodsWindow(TheCheckedLPO)
{
	var myRequest = new ajaxObject('Application/RecieveGoodsWindow.php?LPOId='+TheCheckedLPO+'&');
	var div=document.getElementById('popup_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='20%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
}

function ProceedReceiveGoods()
{
	var LPOId=document.getElementById('LPONumber').value;
	var DeliveryNote=document.getElementById('DeliveryNoteNo').value;
	var DetailId=document.getElementsByName('DetailId');
	 var BroughtIn='';
	// alert(DetailId.length);
	for(var i=0;i<=DetailId.length;i++)
	{
		
		var StockId=document.getElementById('StockId'+DetailId[i].value).value;
		var QtyBroughtIn=document.getElementById('BroughtIn'+DetailId[i].value).value;
		
		var BroughtInDetails=StockId+'*'+QtyBroughtIn;
		BroughtIn+=BroughtInDetails+':';
		if(i==(DetailId.length-1))
		{
			CompleteReceiveGoods(LPOId,BroughtIn,DeliveryNote);
		}
	}
}



function CompleteReceiveGoods(LPOId,BroughtInDetails,DeliveryNote)
{
	if(DeliveryNote=='')
	{
		alert_box('Please type in Delivery Note first');
	}
	else
   {
		var pname='Application/StoreBroughtInGoods.php?LPOId='+LPOId+'&BroughtInDetails='+BroughtInDetails+'&DeliveryNoteNo='+DeliveryNote+'&';
	   // alert(pname);
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
				ShowServiceHistory(LPOId);
			}
			else
			{
				 ShowServiceHistory(LPOId);
				alert_box("Action Successful.Stock recieved sucessfully");

			}
			
		}
		myRequest.update();
  }
} 

function LPOServiceHistory()
{
	
	
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
		}
		if(i==(LPO.length-1))
		{
			if(SelectedLPO>1)
			{
				alert_box("You can only View Service History for Only one LPO at a time");
			}
			else
			{
			ShowServiceHistory(TheCheckedLPO);
			}
		}
		
	}	


	
}


function  ShowServiceHistory(TheCheckedLPO)
{
	var myRequest = new ajaxObject('Application/LPOServiceHistory.php?LPOId='+TheCheckedLPO+'&');
	var div=document.getElementById('popup_div_1');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='55%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
}


function GenerateGoodsReceivedNote(LPOId)
{
	var myRequest = new ajaxObject('Application/ViewGoodsReceivedNote.php?LPOId='+LPOId+'&');
	var div=document.getElementById('print_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='20%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
}

function PrintLPOService(ServiceId)
{
	var myRequest = new ajaxObject('Application/ViewGoodsReceivedNote.php?ServiceId='+ServiceId+'&');
	var div=document.getElementById('print_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='20%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	}
	myRequest.update();  
	
}


function RecieveLPOInvoice()
{
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
		}
		if(i==(LPO.length-1))
		{
			
			if(SelectedLPO>1)
			{
				alert_box("You can only View Service History for Only one LPO at a time");
			}
			if(SelectedLPO==0)
			{
				alert_box("Select an LPO To view and enter invoices that came with the supplies");
			}
			else
			{
				//alert(TheCheckedLPO);
			 ViewSupplyHistory(TheCheckedLPO);
			}
		}
		
	}	


	
}



function  ViewSupplyHistory(LPOId)
{
	var pname='Application/ViewSupplyHistory.php?LPOId='+LPOId+'&';
	//alert(pname);
	var myRequest = new ajaxObject(pname);
	var div=document.getElementById('popup_div');
	myRequest.callback=function(responseText)
	{
	div.innerHTML=responseText;
	div.style.display='block';
	div.style.position='absolute';
	div.style.left='20%';
	div.style.top = '10%';
	div.style.width='auto';
	div.style.height='auto';
	div.style.width='auto';
	ShowLPOInvoices(LPOId);
	}
	myRequest.update();  
}



function ShowLPOInvoices(LPOId)
{
	//alert(LPOId);
	var pname='Application/ShowLPODeliveries.php?LPOId='+LPOId+'&';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{	
	//alert(responseText);
	document.getElementById('ShowLPODeliveries').innerHTML=responseText;
	}	
	myRequest.update();
}


function ShowSuppliesInside(DeliveryNote)
{
	//alert(LPOId);
	var pname='Application/SuppliesInDeliveryNote.php?DeliveryNote='+DeliveryNote+'&';

	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{	
	//alert(responseText);
	document.getElementById('DisplaySupplies'+DeliveryNote).innerHTML=responseText;
	}	
	myRequest.update();
}



function CheckLPOService()
{
	var CheckLPOService=document.getElementById('CheckLPOService');
	var DNotes=document.getElementsByName('DNoteId');
	
	if(CheckLPOService.checked)
	{
		for(var i=0;i<=DNotes.length;i++)
		{
			DNotes[i].checked=true;
		}
	}
	else
	{
		for(var i=0;i<=DNotes.length;i++)
		{
			DNotes[i].checked=false;
		}
	}
}
function EnterInvoiceForSupplies()
{
	var LPOId=document.getElementById('LPONo').value;
	var DNotes=document.getElementsByName('DNoteId');
	var SelectedDNotes='';
	var CountSelected=0;
	for(var i=0;i<=DNotes.length;i++)
	{
		if(DNotes[i].checked)
		{
			CountSelected+=1;
			SelectedDNotes+=DNotes[i].value+':';
		}
		if(i==(DNotes.length-1))
		{
			if(CountSelected==0)
			{
				alert_box("Please select some supplies to invoice");
			}
			else
			{
				CompleteRecieveInvoice(SelectedDNotes,LPOId);
			}
			
		}
	}
	
}


function CompleteRecieveInvoice(SelectedNotes,LPOId)
{
	var div=document.getElementById('popup_div_1');
	var ModuleId=document.getElementById('ModuleNumber').value
	var pname='Application/GrabLPOInvoiceDetails.php?SelectedNotes='+SelectedNotes+'&LPOId='+LPOId+'&ModuleId='+ModuleId+'&';

	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
}


function SendInvoiceToAccountsPayable()
{
	var InvoiceNo=document.getElementById('InvNo').value;
	var InvoiceDate=document.getElementById('InvDate').value;
	var DateRecieved=document.getElementById('DateRecieved').value;
	var InvoiceAmt=document.getElementById('InvoiceAmt').value;
	var SelectedSupplies=document.getElementById('SelectedSupplies').value;
	var LPOId=document.getElementById('LPONo').value;
	
	if(1>0)
	{
		var pname='Application/StoreSupplierInvoice.php?InvoiceNo='+InvoiceNo+'&InvoiceDate='+InvoiceDate+'&InvoiceAmt='+InvoiceAmt+'&SelectedSupplies='+SelectedSupplies+'&LPOId='+LPOId+'&DateRecieved='+DateRecieved+'&';
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
				closepopupdiv_1();
				ShowLPOInvoices(LPOId);
			}
		}
		myRequest.update();
	}
}


function ApproveLPO()
{
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
		}
		if(i==(LPO.length-1))
		{
			if(SelectedLPO>1)
			{
				alert_box("You can Approve only one LPO at a time");
			}
			else if(SelectedLPO==1)
			{
				Confirm_Box("You are about to Approve an LPO.Are you sure of this Action","ProceedApproveLPO");
			}
		}
		
	}	
}

function ProceedApproveLPO()
{
   
	var LPO=document.getElementsByName('LPOId');
	var SelectedLPO=0;
	var TheCheckedLPO='';
	for(var i=0;i<=LPO.length;i++)
	{
		if(LPO[i].checked)
		{
			SelectedLPO+=1;
			TheCheckedLPO=LPO[i].value;
		}
		if(i==(LPO.length-1))
		{
			CompleteApproveLPO(TheCheckedLPO);
		}
	}	
	
}
function CompleteApproveLPO(TheCheckedLPO)
{
	var myRequest = new ajaxObject('Application/CompleteApproveLPO.php?LPOId='+TheCheckedLPO+'&');
	myRequest.callback=function(responseText)
	{
	    if(responseText=='reload')
		{
			history.go(-1);
		}
		else if(isNaN(responseText))
		{
		    alert_box(responseText);
		}
		else
		{
			ShowMadeLPOs();
			close_alert_div();
		}
	}
	myRequest.update();  
}