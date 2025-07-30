<?php
    date_default_timezone_set('Asia/Karachi');
    $merchant_id = 84031;
    $secured_key = 'MCnZfp2YYcsbXuKl7DOOdpiq';
    // $secured_key = 'EI_5csIFFPPKC-9HLM_lAFst';
    $basket_id = 'ITEM-' . generateRandomString(4); // Generate basket_id with 4 random characters (letters and numbers)
    $trans_amount = $_POST['amount'];
    $currency_code = 'PKR';
    $item_name = $_POST['plan'];
    $return_url = "https://usmandigitalstore.com/thankyou.html";
    $checkout_url = "https://usmandigitalstore.com/ipn.php";
    $cancel_url = "https://usmandigitalstore.com";

    function generateRandomString($length = 4)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Only capital letters and numbers
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $token = getAccessToken(
        $merchant_id,
        $secured_key,
        $basket_id,
        $trans_amount,
        $currency_code

    );
    function getAccessToken(
        $merchant_id,
        $secured_key,
        $basket_id,
        $trans_amount,
        $currency_code

    ) {
        $tokenApiUrl = 'https://ipg1.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken';
        $urlPostParams = sprintf(
            'MERCHANT_ID=%s&SECURED_KEY=%s&BASKET_ID=%s&TXNAMT=%s&CURRENCY_CODE=%s',
            $merchant_id,
            $secured_key,
            $basket_id,
            $trans_amount,
            $currency_code
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlPostParams);
        curl_setopt($ch, CURLOPT_USERAGENT, 'CURL/PHP PayFast Example');
        $response = curl_exec($ch);
        curl_close($ch);
        $payload = json_decode($response);
        $token = isset($payload->ACCESS_TOKEN) ? $payload->ACCESS_TOKEN : '';
        return $token;
    }

    print("Redirecting to Payfast....");


?>

<!DOCTYPE html>
<html>
<head>
    <title>PayFast</title>
</head>
<body onload="document.forms['PayFast-payment-form'].submit();">
      <form class="form-inline" id='PayFast_payment_form' name='PayFast-payment-form' method='post'
        action="https://ipg1.apps.net.pk/Ecommerce/api/Transaction/PostTransaction">
        <input type="hidden" name="CURRENCY_CODE" value="<?php echo $currency_code; ?>">
        <input type="hidden" name="MERCHANT_ID" value="<?php echo $merchant_id; ?>">
        <input type="hidden" name="MERCHANT_NAME" value="Usman Digital Store" />
        <input type="hidden" name="TOKEN" value="<?php echo $token; ?>" />
        <input type="hidden" name="BASKET_ID" value="<?php echo $basket_id; ?>" />
        <input type="hidden" name="TXNAMT" value="<?php echo $trans_amount; ?>" />
        <input type="hidden" name="ORDER_DATE" value="<?php echo date('Y-m-d H:i:s', time()); ?>" />
        <input type="hidden" name="SUCCESS_URL" value="<?php echo $return_url ?>" />
        <input type="hidden" name="FAILURE_URL" value="<?php echo $cancel_url ?>" />
        <input type="hidden" name="CHECKOUT_URL" value="<?php echo $checkout_url ?>" />

    </form>
</body>
</html>
