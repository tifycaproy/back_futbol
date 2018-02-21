<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">

<head>

    

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
    </style>
    
    </head>
    <body>

<?php $idUsuario=$_GET['idusurio']; ?>



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


?>


<div class="resultados-tabla">
<?php
$query = "SELECT * FROM simulador_predicciones where idusuario=$idUsuario";
$result = mysql_query($query);

/* array numérico */
if(mysql_num_rows($result)==0){

echo "<div class=\"column\">
    <h5 class=\"haz\">Cargando datos, desliza hacia abajo para refrescar</h5>
  </div>";
  



}else{?>

<div class="column resultados">
    <h5 class="haz">Resultados</h5>
</div>
<ul class="sim-calendario-grupo resultados">
<li><div class="loc res"><img src="img/banderas/paraguay.png">Paraguay</div><div class="marc">
<input name="fecha18-1" tabindex="171" maxlength="2" pattern="\d*" type="number" data-eq="py" value="<?php echo $resultado11; ?>" disabled><span>--</span><input name="fecha18-2" type="number" value="<?php echo $resultado12; ?>" disabled></div><div class="vis res">Venezuela<img src="img/banderas/venezuela.png"></div></li>

<li><div class="loc res"><img src="img/banderas/brasil.png">Brasil</div><div class="marc"><input name="fecha18-3" tabindex="173" maxlength="2" pattern="\d*" type="number" data-eq="br" value="<?php echo $resultado13; ?>" disabled><span>--</span><input name="fecha18-4" tabindex="174" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="<?php echo $resultado14; ?>" disabled></div><div class="vis res">Chile<img src="img/banderas/chile.png"></div></li>

<li><div class="loc res"><img src="img/banderas/ecuador.png">Ecuador</div><div class="marc"><input name="fecha18-5" tabindex="175" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="<?php echo $resultado15;?>" disabled><span>--</span><input name="fecha18-6" tabindex="176" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="<?php echo $resultado16; ?>" disabled></div><div class="vis res">Argentina<img src="img/banderas/argentina.png"></div></li>

<li><div class="loc res"><img src="img/banderas/peru.png">Perú</div><div class="marc"><input name="fecha18-7" tabindex="177" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="<?php echo $resultado17;?>" disabled><span>--</span><input name="fecha18-8" tabindex="178" pattern="\d*" maxlength="2" type="number" data-eq="co" value="<?php echo $resultado18; ?>" disabled></div><div class="vis res">Colombia<img src="img/banderas/colombia.png"></div></li>

<li><div class="loc res"><img src="img/banderas/uruguay.png">Uruguay</div><div class="marc"><input name="fecha18-9" tabindex="179" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="<?php echo $resultado19;?>" disabled><span>--</span><input name="fecha18-10" tabindex="180" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="<?php echo $resultado20;?>" disabled></div><div class="vis res">Bolivia<img src="img/banderas/bolivia.png"></div></li>

</ul>



<?php

//imprime resultados
$row = mysql_fetch_array($result);

?>


<div class="column resultados">
    <h5 class="haz">Tu predicción Fecha </h5>
</div>



<ul class="sim-calendario-grupo resultados">


<li><div class="loc res"><img src="img/banderas/paraguay.png">Paraguay</div><div class="marc"><input name="fecha18-1" tabindex="171" maxlength="2" pattern="\d*" type="number" data-eq="py" value="<?php echo $row['fecha18-1']?>" disabled><span>--</span><input name="fecha18-2" tabindex="172" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="<?php echo $row['fecha18-2']?>" disabled></div><div class="vis res">Venezuela<img src="img/banderas/venezuela.png"></div></li>

<li><div class="loc res"><img src="img/banderas/brasil.png">Brasil</div><div class="marc"><input name="fecha18-3" tabindex="173" maxlength="2" pattern="\d*" type="number" data-eq="br" value="<?php echo $row['fecha18-3']?>" disabled><span>--</span><input name="fecha18-4" tabindex="174" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="<?php echo $row['fecha18-4']?>" disabled></div><div class="vis res">Chile<img src="img/banderas/chile.png"></div></li>

<li><div class="loc res"><img src="img/banderas/ecuador.png">Ecuador</div><div class="marc"><input name="fecha18-5" tabindex="175" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="<?php echo $row['fecha18-5']?>" disabled><span>--</span><input name="fecha18-6" tabindex="176" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="<?php echo $row['fecha18-6']?>" disabled></div><div class="vis res">Argentina<img src="img/banderas/argentina.png"></div></li>

<li><div class="loc res"><img src="img/banderas/peru.png">Perú</div><div class="marc"><input name="fecha18-7" tabindex="177" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="<?php echo $row['fecha18-7']?>" disabled><span>--</span><input name="fecha18-8" tabindex="178" pattern="\d*" maxlength="2" type="number" data-eq="co" value="<?php echo $row['fecha18-8']?>" disabled></div><div class="vis res">Colombia<img src="img/banderas/colombia.png"></div></li>

<li><div class="loc res"><img src="img/banderas/uruguay.png">Uruguay</div><div class="marc"><input name="fecha18-9" tabindex="179" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="<?php echo $row['fecha18-9']?>" disabled><span>--</span><input name="fecha18-10" tabindex="180" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="<?php echo $row['fecha18-10']?>" disabled></div><div class="vis res">Bolivia<img src="img/banderas/bolivia.png"></div></li>

</ul>


<?php

}
 
 
 
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
 
