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
		
		/*
		*generate forms
		*@params - too many parameters, planning to insert them into an array instead
		*parameters are columns of the table
		*/
		function generateForm($id, $curr_name, $curr_region){
			
			include('../connect.php');
			
			$regionList = "<option value='null'></option>";
			$sql = "SELECT * FROM Region ORDER BY region_name";
			$result = $conn->query($sql);
			//default value of manufacturer will be set here
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($curr_region == $row['region_id'])? "selected = 'selected'" : null;
				$regionList .= "<option value=".$row['region_id']. " ".$isSelected.">".$row['region_name']."</option>";
			}		
			mysqli_close($conn);
			
			
			
			return "<center><h3>Edit a record</h3>
		<form action = 'edit-pub_elem_school.php?id=$id' method='post'>
		<table>
        	<tr> 
	  			<td>School ID</td>
                <td><input name='id' type='text'  value='".$id."' disabled></td>
			</tr>
			<tr>                   
   				<td>Name</td>
            	<td><input name='new_name' type='text' value='".$curr_name."' ></td>
            </tr>
        	<tr> 
	  			<td>Region</td>
            	<td><select name='new_region'>{$regionList}</select></td>
			</tr>
			<tr>
				<td><input  type='submit' name='edit_pub_elem_school' value='Save'/></td>
                <td><a class='btn' href='/IS/reports/pub_elem_school.php'>Back</a></td>
			</tr>
		</table> </form></center>";
		}
		
		//get cpr_no of selected record from the generated table
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		if($id == null){
			header("Location: /IS/reports/pub_elem_school.php");
		}else{
			include("../connect.php");
			
			//get current values 
			$sql = "SELECT * from Public_Elementary_School WHERE elementary_school_id = '{$id}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$curr_name = $row['school_name'];
			$curr_region = $row['region_id'];
			
			mysqli_close($conn);
		}
   
		//when form is submitted or saved, record will be updated with new values
		if($_POST['edit_pub_elem_school']){
			//get new values
			$new_name= $_POST['new_name'];
			$new_region = $_POST['new_region'];
			
			include('../connect.php');
		
			//update record
			if(!mysqli_query($conn, "UPDATE Public_Elementary_School SET school_name = '{$new_name}'
					, region_id = '{$new_region}' 
					WHERE elementary_school_id = '{$id}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($id, $new_name, $new_region);
				
			} else { 
				//echo updated form
				echo "<center>Successfully edited a record! <br/></center>" . generateForm($id, $new_name, $new_region);
			}
		
			mysqli_close($conn);
		} else{
			echo  generateForm($id, $curr_name, $curr_region);
		}
	?>

  </body>
</html>