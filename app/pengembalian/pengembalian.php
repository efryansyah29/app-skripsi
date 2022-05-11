<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Pengembalian barang";
$breadcumb ="Pengembalian > Pengembalian barang";
$operatorakses = 1;
include('../../assets/app/dashboard.php');

$ambilid = $_GET['id_peminjaman'];
$tampil = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE id_peminjaman='$ambilid'"));


$tampilinventaris=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris ORDER BY nama_barang"));
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
                        <form action="../../assets/sql/pengembalian/edit.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            <label for="exampleFormControlInput1" class="form-label">Id Peminjaman</label>
                            <input class="form-control"  value="<?= $tampil['id_peminjaman'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <input class="form-control" value="<?= $tampilinventaris['nama_barang'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Pinjam</label>
                            <input class="form-control" value="<?= $tampil['tanggal_pinjam'];?>" readonly >
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tanggal_kembali">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                            <input class="form-control" value="<?= $tampil['jumlah'];?>" readonly >
                            
                           <div style="text-align:center;"><br>
                           <input type="submit" value="Terima" class="btn btn-primary" >
                        </div>
                        </div>
                        </form>
                        </div>
                </main>

                </div>

<?php
include('../../assets/templates/app/footer.php');
?>