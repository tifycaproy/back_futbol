<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}compartir/"/>

    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap-grid.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/bootstrap.min.css" type="text/css">
    <link rel=StyleSheet href="{{asset('/') }}compartir/css/main.css" type="text/css">
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
    <meta property="og:url" content="{{ Request::fullUrl() }}"/>
    <meta property="og:type" content="article"/>
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
                <h1>Contraseña no permitida!!!!</h1>
            </div>
        </section>
        <section class="row justify-content-center mt-3 no-gutters">
            <!--<div class="col-12 col-lg-5 ">-->
            <div class="col-11 col-lg-5 col-xl-3">
                <!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, según cambio del diseño)-->
                <!-- Imagen-->
            </div>
        </section>

        <section class="row justify-content-center mt-1 no-gutters">
            <!--<div class="col-12 col-lg-5">-->
            <div class="col-12 col-lg-6 col-xl-4">
                <!-- ETIQUETA REMPLAZADA (15/01/2018 por ym, segun cambios del diseño)-->
                <div class="texto mt-1 pl-4 pr-4">
                    <!-- Texto-->
                </div>
            </div>
        </section>
        <section class="row justify-content-center no-gutters pb-1">
            <div class="col-6 col-xl-4 col-lg-4">
                <a href="https://itunes.apple.com/co/app/millonarios-fc-oficial/id1315497014?mt=8"><img
                            src="images/btn_appstore.svg" alt="" class="tiendas"></a>
            </div>
            <div class="col-6 col-xl-4 col-lg-4">
                <a href="https://play.google.com/store/apps/details?id=com.millonarios.MillonariosFC"><img
                            src="images/btn_googleplay.svg" alt="" class="tiendas"></a>
            </div>
        </section>
    </div>
    <!-- fin contenido-->
</div>
<!-- FIN CONTENEDOR-->
</body>
</html>