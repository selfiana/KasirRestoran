<?php 
session_start();
include "koneksi.php";
$sid = $_SESSION["user_id"];

$sql = mysqli_query($koneksi, "SELECT id_masakan FROM keranjang WHERE id_masakan='$_GET[id]' AND id_user='$sid'");
	$sel = mysqli_num_rows($sql);

	if ($sel == 0) {
		mysqli_query($koneksi, "INSERT INTO keranjang(id_masakan, id_user, jumlah)
			VALUES ('$_GET[id]','$sid',1)");
	} else {
		mysqli_query($koneksi, "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = '$sid' AND id_masakan='$_GET[id]'");
	}
	header('Location: http://localhost/kasir/restoran/chackout.php');
 
 ?>