<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
/*
*isLoggedIn - true when an admin is logged in, else false
*/
$_SESSION['isLoggedIn'] = false;
//redirect to home page
header("Location: home.php");
?>
