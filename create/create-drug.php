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
	//connect to database
	include('../connect.php');
	
	//generate query
	$sql = "SELECT * FROM Manufacturer ORDER BY name";
	$result = $conn->query($sql);
	
	// get list of manufacturers and place them to <option> tags
	$manuList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$manuList .= "<option value=".$row['manu_no'].">".$row['name']."</option>";
	}	
	
	//generate query
	$sql = "SELECT * FROM Importer ORDER BY name";
	$result = $conn->query($sql);
	
	$importerList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$importerList .= "<option value=".$row['importer_no'].">".$row['name']."</option>";
	}
	$sql = "SELECT * FROM Trader ORDER BY name";
	$result = $conn->query($sql);
	
	$traderList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$traderList .= "<option value=".$row['trader_no'].">".$row['name']."</option>";
	}
	$sql = "SELECT * FROM Distributor ORDER BY name";
	$result = $conn->query($sql);
	
	$distList = "<option value='null'></option>";
	while($row = mysqli_fetch_array($result)){
		$distList .= "<option value=".$row['dist_no'].">".$row['name']."</option>";
	}
	
	//disconnect to db
	mysqli_close($conn);
	
	//form to be displayed
	$form ="
<center><h3>Create a Drug</h3>
                    
    <form action='create-drug.php' method='post'>
		<table>
        	<tr> 
	  			<td>CPR No.</td>
                <td><input name='cpr_no' type='text'  required></td>
			</tr>
			<tr>                   
   				<td>DR No.</td>
            	<td><input name='dr_no' type='text' ></td>
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
				<td>Manufacturer</td>
				<td><select name='manu'>{$manuList}</select><td>
			</tr>
			<tr>
				<td>Importer</td>
				<td><select name='importer'>{$importerList}</select><td>
			</tr>
			<tr>
				<td>Trader</td>
				<td><select name='trader'>{$traderList}</select><td>
			</tr>
			<tr>
				<td>Distributor</td>
				<td><select name='dist'>{$distList}</select><td>
			</tr>
			<tr>
				<td><input  type='submit' name='create_drug' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/drug.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";

		
		//when form is submitted, get all values of each fields
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
			$manufacturer = $_POST['manu'];
			$importer = $_POST['importer'];
			$trader = $_POST['trader'];
			$distributor = $_POST['dist'];
		
		
			include('../connect.php');
			
			$if_cpr_exists = "SELECT cpr_no from Drug where cpr_no = '{$cpr_no}'";
			$result = $conn->query($if_cpr_exists);
			$data = mysqli_fetch_array($result)['cpr_no'];
			
			if($data){
				echo "<center>CPR No. already exists!</center>" . $form;
			}else{
				$newIdSql = "SELECT DISTINCT industry_id from Industry where name = 'Drug'";
				$result = $conn->query($newIdSql);
				$industry_id = mysqli_fetch_array($result)['industry_id'];
			
			//insert values into the table
				if(!mysqli_query($conn, "INSERT INTO Drug VALUES ('{$industry_id}','{$cpr_no}','{$dr_no}','{$country}','{$rsn}','{$validity_date}','{$generic_name}','{$brand_name}','{$strength}','{$form1}')")){
					echo "Error description: " . mysqli_error($conn) . "<br> $form";
				} else {
					if($manufacturer != 'null'){
						if(!mysqli_query($conn, "INSERT INTO Manufactures VALUES ('{$cpr_no}','0','{$manufacturer}')")){
							echo "Error description: " . mysqli_error($conn) . "<br> $form";
						} 		
					} 					
					if($importer != 'null'){
						if(!mysqli_query($conn, "INSERT INTO Imports VALUES ('{$cpr_no}','0','{$importer}')")){
							echo "Error description: " . mysqli_error($conn) . "<br> $form";
						}		
					}				
					if($trader != 'null'){
						if(!mysqli_query($conn, "INSERT INTO Trades VALUES ('{$cpr_no}','0','{$trader}')")){
							echo "Error description: " . mysqli_error($conn) . "<br> $form";
						}		
					}				
					if($distributor != 'null'){
						if(!mysqli_query($conn, "INSERT INTO Distributes VALUES ('{$cpr_no}','0','{$distributor}')")){
							echo "Error description: " . mysqli_error($conn) . "<br> $form";
						}else{
							echo "<center>Successfully created a Product! </center><br> $form";
						}
					}else{
						echo "<center>Successfully created a Product! </center><br> $form";
					}
				}
			}
			
	
		
			mysqli_close($conn);
		
		}else{
			echo "$form";
		}
		
	?>


</body>
</html>
        