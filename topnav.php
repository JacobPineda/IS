<?php
session_start();
//check whether an admin is logged in
if ($_SESSION['isLoggedIn'] == false){
	echo '<a href="/IS/login.php">Login as admin</a>';
}else{
	echo '<a href="/IS/logout.php">Log out</a>';
}

//nav bar
echo "
<center><ul>
<li><a href='/IS/home.php'>Home</a>
	
</li>
 <li><a href=''>Lists &#9662</a>
	<ul class='dropdown'>
		<li><a href='/IS/list/importer.php'>Importers</a></li>
		<li><a href='/IS/list/manufacturer.php'>Manufacturers</a></li>
		<li><a href='/IS/list/trader.php'>Traders</a></li>
		<li><a href='/IS/list/distributor.php'>Distributors</a></li>
		<li><a href='/IS/list/course.php'>Courses</a></li>
		<li><a href='/IS/list/student.php'>Students</a></li>
		<li><a href='/IS/list/grade_level.php'>Grade Levels</a></li>
		<li><a href='/IS/list/enrollment.php'>Enrollments</a></li>
	</ul></li>
<li><a  href='/IS/reports/drug.php'>Drug</a></li>
<li><a  href='/IS/reports/food.php'>Food</a></li>
<li><a  href='/IS/reports/school.php'>School</a></li>
<li><a  href='/IS/reports/pub_elem_school.php'>Public Elementary School</a></li>
<li><a href='#'>About</a></li>
</ul></center>

";

?>
