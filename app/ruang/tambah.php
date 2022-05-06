<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Tambah ruang";
$breadcumb ="Ruang > Tambah";
$adminonly = 1;
include('../../assets/app/dashboard.php');
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
                        <form action="../../assets/sql/ruang/tambah.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Nama Ruang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Ruang">
                            
                           <div style="text-align:center;"><br>
                           <input type="submit" value="Tambah" class="btn btn-primary" >
                        </div>
                        </div>
                        </form>
                        </div>
                </main>

                </div>
<?php
include('../../assets/templates/app/footer.php');
?>