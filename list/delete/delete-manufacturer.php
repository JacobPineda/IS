<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link   href="/IS/css/topnav.css" rel="stylesheet">
</head>

<body>

   <?php
		include("../../topnav.php");

		//get param cpr_no - selected record from the generated table
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/list/manufacturer.php");
		}else{
			include("../../connect.php");

			//get all field values of the selected record
			$sql = "SELECT * from Manufacturer WHERE manu_no = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['name'];

			mysqli_close($conn);
		}

		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-manufacturer.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_manufacturer' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/list/manufacturer.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
		<table border='1'>
        	<tr> 
	  			<td><b>Name</b></td>
                <td>".$name."</td>
			</tr>
		</table>
		</form>
		</center>
		";


		//delete record when record is confirmed to be deleted
		if($_POST['delete_manufacturer']){
			include('../../connect.php');

			if(!mysqli_query($conn, "DELETE FROM Manufacturer WHERE manu_no={$id}")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/list/manufacturer.php'>Back</a></center>";
			}

			mysqli_close($conn);
		} else{
			echo  "$form";
		}

	?>

  </body>
</html>
