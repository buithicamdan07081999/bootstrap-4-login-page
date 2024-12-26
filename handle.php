<?php
    // 1. Bóc tách dữ liệu theo đường POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    // 2. In ra màn hình
    echo 'Tài khoản là: ' . $username . '<br />';
    echo 'Mật khẩu là: ' . $password;
    // 3. Kiểm tra xem tài khoản, mật khẩu có đúng
    // admin và 123 => đăng nhập thành công
    // nếu k        => đăng nhập thất bại
    if($username == 'admin' && $password == '123') {
        echo '<span style="color: blue;">Đăng nhập thành công!</span>';
    } else {
        echo '<span style="color: red;">Đăng nhập thất bại!</span>';
    }
?>