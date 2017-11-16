<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">
<title>Drug Products Report</title>

</head>


<body>

	<?php	
		include("../topnav.php");
		
		if($_SESSION['isLoggedIn'] == true){
			echo "<p> <a href='../create/create-drug.php' >Create</a><p>";
		} 
		
		$form="<center><div> 
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
		</div></center>";
		
		$cols = "1";
			
		if($_POST['generate']){
			
			
			if (!empty($_GET['p'])) {
				$page = $_REQUEST['p'];
			} else {
				$page = 1;
			}
			echo "$form</br>";
			$arrCheckBox = $_POST['check_list'];
		//	$_SESSION['checked'] = $_POST['check_list'];
			
			include('../connect.php');
			$totalSql = "SELECT count(*) as total_no from Drug WHERE cpr_no NOT IN ('0')";
			$totalResult = $conn->query($totalSql);
			$totalRow = mysqli_fetch_array($totalResult);		
			$total_no = ($arrCheckBox)? $totalRow['total_no']: 0;
			
			$noOfPages = ceil($total_no/10);
			$page_sub = $page - 1;			
			$page_add = $page + 1;
			
			$prev = ($page > 1)? "<td><a href='drug.php?p={$page_sub}'>prev</a></td>": null;
			$next = ($page < $noOfPages)? "<td><a href='drug.php?p={$page_add}'>next</a></td>" : null;
				
			echo "<center><table><tr> {$prev} <td>	Total no. of records: {$total_no}</td>  {$next} </tr></table></center>";
			
			if($arrCheckBox){
				
				$offset = $page * 10;
				
				echo "<center><table border='1'><tr><th>no.</th><th>action</th>";
				foreach($arrCheckBox as $check) {
					$cols = "$cols,$check"; 
					echo "<th>$check</th>";
				}
				echo "</tr>";
				
				
				$totalSql = "SELECT count(*) as total_no from Drug WHERE cpr_no NOT IN ('0')"; 
				$totalResult = $conn->query($totalSql);
				$totalRow = mysqli_fetch_array($totalResult);		
				$total_no = $totalRow['total_no'];
			
				$sql = "SELECT * from Drug WHERE cpr_no NOT IN ('0') LIMIT 10 OFFSET {$offset}";
				$result = $conn->query($sql);
				
				$counter = 0;
				while($row = mysqli_fetch_array($result)){
					$counter++;
					echo "<tr><td>{$counter}</td><td>";
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
				
				echo "</table></center>";		
				
				mysqli_close($conn);
			}

			
		} else {
			echo "$form";
		}
		
		
	
	?>



</body>

</html>

