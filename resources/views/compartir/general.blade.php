<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

    <base href="{{asset('/') }}compartir/" />

	<link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
	<link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
	<link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
	<script src="js/bootstrap.min.js"></script>


	<title>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->titulo) !!}</title>
	<meta property="og:url"                content="{{ Request::fullUrl() }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->titulo) !!}" />
	<meta property="og:description"        content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->descripcion) !!}" />
	<meta property="og:image"              content="{{ config('app.url') . 'ventanas/' . $seccion['foto'] }}" />
</head>



<body>
	<!--CONTENEDOR-->
	<div class="container-fluid "> 
		<header class="row justify-content-center mt-5 no-gutters">

			<div class="col-12  col-lg-5">
				<img src="images/logo_millos.png" class="logo_millos" alt="">
				<img src="images/separador.svg" alt="" class="separador  mb-3">
	     	</div>			
		</header>
		<!--contenido-->
		<div class="fondo">
			<section class="row justify-content-center mt-3 no-gutters">
				<!-- titulo-->
				<h1>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), "<br>", $seccion->titulo) !!}</h1>
			</section>
			<section class="row justify-content-center mt-3 no-gutters">
				<div class="col-12 col-lg-5 ">
					<!-- Imagen-->
					<img src="images/1.jpg" class="img-fluid" alt="">
				</div>
			</section>
			<section class="row justify-content-center mt-3 no-gutters">
				<div class="col-12 col-lg-5">
					<div class="texto mt-5 pl-4 pr-4">
						<!-- Texto-->
						<!-- <p>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), "<br>", $seccion->descripcion) !!}</p> -->
						<h2>{{ $seccion->footer1 }}</h2>

						<h2 class="mt-5"><b>{{ $seccion->footer2 }}</b></h2>
						
					</div>
				</div>
			</section>
			<section class="row justify-content-center no-gutters pb-5">
				<div class="col-6">
					<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="images/btn_appstore.svg" alt="" class="tiendas"></a>
				</div>
				<div class="col-6">
					<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="images/btn_googleplay.svg" alt="" class="tiendas"></a>
				</div>
			</section>
		</div>
		<!-- fin contenido-->

	</div>
	<!-- FIN CONTENEDOR-->
</body>


</html>