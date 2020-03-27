<?php 
include '../koneksi.php';

$id_mas = $_GET["id_masakan"];
mysqli_query($koneksi, "DELETE FROM masakan where id_masakan = $id_mas");

if( mysqli_affected_rows($koneksi) > 0 ) {
	echo "
	<script>
		alert('data berhasil di hapus');
		document.location.href = 'masakan.php';
	</script>
	";
} else {
	echo "
	<script>
		alert('data gagal di hapus');
		document.location.href = 'masakan.php';
	</script>
	";
}

 ?>