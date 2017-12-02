<?php
session_start();
//check whether an admin is logged in
if ($_SESSION['isLoggedIn'] == false){
	echo '<a href="/IS/login.php">Login as admin</a>';
}else{
	echo '<a href="/IS/logout.php">Log out</a>'
;}

?>

	<link href="/IS/css/topnav.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/IS/semantic-ui/semantic.min.css">
	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="naonymous"></script>
	<script src="/IS/semantic-ui/semantic.min.js"></script>

  <style>
  .ui.inverted.menu {
    background: #471c01;
  }
  </style>

<!-- nav bar -->

<div class="ui fixed inverted menu">
  <div class="ui container">
    <a href="/IS/home.php" class="header item">
      <i class="industry icon"></i>
      Report Analytics Portal 
    </a>
    <a href="/IS/home.php" class="item">Home</a>
    <div class="ui simple dropdown item">
      Lists <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item" href="/IS/list/importer.php">Importers</a>
        <a class="item" href="/IS/list/importer.php">Manufacturers</a>
        <a class="item" href="/IS/list/trader.php">Traders</a>
        <a class="item" href="/IS/list/distributor.php">Distributors</a>
        <a class="item" href="/IS/list/course.php">Courses</a>
        <a class="item" href="/IS/list/student.php">Students</a>
        <a class="item" href="/IS/list/grade_level.php">Grade Levels</a>
        <a class="item" href="/IS/list/enrollment.php">Enrollments</a>
      </div>
    </div>
    <a href="/IS/reports/drug.php" class="item">Drug</a>
    <a href="/IS/reports/food.php" class="item">Food</a>
    <a href="/IS/reports/school.php" class="item">School</a>
    <a href="/IS/reports/pub_elem_school.php" class="item">Public Elementary School</a>
    <?php if ($_SESSION['isLoggedIn'] == false){ ?>
      <a href="/IS/login.php" class="right item">
        <i class="sign in icon"></i>Login as admin</a>
    <?php }else{ ?>
      <a href="/IS/logout.php" class="right item">
         <i class="sign out icon"></i>Log out</a>
    <?php;}?>
  </div>
</div>

