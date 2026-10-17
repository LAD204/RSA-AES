<?php
   session_start();
    if(isset($_SESSION['user']) && isset($_SESSION['password'])){
        include('../class_process/login_process.php');
        $p = new login();
        include('../class_process/algorithm_process.php');
        $algor = new encrypt_algorithm();
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
    <link rel="stylesheet" href="../layout/CSS/crypto_style.css">
</head>
<body>
     <div class="crypto-container">
        <span><h2 id="title"></h2></span>
        
        <form id="crypto-form" method="post" name="crypto">
            <div class="form-group">
                <label for="algorithm">1. Chọn thuật toán</label>
                <select id="algorithm" name="algorithm" class="form-control">
                    <option value="None">---</option>
                    <option value="AES">Thuật toán AES (Khóa đối xứng)</option>
                    <option value="RSA">Thuật toán RSA (Khóa bất đối xứng)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="inputText">2. Nhập văn bản đầu vào</label>
                <textarea id="inputText" name="inputText" class="form-control" rows="4" placeholder="Nhập văn bản cần mã hóa hoặc đoạn mã cần giải mã vào đây..."></textarea>
            </div>

            <div class="form-group">
                <label for="keyInput">3. Nhập Khóa</label>
                <textarea id="keyInput" name="keyInput" class="form-control" rows="3" placeholder="Nhập Khóa..."></textarea>
            </div>

            <div class="action-buttons">
                <input type="submit" class="btn btn-encrypt" id="btnEncrypt" name="thucthi" value="Mã Hóa">
                <input type="submit" class="btn btn-decrypt" id="btnDecrypt" name="thucthi" value="Giải Mã">
            </div>

            <div class="form-group">
                <label for="outputText">4. Kết quả</label>
                <textarea id="outputText" name="outputText" class="form-control" rows="5" placeholder="Kết quả..." readonly>
                    <?php
                        if(isset($_POST['thucthi'])){
                            switch($_POST['thucthi']){
                                case 'Mã Hóa':{
                                    if($_POST['algorithm']=='AES'){
                                        $input = $_POST['inputText'];
                                        $key = $_POST['keyInput'];
                                        $result = $algor->encryptAES($input, $key);
                                        if($result!=false){
                                            echo $result;
                                        }
                                        else{
                                            echo 'Đã có lỗi xảy ra!';
                                        }
                                    }
                                    else if($_POST['algorithm']=='RSA'){
                                        $input = $_POST['inputText'];
                                        $key = $_POST['keyInput'];
                                        $result = $algor->encryptRSA($input, $key);
                                        if($result!=false){
                                            echo $result;
                                        }
                                        else{
                                            echo 'Đã có lỗi xảy ra!';
                                        }
                                    }
                                    else if($_POST['algorithm']=='None'){
                                        echo 'Vui lòng chọn thuật toán để tiến hành mã hóa';
                                    }
                                    break;
                                }
                                case 'Giải Mã':{
                                    if($_POST['algorithm']=='AES'){
                                        $input = $_POST['inputText'];
                                        $key = $_POST['keyInput'];
                                        $result = $algor->decryptAES($input, $key);
                                        if($result!=false){
                                            echo $result;
                                        }
                                        else{
                                            echo 'Đã có lỗi xảy ra!';
                                        }
                                    }
                                    else if($_POST['algorithm']=='RSA'){
                                        $input = $_POST['inputText'];
                                        $key = $_POST['keyInput'];
                                        $result = $algor->decryptRSA($input, $key);
                                        if($result!=false){
                                            echo $result;
                                        }
                                        else{
                                            echo 'Đã có lỗi xảy ra';
                                        }
                                    }
                                    else if($_POST['algorithm']=='None'){
                                        echo 'Vui lòng chọn thuật toán để tiến hành giải mã';
                                    }
                                    break;
                                }
                            }
                        }
                    ?>
                </textarea>
            </div>
        </form>
    </div>  
    <script src="../layout/JS/script.js"></script> 
</body>
</html>