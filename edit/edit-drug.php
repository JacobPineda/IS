<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link   href="/IS/css/sidenav.css" rel="stylesheet">
    <meta charset="utf-8">
</head>
 
<body>
   <?php
		include("../sidenav.php");
		
		function generateForm($cpr_no,  $curr_dr_no, $curr_country, $curr_rsn, $curr_validity_date, $curr_generic_name, $curr_brand_name,$curr_strength, $curr_form, $curr_manu){
			
			$manuList = "<option value='null'></option>";
			include('../connect.php');
			$sql = "SELECT * FROM Manufacturer ORDER BY name";
			$result = $conn->query($sql);
		
			while($row = mysqli_fetch_array($result)){
				$isSelected = ($curr_manu == $row['manu_no'])? "selected = 'selected'" : null;
				$manuList .= "<option value=".$row['manu_no']. " ".$isSelected.">".$row['name']."</option>";
			}
		
			mysqli_close($conn);
			
			
			return "<h3>Edit a record</h3>
		<form action = 'edit-drug.php?cpr_no=$cpr_no' method='post'>
		<table>
        	<tr> 
	  			<td>CPR No.</td>
                <td><input name='cpr_no' type='text'  value='".$cpr_no."' disabled></td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
            	<td><input name='new_dr_no' type='text' value='".$curr_dr_no."' ></td>
            </tr>
        	<tr> 
	  			<td>Country</td>
                <td><input name='new_country' type='text'  value='".$curr_country."' ></td>
			</tr>
        	<tr> 
	  			<td>RSN</td>
                <td><input name='new_rsn' type='text'  value='".$curr_rsn."' ></td>
			</tr>
			<tr>                   
   				<td>Validity Date</td>
            	<td><input name='new_validity_date' type='text' value='".$curr_validity_date."' ></td>
            </tr>
			<tr>                   
   				<td>Generic Name</td>
            	<td><input name='new_generic_name' type='text' value='".$curr_generic_name."' ></td>
            </tr>
			<tr>                   
   				<td>Brand Name</td>
            	<td><input name='new_brand_name' type='text' value='".$curr_brand_name."' ></td>
            </tr>
			<tr>                   
   				<td>Strength</td>
            	<td><input name='new_strength' type='text' value='".$curr_strength."' ></td>
            </tr>
			<tr>                   
   				<td>Form</td>
            	<td><input name='new_form' type='text' value='".$curr_form."' ></td>
            </tr>
			<tr>                   
   				<td>Manufacturer</td>
            	<td><select name='new_manu'>{$manuList}</select></td>
            </tr>
			<tr>
				<td><input  type='submit' name='edit_drug' value='Save'/></td>
                <td><a class='btn' href='/IS/reports/drug.php'>Back</a></td>
			</tr>
		</table> </form>";
		}
   
		$cpr_no = null;
		if ( !empty($_GET['cpr_no'])) {
			$cpr_no = $_REQUEST['cpr_no'];
		}
		if($cpr_no == null){
			header("Location: /IS/reports/drug.php");
		}else{
			include("../connect.php");
			
			$sql = "SELECT * from Drug WHERE cpr_no = '{$cpr_no}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$curr_dr_no = $row['dr_no'];
			$curr_country = $row['country'];
			$curr_rsn = $row['rsn'];
			$curr_validity_date = $row['validity_date'];
			$curr_generic_name = $row['generic_name'];
			$curr_brand_name = $row['brand_name'];
			$curr_strength = $row['strength'];
			$curr_form = $row['form'];
			
			
			$manuSql = "SELECT manu_no FROM Manufactures WHERE drug_cpr_no = '{$cpr_no}'";
			$manuResult = $conn->query($manuSql);
			$manuRow = mysqli_fetch_array($manuResult);			
		
			$curr_manu = $manuRow['manu_no'];
			
			mysqli_close($conn);
		}
   
		if($_POST['edit_drug']){
			$new_dr_no = $_POST['new_dr_no'];
			$new_country = $_POST['new_country'];
			$new_rsn = $_POST['new_rsn'];
			$new_validity_date = $_POST['new_validity_date'];
			$new_generic_name = $_POST['new_generic_name'];
			$new_brand_name = $_POST['new_brand_name'];
			$new_strength = $_POST['new_strength'];
			$new_form = $_POST['new_form'];
			$new_manu = $_POST['new_manu'];
			
			include('../connect.php');
		
			if(!mysqli_query($conn, "UPDATE Drug SET dr_no = '{$new_dr_no}'
					, country = '{$new_country}' 
					, rsn = '{$new_rsn}'
					, validity_date = '{$new_validity_date}' 
					, generic_name = '{$new_generic_name}'
					, brand_name = '{$new_brand_name}' 
					, strength = '{$new_strength}'
					, form = '{$new_form}' 
					WHERE cpr_no = '{$cpr_no}'")){
				echo "Error description: " . mysqli_error($conn) . "<br>". generateForm($cpr_no, $new_dr_no, $new_country, $new_rsn, $new_validity_date, $new_generic_name, $new_brand_name,$new_strength, $new_form, $new_manu);
				
			} else { 
				if($curr_manu != $new_manu){
					mysqli_query($conn, "DELETE FROM Manufactures WHERE drug_cpr_no = '{$cpr_no}' AND manu_no = '{$curr_manu}'");
					mysqli_query($conn, "INSERT INTO Manufactures VALUES ('{$cpr_no}', '0', '{$new_manu}')");
				}
				echo "Successfully edited a drug! <br/>" . generateForm($cpr_no, $new_dr_no, $new_country, $new_rsn, $new_validity_date, $new_generic_name, $new_brand_name,$new_strength, $new_form, $new_manu);
			}
		
			mysqli_close($conn);
		} else{
			echo  generateForm($cpr_no, $curr_dr_no, $curr_country, $curr_rsn, $curr_validity_date, $curr_generic_name, $curr_brand_name,$curr_strength, $curr_form, $curr_manu);
		}
		
			
		
	?>
  </body>
</html>