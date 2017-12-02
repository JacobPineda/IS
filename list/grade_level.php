<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['table'] != 'Grade Level'){
	$_SESSION['page'] = 1;
}
$_SESSION['table'] = 'Grade Level';
?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">
	<link href="/IS/css/styles.css" rel="stylesheet">
	<script type="text/javascript" src="/IS/js/jquery.min.js"></script>


<title>Trader</title>

</head>


<body>

    <?php
   include("../topnav.php");
	?>
   	 <div class="pusher">
        <div class="ui centered text container">
            <h1 class="ui center aligned header"><i class="list layout icon"></i>GRADE LEVEL LIST</h1>
    <?php		

       //check if logged in
       if($_SESSION['isLoggedIn'] == true){
       echo "<a href='create/create-grade_level.php' class='fluid ui primary button'>Create New Entry</a>";
       }
		/*
		*generate table based from selected columns
		*offset - number of last record displayed
		*/
		function generateTable($offset){

				include('../connect.php');
				//get total number of record
				$totalSql = "SELECT count(*) as total_no from Grade_Level";
				$totalResult = $conn->query($totalSql);
				$totalRow = mysqli_fetch_array($totalResult);
				$total_no = $totalRow['total_no'];
				$noOfPages = ceil($total_no/20);
				
				//display prev and next button based on the current page
				$prev = ($_SESSION['page'] > 1)?
					"<td> <form action='trader.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='trader.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;

				//table to be generated
				$table = "<br/><center><table><tr> {$prev} <td>	Total no. of records: {$total_no}</td>  {$next} </tr></table></center>
					<center><table border='1'><tr><th>no.</th><th>action</th><th>name</th>
					</tr>";
		$table = "<div class='ui center aligned container'>{$prev} Total no. of records: {$total_no}  {$next}</div>
					<table class='ui celled table'>
						<thead>
							<tr><th>No.</th>
							    <th>Action</th>
							    <th>Level Name</th>
					  		</tr></thead>
					";

				//get number of first record to be displayed
				$counter = $offset - 20;
				//$sql = "SELECT * from Drug WHERE cpr_no NOT IN ('0') ORDER BY cpr_no ASC LIMIT 10 OFFSET {$counter} ";
				$sql = "SELECT * from Grade_Level ORDER BY level_id ASC LIMIT 20 OFFSET {$counter}";
				$result = $conn->query($sql);

				//add action column to the table, i.e., view, edit, and delete actions
				while($row = mysqli_fetch_array($result)){
					$counter++;
					$table .= "<tr><td>{$counter}</td><td>";
					$table .= '<a href="view/view-grade_level.php?id='.$row['level_id'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						$table .=' | <a href="edit/edit-grade_level.php?id='.$row['level_id'].'">edit</a>
						| <a href="delete/delete-grade_level.php?id='.$row['level_id'].'">delete</a></td>';
					}
					$table .= "<td>" . $row['level_name'] . "</td></tr>";
				}
				$table .= "</table>";

				mysqli_close($conn);
				return $table;
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
                <br>
                <br>
        </div>
    </div>



</body>

</html>
