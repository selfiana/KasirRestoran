<?php 
include '../koneksi.php';

$id_user = $_GET["id_user"];
mysqli_query($koneksi, "DELETE FROM user where id_user = $id_user");

if( mysqli_affected_rows($koneksi) > 0 ) {
	echo "
	<script>
		alert('data berhasil di hapus');
		document.location.href = 'user.php';
	</script>
	";
} else {
	echo "
	<script>
		alert('data gagal di hapus');
		document.location.href = 'user.php';
	</script>
	";
}

 ?>