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
    <form action='create-enrollment.php' method='post'>
		<table>
            <tr>
                <td><b>Student Name</b></td>
                <td>".$sid."</td>
			</tr>
            <tr>
                <td><b>No. of Units</b></td>
                <td><input name='num_units' type='text'></td>
			</tr>
            <tr>
                <td><b>School Year</b></td>
                <td><input name='year' type='text'></td>
			</tr>
            <tr>
                <td><b>Semester</b></td>
                <td><input name='semester' type='text'></td>
			</tr>
            <tr>
                <td><b>Payment Status</b></td>
                <td><input name='payment_status' type='text'></td>
			</tr>
            <tr>
                <td><b>Enrollment Status</b></td>
                <td><input name='enrollment_status' type='text'></td>
			</tr>
            <tr>
				<td><input  type='submit' name='create_enrollment' value='Create'/></td>
                <td><a class='btn' href='/IS/list/enrollment.php'>Back</a></td>
			</tr>
		</table>
    </form>
    </center>";
    /*  <td>".$id."</td>
        <td>".$name."</td>
        <td>".$num_units."</td>
        <td>".$year."</td>
        <td>".$sem."</td>
        <td>".$pay."</td>
        <td>".$enroll."</td>
     */
	//when form is submitted, get all values of each fields
	if($_POST['create_enrollment']){
		$sid = $_POST['name'];

		include('../../connect.php');

		$qry = "SELECT * from Enrollment where student_id = '{$sid}'";
		$result = $conn->query($qry);
		$data = mysqli_fetch_array($result)['student_id'];
		

		if($data){
			echo "<center>Enrollment data for student already exists!</center>" . $form;
		}else{
			$qry = "SELECT count(*) as total_no from Enrollment";
			$result = $conn->query($qry);
			$id = mysqli_fetch_array($result)['total_no'];
			$id++;
			
			$sql = "SELECT count(*) as total FROM Enrollment";
			$total = mysqli_fetch_array($conn->query($sql))['total'];
			$total--;
			
            $newIdSql = "SELECT TRIM(LEADING '0' FROM REPLACE(enrollment_id, 'EID-', '')) as 'id' from Enrollment ORDER BY enrollment_id ASC LIMIT 1 OFFSET {$total}";
			$id = mysqli_fetch_array($conn->query($newIdSql))['id'];
			$id++;				
			if($id < 10){
				$zero = '00';
			} else if ($id < 100){
				$zero = '0';
			} else {
				$zero = null;
			}
			$enrolment_id = 'CID-'.$zero.$id;
				

		//insert values into the table
			if(!mysqli_query($conn, "INSERT INTO Enrollment VALUES ('{$enrollment_id}','{$sid}')")){
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
