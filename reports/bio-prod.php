<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link   href="../css/sidenav.css" rel="stylesheet">
<title>Biological Products Report</title>
</head>

<body>

	<?php	
		include("../sidenav.php");
		
		
		$form="<div>
			<p> <a href='../create/create-bio-prod.php' >Create</a><p>
			<form action='bio-prod.php' method='post'>
				<input type='checkbox' name='check_list[]' value='industry_id'>Industry ID</input>		
				<input type='checkbox' name='check_list[]' value='cpr_no'>CPR No.</input>			
				<input type='checkbox' name='check_list[]' value='dr_no'>DR No.</input>	
				<input type='checkbox' name='check_list[]' value='country'>Country</input>	
				<input type='checkbox' name='check_list[]' value='rsn'>RSN</input>	
				<input type='checkbox' name='check_list[]' value='validity_date'>Validity Date</input>	
				
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
				$sql = "SELECT * from Biological";
				$result = $conn->query($sql);
				
				while($row = mysqli_fetch_array($result)){
					echo "<tr><td>";
					echo '<a href="../view/view-bio-prod.php?id='.$row['id'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						echo' | <a href="../edit/edit-bio-prod.php?id='.$row['id'].'">edit</a>
						| <a href="../delete/delete-bio-prod.php?id='.$row['id'].'">delete</a></td>';
					}
					foreach($_POST['check_list'] as $rowVal){
						echo "<td>" . $row[$rowVal] . "</td>";
					}
					echo "</tr>";
				}
				
				echo "</table>";		
				
				mysqli_close($conn);
			}

			
		//	require("connect.php");
		
		//	$query = mysql_query("SELECT * from users;");
				
		} else {
			echo "$form";
		}
		
		
	
	?>



</body>

</html>

