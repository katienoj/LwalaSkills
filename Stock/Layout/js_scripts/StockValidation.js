function validateAddStock(){		
	var reason = '';
	
	reason += validateProductName();
	reason += validatePdCat();
	//reason += validateOpeningStock();
	reason += validateMinStock();
	reason += validateMaxStock();
	reason += validateMinReorder();
	reason += validateMaxReorder();
	
	

		
		if (reason != '') {
		alert_box("Please attend to the following:<br>" +reason);
		return false;
		}

	}
	
	
	function validateImageFile(){
	var imagefile = document.getElementById('imagefile');	
	var error = '';
	if(imagefile.value.length == 0 || document.getElementById('photoz').value==""){var error = 'You have not selected an image.<br>'}	
	return error;	
	}
	
	function validateProductName(){
	var prdct_name = document.getElementById('prdct_name');	
	var error = '';
	if(prdct_name.value.length == 0){var error = 'You have not entered a product name.<br>'}	
	return error;			
	}
	
	
	function validateOpeningStock(){
	var price = document.getElementById('OpeningStock');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered Opening Stock for stock item.<br>'}	
	return error;			
	}
	
	function validatePdCat(){
	var category = document.getElementById('category');	
	var error = '';
	if(category.value.length == 0){var error = 'You have not selected a category.<br>'}	
	return error;			
	}
	
	function validateOpeningStock(){
	var price = document.getElementById('OpeningStock');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered Opening Stock for stock item.<br>'}	
	return error;			
	}
	
	function validateMinStock(){
	var price = document.getElementById('minStock');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered minimum Stock for stock item.<br>'}	
	return error;			
	}
	
	function validateMaxStock(){
	var price = document.getElementById('maxStock');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered maximum Stock for stock item.<br>'}	
	return error;			
	}
	function validateMinReorder(){
	var price = document.getElementById('minReorder');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered minimum Reorder level for stock item.<br>'}	
	return error;			
	}
	
	function validateMaxReorder(){
	var price = document.getElementById('MaxReorder');	
	var error = '';
	if(price.value.length == 0){var error = 'You have not entered maximum Reroder level for stock item.<br>'}	
	return error;			
	}
	function validateAddCategory(){		
	var reason = '';
	reason += validateCatName();
	reason += validateCategory();
	
		if (reason != '') {
		alert_box("Please attend to the following:<br><br>" +reason);
		return false;
		}

	}
	
	
	function validateCatName(){
	var cat_name = document.getElementById('cat_name');	
	var error = '';
	if(cat_name.value.length == 0){var error = 'You have not entered a category name.<br>'}	
	return error;			
	}
	
	function validateCategory(){
	var category = document.getElementById('category');	
	var error = '';
	if(category.value.length == 0){var error = 'You have not selected a parent category.<br>'}	
	return error;			
	}
	


function ValidateSupplier()
{
	var reason = '';
	
	reason += validateSupplierName();
	reason += validateSupplierPhone();
	reason += validateSupplierPhyAddress();
	reason += validateSupplierPostAddress();
	reason += validateSupplierTown();
	reason += validateSupplierCountry();
	
	
		if (reason != '') {
		alert_box("Please attend to the following:<br>" +reason);
		return false;
		}

	
}



	function validateSupplierName(){
	var critera = document.getElementById('SupplierNames');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in Supplier Names.<br>'}	
	return error;			
	}
	
	function validateSupplierPhone(){
	var critera = document.getElementById('Phone');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in telephone number of the supplier.<br>'}	
	return error;			
	}
	
	function validateSupplierPhyAddress(){
	var critera = document.getElementById('PhyAddress');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the physical Address of the supplier.<br>'}	
	return error;			
	}
	
	function validateSupplierPostAddress(){
	var critera = document.getElementById('PostAddress');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the Postal Address of the supplier.<br>'}	
	return error;			
	}
	function validateSupplierTown(){
	var critera = document.getElementById('Town');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the town or city where the supplier is located.<br>'}	
	return error;			
	}
	function validateSupplierCountry(){
	var c=document.getElementById('country');
	var country=c.options[c.selectedIndex];
	var critera = country;	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not selected the Country where the supplier is located.<br>'}	
	return error;			
	}
	
function ValidateMfgDetails()
{
	var reason = '';
	
	reason += validateMfgName();
	reason += validateDateMfg();
	reason += validateExprDate();
	

		if (reason != '') {
		alert_box("Please attend to the following:<br>" +reason);
		return false;
		}	
}


    function validateMfgName(){
	var critera = document.getElementById('MfgName');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the name of the manufacturer.<br>'}	
	return error;			
	}
	function validateDateMfg(){
	var critera = document.getElementById('DateMfg');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the Date of manufacture.<br>'}	
	return error;			
	}
	function validateExprDate(){
	var critera = document.getElementById('ExprDate');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the date of expiry of manufacturer.<br>'}	
	return error;			
	}

function ValidatePackaging()
{
	var reason = '';
	
	reason += validatePackagingName();
	reason += validatePackagingQty();
	reason += validatePackagingType();
	

		if (reason != '') {
		alert_box("Please attend to the following:<br>" +reason);
		return false;
		}	
}



	function validatePackagingName(){
	var pac=document.getElementById('Packaging');
	var packaging=pac.options[pac.selectedIndex];
	var critera = packaging;	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not selected a packaging.<br>'}	
	return error;			
	}
	function validatePackagingQty(){
	var critera = document.getElementById('PackageQty');	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not typed in the Qty inside the package.<br>'}	
	return error;			
	}
	function validatePackagingType(){
    var pacType=document.getElementById('PackagingType');
	var packagingType=pacType.options[pacType.selectedIndex];
	var critera = packagingType;	
	var error = '';
	if(critera.value.length == 0){var error = 'You have not selected a packaging type.<br>'}
	return error;
	}
	
	
	