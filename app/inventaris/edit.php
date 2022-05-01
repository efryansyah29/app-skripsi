<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Edit inventaris";
$breadcumb ="Inventaris > Edit";
$adminonly = 1;

$ambil = $_GET['id_inventaris'];
$cek = mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id_inventaris='$ambil'");
$tampil = mysqli_fetch_array($cek)
?>
<!DOCTYPE html>
<html lang="en">
<?php
//error_reporting(0);

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
include '../../assets/sql/koneksi.php';
      
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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../assets/app/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Ganti Password</a></li>
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
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataAkun" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/akun/index.php">List Akun</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Inventaris</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataBarang" aria-expanded="false" aria-controls="collapseDataBarang">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataBarang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/inventaris/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/inventaris/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataJenis" aria-expanded="false" aria-controls="collapseDataJenis">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Jenis
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataJenis" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/jenis/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/jenis/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRuang" aria-expanded="false" aria-controls="collapseRuang">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Ruang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseRuang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/ruang/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/ruang/tambah.php">Tambah Data</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Fitur</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPengembalian" aria-expanded="false" aria-controls="collapseDataPengembalian">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pengembalian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPengembalian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/pengembalian/index.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/pengembalian/pengembalian.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPeminjaman" aria-expanded="false" aria-controls="collapseDataPeminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/peminjaman/tambah.php">Tambah Data</a>
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
                                    <a class="nav-link" href="../app/pengembalian/index.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/pengembalian/pengembalian.php">Tambah Data</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataPeminjaman" aria-expanded="false" aria-controls="collapseDataPeminjaman">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Peminjaman
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseDataPeminjaman" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/peminjaman/tambah.php">Tambah Data</a>
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
                                    <a class="nav-link" href="../app/peminjaman/lihat.php">Lihat Data</a>
                                    <a class="nav-link" href="../app/peminjaman/tambah.php">Tambah Data</a>
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
              <div id="layoutSidenav_content">
            

<main>
<div class="container-fluid px-4">
    <div class="card mb-4">
  <h5 class="card-header">Featured</h5>
  <div class="card text-center">
  <div class="card-body">
    <div class="kotak-badan mt-2">
        <form action="../../assets/sql/inventaris/edit.php" method="POST">
            <div class="form-isi">
                <input type="hidden" name="id_inventaris" value="<?= $tampil['id_inventaris'];?>">
                <p>Id inventaris</p>
                <small class="form-input"><?= $tampil['id_inventaris'];?></small>
            </div>
            <div class="form-isi">
                <p>Nama barang</p>
                <input type="text" name="nama" class="form-input" placeholder="Masukkan nama barang"
                    value="<?= $tampil['nama_barang'];?>">
            </div>
            <div class="form-isi">
                <p>Kondisi</p>
                <input type="text" name="kondisi" class="form-input" placeholder="Kondisi barang"
                    value="<?= $tampil['kondisi'];?>">
            </div>
            <div class="form-isi">
                <p>Jumlah</p>
                <input type="number" name="jumlah" class="form-input" placeholder="Jumlah barang"
                    value="<?= $tampil['jumlah'];?>">
            </div>
            <div class="form-isi">
                <p>Tanggal didaftarkan</p>
                <input type="date" name="tanggal" class="form-input" value="<?= $tampil['tanggal_register'];?>">
            </div>
            <div class="form-isi">
                <p>Jenis</p>
                <select name="jenis" class="form-input">
                    <?php
                        $jenis=mysqli_query($koneksi,"SELECT * FROM jenis");
                        while($tampiljenis= mysqli_fetch_array($jenis)):
                    ?>
                    <option value="<?= $tampiljenis['id_jenis'];?>"
                        <?php if($tampiljenis['id_jenis']==$tampil['id_jenis']){echo 'selected';}?>>
                        <?= $tampiljenis['nama_jenis'];?>
                    </option> <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-isi">
                <p>Ruang</p>
                <select name="ruang" class="form-input">
                    <?php
                        $ruang=mysqli_query($koneksi,"SELECT * FROM ruang");
                        while($tampilruang= mysqli_fetch_array($ruang)):
                    ?>
                    <option value="<?= $tampilruang['id_ruang'];?>"
                        <?php if($tampilruang['id_ruang']==$tampil['id_ruang']){echo 'selected';}?>>
                        <?= $tampilruang['nama_ruang'];?>
                    </option> <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <input type="submit" value="Ubah" class="form-submit mx-auto">
        </form>
    </div>
</div>
</div>
</div>
</div>
    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                                
                             
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                
                            </div>
                        </div>
<div class="kotak mt-3 mx-auto mb-4" style="width:70%;">
    <div class="kotak-kepala center">
        <h2>Edit data inventaris</h2>
    </div>
   
</div>
</main>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/app/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../assets/app/js/datatables-simple-demo.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>