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
		include("../../topnav.php");

		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/list/trader.php");
		}else{
			include("../../connect.php");

			//get all field values of selected record
			$sql = "SELECT * from Trader WHERE trader_no = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['name'];
		}

		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-trader.php?id=$id'>Edit</a>     <a href='../delete/delete-trader.php?id=$id'>Delete</a>": null;
		$form=" {$edit_delete}
		<br><center><h3>View a record</h3>
			<table border='1'>
        	<tr> 
	  			<td><b>Name</b></td>
                <td>".$name."</td>
			</tr>
		</table><br/><a class='btn' href='/IS/list/trader.php'>Back</a></center>";

		echo "$form";


		mysqli_close($conn);

	?>

  </body>
</html>
