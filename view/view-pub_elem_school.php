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
			header("Location: /IS/reports/pub_elem_school.php");
		}else{
			include("../connect.php");
			
			//get all field values of selected record			
			$sql = "SELECT * from Public_Elementary_School WHERE elementary_school_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);			
			
			$regionSql = "SELECT region_name from Region WHERE region_id = (SELECT region_id FROM Public_Elementary_School WHERE elementary_school_id = '{$id}')";
			$regionRow = mysqli_fetch_array($conn->query($regionSql));		
						
			$name = $row['school_name'];
			$region = $regionRow['region_name'];
		}
   
		$edit_delete = ($_SESSION['isLoggedIn'] == true)? "<a href='../edit/edit-pub_elem_school.php?id=$id'>Edit</a>    
		<a href='../delete/delete-pub_elem_school.php?id=$id'>Delete</a>": null;
		$form=" {$edit_delete}
		<center><h3>View a record</h3>
			<table border='1'>
        	<tr> 
	  			<td><b>Elementary School ID</b></td>
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
		</table><br/><a class='btn' href='/IS/reports/pub_elem_school.php'>Back</a></center>";
		
		echo "$form";
		
		
		mysqli_close($conn);
		
	?>

  </body>
</html>