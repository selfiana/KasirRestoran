<?php
session_start();
include "koneksi.php";
$sid = $_SESSION["user_id"];
$total = 0;

// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
$isikeranjang = array();
$sid = $_SESSION["user_id"];
$koneksi = mysqli_connect("localhost", "root", "", "kasir_restoran_selfi");
$sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE
id_user='$sid'");
while ($r=mysqli_fetch_array($sql)) {
$isikeranjang[] = $r;
}
return $isikeranjang;
}

// kode beli
$text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pnj = 4;
$text1 = strlen($text)-1;
$kode_beli = '';
for ($i=1; $i <=$pnj ; $i++) { 
	$kode_beli .= $text[rand(0, $text1)];
}

$tgl_skrg = date("Ymd");
$no_meja = $_POST["no_meja"];
$ketnomeja = $_POST["ketnomeja"];

// simpan data pemesanan
mysqli_query($koneksi,"INSERT INTO orderr(no_meja, tanggal, id_user, kode_beli, keterangan, status_order) VALUES ('$no_meja', '$tgl_skrg', '$sid', '$kode_beli', '$ketnomeja', 'sudah dipesan')");
// mendapatkan nomor orders dari tabel order
// $id_orders=mysql_insert_id();
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan 
$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);
$ketnama = $_POST["ketnama"];

// deklarasi id_order
$sql = mysqli_query($koneksi, "SELECT * FROM orderr WHERE id_user='$sid'");
$ru = mysqli_fetch_array($sql);
$id = $ru['id_order'];

// simpan data detail pemesanan
for ($i = 0; $i < $jml; $i++){
mysqli_query($koneksi, "INSERT INTO detail_order(id_detail_order, id_order, id_masakan, id_user, kode_beli, keterangan, jumlah, status_detail_order)
VALUES('','$sid',{$isikeranjang[$i]['id_masakan']}, $sid, '$kode_beli', '$ketnama[$i]', 
{$isikeranjang[$i]['jumlah']}, 'belum dibayar')");
}

// setelah data pemesanan tersimpan, hapus data pemesanan di tabel keranjang
for ($i = 0; $i < $jml; $i++) { mysqli_query($koneksi, "DELETE FROM keranjang WHERE
id_keranjang = {$isikeranjang[$i]['id_keranjang']}");}




// $row=mysqli_query($koneksi, "SELECT * FROM detail_order INNER JOIN masakan where $sid and detail_order.id_masakan=masakan.id_masakan");

$row=mysqli_query($koneksi, "SELECT * FROM detail_order,masakan WHERE
detail_order.id_masakan=masakan.id_masakan AND id_user='$sid'");
$data = mysqli_query($koneksi, "SELECT * FROM orderr");

// while($data=mysqli_fetch_array($row)){
// $subtotal = $data['harga']* $data['jumlah'];
// $total = $total + $subtotal;

// echo"<tr><td>$data[nama_masakan]</td>
// 		<td>$data[jumlah]</td>
// 		<td>$data[harga]</td>
// 		<td>$subtotal</td></tr>";
// }

// echo"</table>
// <h2>Total Belanja : <b>$total</b></h2>";
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>keranjang</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example</div><br>
            <div class="card-body">
              <a href="../index.php" class="btn btn-info">Rincian pesanan</a><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>menu</th>
                      <th>qty</th>
                      <th>Harga</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($d=mysqli_fetch_array($sql)){
                      $subtotal = $d['harga']* $d['jumlah'];
                      $total = $total + $subtotal; ?>
                      <tr>
                        <td><?= $d["nama_masakan"]; ?></td>
                        <td><?= $d["jumlah"]; ?></td>
                        <td>Rp. <?= $d["harga"]; ?></td>
                        <td>Rp. <?=$subtotal ; ?></td>
                      </tr>

                   <?php } ?>
                  </tbody>

                </table>

               

                <div class="total">
                	<h4>Kode beli: <b>Rp. <?= $kode_beli;?></b></h4>
                 	<h4>Total belanja: <b>Rp. <?= $total;?></b></h4>
                </div>

                  <div btn btn-primary>
                    <button class="btn btn-primary" type="submit" name="submit">Chackout</button>
                </div>  


                <!-- <div btn btn-primary>
                    <button class="btn btn-primary" type="submit" name="submit">Chackout</button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © selfiana</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>