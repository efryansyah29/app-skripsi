<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Lihat jenis";
$breadcumb ="Jenis > Lihat";
$adminonly = 1;
include('../../assets/app/dashboard.php');
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $queryjenis = mysqli_query($koneksi,"SELECT * FROM jenis WHERE nama_jenis LIKE '%$cari%'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    $queryjenis = mysqli_query($koneksi,"SELECT * FROM jenis ORDER BY nama_jenis LIMIT $mulai, $jumlahdatahalaman");
    $no = $mulai+1;
    
    
    $result = mysqli_query($koneksi,"SELECT * FROM jenis");
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
            <th>Nama Jenis</th>
            <th>Aksi</th>

        </tr>
    </thead>

    <tbody>
        <?php
            while($tampiljenis = mysqli_fetch_array($queryjenis)):
        ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $tampiljenis['nama_jenis'];?></td>
            <td>
                <a class="btn btn-warning"
                        href="<?= $base_url;?>app/jenis/edit.php?id_jenis=<?= $tampiljenis['id_jenis'];?>">Edit</a></button>
                <a class="btn btn-danger"
                        href="<?= $base_url;?>assets/sql/jenis/hapus.php?id_jenis=<?= $tampiljenis['id_jenis'];?>">Hapus</a></button>
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
        <li class="item-halaman"><a href="?halaman=<?= $halamansekarang-1;?>" class="link-halaman">Sebelumnya</a></li>
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
        <li class="item-halaman"><a href="?halaman=<?= $halamansekarang+1;?>" class="link-halaman">Selanjutnya</a></li>
        <?php else : ?>
        <li class="item-halaman disabled"><a href="?halaman=<?= $halamansekarang+1;?>"
                class="link-halaman">Selanjutnya</a></li>
        <?php endif; ?>
    </ul>
</nav>
        </div>


<?php
include('../../assets/templates/app/footer.php');
?>