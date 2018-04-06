<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Documentación</title>
    <style>
        table td {
            vertical-align: top;
        }

        .ppal {
            background: #f5f5f5;
            padding-bottom: 20px;
            cursor: pointer;
        }

        .sec {
            padding-bottom: 20px;
            display: none;
        }

    </style>
</head>

<body>
<div style="background: #2E4B9B; color: #FFF; font-weight: bold; text-align: center; padding: 5px;">
    Ojo, para todas las llamadas tendremos como respuesta el compo 'status' con los valores: 'exito' y mas valores de la
    llamada dentro de 'data', o 'fallo' mas campo 'error' con array con el o los errores
</div>
<?php
function mostrar($m, $primera)
{
    if ($primera) {
        $claseppal = 'ppal';
        $clasesec = 'sec';
    } else {
        $claseppal = '';
        $clasesec = '';
    }
    echo "<table>";
    foreach ($m as $clave => $valor) {
        echo "<tr>";
        if (!is_numeric($clave)) echo "<td class='{$claseppal}'><b>" . $clave . "</b></td>";
        echo "<td class='{$clasesec}'>";
        if (is_array($valor)) {
            mostrar($valor, false);
        } else {
            echo $valor;
        }
        echo "</td></tr>";
    }
    echo "</table>";
}
$data = array(
    "Configuración" => array(
        "Ruta" => "/configuracion",
        "Método" => "GET",
        "Éxito" => [
            'url_tabla', 'url_simulador', 'url_juramento', 'url_livestream', 'url_tienda', 'url_estadisticas', 'url_academia',
            'tit_1', 'tit_1_1', 'tit_1_2', 'tit_2', 'tit_3', 'tit_4', 'tit_4_1', 'tit_4_2', 'tit_5', 'tit_6', 'tit_6_1', 'tit_6_1_1', 'tit_6_1_2', 'tit_6_2', 'tit_6_3', 'tit_6_3_1', 'tit_6_3_2', 'tit_7',
            'tit_7_1', 'tit_7_2', 'tit_8', 'tit_9', 'tit_10', 'tit_10_1', 'tit_10_2', 'tit_11', 'tit_11_1', 'tit_11_1_1', 'tit_11_1_2', 'tit_11_1_3', 'tit_11_1_4',
            'tit_12', 'tit_13', 'tit_14', 'tit_14_1', 'tit_14_2', 'tit_14_2_1', 'tit_14_2_2', 'tit_14_3', 'tit_15',
            'tit_16', 'tit_16_1', 'tit_16_2', 'tit_16_3', 'tit_16_3_1', 'tit_16_3_2', 'tit_16_3_3', 'tit_16_3_4',
            'patrocinante', 'url_vistas',
            'video_referidos', 'terminos_referidos',
        ],
    ),

    "Banners" => array(
        "Ruta" => "/banners",
        "Método" => "GET",
        "Éxito (Array)" => ['seccion', 'titulo', 'target (Interno,Externo,Seccion)', 'url', 'seccion_destino', 'foto'],
    ),

    "Ventanas para compartir" => array(
        "Ruta" => "/ventanas_compartir",
        "Método" => "GET",
        "Éxito (Array)" => ['seccion', 'url'],
    ),

    "Noticias" => array(
        "Ruta" => "/noticias/{token}?page={pagina}",
        "Método" => "GET",
        "Éxito" => [ 'idpartido', 'estado', 'equipo_1', 'bandera_1', 'goles_1', 'equipo_2', 'bandera_2', 'goles_2', 'fecha', 'fecha_etapa', 'estadio', 'info',
            'noticias (array)' => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)', 'solo_dorado(boolean)']
        ],
       
    ),
    "Noticias fotos" => array(
        "Ruta" => "/noticia_fotos/{id de la noticia}",
        "Método" => "GET",
        "Éxito (Array)" => [
            'titulo', 'foto'
        ],
    ),

    "Noticias futboal base" => array(
        "Ruta" => "/noticias_futbolbase?page={pagina}",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)'
        ],
    ),

