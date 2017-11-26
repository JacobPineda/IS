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

		$cpr_no = null;
		if ( !empty($_GET['cpr_no'])) {
			$cpr_no = $_REQUEST['cpr_no'];
		}
		if($cpr_no == null){
			header("Location: /IS/reports/food.php");
		}else{
			include("../connect.php");

			//get all field values of selected record
			$sql = "SELECT * from Food WHERE cpr_no = '{$cpr_no}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);

			$manuSql = "SELECT name from Manufacturer WHERE manu_no = (SELECT manu_no FROM Manufactures WHERE food_cpr_no = '{$cpr_no}')";
			$manuResult = $conn->query($manuSql);
			$manuRow = mysqli_fetch_array($manuResult);

			$trdSql = "SELECT name from Trader WHERE trader_no = (SELECT trader_no FROM Trades WHERE food_cpr_no = '{$cpr_no}')";
			$trdResult = $conn->query($trdSql);
			$trdRow = mysqli_fetch_array($trdResult);

			$distSql = "SELECT name from Distributor WHERE dist_no = (SELECT dist_no FROM Distributes WHERE food_cpr_no = '{$cpr_no}')";
			$distResult = $conn->query($distSql);
			$distRow = mysqli_fetch_array($distResult);

			$cpr_no = $row['cpr_no'];
			$dr_no = $row['dr_no'];
			$country = $row['country'];
			$rsn = $row['rsn'];
			$validity_date = $row['validity_date'];
			$food_name = $row['food_name'];
			$manufacturer = $manuRow['name'];
			$importer = $impRow['name'];
			$trader = $trdRow['name'];
			$distributor = $distRow['name'];
		}

		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-food.php?cpr_no=$cpr_no'>Edit</a>     <a href='../delete/delete-food.php?cpr_no=$cpr_no'>Delete</a>": null;
		$form=" {$edit_delete}
		<center><h3>View a record</h3>
			<table border='1'>
        	<tr> 
	  			<td>CPR No.</td>
                <td>".$cpr_no."</td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
				<td>".$dr_no."</td>
            </tr>
        	<tr> 
	  			<td>Country</td>
				<td>".$country."</td>
			</tr>
        	<tr> 
	  			<td>RSN</td>
				<td>".$rsn."</td>
			</tr>
			<tr>                   
   				<td>Validity Date</td>
				<td>".$validity_date."</td>
            </tr>
			<tr>                   
   				<td>Name</td>
				<td>".$food_name."</td>
            </tr>
			<tr>                   
   				<td>Manufacturer</td>
				<td>".$manufacturer."</td>
            </tr>            
   				<td>Trader</td>
				<td>".$trader."</td>
            </tr>
			<tr>                   
   				<td>Distributor</td>
				<td>".$distributor."</td>
            </tr>
		</table><br/><a class='btn' href='/IS/reports/food.php'>Back</a></center>";

		echo "$form";


		mysqli_close($conn);

	?>

  </body>
</html>
