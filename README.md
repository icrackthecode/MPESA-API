# MPESA-API
PHP implementation of MPESA checkout API. Simple for even the non techies.

Try out the sample checkout
http://crackthecode.co.ke/MPESA/sampleCheckout.php


What happens?

1. You request for a checkout through the requestcheckout.php; which runs a ussd prompt of the online checkout to the phone number. 
2. Response is sent to your phone for verification; through your bonga pin.
3. After verification you are asked to confirm payment .
4. After confirmation transaction is processed by callback url processcheckout.php

 


