<?php



if($_GET['seccion']=='alineacion' || $_GET['seccion']=='alineación' || $_GET['seccion']=='alineaciónoficial'){

	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/alineacion.jpg";
	$descripcion="¡CONOCE LA ALINEACIÓN OFICIAL Y CADA EVENTO DEL PARTIDO EN TIEMPO REAL!";
	$titulo="Alineación";
	
	
	}elseif($_GET['seccion']=='tabla' || $_GET['seccion']=='tabla' || $_GET['tabla']=='tabla'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/tabla.jpg";
	$descripcion="¡ASÍ VA EL EMBAJADOR EN LA LIGA AGUILA!";
	$titulo="Tabla";
	
	
	
	}elseif($_GET['seccion']=='calendario' || $_GET['seccion']=='calendario' || $_GET['seccion']=='calendario'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/calendario.jpg";
	$descripcion="¡NO TE PIERDAS NINGÚN PARTIDO DE MILLONARIOS Y CONOCE TODA LA INFORMACIÓN OFICIAL!";
	$titulo="Calendario";
	
	
	
	}elseif($_GET['seccion']=='noticias' || $_GET['seccion']=='noticias' || $_GET['seccion']=='noticias'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/noticias.jpeg";
	$descripcion="¡CONOCE LAS ÚLTIMAS NOTICIAS DEL EMBAJADOR!";
	$titulo="Noticias";
	
    }elseif($_GET['seccion']=='estadisticas' || $_GET['seccion']=='estadisticas' || $_GET['seccion']=='estadisticas'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/estadisticas.jpg";
	$descripcion="¡CONOCE LAS ESTADÍSTICAS DEL BALLET AZUL EN ESTA TEMPORADA!";
	$titulo="Estadisticas";
	
	 }elseif($_GET['seccion']=='equipo' || $_GET['seccion']=='equipo' || $_GET['seccion']=='equipo'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/equipo.jpeg";
	$descripcion="¡CONOCE LA PLANTILLA EMBAJADORA Y APLAUDE A TU JUGADOR FAVORITO!";
	$titulo="Equipo";
	
	 }elseif($_GET['seccion']=='tiendavirtual' || $_GET['seccion']=='tiendavirtual' || $_GET['seccion']=='tiendavirtual'){
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/tiendas.jpg";
	$descripcion="¡ADQUIERE LOS PRODUCTOS OFICIALES DE TU EQUIPO!";
	$titulo="Tienda Virtual";

}elseif($_GET['seccion']=='futbolbase' || $_GET['seccion']=='fútbolbase' || $_GET['seccion']=='futbolbase'){
    $url="";
    $imagen="https://s3.amazonaws.com/cmsmillos/compartir/futbol_base.jpeg";
    $descripcion="¡CONOCE A LAS FUTURAS ESTRELLAS DEL CUADRO EMBAJADOR!";
    $titulo="Fútbol Base";


}elseif($_GET['seccion']=='realidadvirtual' || $_GET['seccion']=='realidad_virtual'){
$url="";
$imagen="https://s3.amazonaws.com/cmsmillos/compartir/vr.jpeg";
$descripcion="¡VIVE UNA EXPERIENCIA EMBAJADORA EN REALIDAD VIRTUAL!";
$titulo="Realidad Virtual";



}else{
	$url="";
	$imagen="https://s3.amazonaws.com/cmsmillos/compartir/compartaelapp.jpeg";
	$descripcion="¡COMPARTE LA APP CON TODOS TUS AMIGOS EMBAJADORES Y CONVIÉRTETE EN HINCHA OFICIAL!";
	$titulo="Comparte tu pasión";
	
	
	
	
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
			<h2><b><?php echo $titulo;?></b></h2>
			<h3><b><?php echo $descripcion;?></b></h3>
		</header>
		<div class="contenido">
			<!--IMAGEN-->
			<img src="<?php echo $imagen;?>" class="img-content">
			<!--TEXTO-->
			<div class="texto">
				
				
				<h4>
				Yo ya soy Hincha Oficial del Embajador, <br>¿Y tu que esperas? <br>Descarga el app
			</h4>
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