<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<?php
	include_once __DIR__ .  '/../layouts/partials/styles.php';
	?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
	<?php
	include_once __DIR__ . '/../layouts/partials/header.php'
	?>
	<div class="container-fluid">
		<section class="h-100">
			<div class="container h-100">
				<div class="row justify-content-md-center h-100">
					<div class="card-wrapper">
						<div class="brand">
							<img src="img/logo.png" alt="logo">
						</div>
						<div class="card fat">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<?php
								if (isset($_SESSION['logged'])): ?>
									<h2>Xin chào </h2><?= $_SESSION['username'] ?> đã quay trở lại trang web.
								<?php else: ?>
									<form method="post" class="my-login-validation" novalidate="">
										<div class="form-group">
											<label for="email">E-Mail Address</label>
											<input id="email" type="email" class="form-control" name="username" id="username" value="" required autofocus>
											<div class="invalid-feedback">
												Email is invalid
											</div>
										</div>

										<div class="form-group">
											<label for="password">Password
												<a href="forgot.html" class="float-right">
													Forgot Password?
												</a>
											</label>
											<input id="password" type="password" class="form-control" name="password" required data-eye>
											<div class="invalid-feedback">
												Password is required
											</div>
										</div>

										<div class="form-group">
											<div class="custom-checkbox custom-control">
												<input type="checkbox" name="remember" id="remember" class="custom-control-input">
												<label for="remember" class="custom-control-label">Remember Me</label>
											</div>
										</div>

										<div class="form-group m-0">
											<button id="btnLogin" name="btnLogin" type="submit" class="btn btn-primary btn-block">
												Login
											</button>
										</div>
										<div class="mt-4 text-center">
											Don't have an account? <a href="register.html">Create One</a>
										</div>
									</form>
								<?php endif; ?>
							</div>
						</div>
						<a href="/salomon.com/index.php">Click vào đây để quay lại!</a></br>
						<div class="footer">
							Copyright &copy;<?php echo date("d-m-Y");?> &mdash; KD & BD Official
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
	<?php
	include_once __DIR__ . '/../layouts/partials/footer.php'
	?>
</body>
<?php
if (isset($_POST['btnLogin'])) {
	include_once __DIR__ . '/../handle/dbconnect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql =
		"SELECT *
	FROM thongtinkhachhang KH
	WHERE KH.kh_tendangnhap = '$username' AND KH.kh_matkhau = '$password'";

	$result = mysqli_query($conn, $sql);
	$account = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//var_dump($account);
	if (is_null($account)) {
		echo 'Đăng nhập thất bại!';
	} else {
		//Đăng nhập thành công => Lưu trữ thông tin trong 
		// Lưu SESSION.
		$_SESSION['logged'] = true; // tắt trình duyệt mở lại thì mất thông tin.
		$_SESSION['username'] = $username;

		echo 'Xin chào ' . $_SESSION['username'] . ' đã quay trở lại trang web';
		// Lưu COOKIES
		//setcookie("logged", true, time() + 100, '/');
		// Kiểm tra trên trình duyệt F12 -> Application -> Cookie (Thu thập dữ liệu người dùng)

		//echo '<script>location.href="index.php";</script>';
		// echo 'Chào mừng ' . $name . ' đã quay lại! ';
	}
}
?>

</html>