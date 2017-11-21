<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">		
	<script type="text/javascript" src="/IS/js/jquery.min.js"></script>
	<script type="text/javascript" src="/IS/js/Chart.min.js"></script>
	<script type="text/javascript" src="/IS/js/generate_graph.js"></script>
<title>Drug Products Report</title>

</head>


<body>

	<?php	
		include("../topnav.php");
		
		//check if logged in
		if($_SESSION['isLoggedIn'] == true){
			echo "<p> <a href='../create/create-drug.php' >Create</a><p>";
		} 
				
		//list of displayed column names and ids/db column name
		$arrColValues = array('industry_id','cpr_no','dr_no','country','rsn','validity_date','generic_name','brand_name','strength','form','manufacturers');
		$arrColLabels = array('Industry ID','CPR No.','DR No.','Country','RSN','Validity Date','Generic Name','Brand Name','Strength','Form','Manufacturers');
		
		/*
		*generate form/ selection of columns
		*arrColValues - list of db column name
		*arrColLabels - list of column labels to be displayed
		*/
		function generateForm($arrColValues, $arrColLabels){
			$form="<center><div> <form action='drug.php' method='post'>";
			
			for($i = 0; $i < count($arrColValues); $i++){
				for($j = 0; $j < count($_SESSION['arrCheckedVals']); $j++){
					if($_SESSION['arrCheckedVals'][$j] == $arrColValues[$i]){
						$isChecked = 'checked';
						break;
					}else{						
						$isChecked = null;
					}
				}				
				$form .= "<input type='checkbox' name='check_list[]' value='{$arrColValues[$i]}' $isChecked>{$arrColLabels[$i]}</input>";
			}
			$form .= " <input type='submit' name='generate' value='Generate'/></form></div></center>
			";
			return $form;
		}
		
		/*
		*generate table based from selected columns
		*arrCheckBox - list of selected columns
		*offset - number of last record displayed
		*/
		function generateTable($arrCheckBox, $offset){
			
				include('../connect.php');
				
				//get total number of record
				$totalSql = "SELECT count(*) as total_no from Drug WHERE cpr_no NOT IN ('0')";
				$totalResult = $conn->query($totalSql);
				$totalRow = mysqli_fetch_array($totalResult);		
				$total_no = ($arrCheckBox)? $totalRow['total_no']: 0;	

				//get number of pages
				$noOfPages = ceil($total_no/10);
				
				//display prev and next button based on the current page
				$prev = ($_SESSION['page'] > 1)?
					"<td> <form action='drug.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='drug.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;				
			
				//table to be generated
				$table = "<br/><center><table><tr> {$prev} <td>	Total no. of records: {$total_no}</td>  {$next} </tr></table></center>";
				$table .= "<center><table border='1'><tr><th>no.</th><th>action</th>";
				foreach($arrCheckBox as $check) {
					$table .= "<th>$check</th>";
				}
				$table .= "</tr>";
				
				//get number of first record to be displayed
				$counter = $offset - 10;
				$sql = "SELECT * from Drug WHERE cpr_no NOT IN ('0') LIMIT 10 OFFSET {$counter}";
				$result = $conn->query($sql);				
				
				//add action column to the table, i.e., view, edit, and delete actions
				while($row = mysqli_fetch_array($result)){
					$counter++;
					$table .= "<tr><td>{$counter}</td><td>";
					$table .= '<a href="../view/view-drug.php?cpr_no='.$row['cpr_no'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						$table .=' | <a href="../edit/edit-drug.php?cpr_no='.$row['cpr_no'].'">edit</a>
						| <a href="../delete/delete-drug.php?cpr_no='.$row['cpr_no'].'">delete</a></td>';
					}
					foreach($arrCheckBox as $rowVal){
						$table .= "<td>" . $row[$rowVal] . "</td>";
					}
					$table .= "</tr>";
				}
				
				$table .= "</table></center><br><canvas id='graph_canvas'></canvas>";	

				mysqli_close($conn);
				return $table;
		}
		
		
		//when form is submitted/or generate table
		if($_POST['generate']){
			
			//set list of selected columns to the session variable so that checkboxes will remain checked after submitting the form
			$_SESSION['arrCheckedVals'] = $_POST['check_list'];
			echo generateForm($arrColValues, $arrColLabels);
			
			
			$arrCheckBox = $_POST['check_list'];
			
			if($arrCheckBox){
				//number of records will be displayed at most 10 each page
				$offset = $_SESSION['page'] * 10;
				echo generateTable($arrCheckBox,$offset);
				
			}

			
		} else {
			echo generateForm($arrColValues, $arrColLabels);
		}
		
		//if next page is selected
		if($_POST['next_table']){
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$_SESSION['page'] ++;
			$offset = $_SESSION['page'] * 10;
			echo generateTable($arrCheckBox,$offset);
		}
		//if previous page is selected
		if($_POST['prev_table']){
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$_SESSION['page']--;
			$offset = $_SESSION['page'] * 10;
			echo generateTable($arrCheckBox,$offset);
		}
		
	
	?>



</body>

</html>

