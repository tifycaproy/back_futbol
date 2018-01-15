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


<!--<table class="tablappal">
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
</table>-->
	<!--CONTENEDOR-->
	<div class="container-fluid "> 
		<header class="row justify-content-center mt-5 no-gutters">

			<div class="col-12  col-lg-6 col-xl-3 no-gutters"> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
				<img src="{{ asset('compartir/images/logo_millos.png') }}" class="logo_millos" alt="">
				<img src="{{ asset('compartir/images/separador.svg') }}" alt="" class="separador  mb-3">
	     	</div>			
		</header>
		<!--contenido-->
		<div class=""> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
			<section class="row justify-content-center no-gutters "> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
				<!-- titulo-->
				<div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1"><!-- AÑADIDO CONTENEDOR (15/01/2018)-->
					<h1>¡ESTE ES MI ONCE IDEAL!</h1>
				</div>
			</section>
			<section class="row justify-content-center mt-3 no-gutters">

				<div class="row align-items-center justify-content-around mb-3">
					<div class="col-3 col-xl-3 col-lg-3">
						<img src="{{ $data['bandera_1'] }}" alt="" class="tiendas">
						<!--<h4>Nombre del Equipop</h4>-->
					</div>
					
						<h1>Vs</h1>
				
					<div class="col-3 col-xl-3 col-lg-3">
						<img src="{{ $data['bandera_2'] }}" alt="" class="tiendas">
						<!--<h4>Nombre del Equipop</h4>-->
					</div>

					<div class="col-12">
						<h2>{{ $data['copa'] }}</h2>
					</div>
				</div>

				<div class="col-12 col-lg-5 col-xl-6 pl-2 pr-2 "><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
					<!-- Imagen-->
					<!--<img src="{{ asset ('compartir/images/soccer_field.svg') }}" class="img-fluid" alt="">-->
					<table class="tablappal">
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

						</table>  
					</div>
			</section>
			<section class="row justify-content-center mt-3 no-gutters">
				<div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
					<div class="texto mt-5 pl-4 pr-4">
						<!-- Texto-->
						<h2>¡No dejemos de seguir nunca al más grande!</h2>

						<h2 class="mt-5"><b>DESCARGA LA APP OFICIAL DEL MILLONARIOS FC</b></h2>
						
					</div>
				</div>
			</section>
			<section class="row justify-content-center no-gutters pb-5">
				<div class="col-6 col-xl-4 col-lg-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
					<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="{{ asset('compartir/images/btn_appstore.svg') }}" alt="" class="tiendas"></a>
				</div>
				<div class="col-6 col-xl-4 col-lg-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
					<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="{{ asset('compartir/images/btn_googleplay.svg') }}" alt="" class="tiendas"></a>
				</div>
			</section>
		</div>
		<!-- fin contenido-->

	</div>
	<!-- FIN CONTENEDOR-->

</body>
</html>