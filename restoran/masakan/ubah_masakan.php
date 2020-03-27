<?php
include "../inti/header.php";
include "../koneksi.php";

$id_masakan = $_GET['id_masakan'];
$masakan = query_mas("SELECT * FROM masakan where id_masakan = $id_masakan ")[0];

if(isset($_POST['submit'])){
  if(ubah_mas($_POST)>0){

  echo "
    <script>
      alert('data berhasil di ubah')
      document.location.href = 'masakan.php';
    </script>";
  } else {
    echo "
    <script>
      alert('data gagal di ubah')
      document.location.href = 'masakan.php';
    </script>";
  }
}
?>

<!-- Ubah masakan -->
<!DOCTYPE html>
<html>
<head>
  <title>Ubah masakan</title>
</head>
<body>
      
<div class="container">
  <h3 style="text-align: center; margin-top: 10px; margin-bottom: 20px;">Edit Menu</h3>
  <hr><br>
<div class="row">
  <div class="col-md-6 mb-3">
    <form  method="post" action="" enctype="multipart/form-data">
      
      <div class="card">
        <div class="card-header">
          <h5>Edit menu</h5>
        </div> <!-- end card hearder-->

          <!-- input nama_masakan -->
          <div class="form-group form-label-group">
            <input type="text" name="nama_masakan" class="form-control" value="<?=$masakan['nama_masakan'];?>">
            <label>nama Masakan</label>
          </div>

        <div class="card-body">
            <input type="hidden" name="id_masakan" value="<?= $masakan["id_masakan"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $masakan["gambar"]; ?>">
          <!-- input gmbar --> 
          <div class="form-group form-label-group">
            <input type="hidden" name="id_masakan" value="<?= $masakan["id_masakan"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $masakan["gambar"]; ?>">
            <img src="../img/<?=$masakan['gambar'];?>" style="width:40%">
            <input type="file" name="gambar">
            <label>Gambar</label>
          </div>


          <div class="form-group form-label-group">
            <input type="text" name="harga" class="form-control" value="<?=$masakan['harga'];?>">
            <label>Harga</label>
          </div>

          <div class="form-group form-label-group">
            <input type="text" name="status_masakan" class="form-control" value="<?=$masakan['status_masakan'];?>">
            <label>Status masakan</label>
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
<!-- akhir Ubah masakan-->

<?php
require "../inti/footer.php";
?>