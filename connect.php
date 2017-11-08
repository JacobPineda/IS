<?php

$server = "127.0.0.1:3307";
$user = "root";
$password_db = "";
$db = "is_db";

$conn = mysqli_connect($server, $user, $password_db, $db);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>