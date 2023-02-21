<?php
// Load the main class
require_once 'HTML/QuickForm.php';
require_once '../../Main/Config/DbConnect.php';
require_once '../Lang/lang.php';
// Instantiate the HTML_QuickForm object
$form = new HTML_QuickForm('AddModuleForm', 'POST');

$form->addElement('header', null, $AddModuleHeaderText);
$form->addElement('text', 'Modulename', $AddModuleModuleName, array('size' => 50, 'maxlength' => 255));
$form->addElement('text', 'DisOrder', $AddModuleDisplayOrder, array('size' => 50, 'maxlength' => 255));
$form->addElement('textarea', 'Description', $AddModuleDescription, array('cols' => 38, 'rows' => 5));
$form->addElement('submit', null, 'Send');

// Define filters and validation rules
$form->applyFilter('Modulename', 'trim');
$form->applyFilter('DisOrder', 'trim');
$form->applyFilter('Description', 'trim');

//Define control validation rules
$form->addRule('Description', 'Please enter the module description', 'required', null, 'client');
$form->addRule('Modulename', 'Please enter the module name', 'required', null, 'client');
$form->addRule('DisOrder', 'Please enter the display order', 'numeric', null, 'client');
$form->addRule('DisOrder', 'Please enter the display order', 'required', null, 'client');
// Try to validate a form
if ($form->validate()) {
	// Output the form
	$ModuleName = htmlspecialchars($form->getSubmitValue('Modulename'));
	$DisplayOrder = htmlspecialchars($form->getSubmitValue('DisOrder'));
	$ModuleDescription = htmlspecialchars($form->getSubmitValue('Description'));
	$res = "INSERT INTO `systemmodules`(`ModuleName`,`DispOrder`,`ModulePermission`,`ModuleDescription`) VALUES('$ModuleName','$DisplayOrder',1,'$ModuleDescription')";
	$affected = &$mdb2->exec($res);
	if (PEAR::isError($affected)) {
		die($affected->getMessage());
	}
} else {

	$form->display();
}
