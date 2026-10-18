<?php
    class encrypt_algorithm{
        public function autoGeneratePassCode(){
            $password = "LeAnhDung24743951!";
            $config = array(
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
                "config" => "D:/Xampp/php/extras/ssl/openssl.cnf"
            );
            $res = openssl_pkey_new($config);
            $privateKey = '';
            openssl_pkey_export($res, $privateKey, $password, $config);
            file_put_contents('../RSA_crypto_resources/privatekey.pem', $privateKey);
            $thong_tin_chi_tiet = openssl_pkey_get_details($res);
            $publicKey = $thong_tin_chi_tiet["key"];
            file_put_contents('../RSA_crypto_resources/publickey.pem', $publicKey);
        }

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

        public function encryptRSA(string $input)
        {
            $this->autoGeneratePassCode();
            $fp = fopen("../RSA_crypto_resources/publickey.pem", "r");
            $pubkey = fread($fp, 8192);
            if (openssl_public_encrypt($input, $encrypted, $pubkey)){
                $data = base64_encode($encrypted);
            }
            else{
                throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');
            }
            return $data;
        }

        public function decryptRSA(string $input)
        {
            $fp = fopen("../RSA_crypto_resources/privatekey.pem", "r");
            $privkey = fread($fp, 8192);
            fclose($fp);
            $passphrase = "LeAnhDung24743951!";
            $privkey_resource = openssl_get_privatekey($privkey, $passphrase);
            if (!$privkey_resource) {
                return "Lỗi: Mở khóa Private Key thất bại. Sai mật khẩu!";
            }
            if (openssl_private_decrypt(base64_decode($input), $decrypted, $privkey_resource)){
                return $decrypted;
            }   
            else{
                $loi_he_thong = "";
                while ($msg = openssl_error_string()) {
                    $loi_he_thong .= $msg . " | ";
                }
                return "Lỗi giải mã: " . $loi_he_thong; 
            }
        }
    }
?>