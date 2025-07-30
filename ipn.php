<?php
date_default_timezone_set('Asia/Karachi');
file_put_contents("ipn_log.txt", date('Y-m-d H:i:s') . " - IPN received: " . json_encode($_REQUEST) . PHP_EOL, FILE_APPEND);

// Extract the necessary values
$basket_id = $_REQUEST['basket_id'] ?? '';
$error_code = $_REQUEST['err_code'] ?? '';
$received_hash = $_REQUEST['validation_hash'] ?? ''; // You get this from GoPayFast
$merchant_id = 84031;
$merchant_key = 'EI_5csIFFPPKC-9HLM_lAFst';
// $merchant_key = 'MCnZfp2YYcsbXuKl7DOOdpiq';

// Construct the hash string
$hash_string = "$basket_id|$merchant_key|$merchant_id|$error_code";
$calculated_hash = hash('sha256', $hash_string);
// header("Location: capcut.html");
// Validate
file_put_contents("ipn_log.txt", "Calculated Hash = ". $calculated_hash . PHP_EOL, FILE_APPEND);
if ($calculated_hash === $received_hash) {
    // Hash valid, update order status in DB
    file_put_contents("ipn_log.txt", "Hash matched. Payment successful." . PHP_EOL, FILE_APPEND);
} else {
    file_put_contents("ipn_log.txt", "Hash mismatch! Potential tampering." . PHP_EOL, FILE_APPEND);
}
?>
