
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet"  href="login.css">
</head>
<body>
<div class="login-box">

	<?php 
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan']) {
				echo "<div class='alert'>username dan password tidak sesuai</div>";
			}
		}

	 ?>
		
		<h2>Log In </h2>
		
		<form class="box" action="cek_login.php" method="post">
		
			<p>Username</p>
			<i class="fa fa-user" aria-hidden="true"></i>
			<input type="text" name="username" placeholder="Enter Username">
			
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
			<input class="btn" type="submit" name="submit" value="Login">
		</form>
</div>

</body>
</html>