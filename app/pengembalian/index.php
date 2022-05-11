<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "List pengembalian";
$breadcumb ="List Pengembalian";
$operatorakses = 1;
include('../../assets/app/dashboard.php');

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $querypengembalian = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE username LIKE '%$cari%'  AND tanggal_kembali='0000-00-00'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    $querypengembalian = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00' ORDER BY tanggal_pinjam asc LIMIT $mulai, $jumlahdatahalaman");
    $no = $mulai+1; 
    $result = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00'");
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
            <th>Tanggal pinjam</th>
            <th>Jumlah</th>
            <th>Dipinjam oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
            while($tampilpengembalian = mysqli_fetch_array($querypengembalian)):
                $idinventaris = $tampilpengembalian['id_inventaris'];
                $ceknamabarang = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id_inventaris ='$idinventaris'"));
        ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $ceknamabarang['nama_barang'];?></td>
            <td><?= $tampilpengembalian['tanggal_pinjam'];?></td>
            <td><?= $tampilpengembalian['jumlah'];?></td>
            <td><?= $tampilpengembalian['username'];?></td>
            <td>
                <button class="button button-biru"><a
                        href="<?= $base_url; ?>app/pengembalian/pengembalian.php?id_peminjaman=<?= $tampilpengembalian["id_peminjaman"];?>">Pengembalian</a></button>
            </td>
        </tr>

        <?php
            $no++;
            endwhile;
        ?>
    </tbody>
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

<?php
include('../../assets/templates/app/footer.php');
?>