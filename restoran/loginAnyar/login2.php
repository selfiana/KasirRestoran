<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet"  href="login.css">
</head>
<body>
<div class="loginBox">

	<form class="box" action="cek_login.php" method="post">
		<img src="../img/mpi.png" class="user">
		<h2>Log In Admin</h2>
		
			<p style="color:maroon;">Username</p>
			<?php 	

			if(isset($_GET['pesan'])){
				if($_GET['pesan'] == "gagal"){
					echo "Login gagal! username  dan password salah!";
				}else if($_GET['pesan']=="logout"){
					echo "Anda telah berhasil Logout";
				}else if ($_GET['pesan']=="belum login") {
					echo "Anda harus login untuk mengakses halaman admin";
				}
			}

		 ?>

	<form class="box" action="" method="post">
		<p>Username</p>
			<input type="text" name="username" placeholder="Enter username">
		<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password"><br>
		<p>Nama User</p>
			<input type="text" name="nama_user" placeholder="Enter nama_user">
			<input type="submit" name="submit" value="login">
	</form>

</body>
</html>