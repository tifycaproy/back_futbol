 <!DOCTYPE html>
<html>
<head>
</head>

<body>
<p>Monto : {{number_format($datos->Amount, 0, '.', ',')}} </p>
<p>E-mail usuario : {{$datos->buyerEmail}}
 <form method="post" name="formulario" id="formulario" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="hidden"  value="{{$datos->merchantId}}"   >
  <input name="accountId"     type="hidden"  value="512321" >
  <input name="ApiKey"     type="hidden"  value="{{$datos->ApiKey}}" >
  <input name="description"   type="hidden"  value="Test PAYU"  >
  <input name="referenceCode" type="hidden"  value="{{$datos->reference}}" >
  <input name="amount"        type="hidden"  value="{{$datos->Amount}}"   >
  <input name="tax"           type="hidden"  value="0"  >
  <input name="taxReturnBase" type="hidden"  value="0" >
  <input name="currency"      type="hidden"  value="{{$datos->currency}}" >
  <input name="signature"     type="hidden"  value="{{$datos->signature}}"  >
  <input name="test"          type="hidden"  value="1" >
  <input name="buyerEmail"    type="hidden"  value="{{$datos->buyerEmail}}" >
  <input name="extra3"    type="hidden"  value="{{$datos->extra3}}" >
  <input name="responseUrl"    type="hidden"  value="{{ env('APP_SHARE_URL') }}/api/pago/payu/response" >
  <input name="confirmationUrl"    type="hidden"  value="{{ env('APP_SHARE_URL') }}/api/pago/payu/confirmation" >
  <input name="Submit"        type="submit"  value="Pagar con PayU" >
</form>

<script type="text/javascript">
    window.onload=function(){

          document.forms["formulario"].submit();

    }
</script>

</body>
</html>
