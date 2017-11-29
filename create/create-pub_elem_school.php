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
                    
    <form action='create-pub_elem_school.php' method='post'>
		<table>
        	<tr> 
	  			<td>Name</td>
                <td><input name='school_name' type='text'  required></td>
			</tr>
			<tr>                   
   				<td>Region</td>
            	<td><select name='region'>{$regionList}</select><td>
            </tr>
			<tr>
				<td><input  type='submit' name='create_pub_elem_school' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/pub_elem_school.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";

		
		//when form is submitted, get all values of each fields
		if($_POST['create_pub_elem_school']){
			$name = $_POST['school_name'];
			$region = $_POST['region'];	
			
			include('../connect.php');
			$sql = "SELECT COUNT(*) as total FROM Public_Elementary_School";
			$total = mysqli_fetch_array($conn->query($sql))['total'];
			$total--;
			
			$newIdSql = "SELECT TRIM(LEADING '0' FROM REPLACE(elementary_school_id, 'PESID-', '')) as 'id' from Public_Elementary_School ORDER BY elementary_school_id ASC LIMIT 1 OFFSET {$total}";
			$id = mysqli_fetch_array($conn->query($newIdSql))['id'];
			$id++;

			if($id < 10){
				$zero = '00000';
			} else if ($id < 100){
				$zero = '0000';
			} else if ($id < 1000){
				$zero = '000';
			} else if ($id < 10000){
				$zero = '00';
			}  else if ($id < 100000){
				$zero = '0';
			}  else {
				$zero = null;
			}
			$school_id = 'PESID-'.$zero.$id;
			//insert values into the table
			if(!mysqli_query($conn, "INSERT INTO Public_Elementary_School VALUES (4,'{$school_id}','{$region}','{$name}')")){
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
        