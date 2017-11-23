<?php
session_start();
//setting header to json
header('Content-Type: application/json');
include("../connect.php");


function isNotFromTable($columnName){
	
	$arrColsNotFromTable = array('manufacturer', 'importer', 'trader', 'distributor');
	
	foreach($arrColsNotFromTable  as $i){
		if($i == $columnName){
			return true;
		}
	}
	return false;
	
}

function generateQryforOtherTables(){
	
	$column = '';
	
	switch($column){
		case '':

		default:
			return null;
	}
	
}



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
		$remainingCols .= (!isNotFromTable($_SESSION['arrCheckedVals'][$i]))? ",count(*) -1 -  sum(case when {$_SESSION['arrCheckedVals'][$i]} is null then 1 else 0 end) as {$_SESSION['arrCheckedVals'][$i]}" : null;
	}

	$query = sprintf("SELECT '{$asColumns}' as columns,  count(*) - 1 as 'Total records' {$remainingCols}, (select count( distinct drug_cpr_no) - 1 from manufactures where drug_cpr_no in (select cpr_no from drug)) as manufacturer FROM {$_SESSION['table']} ");
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
	
	$query = sprintf("SELECT country, count(*) as total FROM {$_SESSION['table']} where cpr_no not in ('0') GROUP BY country");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
		
}

function generate_no_of_generic_name($conn){
	
	$query = sprintf("SELECT generic_name, count(*) as total FROM {$_SESSION['table']} where cpr_no not in ('0') GROUP BY generic_name ");
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
	case 'no_of_generic_name':
		$data = generate_no_of_generic_name($conn);
		break;		
		
		
	default: 
		$data = generateDefaultResult($conn);
		break;

}



$conn->close();
print json_encode($data);