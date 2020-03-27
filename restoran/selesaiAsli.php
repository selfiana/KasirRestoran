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

echo"Nomor Order: <b>$sid</b><br /><br />";

echo"<h1>Rincian Belanja</h1>
<table border=1>
<tr>
<th>Nama Produk</th>
<th>Qty</th>
<th>Harga</th>
<th>Sub Total</th>
</tr>
";

$row=mysqli_query($koneksi, "SELECT * FROM detail_order,masakan WHERE
detail_order.id_masakan=masakan.id_masakan AND id_user='$sid'");

// $row=mysqli_query($koneksi, "SELECT * FROM detail_order INNER JOIN masakan where $sid and detail_order.id_masakan=masakan.id_masakan");

$data = mysqli_query($koneksi, "SELECT * FROM orderr");

while($data=mysqli_fetch_array($row)){
$subtotal = $data['harga']* $data['jumlah'];
$total = $total + $subtotal;

echo"<tr><td>$data[nama_masakan]</td>
		<td>$data[jumlah]</td>
		<td>$data[harga]</td>
		<td>$subtotal</td></tr>";
}

echo"</table>
<h2>Total Belanja : <b>$total</b></h2>";
?>