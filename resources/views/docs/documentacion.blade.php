<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documentación</title>
<style>
table td{vertical-align:top;}
.ppal{background:#f5f5f5; padding-bottom:20px; cursor:pointer;}
.sec{padding-bottom:20px; display:none;}

</style>
</head>

<body>
<div style="background: #2E4B9B; color: #FFF; font-weight: bold; text-align: center; padding: 5px;">
	Ojo, para todas las llamadas tendremos como respuesta el compo 'status' con los valores: 'exito' y mas valores de la llamada dentro de 'data', o  'fallo' mas campo 'error' con array con el o los errores
</div>
<?php
function mostrar($m, $primera){
	if($primera){
		$claseppal='ppal';
		$clasesec='sec';
	}else{
		$claseppal='';
		$clasesec='';
	}
	echo "<table>";
	foreach($m as $clave => $valor){
		echo "<tr>";
		if(!is_numeric($clave)) echo "<td class='{$claseppal}'><b>" .$clave . "</b></td>";
		echo "<td class='{$clasesec}'>";
		if(is_array($valor)){
			mostrar($valor, false);
		}else{
			echo $valor;
		}
		echo "</td></tr>";	
	}
	echo "</table>";
}
$data=array(
	"Noticias"=>array(
		"Ruta"=>"/noticias?page={pagina}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'id','link','titulo','descripcion','fecha','foto','aparecetimelineppal (1 ó 0)','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)',
			'aparevetimelinemonumentales (1 ó 0)'
		],
	),
	"Noticias fotos"=>array(
		"Ruta"=>"/noticia_fotos/{id de la noticia}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'titulo','foto'
		],
	),

//usuarios
	"Registrarse"=>array(
		"Ruta"=>"/usuarios",
		"Método"=>"POST",
		"Parámetros"=>array(
			"nombre" => "varchar(60) / requerido",
			"apellido" => "varchar(60) / opcional",
			"email" => "varchar(100) / requerido / único",
			"clave" => "varchar(20) / requerido",
			"celular" => "varchar(30) / opcional",
			"pais" => "varchar(100) / opcional",
			"ciudad" => "varchar(100) / opcional",
			"fecha_nacimiento" => "fecha / opcional / yy-mm-dd",
			"genero" => "Masculino,Femenino",
			"foto" => "base64 / opcional",
		),
		"Éxito"=>"token",
		"Falla"=>array(
			"error"=>array("Error en validación de datos", "El email ya se encuentra registrado","El apodo ya se encuentra registrado","El apodo del referido no existe")
		)
	),
	"Iniciar sessión"=>array(
		"Ruta"=>"/auth",
		"Método"=>"POST",
		"Parámetros"=>array(
			"email" => "varchar(200) / requerido / único",
			"clave" => "varchar(20) / requerido"
		),
		"Éxito"=>"token",
		"Falla"=>array(
			"error"=>array("Error en validación de datos" , "Usuario o clave incorrectos")
		)
	),
	"iniciar sesión con redes"=>array(
		"Ruta"=>"/auth_redes",
		"Método"=>"POST",
		"Parámetros"=>array(
			"email" => "varchar(200) / requerido / único",
			"nombre" => "varchar(60) / requerido",
			"apellido" => "varchar(60) / opcional",
			"userID_facebook o userID_google" => "varchar(20) / requerido",
			"foto_redes" => "(URL opcional)"
		),
		"Éxito"=>"token",
		"Falla"=>array(
			"error"=>array("Error en validación de datos" , "userID_facebook o userID_google son requeridos")
		)
	),
	"Recuperar clave"=>array(
		"Ruta"=>"/recuperar_clave",
		"Método"=>"POST",
		"Parámetros"=>array(
			"email" => "varchar(200) / requerido / único",
		),
		"Éxito"=>array(
			"Se ha enviado un email con su PIN de recuperación. Si no lo recibe por favor revise su carpeta de correos no deseados (spam)",
		),
		"Falla"=>array(
			"error"=>array("Error en validación de datos" , "Email incorrecto")
		)
	),
	"Ingresar con pin"=>array(
		"Ruta"=>"/ingresar_con_pin",
		"Método"=>"POST",
		"Parámetros"=>array(
			"email" => "varchar(200) / requerido / único",
			"pin" => "varchar(4)",
		),
		"Éxito"=>"token",
		"Falla"=>array(
			"error"=>array("Error en validación de datos" , "Usuario o PIN incorrectos")
		)
	),
	"Consultar usuario"=>array(
		"Ruta"=>"/usuarios/{token}",
		"Método"=>"GET",
		"Éxito"=>['nombre','apellido','email','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','codigo'],
		"Falla"=>array(
			"error"=>"Invalid token",
		)
	),
	"Actualizar usuario"=>array(
		"Ruta"=>"/usuarios/token",
		"Método"=>"PUT",
		"Parámetros"=>array(
			"nombre" => "varchar(60) / requerido",
			"apellido" => "varchar(60) / opcional",
			"celular" => "varchar(30) / opcional",
			"pais" => "varchar(100) / opcional",
			"ciudad" => "varchar(100) / opcional",
			"fecha_nacimiento" => "fecha / opcional",
			"genero" => "Masculino,Femenino",
			"foto" => "base64 / opcional",
		),
		"Falla"=>array(
			"error"=>"Internal error",
		)
	),
