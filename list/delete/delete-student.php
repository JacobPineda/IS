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
			header("Location: /IS/list/student.php");
		}else{
			include("../../connect.php");

			//get all field values of the selected record
			$sql = "SELECT * from Student WHERE student_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$scSql = "SELECT name from School where school_id = '{$row['school_id']}'";
			$school = mysqli_fetch_array($conn->query($scSql))['name'];	
			
			$cSql = "SELECT course_name from Course where course_id = '{$row['course_id']}'";
			$course = mysqli_fetch_array($conn->query($cSql))['course_name'];

			$name = $row['student_name'];
			$birthdate = $row['birthdate'];
			$gender = $row['gender'];
			$contact = $row['contact'];
			$address = $row['address'];

			mysqli_close($conn);
		}

		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-student.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_student' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/list/student.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
		<table border='1'>
        	<tr> 
	  			<td><b>Student ID</b></td>
                <td>".$id."</td>
			</tr>
        	<tr> 
	  			<td><b>Student Name</b></td>
                <td>".$name."</td>
			</tr>
			<tr> 
	  			<td><b>School</b></td>
                <td>".$school."</td>
			</tr>
			<tr> 
	  			<td><b>Course</b></td>
                <td>".$course."</td>
			</tr>
			<tr> 
	  			<td><b>Birthdate</b></td>
                <td>".$birthdate."</td>
			</tr>
			<tr> 
	  			<td><b>Gender</b></td>
                <td>".$gender."</td>
			</tr>
			<tr> 
	  			<td><b>Contact</b></td>
                <td>".$contact."</td>
			</tr>
			<tr> 
	  			<td><b>Address</b></td>
                <td>".$address."</td>
			</tr>
		</table>
		</form>
		</center>
		";


		//delete record when record is confirmed to be deleted
		if($_POST['delete_student']){
			include('../../connect.php');

			if(!mysqli_query($conn, "DELETE FROM Student WHERE student_id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/list/student.php'>Back</a></center>";
			}

			mysqli_close($conn);
		} else{
			echo  "$form";
		}

	?>

  </body>
</html>
