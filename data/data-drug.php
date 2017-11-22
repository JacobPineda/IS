<?php
session_start();
//setting header to json
header('Content-Type: application/json');
include("../connect.php");


function isNotFromDrug($value){

	$arrColsNotFromDrug = array('manufacturers');
	
	for($i = 0; $i < count($arrColsNotFromDrug); $i++){
		if($arrColsNotFromDrug[$i] == $value){
			return false;
		}
	}
	return true;
}



$asColumns = "Total records";
for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
	$asColumns .= (isNotFromDrug($_SESSION['arrCheckedVals'][$i]))? ",{$_SESSION['arrCheckedVals'][$i]}" : null;
}
$asColumns .= ",dummy";

$remainingCols = "";
for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
	$remainingCols .= (isNotFromDrug($_SESSION['arrCheckedVals'][$i]))? ",count(*) -1 -  sum(case when {$_SESSION['arrCheckedVals'][$i]} is null then 1 else 0 end) as {$_SESSION['arrCheckedVals'][$i]}" : null;
}

//query to get data from the table
$query = sprintf("SELECT '{$asColumns}' as columns,  count(*) - 1 as 'Total records' {$remainingCols}, 0 as 'dummy' FROM drug ");

//execute query
$result = $conn->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$conn->close();

//now print the data
print json_encode($data);