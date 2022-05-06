<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Edit jenis";
$breadcumb ="Jenis > Edit";
$adminonly = 1;
include('../../assets/app/dashboard.php');

$ambil = $_GET['id_jenis'];
$cek = mysqli_query($koneksi,"SELECT * FROM jenis WHERE id_jenis='$ambil'");
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
                        <form action="../../assets/sql/jenis/edit.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Id Jenis</label>
                            <input class="form-control" type="text"name="id_jenis" value="<?= $tampil['id_jenis'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Nama Jenis</label>
                            <input type="text" class="form-control" name="nama" value="<?= $tampil['nama_jenis'];?>">
                            
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