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
	"Configuración"=>array(
		"Ruta"=>"/configuracion",
		"Método"=>"GET",
		"Éxito"=>[
			'url_tabla','url_simulador','url_juramento','url_livestream','url_tienda','url_estadisticas','url_academia',
			'tit_1','tit_1_1','tit_1_2','tit_2','tit_3','tit_4','tit_4_1','tit_4_2','tit_5','tit_6','tit_6_1','tit_6_1_1','tit_6_1_2','tit_6_2','tit_6_3','tit_6_3_1','tit_6_3_2','tit_7',
			'tit_7_1','tit_7_2','tit_8','tit_9','tit_10','tit_10_1','tit_10_2','tit_11','tit_11_1','tit_11_1_1','tit_11_1_2','tit_11_1_3','tit_11_1_4',
			'tit_12','tit_13','tit_14','tit_14_1','tit_14_2','tit_14_2_1','tit_14_2_2','tit_14_3','tit_15',
		],
	),
	"Banners"=>array(
		"Ruta"=>"/banners",
		"Método"=>"GET",
		"Éxito (Array)"=>['seccion','target (Interno,Externo,Seccion)','url','seccion_destino','foto'],
	),
	"Noticias"=>array(
		"Ruta"=>"/noticias?page={pagina}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)'
		],
	),
	"Noticias fotos"=>array(
		"Ruta"=>"/noticia_fotos/{id de la noticia}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'titulo','foto'
		],
	),
	
	"Noticias futboal base"=>array(
		"Ruta"=>"/noticias_futbolbase?page={pagina}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)'
		],
	),

//usuarios
	"Registrarse"=>array(
		"Ruta"=>"/usuarios",
		"Método"=>"POST",
		"Parámetros"=>array(
			"nombre" => "varchar(60) / requerido",
			"apellido" => "varchar(60) / opcional",
			"apodo" => "varchar(30) / opcional",
			"referido" => "varchar(30) / opcional",
			"email" => "varchar(100) / requerido / único",
			"clave" => "varchar(20) / requerido",
			"celular" => "varchar(30) / opcional",
			"pais" => "varchar(100) / opcional",
			"ciudad" => "varchar(100) / opcional",
			"fecha_nacimiento" => "fecha / opcional / yy-mm-dd",
			"genero" => "Masculino,Femenino",
			"foto" => "base64 / opcional",
		),
		"Éxito"=>"token, idusuario",
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
		"Éxito"=>"token, idusuario, codigo",
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
		"Éxito"=>"token, idusuario, codigo",
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
		"Éxito"=>"token, idusuario, codigo",
		"Falla"=>array(
			"error"=>array("Error en validación de datos" , "Usuario o PIN incorrectos")
		)
	),
	"Consultar usuario"=>array(
		"Ruta"=>"/usuarios/{token}",
		"Método"=>"GET",
		"Éxito"=>['idusuario','nombre','apellido','apodo','email','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','codigo','fecha_vencimiento'],
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
	"consultar referidos"=>array(
		"Ruta"=>"/consultar_referidos/{token}",
		"Método"=>"GET",
		"Éxito (array)"=>['nombre','apellido','apodo','email','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at'],
		"Falla"=>array(
			"error"=>"Invalid token",
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
	"Silgle Calendario"=>array(
		"Ruta"=>"/single_calendario/{idpartido}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio",
			"noticias (Array)"=>['id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)'],
		)
	),

	"Calendario FB"=>array(
		"Ruta"=>"/calendariofb",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"copa",
			"partido (array)"=>[
				"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio"
			],
		)
	),
	"Silgle Calendario FB"=>array(
		"Ruta"=>"/single_calendariofb/{idpartido}",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio",
			"noticias (Array)"=>['id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)'],
		)
	),

	"Convocados"=>array(
		"Ruta"=>"/convocados",
		"Método"=>"GET",
		"Éxito"=>array(
			"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio",
			"jugadores (array)"=>['idjugador','nombre','foto','banner'],
		)
	),
	"Play by play"=>array(
		"Ruta"=>"/playbyplay",
		"Método"=>"GET",
		"Éxito Array"=>array(
			"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio",
			"video","info","formacion","foto_formacion",
			"idjugador","nombre_dt","foto_dt",
			"titulares (array)"=>array(
				"idjugador","foto","nombre","posicion","actividades (array)"=>array("actividad","minuto")
			),
			"suplentes (array)"=>array(
				"idjugador","foto","nombre","actividades (array)"=>array("actividad","minuto")
			),
		),
		"Error"=>array("idcalendario es requerido","idcalendario incorrecto")
	),
