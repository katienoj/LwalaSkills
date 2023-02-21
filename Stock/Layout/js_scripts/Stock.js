// JavaScript Document
function upOneCat(cat_id) {
	catalogue(cat_id);
}
function upOneCatLevel(cat_id, c_name) {
	navigateCat(cat_id, c_name);
}
//This function selects all the displayed products should the Checkbox at the top left of the window that displays the products be selected
function CheckStock() {
	//Get the name of the checkbox at the top left part of the display window
	var cheks = document.getElementById('CheckStock');
	//Get the names of all the checkboxes inside the display window
	var Stocks = document.getElementsByName('StockId')
	if (cheks.checked) {
		//Loop through all the checkboxes and check them should cheks be selected
		for (var i = 0; i <= Stocks.length; i++) {
			Stocks[i].checked = true;
		}
	}
	else {
		//Loop through all the checkboxes and uncheck them should cheks be unselected
		for (var i = 0; i <= Stocks.length; i++) {
			Stocks[i].checked = false;
		}
	}
}
function RestockHistory() {
	var hist = "Application/Stock/ViewStockUpdateHistory.php";
	var myRequest = new ajaxObject(hist);
	myRequest.callback = function (responseText) {
		$(document).ready(
			function () {
				$('#stockupdatehistory').DataTable(
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
function ItemReceipts() {
	var hist = "Application/Stock/ItemReceipts.php";
	var myRequest = new ajaxObject(hist);
	myRequest.callback = function (responseText) {
		$(document).ready(
			function () {
				$('#stockitemreceipts').DataTable(
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
function ViewStock() {
	catalogue();
}
//This function displays all the products 
function catalogue(cat_id) {
	// alert(document.getElementById('ListType').value);
	if (document.getElementById('ListType').value == 1 || document.getElementById('ListType').value == '') {
		var pname = 'Application/Stock/tabular.php?cat_id=' + cat_id + '&';
	}
	else {
		var pname = 'Application/Stock/catalogue.php?cat_id=' + cat_id + '&';
		document.getElementById('main_window').style.background = "#FFFFFF";
	}
	//alert(pname);
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
		$(document).ready(
			function () {
				$('#pharmacystock').DataTable(
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
	}
	myRequest.update();
}
function navigateCat(cat_id, c_name) {
	myRequest = new ajaxObject('Application/Stock/navigate_cat.php?cat_id=' + cat_id + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('navigate_cat').innerHTML = responseText;
		document.getElementById('navigate_cat').style.display = 'block';
		document.getElementById('c_id').value = cat_id;
		document.getElementById('c_name').value = c_name;
	}
	myRequest.update();
}
function getSelectedCat() {
	var cat = document.getElementById('c_id').value;
	var category = document.getElementById('c_name').value;
	if (cat == 'undefined') { var cat = 0; }
	document.getElementById('cat').value = cat;
	if (category == 'undefined') { var category = 'none'; }
	document.getElementById('category').value = category;
	document.getElementById('navigate_cat').style.display = 'none';
}
/*
function productsdisp()
{
	document.getElementById('main_window').style.display='block';
	myRequest=new ajaxObject('Application/Stock/productscode.php');
	myRequest.callback=function(responseText){
	if(responseText==0)
	{   document.getElementById('main_window').innerHTML="No Products Added to System";
	}
	else
	{
		document.getElementById('main_window').innerHTML=responseText;
	}
}
myRequest.update();
}
*/
//This function is called by the productadd() function and it fetches the server side script for adding products to the system
function AddStock() {
	//viewmodules('products_links',4,1);
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Stock/AddStock.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '400px';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function AddMainCategory() {
	//viewmodules('products_links',4,1);
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Stock/add_category.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '400px';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function tax_val() {
	var tax_val = document.getElementById('tax');
	var tax = document.getElementById('tax').options[tax_val.selectedIndex].value;
	alert_box(tax);
}
function StoreStockItem(actionType) {
	var imagefile = document.getElementById('imagefile').value;
	var filename = imagefile.substr(imagefile.lastIndexOf('\\') + 1);
	var prdct_name = document.getElementById('prdct_name').value;
	var subcategory = document.getElementById('subcategory').value;
	var desc = document.getElementById('desc').value;
	var barcode = document.getElementById('Barcode').value;
	var supercategory = document.getElementById('supercategory').value;
	var maincategory = document.getElementById('maincategory').value;
	var minReorder = document.getElementById('minReorder').value;
	var maxReorder = document.getElementById('MaxReorder').value;
	var minStock = document.getElementById('minStock').value;
	var maxStock = document.getElementById('maxStock').value;
	var OpeningStock = document.getElementById('OpeningStock').value;
	var StockPrice = document.getElementById('StockPrice').value;
	var MfgName = document.getElementById('MfgName').value;
	var MfgEmail = document.getElementById('MfgEmail').value;
	var MfgAddress = document.getElementById('MfgAddress').value;
	var MfgTel = document.getElementById('MfgTel').value;
	var pac = document.getElementById('Packaging').value;
	var ExpiryDate = document.getElementById('ExpiryDate').value;
	
	if (actionType == 'add') {
	// var InitialQty = document.getElementById('maxStock').value;
	// var InitialPrice = document.getElementById('StockPrice').value;
		myRequest = new ajaxObject('Application/Stock/StoreProduct.php?prdct_name=' + prdct_name + '&subcategory=' + subcategory + '&desc=' + desc + '&filename=' + filename + '&barcode=' + barcode + '&minReorder=' + minReorder + '&maxReorder=' + maxReorder + '&minStock=' + minStock + '&maxStock=' + maxStock + '&OpeningStock=' + OpeningStock + '&StockPrice=' + StockPrice + '&MfgName=' + MfgName + '&MfgEmail=' + MfgEmail + '&MfgAddress=' + MfgAddress + '&MfgTel=' + MfgTel + '&DefaultPackaging=' + pac + ' &ExpiryDate=' + ExpiryDate + ' &supercategory=' + supercategory + '&maincategory=' + maincategory + '&');
		myRequest.callback = function (responseText) {
			if (isNaN(responseText)) {
				alert_box("The Item has been added.isNAN");
			}
			else {
				alert_box("The Item has been added.");
				catalogue(cat);
				closepopupdiv();

			}
		}
	}
	else
		if (actionType == 'edit') {
			var InitialQty = document.getElementById('InitialQty').value;
			var InitialPrice = document.getElementById('InitialPrice').value;
			var StockId = document.getElementById('StockId').value;
			myRequest = new ajaxObject('Application/Stock/StoreProductEdit.php?prdct_name=' + prdct_name + '&subcategory=' + subcategory + '&InitialQty=' + InitialQty + '&InitialPrice=' + InitialPrice + '&desc=' + desc + '&filename=' + filename + '&barcode=' + barcode + '&minReorder=' + minReorder + '&maxReorder=' + maxReorder + '&minStock=' + minStock + '&maxStock=' + maxStock + '&OpeningStock=' + OpeningStock + '&StockPrice=' + StockPrice + '&MfgName=' + MfgName + '&MfgEmail=' + MfgEmail + '&MfgAddress=' + MfgAddress + '&MfgTel=' + MfgTel + '&DefaultPackaging=' + pac + '&supercategory=' + supercategory + '&maincategory=' + maincategory + '&ExpiryDate=' + ExpiryDate + '&');
		}
	myRequest.callback = function (responseText) {
		if (responseText == 1) {
			alert_box('Action completed.');
			document.getElementById('imgupload').submit();
			if (actionType == 'add') {
				catalogue(cat);
			}
			else {
				if (document.getElementById('ListType').value == 1) {
					catalogue(cat);
				}
				else {
					disp_product_details(StockId, cat);
				}
			}
		}
		else {
			//alert_box("Error encountered in trying to store "+prdct_name);
			alert_box(responseText);
		}
		closepopupdiv();
	}
	myRequest.update();
}
function StockEdit() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to edit,click on it and use the Edit menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			if (StockId[i].checked) {
				EditStock(StockId[i].value);
				break;
			}
		}
	}
}
function EditStock(StockId) {
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Stock/EditStock.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '400px';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function RemoveStock() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to Remove,click on it and use the Delete menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			//alert(StockId.length);
			if (StockId[i].checked) {
				//alert(StockId[i].value);
				DeleteStock(StockId[i].value);
				break;
			}
		}
	}
}
function DeleteStock(StockId, CatId) {
	//alert(StockId);
	document.getElementById('ConfirmVars').value = StockId + "," + CatId;
	Confirm_Box("Are you sure you want to remove the selected Stock item ", "CompleteDelete");
}
function CompleteDelete() {
	var ConfirmVars = document.getElementById('ConfirmVars').value;
	ConfirmVarsDetails = ConfirmVars.split(",");
	var StockId = ConfirmVarsDetails[0];
	var CatId = ConfirmVarsDetails[1];
	var pname = 'Application/Stock/DeleteStock.php?StockId=' + StockId + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			catalogue(CatId);
			close_alert_div();
			closepopupdiv();
		}
	}
	myRequest.update();
}
function show_selected_products(cat) {
	/*alert_box(cat);*/
	var result = document.getElementById('product_search').value;
	if (result == "") {
		catalogue(cat);
	}
	else {
		display_search_results(result)
	}
}
function prdctsearch() {
	//getFuncs(9,1);
	//viewmodules('products_search',9,1);
	document.getElementById('drsElement').style.display = 'block';
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Stock/searchproduct.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.background = '#FAFAFA';
		div.style.border = "2px solid #0000ff";
		div.style.width = 700;
		div.style.height = 490;
		div.style.left = 200;
		div.style.top = 40;
	}
	myRequest.update();
}
function returnToCat() {
	productsdisp();
	getFuncs(6, 1);
}
function disp_product_details(StockId, CatId) {
	var div = document.getElementById('popup_div');
	var pname = 'Application/Stock/StockDetails.php?StockId=' + StockId + '&CatId=' + CatId + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (responseText == 0) {
			alert_box("This Product No longer exists in the system");
		} else {
			div.innerHTML = responseText;
			div.style.display = 'block';
			div.style.position = 'absolute';
			div.style.left = '20%';
			div.style.top = '10%';
			div.style.width = '900px';
			div.style.height = 'auto';
			div.style.width = 'auto';
		}
	}
	myRequest.update();
}
function catadd() {
	var myRequest = new ajaxObject('Application/Stock/add_category.php');
	myRequest.callback = function (responseText) {
		document.getElementById('popup_div').innerHTML = responseText;
	}
	openPopupDiv('block', 500, 'auto', '', '2px solid #0000ff', '#FAFAFA', '', '', 'none');
	myRequest.update();
}
function catedit(cat) {
	var myRequest = new ajaxObject('Application/Stock/edit_category.php?cat_id=' + cat + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('popup_div').innerHTML = responseText;
	}
	openPopupDiv('block', 400, 'auto', '', '2px solid #0000ff', '#FAFAFA', 250, 50, 'none');
	myRequest.update();
}
function clear_cat_fields() {
	document.getElementById('cat_name').value = "";
	document.getElementById('cat_description').value = "";
}
function CategoryAction() {
	if (document.getElementById('CatId').value == "") {
		add_category();
	}
	else {
		edit_category();
	}
}
function add_category() {
	var cat_name = document.getElementById('cat_name').value;
	var cat_desc = document.getElementById('cat_description').value;
	var par_id = document.getElementById('parent_id');
	var parent_id = document.getElementById('cat').value;
	var CatIm = document.getElementById('file').value;
	var CatImage = CatIm.substr(CatIm.lastIndexOf('\\') + 1);
	var ParentCatName = document.getElementById('ParentCatName').value;
	var CatName2 = document.getElementById('CatName2').value;
	var SubCatName = document.getElementById('SubCatName').value;
	if (validateAddCategory() != false) {
		var pname = 'Application/Stock/StoreCategory.php?cat_name=' + cat_name + '&cat_desc=' + cat_desc + '&parent_id=' + parent_id + '&ParentCatName' + ParentCatName + '&CatName2' + CatName2 + 'SubCatName' + SubCatName + '&CatImage=' + CatImage + '&';
		var myRequest = new ajaxObject(pname + '&');
		myRequest.callback = function (responseText) {
			//alert(responseText);
			if (responseText == 2) {
				alert_box("Category already exists");
			}
			else if (responseText == 1) {
				//alert_box("Action completed.");
				document.getElementById('UploadCatImage').submit();
				catalogue();
				ShowTheCats();
				//closepopupdiv();
			}
			else {
				alert_box(responseText);
			}
		}
		myRequest.update();
	}
}
function edit_category() {
	var cat_name = document.getElementById('cat_name').value;
	var cat_desc = document.getElementById('cat_description').value;
	var cat_id = document.getElementById('cat').value;
	var CatIm = document.getElementById('file').value;
	var CatImage = CatIm.substr(CatIm.lastIndexOf('\\') + 1);
	var PrevImage = document.getElementById('prevCatImage').value;
	if (PrevImage != CatImage) {
		document.getElementById('UploadCatImage').submit();
	}
	else {
		CatImage = PrevImage;
	}
	if (validateAddCategory() != false) {
		var pname = 'Application/Stock/StoreCategoryChanges.php?cat_name=' + cat_name + '&cat_desc=' + cat_desc + '&cat_id=' + cat_id + '&CatImage=' + CatImage + '&';
		//alert(pname);
		var myRequest = new ajaxObject(pname + '&');
		myRequest.callback = function (responseText) {
			if (responseText == 2) {
				alert_box("Category name used is already being used by another Category");
			}
			else if (responseText == 1) {
				ShowTheCats();
				catalogue();
				closepopupdiv();
			}
			else {
				alert_box(responseText);
			}
		}
		myRequest.update();
	}
}
function searchProd() {
	var crit = document.getElementById('search_criteria');
	var criteria = document.getElementById('search_criteria').options[crit.selectedIndex].value;
	var search_val = document.getElementById('search_val').value;
	var crit_amt = document.getElementById('criteria_amt');
	var criteria_amt = document.getElementById('criteria_amt').options[crit_amt.selectedIndex].value;
	var myRequest = new ajaxObject('Application/Stock/generate_product.php?criteria=' + criteria + '&search_val=' + search_val + '&criteria_amt=' + criteria_amt + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('product_search').value = responseText;
		display_search_results(responseText);
	}
	myRequest.update();
}
function display_search_results(results) {
	var myRequest = new ajaxObject('Application/Stock/search_product_result.php?search_string=' + results + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
		document.getElementById('main_window').style.display = 'block';
		document.getElementById('main_window').style.overflow = 'hidden';
	}
	myRequest.update();
}
function StockCategories() {
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Stock/ViewStockCategories.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '700px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheCats();
	}
	myRequest.update();
}
function ShowTheCats() {
	var myRequest = new ajaxObject('Application/Stock/StockCategories.php');
	myRequest.callback = function (responseText) {
		document.getElementById('showCategories').innerHTML = responseText;
	}
	myRequest.update();
}
function SelectCat(CatId) {
	var pname = 'Application/Stock/SelectCat.php?CatId=' + CatId + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		var result = responseText.split(':');
		document.getElementById('CatId').value = CatId;
		document.getElementById('cat').value = CatId;
		document.getElementById('cat_name').value = result[0];
		document.getElementById('category').value = result[1];
		document.getElementById('cat_description').value = result[2];
		document.getElementById('prevCatImage').value = result[3];
	}
	myRequest.update();
}
function DeleteCategory() {
	Confirm_Box("Are you sure you want to delete the selected categories", "CompleteDeleteCat");
}
function CompleteDeleteCat() {
	var CatId = document.getElementsByName('CatId');
	for (var i = 0; i <= CatId.length; i++) {
		if (CatId[i].checked) {
			var pname = 'Application/Stock/DeleteCategory.php?CatId=' + CatId[i].value + '&';
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function (responseText) {
				//alert(responseText);
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else if (responseText == 1) {
					ShowTheCats();
					catalogue();
					close_alert_div();
				}
			}
			myRequest.update();
			break;
		}
	}
}
function ListStockFormat() {
	var div = document.getElementById('QuitWindowDiv');
	myRequest = new ajaxObject('Application/Stock/ListStockView.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '40%';
		div.style.top = '10%';
		div.style.width = '200px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		modal();
	}
	myRequest.update();
}
function ListStockViewShow(ViewType) {
	//alert(ViewType);
	document.getElementById('ListType').value = ViewType;
	catalogue();
	HideQuitWindow();
	removeModal();
}
function ItemMfgDetails() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to view its stock Mfg Details,click on it and use the Item Mfg Details menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			if (StockId[i].checked) {
				ShowItemMfgDetails(StockId[i].value);
				break;
			}
		}
	}
}
function ShowItemMfgDetails(StockId) {
	var div = document.getElementById('popup_div_1');
	myRequest = new ajaxObject('Application/Stock/ItemMfgDetails.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '25%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function EditMfgDetails(DetailsId) {
	var div = document.getElementById('popup_div_1');
	myRequest = new ajaxObject('Application/Stock/EditItemMfgDetails.php?DetailsId=' + DetailsId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '25%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function CompleteEditMfgDetails(DetailsId) {
	var MfgName = document.getElementById('MfgName').value;
	var DateMfg = document.getElementById('DateMfg').value;
	var ExprDate = document.getElementById('ExprDate').value;
	var OtherDetails = document.getElementById('OtherDetails').value;
	var StockId = document.getElementById('StockId').value;
	if (ValidateMfgDetails() != false) {
		var pname = 'Application/Stock/CompleteEditMfgDetails.php?MfgName=' + MfgName + '&DateMfg=' + DateMfg + '&ExprDate=' + ExprDate + '&OtherDetails=' + OtherDetails + '&DetailsId=' + DetailsId + '&StockId=' + StockId + '&';
		var myRequest = new ajaxObject(pname);
		myRequest.callback = function (responseText) {
			if (isNaN(responseText)) {
				alert_box(responseText);
			}
			else {
				ShowItemMfgDetails(StockId);
			}
		}
		myRequest.update();
	}
}
function StockPackaging() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to view its stock packaging,click on it and use the Item packaging menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			if (StockId[i].checked) {
				ShowStockPackaging(StockId[i].value);
				break;
			}
		}
	}
}
function ShowStockPackaging(StockId) {
	var div = document.getElementById('popup_div_1');
	document.getElementById('ShowPackageType').value = 'JustPackaging';
	myRequest = new ajaxObject('Application/Stock/StockPackaging.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		//alert(reponseText);
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowThePackaging(StockId);
	}
	myRequest.update();
}
function ShowThePackaging(StockId) {
	//alert(StockId);
	var myRequest = new ajaxObject('Application/Stock/StockPackagingDetails.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('ShowPackages').innerHTML = responseText;
	}
	myRequest.update();
}
function ShowStockPackagingDisplay(StockId) {
	//viewmodules('products_links',4,1);
	//ert(StockId);
	var div = document.getElementById('popup_div_1');
	document.getElementById('ShowPackageType').value = 'JustPackaging';
	myRequest = new ajaxObject('Application/Stock/StockPackagingDisplay.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowThePackaging(StockId);
	}
	myRequest.update();
}
function StorePackagingDetails() {
	var pac = document.getElementById('Packaging');
	var packaging = pac.options[pac.selectedIndex].value;
	var qty = document.getElementById('PackageQty').value;
	var price = document.getElementById('PackagePrice').value;
	var barcode = document.getElementById('PackageBarcode').value;
	var pacType = document.getElementById('PackagingType');
	var packagingType = pacType.options[pacType.selectedIndex].value;
	var PackagingId = document.getElementById('PackagingId').value;
	var StockId = document.getElementById('StockNo').value;
	var ShowType = document.getElementById('ShowPackageType').value;
	//alert(packaging);
	if (ValidatePackaging() != false) {
		var pname = 'Application/Stock/StorePackaging.php?Packaging=' + packaging + '&qty=' + qty + '&price=' + price + '&PackagingType=' + packagingType + '&PackagingId=' + PackagingId + '&StockId=' + StockId + '&barcode=' + barcode + '&';
		//alert(pname);
		var myRequest = new ajaxObject(pname);
		myRequest.callback = function (responseText) {
			if (isNaN(responseText)) {
				alert_box(responseText);
			}
			else {
				if (ShowType == 'JustPackaging') {
					ShowThePackaging(StockId);
				}
				else {
					ShowThePackagingPricing(StockId);
				}
				document.getElementById('StockId').value = '';
				document.getElementById('PackageQty').value = '';
				document.getElementById('PackagePrice').value = '';
				document.getElementById('PackageBarcode').value = '';
				document.getElementById('PackagingId').value = '';
			}
		}
		myRequest.update();
	}
}
function LoadPackageDetailsForEdit(PackageId) {
	var myRequest = new ajaxObject('Application/Stock/FetchPackagingDetails.php?PackageId=' + PackageId + '&');
	myRequest.callback = function (responseText) {
		var result = responseText.split(':');
		document.getElementById('PackagingId').value = PackageId;
		document.getElementById('PackageQty').value = result[2];
		document.getElementById('PackagePrice').value = result[3];
		document.getElementById('PackageBarcode').value = result[6];
		var pac = document.getElementById('Packaging');
		pac.options[0] = new Option(result[1], result[0], true, true);
		var pacType = document.getElementById('PackagingType');
		pacType.options[0] = new Option(result[5], result[4], true, true);
	}
	myRequest.update();
}
function DeletePackaging() {
	Confirm_Box("Are you sure you want to delete the selected Packaging entries?", "CompleteDeletePackaging");
}
// function DeletePackaging() {
// 	var confirmAction = confirm("Are you sure to execute this action?");
// 	if (confirmAction) {
// 		CompleteDeletePackaging();
// 	} else {
// 		alert("Action canceled");
// 	}
// }
function CompleteDeletePackaging() {
	var PackagingId = document.getElementsByName('PackageId');
	var StockId = document.getElementById('StockNo');
	for (var i = 0; i <= PackagingId.length; i++) {
		if (PackagingId[i].checked) {
			var pname = 'Application/Stock/DeletePackaging.php?PackagingId=' + PackagingId[i].value + '&';
			//alert(pname);
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function (responseText) {
				//alert(responseText);
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					ShowThePackaging(StockId);
					close_alert_div();
					removeModal();
				}
			}
			myRequest.update();
		}
	}
}
function SearchItem() {
	//THis function is used to roll out the patient's search window
	var myRequest = new ajaxObject('Application/Stock/SearchStock.php');
	document.getElementById('SearchHeight').value = '140';
	myRequest.callback = function (responseText) {
		document.getElementById('search_bar').innerHTML = responseText;
		//Show the window if the window is empty
		if (document.getElementById('search_bar').style.display == 'none' || document.getElementById('search_bar').style.display == '') {
			inter = setInterval('showSearchDiv()', 3);
			return false;
		}
	}
	myRequest.update();/**/
}
function SendStockSearch() {
	var StockName = document.getElementById('StockName').value;
	var BarcodeNo = document.getElementById('BarcodeNo').value;
	var Category = document.getElementById('cat').value;
	var minReorder = document.getElementById('minReorder').value;
	var MaxReorder = document.getElementById('MaxReorder').value;
	var minStock = document.getElementById('minStock').value;
	var MaxStock = document.getElementById('MaxStock').value;
	var OpeningStock = document.getElementById('OpeningStock').value;
	var pname = 'Application/Stock/GenerateStockSearchSQL.php?StockName=' + StockName + '&BarcodeNo=' + BarcodeNo + '&Category=' + Category + '&minReorder=' + minReorder + '&MaxReorder=' + MaxReorder + '&minStock=' + minStock + '&MaxStock=' + MaxStock + '&OpeningStock=' + OpeningStock + '&';
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		if (document.getElementById('ListType').value != 1) {
			ShowStockResultsIcon(responseText);
		}
		else {
			ShowStockResultsTabular(responseText);
		}
	}
	myRequest.update();
}
function ShowStockResultsTabular(results) {
	//alert(results);
	var pname = 'Application/Stock/SearchResultstabular.php?SearchStr=' + results + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function ShowStockResultsIcon(results) {
	//alert(results);
	var pname = 'Application/Stock/SearchResultsIcon.php?SearchStr=' + results + '&';
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
function LinkCatToDepartment() {
	var CatId = document.getElementsByName('CatId');
	var SelectedCatIds = 0;
	TheCatId = '';
	for (var i = 0; i <= CatId.length; i++) {
		//alert(CatId.length);
		if (CatId[i].checked) {
			SelectedCatIds += 1;
			TheCatId = CatId[i].value;
		}
		if (i == (CatId.length - 1)) {
			if (SelectedCatIds > 1) {
				alert_box("You can only with one category at a time.You have selected more than one category");
			}
			else {
				ShowDepartmentsList(TheCatId);
			}
		}
	}
}
function ShowDepartmentsList(TheCatId) {
	var div = document.getElementById('popup_div_1');
	myRequest = new ajaxObject('Application/Stock/DepartmentsList.php?CatId=' + TheCatId + '&');
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
function CheckDepartments() {
	var CheckDepartment = document.getElementById('CheckDepartments');
	var Depts = document.getElementsByName('DeptId');
	if (CheckDepartment.checked) {
		for (var i = 0; i <= Depts.length; i++) {
			Depts[i].checked = true;
		}
	}
	else {
		for (var i = 0; i <= Depts.length; i++) {
			Depts[i].checked = false;
		}
	}
}
function LinkCatToDepts() {
	var Depts = document.getElementsByName('DeptId');
	var CatId = document.getElementById('CatNo').value;
	var SelectedDepartments = '';
	for (var i = 0; i <= Depts.length; i++) {
		if (Depts[i].checked) {
			SelectedDepartments += Depts[i].value + ':';
		}
		if (i == (Depts.length - 1)) {
			var pname = 'Application/Stock/CompleteLinkCatToDept.php?SelectedDepartments=' + SelectedDepartments + '&CatId=' + CatId + '&';
			//alert(pname);
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function (responseText) {
				//alert(responseText);
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					ShowDepartmentsList(CatId);
					ShowConnectedDepartments(CatId);
				}
			}
			myRequest.update();
		}
	}
}
function ShowConnectedDepartments(CatId) {
	var div = document.getElementById('popup_div_2');
	myRequest = new ajaxObject('Application/Stock/ConnectedDepartmentsList.php?CatId=' + CatId + '&');
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
function ItemPricing() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to view its Item Pricing,click on it and use the Item packaging menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			if (StockId[i].checked) {
				ShowItemPricing(StockId[i].value);
				break;
			}
		}
	}
}
function ShowItemPricing(StockId) {
	var div = document.getElementById('popup_div_1');
	document.getElementById('ShowPackageType').value = 'Pricing';
	myRequest = new ajaxObject('Application/Stock/ItemPackagingPricing.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowThePackagingPricing(StockId);
	}
	myRequest.update();
}
function ShowThePackagingPricing(StockId) {
	//alert(StockId);
	var myRequest = new ajaxObject('Application/Stock/StockPackagingPricingDetails.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('ShowPackages').innerHTML = responseText;
	}
	myRequest.update();
}
function PriceChangeHistory(StockId, PackageId) {
	var div = document.getElementById('popup_div_2');
	myRequest = new ajaxObject('Application/Stock/ItemPriceChangeLog.php?StockId=' + StockId + '&PackageId=' + PackageId + '&');
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
function GetAlternativeItemsHint(StockId) {
	var ItemName = document.getElementById('ItemName').value;
	//alert(item_type);
	var pname = 'Application/Stock/HintAlternativeItems.php?ItemName=' + ItemName + '&StockId=' + StockId + '&';
	//alert(pname);
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('hint').innerHTML = responseText;
		document.getElementById('hint').style.display = 'block';
	}
	myRequest.update();
}
function hideHint() {
	document.getElementById('hint').style.display = 'none';
}
function GetItemDetail() {
	var ItemName = document.getElementById('hintTxt').value;
	document.getElementById('ItemName').value = document.getElementById('hintTxt').value;
	//alert(transaction_type);
	var myRequest = new ajaxObject('Application/Stock/GetStockItemId.php?ItemName=' + ItemName + '&');
	myRequest.callback = function (responseText) {
		//alert(responseText);
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			document.getElementById('ItemId').value = responseText;
		}
	}
	myRequest.update();
}
function StockAlternatives() {
	if (document.getElementById('ListType').value != 1) {
		alert_box("It appears you are on the icon view mode.<br>Navigate to the item you want to view its stock Alternatives,click on it and use the Item packaging menu at the Title bar of that item details window");
	}
	else {
		var StockId = document.getElementsByName('StockId');
		for (var i = 0; i <= StockId.length; i++) {
			if (StockId[i].checked) {
				ShowStockAlternatives(StockId[i].value);
				break;
			}
		}
	}
}
function ShowStockAlternatives(StockId) {
	//viewmodules('products_links',4,1);
	//ert(StockId);
	var div = document.getElementById('popup_div_1');
	document.getElementById('ShowPackageType').value = 'JustPackaging';
	myRequest = new ajaxObject('Application/Stock/StockAlternatives.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheStockAlternatives(StockId);
	}
	myRequest.update();
}
function ShowTheStockAlternatives(StockId) {
	//alert(StockId);
	var myRequest = new ajaxObject('Application/Stock/ShowStockAlternatives.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('ShowAlternatives').innerHTML = responseText;
	}
	myRequest.update();
}
function ShowStockAlternativesDisplay(StockId) {
	//viewmodules('products_links',4,1);
	//ert(StockId);
	var div = document.getElementById('popup_div_1');
	document.getElementById('ShowPackageType').value = 'JustPackaging';
	myRequest = new ajaxObject('Application/Stock/StockAlternativesDisplay.php?StockId=' + StockId + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheStockAlternatives(StockId);
	}
	myRequest.update();
}
function StoreItemAsAlternative(StockId) {
	//alert(StockId);
	var ItemId = document.getElementById('ItemId').value;
	if (ItemId == '') {
		alert_box("Please Select an item to add as an alternative");
	}
	else {
		var pname = 'Application/Stock/AddAlternative.php?ItemId=' + ItemId + '&StockId=' + StockId + '&';
		var myRequest = new ajaxObject(pname);
		myRequest.callback = function (responseText) {
			//alert(responseText);
			if (isNaN(responseText)) {
			}
			else {
				ShowTheStockAlternatives(StockId);
			}
		}
		myRequest.update();
	}
}
function RemoveAlternative() {
	Confirm_Box("Are you sure you want to remove the selected Stock Alternatives", "ProceeedRemoveAlternative");
}
function ProceeedRemoveAlternative() {
	var Alternates = document.getElementsByName('AlternateId');
	var StockId = document.getElementById('StockNumba').value;
	//alert("Proceed"+StockId);
	var SelectedAlternatives = '';
	for (var i = 0; i <= Alternates.length; i++) {
		if (Alternates[i].checked) {
			SelectedAlternatives += Alternates[i].value + ':';
		}
		if (i == (Alternates.length - 1)) {
			CompleteRemoveAlternatives(StockId, SelectedAlternatives);
			close_alert_div();
		}
	}
}
function CompleteRemoveAlternatives(StockId, SelectedAlternatives) {
	//alert("Complete"+StockId);
	var myRequest = new ajaxObject('Application/Stock/RemoveStockAlternatives.php?StockId=' + StockId + '&SelectedAlternatives=' + SelectedAlternatives + '&');
	myRequest.callback = function (responseText) {
		if (isNaN(responseText)) {
			alert_box(responseText);
		}
		else {
			ShowTheStockAlternatives(StockId);
		}
	}
	myRequest.update();
}
function CheckAlternates() {
	var CheckAlternates = document.getElementById('AlternateCheck');
	var Alternates = document.getElementsByName('AlternateId');
	if (CheckAlternates.checked) {
		for (var i = 0; i <= Alternates.length; i++) {
			Alternates[i].checked = true;
		}
	}
	else {
		for (var i = 0; i <= Alternates.length; i++) {
			Alternates[i].checked = false;
		}
	}
}
function StorePackagingName() {
	var PackageName = document.getElementById('PackagingName').value;
	var PackagingId = document.getElementById('PackagingId').value;
	if (PackageName == '') {
		alert_box("Please type in the name of the packaging you want to setup");
	}
	else {
		var pname = 'Application/Stock/StorePackageSetup.php?PackageName=' + PackageName + '&PackagingId=' + PackagingId + '&';
		var myRequest = new ajaxObject(pname);
		myRequest.callback = function (responseText) {
			if (isNaN(responseText)) {
				alert_box(responseText);
			}
			else {
				alert_box("You have successfully Added a Packaging Type");
				ShowMadePackaging();
			}
		}
		myRequest.update();
	}
}
function ShowMadePackaging() {
	var myRequest = new ajaxObject('Application/Stock/MadePackaging.php');
	myRequest.callback = function (responseText) {
		$(document).ready(
			function () {
				$('#madepackaging').DataTable(
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
		document.getElementById('ShowMadePackages').innerHTML = responseText;
	}
	myRequest.update();
}
function StockPackagingSetup() {
	var div = document.getElementById('popup_div');
	myRequest = new ajaxObject('Application/Stock/PackagingSetup.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '30%';
		div.style.top = '10%';
		div.style.width = '500px';
		div.style.height = 'auto';
		ShowMadePackaging();
	}
	myRequest.update();
}
function CheckMadePackaging(PackageId) {
	var Package = document.getElementsByName('CheckPackage');
	for (var i = 0; i <= Package.length; i++) {
		if (Package[i].checked) {
			var pname = 'Application/Stock/GetPackageDetails.php?PackageId=' + Package[i].value + '&';
			var myRequest = new ajaxObject(pname);
			myRequest.callback = function (responseText) {
				document.getElementById('PackagingName').value = responseText;
				document.getElementById('PackagingId').value = Package[i].value;
			}
			myRequest.update();
			break;
		}
	}
}
function ShowLinkedItems(PackageId, StockItems) {
	var div = document.getElementById('popup_div_1');
	myRequest = new ajaxObject('Application/Stock/ShowLinkedItems.php?PackageId=' + PackageId + '&StockItems=' + StockItems + '&');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '45%';
		div.style.top = '10%';
		div.style.width = 'auto';
		div.style.height = 'auto';
		div.style.width = 'auto';
	}
	myRequest.update();
}
function AddMainStockCat() {
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Stock/addmain.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '700px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheCats();
	}
	myRequest.update();
}
function AddStockCategory() {
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Stock/category.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '700px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheCats();
	}
	myRequest.update();
}
function AddStockSubCategory() {
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Stock/addsubcat.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '700px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheCats();
	}
	myRequest.update();
}
function AddStockItem() {
	var div = document.getElementById('popup_div');
	var myRequest = new ajaxObject('Application/Stock/AddStockItem.php');
	myRequest.callback = function (responseText) {
		div.innerHTML = responseText;
		div.style.display = 'block';
		div.style.position = 'absolute';
		div.style.left = '20%';
		div.style.top = '10%';
		div.style.width = '700px';
		div.style.height = 'auto';
		div.style.width = 'auto';
		ShowTheCats();
	}
	myRequest.update();
}
function AddMainCat(actionType) {
	var ParentCatName = document.getElementById('ParentCatName').value;
	var Description = document.getElementById('Description').value;
	var Error_Message = 'The following errors occuired during excution.<br/>';
	var Error_Count = 0
	if (ParentCatName == '') {
		Error_Message += '-Please enter the Super Category Name.<br/>';
		Error_Count += 1;
	}
	if (Description == '') {
		Error_Message += '-Please enter the Main Category Description.<br/>';
		Error_Count += 1;
	}
	if (Error_Count > 0) {
		alert_box(Error_Message);
	}
	else {
		if (actionType == 'add') {
			myRequest = new ajaxObject('Application/Stock/StoreMainCat.php?ParentCatName=' + ParentCatName + '&Description=' + Description + '&');
			myRequest.callback = function (responseText) {
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					alert_box("The Main Category has been added.");
					ViewStockCategories2();
					closepopupdiv();
				}
			}
		}
		myRequest.update();
	}
}
function AddCategory2(actionType) {
	var MainCat = document.getElementById('MainCat').value;
	var CatName = document.getElementById('CatName').value;
	var Description = document.getElementById('Description').value;
	var Error_Message = 'The following errors occuired during excution.<br/>';
	var Error_Count = 0
	if (MainCat == '') {
		Error_Message += '-Please enter the Super Category Name.<br/>';
		Error_Count += 1;
	}
	if (CatName == '') {
		Error_Message += '-Please enter the Category Name.<br/>';
		Error_Count += 1;
	}
	if (Description == '') {
		Error_Message += '-Please enter the Category Description.<br/>';
		Error_Count += 1;
	}
	if (Error_Count > 0) {
		alert_box(Error_Message);
	}
	else {
		if (actionType == 'add') {
			myRequest = new ajaxObject('Application/Stock/StoreCat.php?MainCat=' + MainCat + '&CatName=' + CatName + '&Description=' + Description + '&');
			myRequest.callback = function (responseText) {
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					alert_box("The Category has been added.");
					ViewStockCategories2();
					closepopupdiv();
				}
			}
		}
		myRequest.update();
	}
}
function AddCategory3(actionType) {
	var superCat = document.getElementById('MainCat').value;
	var maincatId = document.getElementById('Category').value;
	var SubCatName = document.getElementById('SubCatName').value;
	var Description = document.getElementById('Description').value;
	var Error_Message = 'The following errors occuired during excution.<br/>';
	var Error_Count = 0
	if (MainCat == '') {
		Error_Message += '-Please enter the Super Category Name.<br/>';
		Error_Count += 1;
	}
	if (Category == '') {
		Error_Message += '-Please enter the Category Name.<br/>';
		Error_Count += 1;
	}
	if (SubCatName == '') {
		Error_Message += '-Please enter the Sub Category Name.<br/>';
		Error_Count += 1;
	}
	if (Description == '') {
		Error_Message += '-Please enter the Sub Category Description.<br/>';
		Error_Count += 1;
	}
	if (Error_Count > 0) {
		alert_box(Error_Message);
	}
	else {
		if (actionType == 'add') {
			myRequest = new ajaxObject('Application/Stock/StoreSubCat.php?MainCat=' + superCat + '&Category=' + maincatId + '&SubCatName=' + SubCatName + '&Description=' + Description + '&');
			myRequest.callback = function (responseText) {
				if (isNaN(responseText)) {
					alert_box(responseText);
				}
				else {
					alert_box("The Sub Category has been added.");
					ViewStockCategories2();
					closepopupdiv();
				}
			}
		}
		myRequest.update();
	}
}
function ViewStockCategories2() {
	catalogue2();
}
//This function displays all the products 
function catalogue2(cat_id) {
	// alert(document.getElementById('ListType').value);
	if (document.getElementById('ListType').value == 1 || document.getElementById('ListType').value == '') {
		var pname = 'Application/Stock/ViewCategories.php?cat_id=' + cat_id + '&';
	}
	else {
		var pname = 'Application/Stock/catalogue.php?cat_id=' + cat_id + '&';
		document.getElementById('main_window').style.background = "#FFFFFF";
	}
	//alert(pname);
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
		$(document).ready(
			function () {
				$('#stockcategories').DataTable(
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
	}
	myRequest.update();
}
function DisplayStockPackaging() {
	catalogue3();
}
//This function displays all the products 
function catalogue3(cat_id) {
	// alert(document.getElementById('ListType').value);
	if (document.getElementById('ListType').value == 1 || document.getElementById('ListType').value == '') {
		var pname = 'Application/Stock/DisplayPackagingList.php?StockId=' + StockId + '&';
	}
	else {
		var pname = 'Application/Stock/catalogue.php?cat_id=' + cat_id + '&';
		document.getElementById('main_window').style.background = "#FFFFFF";
	}
	//alert(pname);
	myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		document.getElementById('main_window').innerHTML = responseText;
		$(document).ready(
			function () {
				$('#stockpackaging').DataTable(
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
	}
	myRequest.update();
}
//Getting Category Details
function getmainCategory(value) {
	var myRequest = new ajaxObject('Application/Stock/getCategory.php?value=' + value + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('loadCategory').innerHTML = responseText;
	}
	myRequest.update();
}
//Getting Category Details
function getSubCategory(value) {
	var myRequest = new ajaxObject('Application/Stock/getSubCategory.php?value=' + value + '&');
	myRequest.callback = function (responseText) {
		document.getElementById('loadSubCategory').innerHTML = responseText;
	}
	myRequest.update();
}
function StockDashBoard() {
	//This function will be used to display patients on the browser window
	var pname = "Application/InventoryDashBoard.php";
	var myRequest = new ajaxObject(pname);
	myRequest.callback = function (responseText) {
		
 		 $(document).ready(
        function() {
         $('#staffservices1').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: 'Bfrtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
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
    

],
paging: true,
sPageButtonStaticDisabled : "paginate_button_disabled",
searching: false,
destroy: true

});
     
        });



 		 $(document).ready(
        function() {
         $('#staffservices2').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: 'Bfrtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
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
    

],
paging: true,
searching: false,
destroy: true

});
     
        });



 		 $(document).ready(
        function() {
         $('#staffservices3').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: 'Bfrtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
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
    

],
paging: true,
searching: false,
destroy: true

});
     
        });



 		 $(document).ready(
        function() {
         $('#staffservices4').DataTable(
          {
    order: [[ 1, "desc" ]],
    dom: 'Bfrtip',
    lengthMenu: [
        [ 2, 25, -1 ],
        [ '2 rows', '25 rows', 'Show all' ]
    ],
     buttons: [
    {
        extend: 'excel', 
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
    

],
paging: true,
searching: false,
destroy: true

});
     
        });

		document.getElementById('main_window').innerHTML = responseText;
	}
	myRequest.update();
}
