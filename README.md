# MPESA-API

PHP implementation of MPESA checkout API. Simple for even the non techies.

__TRY OUT__ A sample of the checkout process [HERE](https://mpesa-checkout.herokuapp.com/)

The `$PASSWORD` must be generate using the following approach:

```yaml
$MERCHENTS_ID = $PAYBILL_NO;
$TIMESTAMP = date("YmdHis",time());// in this format strictly
$PASSKEY = "your SAG password";
$PASSWORD = base64_encode(hash("sha256", $MERCHENTS_ID.$PASSKEY.$TIMESTAMP));
```

*__PLEASE NOTE__: _if `$TIMESTAMP` used is different from the one used to create the `$PASSWORD` it will lead to AUTHETICATION ERROR*

And you are __DONE__. Simple.

---

#### What happens?

1. You request for a checkout through the requestcheckout.php; which runs a ussd prompt of the online checkout to the phone number.
2. Response is sent to your phone for verification; through your bonga pin.
3. After verification you are asked to confirm payment .
4. After confirmation transaction is processed by callback url processcheckout.php
