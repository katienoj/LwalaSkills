<?
session_start();
include "../../Main/Config/db_conn.php";
$SelectedQuotes=$_REQUEST['SelectedQuotes'];


@$UserId=$_SESSION['UserId'];
@$EmployeeId=$_SESSION['EmployeeId'];
@$UserNames=$_SESSION['UserName'];
$sql=mysqli_query($conn, "SELECT Session_Id FROM UsersTable WHERE UserId='$UserId'") or die(mysqli_error($conn));
$result=mysqli_fetch_assoc($sql);
$SessionId=$result['Session_Id'];
//echo "New ".$SessionId."<br>Old".session_id();
if($SessionId != session_id() or $SessionId=='')
{
   echo "reload";
}
else
{
//echo $page_name;
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">


<table class="SearchTop" width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#E8EAEC">
  <tr>
    <td valign="top" class="SearchTop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Print Preview</td>
    <td valign="top" class="SearchTop"><input class="btn btn-warning" type="button" value="Print" onClick="printDoc('print_doc');"></td>
    <td align="right" valign="top" class="SearchTop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closepopupdiv()" style="cursor:hand" /> </td>
  </tr>
  <tr>
    <td colspan="3">
      <div id="ShowPrintable" style="height:550px; max-height:550px; overflow-x:hidden; overflow-y:auto;">
        <!--style="border:solid 1px #D0D0D0;"-->
        <?php

        $pageName = 'Application/QuotationRequestPrint.php?SelectedQuotes=' . $SelectedQuotes;
        ?>
        <iframe name="print_doc" id="print_doc" src="<?php echo $pageName; ?>" scrolling="auto" frameborder="0" style="width:800px; height:500px; display:block; background-color:#FAFAFA;"> </iframe>
        <?

}
?>
      </div>
    </td>
  </tr>
</table>