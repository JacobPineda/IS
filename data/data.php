<?php
session_start();
//setting header to json
header('Content-Type: application/json');
include("../connect.php");

/*
*generate default result 
*conn - MySQL connection
*/
function generateDefaultResult($conn){
	$asColumns = "Total records";
	for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
		$asColumns .= ",{$_SESSION['arrCheckedVals'][$i]}";
	}
	
	$remainingCols = "";
	for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
		$remainingCols .= ",count(*) -1 -  sum(case when {$_SESSION['arrCheckedVals'][$i]} is null then 1 else 0 end) as {$_SESSION['arrCheckedVals'][$i]}";
	}

	$query = sprintf("SELECT '{$asColumns}' as columns,  count(*) - 1 as 'Total records' {$remainingCols} FROM {$_SESSION['table']} ");
	$result = $conn->query($query);
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	$data[] = (object) array('tableName' => $_SESSION['table']);
	$result->close();
	
	return $data;
}


function generate_Drug_vs_Country($conn){
	
	$query = sprintf("SELECT country, count(*) as total FROM {$_SESSION['table']} GROUP BY country");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
		
}

switch($_SESSION['selected_report']){
	case 'default': 
		$data = generateDefaultResult($conn);
		break;
	case 'no_of_drug_country':
		$data = generate_Drug_vs_Country($conn);
		break;		
		
	default: 
		$data = generateDefaultResult($conn);
		break;

}



$conn->close();
print json_encode($data);