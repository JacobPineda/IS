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
		include("../topnav.php");
		
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/reports/school.php");
		}else{
			include("../connect.php");
			
			//get all field values of selected record			
			$sql = "SELECT * from School WHERE school_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);			
			
			$regionSql = "SELECT region_name from Region WHERE region_id = (SELECT region_id FROM School WHERE school_id = '{$id}')";
			$regionRow = mysqli_fetch_array($conn->query($regionSql));		
						
			$name = $row['name'];
			$region = $regionRow['region_name'];
			$contact = $row['contact'];
			$email = $row['email'];
		}
   
		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-school.php?id=$id'>Edit</a>    
		<a href='../delete/delete-school.php?id=$id'>Delete</a>": null;
		$form=" {$edit_delete}
		<center><h3>View a record</h3>
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
		</table><br/><a class='btn' href='/IS/reports/school.php'>Back</a></center>";
		
		echo "$form";
		
		
		mysqli_close($conn);
		
	?>

  </body>
</html>