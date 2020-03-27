<?php 
include "../inti/header.php";
include'../koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM masakan order by id_masakan desc");

// @$cari = $_POST['cari'];
// @$keyword = $_POST ['keyword'];
//   if($cari) {
//     if ($keyword == "") {
//       $sql = mysqli_query($koneksi, "SELECT * FROM masakan order by id desc");
//     }else if ($keyword != ""){
//       $sql = mysqli_query($koneksi, "SELECT * FROM masakan where nama_masakan LIKE '%$keyword%' order by id_masakan asc ")
//     }
//   }
//   else{
//     $sql = mysqli_query($koneksi, "SELECT * FROM masakan order by id_masakan desc")
//   }
//   $cek = mysqli_num_rows($sql);
//   if ($cek < 1) {
//     echo "Data tidak di temukan"
//   }



if (isset($_POST["cari"])) {
  $keyword = $_POST["keyword"];

  $result = mysqli_query($koneksi,"SELECT * FROM masakan where 
    nama_masakan LIKE '%$keyword%' OR 
    harga LIKE '%$keyword%' order by masakan.id_masakan asc ");
 }
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>order</title>
</head>
<body>
	<h1 style="font-family: sans-serif; margin-left: 20px;">Daftar Menu</h1>
	 <a href="tambah_masakan.php" class="btn btn-primary" style="margin-bottom: 30px; margin-left: 20px;">[+] Tambah Menu</a>

   <form class="form-inline" action="" method="post" >
    <input style="background-color: #fff; margin-left: 700px; margin-bottom: 20px;" class="form-control mr-sm-2"  type="text" name="keyword" size="40" autofocus placeholder="masukan pencarian..." autocomplete="off" >
    <button style="border-radius: 10px; background-color: blue; color: white;  margin-bottom: 20px;"  type="submit" name="cari">Search</button>

  </form>

	  <!-- gambar -->
      <div class="container">
        <div class="row">
              <?php $i = 1; ?>
              <?php while($row = mysqli_fetch_assoc($result)):?>
          <div class="col-lg-4">
            <div class="card text-center" style="margin-bottom: 20px;">
             <form method="post" action="" enctype="multipart/form-data" >
              <img style="width: 20rem; height: 13rem;" src="../img/<?=$row['gambar'];?>" class="card-img-top" >
              <div class="card-body" >
                <h5 class="card-title"><?=$row['nama_masakan'];?></h5>
                <h5 class="card-title">Rp. <?=$row['harga'];?></h5>
                <h5 class="card-title"><?=$row['status_masakan'];?></h5>

                 <a href="ubah_masakan.php?id_masakan=<?= $row["id_masakan"]; ?>"class="btn btn-info btn-sm fa fa-w fa-edit" style="height: 30px;">Ubah</a>
                <a href="hapus_masakan.php?id_masakan=<?= $row["id_masakan"]; ?>" onclick="return confirm('yakin?');" class="btn btn-danger btn-sm btn-trash fa fa-w fa-trash" style="height: 30px;">Hapus</a>

              </div>
            </div>
          </div> <!-- tutp col--> 
        <?php endwhile;?>
        </form>
      </div> <!-- tutp row-->
     </div> <!-- tutp con-->

</body>
</html>

<?php 
include "../inti/footer.php";
 ?>