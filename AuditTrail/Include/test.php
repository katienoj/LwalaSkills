<?php

@include '../../Main/Config/db_conn.php';
@include 'AuditTrailFunc.php';

   /* $EmployeeId = htmlentities($_REQUEST['employeeid']);
	$County = htmlentities($_REQUEST['nationality']);
	$City = htmlentities($_REQUEST['town']);
	$PostalAdd = htmlentities($_REQUEST['address']);
	$PostalCode = htmlentities($_REQUEST['postalcode']);
	$PhoneNumber = htmlentities($_REQUEST['workphone']);
	$MobileNo = htmlentities($_REQUEST['mobileno']);
	$WorkEmail = htmlentities($_REQUEST['workemail']);
	$Street = htmlentities($_REQUEST['street']);
	$HomePhone = htmlentities($_REQUEST['homephone']);
	$OtherMobileNo = htmlentities($_REQUEST['othermobileno']);
	$OtherEmail = htmlentities($_REQUEST['otheremail']);*/
	
	
	$EmployeeId = htmlentities('employeeid');
	$County = htmlentities('nationality');
	$City = htmlentities('town');
	$PostalAdd = htmlentities('address');
	$PostalCode = htmlentities('postalcode');
	$PhoneNumber = htmlentities('workphone');
	$MobileNo = htmlentities('mobileno');
	$WorkEmail = htmlentities('workemail');
	$Street = htmlentities('street');
	$HomePhone = htmlentities('homephone');
	$OtherMobileNo = htmlentities('othermobileno');
	$OtherEmail = htmlentities('otheremail');

   $EmployeeId = htmlentities('34');
	$UserName = htmlentities('myname');
	$GroupId = htmlentities('13');
	$Password = htmlentities('mypass');
	$RegDate = date("yyyy-mm-dd");
	
	$GroupName = htmlentities('groupname');
	
	$Description = htmlentities('groupdescription');
	$InsertUser = '';

$SessionId='sg367484dfjjf949404jjjfj';
$InsertStatement = "UPDATE UserGroups SET GroupName = 'GroupName', GroupDescription = 'Description', LastModified = NOW() WHERE GroupId = 'GroupId'";

$SqlStatement = "UPDATE EmployeeContactTable SET CountryName = '$County', Street = '$Street',TownName = '$City',PostalAdd = '$PostalAdd', PostalCode = '$PostalCode',WorkPhone = '$PhoneNumber',MobileNumber = '$MobileNo',HomePhone = '$HomePhone',WorkEmail = '$WorkEmail',OtherEmail = '$OtherEmail' WHERE EmployeeId = '$EmployeeId'";
		
/*$InsertStatement = "INSERT INTO UserGroups(GroupName, GroupDescription, DateCreated) VALUES('$GroupName','$Description',CURDATE())";	
*/
AuditTransaction($SessionId,$InsertStatement);
