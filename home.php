<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>


<!DOCTYPE html>

<html>
<head>
<title>Home</title>
</head>
<link   href="css/sidenav.css" rel="stylesheet">


<body>

<!--<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>-->

<?php
	include("sidenav.php");

	if ($_SESSION['isLoggedIn'] == false){
		echo '<a href="/IS/login.php">Login as admin</a>';
	}else{
		echo '<a href="/IS/logout.php">Log out</a>';
	}

?>
</body>

</html>

