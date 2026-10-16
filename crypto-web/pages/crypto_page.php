<?php
   session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['password'])){
        include('../class_process/login_process.php');
        $p = new login();
        $p->confirmlogin($_SESSION['user'], $_SESSION['password']);
    }
    else{
        header('location:../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Chào mừng đến với trang chủ <?php echo $_SESSION['user'] ?>
</body>
</html>