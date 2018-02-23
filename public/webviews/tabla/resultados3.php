<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">

<head>

    

   <link href="css/especial.css" rel="stylesheet" type="text/css">
    <link href="css/simulador.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <style>
    
    .column{
    padding-top: 20px
    
    }</style>
    
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








?>



<div class="resultados-tabla">
<?php
$query = "SELECT * FROM simulador_predicciones where idusuario=$idUsuario";
$result = mysql_query($query);

/* array numérico */
if(mysql_num_rows($result)==0){

echo "<div class=\"column\">
    <h5 class=\"haz\">Cargando datos... Jala para refrescar!</h5>
  </div>";
  



}else{
echo "<div class=\"column\">
    <h5 class=\"haz\">Espera los resultados de los partidos!</h5>

    
    
  </div><hr>";


//imprime resultados
$row = mysql_fetch_array($result);

?>


<div class="column">
    <h5 class="haz">Tu Prediccion!</h5>
<?php  
/*
echo "<pre>";
print_r($_GET);

echo "</pre>";
*/
?>
    
    
  </div>
<ul class="sim-calendario-grupo">
<li><div class="loc res"><img src="img/banderas/colombia.png">Colombia</div><div class="marc"><input name="fecha17-1" tabindex="161" maxlength="2" pattern="\d*" type="number" data-eq="co" value="<?php echo $row['fecha17-1']?>" disabled><span>-</span><input name="fecha17-2" tabindex="162" pattern="\d*" maxlength="2" type="number" data-eq="py" value="<?php echo $row['fecha17-2']?>" disabled></div><div class="vis res">Paraguay<img src="img/banderas/paraguay.png"></div></li>

<li><div class="loc res"><img src="img/banderas/chile.png">Chile</div><div class="marc"><input name="fecha17-3" tabindex="163" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="<?php echo $row['fecha17-3']?>" disabled><span>-</span><input name="fecha17-4" tabindex="164" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="<?php echo $row['fecha17-4']?>" disabled></div><div class="vis res">Ecuador<img src="img/banderas/ecuador.png"></div></li>

<li><div class="loc res"><img src="img/banderas/argentina.png">Argentina</div><div class="marc"><input name="fecha17-5" tabindex="165" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="<?php echo $row['fecha17-5']?>" disabled><span>-</span><input name="fecha17-6" tabindex="166" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="<?php echo $row['fecha17-6']?>" disabled></div><div class="vis res">Perú<img src="img/banderas/peru.png"></div></li>

<li><div class="loc res"><img src="img/banderas/venezuela.png">Venezuela</div><div class="marc"><input name="fecha17-7" tabindex="167" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="<?php echo $row['fecha17-7']?>" disabled><span>-</span><input name="fecha17-8" tabindex="168" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="<?php echo $row['fecha17-8']?>" disabled></div><div class="vis res">Uruguay<img src="img/banderas/uruguay.png"></div></li>

<li><div class="loc res"><img src="img/banderas/bolivia.png">Bolivia</div><div class="marc"><input name="fecha17-9" tabindex="169" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="<?php echo $row['fecha17-9']?>" disabled><span>-</span><input name="fecha17-10" tabindex="170" pattern="\d*" maxlength="2" type="number" data-eq="br" value="<?php echo $row['fecha17-10']?>" disabled></div><div class="vis res">Brasil<img src="img/banderas/brasil.png"></div></li>


</ul>

<?php

}
 ?>
 
</div>
</body>
</html>