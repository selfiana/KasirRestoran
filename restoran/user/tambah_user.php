<?php 
include '../inti/header.php';
include '../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM level");

if (isset($_POST["submit"])) {
	if (tambah_user($_POST) > 0) {
		 echo "
    	<script>
      		alert('data berhasil di tambahkan')
      		document.location.href = 'user.php';
    	</script>";
	} else {
    	echo "
    	<script>
      		alert('data gagal di tambahkan')
      		document.location.href = 'user.php';
    	</script>";
}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>tambah user</title>
</head>
<body>


<h1 style="text-align: center; font-family: sans-serif; margin-left: 20px;">Tambah User</h1>
<hr>

<div class="container">
<div class="row">
	<div class="col-md-6 mb-3">
		<form  method="post" enctype="multipart/form-data">
			
			<div class="card">
				<div class="card-header">
					<h5>Buat user Baru</h5>
				</div> <!-- end card hearder-->
				<div class="card-body">
					<!-- input gmbar --> 
					<div class="form-group form-label-group">
						<input type="" name="username">
						<label>Username</label>
					</div>

					<!-- input nama -->
					<div class="form-group form-label-group">
						<input type="" name="password" class="form-control">
						<label>password</label>
					</div>

					<div class="form-group form-label-group">
						<input type="" name="nama_user" class="form-control">
						<label>nama user</label>
					</div>

				<label>Hak akses</label>
						<select name="id_level">
							<?php while($row = mysqli_fetch_assoc($result)) : ?>
								<option value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
							<?php endwhile; ?>
						</select>

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
