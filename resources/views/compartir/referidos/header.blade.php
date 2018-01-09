<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google-signin-client_id" content="532872190545-h87jgs562eijh6pfqkrahk53snqbla0s.apps.googleusercontent.com">
	<title>Millonarios FC</title>
	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap-grid.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('compartir/css/main.css') }}" />
	<script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>

</head>

<body>
	<!--CONTENEDOR-->
	<div class="container-fluid "> 
		<header class="row justify-content-center mt-5 no-gutters">

			<div class="col-12  col-lg-6 col-xl-4">

				<img src="{{ asset ('compartir/images/logo_millos.png') }}" class="logo_millos" alt="">

				<img src="{{ asset ('compartir/images/separador.svg') }}" alt="" class="separador  mb-3">
			</div>			
		</header>
		<!--contenido-->
		<div class="fondo">
			<section class="row justify-content-center  ">
				<div class="col-12 col-lg-7 col-xl-5">
					<h1 class="nombre"><?php echo $nombre;?></h1>
					<h1 class="mt-3">te invita a compartir la PASIÓN POR MILLONARIOS FC</h1>

					<h1 class="mt-4">Para empezar a participar, <br> regístrate ahora como HINCHA OFICIAL y <br>¡DESCARGA LA APP OFICIAL DE MILLONARIOS FC!</h1>
				</div>
			</section>
		@yield('content')

	@stack('scripts')
  
</body>

</html>