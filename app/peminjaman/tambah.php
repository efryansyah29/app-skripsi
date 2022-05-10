<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Tambah peminjaman";
$breadcumb ="Peminjaman > Tambah";
include('../../assets/app/dashboard.php');

$inventaris=mysqli_query($koneksi,"SELECT * FROM inventaris LEFT JOIN ruang ON inventaris.id_ruang = ruang.id_ruang ORDER BY nama_barang");
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
                        <form action="../../assets/sql/peminjaman/tambah.php" method="POST">
                        <div class="card-header">Edit Data Inventaris</div>
                            <div class="card-body">
                            
                            <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                            <select name="inventaris" class="form-select">
                    <?php
                        while($tampilinventaris= mysqli_fetch_array($inventaris)) :
                          //  $tampilruang= mysqli_fetch_array($ruang))
                    ?>
                    <option value="<?= $tampilinventaris['id_inventaris'];?>">
                        <?= $tampilinventaris['nama_barang'];?> Lokasi di ruangan : <?= $tampilinventaris['nama_ruang'];?>
                    </option>

                    <?php
                    endwhile;
                    ?>
                </select>
                            <label for="exampleFormControlInput1" class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control">
                            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah barang">
                            
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