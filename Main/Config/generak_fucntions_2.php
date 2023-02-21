<?php
global $conn;
//Script Author:John Katieno
//Warning.The following server side functions run system wide.An error on any of these functions will be visible system wide
//Certain variables or objects might be seen in every function,a good example will be this:'global $conn'.This will be used to supply a copy of the database connection from where it is being called from
function sub_modules($parent_module, $group_id, $user_id)
{
    //Bassed on what module the user decides to enter,they must see a bunch of menus.This function will be invoked when the user gets into the module
    //Supply connection
    global $conn;
    global $dbconn; ?>
	<ul id="mainmenu" style="width:100%;">
		<?php  //Loop throught the database to get menus that call the selected module 'my parent'
        $strSQL = "SELECT * from SystemSubModules WHERE ParentModule='$parent_module' ORDER BY DispOrder ASC";
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    if (mysqli_num_rows($sql) > 0) {
        while ($recs = mysqli_fetch_array($sql)) {
            $module_id = $recs['SubModuleId'];
            $module_name = $recs['ModuleName'];
            $js_function = $recs['JsFunction'];
            //While looping through,check if the module has the appropriate permmissions
            $permission = GetSubPermission($group_id, $module_id, $user_id);
            //echo $permission;
            /**/
            if ($permission != 0) {
                //So long as the user has permission to see this module,why should deny the user access to the module?Show it?>
					<li><a href="javascript:void(0)" onClick="<?php echo $js_function; ?>('<?php echo $module_id; ?>')" onblur='indicate_where("<?php echo $module_name; ?>");' onfocus="module_functions('<?php echo $module_id; ?>')"><?php echo $module_name; ?></a></li>
		<?php
            }
        }
    } ?>
	</ul>
	<?php
}
function GetSubPermission($GroupId, $ModuleId, $user)
{
    //This function is called by the above function.So its major role is to spit out permissions assigned to this user on the selected module
    global $conn;
    $permission = '';
    $strSQL = "SELECT Permission,DeniedUsers FROM UserSubModulePermissions WHERE GroupId='$GroupId' AND ModuleId='$ModuleId'";
    //echo $strSQL;
    $get_perm = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($get_perm);
    $permission = $result['Permission'];
    $denied_users = $result['DeniedUsers'];
    if (stristr($denied_users, ':')) {
        $users = explode(':', $denied_users);
        $x = 0;
        //The following statement is to check if the user is blacklisted from Accessing this submodule
        while ($x < count($users)) {
            //If the user is blacklisted from accessing this submodule,return 0.This will tell the above function to hide this sub module from view and access by the user
            if ($users[$x] == $user) {
                $permission = 0;
            }
            $x++;
        }
    } else {
        $permission = $result['permission'];
    }
    return "1";
}
function GetPermission($GroupId, $ModuleId)
{
    //This function will be used to confirm if a user has access to the selected module
    global $conn;
    //Loop thru the database to pick up permissions for the selected module
    $get_perm = mysqli_query($conn, "SELECT Permission FROM UserPermissions WHERE GroupId='$GroupId' AND ModuleId='$ModuleId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($get_perm);
    $permission = $result['Permission'];
    //echo $permission;
    return $permission;
}
#
function GetGroup($UserId)
{
    //This function is used to check what group a user is in,this should be self explanatory
    global $conn;
    $get_group = mysqli_query($conn, "SELECT GroupId FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($get_group);
    $group_id = $result['GroupId'];
    return $group_id;
}
function GetAge($DateOfBirth)
{
    global $conn;
    // Parse Birthday Input Into Local Variables
    // Assumes Input In Form: YYYYMMDD
    $yIn = substr($DateOfBirth, 0, 4);
    $mIn = substr($DateOfBirth, 4, 2);
    $dIn = substr($DateOfBirth, 6, 2);
    // Calculate Differences Between Birthday And Now
    // By Subtracting Birthday From Current Date
    $ddiff = date("d") - $dIn;
    $mdiff = date("m") - $mIn;
    $ydiff = date("Y") - $yIn;
    // Check If Birthday Month Has Been Reached
    if ($mdiff < 0) {
        // Birthday Month Not Reached
        // Subtract 1 Year From Age
        $ydiff--;
    } elseif ($mdiff == 0) {
        // Birthday Month Currently
        // Check If BirthdayDay Passed
        if ($ddiff < 0) {
            //Birthday Not Reached
            // Subtract 1 Year From Age
            $ydiff--;
        }
    }
    return $ydiff; //Give the difference in years
}
function GetRegSession($UserId)
{
    //This function is used to pick the session id stored during logon to the system from the database,this should be self explanatory
    global $conn;
    $sql = mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $session_id = $result['Session_Id'];
    return $session_id;
}
function ParentModuleId($ModuleId)
{
    global $conn;
    //This function is used to pick up the parent id for a selected submodule,this should be self explanatory
    $sql = mysqli_query($conn, "SELECT ParentModule FROM SystemSubModules WHERE SubModuleId='$ModuleId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $ParentModuleId = $result['ParentModule'];
    return $ParentModuleId;
}
function PrevPerm($GroupId, $ModuleId)
{
    global $conn;
    //This function is used to check if a user is allowed to see a selected module
    $sql = mysqli_query($conn, "SELECT permission FROM UserPermissions WHERE GroupId='$GroupId' AND ModuleId='$ModuleId'") or die(mysqli_error($conn));
    if (mysqli_num_rows($sql) == 0) {
        return 0;
    } else {
        while ($recs = mysqli_fetch_array($sql)) {
            $permission = $recs['permission'];
            return $permission;
        }
    }
}
function PrevPermSubModule($GroupId, $ModuleId)
{
    global $conn;
    //This function is used to check if a user is allowed to see a selected submodule
    $sql = mysqli_query($conn, "SELECT permission FROM UserSubModulePermissions WHERE GroupId='$GroupId' AND ModuleId='$ModuleId'") or die(mysqli_error($conn));
    if (mysqli_num_rows($sql) == 0) {
        return 0;
    } else {
        while ($recs = mysqli_fetch_array($sql)) {
            $permission = $recs['permission'];
            return $permission;
        }
    }
}
function dteconvert($dtevar)
{
    //This function is used convert a mysql date format into a more friendly date format,specifically from yyyy-mm-dd to ddMMMM YYYYY
    //Get the date and the chunks that make up that date
    @$dtearray = explode("-", $dtevar);
    //Make up a time stamp from the date chunks
    @$dtestamp = mktime(12, 0, 0, $dtearray[1], $dtearray[2], $dtearray[0]);
    //Convert that time stamp into a date format of ur choice and desire
    @$dteconverted = date('d M Y', $dtestamp);
    //If the MySQL server returns a 0000-00-00 date and this date is fed into this function,it generates either 1970-01-01 or 1969-12-31 depending on the time stamp settings on the server.This anomaly is corrected by the following if condition
    if ($dteconverted == "01 Jan 1970" || $dteconverted == "31 Dec 1969") {
        $dtefinal = "";
    } else {
        $dtefinal = $dteconverted;
    }
    return $dtefinal;
}
function dteconvert_slash($dtevar)
{
    //This function is exactly as the one above.The only difference is this one returns a d/m/Y date format
    @$dtearray = explode("-", $dtevar);
    @$dtestamp = mktime(12, 0, 0, $dtearray[1], $dtearray[2], $dtearray[0]);
    @$dteconverted = date('d/m/Y', $dtestamp);
    if ($dteconverted == "01-01-1970" || $dteconverted == "31-12-1969") {
        $dtefinal = "";
    } else {
        $dtefinal = $dteconverted;
    }
    return $dtefinal;
}
function convert_date($date)
{
    //This function converts any date format into the MySQL date format
    //Grab the date
    $time = $date;
    //Convert the '/' to '-' if they exist
    $time_x = strtotime(str_replace("/", "-", $time));
    //The the various chunks of that date using the date() function
    $d = date('m', $time_x);
    $m = date('d', $time_x);
    $y = date('Y', $time_x);
    //Make a timestamp using the mktime() function with values from the date chunks and then feed that time stamp into the date() function to convert the timestamp tpo a date
    $dte = date('Y-m-d', mktime(12, 0, 0, date('m', $time_x), date('d', $time_x), date('Y', $time_x)));
    //Handle the 0000-00-00 date anomaly
    if ($dte == '1970-01-01' || $dte == '1969-12-31') {
        $dte = '';
    }
    return $dte;
}
function dteconvert_advanced($dtevar)
{
    $dte_details = explode(' ', $dtevar);
    @$dtearray = explode("-", $dte_details[0]);
    @$dtestamp = mktime(12, 0, 0, $dtearray[1], $dtearray[2], $dtearray[0]);
    @$dteconverted = date('d M Y', $dtestamp);
    if ($dteconverted == "01 Jan 1970" || $dteconverted == "31 Dec 1969") {
        $dtefinal = "";
    } else {
        $dtefinal = $dteconverted;
    }
    return $dtefinal . ' at ' . $dte_details[1];
}
function ReligionName($Religion)
{
    //This function gets the name of a religion based on the id supplied.It should be self explanatory
    global $conn;
    $sql = mysqli_query($conn, "SELECT ReligionName FROM Religions WHERE Id='$Religion'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['ReligionName'];
    return $name;
}
function RelationshipName($NextOfKinRelationship)
{
    //This function gets the name of a next of kin relationship based on the id supplied.It should be self explanatory
    global $conn;
    $sql = mysqli_query($conn, "SELECT RelationshipName FROM NextOfKinRelationships WHERE Id='$NextOfKinRelationship'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['RelationshipName'];
    return $name;
}
function PatNames($PatId)
{
    //This function gets the names of a patient based on the Id supplied.It should be self explanatory
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM Patients WHERE Id='$PatId'") or die(mysqli_error($conn));
    $recs = mysqli_fetch_assoc($sql);
    $Id = $recs['Id'];
    $LastName = $recs['LastName'];
    $FirstName = $recs['FirstName'];
    $result = $LastName . " " . $FirstName;
    return $result;
}
function PatientBiodata($PatId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM Patients WHERE Id='$PatId'") or die(mysqli_error($conn));
    $recs = mysqli_fetch_assoc($sql);
    $Id = $recs['Id'];
    $LastName = $recs['LastName'];
    $FirstName = $recs['FirstName'];
    $MiddleName = $recs['MiddleName'];
    $IDNo = $recs['IDNo'];
    $PassportNo = $recs['PassportNo'];
    $EpisodeNumber = $recs['CurrentEpisode'];
    $result = $LastName . ":" . $FirstName . ":" . $IDNo . ":" . $PassportNo . ":" . $EpisodeNumber . ":" . $MiddleName;
    return $result;
}
function PatientEpisode($PatId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT CurrentEpisode FROM Patients WHERE Id='$PatId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $EpisodeNumber = $result['CurrentEpisode'];
    return $EpisodeNumber;
}
function CountryName($country)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT CountryName FROM country WHERE Id='$country'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['CountryName'];
    return $name;
}
function GetUserDepartment($UserId)
{
    global $conn;
    $Sql = mysqli_query($conn, "Select EED.DepartmentId
						From DepartmentTable D, UsersTable U, EmployeeEmploymentDetailsTable EED 
						WHERE EED.DepartmentId = D.DepartmentId And EED.EmployeeId = U.EmployeeId And U.UserId = '$UserId'") or die("Could not excute query: " . mysqli_error($conn));
    $Result = mysqli_fetch_assoc($Sql);
    $Department = $Result['DepartmentId'];
    return $Department;
}
function DepartmentName($Id)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT DepartmentName FROM DepartmentTable WHERE DepartmentId='$Id'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['DepartmentName'];
    return $name;
}
function PatientTypeName($Id)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT TypeName FROM SetupPatientTypes WHERE Id='$Id'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['TypeName'];
    return $name;
}
function ResolveEmployeeId($UserId)
{
    global $conn;
    $EmployeeId = '';
    $SqlStatement = "Select EmployeeId from UsersTable Where UserId = '$UserId'";
    $ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute the query due to :" . mysqli_error($conn));
    /*Check if the query excuted succesefuly*/
    if (!$ExecSqlStatement) {
        echo("Could not excute the query");
    } else {
        $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
        $EmployeeId = $GetDetails['EmployeeId'];
    }
    return $EmployeeId;
}
function ResolveUserId($EmployeeId)
{
    global $conn;
    $SqlStatement = "Select UserId from UsersTable Where EmployeeId = '$EmployeeId'";
    $ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute the query due to :" . mysqli_error($conn));
    /*Check if the query excuted succesefuly*/
    if (!$ExecSqlStatement) {
        echo("Could not excute the query");
    } else {
        $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
        $UserId = $GetDetails['UserId'];
    }
    return $UserId;
}
function ResolveEmployeeName($UserId)
{
    global $conn;
    $EmployeeName = '';
    $EmployeeId = ResolveEmployeeId($UserId);
    $SqlStatement = "Select EmployeeName From EmployeeTable Where Id = '$EmployeeId'";
    $ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute the query due to :" . mysqli_error($conn));
    /*Check if the query excuted succesefuly*/
    if (!$ExecSqlStatement) {
        echo("Could not excute the query");
    } else {
        /*Get employee name from the result test*/
        $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
        $EmployeeName = $GetDetails['EmployeeName'];
    }
    return $EmployeeName;
}
function GetEmployeeName($EmployeeId)
{
    global $conn;
    $EmployeeName = '';
    //$EmployeeId = ResolveEmployeeId($UserId);
    $SqlStatement = "Select EmployeeName From EmployeeTable Where Id = '$EmployeeId'";
    $ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute the query due to :" . mysqli_error($conn));
    /*Check if the query excuted succesefuly*/
    if (!$ExecSqlStatement) {
        echo("Could not excute the query");
    } else {
        /*Get employee name from the result test*/
        $GetDetails = mysqli_fetch_assoc($ExecSqlStatement);
        $EmployeeName = $GetDetails['EmployeeName'];
    }
    return $EmployeeName;
}
function CheckIfDepartmentHead($UserId)
{
    global $conn;
    $IsHOD = '';
    $DepartmentId = GetUserDepartment($UserId);
    $EmployeeId = ResolveEmployeeId($UserId);
    $SqlStatement = "Select EmployeeId From EmployeePostions Where DepartmentId = '$DepartmentId' And EmployeeId = '$EmployeeId' And PostionId = 2";
    $ExecSqlStatement = mysqli_query($conn, $SqlStatement) or die("Could not excute the query due to :" . mysqli_error($conn));
    /*Check if the query excuted succesefuly*/
    if (!$ExecSqlStatement) {
        echo("Could not excute the query");
    } else {
        /*Get rows in the result set.*/
        $GetRowsInExecSqlStatement = mysqli_num_rows($ExecSqlStatement);
        if ($GetRowsInExecSqlStatement > 0) {
            $IsHOD = 1;
        } else {
            $IsHOD = 0;
        }
    }
    return $IsHOD;
}
function CheckIfCEO($UserId)
{
    global $conn;
    $EmployeeId = ResolveEmployeeId($UserId);
    $CEOId = CEOId();
    $COOId = COOId();
    $ifCEO = '';
    $sql = mysqli_query($conn, "SELECT * FROM EmployeePostions WHERE PostionId='$CEOId' OR PostionId='$COOId'") or die(mysqli_error($conn));
    while ($result = mysqli_fetch_assoc($sql)) {
        $PositionEmployeeId = $result['EmployeeId'];
        if ($PositionEmployeeId == $EmployeeId) {
            $ifCEO = 1;
        } else {
            $ifCEO = 0;
        }
    }
    return $ifCEO;
}
function CEOId()
{
    global $conn;
    $resultId = '';
    $sql = mysqli_query($conn, "SELECT * FROM SetupEmploymentPositions") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $PositionName = $recs['PostionName'];
        $Id = $recs['Id'];
        if (stristr($PositionName, "Chief Executive Officer") or stristr($PositionName, "chief executive officer")) {
            $resultId = $Id;
        }
    }
    return $resultId;
}
function COOId()
{
    global $conn;
    $resultId = '';
    $sql = mysqli_query($conn, "SELECT * FROM SetupEmploymentPositions") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $PositionName = $recs['PostionName'];
        $Id = $recs['Id'];
        if (stristr($PositionName, "Chief Operations Officer") or stristr($PositionName, "chief operations officer")) {
            $resultId = $Id;
        }
    }
    return $resultId;
}
function SanitisedIds($theSuppliers)
{
    $indvidualNumbers = explode('+', $theSuppliers);
    $CleanIds = '';
    foreach ($indvidualNumbers as $IndNum) {
        $Compare = ':' . $IndNum . ':';
        $AnotherCompare = $IndNum . ':';
        //echo "Compare-".$Compare." Clean-".$CleanIds."<br>";
        if (stristr($CleanIds, $Compare) or stristr($CleanIds, $AnotherCompare)) {
        } else {
            $CleanIds .= $IndNum . ":";
        }
        //echo $CleanIds."<br>";
    }
    //echo $CleanIds;
    return $CleanIds;
}
function HospitalDetails()
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM SetHospital WHERE Id='1'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $name = $recs['HospitalName'];
        $Address = $recs['Address'];
        $country = $recs['Country'];
        $location = $recs['PhysicalLocation'];
        $tel = $recs['Telephone'];
        $fax = $recs['Fax'];
        $web = $recs['WebSite'];
        $email = $recs['Email'];
        $logo = $recs['HospitalLogo'];
        $result = $name . ":" . $Address . ":" . $country . ":" . $location . ":" . $tel . ":" . $fax . ":" . $web . ":" . $email . ":" . $logo;
    }
    return $result;
}
function GetInsuranceGroup($Id)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT CompanyName FROM InsuranceGroups WHERE InsuranceGroupId='$Id'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['CompanyName'];
    return $name;
}
function GetInsurance($PatientIdNo)
{
    global $conn;

    $sql = mysqli_query($conn, "SELECT InsuranceName FROM PatientsAndInsurance WHERE IdNo='$PatientIdNo'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);

    $name = $result['InsuranceName'];

    return $name;
}
function GetPolicy($PatientIdNo)
{
    global $conn;

    $sql = mysqli_query($conn, "SELECT PolicyName FROM PatientsAndInsurance WHERE IdNo='$PatientIdNo'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);

    $name = $result['PolicyName'];

    return $name;
}
function GetRule($PatientIdNo)
{
    global $conn;

    $sql = mysqli_query($conn, "SELECT RuleName FROM PatientsAndInsurance WHERE IdNo='$PatientIdNo'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);

    $name = $result['RuleName'];

    return $name;
}


function GetInsuranceInfo($PatientIdNo)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM PatientsAndInsurance WHERE IdNo='$PatientIdNo'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);

    $PolicyId = $result['PolicyId'];
    $RuleId = $result['RuleId'];
    $InsuranceId = $result['InsuranceId'];
    $RuleName = $result['RuleName'];
    $PolicyName = $result['PolicyName'];
    $InsuranceName = $result['InsuranceName'];

    $ReturnResult = $InsuranceName . ":" . $InsuranceId . ":" . $RuleName . ":" . $RuleId . ":" . $PolicyName . ":" . $PolicyId;
    return $ReturnResult;
}

function PatientEpisodeId($PatientId, $EpisodeNumber)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT Id FROM PatientEpisodes WHERE PatientId='$PatientId' AND EpisodeNumber='$EpisodeNumber'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $EpisodeId = $result['Id'];
    return $EpisodeId;
}
function CaptureTransaction($SubAccountType, $DepartmentId, $TransactionType, $Description, $Amount, $Currency, $Paymode, $SourceTransactionId, $SystemGeneratedStatus, $ModuleId)
{
    global $conn;
    $TimeStamp = time();
    $sql = mysqli_query($conn, "INSERT INTO GeneralTransaction(SubAccountType,DepartmentId,DateTimeStamp,TransactionType,Description,SourceTransactionId,SystemGeneratedStatus,ModuleId,Currency,Paymode) VALUES('$SubAccountType','$DepartmentId','$TimeStamp','$TransactionType','$Description','$SourceTransactionId','$SystemGeneratedStatus','$ModuleId','$Currency','$Paymode')") or die(mysqli_error($conn));
}
function StockName($StockId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT StockName FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['StockName'];
    return $name;
}
function StockId($StockName)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT Id FROM StockTable WHERE StockName='$StockName'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $Id = $result['Id'];
    return $Id;
}
function StockCategory($StockId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT CatId FROM StockTable WHERE Id='$StockId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $CatId = $result['CatId'];
    return $CatId;
}
function PackagingInfo($Packaging)
{
    global $conn;
    $strSQL = "SELECT PackagingId FROM StockPackaging WHERE Id='$Packaging'";
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $PackagingTypeId = $result['PackagingId'];
    $PackageName = PackageName($PackagingTypeId);
    return $PackageName;
}
function ModuleName($ModuleId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT ModuleName FROM SystemModules WHERE ModuleId='$ModuleId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['ModuleName'];
    return $name;
}
function CurrencyCode($Currency)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT Code FROM CurrencyDetails WHERE Id='$Currency'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $Code = $result['Code'];
    return $Code;
}
function CurrencyValue($Currency)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT Rate FROM CurrencyDetails WHERE Id='$Currency'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $Rate = $result['Rate'];
    return $Rate;
}
function InsertIntoChargeSheet($ChargeId, $DepartmentId, $Particulars, $EpisodeNo, $Cost, $qty, $Amount, $PatientId, $Date, $UserId, $Currency, $Service)
{
    global $conn;
    $sql = mysqli_query($conn, "INSERT INTO PatientChargeSheet(DepartmentId,ParticularsId,EpisodeNo,Cost,Quantity,Amount,PatientId,Date,UserId,Currency,Type) VALUES('$DepartmentId','$ChargeId','$EpisodeNo','$Cost','$qty','$Amount','$PatientId','$Date','$UserId','$Currency','$Service')") or die(mysqli_error($conn));
    if ($sql == 1) {
        $sql = mysqli_query($conn, "DELETE FROM PatientChargeSheetTemp WHERE Id='$ChargeId'") or die(mysqli_error($conn));
    }
}
function ChargeSheetDetails($Charge)
{
    
    global $conn;
    if (stristr($Charge, 'Patient Registration')) {
        $sql = mysqli_query($conn, "SELECT * FROM HospitalServices WHERE ServiceName='Patient Registration' AND Status='Active' AND ApprovalStatus='1'") or die(mysqli_error($conn));
    }
    $result = mysqli_fetch_assoc($sql);
    $ChargeId = $result['ServiceId'];
    $ChargeName = $result['ServiceName'];
    $Amount = $result['Amount'];
    $Currency = $result['CurrencyId'];
    return $ChargeId . ':' . $ChargeName . ':' . $Amount . ':' . $Currency;
}
function GetFinancialPeriod()
{
    global $conn;
    $dte = date('F-Y', time());
    // echo $dte;
    $sql = mysqli_query($conn, "SELECT * FROM FinancialMonths WHERE FinancialMonth LIKE '%$dte%'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $Id = $result['YearId'];
    return $Id;
}
function FetchTotalChartAmt($AccountId, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod)
{
    global $conn;
    $TheKids = '';
    $sql = mysqli_query($conn, "SELECT * FROM ChartOfAccounts WHERE ParentChartAccount='$AccountId'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $id = $recs['Id'];
        $GrandKids = ChartAccountGrandKids($id);
        $TheKids .= $id . ':';
        if ($GrandKids != '') {
            $TheGrandKids = explode(':', $GrandKids);
            foreach ($TheGrandKids as $TheKid) {
                if ($TheKid != '') {
                    $TheKids .= $TheKid . ':';
                    $GreatGrandKids = ChartAccountGrandKids($TheKid);
                    $GreatGrandKidsDetails = explode(':', $GreatGrandKids);
                    foreach ($GreatGrandKidsDetails as $GreatGrandKid) {
                        if ($GreatGrandKid != '') {
                            $TheKids .= $GreatGrandKid . ':';
                        }
                    }
                }
            }
        }
    }
    $FinalChartIds = $AccountId . ':' . $TheKids;
    $GetActualChartAmount = GetActualChartAmount($FinalChartIds, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod);
    return number_format($GetActualChartAmount, 2);
}
function ChartAccountGrandKids($id)
{
    global $conn;
    $Charts = '';
    $sql = mysqli_query($conn, "SELECT * FROM ChartOfAccounts WHERE ParentChartAccount='$id'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $id = $recs['Id'];
        $Charts .= $id . ':';
    }
    return $Charts;
}
function GetActualChartAmount($FinalChartIds, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod)
{
    global $conn;
    $sqlAmt="";
    $ChartIds = explode(':', $FinalChartIds);
    $TotalChartAmt = 0;
    foreach ($ChartIds as $ChartId) {
        if ($ChartId != '') {
            if ($ChartFinancialPeriod == '') {
                $sqlAmt = mysqli_query($conn, "SELECT * FROM GeneralTransactions WHERE ChartAccountId='$ChartId' AND FinancialYear='$ChartFinancialYear'") or die(mysqli_error($conn));
            } else {
                $sqlAmt = mysqli_query($conn, "SELECT * FROM GeneralTransactions WHERE ChartAccountId='$ChartId' AND FinancialYear='$ChartFinancialYear' AND FinancialPeriod='$ChartFinancialPeriod'") or die(mysqli_error($conn));
            }
            while ($recs = mysqli_fetch_array($conn, $sqlAmt)) {
                $Amount = $recs['Amount'];
                $Currency = $recs['Currency'];
                $RealAmt = $Amount * $Currency;
                $ShowChartAmt = $RealAmt * CurrencyValue($ChartCurrency);
                $JournalAccountStatus = $recs['JournalAccountStatus'];
                if ($JournalAccountStatus == 1) {
                    $TotalChartAmt -= $ShowChartAmt;
                } else {
                    $TotalChartAmt += $ShowChartAmt;
                }
            }
        }
    }
    return $TotalChartAmt;
}
function FinancialYearName($YearId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM FinancialYears WHERE Id='$YearId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_array($sql);
    $StartDate = $result['StartDate'];
    $EndDate = $result['EndDate'];
    $result = dteconvert($StartDate) . ' - ' . dteconvert($EndDate);
    return $result;
}
function FinancialPeriodName($MonthId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM FinancialMonths WHERE Id='$MonthId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_array($sql);
    $FinancialMonth = $result['FinancialMonth'];
    $result = $FinancialMonth;
    return $result;
}
function FetchChartAccounts($Id, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM  ChartOfAccounts WHERE ParentChartAccount='$Id'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $AccountId = $recs['Id'];
        $AccountName = $recs['AccountName']; ?>
		<li><a href="#" onmousedown="ShowAccounts(<?php echo $AccountId; ?>,1)" ondblclick="LoadChartSubMenu('<?php echo $AccountId; ?>',event)" style="text-decoration:none;color:#990000;"><?php echo $AccountName; ?></a>
			<div id="ChartAmtTotal<?php echo $Id; ?>" style="margin:-18px; background-color:#E2FFE9; border:solid 1px #0000FF; float:right; width:100px; left:450px;width:130px;"><?php echo  CurrencyCode($ChartCurrency) . " " . FetchTotalChartAmt($AccountId, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod); ?></div>
			<ul><?php echo  FetchChartAccounts($AccountId, $ChartCurrency, $ChartFinancialYear, $ChartFinancialPeriod); ?></ul>
		</li>
	<?php
    }
}
function FetchChartSubAccounts($AccountTypeId, $AccountId)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM  FinancialSubAccounts WHERE ParentAccount='$AccountId'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $SubAccountId = $recs['Id'];
        $AccountName = $recs['SubAccountName']; ?>
		<li><a href="#" onclick="LoadChartOfAccountsDetails('<?php echo $AccountTypeId; ?>','<?php echo $AccountId; ?>','<?php echo $SubAccountId; ?>')"><?php echo $AccountName; ?></a> </li>
