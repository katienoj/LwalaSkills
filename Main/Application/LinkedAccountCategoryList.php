 <?php //session_start();
	//Script Author:John Katieno
	//This Script is used to show newly regsitered patients in the system
	//Grab the main Database connection
	include "../Config/db_conn.php";
	//include "general_functions.php";
	//$user=$_SESSION['UserId'];
	global $conn;
	$module_id = $_REQUEST['module_id'];
	?>
 <link href="../Main/Layout/styles/interface.css" rel="stylesheet" type="text/css">
 <div id="pregnant_patient_list" style="height:40%; max-height:40%;">
 	<table border="0" width="100%">
 		<thead>
 			<tr>
 				<td >&nbsp;</td>
 				<td >Category Id</td>
 				<td >Account Category Name</td>
 			</tr>
 		</thead>
 		<tbody style="overflow-y:auto;max-height:200px; height:auto; overflow-x:hidden;">
 			<?php
				$module_ids = GetAccountsCatArray($module_id);
				$my_module_ids = explode(", ", '$module_ids');
				$v = 0;
				foreach ($module_ids as $value) {
					$v++;
					$my_mod = $value;
					// echo "<br>".$module_ids."<br>";
					$sql = mysqli_query($conn, "SELECT * FROM AccountsCategories WHERE Id ='$my_mod'") or die(mysqli_error($conn));
					//echo "<br>".mysqli_num_rows($sql)."<br>";
					if (mysqli_num_rows($sql) == 0) {
				?>
 					<?php
					} else {
						$count = 0;
						while ($rec = mysqli_fetch_array($sql)) {
							$id = $rec['Id'];
							$CategoryName = $rec['CategoryName'];
							if ($count % 2 == 0) {
								$bg = '#E1E1FF';
							} else {
								$bg = '#EAEAEA';
							}
						?>
 						<tr bgColor='<?php echo $bg; ?>' onMouseOver="this.bgColor='#FFFFFF'" onMouseOut="this.bgColor='<?php echo $bg; ?>'">

 							<input class="form-control" type="checkbox" name='linked_categories' value='<?php echo $id; ?>'></td>
 							<td ><?php echo $id; ?></td>
 							<td ><?php echo $CategoryName; ?>
 						</tr>
 			<?php
						}
					}
				}
				?>
 		</tbody>
 	</table>
 	<?php
		function GetTotalPregnancies($id)
		{
			global $conn;
			$sql = mysqli_query($conn, "SELECT * FROM PregnantPatients WHERE PatientId='$id'") or die(mysqli_error($conn));
			return mysqli_num_rows($sql);
		}
		function GetAccountsCatArray($module_id)
		{
			global $conn;
			$account_ids = array();
			$sql = mysqli_query($conn, "SELECT * FROM ModuleAccountsCategories WHERE ModuleId ='$module_id'") or die(mysqli_error($conn));
			$rows = mysqli_num_rows($sql);
			$count = 0;
			while ($rec = mysqli_fetch_assoc($sql)) {
				$account_ids[$count] = $rec['CategoryId'] . ",";
				$count++;
				//$account_ids .= $rec['CategoryId'].",";

			}
			return $account_ids;
		}
		?>