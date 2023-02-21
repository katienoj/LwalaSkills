function upOneSupplierCat(cat_id){
ViewSuppliers(cat_id);	
}

function ViewSuppliers(cat_id)
{
	if(document.getElementById('ListType').value==1)
	{
		var pname="Application/Suppliers/ViewSuppliersTabular.php?cat_id="+cat_id+"&";
	}
	else
	{
	    var pname="Application/Suppliers/SupplierCatalogue.php?cat_id="+cat_id+"&";
		document.getElementById('main_window').style.background="#FFFFFF";
	}
	//alert(pname);
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
	}
	myRequest.update();
	
}

function SupplierCategories()
{
	var div=document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Suppliers/ViewSupplierCategories.php');
	
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
	ShowTheCats();
	}
	myRequest.update();
}


//This function is called by the productadd() function and it fetches the server side script for adding products to the system
function AddSupplier()
{
	//viewmodules('products_links',4,1);
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Suppliers/AddSupplier.php');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top = '10%';
		div.style.width='400px';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
	
}
function SupplierEdit()
{
	var Supplier=document.getElementsByName('SupplierId');
	
	for(var i=0;i<=Supplier.length;i++)
	{
		if(Supplier[i].checked)
		{
			EditSupplier(Supplier[i].value);
			break;
		}
	}
}

function EditSupplier(SupplierId,CatId)
{
	//viewmodules('products_links',4,1);
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Suppliers/EditSupplier.php?SupplierId='+SupplierId+'&CatId='+CatId+'&');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='20%';
		div.style.top = '10%';
		div.style.width='400px';
		div.style.height='auto';
		div.style.width='auto';
	}
	myRequest.update();
}

function StoreSupplier(ActionType)
{
	var SupplierNames=document.getElementById('SupplierNames').value;
	var Phone=document.getElementById('Phone').value;
	var Email=document.getElementById('Email').value;
	var web=document.getElementById('web').value;
	var PhyAddress=document.getElementById('PhyAddress').value;
	var PostAddress=document.getElementById('PostAddress').value;
	var town=document.getElementById('Town').value;
	var c=document.getElementById('country');
	var country=c.options[c.selectedIndex].value;
	var CreditTerms=document.getElementById('CreditTerms').value;
	var CreditLimitAmt=document.getElementById('CreditLimitAmt').value;
	var imagefile = document.getElementById('imagefile').value;
    var filename=imagefile.substr(imagefile.lastIndexOf('\\')+1);
		if(ValidateSupplier()!=false)
	{
		if(ActionType=='add')
		{
			var pname='Application/Suppliers/StoreSupplier.php?SupplierNames='+SupplierNames+'&Phone='+Phone+'&Email='+Email+'&web='+web+'&PhyAddress='+PhyAddress+'&PostAddress='+PostAddress+'&town='+town+'&country='+country+'&filename='+filename+'&CreditTerms='+CreditTerms+'&CreditLimitAmt='+CreditLimitAmt+'&';
		}
		else
		{
			var SupplierId=document.getElementById('SupplierId').value;
			var prevLogo=document.getElementById('prevLogo').value;
			var CatId=document.getElementById('CatNo').value;
			if(filename!=prevLogo && filename!='')
			{
				document.getElementById('UploadSupplierLogo').submit();
			}
			else
			{
				filename=prevLogo;
			}
			var pname='Application/Suppliers/StoreSupplierChanges.php?SupplierNames='+SupplierNames+'&Phone='+Phone+'&Email='+Email+'&web='+web+'&PhyAddress='+PhyAddress+'&PostAddress='+PostAddress+'&town='+town+'&country='+country+'&CreditTerms='+CreditTerms+'&CreditLimitAmt='+CreditLimitAmt+'&filename='+filename+'&SupplierId='+SupplierId+'&';
		}
		 
		var myRequest=new ajaxObject(pname);
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert_box(responseText);
			}
			else
			{
				if(ActionType=='add')
				{
					alert_box('Action successful');
				}
				else
				{
				ViewSuppliers(CatId);
				}
				closepopupdiv();
			}
		}
		myRequest.update();
			
	}
	
}

function SupplierDelete()
{
	var Supplier=document.getElementsByName('SupplierId');
	
	for(var i=0;i<=Supplier.length;i++)
	{
		//alert(Supplier.length);
		if(Supplier[i].checked)
		{
			//alert(Supplier[i].value);
			RemoveSupplier(Supplier[i].value);
			break;
		}
	}
}

function RemoveSupplier(SupplierId,Cat)
{  
   //alert(SupplierId);
   document.getElementById('ConfirmVars').value=SupplierId+':'+Cat;
   Confirm_Box("Are you sure you want to remove the selected Supplier  ","CompleteRemoveSupplier");
	
}
function CompleteRemoveSupplier()
{
	var SupplierDetail=document.getElementById('ConfirmVars').value;
	var SupplierDetails=SupplierDetail.split(':');
	var SupplierId=SupplierDetails[0];
	var CatId=SupplierDetails[1];
	var pname='Application/Suppliers/RemoveSupplier.php?SupplierId='+SupplierId+'&CatId='+CatId+'&';
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(isNaN(responseText))
		{
			alert_box(responseText);
		}
		else
		{
			ViewSuppliers(CatId);
			close_alert_div();
			closepopdiv();
			removeModal();
		}
	}
	myRequest.update();
}

