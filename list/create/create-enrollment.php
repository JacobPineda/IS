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

    $sql = "SELECT * FROM Student ORDER BY student_name";
    $result = $conn->query($sql);

    $sidList = "<option value='null'></option>";
    while($row = mysqli_fetch_array($result)){
      $sidList .= "<option value=".$row['student_id'].">".$row['student_name']."</option>";
    }

    //form to be displayed
    $form ="
    <center><h3>Create a record</h3>
    <form action='create-enrollment.php' method='post'>
        <table>
            <tr>
                <td><b>Student ID</b></td>
                	<td><select name='student_id'>{$sidList}</select><td>
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
                <td><select name='semester'><option value='null'></option><option value=1>1</option><option value=2>2</option><td></select>
            </tr>
            <tr>
                <td><b>Payment Status</b></td>
                <td><select name='payment_status'><option value='null'></option><option value='PAID'>PAID</option><option value='NOT PAID'>NOT PAID</option></select><td>
            </tr>
            <tr>
                <td><b>Enrollment Status</b></td>
                  <td><select name='enrollment_status'><option value='null'></option><option value='REGULAR'>REGULAR</option><option value='NOT REGULAR'>NOT REGULAR</option></select><td>
            </tr>
            <tr>
                <td><input  type='submit' name='create_enrollment' value='Create'/></td>
                <td><a class='btn' href='/IS/list/enrollment.php'>Back</a></td>
            </tr>
        </table>
    </form>
    </center>";

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
