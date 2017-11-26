<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$_SESSION['table'] = 'Distributor';
?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">
	<link href="/IS/css/styles.css" rel="stylesheet">
	<script type="text/javascript" src="/IS/js/jquery.min.js"></script>


<title>Importer</title>

</head>


<body>

	<?php
		include("../topnav.php");

		//check if logged in
		if($_SESSION['isLoggedIn'] == true){
			echo "<p> <a href='create/create-distributor.php' >Create</a><p>";
		}

		function getPage($conn){
			//get total number of record
			$totalSql = "SELECT count(*) as total_no from Distributor";
			$totalResult = $conn->query($totalSql);
			$totalRow = mysqli_fetch_array($totalResult);
			$total_no = $totalRow['total_no'];

			//get number of pages
			return $total_no ;

		}

		/*
		*generate table based from selected columns
		*offset - number of last record displayed
		*/
		function generateTable($offset){

				include('../connect.php');

				$total_no = getPage($conn);
				$noOfPages = ceil($total_no/20);

				if($noOfPages < $_SESSION['page']){
					$_SESSION['page'] = 1;
				}

				//display prev and next button based on the current page
				$prev = ($_SESSION['page'] > 1)?
					"<td> <form action='distributor.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='distributor.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;

				//table to be generated
				$table = "<br/><center><table><tr> {$prev} <td>	Total no. of records: {$total_no}</td>  {$next} </tr></table></center>
					<center><table border='1'><tr><th>no.</th><th>action</th><th>name</th>
					</tr>";

				//get number of first record to be displayed
				$counter = $offset - 20;
				//$sql = "SELECT * from Drug WHERE cpr_no NOT IN ('0') ORDER BY cpr_no ASC LIMIT 10 OFFSET {$counter} ";
				$sql = "SELECT * from Distributor ORDER BY dist_no ASC LIMIT 20 OFFSET {$counter}";
				$result = $conn->query($sql);

				//add action column to the table, i.e., view, edit, and delete actions
				while($row = mysqli_fetch_array($result)){
					$counter++;
					$table .= "<tr><td>{$counter}</td><td>";
					$table .= '<a href="view/view-distributor.php?id='.$row['dist_no'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						$table .=' | <a href="edit/edit-distributor.php?id='.$row['dist_no'].'">edit</a>
						| <a href="delete/delete-distributor.php?id='.$row['dist_no'].'">delete</a></td>';
					}
					$table .= "<td>" . $row['name'] . "</td></tr>";
				}
				$table .= "</table>";

				mysqli_close($conn);
				return $table;
		}
		include('../connect.php');
		$total_no = getPage($conn);
		$noOfPages = ceil($total_no/20);
		if($noOfPages < $_SESSION['page']){
			$_SESSION['page'] = 1;
		}

    if($_POST['next_table'] || $_POST['prev_table']){
		if($_POST['next_table']){
			$_SESSION['page'] ++;
		}
		if($_POST['prev_table']){
			$_SESSION['page'] --;
		}
		$offset = $_SESSION['page'] * 20;

		echo generateTable($offset);
    }else{
		$offset = $_SESSION['page'] * 20;
		echo generateTable($offset);
	}
	?>



</body>

</html>
