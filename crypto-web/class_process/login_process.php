<?php
    class login{
        public function mylogin(string $user, string $password){
            if($user == 'antoanthongtin@gmail.com' && $password == 'nhapmonantoanthongtin'){
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                return 1;
            }
            else{
                return 0;
            }
        }

       public function confirmlogin(string $user, string $password){
            if($user != 'antoanthongtin@gmail.com' || $password != 'nhapmonantoanthongtin'){
                header('location:../index.php');
                exit();
            }
        }
    }
?>