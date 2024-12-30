<!DOCTYPE html>
<html lang="en">
<!-- https://nentang.vn/app/edu/khoa-hoc/thiet-ke-lap-trinh-web-backend/lap-trinh-can-ban-php/lessons/cookie-trong-php	 -->
<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
	// Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
	session_start();
}
?>

<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<?php
	include_once __DIR__ .  '/../../layouts/partials/styles.php';
	include_once __DIR__ . '/../../handle/dbconnect.php';
	?>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
	<!-- header -->
	<?php include_once __DIR__ . '/../../layouts/partials/header_fe.php'; ?>
	<!-- end header -->

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
								<?php
								// Đã đăng nhập rồi -> điều hướng về trang chủ
								if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) :
								?>
									<h4 class="card-title">Wellcome <?= $_SESSION['logged'] ?> </h4>
									<form method="post" class="my-logout-validation" novalidate="">
										<div class="form-group m-0">
											<button id="btnLogout" name="btnLogout" type="submit" class="btn btn-primary btn-block">
												Logout
											</button>
										</div>
										</h4>
									</form>
									<?php
									if (isset($_POST['btnLogout'])) {
										if (isset($_SESSION['logged'])) {
											unset($_SESSION['logged']);
											echo '<script>location.href = "/salomon.com/backend/auth/login.php";</script>';
										}
									}
									?>
								<?php else: ?>
									<h4 class="card-title">Login</h4>
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
								<?php
									if (isset($_POST['btnLogin'])) {
										$username = $_POST['username'];
										$password = $_POST['password'];
										$sql =
											"   SELECT *
												FROM thongtinkhachhang KH
												WHERE KH.kh_tendangnhap = '$username' AND KH.kh_matkhau = '$password'";

										$result = mysqli_query($conn, $sql);
										$account = mysqli_fetch_array($result, MYSQLI_ASSOC);
										$name = $account['kh_ten'];
										//var_dump($account);
										if (is_null($account)) {
											echo 'Đăng nhập thất bại!';
										} else {
											// Lưu thông tin Tên tài khoản user đã đăng nhập
											$_SESSION['logged'] = $name;
											echo '<script>location.href = "/salomon.com/backend/auth/login.php";</script>';
										}
									}
								endif;
								?>
							</div>
						</div>
						<div style="text-align: center;" class="mt-5"><a href="/salomon.com/index.php">Tiếp tục mua sắm!</a></br></div>
						<div class="footer">
							Copyright &copy;<?php echo date("d-m-Y"); ?> &mdash; KD&BD Official
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


</html>