//jugadores
	"Nómina"=>array(
		"Ruta"=>"/nomina",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idjugador","banner"
		)
	),
	"Nómina FB"=>array(
		"Ruta"=>"/nominafb",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"idjugador","banner"
		)
	),
	"Single del jugador"=>array(
		"Ruta"=>"/single_jugador/{idjugador}",
		"Método"=>"GET",
		"Éxito"=>['idjugador','nombre','fecha_nacimiento','nacionalidad','n_camiseta','posicion','peso','estatura','banner','instagram',
			'sepuedeaplaudir (0 ó 1, OJO: si es 0 no trae los datos del partido)',
			'idpartido','equipo_1','bandera_1','goles_1','equipo_2','bandera_2','goles_2','fecha','fecha_etapa','estadio',
			'apalusos_ultimo_partido', 'aplausos_acumulado',
			'noticias (array)'=>['id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)']
		],
		"Falla"=>array(
			"error"=>["idjugador incorrecto"],
		)
	),
	"Single del jugador FB"=>array(
		"Ruta"=>"/single_jugadorfb/{idjugador}",
		"Método"=>"GET",
		"Éxito"=>['idjugador','nombre','fecha_nacimiento','nacionalidad','n_camiseta','posicion','peso','estatura','banner','instagram',
			'noticias (array)'=>['id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)']
		],
		"Falla"=>array(
			"error"=>["idjugador incorrecto"],
		)
	),
	"Aplaudir"=>array(
		"Ruta"=>"/aplaudir",
		"Método"=>"POST",
		"Parámetros"=>array(
			"idjugador" => "integer / requerido",
			"idpartido" => "integer / requerido",
			"imei" => "varchar(45) / requerido",
		),
		"Éxito"=>"no devuelve datos, simplemente se debería refrescar la vista",
		"Falla"=>array(
			"error"=>array("El idjugador es requerido","El imei es requerido","El idpartido es requerido","Usted ya aplaudió a este jugador en este partido")
		)
	),
	"Consultar aplauso / equipo"=>array(
		"Ruta"=>"/aplausos_equipo",
		"Método"=>"GET",
		"Éxito"=>array(
			'partido_actual'=>[
				'idjugador','nombre','foto','votos','porcentaje'
			],
			'acumulado'=>[
				'idjugador','nombre','foto','votos','porcentaje'
			],
		),
		"Error"=>array("No hay juegos registrados")
	),

//monumentales
	"Noticias Monumentales"=>array(
		"Ruta"=>"/noticias_monumentales?page={pagina}",
		"Método"=>"GET",
		"Éxito (Array)"=>[
			'id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)'
		],
	),
	"Encuesta Monumentales"=>array(
		"Ruta"=>"/monumentales_encuesta",
		"Método"=>"GET",
		"Éxito"=>['idencuesta','titulo','fecha_fin','total_votos'],
		'monumentales (array)'=>['idmonumental','nombre','banner'],
		"Falla"=>array(
			"error"=>["No hay encuestas activas"],
		)
	),
	"Single Monumental"=>array(
		"Ruta"=>"/single_monumental/{idmonumental}",
		"Método"=>"GET",
		"Éxito"=>['nombre','foto','total_votos','instagram',
			'noticias (array)'=>['id','link','titulo','descripcion','fecha','foto','destacada (1 ó 0)','tipo (Normal,Video,Infografia,Galeria,Stat)']
		],
		"Falla"=>array(
			"error"=>["idmonumental incorrecto"],
		)
	),
	"Votar Monumental"=>array(
		"Ruta"=>"/votar_monumental",
		"Método"=>"POST",
		"Parámetros"=>array(
			"idencuesta" => "integer / requerido",
			"idmonumental" => "integer / requerido",
			"imei" => "varchar(45) / requerido",
		),
		"Éxito"=>"no devuelve datos, simplemente se debería refrescar la vista",
		"Falla"=>array(
			"error"=>array("El idencuesta es requerido","El imei es requerido","El idmonumental es requerido","Usted ya ha votado por esta monumental"),
		)
	),
	"Monumentales Anual"=>array(
		"Ruta"=>"/monumentales_anuales",
		"Método"=>"GET",
		"Éxito"=>['nombre','banner'],
	),
	"Ranking Monumentales"=>array(
		"Ruta"=>"/ranking_monumentales",
		"Método"=>"GET",
		"Éxito"=>['idmonumental','nombre','miniatura','total_votos','porcentaje'],
	),
//Onceideal
	"Registrar Once ideal"=>array(
		"Ruta"=>"/onceideal",
		"Método"=>"POST",
		"Parámetros"=>array(
			"token" => "requerido",
			"jugadores (Array de 11)"=>[
				"idjugador" => "integer / requerido",
				"x" => "integer / requerido",
				"y" => "integer / requerido"
			],
			"foto" => 'base64',
		),
		"Éxito"=>["url"],
		"Falla"=>array(
			"error"=>array("El token es requerido","Debe colocar todos los jugadores"),
		)
	),
	"Consultar Once ideal"=>array(
		"Ruta"=>"/onceideal/{token}",
		"Método"=>"GET",
		"Éxito"=>[
			"jugadores (Array de 11)"=>["idjugador","x","y"],
			"url"=>'',
		],
		"Falla"=>array(
			"error"=>array("El token es requerido", "No tiene once ideal cargado"),
		)
	),

	"videos 360"=>array(
		"Ruta"=>"/videos360",
		"Método"=>"GET",
		"Éxito (Array)"=>array(
			"titulo","descripcion","foto","video",
		),
	),

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