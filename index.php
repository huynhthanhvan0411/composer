<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    // Kiểm tra rỗng
    if (empty($username) || empty($password)) {
        echo "Tên người dùng và mật khẩu không được để trống!";
        exit; 
    }
    // Kiểm tra mật khẩu có ít nhất 6 kí tự
    if (strlen($password) < 6) {
        echo "Mật khẩu phải có ít nhất 6 kí tự!";
        exit; 
    }
    try{
        if ($username === 'admin' && $password === '123456') {
            $_SESSION['user'] = 'admin';
            $_SESSION['pass'] = '123456';
            $_SESSION['expire'] = time() + 86400; // 86400 giây = 1 ngày
            echo "Bạn đã đăng nhập với tư cách là Admin!";
        } elseif ($username === 'user' && $password === '123456') {
            setcookie('user', 'user', time() + 1296000); //  15 ngày = 86400 * 15
            echo "Bạn đã đăng nhập với tư cách là Người dùng!";
        } else {
            echo "Tên người dùng hoặc mật khẩu không chính xác!";
        }
        
    } catch (Exception $e) {
        echo "Đã xảy ra lỗi: " . $e->getMessage();
        exit; 
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="user" required>
        <br>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pass" required>
        <br>
        <button type="submit">Login</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </form>
</body>

</html>