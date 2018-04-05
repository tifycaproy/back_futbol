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
    <title>VIDEO</title>
    <meta property="og:url"                content="{{ Request::fullUrl() }}" />
    <meta property="og:type"               content="article"/>
    <meta property="og:title"              content="en vivo"/>
    <meta property="og:description"        content="en vivo" />
    <meta property="og:image"              content="{{ $data->foto }}" />
</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid containerp"> 
        <header class="row justify-content-center no-gutters">
            <div class="col-12  col-lg-6 col-xl-3 no-gutters"> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                <img src="{{ asset ('compartir/images/logo_millos.png') }}" class="logo_millos" alt="">
                <img src="{{ asset ('compartir/images/separador.svg') }}" alt="" class="separador">
            </div>            
        </header>
        <!--contenido-->
        <div class="">
            <!--<section class="row justify-content-center mt-3 no-gutters"> cambiada el 15012018 por ym, según nuevo diseño-->
                <section class="row justify-content-center no-gutters ">    
                    <!-- titulo-->
                    <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1"> <!-- Agregada el 150102018 por ym, según nuevo diseño-->   
                        <h1>En vivo<br></h1>
                    </div>
                </section>
                <section class="row justify-content-center no-gutters">
                    <!--<div class="col-12 col-lg-5 ">-->
                        <div align="center"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, según cambio del diseño)-->    
                            <?php  $parts = parse_url($data->url_envivo); 
                            if(isset($parts['query'])){
                                parse_str($parts['query'], $query);
                            }else{
                                $url = "https://twitter.com".$parts['path']."?ref_src=twsrc%5Etfw";
                                $url = str_replace("/Twitter", "", $url);
                            } 
                            ?>
                            
                            @if(isset($parts['query']))
                                <iframe width="300" height="200" src="https://www.youtube.com/embed/{{$query['v']}}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                            @else
                                <blockquote class="twitter-video" data-lang="es">&mdash; Millonarios FC (@MillosFCoficial) <a href="https://twitter.com/MillosFCoficial/status/981199569986965505?ref_src=twsrc%5Etfw">3 de abril de 2018</a></blockquote>
                            @endif

                        </div>
                    </section>

                    <section class="row justify-content-center mt-1 no-gutters">
                        <!--<div class="col-12 col-lg-5">-->
                            <div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, segun cambios del diseño)-->    

                                <div class="texto mt-1 pl-4 pr-4">
                                    <h2>{{ $seccion->footer1 }}</h2>
                                    <h2 class="mt-1"><b>{{ $seccion->footer2 }}</b></h2>
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
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>





