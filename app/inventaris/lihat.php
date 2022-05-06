<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Lihat inventaris";
$breadcumb ="Inventaris > Lihat";
$adminonly = 1;
include('../../assets/app/dashboard.php');
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $queryinventaris = mysqli_query($koneksi,"SELECT * FROM inventaris WHERE nama_barang LIKE '%$cari%'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    $queryinventaris = mysqli_query($koneksi,"SELECT * FROM inventaris ORDER BY nama_barang LIMIT $mulai, $jumlahdatahalaman");
    $no = $mulai+1;
    
    
    $result = mysqli_query($koneksi,"SELECT * FROM inventaris");
    $total = mysqli_num_rows($result);
    $jumlahhalaman = ceil($total/$jumlahdatahalaman);
}     
?>
              <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
            <th>#</th>
            <th>Nama barang</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Tanggal register</th>
            <th>Jenis</th>
            <th>Ruang</th>
            <th>Dikelola oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
            while($tampilinventaris = mysqli_fetch_array($queryinventaris)):
                $tampiljenis = $tampilinventaris['id_jenis'];
                $tampilruang = $tampilinventaris['id_ruang'];
                $jenis= mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jenis WHERE id_jenis='$tampiljenis'"));
                $ruang= mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ruang WHERE id_ruang='$tampilruang'"));
        ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $tampilinventaris['nama_barang'];?></td>
            <td><?= $tampilinventaris['kondisi'];?></td>
            <td><?= $tampilinventaris['jumlah'];?></td>
            <td><?= $tampilinventaris['tanggal_register'];?></td>
            <td><?= $jenis['nama_jenis'];?></td>
            <td><?= $ruang['nama_ruang'];?></td>
            <td><?= $tampilinventaris['username'];?></td>
            <td>
                <a class="btn btn-warning"
                        href="<?= $base_url;?>app/inventaris/edit.php?id_inventaris=<?= $tampilinventaris['id_inventaris'];?>">Edit</a>
                <a class="btn btn-danger"
                        href="<?= $base_url;?>assets/sql/inventaris/hapus.php?id_inventaris=<?= $tampilinventaris['id_inventaris'];?>">Hapus</a>
            </td>
        </tr>

        <?php
            $no++;
            endwhile;
        ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>#</th>
            <th>Nama barang</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Tanggal register</th>
            <th>Jenis</th>
            <th>Ruang</th>
            <th>Dikelola oleh</th>
            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
                            </div>
                        </div>
                    </div>
                </main>
        </div>