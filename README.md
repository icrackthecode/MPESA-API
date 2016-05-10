# MPESA-API

PHP implementation of MPESA checkout API. Simple for even the non techies.

Try out the sample checkout [HERE](http://crackthecode.co.ke/MPESA/sampleCheckout.php)

You are required to add/create a `.env` file in the `root directory ` with the following alike content:

```yaml
PAYBILL_NO='123467'
PASSKEY='ruwioefhisadkjahjfhkjsbckhbzxkhbhkzbchjbKKDHKJSAHKJdh'
TRANSACTION_PASSWORD='AKSHKLJHjkdjahkbdKJBDJbajkbkjBJKDgakJGDJHBsdkGSJHD=='
ENDPOINT='https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl'
CALLBACK_URL='http://crackthecode.co.ke/gizmopay/MPESA/processcheckout.php'
CALL_BACK_METHOD='POST'
```

And you are done. It should now work out of the box.

What happens?

1. You request for a checkout through the requestcheckout.php; which runs a ussd prompt of the online checkout to the phone number.
2. Response is sent to your phone for verification; through your bonga pin.
3. After verification you are asked to confirm payment .
4. After confirmation transaction is processed by callback url processcheckout.php
