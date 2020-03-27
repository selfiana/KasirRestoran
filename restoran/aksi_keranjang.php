<?php
session_start();
include "koneksi.php";
$sid = $_SESSION["user_id"];
//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
$sql = mysqli_query($koneksi, "SELECT id_masakan FROM keranjang WHERE
id_masakan='$_GET[id]' AND id_user ='$sid'");
$ketemu=mysqli_num_rows($sql);
if ($ketemu==0){
	// kalau barang belum ada, maka di jalankan perintah insert
	mysqli_query($koneksi, "INSERT INTO keranjang (id_masakan, jumlah, id_user )
	VALUES ('$_GET[id]', 1, '$sid')");
	} else {
		// kalau barang ada, maka di jalankan perintah update
		mysqli_query($koneksi, "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user  ='$sid' AND id_masakan='$_GET[id]'");
	}
		header('Location:chackout.php');
?>