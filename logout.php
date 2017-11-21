<?php
session_start();
//set isLoggedIn to false when logged out
$_SESSION['isLoggedIn'] = false;
header("Location: home.php");
?>