//usuarios
    "Registrarse" => array(
        "Ruta" => "/usuarios",
        "Método" => "POST",
        "Parámetros" => array(
            "nombre" => "varchar(60) / requerido",
            "apellido" => "varchar(60) / opcional",
            "apodo" => "varchar(30) / opcional",
            "email" => "varchar(100) / requerido / único",
            "clave" => "varchar(20) / requerido",
            "celular" => "varchar(30) / opcional",
            "pais" => "varchar(100) / opcional",
            "ciudad" => "varchar(100) / opcional",
            "fecha_nacimiento" => "fecha / opcional / yy-mm-dd",
            "genero" => "Masculino,Femenino",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "token, idusuario, codigo",
        "Falla" => array(
            "error" => array("Error en validación de datos", "El email ya se encuentra registrado", "El apodo ya se encuentra registrado")
        )
    ),

    "Iniciar sessión" => array(
        "Ruta" => "/auth",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
            "clave" => "varchar(20) / requerido"
        ),
        "Éxito" => "token, idusuario, codigo",
        "Falla" => array(
            "error" => array("Error en validación de datos", "Usuario o clave incorrectos")
        )
    ),

    "Registrarse 2" => array(
        "Ruta" => "/usuarios2",
        "Método" => "POST",
        "Parámetros" => array(
            "nombre" => "varchar(60) / requerido",
            "apellido" => "varchar(60) / opcional",
            "apodo" => "varchar(30) / opcional",
            "email" => "varchar(100) / requerido / único",
            "clave" => "varchar(20) / requerido",
            "celular" => "varchar(30) / opcional",
            "pais" => "varchar(100) / opcional",
            "ciudad" => "varchar(100) / opcional",
            "fecha_nacimiento" => "fecha / opcional / yy-mm-dd",
            "genero" => "Masculino,Femenino",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "mensaje_pin",
        "Falla" => array(
            "error" => array("Error en validación de datos", "El email ya se encuentra registrado", "El apodo ya se encuentra registrado")
        )
    ),

    "Reenviar pin de confirmación" => array(
        "Ruta" => "/reenviar_pin_confirmacion/{email}",
        "Método" => "GET",
        "Éxito" => "mensaje_pin",
        "Falla" => array(
            "error" => ["El email es requerido", "El email es incorrecto"],
        )
    ),

    "Validar cuenta" => array(
        "Ruta" => "/validar_cuenta",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
            "pin" => "varchar(4)",
        ),
        "Éxito" => ["token", "idusuario", "codigo"],
        "Falla" => array(
            "error" => array("Error en validación de datos", "Usuario o PIN incorrectos")
        )
    ),

    "Iniciar sessión 2" => array(
        "Ruta" => "/auth2",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
            "clave" => "varchar(20) / requerido"
        ),
        "Éxito" => "token, idusuario, codigo",
        "Falla" => array(
            "error" => array("Error en validación de datos", "Usuario o clave incorrectos", "La cuenta aun no ha sido confirmada")
        )
    ),
    "iniciar sesión con redes" => array(
        "Ruta" => "/auth_redes",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
            "nombre" => "varchar(60) / requerido",
            "apellido" => "varchar(60) / opcional",
            "userID_facebook o userID_google" => "varchar(20) / requerido",
            "foto_redes" => "(URL opcional)"
        ),
        "Éxito" => "token, idusuario, codigo",
        "Falla" => array(
            "error" => array("Error en validación de datos", "userID_facebook o userID_google son requeridos")
        )
    ),
    "Recuperar clave" => array(
        "Ruta" => "/recuperar_clave",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
        ),
        "Éxito" => array(
            "Se ha enviado un email con su PIN de recuperación. Si no lo recibe por favor revise su carpeta de correos no deseados (spam)",
        ),
        "Falla" => array(
            "error" => array("Error en validación de datos", "Email incorrecto")
        )
    ),
    "Recuperar clave link" => array(
        "Ruta" => "/recuperar_clave_link",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
        ),
        "Éxito" => array(
            "Se ha enviado un email con su link de recuperación. Si no lo recibe por favor revise su carpeta de correos no deseados (spam)",
        ),
        "Falla" => array(
            "error" => array("Error en validación de datos", "Email incorrecto")
        )
    ),
    "Ingresar con pin" => array(
        "Ruta" => "/ingresar_con_pin",
        "Método" => "POST",
        "Parámetros" => array(
            "email" => "varchar(200) / requerido / único",
            "pin" => "varchar(4)",
        ),
        "Éxito" => "token, idusuario, codigo",
        "Falla" => array(
            "error" => array("Error en validación de datos", "Usuario o PIN incorrectos")
        )
    ),
    "Consultar usuario" => array(
        "Ruta" => "/usuarios/{token}",
        "Método" => "GET",
        "Éxito" => ['idusuario', 'ci', 'nombre', 'apellido', 'apodo', 'email', 'celular', 'pais', 'ciudad', 'fecha_nacimiento', 'genero', 'foto', 'created_at', 'codigo', 'fecha_vencimiento', 'referido'],
        "Falla" => array(
            "error" => "Invalid token",
        )
    ),
    "Actualizar usuario" => array(
        "Ruta" => "/usuarios/{token}",
        "Método" => "PUT",
        "Parámetros" => array(
            "nombre" => "varchar(60) / requerido",
            "apellido" => "varchar(60) / opcional",
            "celular" => "varchar(30) / opcional",
            "pais" => "varchar(100) / opcional",
            "ciudad" => "varchar(100) / opcional",
            "fecha_nacimiento" => "fecha / opcional",
            "genero" => "Masculino,Femenino",
            "foto" => "base64 / opcional",
        ),
        "Falla" => array(
            "error" => "Internal error",
        )
    ),
    "consultar referidos" => array(
        "Ruta" => "/consultar_referidos/{token}?page={pagina}",
        "Método" => "GET",
        "Éxito" => [
            "activos",
            "referidos (array)" => array('nombre', 'apellido', 'apodo', 'email', 'celular', 'pais', 'ciudad', 'fecha_nacimiento', 'genero', 'foto', 'estatus', 'activo', 'created_at'),
        ],
        "Falla" => array(
            "error" => "Invalid token",
        )
    ),


