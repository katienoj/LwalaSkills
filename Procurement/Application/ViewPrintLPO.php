<?
require_once '../../Main/Config/db_conn.php';
$SelectedLPOs=$_REQUEST['SelectedLPOs'];
$pageName='Application/PrintLPO.php?SelectedLPOs='.$SelectedLPOs;


//echo $page_name;
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">


<table class="SearchTop" width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#E8EAEC">
  <tr>
    <td valign="top" class="SearchTop" onMouseDown="javascript:getReadyToMove('popup_div', event);" onMouseUp="javascript:dropLoadedObject(event)" onClick="javascript:dropLoadedObject(event);">Print Preview</td>
    <td valign="top" class="SearchTop"><input class="btn btn-warning" type="Button" value="Print" onClick="printDoc('print_doc');" /></td>
    <td align="right" valign="top" class="SearchTop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closeprintdiv()" style="cursor:hand" /> </td>
  </tr>
</table>

<!--style="border:solid 1px #D0D0D0;"-->


<iframe name="print_doc" id="print_doc" src="<?php echo $pageName; ?>" scrolling="auto" frameborder="0" style="width:800px; height:400px; display:block; background-color:#FAFAFA;" OnmouseOver="javascript:dropLoadedObject(event)"> </iframe>