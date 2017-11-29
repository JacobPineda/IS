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
			header("Location: /IS/reports/pub_elem_school.php");
		}else{
			include("../connect.php");
			
			//get all field values of the selected record
			$sql = "SELECT * from Public_Elementary_School WHERE elementary_school_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$name = $row['school_name'];
			$region_id = $row['region_id'];
	
			$regionSql = "SELECT region_name from Region WHERE region_id = '{$region_id}'";
			$region = mysqli_fetch_array($conn->query($regionSql))['region_name'];	
			
			
			mysqli_close($conn);
		}
		
		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-pub_elem_school.php?id=$id' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_pub_elem_school' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/reports/pub_elem_school.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
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
		</table>
		</form>
		</center>
		";
		
		
		//delete record when record is confirmed to be deleted
		if($_POST['delete_pub_elem_school']){		
			include('../connect.php');
		
			if(!mysqli_query($conn, "DELETE FROM Public_Elementary_School WHERE elementary_school_id='{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else { 
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/reports/pub_elem_school.php'>Back</a> </center>";
			}
		
			mysqli_close($conn);
		} else{
			echo  "$form";
		}
				
	?>

  </body>
</html>