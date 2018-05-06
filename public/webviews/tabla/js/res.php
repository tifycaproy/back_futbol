<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 

<title>Simulador</title>

<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

<script type="text/javascript" src="jquery/jquery-min.js"></script>
	<script type="text/javascript" src="js/simulador.js"></script>

<style type="text/css">
body,td,th {
	font-family: 'Oswald';
}
</style>

	</head>
	
<?php  

error_reporting(E_ALL);
ini_set("display_errors", 1);

//tomamos los datos del archivo conexion.php  
include("conexion.php");  
$link = Conectarse();  
mysql_set_charset('utf8', $link);




//se despliega el resultado  
echo "<div class='header'>";


echo "<div class='box-columna' id='clasificacion'>";

echo "<table width='100%' border='1' cellspacing='0' cellpadding='0' class='tabla-posiciones' id='tabla-posiciones-simulador'>";

echo    "<tr>";
echo      "<tH>&nbsp;</tH>";
echo      "<th>EQUIPOS</th>";
echo      "<th>PTS</th>";
echo      "<th>PJ</th>";
echo      "<th>PG</th>";
echo      "<th>PE</th>";
echo      "<th>PP</th>";
echo      "<th>GF</th>";
echo      "<th>GC</th>";
echo      "<th>DIF</th>";
echo    "</tr>";
	
	//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=1", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
						
    echo "<tr data-eq='BAR'>";
	
	echo "<td>&nbsp;</td>";  

	echo "<td>&nbsp;<IMG SRC='img/banderas/bsc.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}
	
		//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=2", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='NAC'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/nacional.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}
			//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=3", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='FLU'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/fluminense.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}

				//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=4", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='MIN'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/mineiro.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}
					//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=5", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='VAR'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/legia.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}
					//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=6", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='RAN'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/rangers.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}

//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=7", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='COR'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/corinthians.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}

//se envia la consulta  
$result = mysql_query("SELECT * FROM florida_cup WHERE id=8", $link);  

//marcadores

while ($row = mysql_fetch_row($result)){   
    echo "<tr data-eq='PSV'>";
	echo "<td>&nbsp;</td>";  
	echo "<td>&nbsp;<IMG SRC='img/banderas/psv.png' width='24px' height='24px' valign='bottom'>
".$row[1]."</td>";  
    echo "<td>".$row[2]."</td>";  
    echo "<td>".$row[3]."</td>";  
    echo "<td>".$row[4]."</td>";  
    echo "<td>".$row[5]."</td>";  
    echo "<td>".$row[6]."</td>";  
    echo "<td>".$row[7]."</td>";  
    echo "<td>".$row[8]."</td>";  
    echo "<td>".$row[9]."</td>";  

	echo "</tr>";  
	
	
}

echo "</table>";  
	
	echo "</div>";
	echo "</div>";




//<!-- Contenedor general-->
echo "<div id='inner-wrap'>";

//<!-- Contenido-->
echo "<div id='especiales-contenedor-principal'>";






//<!-- Contenedor columnas -->
echo "<div id='contenedor-columnas'>";


//<!-- Box central > Intro florida_cup -->

echo "<div class='box-central'>";




echo "<div class='contenedor-simulador-movil'>";

echo "<div class='contenedor-simulador-movil-inside' data-pos='1'>";


echo "<ul class='nav-fechas-calendario'>
    <span class='titulo-nav-box-central' data-top='top'>Selecciona una fecha</span>
    <li data-ancla='1'>1</li><li data-ancla='2'>2</li><li data-ancla='3'>3</li><li data-ancla='4'>4</li><li data-ancla='5'>5</li><li data-ancla='6'>6</li>
</ul>";




//<!--FECHAS while-->

$feca = mysql_query("SELECT distinct(id_fecha) FROM simulador_fechas", $link);

while($fila = mysql_fetch_array($feca)){
 $query="SELECT * FROM simulador_fechas where id_fecha=".$fila['id_fecha'];
 $feca2 = mysql_query($query, $link);	



 
echo "<div class='box-simulador-general'>";

echo "<h4 class='calendario-fecha' data-anclado='".$fila['id_fecha']."'>";
if(!$fila['id_fecha']==1){
echo "<a href='#' class='izq' ></a>";
}
echo "<a href='#' ></a>Fecha ".$fila['id_fecha']."
<a href='#' class='der'></a></h4>";

echo "<ul class='sim-calendario-grupo'>";
	
	
while($fila2 = mysql_fetch_array($feca2)){ 	
      echo "<li>
      <div class='loc'>
      <IMG SRC='img/banderas/corinthians.png' valign='top'>".$fila['id_fecha']."</div><div class='marc'>
      <input tabindex='2' maxlength='2' pattern='\d*' type='tel' data-eq='COR' value=''>
      <span>--</span>

      <input tabindex='2' pattern='\d*' maxlength='2' type='tel' data-eq='PSV' value=''></div><div class='vis'>".$fila['id_fecha']."<IMG SRC='img/banderas/psv.png' ></div>
       </li>"; 
}


echo "<li><center>&nbsp;<button class='btn btn-primary'>Simular</button></center></li>";
echo "<li></li>";

	
echo	"<br>";
echo "</ul>";

echo "</div>";



}

//<!--FIN FECHAS-->



echo "</ul>";
echo "</div>";
echo "</div>";
echo "</div>";
//<!-- fin columnas -->
echo "</div>";
//<!-- fin contenido -->
echo "</div>";
//<!-- fin contenedor general -->
echo "</div>";

?> 
	

<body>                          
</body>
</html>