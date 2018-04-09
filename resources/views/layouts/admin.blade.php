<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('/') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="css/slim.min.css" rel="stylesheet">
@yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp; {{ Auth::user()->nombre }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-bell"></i> Alertas</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ route('home') }}"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route("configuracion") }}"><i class="fa fa-fw fa-cog"></i> Configuración</a>
                    </li>
                    <li>
                        <a href="{{ route("usuarios.index") }}"><i class="fa fa-fw fa-user"></i> Usuarios</a>
                    </li>
                    <li>
                        <a href="{{ url('secciones_doradas') }}"><i class="fa fa-fw fa-pencil"></i> Secciones Doradas</a>
                    </li>
                    <li>
                        <a href="{{ url('funciones_doradas') }}"><i class="fa fa-fw fa-pencil"></i> Funciones Doradas</a>
                    </li>
                     <li>
                        <a href="{{ route("enviarNotificaciones") }}"><i class="fa fa-fw fa-pencil"></i> Enviar notificaciones</a>
                    </li>
                    <li>
                        <a href="{{ route("banners.index") }}"><i class="fa fa-fw fa-pencil"></i> Banners</a>
                    </li>
                    <li>
                        <a href="{{ route("ventanas.index") }}"><i class="fa fa-fw fa-pencil"></i> Ventanas para compartir</a>
                    </li>
                    <li>
                        <a href="{{ route("noticias.index") }}"><i class="fa fa-fw fa-pencil"></i> Noticias</a>
                    </li>
                    <li>
                        <a href="{{ route("equipos.index") }}"><i class="fa fa-fw fa-pencil"></i> Equipos</a>
                    </li>
                    <li>
                        <a href="{{ route("jugadores.index") }}"><i class="fa fa-fw fa-pencil"></i> Jugadores</a>
                    </li>
                    <li>
                        <a href="{{ route("jugadoresfb.index") }}"><i class="fa fa-fw fa-pencil"></i> Jugadores Futbol Base</a>
                    </li>
                    <li>
                        <a href="{{ route("copas.index") }}"><i class="fa fa-fw fa-pencil"></i> Copas / Calendario</a>
                    </li>
                    <li>
                        <a href="{{ route("copasfb.index") }}"><i class="fa fa-fw fa-pencil"></i> Copas / Calendario FB</a>
                    </li>
                    <li>
                        <a href="{{ route("posiciones.index") }}"><i class="fa fa-fw fa-pencil"></i> Posiciones</a>
                    </li>
                    <li>
                        <a href="{{ route("convocados") }}"><i class="fa fa-fw fa-pencil"></i> Convocados</a>
                    </li>
                    <li>
                        <a href="{{ route("videosvr.index") }}"><i class="fa fa-fw fa-pencil"></i> Videos VR</a>
                    </li>
                    <li>
                        <a href="{{ route("encuestas.index") }}"><i class="fa fa-fw fa-pencil"></i> Encuestas</a>
                    </li>
                    <li>
                        <a href="{{ route("post.index") }}"><i class="fa fa-fw fa-pencil"></i> Posts</a>
                    </li>
                    <li>
                        <a href="{{ route("puntoreferencia.index") }}"><i class="fa fa-fw fa-pencil"></i> Puntos de referencia</a>
                    </li>
                    <li>
                        <a href="{{ route("reporte.index") }}"><i class="fa fa-fw fa-pencil"></i> Reportes</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

@yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

@yield('javascript')

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script src="js/slim.jquery.js"></script>
</body>
</html>
