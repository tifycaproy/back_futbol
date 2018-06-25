<?php
$ApiKey = "1Hzv6cMkOrR4XSWD4M1Ibu444o";
$merchant_id = $request->merchantId;
$referenceCode = $request->referenceCode;
$TX_VALUE = $request->TX_VALUE;
$New_value = number_format($TX_VALUE, 1, '.', '');
$currency = $request->currency;
$transactionState = $request->transactionState;
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $request->signature;
$reference_pol = $request->reference_pol;
$cus = $request->cus;
$extra1 = $request->description;
$pseBank = $request->pseBank;
$lapPaymentMethod = $request->lapPaymentMethod;
$transactionId = $request->transactionId;

if ($request['transactionState'] == 4 ) {
	$estadoTx = "APROBADA";

}

else if ($request['transactionState'] == 6 ) {
	$estadoTx = "RECHAZADA";
}

else if ($request['transactionState'] == 104 ) {
	$estadoTx = "ERROR";
}

else if ($request['transactionState'] == 7 ) {
	$estadoTx = "PENDIENTE";
}

else {
	$estadoTx=$request['mensaje'];
}


if (strtoupper($firma) == strtoupper($firmacreada)) {
?>
	<h2>Resúmen de transacción</h2>
	<table>
	<tr>
	<td>Estado de transacción</td>
	<td><?php echo $estadoTx; ?></td>
	</tr>
	<tr>
	<tr>
	<td>Transaction ID</td>
	<td><?php echo $transactionId; ?></td>
	</tr>
	<tr>
	<td>Referencia de venta</td>
	<td><?php echo $reference_pol; ?></td>
	</tr>
	<tr>
	<td>Referencia de transacción</td>
	<td><?php echo $referenceCode; ?></td>
	</tr>
	<tr>
	<?php
	if($pseBank != null) {
	?>
		<tr>
		<td>cus </td>
		<td><?php echo $cus; ?> </td>
		</tr>
		<tr>
		<td>Bank </td>
		<td><?php echo $pseBank; ?> </td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td>Monto total</td>
	<td>$<?php echo number_format($TX_VALUE); ?></td>
	</tr>
	<tr>
	<td>Moneda</td>
	<td><?php echo $currency; ?></td>
	</tr>
	<tr>
	<td>Descripción</td>
	<td><?php echo ($extra1); ?></td>
	</tr>
	<tr>
	<td>Entidad:</td>
	<td><?php echo ($lapPaymentMethod); ?></td>
	</tr>
	</table>
	<script type="text/javascript">
        alert('<?php echo $estadoTx; ?>');
    </script>

<?php
}
else
{
?>
	<h1>Error validating digital signature.</h1>
<?php
}
?>