<?php
session_start();
include('../koneksi.php');
$base_url = "../../../";
if(!isset($_SESSION['username']) AND !isset($_SESSION['status']) AND !isset($_SESSION['role'])){
    echo "<script>alert('Login dahulu !!!');window.location='{$base_url}index.php'</script>";
}


if($_SESSION['role']!='1'){
    echo "<script>alert('Akses ditolak !!!');window.location='{$base_url}app/index.php'</script>";
}else{
    $a = $_GET['id_inventaris'];
    $query = mysqli_query($koneksi,"DELETE from inventaris WHERE id_inventaris='$a'");
    if($query){
        echo "<script>alert('Berhasil dihapus !!!');window.location='{$base_url}app/index.php'</script>";
    }else{
        echo "<script>alert('Gagal dihapus !!!');window.location='{$base_url}app/index.php'</script>";
    }
}

?>