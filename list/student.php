<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
if($_SESSION['table'] != 'Student'){
	$_SESSION['page'] = 1;
}
$_SESSION['table'] = 'Student';
?>



<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
	<link href="/IS/css/topnav.css" rel="stylesheet">
	<link href="/IS/css/styles.css" rel="stylesheet">
	<script type="text/javascript" src="/IS/js/jquery.min.js"></script>


<title>Student</title>

</head>


<body>

	<?php
		include("../topnav.php");

		//check if logged in
		if($_SESSION['isLoggedIn'] == true){
			echo "<p> <a href='create/create-student.php'>Create</a><p>";
		}

		/*
		*generate table based from selected columns
		*offset - number of last record displayed
		*/
		function generateTable($offset){

				include('../connect.php');
				//get total number of record
				$totalSql = "SELECT count(*) as total_no from Student";
				$totalResult = $conn->query($totalSql);
				$totalRow = mysqli_fetch_array($totalResult);
				$total_no = $totalRow['total_no'];
				$noOfPages = ceil($total_no/20);

				//display prev and next button based on the current page
				$prev = ($_SESSION['page'] > 1)?
					"<td> <form action='student.php' method='post'><input type='submit' name='prev_table' value='prev'/></form></td>": null;
				$next = ($_SESSION['page'] < $noOfPages)? "<td> <form action='student.php' method='post'><input type='submit' name='next_table' value='next'/></form></td>" : null;

				//table to be generated
				$table = "<br/><center><table><tr> {$prev} <td>	Total no. of records: {$total_no}</td>  {$next} </tr></table></center>
					<center><table border='1'><tr><th>no.</th><th>action</th><th>student_id</th><th>school</th><th>course</th><th>student_name</th>
					<th>birthdate</th><th>gender</th><th>contact</th><th>address</th>
					</tr>";

				//get number of first record to be displayed
				$counter = $offset - 20;
				$sql = "SELECT * from Student ORDER BY student_id ASC LIMIT 20 OFFSET {$counter}";
				$result = $conn->query($sql);
				
				//add action column to the table, i.e., view, edit, and delete actions
				while($row = mysqli_fetch_array($result)){
					$counter++;
					$table .= "<tr><td>{$counter}</td><td>";
					$table .= '<a href="view/view-student.php?id='.$row['student_id'].'">view</a>';
					if($_SESSION['isLoggedIn'] == true){
						$table .=' | <a href="edit/edit-student.php?id='.$row['student_id'].'">edit</a>
						| <a href="delete/delete-student.php?id='.$row['student_id'].'">delete</a></td>';
					}

					$scSql = "SELECT name from School where school_id = '{$row['school_id']}'";
					$school = mysqli_fetch_array($conn->query($scSql))['name'];	
					
					$cSql = "SELECT course_name from Course where course_id = '{$row['course_id']}'";
					$course = mysqli_fetch_array($conn->query($cSql))['course_name'];	
					
					$table .= "<td>" . $row['student_id'] . "</td>	
					<td>$school</td><td>$course</td>
					<td>".$row['student_name']."</td><td>".$row['birthdate']."</td><td>".$row['gender']."</td>
					<td>".$row['contact']."</td><td>".$row['address']."</td></tr>
					";
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



</body>

</html>
