<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['table'] != 'Drug'){
	$_SESSION['page'] = 1;
	$_SESSION['arrCheckedVals'] = null;
}
$_SESSION['table'] = 'Drug';
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
			case 'no_of_prod_country':
				$path= '/IS/js/preconf_graphs/no_of_prod_country.js';
				break;
			case 'no_of_generic_name':
				$path= '/IS/js/preconf_graphs/no_of_generic_name.js';
				break;
			case 'no_of_branded_prod':
				$path= '/IS/js/preconf_graphs/no_of_branded_prod.js';
				break;
			case 'no_of_manufacturer':
				$path= '/IS/js/preconf_graphs/no_of_drug_food_entities.js';
				break;
			case 'no_of_importer':
				$path= '/IS/js/preconf_graphs/no_of_drug_food_entities.js';
				break;
			case 'no_of_trader':
				$path= '/IS/js/preconf_graphs/no_of_drug_food_entities.js';
				break;
			case 'no_of_distributor':
				$path= '/IS/js/preconf_graphs/no_of_drug_food_entities.js';
				break;
			default:
				$path= '/IS/js/generate_graph.js';
				break;
		}

		return "<script type='text/javascript' src='{$path}'></script>";
	}
	echo setGraphScript();
	?>

<title>Drug Products Report</title>

</head>


<body>

    <?php
   include("../topnav.php");
	?>
   	 <div class="pusher">
        <div class="ui centered container">
            <h1 class="ui center aligned header"><i class="pie chart icon"></i>DRUG PRODUCTS REPORT</h1>
    <?php		

       //check if logged in
       if($_SESSION['isLoggedIn'] == true){
       echo "<a href='../create/create-drug.php' class='fluid ui primary button'>Create New Entry</a>";
       }
		//list of displayed column names and ids/db column name
		$arrColValues = array('cpr_no','dr_no','country','rsn','validity_date','generic_name','brand_name','strength','form','manufacturer', 'importer','trader','distributor');
		$arrColLabels = array('CPR No.','DR No.','Country','RSN','Validity Date','Generic Name','Brand Name','Strength','Form','Manufacturer', 'Importer','Trader','Distributor');

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
				$totalSql = "SELECT count(*) as total_no from Drug WHERE cpr_no NOT IN ('0')";
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
					"<td> <form action='drug.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='drug.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;

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
				$sql = "SELECT cpr_no,dr_no,country,rsn,validity_date,generic_name,brand_name,strength,form
				,(select name from Manufacturer where manu_no = (select manu_no from Manufactures where drug_cpr_no = d.cpr_no LIMIT 1)) as manufacturer
				,(select name from Importer where importer_no = (select importer_no from Imports where drug_cpr_no = d.cpr_no LIMIT 1)) as importer
				,(select name from Trader where trader_no = (select trader_no from Trades where drug_cpr_no = d.cpr_no LIMIT 1)) as trader
				,(select name from Distributor where dist_no = (select dist_no from Distributes where drug_cpr_no = d.cpr_no LIMIT 1)) as distributor
				From Drug d where cpr_no <> '0' ORDER BY cpr_no ASC LIMIT 10 OFFSET {$counter}";
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
				$table .= "</table>";

				mysqli_close($conn);
				return $table;
		}
		/*
		*generate graph based from selected columns
		*graph_type - type of graph to be displayed
		*/
		function generateGraph($graph_type){
			 $graph = "<br><br><br><form action='drug.php' method='post'>
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
			$options = "<br><br><br><center><form action='drug.php' method='post'>
				<p>Pre-Configured Reports</p>
				<table>
				<tr>
					<td><input type='submit' name='no_of_prod_country' value='Number of products per country'/></td>
					<td><input type='submit' name='no_of_generic_name' value='Number of Generic Names'/> </td>
					<td><input type='submit' name='no_of_branded_prod' value='Number of Branded Drug'/> </td>
				</tr>
				<tr>
					<td><input type='submit' name='no_of_manufacturer' value='Number of Manufacturers'/></td>
					<td><input type='submit' name='no_of_importer' value='Number of Importers'/></td>
					<td><input type='submit' name='no_of_trader' value='Number of Traders'/></td>
					<td><input type='submit' name='no_of_distributor' value='Number of Distributors'/></td>
				</tr>
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
		if($_POST['no_of_prod_country'] || $_POST['no_of_generic_name'] || $_POST['no_of_branded_prod']
				|| $_POST['no_of_manufacturer'] || $_POST['no_of_importer'] || $_POST['no_of_trader'] || $_POST['no_of_distributor'] ){
			$graphType = 'bar_graph';
			$arrCheckBox = $_SESSION['arrCheckedVals'];
			$offset = $_SESSION['page'] * 10;

			if($_POST['no_of_prod_country']){
				$_SESSION['selected_report'] = 'no_of_prod_country';
				$graphType = 'bar_graph';
			}
			if($_POST['no_of_generic_name']){
				$_SESSION['selected_report'] = 'no_of_generic_name';
				$graphType = 'radar_graph';
			}
			if($_POST['no_of_branded_prod']){
				$_SESSION['selected_report'] = 'no_of_branded_prod';
				$graphType = 'radar_graph';
			}
			if($_POST['no_of_manufacturer']){
				$_SESSION['selected_report'] = 'no_of_manufacturer';
				$graphType = 'bar_graph';
			}
			if($_POST['no_of_importer']){
				$_SESSION['selected_report'] = 'no_of_importer';
				$graphType = 'radar_graph';
			}
			if($_POST['no_of_trader']){
				$_SESSION['selected_report'] = 'no_of_trader';
				$graphType = 'polarArea_graph';
			}
			if($_POST['no_of_distributor']){
				$_SESSION['selected_report'] = 'no_of_distributor';
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
