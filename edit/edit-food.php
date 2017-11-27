<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link   href="/IS/css/topnav.css" rel="stylesheet">
    <meta charset="utf-8">
</head>

<body>

   <?php
		include("../topnav.php");

		/*
		*generate forms
		*@params - too many parameters, planning to insert them into an array instead
		*parameters are columns of the table
		*/
		function generateForm($cpr_no, $curr_dr_no, $curr_country, $curr_rsn, $curr_validity_date, $curr_food_name, $curr_manu, $curr_trader, $curr_dist){

      include('../connect.php');
			$manuList = "<option value='null'></option>";
			$sql = "SELECT * FROM Manufacturer ORDER BY name";
			$result = $conn->query($sql);
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($curr_manu == $row['manu_no'])? "selected = 'selected'" : null;
				$manuList .= "<option value=".$row['manu_no']. " ".$isSelected.">".$row['name']."</option>";
			}

      $traderList = "<option value='null'></option>";
			$sql = "SELECT * FROM Trader ORDER BY name";
			$result = $conn->query($sql);
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($curr_trader == $row['trader_no'])? "selected = 'selected'" : null;
				$traderList .= "<option value=".$row['trader_no']. " ".$isSelected.">".$row['name']."</option>";
			}

      $distList = "<option value='null'></option>";
			$sql = "SELECT * FROM Distributor ORDER BY name";
			$result = $conn->query($sql);
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($curr_dist == $row['dist_no'])? "selected = 'selected'" : null;
				$distList .= "<option value=".$row['dist_no']. " ".$isSelected.">".$row['name']."</option>";
			}

			mysqli_close($conn);



			return "<center><h3>Edit a record</h3>
		<form action = 'edit-food.php?cpr_no=$cpr_no' method='post'>
		<table>
        	<tr> 
	  			<td>CPR No.</td>
                <td><input name='cpr_no' type='text'  value='".$cpr_no."' disabled></td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
            	<td><input name='new_dr_no' type='text' value='".$curr_dr_no."' ></td>
            </tr>
        	<tr> 
	  			<td>Country</td>
                <td><input name='new_country' type='text'  value='".$curr_country."' ></td>
			</tr>
        	<tr> 
	  			<td>RSN</td>
                <td><input name='new_rsn' type='text'  value='".$curr_rsn."' ></td>
			</tr>
			<tr>                   
   				<td>Validity Date</td>
            	<td><input name='new_validity_date' type='text' value='".$curr_validity_date."' ></td>
            </tr>
			<tr>                   
   				<td>Name</td>
            	<td><input name='new_generic_name' type='text' value='".$curr_food_name."' ></td>
            </tr>
			<tr>                   
   				<td>Manufacturer</td>
            	<td><select name='new_manu'>{$manuList}</select></td>
            </tr>
			<tr>
      <tr>                   
   				<td>Trader</td>
            	<td><select name='new_trader'>{$traderList}</select></td>
            </tr>
			<tr>
      <tr>                   
   				<td>Distributor</td>
            	<td><select name='new_dist'>{$distList}</select></td>
            </tr>
			<tr>
				<td><input  type='submit' name='edit_food' value='Save'/></td>
                <td><a class='btn' href='/IS/reports/food.php'>Back</a></td>
			</tr>
		</table> </form></center>";
		}

		//get cpr_no of selected record from the generated table
		$cpr_no = null;
		if ( !empty($_GET['cpr_no'])) {
			$cpr_no = $_REQUEST['cpr_no'];
		}
		if($cpr_no == null){
			header("Location: /IS/reports/food.php");
		}else{
			include("../connect.php");

			//get current values
			$sql = "SELECT * from Food WHERE cpr_no = '{$cpr_no}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$curr_dr_no = $row['dr_no'];
			$curr_country = $row['country'];
			$curr_rsn = $row['rsn'];
			$curr_validity_date = $row['validity_date'];
			$curr_food_name = $row['food_name'];

			$manuSql = "SELECT manu_no FROM Manufactures WHERE food_cpr_no = '{$cpr_no}'";
			$manuResult = $conn->query($manuSql);
			$manuRow = mysqli_fetch_array($manuResult);
			$curr_manu = $manuRow['manu_no'];
			
			$traderSql = "SELECT trader_no FROM Trades WHERE food_cpr_no = '{$cpr_no}'";
			$curr_trader = mysqli_fetch_array($conn->query($traderSql))['trader_no'];
			
			$distSql = "SELECT dist_no FROM Distributes WHERE food_cpr_no = '{$cpr_no}'";
			$curr_dist = mysqli_fetch_array($conn->query($distSql))['dist_no'];
			
			mysqli_close($conn);
		}

		//when form is submitted or saved, record will be updated with new values
		if($_POST['edit_food']){
			//get new values
			$new_dr_no = $_POST['new_dr_no'];
			$new_country = $_POST['new_country'];
			$new_rsn = $_POST['new_rsn'];
			$new_validity_date = $_POST['new_validity_date'];
			$new_food_name = $_POST['new_food_name'];
			$new_manu = $_POST['new_manu'];
			$new_trader = $_POST['new_trader'];
			$new_dist = $_POST['new_dist'];

			include('../connect.php');

			//update record
			if(!mysqli_query($conn, "UPDATE Food SET dr_no = '{$new_dr_no}'
					, country = '{$new_country}'
					, rsn = '{$new_rsn}'
					, validity_date = '{$new_validity_date}'
					, food_name = '{$new_food_name}'
					WHERE cpr_no = '{$cpr_no}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($cpr_no, $new_dr_no, $new_country, $new_rsn, $new_validity_date, $new_food_name, $new_manu, $new_trader, $new_dist);

			} else {
				if($curr_manu != $new_manu){
					mysqli_query($conn, "DELETE FROM Manufactures WHERE food_cpr_no = '{$cpr_no}' AND manu_no = '{$curr_manu}'");
					mysqli_query($conn, "INSERT INTO Manufactures VALUES ('0','{$cpr_no}',  '{$new_manu}')");
				}
				if($curr_trader != $new_trader){
					mysqli_query($conn, "DELETE FROM Trades WHERE food_cpr_no = '{$cpr_no}' AND trader_no = '{$curr_trader}'");
					mysqli_query($conn, "INSERT INTO Trades VALUES ('0','{$cpr_no}','{$new_trader}')");
				}
				if($curr_dist != $new_dist){
					mysqli_query($conn, "DELETE FROM Distributes WHERE food_cpr_no = '{$cpr_no}' AND dist_no = '{$curr_dist}'");
					mysqli_query($conn, "INSERT INTO Distributes VALUES ('0','{$cpr_no}','{$new_dist}')");
				}
				//echo updated form
				echo "<center>Successfully edited a food! <br/></center>" . generateForm($cpr_no, $new_dr_no, $new_country, $new_rsn, $new_validity_date, $new_food_name, $new_manu, $new_trader, $new_dist);
			}

			mysqli_close($conn);
		} else{
			echo   generateForm($cpr_no, $curr_dr_no, $curr_country, $curr_rsn, $curr_validity_date, $curr_food_name, $curr_manu, $curr_trader, $curr_dist);
		}
	?>

  </body>
</html>
