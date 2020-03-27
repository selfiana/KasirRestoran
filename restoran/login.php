<?php 
ob_start();
session_start();
if(isset($_SESSION['user_username'])) 
	header("location: index/index.php");
include "koneksi.php";

/* PROSES LOGIN */
if(isset($_POST['submit'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $sql_login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

   if(password_verify('password', $password)){

   }

   if(mysqli_num_rows($sql_login)>0) {
      $row_akun = mysqli_fetch_array($sql_login);
      $_SESSION['user_id'] = $row_akun['id_user'];
      $_SESSION['user_username'] = $row_akun['username'];
      $_SESSION['user_password'] = $row_akun['password'];
      $_SESSION['user_level'] = $row_akun['id_level'];

      if ($_SESSION['user_level'] == "1") {
      	header("location:index/index.php");
      }else if($_SESSION['user_level'] == "2"){
      	header("location:index/index.php?page=index");
      }else if($_SESSION['user_level'] == "3"){
      	header("location:index/index.php?page=index");
      }else if($_SESSION['user_level'] == "4"){
      	header("location:../index.php");
      }else if($_SESSION['user_level'] == "5"){
      	header("location:index/index.php?page=index");
}
   }else {
      header("location: login.php?gagal");
   }
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet"  href="login.css">
</head>
<body>
<div class="login-box">

	<?php 
		if (isset($_GET['gagal'])) { ?>
		<p>username dan password salah</p> 
   <?php } ?>
   
		<h2>Log In </h2>
		
		<form class="box" action="" method="post">
		
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