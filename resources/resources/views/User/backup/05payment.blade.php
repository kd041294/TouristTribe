<?php

//$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';



$posted = array();
$posted['key'] = $MERCHANT_KEY;
$posted['amount'] = base64_decode($payment);
$posted['firstname'] = $name;
$posted['email'] = $email;
$posted['phone'] = $phone;
$posted['productinfo'] = $id;
$posted['surl'] = asset("payment-success");
$posted['furl'] = asset("payment-fail");
$posted['service_provider'] = "payu_paisa";
$posted['txnid'] = $txnid;
$posted['udf1'] = $nop;
$posted['udf2'] = $nor;
$posted['udf3'] = $bt;
$posted['udf4'] =  $trip_date;
$posted['udf5'] = $userID;

$formError = 0;

$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
   
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
$hashVarsSeq = explode('|', $hashSequence);
$hash_string = '';	
foreach($hashVarsSeq as $hash_var) {
  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
  $hash_string .= '|';
}

$hash_string .= $SALT;


$hash = strtolower(hash('sha512', $hash_string));
$action = $PAYU_BASE_URL . '/_payment';

?>
<html>
  <head>
    <script>
      var hash = '<?php echo $hash ?>';
      function submitPayuForm() {
        if(hash == '') {
          return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
      }
    </script>
  </head>
  <body onload="submitPayuForm()" class="bg-light">
    <form action="{{ $action }}" method="post" name="payuForm">
      <table>
        <tr>
          <input type="hidden" name="key" value="{{ $MERCHANT_KEY }}" />
          <input type="hidden" name="hash" value="{{ $hash }}"/>
          <input type="hidden" name="txnid" value="{{ $txnid }}" />
          <input type="hidden" name="udf5" value="{{ $userID }}" />
        </tr>
        <tr>
          <td><input type="hidden" name="amount" value="{{ base64_decode($payment) }}" /></td>
          <td><input type="hidden" name="firstname" id="firstname" value="{{ $name }}" /></td>
          <td><input type="hidden" name="email" id="email" value="{{ $email }}" /></td>
          <td><input type="hidden" name="phone" value="{{ $phone }}" /></td>
        </tr>
        <tr>
          <td><input type="hidden"  name="productinfo" value="{{ $id }}"?></td>
          <td><input type="hidden" name="udf1" value="{{ $nop }}"></td>
          <td><input type="hidden" name="udf2" value="{{ $nor }}"></td>
          <td><input type="hidden" name="udf3" value="{{ $bt }}"></td>
        </tr>
        <tr>
          <td><input type="hidden" name="udf4" value="{{ $trip_date }}"></td>
          <td><input type="hidden" name="surl" value={{asset("payment-success")}} /></td>
          <td><input type="hidden" name="service_provider" value="payu_paisa" /></td>
          <td><input type="hidden" name="furl" value={{asset("payment-fail")}}  /></td>
        </tr>
        <tr>
          <td><input type="hidden" name="city" value="{{ $for }}" /></td>
        </tr>
        <tr>
          @if(!$hash)            
              <td colspan="4"><input type="submit" class="btn btn-primary" value="Ready To Pay" /></td>
          @endif
        </tr>
        </table>
    </form>
  </body>
</html>
