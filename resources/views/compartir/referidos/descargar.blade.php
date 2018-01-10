<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Millonarios FC</title>

	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap-grid.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('compartir/css/bootstrap.min.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('compartir/css/main.css') }}" type="text/css" />

	<script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>


</head>

<body>
	<!--CONTENEDOR-->
	<div class="container-fluid "> 
		
		<!--contenido-->
		<div class="fondo">
			<section class="row justify-content-center mt-5 no-gutters">

				<div class="col-12 col-lg-7 col-xl-5">

					<h1 class="m-5 "> <b>¡ESTAS A UN PASO DE CONVERTIRTE EN HINCHA OFICIAL!</b></h1>

					<h1 class="mt-4">Inicia sesión en la <b>APP OFICIAL</b> con la cuenta que registraste y sigue las instrucciones en la sección <b>PERFIL</b>.</h1>

					<h1 class="size-lg mt-5">¡DESCARGA LA APP!</h1>
				</div>
			</section>
			<section class="row justify-content-center mt-3 no-gutters">

				<div class="col-12  col-lg-5 col-xl-4">
					<img src="{{ asset ('compartir/images/logo_millos.png') }}" class="col-8" alt="">
				</div>			
			</section>
			<section class="row justify-content-around  mb-5 ">
				<div class="col-6 col-xl-4">
					<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="{{ asset ('compartir/images/btn_appstore.svg') }}" class="tiendas" alt="">
					</div>
					<div class="col-6 col-xl-4">
						<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="{{ asset ('compartir/images/btn_googleplay.svg') }}" class="tiendas" alt="">

						</div>
					</section>
			
			
		</div>
		<!-- fin contenido-->

	</div>
	<!-- FIN CONTENEDOR-->
</body>

</html>