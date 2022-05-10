<?php
session_start();
include('../assets/sql/koneksi.php');
$base_url= "../";
$judul = "Ganti password";
$breadcumb ="Password > Ubah";
include('../assets/app/dashboard.php');

$ambil = $_SESSION['username'];
$cek = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$ambil'");
$tampil = mysqli_fetch_array($cek)
?>

<div id="layoutSidenav_content">
<main>

    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Inventaris</li>
                        </ol>
                   
                        <div class="card mb-4">
                        <form action="../assets/sql/gantipassword.php" method="POST">
                        <div class="card-header">Ganti Password</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input class="form-control" type="text"name="username" value="<?= $tampil['username'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Password Lama</label>
                            <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password lama">
                            <label for="exampleFormControlInput1" class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru">
                            <label for="exampleFormControlInput1" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_baru" class="form-control" placeholder="Konfirmasi password baru">
                            
                           <div style="text-align:center;"><br>
                           <input type="submit" value="Ubah" class="btn btn-primary">
                        </div>
                        </div>
                        </form>
                        </div>



<?php
include('../assets/templates/app/footer.php');
?>