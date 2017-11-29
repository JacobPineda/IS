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
			header("Location: /IS/list/course.php");
		}else{
			include("../../connect.php");

			//get all field values of the selected record
			$sql = "SELECT * from Course WHERE course_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['course_name'];

			mysqli_close($conn);
		}

		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-course.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_course' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/list/course.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
		<table border='1'>
        	<tr> 
	  			<td><b>Course ID</b></td>
                <td>".$id."</td>
			</tr>
        	<tr> 
	  			<td><b>Name</b></td>
                <td>".$name."</td>
			</tr>
		</table>
		</form>
		</center>
		";


		//delete record when record is confirmed to be deleted
		if($_POST['delete_course']){
			include('../../connect.php');

			if(!mysqli_query($conn, "DELETE FROM Course WHERE course_id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/list/course.php'>Back</a></center>";
			}

			mysqli_close($conn);
		} else{
			echo  "$form";
		}

	?>

  </body>
</html>
