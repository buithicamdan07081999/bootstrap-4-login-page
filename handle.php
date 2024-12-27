
<?php
session_start();
// 1. Bóc tách dữ liệu theo đường POST
$username = $_POST['username'];
$password = $_POST['password'];
// 2. In ra màn hình
// 3. Kiểm tra xem tài khoản, mật khẩu có đúng
// admin và 123 => đăng nhập thành công
// nếu k        => đăng nhập thất bại
if ($username == 'admin@gmail.com' && $password == '123') {
    echo '<script> location.href="../index.php"</script>';
} else {
    $name = $_SESSION['username'];
    echo 'Chào mừng ' . $name . ' đã quay lại! ';
}
?>