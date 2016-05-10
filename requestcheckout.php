<?php

$ENDPOINT = "https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl";
$CALLBACK_URL = "http://crackthecode.co.ke/gizmopay/MPESA/processcheckout.php";
$CALL_BACK_METHOD = "POST";

$MERCHENTS_ID = $PAYBILL_NO;
$MERCHANT_TRANSACTION_ID = generateRandomString();

$PASSWORD_ENCRYPT = base64_encode(hash("sha256", $MERCHANTS_ID.$PASSKEY.$TIMESTAMP));
$PASSWORD = strtoupper($PASSWORD_ENCRYPT);

$TIMESTAMP = date("Y-m-d H:i:s",time());

$AMOUNT = $_POST['amount'];
$NUMBER = $_POST['number']; //format 25470000

$body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/">
    <soapenv:Header>
        <tns:CheckOutHeader>
            <MERCHANT_ID>'.$PAYBILL_NO.'</MERCHANT_ID>
            <PASSWORD>'.$TRANSACTION_PASSWORD.'</PASSWORD>
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
        <CALL_BACK_URL>'.$CALLBACK_URL.'</CALL_BACK_URL>
        <CALL_BACK_METHOD>'.$CALL_BACK_METHOD.'</CALL_BACK_METHOD>
        <TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP>
        </tns:processCheckOutRequest>
    </soapenv:Body>
</soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable

try{

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $ENDPOINT);
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
catch(Exception $ex){
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
