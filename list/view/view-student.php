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
			header("Location: /IS/list/student.php");
		}else{
			include("../../connect.php");

			//get all field values of selected record
			$sql = "SELECT * from Student WHERE student_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['student_name'];
			$birthdate = $row['birthdate'];
			$gender = $row['gender'];
			$contact = $row['contact'];
			$address = $row['address'];
			$scSql = "SELECT name from School where school_id = '{$row['school_id']}'";
			$school = mysqli_fetch_array($conn->query($scSql))['name'];	
					
			$cSql = "SELECT course_name from Course where course_id = '{$row['course_id']}'";
			$course = mysqli_fetch_array($conn->query($cSql))['course_name'];				
		}

		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-student.php?id=$id'>Edit</a>     
		<a href='../delete/delete-student.php?id=$id'>Delete</a>": null;
		$form=" {$edit_delete}
		<br><center><h3>View a record</h3>
			<table border='1'>
        	<tr> 
	  			<td><b>Student ID</b></td>
                <td>".$id."</td>
			</tr>
        	<tr> 
	  			<td><b>Name</b></td>
                <td>".$name."</td>
			</tr>
        	<tr> 
	  			<td><b>Course</b></td>
                <td>".$course."</td>
			</tr>
        	<tr> 
	  			<td><b>School</b></td>
                <td>".$school."</td>
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
		</table><br/><a class='btn' href='/IS/list/student.php'>Back</a></center>";

		echo "$form";


		mysqli_close($conn);

	?>

  </body>
</html>
