<!<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alineación</title>
    <link rel="stylesheet" href="{{asset('/') }}compartir/css/css.css">
    <link rel="stylesheet" href="{{ asset('compartir/css/bootstrap-grid.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('compartir/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('compartir/css/main.css') }}" />
    <script src="{{ asset('compartir/js/bootstrap.min.js') }}"></script>
    <base href="{{asset('/') }}compartir/" />
</head>
<body>
    <!--CONTENEDOR-->
    <div class="container-fluid "> 
        <header class="row justify-content-center mt-5 no-gutters">
            <div class="col-12  col-lg-6 col-xl-3 no-gutters"> <!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                <img src="{{ asset('compartir/images/logo_millos.png') }}" class="logo_millos" alt="">
                <img src="{{ asset('compartir/images/separador.svg') }}" alt="" class="separador  mb-3">
            </div>            
        </header>
        <!--contenido-->
        <div class=""> 
            <section class="row justify-content-center no-gutters "> 
                <!-- titulo-->
                <div class="col-12 col-lg-6 col-xl-4 pl-1 pr-1">
                    <h1>¡ALINEACIÓN OFICIAL!</h1>
                </div>
            </section>

            <section class="row justify-content-center mt-3 no-gutters">

             <section class="col-12- no-gutters">
                <div class="row align-items-center justify-content-around mb-3 no-gutters">
                    <div class="col-3 col-xl-3 col-lg-3">
                        <img src="images/logo_bg.png" alt="" class="tiendas">
                        <h4>Nombre del Equipoa</h4>
                    </div>
                    
                    <h1>Vs</h1>
                    
                    <div class="col-3 col-xl-3 col-lg-3">
                        <img src="images/logo_bg.png" alt="" class="tiendas">
                        <h4>Nombre del Equipob</h4>
                    </div>
                    <div class="col-12 mt-3">
                        <h2>Liga</h2>
                    </div>
                </div>
            </section>
                
                <div class="col-12 col-lg-5 col-xl-4  pl-2 pr-2">
                    <!-- Imagen-->
                    <img src="images/alineacion.jpg" class="img-fluid">
                </div>
                
            </section>
            <section class="row justify-content-center mt-3 no-gutters">
                <div class="col-12 col-lg-6 col-xl-4"><!-- ETIQUETA REMPLAZADA (15/01/2018)-->
                    <div class="texto mt-5 pl-4 pr-4">
                        <!-- Texto-->
                        <h2>¡No dejemos de seguir nunca al más grande!</h2>
                        <h2 class="mt-5"><b>DESCARGA LA APP OFICIAL DEL MILLONARIOS FC</b></h2>
                        
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
</body>
</html>