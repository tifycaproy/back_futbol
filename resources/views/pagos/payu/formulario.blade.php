 <!DOCTYPE html>
<html>
<head>
</head>

<body>
<p>Monto : {{$datos->Amount}} </p>
 <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="hidden"  value="{{$datos->merchantId}}"   >
  <input name="accountId"     type="hidden"  value="512321" >
  <input name="ApiKey"     type="hidden"  value="{{$datos->ApiKey}}" >
  <input name="description"   type="hidden"  value="Test PAYU"  >
  <input name="referenceCode" type="hidden"  value="{{$datos->reference}}" >
  <input name="amount"        type="hidden"  value="{{$datos->Amount}}"   >
  <input name="tax"           type="hidden"  value="3193"  >
  <input name="taxReturnBase" type="hidden"  value="16806" >
  <input name="currency"      type="hidden"  value="{{$datos->currency}}" >
  <input name="signature"     type="hidden"  value="{{$datos->signature}}"  >
  <input name="test"          type="hidden"  value="1" >
  <input name="buyerEmail"    type="hidden"  value="prueba@pagomillonarios.com" >
  <input name="responseUrl"    type="hidden"  value="http://millos-dev.2waysports.com/api/pago/payu/response" >
  <input name="confirmationUrl"    type="hidden"  value="http://millos-dev.2waysports.com/api/pago/payu/confirmation" >
  <input name="Submit"        type="submit"  value="Pagar con PayU" >
</form>

</body>
</html>
