<?php 
include 'restoran/koneksi.php'; 
session_start();

if( !isset($_SESSION["user_username"]) ){
  header("Location: restoran/login.php");
  exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM masakan order by id_masakan desc");
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >

    <title>Cafe Santuy</title>
  </head>
  <body>
    <!-- awal navbar -->
    <nav class="navbar fixed-top navbar-expand-lg " style="background-color: #8B4513">
      <!-- <img src="restoran/img/logo.png"> -->
  <a class="navbar-brand" href="#">Cafe Santuy</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
        <li class="nav-item">
        <a class="nav-link" href="restoran/logout.php" style="margin-left: 1100px;">logout</a>
      </li>
      </li>
    </ul>
  </div>
</nav>
    <!-- akhir navbar -->

    <!-- caroulsel -->
     <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="5.jpg" class="d-block w-100" alt="..." width="250" height="650">
        </div> -->
       <!--  <div class="carousel-item">
          <img src="1.jpg" class="d-block w-100" alt="..." width="250" height="650">
        </div>
        <div class="carousel-item">
          <img src="2.jpg" class="d-block w-100" alt="..." width="250" height="650">
        </div> -->
     <!--  </div>  
    </div> -->
    <!-- akhir caroulsel -->

    <section class="p-b-55">
      <div class="row align-items-center" style="height: 650px; width : 1500px; background: linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5) ), url('img/coffe.jpg') no-repeat; background-size: cover;">
        <div class="col text-left" style="margin-left: 30px;">
          <h1 style="font-size: 60px; margin-left: 60px; color: white; font-family: Freehand521 BT;">Cafee santuy :) </h1>
          <p style="font-size: 30px; margin-left: 60px; color: white; font-family: Tekton Pro Cond;">Cafee nya orang santuy ....</p>
        </div>
      </div>
    </section>


    <!-- awal jumbotron -->
    <div class="jumbotron" style="text-align: center;">
      <h1 class="display-4">Cafee Santuy</h1>
        <p class="le ad">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <hr class="my-4">
    </div>
    <!-- akhir jumbotron -->

    <!-- awal menu -->


    <div class="judul">
      <h1 style="text-align: center; margin-bottom: 20px;">Daftar menu</h1>
      <hr>
    </div>





    <div class="container">
      <div class="row">
        
      <?php $i = 1; ?>
              <?php while($row = mysqli_fetch_assoc($result)):?>
          <div class="col-lg-4">
            <div class="card" style="margin-bottom: 20px;">
             <form method="post" action="" enctype="multipart/form-data" >
              <img style="width: 21.7rem; height: 13rem;" src="restoran/img/<?=$row['gambar'];?>" class="card-img-top" >
              <div class="card-body text-center">
                <h5 class="card-title"><?=$row['nama_masakan'];?></h5>
                <h5 class="card-title">Rp. <?=$row['harga'];?></h5>
                <div class="card-footer text-center">
                 <a href="restoran/aksi_keranjang.php?id=<?= $row["id_masakan"]; ?>"class="btn btn-info btn-sm fa fa-w fa-edit" style="height: 30px;">Beli</a>
               </div>
              </div>
            </div>
          </div> <!-- tutp col--> 
        <?php endwhile;?>
      </div> <!--tutup row-->
    </div> <!--tutup con-->

    <!-- akhir menu -->

    <!-- footer -->
    <footer class="sticky-footer bg-dark">
          <div class="container">
            <div class="row pt-3">
              <div class="col text-center">
                <span>Copyright ©Selfiana 2019</span>
              </div>
            </div>
          </div>
        </footer>
    <!-- akhir footer -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.slim.min.js" ></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
  </body>
</html>