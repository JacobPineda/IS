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

            mysqli_close($conn);
		}

		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-enrollment.php?id=$id' method='post'>
			<table>
                <tr>
                    <td><input name='delete_enrollment' type='submit' value='Yes'/></td>
                    <td><a class='btn' href='/IS/list/enrollment.php'>Back</a></td>
			    </tr>
		    </table>
		<br/><br/>
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
		</table>
		</form>
		</center>
		";

		//delete record when record is confirmed to be deleted
		if($_POST['delete_enrollment']){
			include('../../connect.php');

			if(!mysqli_query($conn, "DELETE FROM Enrollment WHERE enrollment_id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/list/enrollment.php'>Back</a></center>";
			}

			mysqli_close($conn);
		} else{
			echo  "$form";
		}

	?>

  </body>
</html>
