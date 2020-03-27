<?php 
include '../inti/header.php';
include '../koneksi.php';

if (isset($_POST["submit"])) {
	if (tambah_masakan($_POST) > 0) {
		 echo "
    	<script>
      		alert('data berhasil di tambahkan')
      		document.location.href = 'masakan.php';
    	</script>";
	} else {
    	echo "
    	<script>
      		alert('data gagal di tambahkan')
      		document.location.href = 'masakan.php';
    	</script>";
}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>tambah menu</title>
</head>
<body>


<h1 style="text-align: center; font-family: sans-serif; margin-left: 20px;">Tambah Menu</h1>
<hr>

<div class="container">
<div class="row">
	<div class="col-md-6 mb-3">
		<form  method="post" enctype="multipart/form-data">
			
			<div class="card">
				<div class="card-header">
					<h5>Buat kegiatan Baru</h5>
				</div> <!-- end card hearder-->
				<div class="card-body">
					<!-- input gmbar --> 
					<div class="form-group form-label-group">
						<input type="file" name="gambar">
						<label>Gambar</label>
					</div>

					<!-- input nama -->
					<div class="form-group form-label-group">
						<input type="" name="nama_masakan" class="form-control">
						<label>Nama</label>
					</div>

					<div class="form-group form-label-group">
						<input type="" name="harga" class="form-control">
						<label>Harga</label>
					</div>

					<div class="form-group form-label-group">
						<input type="" name="status_masakan" class="form-control">
						<label>Status Masakan</label>
					</div>

				</div> <!-- end card body-->
					<button class="btn btn-primary" type="submit" name="submit"> Simpan</button>

			</div> <!-- end card-->
		</form>
	</div>
</div>
</div>

</body>
</html>

<?php
require "../inti/footer.php";
?>
