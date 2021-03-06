<!DOCTYPE html>
<html lang="es">
<?php
      $codigo_referido=$codigo;
      $titulo="¡YA SOY HINCHA EMBAJADOR OFICIAL!";

      $descripcion="Demuestra tu compromiso por el AZUL y PROBEMOS que SOMOS la hinchada más GRANDE del país";

      //$descripcion="La APP MILLONARIOS FC OFICIAL te trae el contenido más exclusivo del Embajador al alcance de tu mano! Regístrate y descárgala en el siguiente link:";

 ?>

<head>
	<meta charset="UTF-8">


	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap-grid.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/main.css') }}" />
	<script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
	<title>Millonarios FC</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google-signin-client_id" content="532872190545-h87jgs562eijh6pfqkrahk53snqbla0s.apps.googleusercontent.com">

	<meta property="og:url" content="<?php echo env('APP_SHARE_URL')."compartir/referidos/". $codigo ; ?>"/>
	<meta property="og:type"               content="website" />
    <meta property="og:title"              content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $titulo) !!}" />
     <meta property="og:description"        content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $descripcion) !!}" />
     <meta property="og:image" content="https://s3.amazonaws.com/cmsmillos/logo_bsc.jpg"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>
	<!--CONTENEDOR-->
	<div class="container-fluid ">
		<header class="row justify-content-center mt-5 no-gutters">

			<div class="col-12  col-lg-6 col-xl-4">

				<img src="{{ asset ('compartir/images/logo_millos.png') }}" class="logo_millos" alt="Demuestra tu compromiso por el AZUL y contagia a tus amigos de esta pasión">
			</div>
		</header>
		<!--contenido-->
		<div class="">

			<section class="row justify-content-center no-gutters "><!-- clase no-gutter-->
				<div class="col-12 col-lg-7 col-xl-3 no-gutters"><!-- clase no-gutter-->
					<h1 class="nombre"><?php echo $nombre;?></h1>

					<img src="{{ asset ('compartir/images/text1.png') }}" alt="" class="img-fluid p-3">
				</div>
			</section>



		@yield('content')

	@stack('scripts')

</body>

</html>