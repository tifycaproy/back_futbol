<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 

<title>Simulador</title>

<link href="css/color.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<style type="text/css">
body,td,th {
	font-family: 'Oswald';
}
</style>

	</head>
	
<?php  
$mostrar_errores=0;

if($mostrar_errores){
error_reporting(E_ALL);
ini_set("display_errors", 1);
}
//tomamos los datos del archivo conexion.php  
include("conexion.php");  
$link = Conectarse();  
//mysql_set_charset('utf8', $link);
mysqli_set_charset($link, "utf8");


//se despliega el resultado  
echo "<div class='header'>";

echo "<div class=\"abrir\">
       <a href=\"#\" class=\"test\">Click para simular</a>
      </div>";
      
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
	


$query_equipos="SELECT distinct(local) FROM simulador_fechas WHERE 1 order by local asc";
//se envia la consulta  
$result = mysqli_query($link, $query_equipos);  
//marcadores
$ordenamiento_js='';

$flag_contador=1;
while ($row =mysqli_fetch_array($result, MYSQLI_ASSOC)){ 

if($flag_contador!=1){
$ordenamiento_js.=',';
}

$ordenamiento_js.=equipo_nombre($row['local']).": {pts: 0, pj: 0, pg: 0, pe: 0, pp: 0, gf: 0, gc: 0}";
						
    echo "<tr data-eq='".equipo_nombre($row['local'])."'>";
	
	echo "<td>".$flag_contador."</td>";  

	echo "<td>&nbsp;".equipo_bandera($row['local'])."<span class=\"nombre_e\">".equipo_nombre($row['local'])."</span></td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  
    echo "<td>0</td>";  

	echo "</tr>";  
	
	$flag_contador+=1;
}

echo "</table>";  
	
	echo "</div>";
	echo "</div>";
	

	





//<!-- Contenedor general-->
echo "<div id='inner-wrap'class=\"showme\" >";


echo "<div class=\"cerrar\">
        <a href=\"#\" class=\"test2\">Click para cerrar</a>
      </div>";

//<!-- Contenido-->
echo "<div id='especiales-contenedor-principal'>";






//<!-- Contenedor columnas -->
echo "<div id='contenedor-columnas'>";


//<!-- Box central > Intro florida_cup -->

echo "<div class='box-central'>";




echo "<div class='contenedor-simulador-movil'>";

$query_config="SELECT * FROM simulador_config WHERE 1";
//se envia la consulta  
$result_config = mysqli_query($link, $query_config);  
//marcadores

$row_config =mysqli_fetch_array($result_config, MYSQLI_ASSOC);




echo "<div class='contenedor-simulador-movil-inside' data-pos='".$row_config['fecha_activa']."'>";


echo "<ul class='nav-fechas-calendario'>
    <span class='titulo-nav-box-central' data-top='top'>Selecciona una fecha</span>
    <li data-ancla='1'>1</li><li data-ancla='2'>2</li><li data-ancla='3'>3</li><li data-ancla='4'>4</li><li data-ancla='5'>5</li><li data-ancla='6'>6</li>
</ul>";




//<!--FECHAS while-->

$feca = mysqli_query($link,"SELECT distinct(id_fecha) FROM simulador_fechas");


