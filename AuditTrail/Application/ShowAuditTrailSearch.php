<?php
require_once '../../Main/Config/db_conn.php';
include '../Include/AuditTrailFunc.php';
global $conn;
//Includes all the necessary files for database connection and also functions required
?>
<table width="100%">
  <tr>
    <td height="31" valign="top">Action</td>
    <td valign="top"><select class="form-control" id="AuditAction" name="AuditAction">
        <?php
        echo "<option class='form-control' size =30 selected> - Select - </option>";
        //Selects Action Name from the Audit Transaction Table and populates a dropdown menu
        $GetAction = "Select Distinct Action From AuditTrans";
        $sql_result = mysqli_query($conn, $GetAction) or die(mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($sql_result)) {
            echo "<option>$row[Action]</option>";
        }
        ?>
      </select></td>
    <td valign="top">Table Affected </td>
    <td valign="top"><select class="form-control" id="Table" name="Table" onchange="GetFieldName()">
        <!-- On selecting a menu it calls the GetFieldName function in order to populate the field names based on the table selected-->
        <?php
        echo "<option class='form-control' size =30 selected> - Select - </option>";
        //Selects Table Name from the Audit Table and populates a dropdown menu
        $GetTableName = "Select Distinct TableName From AuditTable";
        $sql_result = mysqli_query($conn, $GetTableName) or die(mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($sql_result)) {
            echo "<option class='form-control' value='$row[TableName]'>$row[TableName]</option>";
        }
        ?>
      </select> </td>
    <td valign="top">Field Modified </td>
    <td valign="top">
      <div id="show_my_fields"><?php echo ShowDefaultFields(); ?></div>
    </td>
  </tr>
  <tr>
    <td height="31" valign="top">Start Date </td>
    <td><input class="form-control" name="FromDate" type="text" id="FromDate" size="20" onclick='scwShow(this,event);' /></td>
    <td height="31" valign="top">End Date </td>
    <td> <input class="form-control" name="ToDate" type="text" id="ToDate" size="20" onclick='scwShow(this,event);' /></td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td><input class="btn btn-warning" type="button" id="SubmitSearch" name="SubmitSearch" value="   Search  " onclick="DisplayAuditTrailSearch()" /><!-- On Clicking the Search Button, it calls the AuditTrail Search function which fetches the parameters to form the audit trail search-->
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>