<?php 
session_start();
include "function.php";
$sid = $_SESSION["user_id"];
$total_a = 0;

function isi_keranjang() {
	global $koneksi;
	$isikeranjang = array();
	$sid= $_SESSION["user_id"];
	$sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_user='$sid'");

	while ($row=mysqli_fetch_array($sql)) {
		$isikeranjang[] = $row;
	}
	return $isikeranjang;
}

// Kode beli
$text ='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pnj = 4;
$text1 = strlen($text)-1;
$kode_beli = '';
for ($i=1; $i<=$pnj; $i++) {
	$kode_beli .= $text[rand(0, $text1)];
}

$tgl_sekarang = date("Ymd");
$no_meja = $_POST["no_meja"];
$catatanMeja = $_POST["catatanMeja"];

// simpan dt pmsn
mysqli_query($koneksi, "INSERT INTO orders(id_order,no_meja,kode_beli,id_user, tanggal, keterangan, status_order) VALUES ('','$no_meja','$kode_beli','$sid','$tgl_sekarang','$catatanMeja', 'Belum Dibayar')");

// panggil function isikeranjang & hitung jml produk
$isikeranjang = isi_keranjang();
$jumlah = count($isikeranjang);
$keterangan = $_POST["catatanMakanan"];

// deklarasi id_order
$sql = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_user='$sid' AND kode_beli ='$kode_beli'");
$sql2 = mysqli_fetch_array($sql);
$id = $sql2['id_order'];

// simpan data detail_order
for ($i =0; $i < $jumlah; $i++) {
	mysqli_query($koneksi, "INSERT INTO detail_order(id_detail_order, id_order, kode_beli, id_masakan, id_user, jumlah, keterangan, status_detail_order)
	VALUES('','$id', '$kode_beli', {$isikeranjang[$i]['id_masakan']}, '$sid',{$isikeranjang[$i]['jumlah']}, '$keterangan[$i]', 'Berhasil dipesan')");
	}

//  hapus dt pmsann di tbl krnjang stlh data pmsan trsmpn
for ($i = 0; $i < $jumlah; $i++) {
	mysqli_query($koneksi,  "DELETE FROM keranjang WHERE id_keranjang = {$isikeranjang[$i]['id_keranjang']}");
	}

$data = mysqli_query($koneksi, "SELECT * FROM detail_order,masakan WHERE detail_order.id_masakan=masakan.id_masakan AND id_user='$sid'");
$row = mysqli_query($koneksi, "SELECT * FROM orders");

 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Rincian</title>
	<link rel="shortcut icon" type="image/png" href="img/food.png">
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="vendor/fontawesome-free/css/all.min.css">
</head>
<body>
  

	<div class="container" style="margin-bottom: 30px; margin-top: 3%;">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-secondary text-center"><b>Rincian</b> Pesanan
      </h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
            <th>Nama Masakan</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>

            <?php while($row = mysqli_fetch_assoc($data)) {
            	$subtotal = $row['harga'] * $row['jumlah'];
            	$total_a = $total_a + $subtotal; ?>
              <tr>
                <td><?= $row["nama_masakan"]; ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp. <?= $row['harga']; ?></td>
                <td>Rp. <?= $subtotal; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <div class="total" style="margin-top: 40px; margin-left: 65%;">
          <h4 style="font-size: 20px;">Kode Beli: <b> <?= $kode_beli;?></b></h4>
        	<h4 style="font-size: 20px;">Total Belanja: <b>Rp. <?= $total_a;?></b></h4>
        </div>
        <div class="">
        	<a href="index2.php" style="color: white;" class="btn btn-primary">Selesai</a>
        </div>

      </div>  
    </div>  
  </div>
 </div>

</body>
</html>
