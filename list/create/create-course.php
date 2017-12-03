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

	//form to be displayed
	$form ="
<center><h3>Create a record</h3>
                    
    <form action='create-course.php' method='post'>
		<table>
        	<tr> 
	  			<td>Name</td>
                <td><input name='name' type='text'  required></td>
			</tr>
			<tr>
				<td><input  type='submit' name='create_course' value='Create'/></td>
                <td><a class='btn' href='/IS/list/course.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";


		//when form is submitted, get all values of each fields
		if($_POST['create_course']){
			$name = $_POST['name'];

			include('../../connect.php');

			$qry = "SELECT * from Course where course_name = '{$name}'";
			$result = $conn->query($qry);
			$data = mysqli_fetch_array($result)['course_name'];


			if($data){
				echo "<center>Course name already exists!</center>" . $form;
			}else{
				$qry = "SELECT count(*) as total_no from Course";
				$result = $conn->query($qry);
				$id = mysqli_fetch_array($result)['total_no'];
				$id++;

				$sql = "SELECT COUNT(*) as total FROM Course";
				$total = mysqli_fetch_array($conn->query($sql))['total'];
				$total--;

				$newIdSql = "SELECT TRIM(LEADING '0' FROM REPLACE(course_id, 'CID-', '')) as 'id' from Course ORDER BY course_id ASC LIMIT 1 OFFSET {$total}";
				$id = mysqli_fetch_array($conn->query($newIdSql))['id'];
				$id++;
				if($id < 10){
					$zero = '00';
				} else if ($id < 100){
					$zero = '0';
				} else {
					$zero = null;
				}
				$course_id = 'CID-'.$zero.$id;


			//insert values into the table
				if(!mysqli_query($conn, "INSERT INTO Course VALUES ('{$course_id}','{$name}')")){
					echo "Error description: " . mysqli_error($conn) . "<br> $form";
				} else {
					echo "<center>Successfully created a record! </center><br> $form";
				}
			}



			mysqli_close($conn);

		}else{
			echo "$form";
		}

	?>


</body>
</html>
        
