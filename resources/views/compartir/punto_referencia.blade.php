<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}compartir/" />
 
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
    <title>{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $pr->nombre) !!}</title>
    <meta property="og:url"                content="{{ Request::fullUrl() }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $pr->nombre }}" />
    <meta property="og:description"        content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $pr->descripcion) !!}" />
    @if($imagen<>'') <meta property="og:image"              content="{{ $imagen }}" />@endif
</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid containerp"> 
        <!--contenido-->
        <div class="">
    <!--<section class="row justify-content-center mt-3 no-gutters"> cambiada el 15012018 por ym, según nuevo diseño-->
        <section class="row justify-content-center no-gutters ">    
            <!-- titulo-->
            <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1"> <!-- Agregada el 150102018 por ym, según nuevo diseño-->   
                <h2><img src="{{asset('/') . 'compartir/images/puntos.png'}}" style="margin-right: 10px"> MAPA MILLOS</h2>
                <h1 style="font-size: 22px; margin-top: 10px">{{ $pr->nombre }}</h1>
                <p>{{ $pr->ciudad }}, {{ $pr->pais }}</p>
                <p style="font-weight: normal; font-size: 0.8rem">{!! nl2br($pr->direccion) !!}<br>{{ date('d/m/Y H:i', strtotime($pr->hora_evento)) }}</p>
            </div>
        </section>
        <section class="row justify-content-center mt-3 no-gutters">
            <!--<div class="col-12 col-lg-5 ">-->
                <div class="col-10 col-lg-5 col-xl-3"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, según cambio del diseño)-->        
                    <!-- Imagen-->
                    @if($imagen<>'') <img src="{{ $imagen }}" class="img-fluid" alt="">@endif
                </div>
            </section>

            <section class="row justify-content-center mt-1 no-gutters">
                <!--<div class="col-12 col-lg-5">-->
                    <div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, segun cambios del diseño)-->      
                        <div class="texto mt-1 pl-4 pr-4">
                            <h2>¡NO DEJES DE SEGUIR<br>AL MÁS GRANDE!</h2>
                            <h2 class="mt-1"><b>DESCARGA LA APP OFICIAL<br>DE MILLONARIOS FC</b></h2>
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