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
		
		//get param cpr_no - selected record from the generated table 
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/reports/school.php");
		}else{
			include("../connect.php");
			
			//get all field values of the selected record
			$sql = "SELECT * from School WHERE school_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['name'];
			$region_id = $row['region_id'];
			$contact = $row['contact'];
			$email = $row['email'];
			
			$regionSql = "SELECT region_name from Region WHERE region_id = '{$region_id}'";
			$region = mysqli_fetch_array($conn->query($regionSql))['region_name'];	
			
			
			mysqli_close($conn);
		}
		
		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-school.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_school' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/reports/school.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
		<table border='1'>
        	<tr> 
	  			<td><b>School ID</b></td>
                <td>".$id."</td>
			</tr>
			<tr>                   
   				<td><b>Name</b></td>
				<td>".$name."</td>
            </tr>
        	<tr> 
	  			<td><b>Region</b></td>
				<td>".$region."</td>
			</tr>
        	<tr> 
	  			<td><b>Contact</b></td>
				<td>".$contact."</td>
			</tr>
			<tr>                   
   				<td><b>Email</b></td>
				<td>".$email."</td>
            </tr>
		</table>
		</form>
		</center>
		";
		
		
		//delete record when record is confirmed to be deleted
		if($_POST['delete_school']){		
			include('../connect.php');
		
			if(!mysqli_query($conn, "DELETE FROM School WHERE school_id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else { 
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/reports/school.php'>Back</a> </center>";
			}
		
			mysqli_close($conn);
		} else{
			echo  "$form";
		}
				
	?>

  </body>
</html>