//Javascript Document

function InternalStockReqs()
{
	var pname='../Requisitions/Application/ShowStock.php';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText){
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

function AddRequisition()
{
   var Stocks=document.getElementsByName('StockId');
   var SelectedStock='';
	for (var i=0;i<=Stocks.length;i++)
		{
			if(Stocks[i].checked)
			{
				SelectedStock+=Stocks[i].value+':';
			}
			if(i==(Stocks.length-1))
			{
				if(SelectedStock=='')
				{
					alert_box("Please select the items to issue a request for");
				}
				else
				{
				ShowSelectedStocks(SelectedStock);
				}
			}
		}
}

function ShowSelectedStocks(SelectedStocks)
{
	var pname='../Requisitions/Application/ShowStockToRequest.php';
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
		ShowTheSelectedStock(SelectedStocks);
		
	}
	myRequest.update();
	
}
function ShowTheSelectedStock(SelectedStock)
{
	var pname='../Requisitions/Application/ShowTheSelectedStock.php?SelectedStock='+SelectedStock+'&';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{	
		$(document).ready(
			function() {
			 $('#selected_stock').DataTable(
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
	document.getElementById('ShowStockToRequest').innerHTML=responseText;
	}	
	myRequest.update();
}

function getStockRequestAmts()
{
	//alert("Kubaff");
	var SelectedStockId=document.getElementsByName('SelectedStockId');
	//alert(SelectedStockId);
	for(var i=0;i<=SelectedStockId.length;i++)
	{
		//alert(i+" "+SelectedStockId.length);
		var Qty=document.getElementById('ReqAmt'+SelectedStockId[i].value).value;
		var Packaging=document.getElementById('PackagingType'+SelectedStockId[i].value).value;
		if(Qty=='')
		{
			alert_box("Some Stock Request quantities are empty.Please fill them up");
			break;
		}
		//if(Packaging=='')
		//{
		//	alert_box("Some Stock Request Packaging types are empty.Please fill them up");
		//	break;
		//}
		if(i==(SelectedStockId.length-1))
		{   closepopupdiv();
			CompleteMakeStockRequest();
			closepopupdiv();
		}
	}
	
}
function CompleteMakeStockRequest()
{
	//alert("Kubaff");
	var SelectedStockId=document.getElementsByName('SelectedStockId');
	var SelectStockQties='';
	//alert(SelectedStockId);
	for(var i=0;i<=SelectedStockId.length;i++)
	{
		//alert(i+" "+SelectedStockId.length);
		var Qty=document.getElementById('ReqAmt'+SelectedStockId[i].value).value;
		var Packaging=document.getElementById('PackagingType'+SelectedStockId[i].value).value;
		var StockQty=SelectedStockId[i].value+"*"+Qty+'@'+Packaging;
		SelectStockQties+=StockQty+":";
		if(i==(SelectedStockId.length-1))
		{
			CompleteTheStockRequest(SelectStockQties);
		}
	}
}


function CompleteTheStockRequest(SelectStockQties)
{
	//alert(SelectStockQties);
	var DateExpected=document.getElementById('DateExpected').value;
	if(DateExpected=='')
	{
		alert_box("Please selected the date when this request should have been serviced");
	}
	else
	{
	var pname='../Requisitions/Application/MakeStockRequest.php?SelectStockQties='+SelectStockQties+'&DateExpected='+DateExpected+'&';
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
			closepopupdiv();
			alert_box('Stock Request successfully made. Kindly pick up Requested Items from Issuing Department');
			var Stocks=document.getElementsByName('StockId');
			for (var i=0;i<=Stocks.length;i++)
				{
					if(Stocks[i].checked)
					{
						Stocks[i].checked=false;
					}	
				}
			closepopupdiv_1();
		}
	 }
	myRequest.update();
	}
}


function ViewInternalRequests()
{

	var pname='../Requisitions/Application/ViewInternalStockRequests.php';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		 $(document).ready(
        function() {
         $('#service_table2').DataTable(
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
	//alert(responseText);
	document.getElementById('main_window').innerHTML=responseText;
	}	
	myRequest.update();
	
}


function ShowTheItems(StockItems)
{
	var pname='../Requisitions/Application/ShowItemsInRequest.php?StockItems='+StockItems+'&';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
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


function ApproveStockRequest()
{
	var RequestId=document.getElementsByName('RequestId');
	var Selected=0;
	for(var i=0;i<=RequestId.length;i++)
	{
		if(RequestId[i].checked)
		{
			Selected+=1;
		}
		if(i==(RequestId.length-1) )
		{
			if(Selected>0)
			{
			Confirm_Box("You are about to approve stock requests.Are you sure of this Action","ProceedApproveStockRequest");
			}
			else
			{
			alert_box("Please select some Requests to Approve");

			}
			break;

		}
	}
}

function ProceedApproveStockRequest()
{
	var RequestId=document.getElementsByName('RequestId');
	var selectedRequests='';
	for(var i=0;i<=RequestId.length;i++)
	{
		if(RequestId[i].checked)
		{
			selectedRequests+=RequestId[i].value+':';
		}
		if(i==(RequestId.length-1))
		{
			 CompleteApproveInternalRequest(selectedRequests);
		}
	}
}


function  CompleteApproveInternalRequest(selectedRequests)
{
	var pname='../Requisitions/Application/CompleteApproveInternalRequests.php?SelectedRequests='+selectedRequests+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		if(isNaN(responseText))
		{
			if(responseText=="reload")
			{
				history.go(0);
			}
			else
			{
				alert_box(responseText);
			}
		}
		else
		{
			 ViewInternalRequests();
			close_alert_div();
		}
	}
	myRequest.update();
	
	
}

function ProcurementApproveStockRequest()
{
	var RequestId=document.getElementsByName('RequestId');
	for(var i=0;i<=RequestId.length;i++)
	{
		if(RequestId[i].checked)
		{
			CompleteProcurementApproveStockRequest(RequestId[i].value);
			break;
		}
	}
}
function CompleteProcurementApproveStockRequest(RequestId)
{
	var pname='../Requisitions/Application/ProcurementStockRequestApproval.php?RequestId='+RequestId+'&';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
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

function ProceedToApprovePROCRequest(RequestId)
{
	var div=document.getElementById('popup_div');
	var pname='../Requisitions/Application/CompleteApprovePROCRequests.php?RequestId='+RequestId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
			if(responseText=="reload")
			{
				history.go(0);
			}
			else
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
	}
	myRequest.update();
}

function MgtStockRequests()
{
	var pname='../Requisitions/Application/PROCApprovedInternalStockRequests.php';
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

function MgtApproveStockRequest()
{
	var RequestId=document.getElementsByName('RequestId');
	for(var i=0;i<=RequestId.length;i++)
	{
		if(RequestId[i].checked)
		{
			CompleteMgtApproveStockRequest(RequestId[i].value);
			break;
		}
	}
}

function CompleteMgtApproveStockRequest(RequestId)
{
	var pname='../Requisitions/Application/CompleteApproveMgtRequests.php?RequestId='+RequestId+'&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		if(isNaN(responseText))
		{
			if(responseText=="reload")
			{
				history.go(0);
			}
			else
			{
				alert_box(responseText);
			}
		}
		else
		{
			MgtStockRequests();
			close_alert_div();
		}
	}
	myRequest.update();
	
}


function StockLPOs()
{
	var pname='../Requisitions/Application/CEOApprovedInternalStockRequests.php';
	myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText){
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

function MakeLPO()
{
	var RequestId=document.getElementsByName('RequestId');
	for(var i=0;i<=RequestId.length;i++)
	{
		if(RequestId[i].checked)
		{
			SelectSupplier(RequestId[i].value);
			break;
		}
	}
}



function SelectSupplier(RequestId)
{
	var pname='../Requisitions/Application/SelectSupplier.php?RequestId='+RequestId+'&';
	var div=document.getElementById('popup_div_1');
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
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

function IssueLPO()
{
	var SupplierNo=document.getElementsByName('SupplierNo');
	var SelectedSuppliers=0;
	for(var i=0;i<=SupplierNo.length;i++)
	{
		if(SupplierNo[i].checked)
		{
			SelectedSuppliers+=1;
		}
		if(i==(SupplierNo.length-1))
		{
			if(SelectedSuppliers>1)
			{
				alert_box("You have selected more than supplier.Please select only one supplier");
			}
			else
			{
				CompleteSelectSupplier();
			}
		}		
	}
}


function CompleteSelectSupplier()
{
	var SupplierNo=document.getElementsByName('SupplierNo');
	var RequestId=document.getElementById('RequestId').value;
	var SelectedSuppliers=0;
	for(var i=0;i<=SupplierNo.length;i++)
	{
		if(SupplierNo[i].checked)
		{
			var pname='../Requisitions/Application/CompleteMakeLPO.php?SupplierNo='+SupplierNo[i].value+'&RequestId='+RequestId+'&';
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function(responseText)
			{
				if(isNaN(responseText))
				{
					alert_box(responseText);
				}
				else
				{
					alert_box("LPO Successfully made");
					StockLPOs();
					closepopupdiv_1();
				}
			}
			myRequest.update();
			break;
		}
	}
	
}


function ShowMadeLPOs()
{
	var pname='../Requisitions/Application/ShowMadeLPOs.php';
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
    var pname='../Requisitions/Application/ConsolidateLPOs.php?SelectedLPOs='+SelectedLPOs+'&';
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
				alert_box("Only one LPO can be printed at a time");
			}
			else
			{
			CompletePrintSelectedLPOs(TheCheckedLPO);
			}
		}
		
	}	
}


function CompletePrintSelectedLPOs(TheCheckedLPO)
{
	var myRequest = new ajaxObject('../Requisitions/Application/ViewPrintLPO.php?SelectedLPO='+TheCheckedLPO+'&');
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

function ViewLPOstock(StockItems)
{
	var pname='../Requisitions/Application/ShowItemsInRequest.php?StockItems='+StockItems+'&';
	
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		document.getElementById('LPOStock').innerHTML=responseText;
	}
	myRequest.update();
	
}

function SearchReqStock()
{
	//THis function is used to roll out the patient's search window
	var myRequest=new ajaxObject('../Requisitions/Application/SearchInternalReqs.php');
	document.getElementById('SearchHeight').value='120';
	myRequest.callback=function(responseText)
	{
		document.getElementById('search_bar').innerHTML=responseText;
		//Show the window if the window is empty
		if(document.getElementById('search_bar').style.display=='none' || document.getElementById('search_bar').style.display=='')
		{
		inter=setInterval('showSearchDiv()',3);
		return false;
		}
		
		
	}
	myRequest.update();/**/
}

function SendInternalStockRequestSearch()
{
	var Dept=document.getElementById('Department');
	var Department=Dept.options[Dept.selectedIndex].value;
	var RSelect=document.getElementById('RequestSelect');
	var RequestSelect=RSelect.options[RSelect.selectedIndex].value;
	var ESelect=document.getElementById('ExpectSelect');
	var ExpectSelect=ESelect.options[ESelect.selectedIndex].value;
	var TSelect=document.getElementById('TotalSelect');
	var TotalSelect=ESelect.options[TSelect.selectedIndex].value;
	var RequestTotal=document.getElementById('RequestTotal').value;
	var DateOfRequest=document.getElementById('DateOfRequest').value;
	var DateExpected=document.getElementById('DateExpected').value;
	var ItemId=document.getElementById('ItemId').value;
	
	var pname='../Requisitions/Application/GenerateInternalRequestsSearch.php?Department='+Department+'&RequestSelect='+RequestSelect+'&ExpectedSelect='+ExpectSelect+'&DateOfRequest='+DateOfRequest+'&DateExpected='+DateExpected+'&ItemId='+ItemId+'&TotalSelect='+TotalSelect+'&RequestTotal='+RequestTotal+'&';
	//alert(pname);
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		ShowRequestSearch(responseText);
	}
	myRequest.update();
}

function ShowRequestSearch(SQLstring)
{
	///alert(SQLstring);
	var pname='../Requisitions/Application/ShowInternalRequestSearchResults.php?SQLstring='+SQLstring+'&';
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
function GetItemsHint()
{
	
	var ItemName=document.getElementById('ItemName').value;
	//alert(item_type);
	var pname='../Requisitions/Application/Stock/HintItems.php?ItemName='+ItemName+'&';
	//alert(pname);
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{	
        if(responseText=='')
		{
			
		}
		else
		{
		document.getElementById('hint').innerHTML=responseText;
		document.getElementById('hint').style.display='block';
		}
	}
	myRequest.update();
}

function hideHint()
{
	document.getElementById('hint').style.display='none';
}
function GetItemDetail()
{
	var ItemName=document.getElementById('hintTxt').value;
	document.getElementById('ItemName').value=document.getElementById('hintTxt').value;
	//alert(transaction_type);
	var myRequest=new ajaxObject('../Requisitions/Application/Stock/GetStockItemId.php?ItemName='+ItemName+'&');
	myRequest.callback=function(responseText)
	{
		//alert(responseText);
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			document.getElementById('ItemId').value=responseText;
		}
	}
	myRequest.update();
}


function ViewDepartmentStock(SearchSQL)
{
	//alert(SearchSQL);
	 
    var pname='../Requisitions/Application/DepartmentStock.php?SearchSQL='+SearchSQL+'&';
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		 $(document).ready(
        function() {
         $('#department_stock').DataTable(
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

function SearchTheDeptStock()
{
	
	var StockName=document.getElementById('StockItem').value;
	var StockId=document.getElementById('SearchStockId').value;
	var pname='../Requisitions/Application/SearchDepartmentStock.php?StockName='+StockName+'&StockId='+StockId+'&';
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

		var result=responseText;
       //alert(responseText);
        ViewDepartmentStock(result);
		
	}
	myRequest.update();
}
function ViewStockMovements(StockId,DeptId)
{
	var pname='../Requisitions/Application/DeptStockMvt.php?StockId='+StockId+'&DeptId='+DeptId+'&';
	var div=document.getElementById('popup_div_1');
	myRequest = new ajaxObject(pname);
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='25%';
		div.style.top = '10%';
		div.style.width='auto';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
}
