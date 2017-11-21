<?php
//setting header to json
header('Content-Type: application/json');

//database

$server = "127.0.0.1:3306";
$user = "root";
$password_db = "";
$db = "report_analytics_portal_db";

$conn = mysqli_connect($server, $user, $password_db, $db);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


//query to get data from the table
$query = sprintf("SELECT 'Total records,cpr_no,country,dummy' as columns,  count(*) - 1 as 'Total records',  count(*) - 1 - sum(case when cpr_no is null then 1 else 0 end) as cpr_no, count(*) -1 -  sum(case when country is null then 1 else 0 end) as country, 0 as 'dummy' FROM drug ");

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