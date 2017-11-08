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
	
	
	$form ="<h3>Create a User</h3>
                    
    <form action='create-bio-prod.php' method='post'>
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
				<td><input  type='submit' name='create_bio_prod' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/bio-prod.php'>Back</a></td>
			</tr>
		</table>

    </form>";

		if($_POST['create_bio_prod']){
			$cpr_no = $_POST['cpr_no'];
			$dr_no = $_POST['dr_no'];	
			$country = $_POST['country'];
			$rsn = $_POST['rsn'];
			$validity_date = $_POST['validity_date'];			
		
			include('../connect.php');
		
			$newIdSql = "SELECT DISTINCT industry_id from Industry where name = 'Product'";
			$result = $conn->query($newIdSql);
			$industry_id = mysqli_fetch_array($result)['industry_id'];
			
			if(!mysqli_query($conn, "INSERT INTO Biological VALUES ('{$industry_id}','{$cpr_no}','{$dr_no}','{$country}','{$rsn}','{$validity_date}')")){
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
        