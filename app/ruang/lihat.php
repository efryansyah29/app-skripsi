<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Lihat ruang";
$breadcumb ="Ruang > Lihat";
$adminonly = 1;
include('../../assets/app/dashboard.php');
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $queryruang = mysqli_query($koneksi,"SELECT * FROM ruang WHERE nama_ruang LIKE '%$cari%'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    $queryruang = mysqli_query($koneksi,"SELECT * FROM ruang ORDER BY nama_ruang LIMIT $mulai, $jumlahdatahalaman");
    $no = $mulai+1;

    $result = mysqli_query($koneksi,"SELECT * FROM ruang");
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
            <th>Nama Ruang</th>
            <th>Aksi</th>

        </tr>
    </thead>
    <tbody>
        <?php
            while($tampilruang = mysqli_fetch_array($queryruang)):
        ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $tampilruang['nama_ruang'];?></td>
            <td>
                <a class="btn btn-warning"
                        href="<?= $base_url;?>app/ruang/edit.php?id_ruang=<?= $tampilruang['id_ruang'];?>">Edit</a></button>
                <a class="btn btn-danger"
                        href="<?= $base_url;?>assets/sql/ruang/hapus.php?id_ruang=<?= $tampilruang['id_ruang'];?>">Hapus</a></button>
            </td>
        </tr>

        <?php
            $no++;
            endwhile;
        ?>
    </tbody>
</table>
<?php
include('../../assets/app/footer.php');
?>