//calendario
	"Copas"=>array(
		"Ruta"=>"/copas",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idcopa","titulo"
		)
	),
	"Partidos"=>array(
		"Ruta"=>"/partidos",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"copa",
			"partido (array)"=>[
				"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio"
			],
		)
	),
	"Calendario"=>array(
		"Ruta"=>"/calendario",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"copa",
			"partido (array)"=>[
				"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio"
			],
		)
	),
//jugadores
	"Nómina"=>array(
		"Ruta"=>"/nomina",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idjudador","banner"
		)
	),
	"Single del jugador"=>array(
		"Ruta"=>"/single_jugador/{idjugador}",
		"Método"=>"GET",
		"Éxito"=>['idjudador','nombre','fecha_nacimiento','nacionalidad','n_camiseta','posicion','banner',
		'sepuedeaplaudir (0 ó 1, OJO: si es 0 no trae los datos del partido)',
		'idpartido','equipo_1','bandera_1','goles_1','equipo_2','bandera_2','goles_2','fecha','fecha_etapa','estadio',
		'apalusos_ultimo_partido', 'aplausos_acumulado'

		],
		"Falla"=>array(
			"error"=>["El token es incorrecto","idjugador incorrecto"],
		)
	),

/*
	"Calendario Single (partidos)"=>array(
		"Ruta"=>"/calendario_single?idcalendario={idcalendario}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2","posicion", "tipo", "fecha", "fecha_fifa",
			"hora","descripcion", "estatus",
				"noticias (array)" => array(
					"idNew","linkNew","tittleNew","descNew","dateNew","isVideoNew","impot","isInfograf","img","heigthInfo","isNoticiaInfo"
				),
			),
		"Error"=>array("idcalendario es requerido","idcalendario incorrecto")
	),
	
	"Play by play"=>array(
		"Ruta"=>"/playbyplay?idcalendario={idcalendario}",
		"Método"=>"GET",
		"Éxito Array"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2","posicion", "tipo", "fecha", "fecha_fifa",
			"hora","estatus","formacion","idjugador","nombre_dt","foto_dt",
			"titulares (array)"=>array(
				"idjugador","foto","banner","posicion_campo","nombre","actividades (array)"=>array("actividad","minuto")
			),
			"suplentes (array)"=>array(
				"idjugador","foto","banner","nombre","actividades (array)"=>array("actividad","minuto")
			),
			"titulares2 (array)"=>array(
				"idjugador","foto","banner","posicion_campo","nombre","actividades (array)"=>array("actividad","minuto")
			),
			"suplentes2 (array)"=>array(
				"idjugador","foto","banner","posicion_campo","nombre","actividades (array)"=>array("actividad","minuto")
			),
		),
		"Error"=>array("idcalendario es requerido","idcalendario incorrecto")
	),
	
	"Jugador Single"=>array(
		"Ruta"=>"/jugador?idjugador={idjugador}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2","posicion", "tipo", "fecha", "fecha_fifa", "hora", "estatus",
			"aplausos_partido", "aplausos_total",
			"idjugador","nombre","fecha_nacimiento","estatura","pie","posicion","biografia","foto", "camiseta", "dt","banner",
			"noticias (array)" => array(
				"idNew","linkNew","tittleNew","descNew","dateNew","isVideoNew","impot","isInfograf","img","heigthInfo","isNoticiaInfo"
			),
			"sepuedeaplaudir (1 ó 0)",
		),
		"Error"=>array("idjugador es requerido","idjugador incorrecto")
	),
//calendarios 2
	"Calendario 2"=>array(
		"Ruta"=>"/calendario",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2","tipo", "fecha", "fecha_fifa", "estatus", "destacado"
		)
	),
	"Calendario 2 Single"=>array(
		"Ruta"=>"/calendario2_single?idcalendario={idcalendario}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2","tipo", "fecha", "fecha_fifa",
			"hora","descripcion", "estatus",
				"noticias (array)" => array(
					"idNew","linkNew","tittleNew","descNew","dateNew","isVideoNew","impot","isInfograf","img","heigthInfo","isNoticiaInfo"
				),
			),
		"Error"=>array("idcalendario es requerido","idcalendario incorrecto")
	),

//encuestas
	"Consultar encuesta"=>array(
		"Ruta"=>"/encuestas",
		"Método"=>"GET",
		"Parámetros"=>array('imei'),
		"Éxito (Array)"=>array(
			"idencuesta","titulo","fecha_inicio","fecha_fin","yavoto (1,0)",
			"respuestas (array)"=>array(
				"idrespuesta","respuesta","foto","porcentaje","yavoto"
			),
		),
		"Error"=>array("No hay encuestas activas")
	),
	
	"Encuesta votar"=>array(
		"Ruta"=>"/encuestas",
		"Método"=>"POST",
		"Parámetros"=>array(
			"idencuesta" => "requerido",
			"idrespuesta" => "requerido (si ya voto puede venir con 0)",
			"imei" => 'requerido',
		),
		"Éxito (Array)"=>array(
			"respuesta","foto","votos"
		),
		"Error"=>array("No hay encuestas activas")
	),

	"Single respuesta"=>array(
		"Ruta"=>"/respuesta?idrespuesta={idrespuesta}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idrespuesta","idencuesta","respuesta","foto",
			"noticias (array)" => array(
				"idNew","linkNew","tittleNew","descNew","dateNew","isVideoNew","impot","isInfograf","img","heigthInfo","isNoticiaInfo"
			),
		),
		"Error"=>array("idrespuesta es requerido","idrespuesta incorrecto")
	),
	
//videos
	"videos"=>array(
		"Ruta"=>"/videos",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"titulo","descripcion","foto","url",
		),
	),
	"videos 360"=>array(
		"Ruta"=>"/videos360",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"titulo","descripcion","foto","video",
		),
	),

//aplausos
	"Registrar aplauso"=>array(
		"Ruta"=>"/aplausos",
		"Método"=>"POST",
		"Parámetros"=>array(
			"idjugador" => "requerido",
			"imei" => 'requerido',
		),
		"Éxito"=>"yaaplaudio  (1,0)",
		"Error"=>array("No hay juegos cercanos para aplaudir","El jugador no tiene juegos registrados")
	),
	"Consultar aplauso / jugador"=>array(
		"Ruta"=>"/aplausos",
		"Método"=>"GET",
		"Parámetros"=>array('idjugador'),
		"Éxito"=>array(
			'equipo1','bandera1','goles1','equipo2','bandera2','goles2','tipo','fecha','hora',
			'nombre','posicion','foto','banner',
			'aplausos_partido','aplausos_total'
		),
		"Error"=>array("El jugador no tiene juegos registrados")
	),

	"Consultar aplauso / equipo"=>array(
		"Ruta"=>"/aplausos_equipo",
		"Método"=>"GET",
		"Éxito"=>array(
			'equipo1','bandera1','goles1','equipo2','bandera2','goles2',"posicion",'fecha','hora',
			'partido_actual'=>[
				'idjugador','nombre','foto','votos','porcentaje'
			],
			'acumulado'=>[
				'idjugador','nombre','foto','votos','porcentaje'
			],
		),
		"Error"=>array("No hay juegos registrados","Ya aplaudió a este jugador en este partido")
	),

	"Convocados"=>array(
		"Ruta"=>"/convocados",
		"Método"=>"GET",
		"Éxito"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2", "tipo","posicion", "fecha", "fecha_fifa","hora","estatus",
			"convocados"=>array(
				'idjugador','nombre','foto','banner'
			),
		),
	),


	"Convocados eliminatorias"=>array(
		"Ruta"=>"/convocados_eliminatorias",
		"Método"=>"GET",
		"Éxito"=>array(
			'idjugador','nombre','foto','banner'
		),
		"Error"=>array("No hay juegos registrados")
	),

	"Convocados úlitmo partido"=>array(
		"Ruta"=>"/convocados_ulitmo_partido",
		"Método"=>"GET",
		"Éxito"=>array(
			"idcalendario","equipo1","bandera1","goles1","equipo2","bandera2","goles2", "tipo","posicion", "fecha", "fecha_fifa","hora","estatus",
			"convocados"=>array(
				'idjugador','nombre','foto','banner'
			),
		),
		"Error"=>array("No hay juegos registrados")
	),

//pollas
	"Configuración pollas"=>array(
		"Ruta"=>"/configuracion_pollas",
		"Método"=>"GET",
		"Éxito"=>array("politicas","instrucciones")
	),

	"Consultar polla"=>array(
		"Ruta"=>"/pollas?token={token}",
		"Método"=>"GET",
		"Éxito"=>array("idpolla","fecha_inicio","fecha_fin","nombre","apellido","puntos","ranking","foto","bandera1","bandera2","posicion","fecha",
			"jugadores"=>array(
				"idjugador","nombre","foto","posicion"
			)
		),
		"Error"=>array("Invalid token","No existe polla activa","El usuario ya cargó sus predicciones")
	),

	"Registrar predicción"=>array(
		"Ruta"=>"/pollas",
		"Método"=>"POST",
		"Parámetros"=>array(
			"token","idpolla","goles_colombia","goles_contrincante",
			"idjugador1","idjugador2","idjugador3","idjugador4","idjugador5","idjugador6","idjugador7","idjugador8","idjugador9","idjugador10","idjugador11",
			"goles (array)"=>["idjugador_gol","minuto"],
		),
		//"Éxito"=>"token",
		"Falla"=>array(
			"error"=>array("Error en validación de datos","El token es incorrecto","La polla no se encuentra activa","Ya tiene una predicción cargada para este partido","La cantidad de goles del equipo no coincide con los predichos"),
		)
	),

	"Consultar mi predicción"=>array(
		"Ruta"=>"/pollas_mi_prediccion?token={token}",
		"Método"=>"GET",
		"Éxito"=>array(
			"goles"=>array(
				"idjugador","minuto","nombre"
			),
			"alineacion"=>array(
				"idjugador","nombre"
			),"goles_colombia","goles_contrincante"
		),
		"Error"=>array("Invalid token","No existe polla activa")
	),

	"Ranking pollas"=>array(
		"Ruta"=>"/pollas_rancking?token={token}",
		"Método"=>"GET",
		"Éxito"=>array("nombre","apellido","foto","puntos","ranking","puntos_partido","ranking_partido",
			"usuarios"=>array(
				"idusuario","nombre","apellido","foto","puntos","ranking"
			),
			"usuarios_utimo_partido"=>array(
				"idusuario","nombre","apellido","foto","puntos","ranking"
			),
		),
		"Error"=>array("Invalid token")
	),

	"Resultado de pollas"=>array(
		"Ruta"=>"/pollas_resultados?token={token} o idusuario={idusuario} OJO debe mandar uno de los dos",
		"Método"=>"GET",
		"Éxito"=>array("nombre","apellido","foto","puntos","ranking",
			"bandera1","goles1","bandera2","goles2","posicion (Casa o Visitante)",

			"realidad"=>array(
				"goles"=>array(
					"idjugador","minuto","nombre"
				),
				"alineacion"=>array(
					"idjugador","nombre"
				),"goles_colombia","goles_contrincante"
			),

			"prediccion"=>array(
				"alineacion"=>array(
					"idjugador","nombre","puntos"
				),
				"goles"=>array(
					"idjugador","nombre","puntos"
				),
				"minutos"=>array(
					"minuto","puntos"
				),
				"goles_colombia","goles_contrincante","puntos_resultado","conbono (1 o 0)","puntos"
			),
		),
		"Error"=>array("Invalid token","No existe polla activa")
	),

	"Banners"=>array(
		"Ruta"=>"/banners?seccion={'Menu inferior','Menu superior','login','registro','perfil','notificaciones','noticias recientes','partidos','tabla','calendario','equipo','jugador mas aplaudido','alineación oficial','tu equipo ideal','realidad virtual','en vivo','tu eliges','la polla','ofertas'}",
		"Método"=>"GET",
		"Éxito"=>array(
			"titulo","seccion","url_ios","url_android","link","target (Interno,Externo)"
		),
		"Error"=>array("No hay banners para la sección seleccionada")
	),
*/
);


mostrar($data, true);


?>
<script src="https://code.jquery.com/jquery-latest.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(e) {
	$(".ppal").data("abierto","no");
	$(".ppal").click(function(){
		tr=$(this).parent();
		if($(this).data("abierto")=="no"){
			tr.find(".sec").slideDown(500);	
			$(this).data("abierto","si");
		}else{
			tr.find(".sec").slideUp(500);	
			$(this).data("abierto","no");
		}
	})
});
</script>
</body>
</html>