if($row['fecha17-3']!=NULL){
 $prueba1=marcador($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 
$prueba2=    gana($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $prueba3=  empata($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $prueba4=   goles($resultado3, $resultado4, $row['fecha17-3'], $row['fecha17-4']);
 $puntos2=$prueba1+$prueba2+$prueba3+$prueba4;
 }
 if($row['fecha17-1']!=NULL){
 $puntos1=marcador($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+gana($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+empata($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2'])+goles($resultado1, $resultado2, $row['fecha17-1'], $row['fecha17-2']);
 }
 
 if($row['fecha17-5']!=NULL){
 $puntos3=marcador($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+gana($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+empata($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6'])+goles($resultado5, $resultado6, $row['fecha17-5'], $row['fecha17-6']);
 
 }
 if($row['fecha17-7']!=NULL){
 $puntos4=marcador($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+gana($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+empata($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8'])+goles($resultado7, $resultado8, $row['fecha17-7'], $row['fecha17-8']);
 }
 if($row['fecha17-9']!=NULL){
 $puntos5=marcador($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+gana($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+empata($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10'])+goles($resultado9, $resultado10, $row['fecha17-9'], $row['fecha17-10']);
 }
 
  $puntos_fecha_17=$puntos1+$puntos2+$puntos3+$puntos4+$puntos5;

echo "<hr><br><br><span>Puntos Fecha 17: ".$puntos_fecha_17."*</span>";

 
 
 /////fecha 18
 
 if($row['fecha18-3']!=NULL){
 $prueba1=marcador($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 
$prueba2=    gana($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $prueba3=  empata($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $prueba4=   goles($resultado13, $resultado14, $row['fecha18-3'], $row['fecha18-4']);
 $puntos12=$prueba1+$prueba2+$prueba3+$prueba4;
 }
 if($row['fecha18-1']!=NULL){
 $puntos11=marcador($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+gana($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+empata($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2'])+goles($resultado11, $resultado12, $row['fecha18-1'], $row['fecha18-2']);
 }
 
 if($row['fecha18-5']!=NULL){
 $puntos13=marcador($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+gana($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+empata($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6'])+goles($resultado15, $resultado16, $row['fecha18-5'], $row['fecha18-6']);
 
 }
 if($row['fecha18-7']!=NULL){
 $puntos14=marcador($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+gana($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+empata($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8'])+goles($resultado17, $resultado18, $row['fecha18-7'], $row['fecha18-8']);
 }
 if($row['fecha18-9']!=NULL){
 $puntos15=marcador($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+gana($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+empata($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10'])+goles($resultado19, $resultado20, $row['fecha18-9'], $row['fecha18-10']);
 }
 
   $puntos_fecha_18=$puntos11+$puntos12+$puntos13+$puntos14+$puntos15;
 


 ?>
 
  <div class="column resultados">
    <h5 class="haz">Puntos Fecha 18:</h5>
</div>
<ul class="sim-calendario-grupo resultados">
<li >Paraguay vs Venezuela = <?php echo $puntos11 ?></li>
<li >Brasil vs Chile =<?php echo $puntos12 ?></li>
<li >Ecuador vs Argentina =<?php echo $puntos13 ?></li>
<li >Perú vs Colombia =<?php echo $puntos14 ?></li>
<li >Uruguay vs Bolivia = <?php echo $puntos15 ?></li>
<li >Total = <?php echo $puntos_fecha_18 ?>*</li>
<li ><span class="chiquito">Puntos sujetos a verificación!</span></li>
</ul>


 
</div>
</body>
</html>
<?php

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