<?php

require_once 'dotenv.php';
// echo $_ENV['CALLBACK_URL'];

$MERCHANT_ID = $_ENV['PAYBILL_NO'];
$MERCHANT_TRANSACTION_ID = generateRandomString();

$TIMESTAMP = date("Y-m-d H:i:s",time());
$PASSWORD_ENCRYPT = base64_encode(hash("sha256", $MERCHANT_ID.$_ENV['PASSKEY'].$TIMESTAMP));
$PASSWORD = strtoupper($PASSWORD_ENCRYPT);

$AMOUNT = $_POST['amount'];
$NUMBER = $_POST['phone_number']; // format 254712345678
$PRODUCT_ID = $_POST['product_id'];

$body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/">
    <soapenv:Header>
        <tns:CheckOutHeader>
            <MERCHANT_ID>'.$MERCHANT_ID.'</MERCHANT_ID>
            <PASSWORD>'.$ENV['TRANSACTION_PASSWORD'].'</PASSWORD>
            <TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP>
        </tns:CheckOutHeader>
    </soapenv:Header>
    <soapenv:Body>
        <tns:processCheckOutRequest>
        <MERCHANT_TRANSACTION_ID>'.$MERCHANT_TRANSACTION_ID.'</MERCHANT_TRANSACTION_ID>
        <REFERENCE_ID>'.$PRODUCT_ID.'</REFERENCE_ID>
        <AMOUNT>'.$AMOUNT.'</AMOUNT>
        <MSISDN>'.$NUMBER.'</MSISDN>
        <ENC_PARAMS></ENC_PARAMS>
        <CALL_BACK_URL>'.$_ENV['CALLBACK_URL'].'</CALL_BACK_URL>
        <CALL_BACK_METHOD>'.$_ENV['CALL_BACK_METHOD'].'</CALL_BACK_METHOD>
        <TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP>
        </tns:processCheckOutRequest>
    </soapenv:Body>
</soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable

try{
	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $_ENV['ENDPOINT']);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, '0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '0');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0');

	$output = curl_exec($ch);
	curl_close($ch);

	// Check if any error occured
	if(curl_errno($ch))
	{
	    echo 'Error no : '.curl_errno($ch).' Curl error: ' . curl_error($ch);
	}

	print_r("To complete this transaction, enter your Bonga PIN on your handset. if you don't have one dial *126*5# for instructions ");
}
catch(Exception $ex)
{
	echo $ex;
}

function generateRandomString()
{
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
