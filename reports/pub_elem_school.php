<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['table'] != 'Public_Elementary_School'){
	$_SESSION['page'] = 1;
	$_SESSION['arrCheckedVals'] = null;
}
$_SESSION['table'] = 'Public_Elementary_School';
$_SESSION['graph_type'] = null;
?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">
	<link href="/IS/css/styles.css" rel="stylesheet">
	<script type="text/javascript" src="/IS/js/jquery.min.js"></script>
	<script type="text/javascript" src="/IS/js/Chart.min.js"></script>
	<?php
	function setGraphScript(){
		switch($_SESSION['selected_report']){
			case 'default':
				$path= '/IS/js/generate_graph.js';
				break;
			case 'no_of_school_region':
				$path= '/IS/js/preconf_graphs/no_of_school_region.js';
				break;
			case 'no_of_student_public_elem_school':
				$path= '/IS/js/preconf_graphs/no_of_student_public_elem_school.js';
				break;
			case 'no_of_student_grade_level':
				$path= '/IS/js/preconf_graphs/no_of_student_grade_level.js';
				break;
			default:
				$path= '/IS/js/generate_graph.js';
				break;
		}

		return "<script type='text/javascript' src='{$path}'></script>";
	}
	echo setGraphScript();
	?>

<title>Public Elementary School Report</title>

</head>


