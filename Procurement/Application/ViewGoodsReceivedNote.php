<?
require_once '../../Main/Config/db_conn.php';
$DeliveryNote=$_REQUEST['ServiceId'];
$pageName='Application/PrintGoodsReceivedNote.php?DeliveryNote='.$DeliveryNote;


//echo $page_name;
?>
<link href="../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">


<table class="SearchTop" width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#E8EAEC">
  <tr>
    <td valign="top" class="SearchTop">Print Preview</td>
    <td valign="top" class="SearchTop"><a href="javascript:void(0)" class="SearchTop" onClick="printDoc('print_doc');">Print</a></td>
    <td align="right" valign="top" class="SearchTop"><img src="../Main/Layout/images/close.png" width="20" height="20" align="right" onclick="closeprintdiv()" style="cursor:hand" /> </td>
  </tr>
</table>

<!--style="border:solid 1px #D0D0D0;"-->


<iframe name="print_doc" id="print_doc" src="<?php echo $pageName; ?>" scrolling="auto" frameborder="0" style="width:800px; height:400px; display:block; background-color:#FAFAFA;"> </iframe>