<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Edit akun";
$breadcumb ="Akun > Edit";
$adminonly = 1;
include('../../assets/app/dashboard.php');

$ambil = $_GET['username'];
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
                        <form action="../../assets/sql/akun/edit.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input class="form-control" type="text" name="username" value="<?= $tampil['username'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                            <input type="text" class="form-control" name="nama" value="<?= $tampil['nama_user'];?>" placeholder="Masukkan nama">
                            <label for="exampleFormControlInput1" class="form-label">Kontak</label>
                            <input type="text" class="form-control" name="kontak" value="<?= $tampil['kontak'];?>" placeholder="Masukkan kontak">
                            <label for="exampleFormControlInput1" class="form-label">Level</label>
                              <select name="level" class="form-select">
                            <?php
                              $ceklevel = mysqli_query($koneksi,"SELECT * FROM level");
                               while($tampillevel = mysqli_fetch_array($ceklevel)):?>
                                 <option value="<?= $tampillevel['id_level'];?>"
                                   <?php if($tampillevel['id_level']==$tampil['id_level']){echo 'selected';}?>>
                                  <?= $tampillevel['nama_level'];?></option> <?php
                                  endwhile;
                                 ?>
                                </select>
                           <div style="text-align:center;"><br>
                           <input type="submit" value="Ubah" class="btn btn-primary">
                        </div>
                        </div>
                        </form>
                        </div>


</main>
</div>
<?php
include('../../assets/templates/app/footer.php');
?>