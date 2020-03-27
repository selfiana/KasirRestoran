<?php
session_start();
$sid = $_SESSION["user_id"];
include "function.php";

//menjalankan perintah inner join dr tbl krnjng dan mskn
$sql = mysqli_query($koneksi, "SELECT * FROM keranjang, masakan WHERE id_user='$sid' AND keranjang.id_masakan=masakan.id_masakan");
$total_a = 0;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
	<link rel="shortcut icon" type="image/png" href="img/food.png">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="vendor/fontawesome-free/css/all.min.css">
</head>
<body>
  

	<div class="container" style="margin-bottom: 30px; margin-top: 3%;">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-secondary text-center"><b>Keranjang</b> Belanja
      </h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>Gambar</th>
              <th>Menu</th>
              <th>[-]</th>
              <th>Qty</th>
              <th>[+]</th>
              <th>Harga</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <a href="index2.php?page=index2" class="fa fa-w fa-plus btn btn-primary" style="margin-bottom: 20px;"> Tambah Menu</a>
          <tbody>

            <?php while($row = mysqli_fetch_assoc($sql)) {
            	$subtotal = $row['harga'] * $row['jumlah'];
            	$total_a = $total_a + $subtotal; ?>
              <tr>
              	<td><img style="height: 90px;" src="img/<?= $row['gambar']; ?>" alt="..."></td>
                <td><?= $row["nama_masakan"]; ?></td>
                <td><a href="keranjang_minus.php?id=<?= $row["id_masakan"]; ?>"><i class="fa fa-w fa-minus btn btn-primary"></i></a></td>
                <td><?= $row['jumlah']; ?></td>
                <td><a href="aksi_keranjang.php?id=<?= $row["id_masakan"]; ?>"><i class="fa fa-w fa-plus btn btn-primary"></i></td>
                <td>Rp. <?= $row['harga']; ?></td>
                <td>Rp. <?= $subtotal; ?></td>
                <td>

                <a href="hapus_keranjang.php?id=<?= $row["id_keranjang"]; ?>" onclick="return confirm('Apakah Yakin Ingin Menghapus Pesanan Ini?')" class="btn btn-danger btn-sm"><i class="fa fa-w fa-trash"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>

         </tfoot>
        </table>
        <form  method="post" action="selesai.php" enctype="multipart/form-data"> 
        <div class="form-group">
          <input type="number" name="no_meja" class="form-control" placeholder="No Meja" require>
        </div>
        <div class="form-group">
          <input type="text" name="catatanMeja" class="form-control" placeholder="Catatan Untuk Meja" require>
        </div>
        <div class="form-group">
          <input type="text" name=catatanMakanan[] class="form-control" placeholder="Catatan Untuk Makanan" require>
        </div>
        <!-- <div class="form-group">
          <textarea name="catatanMakanan[]" id="" cols="30" rows="10" class="form-control" placeholder="Catatan Untuk Makanan" require></textarea>
        </div> -->
        <div class="total" style="margin-top: 40px; margin-left: 65%;">
        	<h4 style="font-size: 20px;">Total Belanja: <b>Rp. <?= $total_a;?></b></h4>
        </div>
        <div class="" style="margin-left: 90%;">
          <input type="submit" name="" value="Checkout" class="btn btn-primary">
        	<!-- <a href="selesai.php" style="color: white;">Checkout</a> -->
        </div>
        </form>

      </div>  
    </div>  
  </div>
 </div>

</body>
</html>