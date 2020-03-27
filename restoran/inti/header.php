<?php 

session_start();

if( !isset($_SESSION["user_username"]) ){
  header("Location: ../login.php");
  exit;
}
 ?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cafe Santuy Backend</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top" >

    <nav class="navbar navbar-expand navbar-dark  static-top" style="background-color: #8B4513">

      <img src="../logo.png" style="width: 40px; margin-right: 5px;" >
      <a class="navbar-brand mr-1" href="index.html" style="font-family: Harrington;">Cafe Santuy</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>


      <!-- Navbar -->

      <ul class="navbar-nav ml-auto ml-auto mr-0 mr-md-3 my-2 my-md-0" >
        
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav" style="background-color: #654321"><!-- #964B00 -->
        <li class="nav-item">
          <a class="nav-link" href="../index/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
    <?php if($_SESSION ['user_level'] == 1) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../user/user.php">
            <i class="fas fa-fw fa-table"></i>
            <span>User</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../masakan/masakan.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Entri Menu</span></a>
        </li>
    <?php } ?>

    <?php if($_SESSION ['user_level'] == 1 || $_SESSION ['user_level'] == 2 || $_SESSION ['user_level'] == 3) { ?>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Entri order</span></a>
        </li>
    <?php } ?>

    <?php if($_SESSION ['user_level'] == 1 || $_SESSION ['user_level'] == 2 || $_SESSION ['user_level'] == 5) { ?>
        <li class="nav-item">
          <a class="nav-link" href="../transaksi/proses_transaksi.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Entri Transaksi</span></a>
        </li>
    <?php } ?>

    <?php if($_SESSION ['user_level'] == 1 || $_SESSION ['user_level'] == 3 || $_SESSION ['user_level'] == 5) { ?>
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Generate Laporan</span></a>
        </li>
    <?php } ?>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

        </div>
        <!-- /.container-fluid -->




