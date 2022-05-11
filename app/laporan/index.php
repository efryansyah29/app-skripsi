<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Laporan";
$breadcumb ="Laporan";
$adminonly =1;
include('../../assets/app/dashboard.php');
$ambilnama = $_SESSION['username'];
$ambilrole = $_SESSION['role'];

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $querylaporan = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE username LIKE '%$cari%'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    $querylaporan = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali!='0000-00-00' ORDER BY tanggal_kembali LIMIT $mulai, $jumlahdatahalaman");
    $no = $mulai+1; 
    $result = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali!='0000-00-00'");
    $total = mysqli_num_rows($result);
    $jumlahhalaman = ceil($total/$jumlahdatahalaman);
}     

$ambilinventaris = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM inventaris"));
$jumlahpengguna = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM user WHERE status='Aktif'"));
$keseluruhan = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM peminjaman"));
$datapinjam = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali ='0000-00-00'"));
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
                                <thead class="kepala-dark">
        <tr>
                <th>#</th>
                <th>Nama barang</th>
                <th>Tanggal pinjam</th>
                <th>Tanggal kembali</th>
                <th>Jumlah</th>
                <th>Dipinjam oleh</th>
                <th>Dikelola oleh</th>
                <th class="aksi">Aksi</th>
            </tr>
    </thead>

    <tbody>
            <?php
            while($tampillaporan = mysqli_fetch_array($querylaporan)):
                $idinventaris = $tampillaporan['id_inventaris'];
                $ceknamabarang = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id_inventaris ='$idinventaris'"));
        ?>
            <tr>
                <td><?= $no;?></td>
                <td><?= $ceknamabarang['nama_barang'];?></td>
                <td><?= $tampillaporan['tanggal_pinjam'];?></td>
                <td><?= $tampillaporan['tanggal_kembali'];?></td>
                <td><?= $tampillaporan['jumlah'];?></td>
                <td><?= $tampillaporan['username'];?></td>
                <td><?= $tampillaporan['pengelola'];?></td>
                <td class="aksi">
                    <button class='button button-merah'><a
                            href='<?= $base_url;?>assets/sql/laporan/rollback.php?id_peminjaman=<?= $tampillaporan['id_peminjaman'];?>'>Rollback</a></button>
                    <button class='button button-merah'><a
                            href='<?= $base_url;?>assets/sql/laporan/hapus.php?id_peminjaman=<?= $tampillaporan['id_peminjaman'];?>'>Hapus</a></button>
                </td>
            </tr>

            <?php
            $no++;
            endwhile;
        ?>
        </tbody>
</table>

    <nav class="mt-2 mb-4">
        <ul class="halaman konten-tengah">

            <?php if($halamansekarang >1): ?>
            <li class="item-halaman"><a href="?halaman=<?= $halamansekarang-1;?>" class="link-halaman">Sebelumnya</a>
            </li>
            <?php else :?>
            <li class="item-halaman disabled"><a href="?halaman=<?= $halamansekarang-1;?>"
                    class="link-halaman">Sebelumnya</a></li>
            <?php endif; ?>

            <?php for($i=1;$i<= ($jumlahhalaman);$i++): ?>
            <?php if($i == $halamansekarang): ?>

            <li class="item-halaman active"><a href="?halaman=<?= $i;?>" class="link-halaman"><?= $i;?></a></li>

            <?php else : ?>

            <li class="item-halaman"><a href="?halaman=<?= $i;?>" class="link-halaman"><?= $i;?></a></li>

            <?php
        endif;
        ?>

            <?php
        endfor;
        ?>

            <?php if($halamansekarang < $jumlahhalaman): ?>
            <li class="item-halaman"><a href="?halaman=<?= $halamansekarang+1;?>" class="link-halaman">Selanjutnya</a>
            </li>
            <?php else : ?>
            <li class="item-halaman disabled"><a href="?halaman=<?= $halamansekarang+1;?>"
                    class="link-halaman">Selanjutnya</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="mx-auto center mb-3 mt-3 print"><button style="width: 40%; height:3rem;"
            onClick="window.print()">Print</button>
    </div>

</nav>
<?php
include('../../assets/templates/app/footer.php');
?>