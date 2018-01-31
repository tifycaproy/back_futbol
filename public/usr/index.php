<?php
$footer1= "DESCARGA AHORA MISMO LA APP OFICIAL MILLONARIOS FC";
$footer2 = "NO DEJEMOS DE SEGUIR NUNCA AL MÁS GRANDE";
if (isset($_GET['seccion'])) {
    if ($_GET['seccion'] == 'alineacion' || $_GET['seccion'] == 'alineación' || $_GET['seccion'] == 'alineaciónoficial') {

        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/tabla.jpg";
        $descripcion = "¡ASÍ VA EL EMBAJADOR EN LA LIGA AGUILA!";
        $titulo = "Alineación";


    } elseif ($_GET['seccion'] == 'tabla' || $_GET['seccion'] == 'tabla' || $_GET['tabla'] == 'tabla') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/tabla.jpg";
        $descripcion = "¡ASÍ VA EL EMBAJADOR EN LA LIGA AGUILA!";
        $titulo = "Tabla";


    } elseif ($_GET['seccion'] == 'calendario' || $_GET['seccion'] == 'calendario' || $_GET['seccion'] == 'calendario') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/calendario.jpg";
        $descripcion = "¡NO TE PIERDAS NINGÚN PARTIDO DE MILLONARIOS Y CONOCE TODA LA INFORMACIÓN OFICIAL!";
        $titulo = "Calendario";


    } elseif ($_GET['seccion'] == 'noticias' || $_GET['seccion'] == 'noticias' || $_GET['seccion'] == 'noticias') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/noticias.jpeg";
        $descripcion = "¡CONOCE LAS ÚLTIMAS NOTICIAS DEL EMBAJADOR!";
        $titulo = "Noticias";

    } elseif ($_GET['seccion'] == 'estadisticas' || $_GET['seccion'] == 'estadisticas' || $_GET['seccion'] == 'estadisticas') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/estadisticas.jpg";
        $descripcion = "¡CONOCE LAS ESTADÍSTICAS DEL BALLET AZUL EN ESTA TEMPORADA!";
        $titulo = "Estadisticas";

    } elseif ($_GET['seccion'] == 'equipo' || $_GET['seccion'] == 'equipo' || $_GET['seccion'] == 'equipo') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/equipo.jpeg";
        $descripcion = "¡CONOCE LA PLANTILLA EMBAJADORA Y APLAUDE A TU JUGADOR FAVORITO!";
        $titulo = "Equipo";

    } elseif ($_GET['seccion'] == 'tiendavirtual' || $_GET['seccion'] == 'tiendavirtual' || $_GET['seccion'] == 'tiendavirtual') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/tiendas.jpg";
        $descripcion = "¡ADQUIERE LOS PRODUCTOS OFICIALES DE TU EQUIPO!";
        $titulo = "Tienda Virtual";

    } elseif ($_GET['seccion'] == 'futbolbase' || $_GET['seccion'] == 'fútbolbase' || $_GET['seccion'] == 'futbolbase') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/futbol_base.jpeg";
        $descripcion = "¡CONOCE A LAS FUTURAS ESTRELLAS DEL CUADRO EMBAJADOR!";
        $titulo = "Fútbol Base";


    } elseif ($_GET['seccion'] == 'realidadvirtual' || $_GET['seccion'] == 'realidad_virtual') {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/vr.jpeg";
        $descripcion = "¡VIVE UNA EXPERIENCIA EMBAJADORA EN REALIDAD VIRTUAL!";
        $titulo = "Realidad Virtual";


    } else {
        $url = "";
        $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/compartaelapp.jpeg";
        $descripcion = "¡COMPARTE LA APP CON TODOS TUS AMIGOS EMBAJADORES Y CONVIÉRTETE EN HINCHA OFICIAL!";
        $titulo = "Comparte tu pasión";


    }
} else {
    $url = "";
    $imagen = "https://s3.amazonaws.com/cmsmillos/compartir/compartaelapp.jpeg";
    $descripcion = "¡CONVIÉRTETE EN HINCHA OFICIAL Y COMPARTE TU PASIÓN POR EL EMBAJADOR!";
    $titulo = "Comparte tu pasión";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/bootstrap.min.js"></script>

    <title><?php echo $titulo;?></title>

    <base href="http://millos-dev.2waysports.com/compartir/index.php" />


    

    <meta property="og:url"                content="http://millos-dev.2waysports.com/compartir/index.php" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $titulo;?>" />
    <meta property="og:description"        content="<?php echo $descripcion;?>" />
    <meta property="og:image"              content="<?php echo $imagen;?>" />
    


</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid containerp"> 
        <header class="row justify-content-center no-gutters">
            <div class="col-12  col-lg-6 col-xl-3 no-gutters"> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                <img src="images/logo_millos.png" class="logo_millos" alt="">
                <img src="images/separador.svg" alt="" class="separador">
            </div>            
        </header>
        <!--contenido-->
        <div class="">
            <!--<section class="row justify-content-center mt-3 no-gutters"> cambiada el 15012018 por ym, según nuevo diseño-->
                <section class="row justify-content-center no-gutters ">    
                    <!-- titulo-->
                    <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1"> <!-- Agregada el 150102018 por ym, según nuevo diseño-->   
                        <h1><?php echo $descripcion; ?></h1>
                    </div>
                </section>
                <section class="row justify-content-center mt-3 no-gutters">
                    <!--<div class="col-12 col-lg-5 ">-->
                        <div class="col-11 col-lg-5 col-xl-3"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, según cambio del diseño)-->        
                            <!-- Imagen-->
                            <img src="<?php echo $imagen?>" class="img-fluid" alt="">
                        </div>
                    </section>

                    <section class="row justify-content-center mt-1 no-gutters">
                        <!--<div class="col-12 col-lg-5">-->
                            <div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, segun cambios del diseño)-->      
                                <div class="texto mt-1 pl-4 pr-4">
                                    <!-- Texto-->
                                    <!-- <p>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), "<br>", $seccion->descripcion) !!}</p> -->
                                    <h2><?php echo $footer1;?> </h2>
                                    <h2 class="mt-1"><b><?php echo $footer2;?></b></h2>
                                </div>
                            </div>
                        </section>
                        <section class="row justify-content-center no-gutters pb-1">
                            <div class="col-6 col-xl-4 col-lg-4">
                                <a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="images/btn_appstore.svg" alt="" class="tiendas"></a>
                            </div>
                            <div class="col-6 col-xl-4 col-lg-4">
                                <a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="images/btn_googleplay.svg" alt="" class="tiendas"></a>
                            </div>
                        </section>
                    </div>
                    <!-- fin contenido-->
                </div>
                <!-- FIN CONTENEDOR-->
    </body>
</html>