<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

?>



<!DOCTYPE html>

<html>
<head>
<title>Login</title>
</head>
	<link   href="/IS/css/topnav.css" rel="stylesheet">

<body>
	<?php	
		include("topnav.php");
		
		$form="
			<center><div>
			<form action='login.php' method='post'>
				<table>
					<tr>
						<td>Username:</td>
						<td><input type='text' name='username' required/></td>				
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type='password' name='password' required/></td>				
					</tr>
						<td></td>
					<tr>
						<td></td>
						<td><input type='submit' name='login_btn' value='Login'/></td>
						<td><a class='btn' href='/IS/home.php'>Back</a></td>
						<td></td>
					</tr>
				</table>
			</form>
		</div></center>";
		
		if($_POST['login_btn']){
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$password = md5($password);	
			echo "$form";
			
			include('connect.php');
			$sql = "SELECT * from Admin WHERE username = '{$username}' AND password = '{$password}'";
			$result = $conn->query($sql);
			if (!$result->num_rows == 1) {
				echo "<p>Invalid username/password combination</p>";
			} else {
				echo "<p>Logged in successfully</p>";
				$_SESSION['isLoggedIn'] = true;
				header("Location: home.php");
			}


			mysqli_close($conn);
			
			
			
			
			
			
		//	require("connect.php");
		
		//	$query = mysql_query("SELECT * from users;");
				
		} else {
			echo "$form";
		}
		
		
	
	?>



</body>

</html>

