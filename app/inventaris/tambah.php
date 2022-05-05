<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Tambah inventaris";
$breadcumb ="Inventaris > Tambah";
$adminonly = 1;
include('../../assets/app/dashboard.php');

$jenis=mysqli_query($koneksi,"SELECT * FROM jenis");
$ruang=mysqli_query($koneksi,"SELECT * FROM ruang");
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
                        <form action="../../assets/sql/inventaris/tambah.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama barang">
                            <label for="exampleFormControlInput1" class="form-label">Kondisi</label>
                                <select class="form-select" aria-label="Default select example" name="kondisi" placeholder="Kondisi Barang">
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah barang">
                            <label for="exampleFormControlInput1" class="form-label" >Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" ">
                            <label for="exampleFormControlInput1" class="form-label" >Jenis</label>
                                <select class="form-select" aria-label="Default select example" name="jenis" >
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
                            <label for="exampleFormControlInput1" class="form-label">Ruang</label>
                            <select class="form-select" aria-label="Default select example" name="ruang">
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