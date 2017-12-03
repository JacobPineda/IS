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
	//connect to database
	include('../../connect.php');
	
	$sql = "SELECT * FROM Course ORDER BY course_name";
	$result = $conn->query($sql);
	$courseList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$courseList .= "<option value=".$row['course_id'].">".$row['course_name']."</option>";
	}	
	
	$sql = "SELECT * FROM School ORDER BY name";
	$result = $conn->query($sql);	
	$schoolList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$schoolList .= "<option value=".$row['school_id'].">".$row['name']."</option>";
	}	

	//form to be displayed
	$form ="
<center><h3>Create a record</h3>
                    
    <form action='create-student.php' method='post'>
		<table>
        	<tr> 
	  			<td><b>Name</b></td>
                 <td><input name='name' type='text'  required></td>
			</tr>
        	<tr> 
	  			<td><b>Course</b></td>
                <td><select name='course'>".$courseList."</select></td>
			</tr>
        	<tr> 
	  			<td><b>School</b></td>
                <td><select name='school'>".$schoolList."</select></td>
			</tr>
        	<tr> 
	  			<td><b>Birthdate</b></td>
                 <td><input name='birthdate' type='date' ></td>
			</tr>
        	<tr> 
	  			<td><b>Gender</b></td>
                 <td><select name='gender'><option value='Male'>Male</option><option value='Female'>Female</option></select></td>
			</tr>
        	<tr> 
	  			<td><b>Contact</b></td>
                 <td><input name='contact' type='text'></td>
			</tr>
        	<tr> 
	  			<td><b>Address</b></td>
                 <td><input name='address' type='text'></td>
			</tr>
        	<tr>
				<td><input  type='submit' name='create_student' value='Create'/></td>
                <td><a class='btn' href='/IS/list/student.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";


		//when form is submitted, get all values of each fields
		if($_POST['create_student']){
			$student_name = $_POST['name'];
			$course_id = $_POST['course'];
			$school_id = $_POST['school'];
			$birthdate = $_POST['birthdate'];
			$gender = $_POST['gender'];
			$contact = $_POST['contact'];
			$address = $_POST['address'];

			include('../../connect.php');

			$qry = "SELECT count(*) as total_no from Student";
			$result = $conn->query($qry);
			$id = mysqli_fetch_array($result)['total_no'];
			$id++;
			
			$sql = "SELECT COUNT(*) as total FROM Student";
			$total = mysqli_fetch_array($conn->query($sql))['total'];
			$total--;
			
			$newIdSql = "SELECT TRIM(LEADING '0' FROM REPLACE(student_id, 'SID-', '')) as 'id' from Student ORDER BY student_id ASC LIMIT 1 OFFSET {$total}";
			$id = mysqli_fetch_array($conn->query($newIdSql))['id'];
			$id++;				
			if($id < 10){
				$zero = '0000';
			} else if ($id < 100){
				$zero = '000';
			} else if ($id < 1000){
				$zero = '00';
			} else if ($id < 10000){
				$zero = '0';
			} else {
				$zero = null;
			}
			$student_id = 'SID-'.$zero.$id;
				

			if(!mysqli_query($conn, "INSERT INTO Student VALUES ('{$student_id}','{$school_id}','{$course_id}','{$student_name}','{$birthdate}','{$gender}','{$contact}','{$address}')")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "<center>Successfully created a record! </center><br> $form";

			}
		



			mysqli_close($conn);

		}else{
			echo "$form";
		}

	?>


</body>
</html>
        
