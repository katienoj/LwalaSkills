<?php
//	Include all relevant files
require_once '../../Main/Config/db_conn.php';
include '../Include/AuditTrailFunc.php';
global $conn;
//	Fetch search field data and remove any html characters
@$UserName = htmlentities($_REQUEST['UserName']);
@$FromDate = htmlentities($_REQUEST['FromDate']);
@$ToDate = htmlentities($_REQUEST['ToDate']);
@$search_parts = "";
$Sql = "";
$counter = 0;
$ConvFromDate = convert_date($FromDate);
$ConvToDate = convert_date($ToDate);
if ($UserName == '' && $FromDate == '' && $ToDate == '') {
    $res = "SELECT * FROM `AuditLogonErrors";
    //	if all search fields are empty Select all records from AuditLogon errors" ;
    $Sql = $res;
} else { //	If any of the search fields contain any search data ....Start searching using the data
    $res = "SELECT * FROM `AuditLogonErrors`";
    if ($UserName != '') { //If username is has data
        if ($counter == 0) { //and all other search fields are empty
            $search_parts = " WHERE AuditLogonErrors.UserId LIKE '%$UserName%'"; //search only where username is the same as the
        }																	   //username search data
        else { //if there is another field which has search data
            $search_parts .= " AND AuditLogonErrors.UserId LIKE '%$UserName%'"; //Search where surname and the other search
        }																	  //parameters are true
        $counter++;
    }
    if ($FromDate != '' && $ToDate != '') { //If From Date and End Date are not null
        if ($counter == 0) { //and there are no other search fields with data, Search logon errors which fall between the 2 dates
            $search_parts = " WHERE AuditLogonErrors.DateAccessed >='$ConvFromDate' AND  AuditLogonErrors.DateAccessed <='$ConvToDate'";
        } else { //If there are other search fields with data, get logon errors which fall been the start date and end date and they
         //match with the other defined search field
            $search_parts .= " AND AuditLogonErrors.DateAccessed >='$ConvFromDate' AND  AuditLogonErrors.DateAccessed <='$ConvToDate'";
        }
        $counter++;
    }
    if ($FromDate != '' && $ToDate == '') { //If From Date is not null and End Date is null
        if ($counter == 0) { //and there are no other search fields with data, Search logon errors which fall under start date
            $search_parts = " WHERE AuditLogonErrors.DateAccessed LIKE '%$ConvFromDate%'";
        } else { //if there are other search fields with data, combine the search parameter withe start date
            $search_parts .= " AND AuditLogonErrors.DateAccessed '%$ConvFromDate%'";
        }
        $counter++;
    }
    if ($FromDate == '' && $ToDate != '') { //If From Date is null and End Date is  not null
        if ($counter == 0) { //and there are no other search fields with data, Search logon errors which fall under End date
            $search_parts = " WHERE AuditLogonErrors.DateAccessed LIKE '%$ConvToDate%'";
        } else {
            $search_parts .= " AND AuditLogonErrors.DateAccessed LIKE '%$ConvToDate%'";
        }
        $counter++;
    }
    $Sql = $res . "" . $search_parts; //Combines the sql and the search parameters to form a query
}
$result = mysqli_query($conn, $Sql) or die(mysqli_error($conn));  //Execute the formed query
$GetLogRows = mysqli_num_rows($result); //Checks the number of rows returned to determine if the query had any result
if ($GetLogRows > 0) { //if rows returned is greater than zero, display results into a table.
    //Create table to display query results
    echo("<table class=table width=110%>
	<thead>
	<tr>		
			<td class=heading>User Name</td>
			<td class=heading>Ip Address</td>
			<td class=heading>Date</td>
			<td class=heading>Time</td>
		</tr>
		</thead>
		<tbody style='overflow-y:auto; overflow-x:hidden;height:740px; max-height:740px; overflow-x:hidden; overflow-y:auto;'>");
    while ($row = mysqli_fetch_array($result)) {
        echo('<tr>		
				  <td>' . $row['UserId'] . '</td>
				  <td>' . $row['IpAddress'] . '</td>
				  <td>' . $row['DateAccessed'] . '</td>
				  <td>' . $row['TimeAccessed'] . '</td>
				</tr>');
    }
    echo('</tbody></table>');
}
