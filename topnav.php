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
<!-- <li><a href=''>Industries &#9662</a>
	<ul class='dropdown'>
		<li><a href='/IS/reports/drug.php'>Drug</a></li>
		<li><a href=''>Food</a></li>
		<li><a href=''>School</a></li>
		<li><a href=''>Public Elementary School</a></li>
	</ul></li>-->
<li><a  href='/IS/reports/drug.php'>Drug</a></li>
<li><a  href='#'>Food</a></li>
<li><a  href='#'>School</a></li>
<li><a  href='#'>Public Elementary School</a></li>
<li><a href='#'>About</a></li>
</ul></center>

"

?>