<body>

    <?php
   include("../topnav.php");
	?>
   	 <div class="pusher">
        <div class="ui centered container">
            <h1 class="ui center aligned header"><i class="pie chart  icon"></i>Public Elementary School Report</h1>
    <?php		
       //check if logged in
       if($_SESSION['isLoggedIn'] == true){
       echo "<a href='../create/create-pub_elem_school.php' class='fluid ui primary button'>Create New Entry</a>";
       }
		//list of displayed column names and ids/db column name
		$arrColValues = array('elementary_school_id', 'region_id', 'school_name');
		$arrColLabels = array('Elementary School ID', 'Region','School Name');

		/*
		*generate form/ selection of columns
		*arrColValues - list of db column name
		*arrColLabels - list of column labels to be displayed
		*/
		function generateForm($arrColValues, $arrColLabels){
			$form="<center><div> <form action='pub_elem_school.php' method='post'>";

			for($i = 0; $i < count($arrColValues); $i++){
				for($j = 0; $j < count($_SESSION['arrCheckedVals']); $j++){
					if($_SESSION['arrCheckedVals'][$j] == $arrColValues[$i]){
						$isChecked = 'checked';
						break;
					}else{
						$isChecked = null;
					}
				}
				$form .= "<div class='ui checkbox'><input type='checkbox' name='check_list[]' value='{$arrColValues[$i]}' id='cbox_columns' $isChecked><label>{$arrColLabels[$i]}</label></input></div>";
			}
			$form .= " <input type='submit' name='generate' value='Generate'/></form></div></center>";
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
				$totalSql = "SELECT count(*) as total_no from Public_Elementary_School";
				$totalResult = $conn->query($totalSql);
				$totalRow = mysqli_fetch_array($totalResult);
				$total_no = ($arrCheckBox)? $totalRow['total_no']: 0;

				//get number of pages
				$noOfPages = ceil($total_no/10);
				if($noOfPages < $_SESSION['page']){
					$_SESSION['page'] = 1;
				}

				//display prev and next button based on the current page
				$prev = ($_SESSION['page'] > 1)?
					"<td> <form action='pub_elem_school.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='pub_elem_school.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;

				//table to be generated
				$table = "<div class='ui center aligned container'>{$prev} Total no. of records: {$total_no}  {$next}</div>";
				$table .= "<table class='ui celled table'>
							<thead>
								<tr><th>No.</th>
								    <th>Action</th>";
				foreach($arrCheckBox as $check) {
					$table .= "<th>$check</th>";
				}
				$table .= "</tr></thead>";

				//get number of first record to be displayed
				$counter = $offset - 10;
				$sql = "SELECT elementary_school_id
				,(select region_name from Region where region_id = s.region_id) as region_id
				, school_name
				From Public_Elementary_School s ORDER BY elementary_school_id ASC LIMIT 10 OFFSET {$counter}";
				$result = $conn->query($sql);

				//add action column to the table, i.e., view, edit, and delete actions
				while($row = mysqli_fetch_array($result)){
					$counter++;
					$table .= "<tr><td>{$counter}</td><td>";
					$table .= '<a href="../view/view-pub_elem_school.php?id='.$row['elementary_school_id'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						$table .=' | <a href="../edit/edit-pub_elem_school.php?id='.$row['elementary_school_id'].'">edit</a>
						| <a href="../delete/delete-pub_elem_school.php?id='.$row['elementary_school_id'].'">delete</a></td>';
					}
					foreach($arrCheckBox as $rowVal){
						$table .= "<td>" . $row[$rowVal] . "</td>";
					}
					$table .= "</tr>";
				}
				$table .= "</table>";

				mysqli_close($conn);
				return $table;
		}
		/*
		*generate graph based from selected columns
		*graph_type - type of graph to be displayed
		*/
		function generateGraph($graph_type){
			 $graph = "<br><br><br><form action='pub_elem_school.php' method='post'>
				<input type='submit' name='bar' value='Bar'/>
				<input type='submit' name='line' value='Line'/>
				<input type='submit' name='doughnut' value='Doughnut'/>
				<input type='submit' name='radar' value='Radar'/>
				<input type='submit' name='polarArea' value='Polar Area'/>
				<br></center><br><canvas id='{$graph_type}'></canvas></form>";
			 return $graph;
		}


		/*
		*generate graph based from selected columns
		*graph_type - type of graph to be displayed
		*/
		function generateAdHocReports(){
			$options = "<br><br><br><center><form action='pub_elem_school.php' method='post'>
				<p>Pre-Configured Reports</p>
				<table>
				<tr>
					<td><input type='submit' name='no_of_school_region' value='Number of schools per region'/></td>
					<td><input type='submit' name='no_of_student_public_elem_school' value='Number of Students per PES'/> </td>
					<td><input type='submit' name='no_of_student_grade_level' value='Number of Student per Grade Level'/> </td>
				</table>
				</form></center>";
			 return $options;
		}

		//when form is submitted/or generate table
		if($_POST['generate']){

			//set list of selected columns to the session variable so that checkboxes will remain checked after submitting the form
			$_SESSION['arrCheckedVals'] = $_POST['check_list'];
			$_SESSION['selected_report'] = 'default';
			echo generateForm($arrColValues, $arrColLabels);


			$arrCheckBox = $_POST['check_list'];

			if($arrCheckBox){
				//number of records will be displayed at most 10 each page
				$offset = $_SESSION['page'] * 10;
				$_SESSION['selected_report'] = 'default';
				echo setGraphScript();
				echo generateTable($arrCheckBox,$offset);
				echo generateGraph('bar_graph');
				echo generateAdHocReports();

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
			echo generateGraph('bar_graph');
			echo generateAdHocReports();
		}
		//if previous page is selected
		if($_POST['prev_table']){
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$_SESSION['page']--;
			$offset = $_SESSION['page'] * 10;
			echo generateTable($arrCheckBox,$offset);
			echo generateGraph('bar_graph');
			echo generateAdHocReports();
		}

		//if a graph is selected
		if($_POST['bar'] || $_POST['line'] || $_POST['doughnut'] || $_POST['radar'] || $_POST['polarArea']){
			$graphType = 'bar_graph';
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$offset = $_SESSION['page'] * 10;
			if($_POST['bar']){
				$_SESSION['graph_type'] = 'bar_graph';
				$graphType = 'bar_graph';
			}
			if($_POST['line']){
				$_SESSION['graph_type'] = 'line_graph';
				$graphType = 'line_graph';
			}
			if($_POST['doughnut']){
				$_SESSION['graph_type'] = 'doughnut_graph';
				$graphType = 'doughnut_graph';
			}
			if($_POST['radar']){
				$_SESSION['graph_type'] = 'radar_graph';
				$graphType = 'radar_graph';
			}
			if($_POST['polarArea']){
				$_SESSION['graph_type'] = 'polarArea_graph';
				$graphType = 'polarArea_graph';
			}
			echo generateTable($arrCheckBox,$offset);
			echo generateGraph($graphType);
			echo generateAdHocReports();
		}

		//if a preconfigured report is selected
		if($_POST['no_of_school_region'] || $_POST['no_of_student_public_elem_school'] || $_POST['no_of_student_grade_level']){
			$graphType = 'bar_graph';
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$offset = $_SESSION['page'] * 10;

			if($_POST['no_of_school_region']){
				$_SESSION['selected_report'] = 'no_of_school_region';
				$graphType = 'radar_graph';
			}
			if($_POST['no_of_student_public_elem_school']){
				$_SESSION['selected_report'] = 'no_of_student_public_elem_school';
				$graphType = 'radar_graph';
			}
			if($_POST['no_of_student_grade_level']){
				$_SESSION['selected_report'] = 'no_of_student_grade_level';
				$graphType = 'radar_graph';
			}

			echo setGraphScript();
			echo generateTable($arrCheckBox,$offset);
			echo generateGraph($graphType);
			echo generateAdHocReports();

		}


	?>


                <br>
                <br>
        </div>
    </div>

</body>

</html>
