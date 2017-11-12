<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link href="../css/sidenav.css" rel="stylesheet">
</head>
 
<body>
	<?php
	include("../sidenav.php");
	
	
	$form ="<h3>Create a Drug</h3>
                    
    <form action='create-drug.php' method='post'>
		<table>
        	<tr> 
	  			<td>CPR No.</td>
                <td><input name='cpr_no' type='text'  required></td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
            	<td><input name='dr_no' type='text'  required></td>
            </tr>
			<tr>    
                <td>Country</td>
                <td><input name='country' type='text'></td>
            </tr>
			<tr>    
                <td>RSN</td>
                <td><input name='rsn' type='text'></td>
            </tr>
			<tr>    
                <td>Validity Date</td>
                <td><input name='validity_date' type='date'></td>
            </tr>
			<tr>                   
   				<td>Generic Name</td>
            	<td><input name='generic_name' type='text'></td>
            </tr>
			<tr>    
                <td>Brand Name</td>
                <td><input name='brand_name' type='text'></td>
            </tr>
			<tr>    
                <td>Strength</td>
                <td><input name='strength' type='text'></td>
            </tr>
			<tr>    
                <td>Form</td>
                <td><input name='form' type='text'></td>
            </tr>
			<tr>
				<td><input  type='submit' name='create_drug' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/drug.php'>Back</a></td>
			</tr>
		</table>

    </form>";

		if($_POST['create_drug']){
			$cpr_no = $_POST['cpr_no'];
			$dr_no = $_POST['dr_no'];	
			$country = $_POST['country'];
			$rsn = $_POST['rsn'];
			$validity_date = $_POST['validity_date'];	
			$generic_name = $_POST['generic_name'];	
			$brand_name = $_POST['brand_name'];
			$strength = $_POST['strength'];
			$form1 = $_POST['form'];		
		
			include('../connect.php');
		
			$newIdSql = "SELECT DISTINCT industry_id from Industry where name = 'Drug'";
			$result = $conn->query($newIdSql);
			$industry_id = mysqli_fetch_array($result)['industry_id'];
			
			if(!mysqli_query($conn, "INSERT INTO Drug VALUES ('{$industry_id}','{$cpr_no}','{$dr_no}','{$country}','{$rsn}','{$validity_date}','{$generic_name}','{$brand_name}','{$strength}','{$form1}')")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else {
				echo "Successfully created a Product! <br> $form";
			}	
		
			mysqli_close($conn);
		
		}
		else{
			echo "$form";
		}
		
	?>



</body>
</html>
        