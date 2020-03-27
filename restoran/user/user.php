 <?php 
 // koneksi ke database 
 include "../inti/header.php";
 include "../koneksi.php";
 
// ambil data dari tabel berita
 $result = mysqli_query($koneksi, "SELECT * FROM user INNER JOIN level on user.id_level = level.id_level");

 // if (isset($_POST["cari"])) {
 //  $keyword = $_POST["keyword"];

 //  $result = mysqli_query($koneksi,"SELECT * FROM user where 
 //    username LIKE '%$keyword%' OR 
 //    nama_user LIKE '%$keyword%' order by user.id_user asc ");
 // }

  ?>

 <!DOCTYPE html>
<html>
<head>
  <title>user</title>
</head>
<body>
<div style="text-align: center;">
<h1>User</h1>
<a href="tambah_user.php" class="btn btn-primary" style="margin-bottom: 30px; margin-left: 20px;">[+] Tambah User</a>
<hr>

 <!-- <form class="form-inline" action="" method="post" >
    <input style="background-color: #fff; margin-left: 700px; margin-bottom: 20px;" class="form-control mr-sm-2"  type="text" name="keyword" size="40" autofocus placeholder="masukan pencarian..." autocomplete="off">
    <button style="border-radius: 10px; background-color: blue; color: white;  margin-bottom: 20px;"  type="submit" name="cari">Search</button>

  </form> -->

  <table class="table table-striped mb-6">
  <div class="col-md-6 mb-3">
  
  <tr>
    <th>No</th><th>Username</th><th>nama user</th><th>level</th><th>aksi</th>
  </tr>

  <?php $n = 1; ?>
  <?php while($row = mysqli_fetch_assoc($result)) : ?>
  <tr>
    <td><?= $n;?></td>
    <td><?= $row["username"]; ?></td>
    <td><?= $row["nama_user"]; ?></td>
    <td><?= $row["nama_level"]; ?></td>
    <td>
      
      <a href="ubah_user.php?id_user=<?= $row["id_user"]; ?>"class="btn btn-info btn-sm fa fa-w fa-edit" style="height: 30px;">Ubah</a>

      <?php if($_SESSION['user_id'] != $row["id_user"]) { ?>
      <a href="hapus_user.php?id_user=<?= $row["id_user"]; ?>" onclick="return confirm('yakin?');" class="btn btn-danger btn-sm btn-trash fa fa-w fa-trash" style="height: 30px;">Hapus</a>
    <?php } ?>
    </td>
  </tr>
  <?php $n++; ?>
<?php endwhile; ?>
</div>
</table>

</body>
</html>

<?php
include "../inti/footer.php";
?>