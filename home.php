<?php

error_reporting (E_ALL ^ E_NOTICE);
session_start();
/*
*Setting up session variables
*arrCheckedVals - contains all values of selected columns in each industry
*page - current page of the generated table
*/

$_SESSION['arrCheckedVals'] =  null;
$_SESSION['page'] = 1;

?>


<!DOCTYPE html>

<html>
<head>
<title>Home</title>
</head>
	<link   href="/IS/css/topnav.css" rel="stylesheet">

<body>

<!--<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>-->

<?php
	include("topnav.php");

?>

</body>

</html>

