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
			
			$manuSql = "SELECT name from Manufacturer WHERE manu_no = (SELECT manu_no FROM Manufactures WHERE drug_cpr_no = '{$cpr_no}')";
			$manuResult = $conn->query($manuSql);
			$manuRow = mysqli_fetch_array($manuResult);			
			
			$cpr_no = $row['cpr_no'];
			$dr_no = $row['dr_no'];
			$country = $row['country'];
			$rsn = $row['rsn'];
			$validity_date = $row['validity_date'];
			$generic_name = $row['generic_name'];
			$brand_name = $row['brand_name'];
			$strength = $row['strength'];
			$form1 = $row['form'];
			$manufacturer = $manuRow['name'];
		}
   
   
		$form="<h3>View a record</h3>
			<table border='1'>
        	<tr> 
	  			<td>CPR No.</td>
                <td>".$cpr_no."</td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
				<td>".$dr_no."</td>
            </tr>
        	<tr> 
	  			<td>Country</td>
				<td>".$country."</td>
			</tr>
        	<tr> 
	  			<td>RSN</td>
				<td>".$rsn."</td>
			</tr>
			<tr>                   
   				<td>Validity Date</td>
				<td>".$validity_date."</td>
            </tr>
			<tr>                   
   				<td>Generic Name</td>
				<td>".$generic_name."</td>
            </tr>
			<tr>                   
   				<td>Brand Name</td>
				<td>".$brand_name."</td>
            </tr>
			<tr>                   
   				<td>Strength</td>
				<td>".$strength."</td>
            </tr>
			<tr>                   
   				<td>Form</td>
				<td>".$form1."</td>
            </tr>
			<tr>                   
   				<td>Manufacturer</td>
				<td>".$manufacturer."</td>
            </tr>
		</table><br/><a class='btn' href='/IS/reports/drug.php'>Back</a>";
		
		echo "$form";
		
		
		mysqli_close($conn);
		
	?>
  </body>
</html>