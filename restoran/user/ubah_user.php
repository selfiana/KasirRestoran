<?php
include "../inti/header.php";
include "../koneksi.php";

$id_user = $_GET['id_user'];
$user = query_us("SELECT * FROM user where id_user = $id_user ")[0];
$result = mysqli_query($koneksi, "SELECT * FROM level");

if(isset($_POST['submit'])){
  if(ubah_us($_POST)>0){

  echo "
    <script>
      alert('data berhasil di ubah')
      document.location.href = 'user.php';
    </script>";
  } else {
    echo "
    <script>
      alert('data gagal di ubah')
      document.location.href = 'user.php';
    </script>";
  }
}
?>

<!-- Ubah user -->
<!DOCTYPE html>
<html>
<head>
  <title>Ubah user</title>
</head>
<body>
      
<!-- akhir Ubah user-->
<h1 style="margin-left: 10px;">Ubah <small>user</small></h1>
<hr>

<div class="row">
  <div class="col-md-6 mb-3">
    <form  method="post" action="" enctype="multipart/form-data">
      
      <div class="card">
        <div class="card-header">
          <h5>Ubah user</h5>
        </div> <!-- end card hearder-->
        
        <div class="card-body">
             <input type="hidden" name="id_user" value="<?= $user["id_user"]; ?>">
          <!-- input nama_user -->
          <div class="form-group form-label-group">
            <input type="text" name="username" class="form-control" value="<?=$user['username'];?>">
            <label>Username</label>
          </div>

          <div class="form-group form-label-group">
            <input type="text" name="password" class="form-control" value="<?=$user['password'];?>">
            <label>Password</label>
          </div>

          <div class="form-group form-label-group">
            <input type="text" name="nama_user" class="form-control" value="<?=$user['nama_user'];?>">
            <label>nama user</label>
          </div>


            <select name="id_level" class="form-control" required="">
              <label>Hak akses</label>
              <?php if ($user['id_level']=='1') {
                echo "<option>admin</option><option>kasir</option><option>waiter</option><option>owner</option>";
              } else if($user['id_level']=='2') {
                echo "<option>owner</option><option>admin</option><option>kasir</option><option>waiter</option>";
              } else if($user['id_level']=='3') {
                echo "<option>waiter</option><option>admin</option><option>kasir</option><option>owner</option>";
              } else if($user['id_level']=='5') {
                echo "<option>kasir</option><option>admin</option><option>waiter</option><option>owner</option>";
              } 
              ?>
            </select>

        </div> <!-- end card body-->
        <div class="row"> 
          <button class="btn btn-primary" type="submit" name="submit" style="margin-left: 50px;"> Simpan</button>

          <a href="user.php" class="btn btn-danger" style="margin-left: 10px;">Kembali</a>
        </div>

      </div> <!-- end card-->
    </form>
  </div>
</div>

</body>
</html>

<?php
require "../inti/footer.php";
?>