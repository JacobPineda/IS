<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/IS/css/topnav.css" rel="stylesheet">
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
		function generateForm($id, $curr_sid, $curr_units,$currentsy,$currentsem,$currentpaystat,$currentenrollstat){

			include('../../connect.php');
      $sql = "SELECT * FROM Student ORDER BY student_id";
      $result = $conn->query($sql);

      $sidList = "<option value='null'></option>";
      while($row = mysqli_fetch_array($result)){
        $sidList .= "<option value=".$row['student_id'].">".$row['student_id']."</option>";
      }
			return "<center><h3>Edit a record</h3>
		<form action = 'edit-enrollment.php?id=$id' method='post'>
    <table>
        <tr>
            <td><b>Student ID</b></td>
              <td><input name='new_num_units' type='text'  value='".$curr_sid."' disabled></td>
        </tr>
        <tr>
            <td><b>No. of Units</b></td>
            <td><input name='new_num_units' type='text' value = '".$curr_units."'></td>
        </tr>
        <tr>
            <td><b>School Year</b></td>
            <td><input name='new_currentsy' type='text' value = '".$currentsy."'></td>
        </tr>
        <tr>
            <td><b>Semester</b></td>
            <td><select name='new_currentsem'><option value='null'></option><option value=1>1</option><option value=2>2</option><td></select>
        </tr>
        <tr>
            <td><b>Payment Status</b></td>
            <td><select name='new_currentpaystat'><option value='null'></option><option value='PAID'>PAID</option><option value='NOT PAID'>NOT PAID</option></select><td>
        </tr>
        <tr>
            <td><b>Enrollment Status</b></td>
              <td><select name='new_currentenrollstat'><option value='null'></option><option value='REGULAR'>REGULAR</option><option value='NOT REGULAR'>NOT REGULAR</option></select><td>
        </tr>
        <tr>
            <td><input  type='submit' name='update_enrollment' value='Update'/></td>
            <td><a class='btn' href='/IS/list/enrollment.php'>Back</a></td>
        </tr>
    </table></form></center>";
		}

		//get cpr_no of selected record from the generated table
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/list/enrollment.php");
		}else{
			include('../../connect.php');

			//get current values
			$sql = "SELECT * from Enrollment WHERE enrollment_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$curr_sid = $row['student_id'];
      $curr_units = $row['num_units'];
      $currentsy = $row['school_year'];
      $currentsem = $row['semester'];
      $currentpaystat = $row['payment_status'];
      $currentenrollstat = $row['enrollment_status'];


			mysqli_close($conn);
		}

		//when form is submitted or saved, record will be updated with new values
		if($_POST['edit_enrollment']){
			//get new values
      //$new_sid = $_POST['new_student_id'];
      $new_num_units = $_POST['new_num_units'];
      $new_currentsy = $_POST['new_school_year'];
      $new_currentsem = $_POST['new_semester'];
      $new_currentpaystat = $_POST['new_payment_status'];
      $new_currentenrollstat = $_POST['new_enrollment_status'];

			include('../../connect.php');

			//update record

			/*$qry = "SELECT * from Enrollment where course_name = '{$new_name}'";
			$result = $conn->query($qry);
			$data = mysqli_fetch_array($result)['course_name'];

			if($data){
				echo "<center>Enrollment data already exists!</center>" .generateForm($id, $curr_name);
			}else{
				if(!mysqli_query($conn, "UPDATE Enrollment SET course_name = '{$new_name}'
					WHERE course_id = '{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($id, $new_name);

				} else {
				//echo updated form
					echo "<center>Successfully edited a record!</center> <br/>" . generateForm($id, $new_name);
				}
				mysqli_close($conn);
			}
		} else{
			echo  generateForm($id, $curr_name);
		}*/
    if(!mysqli_query($conn, "UPDATE Enrollment SET student_id =
          num_units = '{$new_num_units}'
        , school_year = '{$new_currentsy}'
        , semester = '{$new_currentsem}'
        , payment_status = '{$new_currentpaystat}'
        , enrollment_status = '{$new_currentenrollstat}'
        WHERE enrollment_id = '{$id}'")){
      echo "Error description: " . mysqli_error($conn) . "<br>". ggenerateForm($id, $new_student_id, $new_num_units,$new_currentsy,$new_currentsem,$new_currentpaystat,$new_currentenrollstat);
    } else {
      //echo updated form
      echo "<center>Successfully edited a drug! <br/></center>" . generateForm($id, $new_student_id, $new_num_units,$new_currentsy,$new_currentsem,$new_currentpaystat,$new_currentenrollstat);
    }

    mysqli_close($conn);
  } else{
    echo  generateForm($id, $curr_sid, $curr_units,$currentsy,$currentsem,$currentpaystat,$currentenrollstat);
  }
	?>
</body>
</html>
