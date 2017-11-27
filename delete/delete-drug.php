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
		$cpr_no = null;
		if ( !empty($_GET['cpr_no'])) {
			$cpr_no = $_REQUEST['cpr_no'];
		}
		if($cpr_no == null){
			header("Location: /IS/reports/drug.php");
		}else{
			include("../connect.php");
			
			//get all field values of the selected record
			$sql = "SELECT * from Drug WHERE cpr_no = '{$cpr_no}'";
			$result = $conn->query($sql);
			$row = mysqli_fetch_array($result);
			$cpr_no = $row['cpr_no'];
			$dr_no = $row['dr_no'];
			$country = $row['country'];
			$rsn = $row['rsn'];
			$validity_date = $row['validity_date'];
			$generic_name = $row['generic_name'];
			$brand_name = $row['brand_name'];
			$strength = $row['strength'];
			$form1 = $row['form'];
			
			//get name of manufacturer
			$manuSql = "SELECT name from Manufacturer WHERE manu_no = (SELECT manu_no FROM Manufactures WHERE drug_cpr_no = '{$cpr_no}' LIMIT 1)";
			$manuResult = $conn->query($manuSql);
			$manuRow = mysqli_fetch_array($manuResult);		
			$manufacturer = $manuRow['name'];	
			
			$impSql = "SELECT name from Importer WHERE importer_no = (SELECT importer_no FROM Imports WHERE drug_cpr_no = '{$cpr_no}' LIMIT 1)";
			$importer =  mysqli_fetch_array($conn->query($impSql))['name'];
			
			$traderSql = "SELECT name from Trader WHERE trader_no = (SELECT trader_no FROM Trades WHERE drug_cpr_no = '{$cpr_no}' LIMIT 1)";
			$trader =  mysqli_fetch_array($conn->query($traderSql))['name'];
			
			$distSql = "SELECT name from Distributor WHERE dist_no = (SELECT dist_no FROM Distributes WHERE drug_cpr_no = '{$cpr_no}' LIMIT 1)";
			$distributor =  mysqli_fetch_array($conn->query($distSql))['name'];
			
			mysqli_close($conn);
		}
		
		//form to be displayed
		$form="<center><h3>Delete a record</h3>
			<p class='alert alert-error'>Are you sure you want to delete this record?</p>
			<form action = 'delete-drug.php?cpr_no=$cpr_no' method='post'>
			<table>
        	<tr> 
	  			<td><input name='delete_drug' type='submit' value='Yes'/></td>
                <td><a class='btn' href='/IS/reports/drug.php'>Back</a></td>
			</tr>
		</table>
		<br/><br/>
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
			<tr>                   
   				<td>Importer</td>
				<td>".$importer."</td>
            </tr>
			<tr>                   
   				<td>Trader</td>
				<td>".$trader."</td>
            </tr>
			<tr>                   
   				<td>Distributor</td>
				<td>".$distributor."</td>
            </tr>
		</table>
		</form>
		</center>
		";
		
		
		//delete record when record is confirmed to be deleted
		if($_POST['delete_drug']){		
			include('../connect.php');
		
			if(!mysqli_query($conn, "DELETE FROM Drug WHERE cpr_no='{$cpr_no}'")){
				echo "Error description: " . mysqli_error($conn) . "<br> $form";
			} else { 
				echo "<center>Successfully deleted a record! <br/> <a class='btn' href='/IS/reports/drug.php'>Back</a> </center>";
			}
		
			mysqli_close($conn);
		} else{
			echo  "$form";
		}
				
	?>

  </body>
</html>