<?php
session_start();
//setting header to json
header('Content-Type: application/json');
include("../connect.php");

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

//free memory associated with result
$result->close();

//close connection
$conn->close();

//now print the data
print json_encode($data);