<?php
    }
}
function CheckQtyInStore($StockId)
{
    global $conn;
    $CumulativeStockInStore = 0;
    //echo "SELECT * FROM StockMovementTable WHERE StockId='$StockId' AND  ToDept='19'";
    $sql = mysqli_query($conn, "SELECT * FROM StockMovementTable WHERE StockId='$StockId' AND  ToDept='19'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_array($sql)) {
        $QtyIn = $recs['QtyIn'];
        $Packaging = $recs['Packaging'];
        $ActualStockQty = QtyInPackaging($StockId, $Packaging);
        $CumulativeStockInStore += ($ActualStockQty * $QtyIn);
    }
    return $CumulativeStockInStore;
}
function CheckQtyInDept($StockItem, $DeptId)
{
    global $conn;
    $CumulativeQty = 0;
    // echo "SELECT * FROM DepartmentStock WHERE StockId='$StockItem' AND ToDept='$DeptId'";
    $sql = mysqli_query($conn, "SELECT * FROM DepartmentStock WHERE StockId='$StockItem' AND ToDept='$DeptId'") or die(mysqli_error($conn));
    while ($recs = mysqli_fetch_assoc($sql)) {
        $QtyIn = $recs['StockQtyIn'];
        $Packaging = $recs['Packaging'];
        $ActualQty = QtyInPackaging($StockItem, $Packaging);
        $CumulativeQty += ($ActualQty * $QtyIn);
    }
    return $CumulativeQty;
}
function QtyInPackaging($StockItem, $ThePackage)
{
    global $conn;
    $strSQL = "SELECT Qty FROM StockPackaging WHERE StockId='$StockItem' AND Id='$ThePackage'";
    // $strSQL;
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    //echo $result['Price']."<br>";
    return $result['Qty'];
}
function ItemEndSalesUnit($StockItem)
{
    global $conn;
    $sqlEndSales = mysqli_query($conn, "SELECT Id FROM PackageType WHERE PackageType LIKE '%End Sales Packaging%'") or die(mysqli_error($conn));
    $resultEndSales = mysqli_fetch_assoc($sqlEndSales);
    $PackageEndSales = $resultEndSales['Id'];
    $strSQL = "SELECT PackagingId FROM StockPackaging WHERE StockId='$StockItem' AND PackageTypeId='$PackageEndSales'";
    // $strSQL;
    $sql = mysqli_query($conn, $strSQL) or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $PackagingId = $result['PackagingId'];
    return PackageName($PackagingId);
    //echo $result['Price']."<br>";
}/**/
function PackageName($PackagingId)
{
    global $conn;
    //echo "SELECT PackageName FROM SetupPackaging WHERE Id='$PackagingId'";
    $sql = mysqli_query($conn, "SELECT PackageName FROM SetupPackaging WHERE Id='$PackagingId'") or die(mysqli_error($conn));
    $result = mysqli_fetch_assoc($sql);
    $name = $result['PackageName'];
    return $name . 's';
}
?>