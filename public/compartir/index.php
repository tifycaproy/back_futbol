<?php



if($_GET['seccion']=='alineacion' || $_GET['seccion']=='alineación'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/tabla.jpg";
	$descripcion="¡ASÍ VA EL EMBAJADOR EN LA LIGA AGUILA!";
	$titulo="Tabla";
	
	
}else{
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/compartaelapp.jpeg";
	$descripcion="¡COMPARTE LA APP CON TODOS TUS AMIGOS EMBAJADORES Y CONVIÉRTETE EN HINCHA OFICIAL!";
	$titulo="COMPARTIR LA APP";
	
	
	
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Referidos</title>
	<link rel="stylesheet" href="css/css.css">
	<base href="http://millos-prod.2waysports.com/compartir/index.php" />

	<title>Noticias</title>
	<meta property="og:url"                content="http://millos-dev.2waysports.com/compartir/index.php" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="<?php echo $titulo;?>" />
	<meta property="og:description"        content="<?php echo $descripcion;?>" />
	<meta property="og:image"              content="<?php echo $imagen;?>" />
	
</head>

<body>
	<div class="contenedor">
		<header>
			<h1>
				Ya yo soy Hincha Oficial del Embajador, <br>¿Y tu que esperas? 
			</h1>
		</header>
		<div class="contenido">
			<!--IMAGEN-->
			<img src="<?php echo $imagen;?>" class="img-content">
			<!--TEXTO-->
			<div class="texto">
				<h2><b><?php echo $titulo;?></b></h2>
				<h3><b><?php echo $descripcion;?></b></h3>
			</div>
		</div>
		<footer>
			<img src="images/logo_millos.png" class="logo">
			<div class="footer">
				<div class="footer-btn">
					<a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC" target="_blank"><img src="images/btn1.png"></a>
					<a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8" target="_blank"><img src="images/btn2.png"></a>
				</div>
			</div>
			
		</footer>
	</div>
</body>

</html>