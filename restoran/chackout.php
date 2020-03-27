<?php
session_start();
include "koneksi.php";
$sid = $_SESSION["user_id"];
$total = 0;

$sql = mysqli_query($koneksi, "SELECT * FROM keranjang, masakan where id_user='$sid' AND keranjang.id_masakan=masakan.id_masakan");
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
              <a href="../index.php" class="btn btn-info">Tambah menu</a><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>menu</th>
                      <th>[-]</th>
                      <th>qty</th>
                      <th>[+]</th>
                      <th>Harga</th>
                      <th>Subtotal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($d=mysqli_fetch_array($sql)){
                      $subtotal = $d['harga']* $d['jumlah'];
                      $total = $total + $subtotal; ?>
                      <tr>
                        <td><?= $d["nama_masakan"]; ?></td>
                        <td><a href="minus.php?id=<?= $d["id_masakan"]; ?>" class="btn btn-danger " style="height: 30px;">-</a></td>
                        <td><?= $d["jumlah"]; ?></td>
                        <td><a href="plus.php?id=<?= $d["id_masakan"]; ?>"  class="btn btn-primary " style="height: 30px;">+</a></td>
                        <td>Rp. <?= $d["harga"]; ?></td>
                        <td>Rp. <?=$subtotal ; ?></td>
                        <td><a href="hapus_keranjang.php?id=<?= $d['id_keranjang']; ?> ">Hapus</a></td>
                      </tr>

                   <?php } ?>
                  </tbody>

                </table>

                <form method="post" action="selesai.php" enctype="multipart/form-data">
                  <div class="form-grup">
                    <input type="text" name="no_meja" class="from-control" value="" id="inomeja" placeholder="No meja" required>
                  </div>
                  <div class="form-grup">
                    <input type="text" name="ketnomeja" class="from-control" value="" id="iketnomeja" placeholder="Catatan untuk meja" required>
                  </div>
                  <div class="form-grup">
                    <input type="text" name="ketnama" class="from-control" value="" id="inama" placeholder="Keterangan menu" required>
                  </div>
                   <!-- <div class="form-grup">
                    <input type="text" name="catatanMakanan[]" class="from-control" value="" id="icatatanmakanan" placeholder="Catatan untuk makanan" required>
                  </div> -->

                  <div class="total">
                  <h4>Total belanja: <b>Rp. <?= $total;?></b></h4>
                </div>

                  <div btn btn-primary>
                    <button class="btn btn-primary" type="submit" name="submit">Chackout</button>
                </div>  


                </form>

                

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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

</html>