//calendario
    "Copas" => array(
        "Ruta" => "/copas",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "idcopa", "titulo"
        )
    ),
    "Partidos" => array(
        "Ruta" => "/partidos",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "copa_id",
            "copa",
            "partido (array)" => [
                "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio", "info"
            ],
        )
    ),
    "Posiciones" => array(
        "Ruta" => "/posicion",
        "Método" => "GET",
        "Éxito (Array)" => array(
                "posicion_id","posicion", "bandera","equipo_id","pt","pj","pg","pp","pe","gc","gf","dif"
        )
    ),
    "Calendario" => array(
        "Ruta" => "/calendario",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "copa",
            "partido (array)" => [
                "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio", "info"
            ],
        )
    ),
    "Silgle Calendario" => array(
        "Ruta" => "/single_calendario/{idpartido}",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio", "info",
            "noticias (Array)" => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)'],
        )
    ),

    "Calendario FB" => array(
        "Ruta" => "/calendariofb",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "copa",
            "partido (array)" => [
                "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio"
            ],
        )
    ),
    "Silgle Calendario FB" => array(
        "Ruta" => "/single_calendariofb/{idpartido}",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio",
            "noticias (Array)" => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)'],
        )
    ),

    "Convocados" => array(
        "Ruta" => "/convocados",
        "Método" => "GET",
        "Éxito" => array(
            "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio", "info",
            "jugadores (array)" => ['idjugador', 'nombre', 'foto', 'banner'],
        )
    ),
    "Play by play" => array(
        "Ruta" => "/playbyplay",
        "Método" => "GET",
        "Éxito Array" => array(
            "idpartido", "estado", "equipo_1", "bandera_1", "goles_1", "equipo_2", "bandera_2", "goles_2", "fecha", "fecha_etapa", "estadio",
            "video", "info", "formacion", "foto_formacion",
            "idjugador", "nombre_dt", "foto_dt",
            "titulares (array)" => array(
                "idjugador", "foto", "nombre", "posicion", "actividades (array)" => array("actividad", "minuto")
            ),
            "suplentes (array)" => array(
                "idjugador", "foto", "nombre", "actividades (array)" => array("actividad", "minuto")
            ),
        ),
        "Error" => array("idcalendario es requerido", "idcalendario incorrecto")
    ),