while($fila = mysqli_fetch_array($feca, MYSQLI_ASSOC)){
 $query="SELECT * FROM simulador_fechas where id_fecha=".$fila['id_fecha'];
 $feca2 = mysqli_query($link,$query);	




 
echo "<div class='box-simulador-general'>";

echo "<h4 class='calendario-fecha' data-anclado='".$fila['id_fecha']."'>";
if($fila['id_fecha']!=1){
echo "<a href='#' class='izq' ></a>";
}


echo "Fecha ".$fila['id_fecha']."";

if($fila['id_fecha']!=19){
echo "<a href='#' class='der'></a></h4>";
}

echo "<ul class='sim-calendario-grupo'>";
	
	
while($fila2 = mysqli_fetch_array($feca2, MYSQLI_ASSOC)){


$disabled_v='';
$disabled_l='';
if($fila2['marcador_l']!=NULL){
$disabled_l='disabled';
}

if($fila2['marcador_v']!=NULL){

$disabled_v='disabled';
}

      echo "<li>
      <div class='loc'>
      ".equipo_bandera($fila2['local'])." ".equipo_nombre($fila2['local'])."</div><div class='marc'>
      <input tabindex='1' maxlength='2' pattern='\d*' type='tel' data-eq='".equipo_nombre($fila2['local'])."' value='".$fila2['marcador_l']."' ".$disabled_l.">
      <span>--</span>

      <input tabindex='2' pattern='\d*' maxlength='2' type='tel' data-eq='".equipo_nombre($fila2['visitante'])."' value='".$fila2['marcador_v']."' ".$disabled_v."></div>
      <div class='vis'>".equipo_nombre($fila2['visitante'])." ".equipo_bandera($fila2['visitante'])."</div>
       </li>"; 
}


echo "<li><center>&nbsp;<button class='btn btn-primary test2'>Simular</button></center></li>";
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


function equipo_nombre($id){
$link2 = Conectarse();  
//mysql_set_charset('utf8', $link);
mysqli_set_charset($link2, "utf8");

$query_f="select nombre from equipos where id=".$id."";

$feca = mysqli_query($link2, $query_f);

$fila = mysqli_fetch_array($feca, MYSQLI_ASSOC);
return $fila['nombre'];

mysqli_close($link2);

}

function equipo_bandera($id){
$link3 = Conectarse();  
//mysql_set_charset('utf8', $link);
mysqli_set_charset($link3, "utf8");


$query_f="select bandera from equipos where id=".$id."";

$feca = mysqli_query($link3,$query_f);

$fila = mysqli_fetch_array($feca, MYSQLI_ASSOC);

return "<img src=\"http://cmsmillos.s3-website-us-east-1.amazonaws.com/equipos/".$fila['bandera']."\" valing=\"top\" width=\"25px\">";

mysqli_close($link3);

}



?> 
	

<body>                          
</body>
</html>

<script>

// Scroll

function animaScroll(destino){

  $("html,body").animate({
    scrollTop: destino
  }, 700, "swing");

}

$(document).ready(function() {

// MenÃº

$("div.especiales-header-boton").on("click", function(){ $("body").toggleClass("menu-on"); })

$("#menu-especial").on("click", function(e){ if (e.target.id === "menu-especial") { $("body").toggleClass("menu-on"); } });

// Scroll calendario

$("[data-top='subir']").on("click", function(e){
  
  e.preventDefault();
  animaScroll($("[data-top='top']").offset().top);

});

// Fix tabla

var tabla = $("#posiciones-simulador");

$(window).on("scroll", function(){

  var wndw = $(this);

  if (wndw.scrollTop() > 190) { tabla.addClass("tabla-fixed"); } else { tabla.removeClass("tabla-fixed") }

});

// Slide Tabla

$("a.ver-tabla-sim").on("click", function(e){

e.preventDefault();
tabla.toggleClass("tabla-slide-up");

});

// Ancla

var curr = 0,
    box = $("div.contenedor-simulador-movil-inside");

$("[data-ancla]").on("click", function(e){

e.preventDefault();

  var ancho = $(window).outerWidth(),
      el = $(this),
      n = el.attr("data-ancla");
      curr = n;

      el.parent().parent().attr("data-pos", n);

  if ( ancho>709 ) { var d = $("[data-anclado='"+n+"']").offset().top;  animaScroll(d); }

});

// Nav sim

$("h4.calendario-fecha a").on("click", function(e){

    e.preventDefault();
    var el = $(this),
        dir = el.attr("class");

    if (dir === "") { return }

    curr = parseInt(el.parent().attr("data-anclado"));

    if (dir === "izq") { curr=curr-1; box.attr("data-pos",curr) }
    if (dir === "der") { curr=curr+1; box.attr("data-pos",curr) }

})

$("div.contenedor-simulador-movil").on("scroll", function(){

$("div.contenedor-simulador-movil").scrollLeft("100%");

})

$("input[data-eq]").on("keydown", function(e){

var el = $(this),
    elInd = el.index(),
    ind = el.parent().parent().index(),
    ancho = $(window).outerWidth();


if (e.keyCode == 9 && ind === 4 && elInd === 2 ) {

    e.preventDefault();
    curr = parseInt(curr)+1;
    box.attr("data-pos", curr);

    var del = 0;
    if (ancho>709) { del = 0 }

    setTimeout(function(){ $("h4[data-anclado='"+curr+"']").siblings("ul.sim-calendario-grupo").find("input").eq(0).focus(); }, del);
    return

 }

if (e.keyCode == 9 && e.shiftKey && ind === 0 && elInd === 0 ) {

    e.preventDefault();
    curr = parseInt(curr)-1;
    box.attr("data-pos", curr);

    var del = 0;
    if (ancho>709) { del = 0 }

    setTimeout(function(){ $("h4[data-anclado='"+curr+"']").siblings("ul.sim-calendario-grupo").find("input").eq(0).focus(); }, del);
}
});

// Simulador

var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

// Load

var res = Base64.decode(window.location.hash.replace("#!","")).replace("r=", "");

if (res.length > 40) {

  var partidos = $("ul.sim-calendario-grupo li");

  $.each(res.split("/"), function(i, v){

    var marc = partidos.eq(i).children("div.marc"),
        gL = parseInt(v.split("-")[0]),
        gV = parseInt(v.split("-")[1]);

    if (isNaN(gL) || isNaN(gV)) { return }

    marc.children("input").eq(0).val(gL);
    marc.children("input").eq(1).val(gV);

  });

  ordenaTabla();

  window.location.hash = ""

 }

else {
  ordenaTabla();
}

// Inputs

$("input[data-eq]").on("focus", function(){  curr = parseInt($(this).parent().parent().parent().siblings("h4").attr("data-anclado")); });

$("input[data-eq]").on("change", function(){

  var el = $(this),
      tmp = parseInt(el.val().toString().slice(0,2));

      el.val(tmp);

  var v = el.val();

  if (isNaN(v) || v === null) { el.val("") }
  if (v < 0 ) { el.val(Math.abs(v)) }

  var riv = el.siblings("input").val();

  if (isNaN(riv)) { return false }
  if (isNaN(el) && isNaN(riv)) { ordenaTabla(); }
  else { ordenaTabla(); }

});

function ordenaTabla(){

 var tabla = {
 
        
        <?php 
        echo $ordenamiento_js;
        
        ?>
  }

  $("input[data-eq]").each(function(){

    var e = $(this).attr("data-eq"),
        goles = parseInt($(this).val()),
        golesRival = parseInt($(this).siblings("input").eq(0).val());

    if (goles > golesRival) {

      tabla[e].pts = tabla[e].pts + 3;
      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pg = tabla[e].pg + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

    if (goles === golesRival) {
      
      tabla[e].pts = tabla[e].pts + 1;
      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pe = tabla[e].pe + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

    if (goles < golesRival) {

      tabla[e].pj = tabla[e].pj + 1;
      tabla[e].pp = tabla[e].pp + 1;
      tabla[e].gf = tabla[e].gf + goles;
      tabla[e].gc = tabla[e].gc + golesRival;
    }

  var tr = $("tr[data-eq='"+e+"'] td");


  tr.eq(2).empty().text(tabla[e].pts);
  tr.eq(3).empty().text(tabla[e].pj);
  tr.eq(4).empty().text(tabla[e].pg);
  tr.eq(5).empty().text(tabla[e].pe);
  tr.eq(6).empty().text(tabla[e].pp);
  tr.eq(7).empty().text(tabla[e].gf);
  tr.eq(8).empty().text(tabla[e].gc);
  tr.eq(9).empty().text(tabla[e].gf - tabla[e].gc);

  });

  reordenar(7);
  reordenar(9);
  reordenar(2);

  // Posiciones

  $("#tabla-posiciones-simulador tr").each(function(v){ $(this).children("td").eq(0).text((v))})

}

function reordenar(cifra){

    var tbl = document.getElementById("tabla-posiciones-simulador").tBodies[0];
    var store = [];
    for(var i=0, len=tbl.rows.length; i<len; i++){
        var row = tbl.rows[i];
        var sortnr = parseFloat(row.cells[cifra].textContent || row.cells[cifra].innerText);
        if(!isNaN(sortnr)) store.push([sortnr, row]);
    }
    store.sort(function(x,y){
        return y[0] - x[0];
    });
    for(var i=0, len=store.length; i<len; i++){
        tbl.appendChild(store[i][1]);
    }
    store = null;
}

// Genera link para compartir

function generaLink(){

var hash = "r=";

$("ul.sim-calendario-grupo li").each(function(){

var el = $(this).children("div.marc"),
    inp = el.children("input"),
    loc = inp.eq(0).val().toString(),
    vis = inp.eq(1).val().toString();

hash = hash + loc + "-" + vis + "/"

})

return Base64.encode(hash);

}



});
$(document).ready(function(){
    $(".test").click(function(){
        $(".showme").show();
       $("#divsthatIwanttohide").hide();

    });

});
$(document).ready(function(){
    $(".test2").click(function(){
        $(".showme").hide();
       $("#divsthatIwanttohide").hide();

    });

});
</script>