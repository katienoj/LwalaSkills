function DisplayModuleCategorySetup(module_id)
{
var div = document.getElementById('popup_div')
// var episode_id = document.getElementById('episode_id').value;
// ex: "../../Main/"
// alert(module_id);
var full_path = "../Main/Application/LoadAccountCategory.php?module_id="+module_id+"&"; 
var myRequest=new ajaxObject(full_path);
	myRequest.callback=function(responseText)
		{
			div.innerHTML=responseText;
			div.style.display='block';
			div.style.position='absolute';
			div.style.left='20%';
			div.style.top = '10%';
			div.style.width='45%';
		}
	myRequest.update();
	 DisplayLinkedCategories(module_id);
}
function LinkCategoryToModule(module_id)
{

var account_category_id = document.getElementById('account_category_id').value;
var module_id = document.getElementById('module_id_cat').value;

//alert(account_category_id);
//alert(module_id);
var full_path = "../Main/Application/SaveLinkAccountCategory.php?module_id="+module_id+"&account_category_id="+account_category_id+"&"; 
var myRequest=new ajaxObject(full_path);
	myRequest.callback=function(responseText)
		{
			if (!isNaN(responseText))
				{
					alert('Category has been linked succesfuly');	
				}
			else
				{
					alert(responseText);
				}
		}
	myRequest.update();
	DisplayLinkedCategories(module_id);
}

function DisplayLinkedCategories(module_id)
{
var div = document.getElementById('main_window')
var full_path = "../Main/Application/LinkedAccountCategoryList.php?module_id="+module_id+"&"; 
var myRequest=new ajaxObject(full_path);
	myRequest.callback=function(responseText)
		{
			div.innerHTML=responseText;
		}
	myRequest.update();	
}