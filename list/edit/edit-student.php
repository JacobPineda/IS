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

		/*
		*generate forms
		*@params - too many parameters, planning to insert them into an array instead
		*parameters are columns of the table
		*/
		function generateForm($id, $name, $school, $course, $birthdate, $gender,
								$contact, $address){

			include('../../connect.php');


			//generate query
			$sql = "SELECT * FROM School ORDER BY name";
			$result = $conn->query($sql);
			
			// get list of school and place them to <option> tags
			$schoollist = "<option value='null'></option>";
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($school == $row['school_id'])? "selected = 'selected'" : null;
				$schoollist .= "<option value=".$row['school_id']." ".$isSelected.">".$row['name']."</option>";
			}

			//generate query
			$sql = "SELECT * FROM Course ORDER BY course_name";
			$result = $conn->query($sql);
			
			// get list of courses and place them to <option> tags
			$courselist = "<option value='null'></option>";
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($course == $row['course_id'])? "selected = 'selected'" : null;
				$courselist .= "<option value=".$row['course_id']." ".$isSelected.">".$row['course_name']."</option>";
			}

			$isFemale = ($gender == 'Female')? "selected = 'selected'": null;
			$isMale = ($gender == 'Male')? "selected = 'selected'": null;

			return "<center><h3>Edit a record</h3>
		<form action = 'edit-student.php?id=$id' method='post'>
		<table>
        	<tr> 
	  			<td>Student ID</td>
                <td><input name='id' type='text'  value='".$id."' disabled></td>
			</tr>
        	<tr> 
	  			<td>Student Name</td>
                <td><input name='new_name' type='text'  value='".$name."' required></td>
			</tr>
			<tr> 
	  			<td>School Name</td>
				<td><select name='new_school'>{$schoollist}</select></td>
			</tr>
			<tr> 
	  			<td>Course</td>
                <td><select name='new_course'>{$courselist}</select></td>
			</tr>
			<tr> 
	  			<td>Birthdate</td>
                <td><input name='new_birthdate' type='date'  value='".$birthdate."' required></td>
			</tr>
			<tr> 
	  			<td>Gender</td>
                <td><select name='new_gender' value='".$gender."' required>
					<option value='Female' ".$isFemale.">Female</option>
					<option value='Male' ".$isMale.">Male</option></select></td>
			</tr>
			<tr> 
	  			<td>Contact</td>
                <td><input name='new_contact' type='text'  value='".$contact."' required></td>
			</tr>
			<tr> 
	  			<td>Address</td>
                <td><input name='new_address' type='text'  value='".$address."' required></td>
			</tr>
			<tr>
				<td><input  type='submit' name='edit_student' value='Save'/></td>
                <td><a class='btn' href='/IS/list/student.php'>Back</a></td>
			</tr>
		</table> </form></center>";
		}

		//get cpr_no of selected record from the generated table
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/list/student.php");
		}else{
			include('../../connect.php');

			//get current values
			$sql = "SELECT * from Student WHERE student_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$curr_name = $row['student_name'];
			$curr_school = $row['school_id'];
			$curr_course = $row['course_id'];
			$curr_gender = $row['gender'];
			$curr_birthdate = $row['birthdate'];
			$curr_contact = $row['contact'];
			$curr_address = $row['address'];

			mysqli_close($conn);
		}

		//when form is submitted or saved, record will be updated with new values
		if($_POST['edit_student']){
			//get new values
			$new_name = $_POST['new_name'];
			$new_school = $_POST['new_school'];
			$new_course = $_POST['new_course'];
			$new_gender = $_POST['new_gender'];
			$new_birthdate = $_POST['new_birthdate'];
			$new_contact = $_POST['new_contact'];
			$new_address = $_POST['new_address'];

			include('../../connect.php');

			//update record

			$qry = "SELECT * from Student where 
					student_name = '{$new_name}' and 
					school_id = '{$new_school}' and
					course_id = '{$new_course}' and
					gender = '{$new_gender}' and
					birthdate = '{$new_birthdate}' and 
					contact = '{$new_contact}' and
					address = '{$new_address}' ";
			$result = $conn->query($qry);
			$data = mysqli_fetch_array($result)['student_name'];

			if($data){
				echo "<center>Student already exists!</center>" .generateForm($id, $curr_name,
						$curr_school, $curr_course, $curr_birthdate, $curr_gender, 
						$curr_contact, $curr_address);
			}else{
				if(!mysqli_query($conn, "UPDATE Student SET 
					student_name = '{$new_name}',
					school_id = '{$new_school}',
					course_id = '{$new_course}',
					gender = '{$new_gender}',
					birthdate = '{$new_birthdate}',
					contact = '{$new_contact}',
					address = '{$new_address}'
					WHERE student_id = '{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($id, $new_name, $new_school, $new_course, $new_birthdate, $new_gender,
								$new_contact, $new_address);

				} else {
				//echo updated form
					echo "<center>Successfully edited a record!</center> <br/>" . generateForm($id, $new_name, $new_school, $new_course, $new_birthdate, $new_gender, $new_contact, $new_address);
				}
				mysqli_close($conn);
			}
		} else{
			echo  generateForm($id, $curr_name, $curr_school, $curr_course, $curr_birthdate, $curr_gender,	$curr_contact, $curr_address);
		}
	?>

  </body>
</html>
