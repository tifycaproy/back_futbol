<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">

<head>

    <meta charset="utf-8"/>

   <link href="css/especial.css" rel="stylesheet" type="text/css">
    <link href="css/simulador.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <style>
    
    .column{
    padding-top: 20px
    
    }
    
.chiquito {
	font-size: 10px;
	text-transform: none;
}
.blanco {
	color: #fff;
}
.negro {
	color: #000;
}
    </style>
    
    </head>
    <body>

<?php $idUsuario=$_GET['idusurio']; ?>



<?php
$DB_SERVER = "awsfcf2waysports.co6n6hotu5cp.us-east-1.rds.amazonaws.com";
$DB_USER = "admin";
$DB_PASSWORD = "Shok7788!";
$DB = "fcf2ways_api";


mysql_query("SET NAMES 'utf8'");



mysql_query("SET CHARACTER SET utf8 ");


$link=mysql_connect($DB_SERVER, $DB_USER, $DB_PASSWORD) or die(mysql_error());
mysql_select_db($DB) or die(mysql_error());


?>


<div class="resultados-tabla">
<?php
$query = "SELECT * FROM simulador_predicciones where idusuario=$idUsuario";
$result = mysql_query($query);

/* array numérico */

echo "<div class=\"column\">
    <h5 class=\"haz\">Tus resultados</h5>
  </div>";
  
if(mysql_num_rows($result)==0){

echo "<div class=\"column\">
    <h5 class=\"haz\">No Participaste :(</h5>
  </div>";
  



}else{?>


<?php

//imprime resultados
$row = mysql_fetch_array($result);

echo "<h5>
Fecha 17: ".$row['ranking1']."<br>
Fecha 18: ".$row['ranking2']."<br>
Total: ".$row['ranking3']."
</h5>";
}

echo "<div class=\"column\">
    <h5 class=\"haz\">Ranking</h5>
  </div>";


$query = "select distinct(a.idusuario), b.nombre, b.apellido,b.email,b.celular, a.idusuario, a.tiempo1, a.tiempo2, a.ranking1, a.ranking2, a.ranking3 from 
simulador_predicciones as a, usuarios as b WHERE a.idusuario=b.idusuario ORDER BY a.ranking3 DESC limit 0, 10";
$result = mysql_query($query);
echo "<table border=0 cellspacing=0 cellpadding=0>";
echo "<tr><td>Nombre</td><td>Puntos</td></td>";
while($row = mysql_fetch_array($result)){


if($row['idusuario']==$idUsuario){
echo "<tr bgcolor=\"#008124\"><td><span class=\"blanco\">Felicitaciones: ".utf8_encode($row['nombre'])." ".utf8_encode($row['apellido'])."</span></td><td><span class=\"blanco\">".$row['ranking3']."</span></td></td>";
}else{

echo "<tr bgcolor=\"#ccc\"><td><span class=\"negro\">".utf8_encode($row['nombre'])." ".utf8_encode($row['apellido'])." </span></td><td><span class=\"negro\">".$row['ranking3']."</span></td></td>";
}


}echo "</ul>";
?>




 
 

 
</div>
</body>
</html>
