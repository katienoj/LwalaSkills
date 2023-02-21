<?php
// @katienoj Include all needed files
require_once '../../Main/Config/db_conn.php';
include '../Include/AuditTrailFunc.php';
global $conn;
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<!--include the necessary css to format page-->
<style type="text/css">
	.style1 {
		color: #FF0000
	}
</style>
<table width="100%" class="bordercolor2" border="0" bgcolor="#E4E4E4" id="service_table">
	<thead>
		<tr>
			<th class="heading" width="12%">Table Name</th>
			<th class="heading" width="11%">Field Name</th>
			<th class="heading" width="16%">Old Value</th>
			<th class="heading" width="14%">New Value</th>
			<th class="heading" width="6%">Action</th>
			<th class="heading" width="9%">Date Modified</th>
			<th class="heading" width="9%">Time Modified</th>
			<th class="heading" width="23%">User Name</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th class="heading" width="12%">Table Name</th>
			<th class="heading" width="11%">Field Name</th>
			<th class="heading" width="16%">Old Value</th>
			<th class="heading" width="14%">New Value</th>
			<th class="heading" width="6%">Action</th>
			<th class="heading" width="9%">Date Modified</th>
			<th class="heading" width="9%">Time Modified</th>
			<th class="heading" width="23%">User Name</th>
		</tr>
	</tfoot>
	<tbody>
		<?php
        //get all fields to display on the audit trail
        $Res = "SELECT Distinct AuditTable.Id, AuditTable.TableName, AuditTable.FieldName, AuditTable.OldValue, AuditTable.NewValue, AuditTrans.Action, AuditTrans.date, AuditTrans.time, AuditSsn.UserId, AuditSsn.LoginDate, AuditSsn.LoginTime, AuditSsn.IpAddress, AuditSsn.LogoutDate, AuditSsn.LogoutTime
			FROM `AuditTable`
			INNER JOIN AuditTrans ON AuditTrans.TranSeqNo = AuditTable.TranSeqNo AND AuditTrans.SessionId=AuditTable.SessionId		
			INNER JOIN AuditSsn ON AuditSsn.SessionId = AuditTable.SessionId ORDER BY AuditTable.Id DESC Limit 0,50";
        $ExecRes = mysqli_query($conn, $Res) or die(mysqli_error($conn)); //Execute the SQL query
        $GetAuditTrailRows = mysqli_num_rows($ExecRes); // Check if there is any rows results returned based on the execution
        if ($GetAuditTrailRows > 0) { 	// If Execution returned anything, i.e. number of rows is greater than zero
            $count = 0;
            while ($Row = mysqli_fetch_array($ExecRes)) {
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
        } else {
            echo('There are no records to display.'); //If query required no results, inform user
        }
        ?>
	</tbody>
</table>