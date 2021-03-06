<?php
include "../inti/header.php";
include "../koneksi.php";


// $get_id_order = $_GET['id_order'];
// $q = mysqli_query($konek, "update pesanan set status_order=0 where id_order='$get_id_order'");
$result = mysqli_query($koneksi, "SELECT * FROM orderr");

if ($result) {
  $pesan = "<div class='alert alert-success'>Transaksi berhasil dilakukan</div>";
} else {
  $pesan = "<div class='alert alert-success'>Transaksi Batal/Gagal.</div>";
}
?>
<div class="col">
  <div class="card">
    <div class="card-header">
      Transaksi
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>NOMOR MEJA</th>
            <th>MENU</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
            <th>TOTAL (IDR)</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $result = mysqli_query($koneksi, "
          SELECT a.*, b.*, c.*, d.* FROM transaksi a
          INNER JOIN orderr b ON a.id_order=b.id_order
          INNER JOIN detil_order c ON b.id_order=c.id_order
          INNER JOIN masakan d ON c.id_masakan=d.id_masakan
        ");
        while($row = mysqli_fetch_array($result)) {
          if ($row['status_order']) {
            $badge = "badge-danger";
            $status = "Belum Bayar";
          } else {
            $badge = "badge-success";
            $status = "Lunas";
          }
        ?>
          <tr>
            <td><?php print $row['id_order']?></td>
            <td><?php print $row['no_meja']?></td>
            <td><?php print $row['nama_masakan']?></td>
            <td><?php print $row['tanggal']?></td>
            <td><div class="badge <?php print $badge?>"><?php print $status?></div></td>
            <td><?php print $row['harga']?></td>
            <td>
              <a href="?menu=transaksi&id_order=<?php print $row['id_order']?>" class="btn btn-info btn-sm">Bayar</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php 
include "../inti/footer.php";
 ?>