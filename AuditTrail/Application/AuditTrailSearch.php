<?php
require_once '../../Main/Config/db_conn.php';
include '../Include/AuditTrailFunc.php';
//Receive search variables from the search form and strip any html characters
global $conn;
@$AuditAction = htmlentities($_REQUEST['ActionValue']);
@$Table = htmlentities($_REQUEST['TableName']);
@$Field = htmlentities($_REQUEST['FieldValue']);
@$FromDate = htmlentities($_REQUEST['FromDate']);
@$ToDate = htmlentities($_REQUEST['ToDate']);
@$UserId = "";
@$search_parts = "";
$Sql = "";
$counter = 0;
$ConvFromDate = convert_date($FromDate);
$ConvToDate = convert_date($ToDate);
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<!--include the necessary css to format page-->
<style type="text/css">
	.style1 {
		color: #FF0000
	}
</style>
<table width="100%" class="bordercolor2" border="0" bgcolor="#E4E4E4">
	<tr>
		<td class="heading" width=16%>Table Name</td>
		<td class="heading" width=12%>Field Name</td>
		<td class="heading" width=15%>Old Value</td>
		<td class="heading" width=15%>New Value</td>
		<td class="heading" width=10%>Action</td>
		<td class="heading" width=13%>Date Modified</td>
		<td class="heading" width=12%>Time Modified</td>
		<td class="heading" width=20%>User Name</td>
	</tr>
	<?php
    if ($AuditAction == '' && $Table == '' && $Field == '' && $FromDate == '' && $ToDate == '' && $UserId == '') { //If all the search fields are empty, Select everything from the Audit Table and it joins the relevant tables to get the audit trail details
        $res = "SELECT AuditTable.Id, AuditTable.TableName, AuditTable.FieldName, AuditTable.OldValue, AuditTable.NewValue, AuditTrans.Action, AuditTrans.date, AuditTrans.time, AuditSsn.UserId, AuditSsn.LoginDate, AuditSsn.LoginTime, AuditSsn.IpAddress, AuditSsn.LogoutDate, AuditSsn.LogoutTime
		FROM `AuditTable`
		INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId		
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId ORDER BY AuditTable.Id DESC Limit 0,50";
        $Sql = $res;
    } else { //Meaning one of the search field has a value, search using that value.
        $res = "SELECT AuditTable.Id, AuditTable.TableName, AuditTable.FieldName, AuditTable.OldValue, AuditTable.NewValue, AuditTrans.Action, AuditTrans.date, AuditTrans.time, AuditSsn.UserId, AuditSsn.LoginDate, AuditSsn.LoginTime, AuditSsn.IpAddress, AuditSsn.LogoutDate, AuditSsn.LogoutTime
		FROM `AuditTable`";
        if ($AuditAction != '') {		//If AuditAction is not null
            if ($counter == 0) {	 //And there is no other search field that has been used before, select from audit trail where AuditAction corresponds to the value in the Audit Action field.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId		
 		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTrans.Action LIKE '%$AuditAction%'";
            } else {		//If there exists another search field(s) being used for the search and it precedes Audit action, then combine the AuditAction Value with the existing search value(s) to select from audit where the match exists.
                $search_parts .= " AND AuditTrans.Action LIKE '%$AuditAction%'";
            }
            $counter++;
        }
        if ($Table != '') {	//If Table is not null
            if ($counter == 0) { //And there is no other search field that has been used before, select from audit where records match to the Table search value.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId	
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTable.TableName LIKE '%$Table%'";
            } else {	//If there exists another search field(s) being used for the search and it precedes Table, then combine the Table Value with the existing search value(s) to select from audit where the match exists.
                $search_parts .= " AND AuditTable.TableName LIKE '%$Table%'";
            }
            $counter++;
        }
        if ($Field != '') {	//If Field is not null
            if ($counter == 0) {	//And there is no other search field that has been used before, select from audit where records match to the Field search value.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId	
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTable.FieldName LIKE '%$Field%'";
            } else {	//If there exists another search field(s) being used for the search and it precedes Field, then combine the Field Value with the existing search value(s) to select from audit where the match exists.
                $search_parts .= " AND AuditTable.FieldName LIKE '%$Field%'";
            }
            $counter++;
        }
        if ($UserId != '') {	 //If UserId is not null
            if ($counter == 0) {	//And there is no other search field that has been used before, select from audit where records match to the UserId search value.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId	
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditSsn.UserId LIKE '%$UserId%'";
            } else {	//If there exists another search field(s) being used for the search and it precedes UserId, then combine the UserId Value with the existing search value(s) to select from audit where the match exists.
                $search_parts .= " AND AuditSsn.UserId LIKE '%$UserId%'";
            }
            $counter++;
        }
        if ($FromDate != '' && $ToDate != '') {	//If Start Date and End Date are not Null
            if ($counter == 0) {	//And there are no other search field that have been used before, Select all Audit Trail records which were modified between the Start and End dates.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTrans.date >='$ConvFromDate' AND  AuditTrans.date <='$ConvToDate'";
            } else {	//If there exists another search field(s) being used for the search, Select all the records that fall under the start and end date and also match the other search criteria
                $search_parts .= " AND AuditTrans.date >='$ConvFromDate' AND  AuditTrans.date <='$ConvToDate'";
            }
            $counter++;
        }
        if ($FromDate != '' && $ToDate == '') {	//If Start Date is not null
            if ($counter == 0) { //If no other search field which has values select from audit trail where record date modified is the same as the Start date.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTrans.date LIKE '%$ConvFromDate%'";
            } else {	//If there exists some search field which have values select from audit trail where record date modified is the same as the Start date and also matches the other search selection parameters.
                $search_parts .= " AND AuditTrans.date LIKE '%$ConvFromDate%'";
            }
            $counter++;
        }
        if ($FromDate == '' && $ToDate != '') {		 //If End Date is not null
            if ($counter == 0) {	//If no other search field which has values select from audit trail where record date modified is the same as the End date.
                $search_parts = "INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId
		INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId WHERE AuditTrans.date LIKE '%$ConvToDate%'";
            } else {		//If there exists some search field which have values select from audit trail where record date modified is the same as the End date and also matches the other search selection parameters.
                $search_parts .= " AND AuditTrans.date LIKE '%$ConvToDate%'";
            }
            $counter++;
        }
        $Sql = $res . "" . $search_parts;		//Form the Sql query
    }
    $result = mysqli_query($conn, $Sql) or die(mysqli_error($conn)); 		//Execute the SQL query
    $GetATSearchRows = mysqli_num_rows($result);	// Check if there is any rows results returned based on the execution
    if ($GetATSearchRows > 0) {	// If Execution returned anything, i.e. number of rows is greater than zero
        if ($GetATSearchRows > 0) { 	// If Execution returned anything, i.e. number of rows is greater than zero
            $count = 0;
            while ($Row = mysqli_fetch_array($result)) {
                $TableName = htmlentities($Row['TableName']);   // Fetch the query results and strip off any html characters
                $FieldName = htmlentities($Row['FieldName']);
                $OldValue = htmlentities($Row['OldValue']);
                $NewValue = htmlentities($Row['NewValue']);
                $Action = htmlentities($Row['Action']);
                $DateValue = htmlentities($Row['date']);
                $TimeValue = htmlentities($Row['time']);
                $UserId = htmlentities($Row['UserId']);
                if ($count % 2 == 0) {
                    $bg = '#E1E1FF';
                } else {
                    $bg = '#EAEAEA';
                } ?>
			<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
				<td valign="top"><?php echo $TableName; ?></td>
				<td valign="top"><?php echo $FieldName; ?></td>
				<td valign="top"><?php echo $OldValue; ?></td>
				<td valign="top"><?php echo $NewValue; ?></td>
				<td valign="top"><?php echo $Action; ?></td>
				<td valign="top"><?php echo dteconvert($DateValue); ?></td>
				<td valign="top"><?php echo $TimeValue; ?></td>
				<td valign="top"><?php echo GetUserIdName($UserId); ?></td>
				<!--Display the fetched records in a grid-->
			</tr>
	<?php
                $count++;
            }
        }
    }
    ?>