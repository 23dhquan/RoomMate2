<?php
// app/VNPay/VNPay.php
namespace App\VNPay;

class VNPay {
    private $vnp_HashSecret;
    private $vnp_TmnCode;

    public function __construct($tmnCode, $hashSecret) {
        $this->vnp_TmnCode = $tmnCode;
        $this->vnp_HashSecret = $hashSecret;
    }

    public function createHashData($data) {
        ksort($data);
        $hashData = http_build_query($data);
        return $hashData;
    }

    public function generateSecureHash($hashData) {
        return hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
    }

    public function verifySecureHash($receivedHash, $hashData) {
        $generatedHash = $this->generateSecureHash($hashData);
        return hash_equals($receivedHash, $generatedHash);
    }
}