//jugadores
    "Nómina" => array(
        "Ruta" => "/nomina",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "idjugador", "banner"
        )
    ),
    "Nómina FB" => array(
        "Ruta" => "/nominafb",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "idjugador", "banner"
        )
    ),
    "Single del jugador" => array(
        "Ruta" => "/single_jugador/{idjugador}/{token}",
        "Método" => "GET",
        "Éxito" => ['idjugador', 'nombre', 'fecha_nacimiento', 'nacionalidad', 'n_camiseta', 'posicion', 'peso', 'estatura', 'banner', 'instagram',
            'sepuedeaplaudir (0 ó 1, OJO: si es 0 no trae los datos del partido)',
            'idpartido', 'equipo_1', 'bandera_1', 'goles_1', 'equipo_2', 'bandera_2', 'goles_2', 'fecha', 'fecha_etapa', 'estadio',
            'apalusos_ultimo_partido', 'aplausos_acumulado','ultimo_aplauso',
            'noticias (array)' => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)']
        ],
        "Falla" => array(
            "error" => ["idjugador incorrecto"],
        )
    ),
    "Single del jugador FB" => array(
        "Ruta" => "/single_jugadorfb/{idjugador}",
        "Método" => "GET",
        "Éxito" => ['idjugador', 'nombre', 'fecha_nacimiento', 'nacionalidad', 'n_camiseta', 'posicion', 'peso', 'estatura', 'banner', 'instagram',
            'noticias (array)' => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)']
        ],
        "Falla" => array(
            "error" => ["idjugador incorrecto"],
        )
    ),
    "Aplaudir" => array(
        "Ruta" => "/aplaudir",
        "Método" => "POST",
        "Parámetros" => array(
            "idjugador" => "integer / requerido",
            "idpartido" => "integer / requerido",
            "imei" => "varchar(45) / requerido",
            "Token" => "varchar / requerido"
        ),
        "Éxito" => "no devuelve datos, simplemente se debería refrescar la vista",
        "aplauso" => "Envia cero '0' si ha desaplaudido y uno '1' si ha aplaudido",
        "Falla" => array(
            "error" => array("El idjugador es requerido", "El imei es requerido", "El idpartido es requerido", "Usted ya aplaudió a este jugador en este partido")
        )
    ),
    "Consultar aplauso / equipo" => array(
        "Ruta" => "/aplausos_equipo",
        "Método" => "GET",
        "Éxito" => array(
            'partido_actual' => [
                'idjugador', 'nombre', 'foto', 'votos', 'porcentaje'
            ],
            'acumulado' => [
                'idjugador', 'nombre', 'foto', 'votos', 'porcentaje'
            ],
        ),
        "Error" => array("No hay juegos registrados")
    ),

//monumentales
    "Encuesta" => array(
        "Ruta" => "/encuesta/{token}",
        "Método" => "GET",
        "Éxito" => ['idencuesta', 'titulo', 'fecha_inicio', 'fecha_fin', 'puedevotar (0 ó 1)', 'puedevervotos (0 ó 1)',
            'respuestas (array)' => ['idrespuesta', 'respuesta', 'foto', 'yavoto (0 ó 1)']
        ],
        "Falla" => array(
            "error" => ["El token es incorrecto", "No hay encuestas activas"],
        )
    ),
    "Votar" => array(
        "Ruta" => "/encuesta_votar",
        "Método" => "POST",
        "Parámetros" => array(
            "idencuesta" => "integer / requerido",
            "idrespuesta" => "integer / requerido",
            "token" => "requerido",
        ),
        "Éxito" => 'puedevervotos (0 ó 1)',
        "Falla" => array(
            "error" => array("El idencuesta es requerido", "El token es requerido", "El idrespuesta es requerido"),
        )
    ),
    "Single respuesta" => array(
        "Ruta" => "/single_respuesta/{idrespuesta}",
        "Método" => "GET",
        "Éxito" => ['respuesta', 'banner', 'votos',
            'noticias (array)' => ['id', 'link', 'titulo', 'descripcion', 'fecha', 'foto', 'destacada (1 ó 0)', 'tipo (Normal,Video,Infografia,Galeria,Stat)']
        ],
        "Falla" => array(
            "error" => ["idrespuesta incorrecto"],
        )
    ),
    "Ranking Encuesta" => array(
        "Ruta" => "/ranking_encuestas/{idencuesta}",
        "Método" => "GET",
        "Éxito" => ['idrespuesta', 'respuesta', 'miniatura', 'votos'],
    ),

