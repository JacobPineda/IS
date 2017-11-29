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
	include("../topnav.php");
	//connect to database
	include('../connect.php');
	
	//generate query
	$sql = "SELECT * FROM Region ORDER BY region_name";
	$result = $conn->query($sql);
	
	// get list of manufacturers and place them to <option> tags
	$regionList = "";
	while($row = mysqli_fetch_array($result)){
		$regionList .= "<option value=".$row['region_id'].">".$row['region_name']."</option>";
	}	
		
	//disconnect db
	mysqli_close($conn);
	
	//form to be displayed
	$form ="
<center><h3>Create a record</h3>
                    
    <form action='create-school.php' method='post'>
		<table>
        	<tr> 
	  			<td>Name</td>
                <td><input name='name' type='text'  required></td>
			</tr>
			<tr>                   
   				<td>Region</td>
            	<td><select name='region'>{$regionList}</select><td>
            </tr>
			<tr>    
                <td>Contact</td>
                <td><input name='contact' type='text'></td>
            </tr>
			<tr>    
                <td>Email</td>
                <td><input name='email' type='email'></td>
            </tr>
			<tr>
				<td><input  type='submit' name='create_school' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/school.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";

		
		//when form is submitted, get all values of each fields
		if($_POST['create_school']){
			$name = $_POST['name'];
			$region = $_POST['region'];	
			$contact = $_POST['contact'];
			$email = $_POST['email'];
			
			include('../connect.php');

			$sql = "SELECT COUNT(*) as total FROM School";
			$total = mysqli_fetch_array($conn->query($sql))['total'];
			$total--;
			
			$newIdSql = "SELECT TRIM(LEADING '0' FROM REPLACE(school_id, 'SCID-', '')) as 'id' from School ORDER BY school_id ASC LIMIT 1 OFFSET {$total}";
			$id = mysqli_fetch_array($conn->query($newIdSql))['id'];
			$id++;
			if($id < 10){
				$zero = '000';
			} else if ($id < 100){
				$zero = '00';
			} else if ($id < 1000){
				$zero = '0';
			} else {
				$zero = null;
			}
			$school_id = 'SCID-'.$zero.$id;
			//insert values into the table
			if(!mysqli_query($conn, "INSERT INTO School VALUES (3,'{$school_id}','{$name}','{$region}','{$contact}','{$email}')")){
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
        