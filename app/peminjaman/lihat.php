<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Lihat Peminjaman";
$breadcumb ="Peminjaman > Lihat";
include('../../assets/app/dashboard.php');
$ambilnama = $_SESSION['username'];
$ambilrole = $_SESSION['role'];
if($_SESSION['role']==3){
    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $ceknama = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris WHERE nama_barang LIKE '%$cari%'"));
        $ambilid = $ceknama['id_inventaris'];
        $querypeminjaman = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE id_inventaris='$ambilid' AND tanggal_kembali='0000-00-00' AND username='$ambilnama'");
        $no =1;
    }else{
        $jumlahdatahalaman = 5;
        $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
        $querypeminjaman = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00' AND username='$ambilnama' ORDER BY tanggal_pinjam desc LIMIT $mulai, $jumlahdatahalaman");
        $no = $mulai+1; 
        $result = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00' AND username='$ambilnama'");
        $total = mysqli_num_rows($result);
        $jumlahhalaman = ceil($total/$jumlahdatahalaman);
    }     
}else{
    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $querypeminjaman = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE username LIKE '%$cari%'  AND tanggal_kembali='0000-00-00'");
        $no =1;
    }else{
        $jumlahdatahalaman = 5;
        $halamansekarang = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $mulai = ($jumlahdatahalaman * $halamansekarang) - $jumlahdatahalaman;
        $querypeminjaman = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00' ORDER BY tanggal_pinjam desc LIMIT $mulai, $jumlahdatahalaman");
        $no = $mulai+1; 
        $result = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE tanggal_kembali='0000-00-00'");
        $total = mysqli_num_rows($result);
        $jumlahhalaman = ceil($total/$jumlahdatahalaman);
    }     
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
                                <thead class="kepala-dark">
        <tr>
            <th>#</th>
            <th>Nama barang</th>
            <th>Tanggal pinjam</th>
            <th>Jumlah</th>
            <th>Dipinjam oleh</th>
            <th>Dikelola oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
            while($tampilpeminjaman = mysqli_fetch_array($querypeminjaman)):
                $idinventaris = $tampilpeminjaman['id_inventaris'];
                $ceknamabarang = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id_inventaris ='$idinventaris'"));
        ?>
        <tr>
            <td><?= $no;?></td>
            <td><?= $ceknamabarang['nama_barang'];?></td>
            <td><?= $tampilpeminjaman['tanggal_pinjam'];?></td>
            <td><?= $tampilpeminjaman['jumlah'];?></td>
            <td><?= $tampilpeminjaman['username'];?></td>
            <td><?php if($tampilpeminjaman['pengelola']==NULL){echo '-';}else{echo $tampilpeminjaman['pengelola'];}?>
            </td>
            <td>
                <?php
                    if($ambilrole==3){
                        echo '-';
                    }elseif($ambilrole==2){
                        echo "<button class='button button-kuning'><a
                        href='{$base_url}app/peminjaman/edit.php?id_peminjaman={$tampilpeminjaman['id_peminjaman']}'>Edit</a></button>";
                    }else{
                        echo "<button class='button button-kuning'><a
                        href='{$base_url}app/peminjaman/edit.php?id_peminjaman={$tampilpeminjaman['id_peminjaman']}'>Edit</a></button>";

                        echo "<button class='button button-merah'><a
                        href='{$base_url}assets/sql/peminjaman/hapus.php?id_peminjaman={$tampilpeminjaman['id_peminjaman']}'>Hapus</a></button>";
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