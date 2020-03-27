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
$data = mysqli_query($koneksi,"SELECT * from user where username='$username' and password='$password'");

//menghitung jml data yang ditemukan

$data = mysqli_num_rows($login);

if ($data['id_level']=="1") {
	// buat sesion login dan username
	$_SESSION['username'] = $username;
	$_SESSION['id_level'] = "1";

	// alihkan ke halaman password 
	header("Location:index/index.php");

	// cek jika user login sebagai owner
}else if($data['id_level'] == "2"){
	// buat sesion login dan username
	$_SESSION['username'] = $username;
	$_SESSION['id_level'] = "2";

	// alihkan ke halaman dashboard pegawai
	header("Location:index/index.php")
} else{
	// alihkan ke halaman login kembali
	header("Location:index/index.php?pesan=gagal");
}
} else {
	
}

 ?>