<?php
error_reporting(0);
$judul = "Daftar akun PSNP";
include('assets/login/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Aplikasi Inventaris</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
    <script src="https://kit.fontawesome.com/83a6dbb254.js" crossorigin="anonymous"></script>
<!--===============================================================================================-->
</head>
<?php
$judul = "Masuk akun PSNP";
include('assets/login/header.php');
?>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/login/images/dishublogo.png" alt="IMG">
				</div>

				<form action="assets/sql/login/daftarakun.php" method="POST" class="login100-form validate-form">
					<span class="login100-form-title">
						Daftar Akun
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nama" placeholder="Masukkan Nama" REQUIRED>

						<span class="focus-input100"></span>
						<span class="symbol-input100">
                        <i class="fa-solid fa-address-card"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="kontak" placeholder="Masukkan Nomor Handphone" REQUIRED>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                        <i class="fa-solid fa-mobile"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" placeholder="Masukkan Username" REQUIRED>

						<span class="focus-input100"></span>
						<span class="symbol-input100">
                        <i class="fa-solid fa-user-lock"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" placeholder="Masukkan Password" REQUIRED>

						<span class="focus-input100"></span>
						<span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Daftar
						</button>
					</div>

					

					<div class="text-center p-t-136">
						<a class="txt2" href="index.php">
							Sudah Memiliki akun? Silahkan Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/login/js/main.js"></script>

</body>
</html>
<?php
include('assets/templates/login/footer.php');
?>