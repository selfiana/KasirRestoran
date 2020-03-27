<?php
session_start();
include "koneksi.php";
$sid = $_SESSION["user_id"];
$total = 0;

echo"<h1>Keranjang Belanja</h1>
	 <table border=1>
	<tr>
	 <th>Nama masakan</th>
	 <th>Qty</th>
	 <th>Harga</th>
	 <th>Sub Total</th>
	</tr>
";

//jalankan perintah inner join dari tabel keranjang dan masakan
$sql = mysqli_query($koneksi, "SELECT * FROM keranjang, masakan where id_user='$sid' AND keranjang.id_masakan=masakan.id_masakan");
while($d=mysqli_fetch_array($sql)){
$subtotal = $d['harga']* $d['jumlah'];
$total = $total + $subtotal;
echo"<tr><td>$d[nama_masakan]</td>
<td>$d[jumlah]</td>
<td>$d[harga]</td>
<td>$subtotal</td></tr>";
}

echo"</table>
		<h2>Total Belanja : <b>$total</b></h2>
	<ul>
		<li><a href='../index.php'>Tambah Barang</a></li>
		<li><a href='selesai.php'>Selesai belanja</a></li>
	</ul>";
?>