//Onceideal
    "Registrar Once ideal" => array(
        "Ruta" => "/onceideal",
        "Método" => "POST",
        "Parámetros" => array(
            "token" => "requerido",
            "jugadores (Array de 11)" => [
                "idjugador" => "integer / requerido",
                "x" => "integer / requerido",
                "y" => "integer / requerido"
            ],
            "foto" => 'base64',
        ),
        "Éxito" => ["url"],
        "Falla" => array(
            "error" => array("El token es requerido", "Debe colocar todos los jugadores"),
        )
    ),
    "Consultar Once ideal" => array(
        "Ruta" => "/onceideal/{token}",
        "Método" => "GET",
        "Éxito" => [
            "jugadores (Array de 11)" => ["idjugador", "x", "y"],
            "url" => '',
        ],
        "Falla" => array(
            "error" => array("El token es requerido", "No tiene once ideal cargado"),
        )
    ),

    "videos 360" => array(
        "Ruta" => "/videos360",
        "Método" => "GET",
        "Éxito (Array)" => array(
            "id", "titulo", "descripcion", "foto", "video",
        ),
    ),
//muro
    "Muro" => array(
        "Ruta" => "/muro?token={token}&page={pagina}",
        "Método" => "GET",
        "Éxito (Array)" => [
            'idpost', 'mensaje', 'fecha', 'foto', 'ncomentarios', 'naplausos', 'yaaplaudio (0 ó 1)',
            'usuarios_aplausos' => ['id', 'nombre', 'foto'],
            'usuario' => ['idusuario', 'nombre', 'apellido', 'apodo', 'email', 'celular', 'pais', 'ciudad', 'fecha_nacimiento', 'genero', 'foto', 'created_at', 'codigo', 'fecha_vencimiento']
        ],
    ),
    "Muro postear" => array(
        "Ruta" => "/muro",
        "Método" => "POST",
        "Parámetros" => array(
            "token" => "token / requerido",
            "mensaje" => "textarea / requerido",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "Debe redireccionar al home del muro",
        "Falla" => array(
            "error" => array("El token es requerido", "El mensaje es requerido")
        )
    ),

    "Consultar perfil" => array(
        "Ruta" => "/perfil_usuario/{idusuario}",
        "Método" => "GET",
        "Éxito" => [
            'id', 'apodo', 'fecha', 'foto'
        ],
        "Falla" => array(
            "error" => array("Idusuario incorrecto")
        )
    ),
    "Muro comentar" => array(
        "Ruta" => "/muro_comentar",
        "Método" => "POST",
        "Parámetros" => array(
            "idpost" => "token / requerido",
            "token" => "token / requerido",
            "comentario" => "textarea / comentario",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "Debe redireccionar a los comentarios del post",
        "Falla" => array(
            "error" => array("El token es requerido", "El comentario es requerido", "El idpost es requerido", "El idpost es incorrecto")
        )
    ),

    "Consultar comentarios del post" => array(
        "Ruta" => "/comentarios_post/{idpost}?token={token}&page={pagina}",
        "Método" => "GET",
        "Éxito" => [
            'idcomentario', 'comentario', 'fecha', 'foto', 'naplausos', 'yaaplaudio',
            'usuario' => ['idusuario', 'nombre', 'apellido', 'apodo', 'email', 'celular', 'pais', 'ciudad', 'fecha_nacimiento', 'genero', 'foto', 'created_at', 'codigo', 'fecha_vencimiento']
        ],
        "Falla" => array(
            "error" => array("Idpost incorrecto")
        )
    ),

    "Muro Editar comentario" => array(
        "Ruta" => "/muro_edit_coment/{idpost}/{idcoment}/{token}",
        "Método" => "POST",
        "Parámetros" => array(
            "comentario" => "textarea / comentario",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "Debe redireccionar a los comentarios del post",
        "Falla" => array(
            "error" => array("Ha ocurrido un error, por favor intenta de nuevo", "El token es requerido", "El idcoment es requerido", "El idpost es requerido", "El idpost es incorrecto", "El idcoment es incorrecto")
        )
    ),
    "Muro Eliminar comentario" => array(
        "Ruta" => "/muro_comentar/{idpost}/{idcoment}/{token}",
        "Método" => "DELETE",
        "Parámetros" => array(
            "comentario" => "textarea / comentario",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "Debe redireccionar a los comentarios del post",
        "Falla" => array(
            "error" => array("Ha ocurrido un error, por favor intenta de nuevo","El token es requerido", "El idcoment es requerido", "El idpost es requerido", "El idpost es incorrecto", "El idcoment es incorrecto")
        )
    ),
    "Muro aplaudir post" => array(
        "Ruta" => "/muro_aplaudir",
        "Método" => "POST",
        "Parámetros" => array(
            "idpost" => "idpost / requerido",
            "token" => "token / requerido",
        ),
        "Éxito" => "Debe redireccionar al home del muro",
        "Falla" => array(
            "error" => array("El token es requerido", "El idpost es requerido", "El idpost es incorrecto")
        )
    ),
    "Muro aplaudir comentario" => array(
        "Ruta" => "/muro_comentario_aplaudir",
        "Método" => "POST",
        "Parámetros" => array(
            "idcomentario" => "idcomentario / requerido",
            "token" => "token / requerido",
        ),
        "Éxito" => "Debe redireccionar a los comentarios del post",
        "Falla" => array(
            "error" => array("El token es requerido", "El idcomentario es requerido", "El idcomentario es incorrecto")
        )
    ),

    "Editar Post" => array(
        "Ruta" => "/muro/{idpost}",
        "Método" => "PUT",
        "Parámetros" => array(
            "token" => "token / requerido",
            "mensaje" => "textarea / requerido",
            "foto" => "base64 / opcional",
        ),
        "Éxito" => "Debe redireccionar al muro",
        "Falla" => array(
            "error" => array("Ha ocurrido un error, por favor intenta de nuevo")
        )
    ),


    "Eliminar Post" => array(
        "Ruta" => "/muro/{idpost}/{token}",
        "Método" => "DELETE",
        "Éxito" => "Debe redireccionar al muro",
        "Falla" => array(
            "error" => array("Ha ocurrido un error, por favor intenta de nuevo")
        )
    ),
    "Consulta Configuracion usuarios Dorados" => array(
        "Ruta" => "/dorado/config",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id', 'nombre', 'solo_dorado (boolean)', 'funciones_doradas (boolean)', 'mensaje_dorado'
        ],
    ),
    "Consulta Suscripciones" => array(
        "Ruta" => "/suscripciones/tipos",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id', 'descripcion', 'costo_menor', 'costo_mayor',
        ],
    ),
    "Razones de Cancelacion Suscripcion" => array(
        "Ruta" => "/suscripciones/razonescancelarsuscripcion",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id', 'descripcion',
        ],
    ),
    "Beneficios de Suscripcion" => array(
        "Ruta" => "/suscripciones/beneficios",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id', 'link','titulo','descripcion', 'fecha', 'tipo','url'
        ],
    ),
    "Cancelar Suscripcion" => array(
        "Ruta" => "/suscripciones/cancelar",
        "Método" => "POST",
        "Parámetros" => array(
            "razon" => "idrazon",
            "token" => "token / requerido",
        ),
        "Éxito" => "Ya no eres Dorado :'(",
        "Falla" => array(
            "error" => array("El token es requerido", "El idcomentario es requerido", "El token es incorrecto!")
        )
    ),

    "Puntos de Referencia" => array(
        "Ruta" => "/punto_referencia",
        "Método" => "GET",
        "Éxito (Array)" => [
            'id','titulo', 'latitud','longitud','direccion','ciudad','pais','fecha_evento','hora','icono (null,"bar-rest","cc","estadio","hotel","tienda")','imagenes'
        ],
        "Falla" => array(
            "[]" => array("Array vacio")
        )
    ),

);


mostrar($data, true);


?>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".ppal").data("abierto", "no");
        $(".ppal").click(function () {
            tr = $(this).parent();
            if ($(this).data("abierto") == "no") {
                tr.find(".sec").slideDown(500);
                $(this).data("abierto", "si");
            } else {
                tr.find(".sec").slideUp(500);
                $(this).data("abierto", "no");
            }
        })
    });
</script>
</body>
</html>