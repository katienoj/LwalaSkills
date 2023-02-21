<?php
//Include relevant file, to make connection to database
require_once '../../Main/Config/db_conn.php';

//Get all the logon errors which have been generated in the system
$LogRes = "SELECT * FROM `AuditLogonErrors`  ORDER BY AuditLogonErrors.Id DESC";
$ExecLogRes = mysqli_query($conn, $LogRes) or die(mysqli_error($conn)); //Execute query
$GetLogRows = mysqli_num_rows($ExecLogRes); // get number of rows, to determine if the query returned any results
if ($GetLogRows > 0) { //if row is greater than zero, meaning query has results, populate display table.
    //Create table to display query results
    echo("<table class=table width=110% id='service_table'>
	<thead>
	<tr>		
			<th class=heading>User Name</th>
			<th class=heading>Ip Address</th>
			<th class=heading>Date</th>
			<th class=heading>Time</th>
		</tr>
		</thead>
			<tfoot>
	<tr>		
			<th class=heading>User Name</th>
			<th class=heading>Ip Address</th>
			<th class=heading>Date</th>
			<th class=heading>Time</th>
		</tr>
		</tfoot>
		<tbody style='overflow-y:auto; overflow-x:hidden;height:740px; max-height:740px; overflow-x:hidden; overflow-y:auto;'>");
    while ($row = mysqli_fetch_array($ExecLogRes)) {
        echo('<tr>		
				  <td>' . $row['UserId'] . '</td>
				  <td>' . $row['IpAddress'] . '</td>
				  <td>' . $row['DateAccessed'] . '</td>
				  <td>' . $row['TimeAccessed'] . '</td>
				</tr>');
    }
    echo('</tbody></table>');
}
