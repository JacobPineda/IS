<?php

$server = "127.0.0.1:3307";
$user = "root";
$password_db = "";
$db = "report_analytics_portal_db";

$conn = mysqli_connect($server, $user, $password_db, $db);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>