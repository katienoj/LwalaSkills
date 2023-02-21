<?php
require_once '../../../Main/Config/db_conn.php';
require_once '../../includes/StockFunctions.php';
?>


<link href="../../../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
<table width="100%" border="0">
  <?php
  $SearchStr = explode(':', stripslashes($_REQUEST['SearchStr']));

  $sql = $SearchStr[0];
  //echo $SearchStr[0]."<br>";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  //display product fields in list
  //echo mysqli_num_rows($result);
  if (mysqli_num_rows($result) == 0) {

  ?>
    <tr>
      <td  colspan="7" align="center">Sorry, Lwala is not aware of any registered stock with the Selected Search criteria</td>
    </tr>
  <?php
  } else {
  ?>
    <thead>
      <tr>
        <td ><input class="form-control" type="checkbox" name="CheckStock" id="CheckStock" onclick="CheckStock()" /></td>
        <td >Item Id</td>
        <td >Item Name </td>
        <td >Sub Category</td>
        <td >Cash Price </td>
        <td >Corporate Price </td>
        <td >Pack Qty </td>
        <td >Unit Corporate</td>
        <td >Unit Cash</td>
        <td >Available Stock</td>
        <td >Packaging</td>
        <td >Alternative</td>

      </tr>
    </thead>
    <tbody style="width:100%;max-height:500px; overflow-x:hidden;overflow-y:auto;">
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
        $UnitCostPrice = $recs['UnitCostPrice'];
        $UnitRetailPrice = $recs['UnitRetailPrice'];
        $UnitTradePrice = $recs['UnitTradePrice'];
        $AvailableStock = $recs['MaxStock'];




        if ($count % 2 == 0) {
          $bg = '#E1E1FF';
        } else {
          $bg = '#EAEAEA';
        }
      ?>
        <tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">
          <td ><input class="form-control" type="checkbox" name="StockId" id="StockId" value="<?php echo $Id; ?>"></td>
          <td  align="left"><?php echo $Id; ?></td>
          <td  align="left"><?php echo $UnitId; ?></td>
          <td  align="centre"><?php echo CatName($cat); ?></td>
          <td  align="right"><?php echo $RetailPrice; ?></td>
          <td  align="right"><?php
                                          $Tprice = $RetailPrice;
                                          echo number_format($Tprice, 2);   ?></td>
          <td  align="right"><?php echo $PackQuantity; ?></td>
          <td  align="right"><?php
                                          $UTprice = $UnitRetailPrice;
                                          echo number_format($UTprice, 2); ?></td>
          <td  align="right"><?php echo $UnitRetailPrice; ?></td>
          <td  align="right"><?php echo $AvailableStock; ?></td>
          <td  align="right"><a href='#' onclick='ShowStockPackagingDisplay(<?php echo $Id; ?>)'>Packaging Details</a></td>
          <td  align="right"><a href='#' onclick='ShowStockAlternativesDisplay(<?php echo $Id; ?>)'>Alternatives</a></td>

        </tr>
      <?php
        $count++;
      }
      ?>
    </tbody>
  <?php
  }
  ?>
  <tr>
    <td colspan="14" align="center"><span class="td_bottom">The search criteria :</span><span ><?php echo $SearchStr[1]; ?></span></td>
  </tr>
</table>