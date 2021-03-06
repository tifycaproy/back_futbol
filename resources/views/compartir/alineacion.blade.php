<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alineación</title>
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
    <base href="{{asset('/') }}compartir/" />
    <meta property="og:url"                content="{{ Request::fullUrl() }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->titulo) !!}" />
    <meta property="og:description"        content="{!! str_replace(array("\\r\\n", "\\n", "\\r","\r\n", "\n", "\r"), " ", $seccion->descripcion) !!}" />
    <meta property="og:image"              content="{{ config('app.url') . 'ventanas/' . $seccion['foto'] }}" />
  
</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid containerp"> 
        <header class="row justify-content-center mt-1 no-gutters">
            <div class="col-12  col-lg-6 col-xl-3 no-gutters"> 
                <img src="{{ asset('compartir/images/logo_millos.png') }}" class="logo_millos_alineacion" alt="">
                <!--img src="{{ asset('compartir/images/separador.svg') }}" alt="" class="separador  mb-3"-->
            </div>            
        </header>
        <!--contenido-->
        <div class=""> 
            <section class="row justify-content-center no-gutters "> 
                <!-- titulo-->
                <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1">
                    <h1>{{ $seccion->titulo }}</h1>
                </div>
            </section>
            <section class="row justify-content-center no-gutters">
                <section class="col-12 no-gutters">
                <div class="row align-items-center justify-content-center no-gutters">
                    <div class="col-3 col-xl-2 col-lg-2">
                        <img src="{{ $data['bandera_1'] }}" alt="" class="escudos">
                        <h4>{{ $data['equipo_1'] }}</h4>
                    </div>
                    
                        <h1 class="ml-5 mr-5">Vs</h1>
                
                    <div class="col-3 col-xl-3 col-lg-3">
                        <img src="{{ $data['bandera_2'] }}" alt="" class="escudos">
                        <p class="texto">{{ $data['equipo_2'] }}</p>
                    </div>
                    <div class="col-12">
                        <p class="texto">{{ $data['copa'] }}</p>
                    </div>
                </div>
            </section>
                <div class="col-12 col-md-10 col-lg-5 col-xl-4 pl-2 pr-2 ">
                    <!-- Imagen-->
                    <img src="{{ config('app.url') . 'ventanas/' . $seccion['foto'] }}" class="img-fluid" alt="">
                </div>
            </section>
            <section class="row justify-content-center mt-1 no-gutters">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="texto pl-4 pr-4">
                        <!-- Texto-->
                        <h2>{{ $seccion->descripcion }}</h2>
                        <h2 class=""><b>{{ $seccion->footer1 }}</b></h2>
                        <p>&nbsp;</p> 
                    </div>
                </div>
            </section>
            <section class="row justify-content-center no-gutters pb-1">
                <div class="col-6 col-xl-4 col-lg-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                    <a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img src="{{ asset('compartir/images/btn_appstore.svg') }}" alt="" class="tiendas"></a>
                </div>
                <div class="col-6 col-xl-4 col-lg-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                    <a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img src="{{ asset('compartir/images/btn_googleplay.svg') }}" alt="" class="tiendas"></a>
                </div>
            </section>
        </div>
        <!-- fin contenido-->
    </div>
    <!-- FIN CONTENEDOR-->
</body>
</html>