<?php
require_once '../../../Main/Config/db_conn.php';
require_once '../../../Stock/includes/StockFunctions.php';
?>
<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" class="bordercolor2" style="background-image:url(../Main/Layout/images/form_top.jpg); background-repeat:repeat-x;">
	<tr>
		<td width="100%" align="center" height="33" class="formtop">PHARMACY INVENTORY</td>
	</tr>
</table>
<table width="100%" border="0">
  <?php
  $sql = "SELECT * FROM StockTable WHERE del=0 ORDER BY StockName ASC";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  //display product fields in list
  //echo mysqli_num_rows($result);
  if (mysqli_num_rows($result) == 0) {
      ?>
    <tr>
      <td  colspan="7">There are currently no registered Stock</td>
    </tr>
  <?php
  } else {
      ?>
</table>
<table width="100%" id="pharmacystock">
  <thead>
    <tr>
      <th ><input type="checkbox" name="CheckStock" id="CheckStock" onclick="CheckStock()" /></th>
      <th >Item Id</th>
      <th >Item Name </th>
      <th >Sub Category</th>
      <th >Price </th>
      <th >Expiry Date</th>
      <th >Available Stock</th>
      <th >Packaging</th>
      <th >Alternative</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th ><input type="checkbox" name="CheckStock" id="CheckStock" onclick="CheckStock()" /></th>
      <th >Item Id</th>
      <th >Item Name </th>
      <th >Sub Category</th>
      <th >Price </th>
      <th >Expiry Date</th>
      <th >Available Stock</th>
      <th >Packaging</th>
      <th >Alternative</th>
    </tr>
  </tfoot>
  <tbody>
    <?php
    $count = 0;
      while ($recs = mysqli_fetch_array($result)) {
          $Id = $recs['Id'];
          $UnitId = $recs['UnitId'];
          $MaxStock = $recs['MaxStock'];
          $MinReorder = $recs['MinReorder'];
          $MaxReorder = $recs['MaxReorder'];
          $OpeningStock = $recs['OpeningStock'];
          $StockPrice = $recs['StockPrice'];
          $Barcode = $recs['Barcode'];
          $CostPrice = $recs['INV_COSTPRICE'];
          $RetailPrice = $recs['INV_RETAILPRICE'];
          $TradePrice = $recs['INV_TRADEPRICE'];
          $PackQuantity = $recs['PACK_QTY'];
          $InvoiceDiscount = $recs['invoice_discount'];
          $UnitCostPrice = $recs['UnitCostPrice'];
          $UnitRetailPrice = $recs['UnitRetailPrice'];
          $UnitTradePrice = $recs['UnitTradePrice'];
          $AvailableStock = $recs['MaxStock'];
          $ExpiryDate = $recs['ExpiryDate'];
          if ($count % 2 == 0) {
              $bg = '#E1E1FF';
          } else {
              $bg = '#EAEAEA';
          } ?>
      <tr>
        <td ><input type="checkbox" name="StockId" id="StockId" value="<?php echo $Id; ?>"></td>
        <td><?php echo $Id; ?></td>
        <td><?php echo $UnitId; ?></td>
        <td><?php echo CatName($cat); ?></td>
        <td><?php echo $StockPrice; ?></td>
        <td><?php echo "<font color='red'><b>".$ExpiryDate."</b></font>"; ?></td>
        <td><?php if ($AvailableStock < 50) {
                                            echo "<font color='blue'><b>".$AvailableStock."</b></font>";
                                        } elseif ($AvailableStock > 50) {
                                            echo "<font color='green'><b>".$AvailableStock."</b></font>";
                                        } ?></td>
        <td><input type="button" class="btn btn-info btn-xs" onclick='ShowStockPackagingDisplay(<?php echo $Id; ?>)' value="Packaging" /></td>
        <td><input type="button" class="btn btn-primary btn-xs" onclick='ShowStockAlternativesDisplay(<?php echo $Id; ?>)' value="Alternatives" /></td>
      </tr>
    <?php
      $count++;
      } ?>
  <?php
  }
  ?>
  </tbody>
</table>