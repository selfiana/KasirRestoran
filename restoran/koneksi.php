<?php 

$koneksi = mysqli_connect("localhost", "root", "", "kasir_restoran_selfi");

// cek koneksi
if(mysqli_connect_errno()) {
	echo "koneksi database gagal :" . mysqli_connect_error();
}

function query($query){
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows [] = $row;
  }
  return $rows;
}

function registrasi($data) {
  global $koneksi;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($koneksi, $data["password"]);
  $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);
  $nama_user = strtolower(stripslashes($data["nama_user"]));

  // cek username sudah ada atau belum
  $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
  if(mysqli_fetch_assoc($result)) {
    echo" <script>
        alert('username sudah terdaptar!');
      </script>";
    return false;
  }

  // cek konfirmasi password
  if( $password !== $password2) {
    echo" <script>
        alert('konfirmasi password tidak sesuai');
      </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
  mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password','$nama_user')");

  return mysqli_affected_rows($koneksi);

}



function upload(){
  $namaFile=$_FILES['gambar']['name'];
  $ukuranFile=$_FILES['gambar']['size'];
  $error=$_FILES['gambar']['error'];
  $tmpName=$_FILES['gambar']['tmp_name'];

// // cek apakah tidak ada gambar yang diupload
  if( $error === 4){
    echo "
    <script>
      alert('pilih gambar terlebih dahulu!');
    </script>";

    return false;
  } 

  $ekstensiGambarValid=['jpg','jpeg','png'];
  $ekstensiGambar=explode('.', $namaFile);
  $ekstensiGambar=strtolower(end($ekstensiGambar));

  if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
    echo "
    <script>
      alert('yang anda upload bukan gambar')
    </script>";

    return false;

  }

  $namafile_baru=uniqid();
  $namafile_baru.= '.';
  $namafile_baru.=$ekstensiGambar;
  $folder ="../img/";
  move_uploaded_file($tmpName,$folder . $namafile_baru);

  return $namafile_baru;
}

// tambah masakan
  function tambah_masakan($data){
  global $koneksi;

  $gambar= upload();
  $nama_masakan=htmlspecialchars($data["nama_masakan"]);
  $harga=htmlspecialchars($data["harga"]);
  $status_masakan=htmlspecialchars($data["status_masakan"]);

if( !$gambar ){
  return false;
}
$query ="INSERT into masakan values ('','$gambar','$nama_masakan','$harga','$status_masakan')";

mysqli_query($koneksi,$query);

return mysqli_affected_rows($koneksi);
}

//ubah masakan
function query_mas($query) {
  global $koneksi;
  $masakan = mysqli_query($koneksi, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($masakan) ){
    $rows[] = $row;
  }
  return $rows;
 }

function ubah_mas($data){
  global $koneksi;
  $id_masakan = $data["id_masakan"];
  $gambarLama = htmlspecialchars($data["gambarLama"]);
  $nama_masakan=htmlspecialchars($data["nama_masakan"]);
  $harga=htmlspecialchars($data["harga"]);
  $status_masakan=htmlspecialchars($data["status_masakan"]);

  // apakah yang di pilih gambar
  if($_FILES['gambar']['error'] === 4){
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  $query="UPDATE masakan SET
      gambar='$gambar',
      nama_masakan='$nama_masakan',
      harga='$harga',
      status_masakan='$status_masakan'
      WHERE
      id_masakan=$id_masakan
      ";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
  }

  // tambah user
  function tambah_user($data){
  global $koneksi;


  $username=htmlspecialchars($data["username"]);
  $password=htmlspecialchars($data["password"]);
  $nama_user=htmlspecialchars($data["nama_user"]);
  $id_level=htmlspecialchars($data["id_level"]);


$query ="INSERT into user values ('','$username','$password','$nama_user','$id_level')";

mysqli_query($koneksi,$query);

return mysqli_affected_rows($koneksi);
}


//ubah user
function query_us($query) {
  global $koneksi;
  $user = mysqli_query($koneksi, $query);
  $rows = [];
  while( $row = mysqli_fetch_assoc($user) ){
    $rows[] = $row;
  }
  return $rows;
 }

function ubah_us($data){
  global $koneksi;
  $id_user = $data["id_user"];
  $username=htmlspecialchars($data["username"]);
  $password=htmlspecialchars($data["password"]);
  $nama_user=htmlspecialchars($data["nama_user"]);
  $id_level=htmlspecialchars($data["id_level"]);


  if ($_POST['id_level']=='admin') {
    $id_level='1';
  } elseif ($_POST['id_level']=='owner') {
    $id_level='2';
  } elseif ($_POST['id_level']=='waiter') {
    $id_level='3';
  } else {
    $id_level='5';
  }

  $query="UPDATE user SET
      username='$username',
      password='$password',
      nama_user='$nama_user',
      id_level='$id_level'
      WHERE
      id_user=$id_user
      ";

  mysqli_query($koneksi,$query);
  return mysqli_affected_rows($koneksi);
  }


  
  






// // tambah user
//   function tambah_user($data){
//   global $koneksi;

//   $username=strtolower(stripcslashes($data["username"]));
//   $password=mysql_real_escape_string($koneksi["password"]);
//   $password2=mysql_real_escape_string($koneksi["password"]);
//   $nama_user=strtolower(stripcslashes($data["nama_user"]));
//   $id_level=strtolower(stripcslashes($data["id_level"]));

// $query =mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

// if (mysqli_fetch_assoc(result)) {
//   echo "<script>
//           alert('username sudah terdaptar')
//         <script> ";
//         return false;
// }

// // cek konfirmasi password
//   if( $password !== $password2) {
//     echo" <script>
//         alert('konfirmasi password tidak sesuai');
//       </script>";
//     return false;
//   }

//   // enkripsi password
//   $password = password_hash($password, PASSWORD_DEFAULT);

//   // tambahkan userbaru ke database
//   mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password','$nama_user','$id_level')");

//   return mysqli_affected_rows($koneksi);

// }























 ?>