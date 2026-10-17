<?php
    class encrypt_algorithm{
        public function encryptAES(string $input, string $key){
            $cipher = "aes-256-cbc";
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $encryptedData = openssl_encrypt($input, $cipher, $key, 0, $iv);
            if($encryptedData){
                return base64_encode($encryptedData. '::'.$iv);
            }
            else{
                return false;
            }
        }

        public function decryptAES(string $input, string $key){
            $input = trim($input);
            $cipher = "aes-256-cbc";
            list($encryptedData, $iv) = explode('::', base64_decode($input), 2);
            return openssl_decrypt($encryptedData, $cipher, $key, 0, $iv);
        }

        public function encryptRSA(string $input, string $publicKey){
            $encryptedData = '';
            $success = @openssl_public_encrypt($input, $encryptedData, $publicKey);
            
            if($success){
                return base64_encode($encryptedData);
            }
            else{
                return false;
            }
        }

        public function decryptRSA(string $input, string $privateKey){
            $input = trim($input);
            $decryptedData = '';
            $decodedInput = base64_decode($input);
            $success = @openssl_private_decrypt($decodedInput, $decryptedData, $privateKey);
            
            if($success){
                return $decryptedData;
            }
            else{
                return false;
            }
        }
    }
?>