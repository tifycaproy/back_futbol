<?php
$DB_SERVER = "awsfcf2waysports.co6n6hotu5cp.us-east-1.rds.amazonaws.com";
$DB_USER = "admin";
$DB_PASSWORD = "Shok7788!";
$DB = "fcf2ways_api";




$link=mysql_connect($DB_SERVER, $DB_USER, $DB_PASSWORD) or die(mysql_error());
mysql_select_db($DB) or die(mysql_error());

$resultado1=1;
$resultado2=2;
$resultado3=2;
$resultado4=1;
$resultado5=0;
$resultado6=0;
$resultado7=0;
$resultado8=0;
$resultado9=0;
$resultado10=0;


$resultado11=0;
$resultado12=1;
$resultado13=3;
$resultado14=0;
$resultado15=1;
$resultado16=3;
$resultado17=1;
$resultado18=1;
$resultado19=3;
$resultado20=1;


$query = "SELECT * FROM simulador_predicciones ";
$result = mysql_query($query);
$flag=0;

while($row = mysql_fetch_array($result)){


 $row['fecha17-1'];
 $row['fecha17-2'];
 $row['fecha17-3'];
 $row['fecha17-4'];
 $row['fecha17-5'];
 $row['fecha17-6'];
 $row['fecha17-7'];
 $row['fecha17-8'];
 $row['fecha17-9'];
 $row['fecha17-10'];
 $resultado1;
 $resultado2;
 $resultado3;
 $resultado4;
 $resultado5;
 $resultado6;
 $resultado7;
 $resultado8;
 $resultado9;
 $resultado10;
 
 
 
 $puntos1=0;
 $puntos2=0;
 $puntos3=0; 
 $puntos4=0;
 $puntos5=0;
 $puntos6=0;
 $puntos7=0;
 $puntos8=0; 
 $puntos9=0;
 $puntos10=0;
 
if($row['fecha17-3']!=''){
 $prueba1=marcador($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 
$prueba2=    gana($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $prueba3=  empata($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $prueba4=   goles($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $puntos2=$prueba1+$prueba2+$prueba3+$prueba4;
 }else{
 
 $puntos2=0;
 }
 if($row['fecha17-1']!=''){
 $puntos1=marcador($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+gana($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+empata($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+goles($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2']);
 }else{
 
 $puntos1=0;
 }
 
 if($row['fecha17-5']!=''){
 $puntos3=marcador($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+gana($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+empata($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+goles($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6']);
 
 }else{
 
 $puntos3=0;
 }
 if($row['fecha17-7']!=''){
 $puntos4=marcador($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+gana($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+empata($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+goles($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8']);
 }else{
 
 $puntos4=0;
 }
 if($row['fecha17-9']!=''){
 $puntos5=marcador($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+gana($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+empata($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+goles($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10']);
 }else{
 
 $puntos5=0;
 }
 
  $puntos_fecha_17=$puntos1+$puntos2+$puntos3+$puntos4+$puntos5;



 
 
 /////fecha 18
 
 
 if($row['fecha18-3']!=''){
 $prueba1=marcador($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 
$prueba2=    gana($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $prueba3=  empata($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $prueba4=   goles($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $puntos12=$prueba1+$prueba2+$prueba3+$prueba4;
 }else{
 
 $puntos12=0;
 }
 if($row['fecha18-1']!=''){
 $puntos11=marcador($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+gana($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+empata($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+goles($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2']);
 }else{
 
 $puntos11=0;
 }
 
 if($row['fecha18-5']!=''){
 $puntos13=marcador($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+gana($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+empata($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+goles($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6']);
 
 }else{
 
 $puntos13=0;
 }
 
 
 if($row['fecha18-7']!=''){
 $puntos14=marcador($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+gana($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+empata($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+goles($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8']);
 }else{
 
 $puntos14=0;
 }
 
 
 if($row['fecha18-9']!=''){
 $puntos15=marcador($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+gana($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+empata($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+goles($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10']);
 }else{
 $puntos15=0;
 }
 
   $puntos_fecha_18=$puntos11+$puntos12+$puntos13+$puntos14+$puntos15;
 
$idUsuario=$row['idusuario'];
$puntos_totales=$puntos_fecha_17+$puntos_fecha_18;
$sql_update="
UPDATE simulador_predicciones
SET 
`ranking1`=".$puntos_fecha_17.",
`ranking2`=".$puntos_fecha_18.",
`ranking3`=".$puntos_totales."
 WHERE idUsuario=".$idUsuario." ";


$result21 = mysql_query($sql_update);

 $flag+=1;
 
 /*
 echo $flag."-".$row['fecha18-3']."<br>";
 if($flag==15){
 exit;
  } */
}
echo $flag;



function marcador($val1,$val2, $val3,$val4){
 
 if($val1==$val3 && $val2==$val4){
 $puntos=3;
 }else{
  $puntos=0;
 }

 return $puntos;
 }
 
 
 
 
 
 function gana($val1,$val2, $val3,$val4){
 
 if($val1<$val2){
 if($val3<$val4){
 $puntos=1;
 }else{ $puntos=0;}
 }elseif($val1>$val2){
 if($val3>$val4){
 $puntos=1;
 }else{ $puntos=0;}
 }else{

 $puntos=0;
 }
 return $puntos;
 }
 
 
 
 
 
 function empata($val1,$val2, $val3,$val4){
 
 if($val1==$val2 && $val3==$val4){
 
 $puntos=1;
 }else{
 
 $puntos=0;
 }
  return $puntos;
 }
 
 
 
 
 
 function goles($val1,$val2, $val3,$val4){
 
$puntos=0;

if($val1==$val3){
$puntos1n=2;
}else{
$puntos1n=0;
}

if($val2==$val4){
$puntos2n=2;
}else{
$puntos2n=0;
}

$puntos=$puntos1n+$puntos2n;

  return $puntos;
 }
 
?>