<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username']) AND !isset($_SESSION['status']) AND !isset($_SESSION['role'])){
    echo "<script>alert('Login dahulu !!!');window.location='{$base_url}index.php'</script>";
}
if(isset($adminonly)){
    if($_SESSION['role']!='1'){
        echo "<script>alert('Akses ditolak !!!');window.location='{$base_url}app/index.php'</script>";
    }
}

if(isset($operatorakses)){
    if($_SESSION['role'] == '3'){
        echo "<script>alert('Akses ditolak !!!');window.location='{$base_url}app/index.php'</script>";
    }
}
include '../assets/sql/koneksi.php';
      
                // mengambil data barang
                $data_barang = mysqli_query($koneksi,"SELECT * FROM inventaris");

                // menghitung data barang
                $jumlah_barang = mysqli_num_rows($data_barang);

                $data_user = mysqli_query($koneksi, "SELECT * FROM user");
                $jumlah_user = mysqli_num_rows($data_user);



?>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
        <link href="<?= $base_url;?>assets/app/css/styles.css" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/83a6dbb254.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
 


    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= $base_url;?>app/gantipassword.php">Ganti password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../assets/sql/keluar.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <?php
            if($_SESSION['role']==1){
                            echo'<div class="sb-sidenav-menu-heading">Akun</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataAkun" aria-expanded="false" aria-controls="collapseDataAkun">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                Data Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataAkun" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/akun/index.php">List Akun</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Inventaris</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataBarang" aria-expanded="false" aria-controls="collapseDataBarang">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-laptop-file"></i></i></div>
                                Data Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataBarang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/inventaris/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/inventaris/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataJenis" aria-expanded="false" aria-controls="collapseDataJenis">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Jenis
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataJenis" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/jenis/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/jenis/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRuang" aria-expanded="false" aria-controls="collapseRuang">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-circle-check"></i></i></div>
                                Data Ruang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseRuang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/ruang/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/ruang/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Fitur</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPengembalian" aria-expanded="false" aria-controls="collapseDataPengembalian">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-hand"></i></div>
                                Pengembalian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPengembalian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/pengembalian/index.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/pengembalian/pengembalian.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPeminjaman" aria-expanded="false" aria-controls="collapseDataPeminjaman">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding"></i></div>
                                Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/tambah.php">Tambah Data</a>
                                </nav>
                            </div>';
                            }else if ($_SESSION['role']==2){
                            echo'<div class="sb-sidenav-menu-heading">Fitur</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPengembalian" aria-expanded="false" aria-controls="collapseDataPengembalian">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pengembalian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPengembalian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/pengembalian/index.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/pengembalian/pengembalian.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPeminjaman" aria-expanded="false" aria-controls="collapseDataPeminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/tambah.php">Tambah Data</a>
                                </nav>
                            </div>';
                            }else{
                            echo '<div class="sb-sidenav-menu-heading">Fitur</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPeminjaman" aria-expanded="false" aria-controls="collapseDataPeminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="'.$base_url.'app/peminjaman/tambah.php">Tambah Data</a>
                                </nav>
                            </div>';
                            }
                            ?>
                    </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                       <?= $_SESSION['nama'];?>
                    </div>
                </nav>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="<?= $base_url;?>assets/app/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script src="<?= $base_url;?>assets/app/js/datatables-simple-demo.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    </body>
</html>
