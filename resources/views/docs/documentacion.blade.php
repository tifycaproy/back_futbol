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
			'url_tabla','url_simulador','url_juramento','url_livestream'
		],
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
	"Convocados"=>array(
		"Ruta"=>"/convocados",
		"Método"=>"GET",
		"Éxito"=>array(
			"idpartido","estado","equipo_1","bandera_1","goles_1","equipo_2","bandera_2","goles_2", "fecha", "fecha_etapa", "estadio",
			"jugadores (array)"=>['idjudador','banner'],
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
		"Éxito"=>['idjudador','nombre','fecha_nacimiento','nacionalidad','n_camiseta','posicion','banner','instagram',
			'sepuedeaplaudir (0 ó 1, OJO: si es 0 no trae los datos del partido)',
			'idpartido','equipo_1','bandera_1','goles_1','equipo_2','bandera_2','goles_2','fecha','fecha_etapa','estadio',
			'apalusos_ultimo_partido', 'aplausos_acumulado',
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
			"idjudador" => "integer / requerido",
			"idpartido" => "integer / requerido",
			"imei" => "varchar(45) / requerido",
		),
		"Éxito"=>"no devuelve datos, simplemente se debería refrescar la vista",
		"Falla"=>array(
			"error"=>array("El idjudador es requerido","El imei es requerido","El idpartido es requerido")
		)
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
		"Éxito"=>['nombre','foto','total_votos','instagram'],
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
			"error"=>array("El idencuesta es requerido","El imei es requerido","El idmonumental es requerido")
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