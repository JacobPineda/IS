<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
$_SESSION['isLoggedIn'] = false;
header("Location: home.php");
?>
