<?php

function processcheckout($MERCHANT_TRANSACTION_ID, $ENDPOINT,$PASSWORD,$TIMESTAMP)
{
    $body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"><soapenv:Header><tns:CheckOutHeader><MERCHANT_ID>898998</MERCHANT_ID><PASSWORD>'.$PASSWORD.'</PASSWORD><TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP></tns:CheckOutHeader></soapenv:Header><soapenv:Body><tns:transactionConfirmRequest><TRX_ID>?</TRX_ID><MERCHANT_TRANSACTION_ID>'.$MERCHANT_TRANSACTION_ID.'</MERCHANT_TRANSACTION_ID></tns:transactionConfirmRequest></soapenv:Body></soapenv:Envelope>';
// Your SOAP XML needs to be in this variable
    try {

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $ENDPOINT); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
                       
        curl_setopt($ch, CURLOPT_VERBOSE, '0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0');

    $output = curl_exec($ch);
    curl_close($ch);

    // Check if any error occured
    if(curl_errno($ch))
    {
        echo 'Error no : '.curl_errno($ch).' Curl error: ' . curl_error($ch);
    }

    //ADD Databbase CRUD features here;

    } catch (SoapFault $fault) {
        echo $fault;
    }
}


?>
