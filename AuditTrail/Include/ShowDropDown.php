<?php
 $Table=htmlentities($_REQUEST['TableName']);
require_once '../../Main/Config/db_conn.php';

?>
<select class="form-control" name="Field" id="Field">
 <?php
           echo "<option class='form-control' size =30 selected> - Select - </option>";
        if ($Table !='') {
            $GetFieldName = "Select Distinct FieldName From AuditTable Where TableName='$Table'";
            $sql_Field = mysqli_query($conn, $GetFieldName) or die(mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($sql_Field)) {
                echo "<option class='form-control'>$row[FieldName]</option>";
            }
        } else {
             $GetFieldName = "Select Distinct FieldName From AuditTable";
             $sql_Field = mysqli_query($conn, $GetFieldName) or die(mysqli_error($conn));
             while ($row = mysqli_fetch_assoc($sql_Field)) {
                 echo "<option class='form-control'>$row[FieldName]</option>";
             }
         }
        ?>
</select>