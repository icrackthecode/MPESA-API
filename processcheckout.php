<?php


 
$PAYBILL_NO = "898998";
$PASSKEY = "ada798a925b5ec20cc331c1b0048c88186735405ab8d59f968ed4dab89da5515";
$PRODUCT_ID = "1717171717171";



$MERCHANT_TRANSACTION_ID = generateRandomString();

$PASSWORD_ENCRYPT = base64_encode(hash("sha256", $MERCHANTS_ID.$PASSKEY.$TIMESTAMP));
$PASSWORD = strtoupper($PASSWORD_ENCRYPT);

$TIMESTAMP = date("Y-m-d H:i:s",time());



	$body = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:tns="tns:ns">
<soapenv:Header>
<tns:CheckOutHeader>
<MERCHANT_ID>'.$PAYBILL_NO.'</MERCHANT_ID>
<PASSWORD>ZTcxY2M3M2U1ZDM1ZGEyZTRiN2UyNGUyNDk0NGQwOTVkMzgzOTNmN2UzOTEzN2RlNDE1N2M0ZjViNDIzMWU0Yw==</PASSWORD>
<TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP>
</tns:CheckOutHeader>
</soapenv:Header>
<soapenv:Body>
<tns:transactionConfirmRequest>
<!--Optional:-->
<TRX_ID>'.generateRandomString().'</TRX_ID>
<!--Optional:-->
<MERCHANT_TRANSACTION_ID>?</MERCHANT_TRANSACTION_ID>
</tns:transactionConfirmRequest>
</soapenv:Body>
</soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable
try {

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
print_r($output);


} catch (SoapFault $fault) {
    echo $fault;
}
function generateRandomString() {
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
