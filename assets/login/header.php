<?php
session_start();
if(isset($_SESSION['username']) AND isset($_SESSION['status']) AND isset($_SESSION['role'])){
    echo "<script>alert('Sudah login !!!');window.location='app/index.php'</script>";
}
?>