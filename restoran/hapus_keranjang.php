<?php 
session_start();
include 'koneksi.php';
$sid = $_SESSION["user_id"];
$id = $_GET["id"];

mysqli_query($koneksi, "DELETE FROM keranjang where id_keranjang = $id");

if( mysqli_affected_rows($koneksi) > 0 ) {
	echo "
	<script>
		alert('data berhasil di hapus');
		document.location.href = 'chackout.php';
	</script>
	";
} else {
	echo "
	<script>
		alert('data gagal di hapus');
		document.location.href = 'chackout.php';
	</script>
	";
}




// $sql = mysqli_query($koneksi, "SELECT id_masakan FROM keranjang WHERE id_masakan = '$_GET[id]' AND id_user = '$id'");
//   $ketemu=mysqli_num_rows($sql);
//   if ($ketemu > 0) {
//     mysqli_query($koneksi, "UPDATE keranjang SET jumlah = jumlah - 1 WHERE id_user = '$sid' AND id_masakan = '$_GET[id]'");
//   }
//     header('Location : keranjang.php');

 ?>