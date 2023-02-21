<?php

$text = $_REQUEST["text"];
$format = $_REQUEST["format"];
$quality = $_REQUEST["quality"];
$width = $_REQUEST["width"];
$height = $_REQUEST["height"];
$type = $_REQUEST["type"];
$barcode = $_REQUEST["barcode"];

// $page_name="qrcode.php?text=".$text."&format=".$format."&quality=".$quality."&width=".$width."&height=".$type."&barcode=".$barcode;
global $conn;
?>

<!--<link href="styles/interface.css" rel="stylesheet" type="text/css" />
<div class="drsMoveHandle">
<table  class="formtop" width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td valign="top" class="formheading">Print Preview</td>
    <td valign="top" class="formheading"><a href="javascript:void(0)" onClick="printDoc('print_doc');" >Print</a></td>
    <td align="right" valign="top" class="formheading"><input name="close" type="image" id="close" src="images/structure/close.png" onClick="close_receipt_div()" />	</td>
  </tr>
</table>
</div>-->
<!--style="border:solid 1px #D0D0D0;"-->

<iframe name="print_doc" id="print_doc" src="<?php echo '<img src="qrcode.php" />'; ?>" scrolling="auto" frameborder="0" style="width:800px; height:400px; display:block; background-color:#FAFAFA;"> </iframe>