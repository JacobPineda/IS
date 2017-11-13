<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link   href="/IS/css/sidenav.css" rel="stylesheet">
<title>Drug Products Report</title>

</head>


<body>

	<?php	
		include("../sidenav.php");
		if($_SESSION['isLoggedIn'] == true){
			echo "<p> <a href='../create/create-drug.php' >Create</a><p>";
		} 
		
		$form="<div> 
			<form action='drug.php' method='post'>
				<input type='checkbox' name='check_list[]' value='industry_id'>Industry ID</input>		
				<input type='checkbox' name='check_list[]' value='cpr_no'>CPR No.</input>			
				<input type='checkbox' name='check_list[]' value='dr_no'>DR No.</input>	
				<input type='checkbox' name='check_list[]' value='country'>Country</input>	
				<input type='checkbox' name='check_list[]' value='rsn'>RSN</input>	
				<input type='checkbox' name='check_list[]' value='validity_date'>Validity Date</input>	
				<input type='checkbox' name='check_list[]' value='generic_name'>Generic Name</input>	
				<input type='checkbox' name='check_list[]' value='brand_name'>Brand Name</input>
				<input type='checkbox' name='check_list[]' value='strength'>Strength</input>	
				<input type='checkbox' name='check_list[]' value='form'>Form</input>		
				
				<input type='submit' name='generate' value='Generate'/>
				
			</form>
		</div>";
		
		$cols = "1";
			
		if($_POST['generate']){
			echo "$form</br>";
			$arrCheckBox = $_POST['check_list'];
			if($arrCheckBox){
			
				echo "<table border='1'><tr><th>action</th>";
				foreach($arrCheckBox as $check) {
					$cols = "$cols,$check"; 
					echo "<th>$check</th>";
				}
				echo "</tr>";
				
				include('../connect.php');
				$sql = "SELECT * from Drug";
				$result = $conn->query($sql);
				
				while($row = mysqli_fetch_array($result)){
					echo "<tr><td>";
					echo '<a href="../view/view-drug.php?cpr_no='.$row['cpr_no'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						echo' | <a href="../edit/edit-drug.php?cpr_no='.$row['cpr_no'].'">edit</a>
						| <a href="../delete/delete-drug.php?cpr_no='.$row['cpr_no'].'">delete</a></td>';
					}
					foreach($_POST['check_list'] as $rowVal){
						echo "<td>" . $row[$rowVal] . "</td>";
					}
					echo "</tr>";
				}
				
				echo "</table>";		
				
				mysqli_close($conn);
			}

			
		} else {
			echo "$form";
		}
		
		
	
	?>



</body>

</html>

