<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "List akun";
$breadcumb ="List akun";
$adminonly = 1;
include('../../assets/app/dashboard.php');
if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $queryakun = mysqli_query($koneksi,"SELECT * FROM user WHERE username LIKE '%$cari%' OR nama_user LIKE '%$cari%' OR kontak LIKE '%$cari%'");
    $no =1;
}else{
    $jumlahdatahalaman = 5;
    $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
    if($_SESSION['username']=="admin"){
        $queryakun = mysqli_query($koneksi,"SELECT * FROM user ORDER BY status desc LIMIT $mulai, $jumlahdatahalaman");
        $result = mysqli_query($koneksi,"SELECT * FROM user");
    }else{
        $queryakun = mysqli_query($koneksi,"SELECT * FROM user WHERE username != 'admin' AND id_level != '1' ORDER BY status desc LIMIT $mulai, $jumlahdatahalaman");
        $result = mysqli_query($koneksi,"SELECT * FROM user WHERE username != 'admin' AND id_level != '1'");
    }
    $no = $mulai+1;

    
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
            <th>Level</th>
            <th>Nama</th>
            <th>kontak</th>
            <th>Username</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        </tr>
    </thead>
    <tbody>
        <?php
            while($tampilakun = mysqli_fetch_array($queryakun)):
        ?>
        <tr>
            <td><?= $no;?></td>
            <?php
                $idlevel = $tampilakun['id_level'];
                $querylevel =mysqli_query($koneksi,"SELECT * FROM level WHERE id_level= '$idlevel'");
                $tampillevel = mysqli_fetch_array($querylevel);
            ?>
            <td><?= $tampillevel['nama_level'];?></td>
            <td><?= $tampilakun['nama_user'];?></td>
            <td><?= $tampilakun['kontak'];?></td>
            <td><?= $tampilakun['username'];?></td>
            <td><?= $tampilakun['status'];?></td>
            <td>
                <?php
                    if($tampilakun['status']=="Belum aktif"){
                        echo "<a class='btn btn-info'
                        href='{$base_url}assets/sql/akun/aktivasi.php?username={$tampilakun['username']}'>Aktivasi</a></button>";
                    }
                ?>

                <a class='btn btn-warning'
                        href='<?= $base_url;?>app/akun/edit.php?username=<?= $tampilakun['username'];?>'>Edit</a></button>
                <?php
                    if($tampilakun['username'] != $_SESSION['username']){
                        echo "<a class='btn btn-danger'
                        href='{$base_url}assets/sql/akun/hapus.php?username={$tampilakun['username']}'>Hapus</a></button>";
                }
                ?>

            </td>
        </tr>

        <?php
            $no++;
            endwhile;
        ?>
    </tbody>
</table>

<?php
include('../../assets/templates/app/footer.php');
?>