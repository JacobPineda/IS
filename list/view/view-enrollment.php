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
			header("Location: /IS/list/enrollment.php");
		}else{
			include("../../connect.php");

			//get all field values of selected record
			$sql = "SELECT * from Enrollment WHERE enrollment_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['student_id'];
			$num_units = $row['num_units'];
			$year = $row['school_year'];
			$sem = $row['semester'];
			$pay = $row['payment_status'];
			$enroll = $row['enrollment_status'];
		}

		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-enrollment.php?id=$id'>Edit</a>     
		<a href='../delete/delete-enrollment.php?id=$id'>Delete</a>": null;
		$form=" {$edit_delete}
		<br><center><h3>View a record</h3>
			<table border='1'>
            <tr>
                <td><b>Enrollment ID</b></td>
                <td><b>Student Name</b></td>
                <td><b>No. of Units</b></td>
                <td><b>School Year</b></td>
                <td><b>Semester</b></td>
                <td><b>Payment Status</b></td>
                <td><b>Enrollment Status</b></td>
			</tr>
            <tr>
                <td>".$id."</td>
                <td>".$name."</td>
                <td>".$num_units."</td>
                <td>".$year."</td>
                <td>".$sem."</td>
                <td>".$pay."</td>
                <td>".$enroll."</td>
			</tr>
		</table><br/><a class='btn' href='/IS/list/enrollment.php'>Back</a></center>";

		echo "$form";

		mysqli_close($conn);

	?>

  </body>
</html>
