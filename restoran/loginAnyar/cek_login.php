<?php 	

//mengaktifkna session php
session_start();
if( isset($_SESSION["username"]) ){
	header("Location: index/index.php");
	exit;
}
//menghubungkan koneksi
include 'koneksi.php';

//menangkap data dari form
$username = $_POST['username'];
$password = $_POST['password'];


//sleksei data admin
$login = mysqli_query($koneksi,"SELECT * from user where username='$username' and password='$password'");

//menghitung jml data yang ditemukan

$cek = mysqli_num_rows($login);

if ($cek > 0) {
	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if ($data['id_level']=="1") {
		
		// buat session login dan usernme
		$_SESSION['username'] = $username;
		$_SESSION['id_level'] = 1;

		// alihkan ke halaman dashboard admin
		header("location:index/index.php");

	} else if($data['id_level']=="2"){
		// buat session login dan usernme
		$_SESSION['username'] = $username;
		$_SESSION['id_level'] = 2;

		// alihkan ke halaman dashboard admin
		header("location:masakan/masakan.php");
	} else if($data['id_level']=="3"){
		// buat session login dan usernme
		$_SESSION['username'] = $username;
		$_SESSION['id_level'] = 3;

		// alihkan ke halaman dashboard admin
		header("location:#");
	} else if($data['id_level']=="4"){
		// buat session login dan usernme
		$_SESSION['username'] = $username;
		$_SESSION['id_level'] = 4;

		// alihkan ke halaman dashboard admin
		header("location:#");
	} else if($data['id_level']=="5"){
		// buat session login dan usernme
		$_SESSION['username'] = $username;
		$_SESSION['id_level'] = 5;

		// alihkan ke halaman dashboard admin
		header("location:user/user.php");
	} else {
		// alihkan ke login lagi
		header("location:login.php?pesan=gagal");
	}
} else {
		// alihkan ke login lagi
		header("location:login.php?pesan=gagal");
	}



 ?>