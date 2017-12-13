<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Referidos</title>
	<link rel="stylesheet" href="{{asset('/') }}compartir/css/css.css">
    <base href="{{asset('/') }}compartir/" />

	<title>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->titulo) !!}</title>
	<meta property="og:url"                content="{{ Request::fullUrl() }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->titulo) !!}" />
	<meta property="og:description"        content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->descripcion) !!}" />
	<meta property="og:image"              content="{{ config('app.url') . 'ventanas/' . $seccion['foto'] }}" />
</head>

<body>
	<div class="contenedor">
		<header>
			<h1>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), "<br>", $seccion->titulo) !!}</h1>
		</header>
		<div class="contenido">
			<!--IMAGEN-->
			<img src="{{ config('app.url') . 'ventanas/' . $seccion['foto'] }}" class="img-content">
			<!--TEXTO-->
			<div class="texto">
				<p>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), "<br>", $seccion->descripcion) !!}</p>
				<h2><b>{{ $seccion->footer1 }}</b></h2>
				<h3><b>{{ $seccion->footer2 }}</b></h3>
			</div>
		</div>
		<footer>
			<img src="images/logo_millos.png" class="logo">
			<div class="footer">
				<div class="footer-btn">
					<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="images/btn1.png"></a>
					<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="images/btn2.png"></a>
				</div>
			</div>
			
		</footer>
	</div>
</body>

</html>