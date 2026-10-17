<?php
    include("class_process/login_process.php");
    $p = new login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="layout/CSS/login_style.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="" method="post">
            
            <div class="input-group">
                <label for="email">Tên đăng nhập hoặc Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
            </div>
            
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            
            <div class="options">
                <label class="remember">
                    <input type="checkbox" name="remember"> Nhớ mật khẩu
                </label>
                <a href="#" class="forgot-password">Quên mật khẩu?</a>
            </div>
            
            <input type="submit" class="btn-login" value="Đăng nhập" name="nutdangnhap">
            
            <div class="register-link">
                Chưa có tài khoản? <a href="#">Đăng ký ngay</a>
            </div>
            <?php
                if(isset($_POST['nutdangnhap'])){
                    switch($_POST['nutdangnhap']){
                        case 'Đăng nhập':{
                            $user = $_POST['email'];
                            $password = $_POST['password'];
                            if($p->mylogin($user, $password)==0){
                                header('location:index.php');
                                exit();
                            }
                            else{
                                header('location:pages/crypto_page.php');
                                exit();
                            }
                        }
                    }
                }
            ?>
        </form>
    </div>
</body>
</html>