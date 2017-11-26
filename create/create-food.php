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

  $sql = "SELECT * FROM Trader ORDER BY name";
  $result = $conn->query($sql);

  $traderList = "<option value = 'null'></option>";
  while($row = mysqli_fetch_array($result)){
    $traderList .= "<option value=".$row['importer_no'].">".$row['name']."</option>";
  }

  $sql = "SELECT * FROM Distributor ORDER BY name";
  $result = $conn->query($sql);

  $distribList = "<option value = 'null'></option>";
  while($row = mysqli_fetch_array($result)){
    $distribList .= "<option value=".$row['importer_no'].">".$row['name']."</option>";
  }

	//disconnect to db
	mysqli_close($conn);

	//form to be displayed
	$form ="
<center><h3>Create a Food</h3>
                    
    <form action='create-food.php' method='post'>
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
   				<td>Name</td>
            	<td><input name='food_name' type='text'></td>
            </tr>
			<tr>
				<td>Manufacturer</td>
				<td><select name='manu'>{$manuList}</select><td>
			</tr>
      <tr>
				<td>Trader</td>
				<td><select name='trader'>{$traderList}</select><td>
			</tr>
      <tr>
				<td>Distributor</td>
				<td><select name='distrib'>{$distribList}</select><td>
			</tr>
			<tr>
				<td><input type='submit' name='create_food' value='Create'/></td>
                <td><a class='btn' href='/IS/reports/food.php'>Back</a></td>
			</tr>
		</table>

    </form>
</center>";


		//when form is submitted, get all values of each fields
		if($_POST['create_food']){
			$cpr_no = $_POST['cpr_no'];
			$dr_no = $_POST['dr_no'];
			$country = $_POST['country'];
			$rsn = $_POST['rsn'];
			$validity_date = $_POST['validity_date'];
			$food_name = $_POST['food_name'];
			$manufacturer = $_POST['manu'];

			include('../connect.php');

			$if_cpr_exists = "SELECT cpr_no from Food where cpr_no = '{$cpr_no}'";
			$result = $conn->query($if_cpr_exists);
			$data = mysqli_fetch_array($result)['cpr_no'];

			if($data){
				echo "<center>CPR No. already exists!</center>" . $form;
			}else{
				$newIdSql = "SELECT DISTINCT industry_id from Industry where name = 'Food'";
				$result = $conn->query($newIdSql);
				$industry_id = mysqli_fetch_array($result)['industry_id'];

			//insert values into the table
				if(!mysqli_query($conn, "INSERT INTO Food VALUES ('{$industry_id}','{$cpr_no}','{$dr_no}','{$country}','{$rsn}','{$validity_date}','{$food_name}')")){
					echo "Error description: " . mysqli_error($conn) . "<br> $form";
				} else {
					if($manufacturer != 'null'){
						if(!mysqli_query($conn, "INSERT INTO Manufactures VALUES ('{$cpr_no}','0','{$manufacturer}')")){
							echo "Error description: " . mysqli_error($conn) . "<br> $form";
						} else {
							echo "<center>Successfully created a Product! </center><br> $form";
						}
					} else{
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
        
