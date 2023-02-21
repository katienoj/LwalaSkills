/*
function AddCategory()
{
	var myRequest=new ajaxObject("Application/SupplierCategories/AddSupplierCategory.php");
	myRequest.callback=function(responseText)
	{
		document.getElementById('main_window').innerHTML=responseText; 
	}
	myRequest.update();
	
}
function SaveCategory()
{
	var Category = document.getElementById('catname').value;
	if(Category != '')
		{
		var myRequest=new ajaxObject('Application/SupplierCategories/SaveSupplierCategory.php?Category='+Category+'&');
			myRequest.callback=function(responseText)
			{
				if(isNaN(responseText))
				{
					alert(responseText);
				}
				else
				{
					alert("Category Added successfully");
					ViewCategories();
				}
			}
			myRequest.update();
		}
		else
		{
			alert('Please ensure that the category field has a value');	
		}

}
function EditCategory()
{
  var Category = document.getElementsByName('category_id');
	
	for(i = 0; i <= Category.length; i++)
	{
			if(Category[i].checked == true)
			{
				Ele_Value = Category[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var myRequest=new ajaxObject('Application/SupplierCategories/EditSupplierCategory.php?Category='+Ele_Value+'&');
		myRequest.callback=function(responseText)
		{
			document.getElementById('main_window').innerHTML=responseText; 
		}
		myRequest.update();
	}
	else
	{
		alert('Please select a supplier category from the list.');
	}
	
}
function SaveEditCategory()
{
   var CategoryId  = document.getElementById('CategoryId').value;
   var Category = document.getElementById('catname').value;	
	if(Category != '')
		{
		var myRequest=new ajaxObject('Application/SupplierCategories/SaveEditCategory.php?Category='+Category+'&CategoryId='+CategoryId+'&');
			myRequest.callback=function(responseText)
			{
				if(isNaN(responseText))
				{
					alert(responseText);
				}
				else
				{
					alert("Category edited successfully");
					ViewSupplierCategories();
				}
			}
			myRequest.update();
		}
		else
		{
			alert('Please ensure that the category field has a value');	
		}
}
function DeactivateCategory()
{
	var Category = document.getElementsByName('category_id');
	for(i = 0; i <= Category.length; i++)
	{
			if(Category[i].checked == true)
			{
				Ele_Value = Category[i].value;
				break;
				return Ele_Value;
			}
	}
	if(Ele_Value != '')
	{
		var cat_id=confirm("Are you sure you want to de-activeate this supplier category");
	 if (cat_id==true)
	  {
	  	var myRequest=new ajaxObject('Application/SupplierCategories/DeactivateCategory.php?CategoryId='+Ele_Value+'&');
		myRequest.callback=function(responseText)
		{
			if(isNaN(responseText))
			{
				alert(responseText);
			}
			else
			{
				alert("Suppliers' category has been deactivated");
				ViewSupplierCategories();
			} 
		}
		myRequest.update();
	  }
	else
	  {
	  	ViewSupplierCategories();
	  }
		
	}
	else
	{
		alert('Please select a category from the list.');
	}
	
}*/