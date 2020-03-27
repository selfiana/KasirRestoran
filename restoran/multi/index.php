<?php 
session_start();
include 'function.php'; 
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>halaman login</title>
</head>
<body>
	<form>
		<input type="text" name="user" placeholder="Masukan Username"><br><br>
		<input type="password" name="pass" placeholder="Masukan password"><br><br>
		<input type="submit" name="login" value="Login">
	</form>
	<?php 
if (isset($_POST['login'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$data_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
	$r = mysqli_fecth_array($data_user);
	$username = $r['username'];
	$password = $r['password'];
	$level = $r['id_level'];
	if ($user == $username && $pass == $password) {
		$_SESSION['id_level'] == $level;
		header('location:beranda.php');
	}else{
		echo 'sorry broooooooooo';
	}
}
	 ?>

</body>
</html>