<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}" />
    <title>TU ONCE IDEAL</title>
    <meta property="og:url"                content="{{ Request::fullUrl() }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="MI ONCE IDEAL PARA EL PRÓXIMO PARTIDO" />
    <meta property="og:description"        content="¡Escoge tu once ideal y comparte con tus amigos! Descarga ya la App Oficial de Millonarios FC" />
    <meta property="og:image"              content="{{ $data['foto'] }}" />
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid "> 
        <header class="row justify-content-center mt-1 no-gutters">
            <div class="col-12  col-lg-6 col-xl-3 no-gutters"> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                <img src="{{ asset('compartir/images/logo_millos.png') }}" class="logo_millos" alt="">
                <img src="{{ asset('compartir/images/separador.svg') }}" alt="" class="separador  mb-3">
            </div>            
        </header>
        <!--contenido-->
        <div class=""> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
            <section class="row justify-content-center no-gutters "> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                <!-- titulo-->
                <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1"><!-- AÑADIDO CONTENEDOR (15/01/2018)-->
                    <h1>¡ESTE ES MI ONCE IDEAL!</h1>
                </div>
            </section>
            <section class="row justify-content-center mt-3 no-gutters">
                <section class="col-12 no-gutters">
                <div class="row align-items-center justify-content-center mb-3 no-gutters">
                    <div class="col-3 col-xl-3 col-lg-3">
                        <img src="{{ $data['bandera_1'] }}" alt="" class="tiendas">
                        <h4>{{ $data['equipo_1'] }}</h4>
                    </div>
                    
                        <h1 class="ml-5 mr-5">Vs</h1>
                     <div class="col-3 col-xl-3 col-lg-3">
                        <img src="{{ $data['bandera_2'] }}" alt="" class="tiendas">
                        <h4>{{ $data['equipo_2'] }}</h4>
                    </div>
                    <div class="col-12 mt-3">
                        <h2>{{ $data['copa'] }}</h2>
                    </div>
                </div>
            </section>
                <div class="col-12 col-lg-5 col-xl-4 pl-2 pr-2 "><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                    <!-- Imagen-->
                    <img src="{{ $data['foto'] }}" class="img-fluid" alt="">
                </div>
            </section>
            <section class="row justify-content-center mt-3 no-gutters">
                <div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                    <div class="texto mt-3 pl-4 pr-4">
                        <!-- Texto-->
                        <h2>¡NO DEJEMO NUNCA DE SEGUIR A LA MÁS GRANDE!</h2>
                        <h2 class="mt-3"><b>DESCARGA LA APP OFICIAL DE MILLONARIOS FC</b></h2>
                        
                    </div>
                </div>
            </section>
            <section class="row justify-content-center no-gutters pb-5">
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