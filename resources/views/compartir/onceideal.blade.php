<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}" />

	<title>TU ONCE IDEAL</title>
	<meta property="og:url"                content="{{ Request::fullUrl() }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="MI ONCE IDEAL PARA EL PRÓXIMO PARTIDO" />
	<meta property="og:description"        content="¡Escoge tu once ideal y comparte con tus amigos! Descarga ya la App Oficial de Millonarios FC" />
	<meta property="og:image"              content="{{ $data['foto'] }}" />
	<link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
	<link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
	<link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
	<script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>

<style type="text/css">
	/* @font-face {
	    font-family: 'Gill Sans MT';
	    src: url('fonts/GillSansMT-Bold.eot');
	    src: url('fonts/GillSansMT-Bold.eot?#iefix') format('embedded-opentype'),
	        url('fonts/GillSansMT-Bold.woff') format('woff'),
	        url('fonts/GillSansMT-Bold.ttf') format('truetype');
	    font-weight: bold;
	    font-style: normal;
	}*/
	/*body, html{background: #1D1F3A}
	*{font-family: 'Gill Sans MT'; font-weight: bold; font-style: normal; color: #FFF;}*/
	.tablappal{border: none; width: 500px; border-collapse: collapse; margin: 0 auto;}
	table td{padding:0;}
	/*h1{font-size: 24px; margin:6px 0 5px 0;}*/
	.banderas{height: 35px}
	.tabla_banderas{margin:0 auto; width: 130px;}
	/*p{margin: 2px 0 7px 0}*/
	.cancha{padding: 15px 10px; width: 318px;}
	.cancha img{width: 318px}
	.tabla_jugadores{width: 100%;}
	.tabla_jugadores img{width: 33px;}
	.tabla_jugadores td{font-size: 9px; text-align: center; padding-top: 5px}

	.footer{background-image: url('img/banner_vacio.png'); height: 80px;}
	.footer div{padding: 30px 0 0 150px;}
</style>
</head>
<body>

<table class="tablappal">
	<tr style="background: #074C9C; text-align: center;">
		<td colspan="2">
			<h1>¡MI ONCE IDEAL PARA EL PRÓXIMO PARTIDO!</h1>
			<table class="tabla_banderas">
				<tr>
					<td><img src="{{ $data['bandera_1'] }}" class="banderas"></td>
					<td> Vs </td>
					<td><img src="{{ $data['bandera_2'] }}" class="banderas"></td>
				</tr>
			</table>
			<p>{{ $data['copa'] }}</p>
		</td>
	</tr>
	<tr>
		<td class="cancha"><img src="{{ $data['foto'] }}"></td>
		<td valign="top">
			<table class="tabla_jugadores"><?php
			$n=1;
			foreach($data['jugadores'] as $jugador){
				if($n==1) echo "<tr>"; ?>
				<td>
					<img src="{{  $jugador['foto'] }}">
					<p>{{ $jugador['nombre'] }}</p>
				</td><?php
				if($n==0) echo "<tr>";
				$n=1-$n;
			 }?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="footer">
			<div><a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="img/android.png"></a>&nbsp;&nbsp;<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="img/ios.png"></a></div>
		</td>
	</tr>
</table>


</body>
</html>