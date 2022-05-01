<?php
session_start();
include('../../assets/sql/koneksi.php');
$base_url= "../../";
$judul = "Edit peminjaman";
$breadcumb ="Peminjaman > Edit";
$operatorakses = 1;
include('../../assets/templates/app/header.php');

$ambilid = $_GET['id_peminjaman'];
$tampil = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE id_peminjaman='$ambilid'"));

$idinventaris = $tampil['id_inventaris'];
$inventaris=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM inventaris WHERE id_inventaris='$idinventaris'"));
?>

<div class="kotak mt-3 mb-4 mx-auto" style="width:70%;">
    <div class="kotak-kepala center">
        <h2>Edit data peminjaman</h2>
    </div>
    <div class="kotak-badan mt-2">
        <form action="../../assets/sql/peminjaman/edit.php" method="POST">
            <div class="form-isi">
                <input type="hidden" name="id_peminjaman" value="<?= $tampil['id_peminjaman'];?>">
                <p>Id peminjaman</p>
                <small class="form-input"><?= $tampil['id_peminjaman'];?></small>
            </div>
            <div class="form-isi">
                <input type="hidden" name="id_inventaris" value="<?= $tampil['id_inventaris'];?>">
                <p>Inventaris</p>
                <small class="form-input"><?= $inventaris['nama_barang'];?></small>
            </div>
            <div class="form-isi">
                <p>Tanggal pinjam</p>
                <input type="date" name="tanggal_pinjam" class="form-input" value="<?= $tampil['tanggal_pinjam'];?>">
            </div>
            <div class="form-isi">
                <p>Jumlah</p>
                <input type="number" name="jumlah" class="form-input" placeholder="Masukkan jumlah"
                    value="<?= $tampil['jumlah'];?>">
            </div>
            <input type="submit" value="Ubah" class="form-submit mx-auto">
        </form>
    </div>
</div>

<?php
include('../../assets/templates/app/footer.php');
?>