function SupplierContacts(SupplierId)
{
	var div=document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Suppliers/SupplierContacts.php?SupplierId='+SupplierId+'&');
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



function ShowUnselectedSuppliers()
{
	var div=document.getElementById('popup_div_1');
	var CatId=document.getElementById('CatId').value;
	if(CatId=='')
	{
		alert_box("Please select a stock category first to add suppliers to it");
	}
	else
	{
	myRequest = new ajaxObject('Application/Suppliers/SelectSuppliersToAttch.php?CatId='+CatId+'&');
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
}


function AddSuppliersToCategory()
{
	var Supplier=document.getElementsByName('SupplierNo');
	var CatId=document.getElementById('CatId').value;
	var Suppliers='';
	for(var i=0;i<=Supplier.length;i++)
	{
		if(Supplier[i].checked)
		{
			Suppliers+=Supplier[i].value+':';
		}
		if(i==(Supplier.length-1))
		{
			var pname='Application/Suppliers/AddSuppliersToCategory.php?Suppliers='+Suppliers+'&CatId='+CatId+'&';
			//alert(pname);
			var myRequest=new ajaxObject(pname)
			myRequest.callback=function(responseText)
			{
			if(isNaN(responseText))
			{
			alert_box(responseText);
			}
			else
			{
			alert_box('Action Successful.Suppliers Added to the selected category');
			ShowUnselectedSuppliers();
			}
			}
			myRequest.update();
		}
	}
	
	
			
	
}
function ViewSuppliersUnderCategory()
{
	
	var div=document.getElementById('popup_div_1');
	var CatId=document.getElementById('CatId').value;
	if(CatId=='')
	{
		alert_box("Please select a stock category first to see suppliers attached to it");
	}
	else
	{
		
	myRequest = new ajaxObject('Application/Suppliers/SelectedSuppliersToCategory.php?CatId='+CatId+'&');
	myRequest.callback = function(responseText)
	{
		//alert(responseText);
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
	
}


function SelectSuppliers()
{
	var SelectSupplier=document.getElementById('SupplierCheck');
	var Supplier=document.getElementsByName('SupplierNo');
	if(SelectSupplier.checked)
	{
		
		for(var i=0;i<=Supplier.length;i++)
		{
			Supplier[i].checked=true;
		}
	}
	else
	{
		for(var i=0;i<=Supplier.length;i++)
		{
			Supplier[i].checked=false;
		}
	}
}

function CheckTheSuppliers()
{
		var SelectSupplier=document.getElementById('CheckSupplier');
	var Supplier=document.getElementsByName('SupplierId');
	if(SelectSupplier.checked)
	{
		
		for(var i=0;i<=Supplier.length;i++)
		{
			Supplier[i].checked=true;
		}
	}
	else
	{
		for(var i=0;i<=Supplier.length;i++)
		{
			Supplier[i].checked=false;
		}
	}
}

function ToggleSupplierView()
{
	var div=document.getElementById('QuitWindowDiv');
	myRequest = new ajaxObject('Application/Suppliers/ListSupplierView.php');
	myRequest.callback = function(responseText)
	{
		div.innerHTML=responseText;
		div.style.display='block';
		div.style.position='absolute';
		div.style.left='40%';
		div.style.top = '10%';
		div.style.width='200px';
		div.style.height='auto';
		div.style.width='auto';
		modal();
	}
	myRequest.update();
}
function ListSupplierViewShow(ViewType)
{
	//alert(ViewType);
	document.getElementById('ListType').value=ViewType;
	ViewSuppliers();
	HideQuitWindow();
	removeModal();
}

function ViewSupplierDetails(SupplierId,CatId)
{
	var div=document.getElementById('popup_div');
	var pname='Application/Suppliers/SupplierDetails.php?SupplierId='+SupplierId+'&CatId='+CatId+'&';
	//alert(pname);
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

function SearchSupplier()
{
	//THis function is used to roll out the patient's search window
	var myRequest=new ajaxObject('Application/Suppliers/SearchSupplier.php');
	document.getElementById('SearchHeight').value='140';
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




function SendSearchSupplier()
{
	var SupplierNames=document.getElementById('SupplierNames').value;
	var Phone=document.getElementById('Phone').value;
	var Email=document.getElementById('Email').value;
	var web=document.getElementById('web').value;
	var PhyAddress=document.getElementById('PhyAddress').value;
	var PostAddress=document.getElementById('PostAddress').value;
	var town=document.getElementById('Town').value;
	var c=document.getElementById('country');
	var country=c.options[c.selectedIndex].value;
	var CreditTerms=document.getElementById('CreditTerms').value;
	var CreditLimitAmt=document.getElementById('CreditLimitAmt').value;
	
	var pname='Application/Suppliers/GenerateSupplierSearchSQL.php?SupplierNames='+SupplierNames+'&Phone='+Phone+'&Email='+Email+'&web='+web+'&PhyAddress='+PhyAddress+'&PostAddress='+PostAddress+'&town='+town+'&country='+country+'&CreditTerms='+CreditTerms+'&CreditLimitAmt='+CreditLimitAmt+'&';
	
	var myRequest=new ajaxObject(pname);
	myRequest.callback=function(responseText)
	{
		if(document.getElementById('ListType').value!=1)
		{
		  ShowSupplierResultsIcon(responseText);	
		}
		else
		{
			ShowSupplierResultsTabular(responseText);
		}
	}
	myRequest.update();
}


function ShowSupplierResultsTabular(results)
{
	var pname='Application/Suppliers/ShowSupplierSearchResultsTabular.php?SearchStr='+results+'&';
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
	}
	myRequest.update();
	
}
function ShowSupplierResultsIcon(results)
{
	var pname='Application/Suppliers/ShowSupplierSearchResultsIcon.php?SearchStr='+results+'&';
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
	}
	myRequest.update();
	
}