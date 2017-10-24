<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> <html xmlns:fb="http://ogp.me/ns/fb#">

<head>

    
<style>
.text-center{
text-align:center;

}
/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 40px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}
.modal-content > img {
	width: 100%;
	z-index: 99999999999;
	height: 100%;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 95%;
  max-width: 1200px;
}

/* The Close Button */
.close {
	color: white;
	position: absolute;
	top: 0px;
	right: 25px;
	font-size: 40px;
	font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
</style>
    
    
    <link href="css/especial.css" rel="stylesheet" type="text/css">
    <link href="css/simulador.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="jquery/jquery-min.js"></script>
 
<meta charset="utf-8">
</head>
<body>

  <div class="header">
<div class="box-columna" id="clasificacion">
<table border="0" cellpadding="0" cellspacing="0" class="tabla-posiciones" id="tabla-posiciones-simulador">
<thead>
  <tr>
    <th>&nbsp;</th>
    <th>Equipos</th>    
    <th>PJ</th>
    <th>PG</th>
    <th>PE</th>
    <th>PP</th>
    <th>GF</th>
    <th>GC</th>
    <th>GD</th>
    <th>PTS</th>
  </tr>
</thead>
<tbody>
  <tr data-eq="ar">
    <td>1</td>
    <td><img src="img/banderas/guayaquil.png" />GUAYAQUIL CITY</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="bo">
    <td>2</td>
    <td><img src="img/banderas/clan.png" />CLAN JUVENIL</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="br">
    <td>3</td>
    <td><img src="img/banderas/emelec.png" />EMELEC</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="cl">
    <td>4</td>
    <td><img src="img/banderas/nacional.png" />NACIONAL</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="co">
    <td>5</td>
    <td><img src="img/banderas/macara.png"/>MACARA</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="ec">
    <td>6</td>
    <td><img src="img/banderas/fuerza.png" />FUERZA AMARILLA</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="py">
    <td></td>
    <td><img src="img/banderas/barcelona.png" />BARCELONA S.C.</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="pe">
    <td>8</td>
    <td><img src="img/banderas/l.d.u.png" />L.D.U (Q)</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="uy">
    <td>9</td>
    <td><img src="img/banderas/independiente.png"  />INDEPENDIENTE</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
  <tr data-eq="ve">
    <td>10</td>
    <td><img src="img/banderas/ucatolica.png" />U. CATOLICA</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
    <tr data-eq="ve">
    <td>10</td>
    <td><img src="img/banderas/delfin.png" />DELFIN</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
    <tr data-eq="ve">
    <td>10</td>
    <td><img src="img/banderas/cuenta.png" />DEP. CUENCA</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
    <td>-</td>
  </tr>
</tbody>
</table>


<!-- Contenedor general-->
<div id="inner-wrap">

<!-- Contenido-->
<div id="especiales-contenedor-principal">


<!-- Contenedor columnas -->
<div id="contenedor-columnas">


<!-- Box central > Intro equipos -->

<div class="box-central">

<div class="contenedor-simulador-movil">

<div class="contenedor-simulador-movil-inside" data-pos="18">


<ul class="nav-fechas-calendario">
    <span class="titulo-nav-box-central" data-top="top">Selecciona una fecha</span>
    <li data-ancla="1">1</li><li data-ancla="2">2</li>
    <li data-ancla="3">3</li><li data-ancla="4">4</li>
    <li data-ancla="5">5</li><li data-ancla="6">6</li>
    <li data-ancla="7">7</li><li data-ancla="8">8</li>
    <li data-ancla="9">9</li><li data-ancla="10">10</li>
    <li data-ancla="11">11</li><li data-ancla="12">12</li>
    <li data-ancla="13">13</li><li data-ancla="14">14</li>
    <li data-ancla="15">15</li><li data-ancla="16">16</li>
    <li data-ancla="17">17</li><li data-ancla="18">18</li>
    <li data-ancla="19">19</li><li data-ancla="20">20</li>
    <li data-ancla="21">21</li><li data-ancla="22">22</li>
</ul>



<!--1 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="1">Fecha 1<a href="#" class="der"></a></h4>
<div class="lafecha-info">8 de octubre de 2015</div>
<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="1" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="2" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="0" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="1" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="2" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="0" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="3" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="0" disabled><span>--</span><input tabindex="4" pattern="\d*" maxlength="2" type="number" data-eq="py" value="1" disabled></div><div class="vis">L.D.U (Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="5" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="0" disabled><span>--</span><input tabindex="6" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="7" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="0" disabled><span>--</span><input tabindex="8" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="9" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="2" disabled><span>--</span><input tabindex="10" pattern="\d*" maxlength="2" type="number" data-eq="br" value="0" disabled></div><div class="vis">BARCELONA S.C<img src="img/banderas/barcelona.png"></div></li>

</ul>

</div>



<!--SEGUNDA FECHA-->

<div class="box-simulador-general">
<h4 class="calendario-fecha" data-anclado="2"><a href="#" class="izq"></a>Fecha 2<a href="#" class="der"></a></h4>
<div class="lafecha-info">13 de octubre de 2015</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="11" maxlength="2" pattern="\d*" type="number" data-eq="py" value="0" disabled><span>--</span><input tabindex="12" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="0" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="11" maxlength="2" pattern="\d*" type="number" data-eq="py" value="0" disabled><span>--</span><input tabindex="12" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="0" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="13" maxlength="2" pattern="\d*" type="number" data-eq="br" value="3" disabled><span>--</span><input tabindex="14" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="1" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="15" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="16" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="17" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="3" disabled><span>--</span><input tabindex="18" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="4" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U (Q)</div><div class="marc"><input tabindex="19" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="3" disabled><span>--</span><input tabindex="20" pattern="\d*" maxlength="2" type="number" data-eq="co" value="0" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

</ul>

</div>


<!--TERCERA FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="3"><a href="#" class="izq"></a>Fecha 3<a href="#" class="der"></a></h4>
<div class="lafecha-info">9 de noviembre de 2015</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="19" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="3" disabled><span>--</span><input tabindex="20" pattern="\d*" maxlength="2" type="number" data-eq="co" value="0" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="21" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="22" pattern="\d*" maxlength="2" type="number" data-eq="co" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="23" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="1" disabled><span>--</span><input tabindex="24" pattern="\d*" maxlength="2" type="number" data-eq="br" value="1" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="25" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="26" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="1" disabled></div><div class="vis">L.D.U (Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="27" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="4" disabled><span>--</span><input tabindex="28" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="29" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="1" disabled><span>--</span><input tabindex="30" pattern="\d*" maxlength="2" type="number" data-eq="py" value="0" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

</ul>

</div>


<!--CUARTA FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="4"><a href="#" class="izq"></a>Fecha 4<a href="#" class="der"></a></h4>
<div class="lafecha-info">17 de noviembre de 2015</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="31" maxlength="2" pattern="\d*" type="number" data-eq="co" value="0" disabled><span>--</span><input tabindex="32" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="1" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="31" maxlength="2" pattern="\d*" type="number" data-eq="co" value="0" disabled><span>--</span><input tabindex="32" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="1" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="33" maxlength="2" pattern="\d*" type="number" data-eq="py" value="2" disabled><span>--</span><input tabindex="34" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="1" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="35" maxlength="2" pattern="\d*" type="number" data-eq="br" value="3" disabled><span>--</span><input tabindex="36" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="0" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="37" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="1" disabled><span>--</span><input tabindex="38" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="3" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U (Q)</div><div class="marc"><input tabindex="39" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="3" disabled><span>--</span><input tabindex="40" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

</ul>

</div>


<!--5 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="5"><a href="#" class="izq"></a>Fecha 5<a href="#" class="der"></a></h4>
<div class="lafecha-info">24/25 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="43" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2"  disabled><span>--</span><input tabindex="44" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2"  disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="45" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="46" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U (Q)</div><div class="marc"><input tabindex="47" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="48" pattern="\d*" maxlength="2" type="number" data-eq="co" value="3" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="49" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2"  disabled><span>--</span><input tabindex="50" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2"  disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

</ul>

</div>



<!--6 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="6"><a href="#" class="izq"></a>Fecha 6<a href="#" class="der"></a></h4>
<div class="lafecha-info">29 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="51" maxlength="2" pattern="\d*" type="number" data-eq="co" value="3" disabled><span>--</span><input tabindex="52" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="51" maxlength="2" pattern="\d*" type="number" data-eq="co" value="3" disabled><span>--</span><input tabindex="52" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="53" maxlength="2" pattern="\d*" type="number" data-eq="py" value="2" disabled><span>--</span><input tabindex="54" pattern="\d*" maxlength="2" type="number" data-eq="br" value="2" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="55" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="2" disabled><span>--</span><input tabindex="56" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="57" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="1" disabled><span>--</span><input tabindex="58" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="4" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="59" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="1" disabled><span>--</span><input tabindex="60" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="0" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

</ul>

</div>



<!--7 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="7"><a href="#" class="izq"></a>Fecha 7<a href="#" class="der"></a></h4>
<div class="lafecha-info">1 de septiembre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="61" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="62" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="0" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="61" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="62" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="0" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="63" maxlength="2" pattern="\d*" type="number" data-eq="py" value="2" disabled><span>--</span><input tabindex="64" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="65" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="1" disabled><span>--</span><input tabindex="66" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="0" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="67" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="0" disabled><span>--</span><input tabindex="68" pattern="\d*" maxlength="2" type="number" data-eq="br" value="3" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="69" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="0" disabled><span>--</span><input tabindex="70" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="3" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

</ul>

</div>



<!--8 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="8"><a href="#" class="izq"></a>Fecha 8<a href="#" class="der"></a></h4>
<div class="lafecha-info">6 de septiembre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="71" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="3" disabled><span>--</span><input tabindex="72" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="71" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="3" disabled><span>--</span><input tabindex="72" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="73" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="2" disabled><span>--</span><input tabindex="74" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="75" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2" disabled><span>--</span><input tabindex="76" pattern="\d*" maxlength="2" type="number" data-eq="co" value="1" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="77" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="78" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C</div><div class="marc"><input tabindex="79" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="4" disabled><span>--</span><input tabindex="80" pattern="\d*" maxlength="2" type="number" data-eq="py" value="0" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

</ul>

</div>



<!--9 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="9"><a href="#" class="izq"></a>Fecha 9<a href="#" class="der"></a></h4>
<div class="lafecha-info">6 de octubre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="81" maxlength="2" pattern="\d*" type="number" data-eq="py" value="0" disabled><span>--</span><input tabindex="82" pattern="\d*" maxlength="2" type="number" data-eq="co" value="1" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="81" maxlength="2" pattern="\d*" type="number" data-eq="py" value="0" disabled><span>--</span><input tabindex="82" pattern="\d*" maxlength="2" type="number" data-eq="co" value="1" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="83" maxlength="2" pattern="\d*" type="number" data-eq="br" value="5" disabled><span>--</span><input tabindex="84" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="85" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="3" disabled><span>--</span><input tabindex="86" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="87" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="88" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="89" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="3" disabled><span>--</span><input tabindex="90" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="0" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

</ul>

</div>



<!--10 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="10"><a href="#" class="izq"></a>Fecha 10<a href="#" class="der"></a></h4>
<div class="lafecha-info">11 de octubre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="91" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="92" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="91" maxlength="2" pattern="\d*" type="number" data-eq="co" value="2" disabled><span>--</span><input tabindex="92" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="93" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="0" disabled><span>--</span><input tabindex="94" pattern="\d*" maxlength="2" type="number" data-eq="py" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="95" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="0" disabled><span>--</span><input tabindex="96" pattern="\d*" maxlength="2" type="number" data-eq="br" value="2" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="97" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="98" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="99" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="2" disabled><span>--</span><input tabindex="100" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="1" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

</ul>

</div>


<!--11 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="11"><a href="#" class="izq"></a>Fecha 11<a href="#" class="der"></a></h4>
<div class="lafecha-info">10 de noviembre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="101" maxlength="2" pattern="\d*" type="number" data-eq="co" value="0" disabled><span>--</span><input tabindex="102" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="101" maxlength="2" pattern="\d*" type="number" data-eq="co" value="0" disabled><span>--</span><input tabindex="102" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="103" maxlength="2" pattern="\d*" type="number" data-eq="py" value="1" disabled><span>--</span><input tabindex="104" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="4" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="105" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="5" disabled><span>--</span><input tabindex="106" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="107" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="2" disabled><span>--</span><input tabindex="108" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="109" maxlength="2" pattern="\d*" type="number" data-eq="br" value="3" disabled><span>--</span><input tabindex="110" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="0" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

</ul>

</div>


<!--12 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="12"><a href="#" class="izq"></a>Fecha 12<a href="#" class="der"></a></h4>
<div class="lafecha-info">15 de noviembre de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="111" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="3" disabled><span>--</span><input tabindex="112" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="111" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="3" disabled><span>--</span><input tabindex="112" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="1" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="113" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="3" disabled><span>--</span><input tabindex="114" pattern="\d*" maxlength="2" type="number" data-eq="co" value="0" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="115" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="3" disabled><span>--</span><input tabindex="116" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="0" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="117" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="1" disabled><span>--</span><input tabindex="118" pattern="\d*" maxlength="2" type="number" data-eq="py" value="0" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="119" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="0" disabled><span>--</span><input tabindex="120" pattern="\d*" maxlength="2" type="number" data-eq="br" value="2" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

</ul>

</div>


<!--13 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="13"><a href="#" class="izq"></a>Fecha 13<a href="#" class="der"></a></h4>
<div class="lafecha-info">20 de marzo de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="121" maxlength="2" pattern="\d*" type="number" data-eq="co" value="1" disabled><span>--</span><input tabindex="122" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="121" maxlength="2" pattern="\d*" type="number" data-eq="co" value="1" disabled><span>--</span><input tabindex="122" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="0" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="123" maxlength="2" pattern="\d*" type="number" data-eq="py" value="2" disabled><span>--</span><input tabindex="124" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="125" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="1" disabled><span>--</span><input tabindex="126" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="127" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="2" disabled><span>--</span><input tabindex="128" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="2" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="129" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="1" disabled><span>--</span><input tabindex="130" pattern="\d*" maxlength="2" type="number" data-eq="br" value="4" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

</ul>

</div>



<!--14 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="14"><a href="#" class="izq"></a>Fecha 14<a href="#" class="der"></a></h4>
<div class="lafecha-info">28 de marzo de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="131" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="3" disabled><span>--</span><input tabindex="132" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="133" maxlength="2" pattern="\d*" type="number" data-eq="br" value="3" disabled><span>--</span><input tabindex="134" pattern="\d*" maxlength="2" type="number" data-eq="py" value="0" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="135" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="0" disabled><span>--</span><input tabindex="136" pattern="\d*" maxlength="2" type="number" data-eq="co" value="2" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="137" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="138" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="0" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="139" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="140" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="1" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="139" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="140" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="1" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

</ul>

</div>


<!--15 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="15"><a href="#" class="izq"></a>Fecha 15<a href="#" class="der"></a></h4>
<div class="lafecha-info">31 de agosto de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="145" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="0" disabled><span>--</span><input tabindex="146" pattern="\d*" maxlength="2" type="number" data-eq="co" value="0" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="141" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="0" disabled><span>--</span><input tabindex="142" pattern="\d*" maxlength="2" type="number" data-eq="py" value="3" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="149" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="0" disabled><span>--</span><input tabindex="150" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="0" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="143" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2" disabled><span>--</span><input tabindex="144" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="0" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="147" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="148" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="1" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="147" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2" disabled><span>--</span><input tabindex="148" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="1" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

</ul>

</div>


<!--16 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="16"><a href="#" class="izq"></a>Fecha 16<a href="#" class="der"></a></h4>
<div class="lafecha-info">5 de septiembre de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input tabindex="159" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="1" disabled><span>--</span><input tabindex="160" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="0" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="151" maxlength="2" pattern="\d*" type="number" data-eq="co" value="1" disabled><span>--</span><input tabindex="152" pattern="\d*" maxlength="2" type="number" data-eq="br" value="1" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE+</div><div class="marc"><input tabindex="157" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="1" disabled><span>--</span><input tabindex="158" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="155" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="1" disabled><span>--</span><input tabindex="156" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="1" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="153" maxlength="2" pattern="\d*" type="number" data-eq="py" value="1" disabled><span>--</span><input tabindex="154" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2" disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="153" maxlength="2" pattern="\d*" type="number" data-eq="py" value="1" disabled><span>--</span><input tabindex="154" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

</ul>

</div>


<!--17 FECHA-->

<div class="box-simulador-general">


<h4 class="calendario-fecha" data-anclado="17"><a href="#" class="izq"></a>Fecha 17<a href="#" class="der"></a></h4>
<div class="lafecha-info">5 de octubre de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input name="fecha17-1" tabindex="161" maxlength="2" pattern="\d*" type="number" data-eq="co" value="1" disabled><span>-</span><input name="fecha17-2" tabindex="162" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input name="fecha17-3" tabindex="163" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="2" disabled><span>-</span><input name="fecha17-4" tabindex="164" pattern="\d*" maxlength="2" type="number" data-eq="ec" value="1" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input name="fecha17-5" tabindex="165" maxlength="2" pattern="\d*" type="number" data-eq="ar" value="0" disabled><span>-</span><input name="fecha17-6" tabindex="166" pattern="\d*" maxlength="2" type="number" data-eq="pe" value="0" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input name="fecha17-7" tabindex="167" maxlength="2" pattern="\d*" type="number" data-eq="ve" value="0" disabled><span>-</span><input name="fecha17-8" tabindex="168" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="0" disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input name="fecha17-9" tabindex="169" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="0" disabled><span>-</span><input name="fecha17-10" tabindex="170" pattern="\d*" maxlength="2" type="number" data-eq="br" value="0" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input name="fecha17-9" tabindex="169" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="0" disabled><span>-</span><input name="fecha17-10" tabindex="170" pattern="\d*" maxlength="2" type="number" data-eq="br" value="0" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<div id="siteInfo2">
</div>
</ul>
</div>

<!--18 FECHA-->


<div class="box-simulador-general">
<h4 class="calendario-fecha" data-anclado="18"><a href="#" class="izq"></a>Fecha 18<a href="#" class="der"></a></h4>
<div class="lafecha-info">10 de octubre de 2017</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C.</div><div class="marc"><input name="fecha18-1" tabindex="171" maxlength="2" pattern="\d*" type="number" data-eq="py" value="<?php echo $row['fecha18-1']?>" ><span>--</span><input name="fecha18-2" tabindex="172" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="<?php echo $row['fecha18-2']?>" ></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input name="fecha18-1" tabindex="171" maxlength="2" pattern="\d*" type="number" data-eq="py" value="<?php echo $row['fecha18-1']?>" ><span>--</span><input name="fecha18-2" tabindex="172" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="<?php echo $row['fecha18-2']?>" ></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input name="fecha18-3" tabindex="173" maxlength="2" pattern="\d*" type="number" data-eq="br" value="<?php echo $row['fecha18-3']?>" ><span>--</span><input name="fecha18-4" tabindex="174" pattern="\d*" maxlength="2" type="number" data-eq="cl" value="<?php echo $row['fecha18-4']?>" ></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input name="fecha18-5" tabindex="175" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="<?php echo $row['fecha18-5']?>" ><span>--</span><input name="fecha18-6" tabindex="176" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="<?php echo $row['fecha18-6']?>" ></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input name="fecha18-7" tabindex="177" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="<?php echo $row['fecha18-7']?>" ><span>--</span><input name="fecha18-8" tabindex="178" pattern="\d*" maxlength="2" type="number" data-eq="co" value="<?php echo $row['fecha18-8']?>" ></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input name="fecha18-9" tabindex="179" maxlength="2" pattern="\d*" type="number" data-eq="uy" value="<?php echo $row['fecha18-9']?>" ><span>--</span><input name="fecha18-10" tabindex="180" pattern="\d*" maxlength="2" type="number" data-eq="bo" value="<?php echo $row['fecha18-10']?>" ></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

</ul>

</div>


<!--19 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="19"><a href="#" class="izq"></a>Fecha 19<a href="#" class="der"></a></h4>
<div class="lafecha-info">24/25 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="43" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2"  disabled><span>--</span><input tabindex="44" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2"  disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="45" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="46" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="47" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="48" pattern="\d*" maxlength="2" type="number" data-eq="co" value="3" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="49" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2"  disabled><span>--</span><input tabindex="50" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2"  disabled></div><div class="vis">BARCELONA S.C.<img src="img/banderas/barcelona.png"></div></li>

</ul>

</div>


<!--20 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="20"><a href="#" class="izq"></a>Fecha 20<a href="#" class="der"></a></h4>
<div class="lafecha-info">24/25 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="43" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2"  disabled><span>--</span><input tabindex="44" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2"  disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="45" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="46" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>
 
<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="47" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="48" pattern="\d*" maxlength="2" type="number" data-eq="co" value="3" disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="49" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2"  disabled><span>--</span><input tabindex="50" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2"  disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

</ul>

</div>


<!--21 FECHA-->

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="21"><a href="#" class="izq"></a>Fecha 21<a href="#" class="der"></a></h4>
<div class="lafecha-info">24/25 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<?php $idUsuario=$_GET['idusurio']; 
$datem2=date("Y-m-d H:i:s", time());
$date2=$hoy = date("Y-m-d H:i:s", time());

?>


<li><div class="loc"><img src="img/banderas/clan.png">CLAN JUVENIL</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">NACIONAL<img src="img/banderas/nacional.png"></div></li>

<li><div class="loc"><img src="img/banderas/cuenta.png">DEP. CUENCA</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">L.D.U(Q)<img src="img/banderas/l.d.u.png"></div></li>

<li><div class="loc"><img src="img/banderas/emelec.png">EMELEC</div><div class="marc"><input tabindex="43" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2"  disabled><span>--</span><input tabindex="44" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2"  disabled></div><div class="vis">GUAYAQUIL CITY<img src="img/banderas/guayaquil.png"></div></li>

<li><div class="loc"><img src="img/banderas/fuerza.png">FUERZA AMARILLA</div><div class="marc"><input tabindex="45" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="46" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">BARCELONA S.C<img src="img/banderas/barcelona.png"></div></li>
 
<li><div class="loc"><img src="img/banderas/macara.png">MACARA</div><div class="marc"><input tabindex="47" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="48" pattern="\d*" maxlength="2" type="number" data-eq="co" value="3" disabled></div><div class="vis">INDEPENDIENTE<img src="img/banderas/independiente.png"></div></li>

<li><div class="loc"><img src="img/banderas/ucatolica.png">U. CATOLICA</div><div class="marc"><input tabindex="49" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2"  disabled><span>--</span><input tabindex="50" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2"  disabled></div><div class="vis">DELFIN<img src="img/banderas/delfin.png"></div></li>

</ul>

</div>


<!--22 FECHA-->

<?php
/*$DB_SERVER = "awsfcf2waysports.co6n6hotu5cp.us-east-1.rds.amazonaws.com";
$DB_USER = "admin";
$DB_PASSWORD = "Shok7788!";
$DB = "fcf2ways_api";

$link=mysql_connect($DB_SERVER, $DB_USER, $DB_PASSWORD) or die(mysql_error());
mysql_select_db($DB) or die(mysql_error());*/



if($_POST['update'] && $_GET['i'] ){

echo "<span class=\"haz\">Pronóstico Generado</span>";
if($_POST['fecha18-1']==''){$_POST['fecha18-1']='NULL';}
if($_POST['fecha18-2']==''){$_POST['fecha18-2']='NULL';}
if($_POST['fecha18-3']==''){$_POST['fecha18-3']='NULL';}
if($_POST['fecha18-4']==''){$_POST['fecha18-4']='NULL';}
if($_POST['fecha18-5']==''){$_POST['fecha18-5']='NULL';}
if($_POST['fecha18-6']==''){$_POST['fecha18-6']='NULL';}
if($_POST['fecha18-7']==''){$_POST['fecha18-7']='NULL';}
if($_POST['fecha18-8']==''){$_POST['fecha18-8']='NULL';}
if($_POST['fecha18-9']==''){$_POST['fecha18-9']='NULL';}
if($_POST['fecha18-10']==''){$_POST['fecha18-10']='NULL';}



 $sql_insert="INSERT INTO simulador_predicciones (
idUsuario, 
`fecha18-1`,
`fecha18-2`,
`fecha18-3`,
`fecha18-4`,
`fecha18-5`,
`fecha18-6`,
`fecha18-7`,
`fecha18-8`,
`fecha18-9`,
`fecha18-10`,
`tiempo2`
)VALUES(
".$_GET['idusurio'].", 
".$_POST['fecha18-1'].",
".$_POST['fecha18-2'].",
".$_POST['fecha18-3'].",
".$_POST['fecha18-4'].",
".$_POST['fecha18-5'].",
".$_POST['fecha18-6'].",
".$_POST['fecha22-7'].",
".$_POST['fecha22-8'].",
".$_POST['fecha22-9'].",
".$_POST['fecha22-10'].",
'".$datem2."'
)";

//mysql_query($sql_insert);

}

if($_POST['update'] && $_GET['u']){

echo "<span class=\"haz\">Pronóstico Actualizado</span>";
if($_POST['fecha22-1']==''){$_POST['fecha22-1']='NULL';}
if($_POST['fecha22-2']==''){$_POST['fecha22-2']='NULL';}
if($_POST['fecha22-3']==''){$_POST['fecha22-3']='NULL';}
if($_POST['fecha22-4']==''){$_POST['fecha22-4']='NULL';}
if($_POST['fecha22-5']==''){$_POST['fecha22-5']='NULL';}
if($_POST['fecha22-6']==''){$_POST['fecha22-6']='NULL';}
if($_POST['fecha22-7']==''){$_POST['fecha22-7']='NULL';}
if($_POST['fecha22-8']==''){$_POST['fecha22-8']='NULL';}
if($_POST['fecha22-9']==''){$_POST['fecha22-9']='NULL';}
if($_POST['fecha22-10']==''){$_POST['fecha22-10']='NULL';}

$datem=date("Y-m-d H:i:s", time());

$sql_update="
UPDATE simulador_predicciones
SET 
`fecha22-1`=".$_POST['fecha22-1'].",
`fecha22-2`=".$_POST['fecha22-2'].",
`fecha22-3`=".$_POST['fecha22-3'].",
`fecha22-4`=".$_POST['fecha22-4'].",
`fecha22-5`=".$_POST['fecha22-5'].",
`fecha22-6`=".$_POST['fecha22-6'].",
`fecha22-7`=".$_POST['fecha22-7'].",
`fecha22-8`=".$_POST['fecha22-8'].",
`fecha22-9`=".$_POST['fecha22-9'].",
`fecha22-10`=".$_POST['fecha22-10'].",
`tiempo2`='".$datem."'
WHERE idUsuario=".$idUsuario." ";

//mysql_query($sql_update);

}



$query = "SELECT * FROM simulador_predicciones where idusuario=$idUsuario";
$result = mysql_query($query);

/* array numérico */
if(mysql_num_rows($result)==0){

echo '<div class="column">
    <img src="img.png"  onload="openModal();">
  </div>';
  
echo "<form id=\"myForm\" method=\"POST\" action=\"index.php?idusurio=$idUsuario&i=1\" >";


}else{


echo "<form id=\"myForm\" method=\"POST\" action=\"index.php?idusurio=$idUsuario&u=1\" >";
//imprime resultados
$row = mysql_fetch_array($result);
}



?>

<div class="box-simulador-general">

<h4 class="calendario-fecha" data-anclado="22"><a href="#" class="izq"></a>Fecha 22<a href="#" class="der"></a></h4>
<div class="lafecha-info">24/25 de marzo de 2016</div>

<ul class="sim-calendario-grupo">

<li><div class="loc"><img src="img/banderas/barcelona.png">BARCELONA S.C</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">MACARA<img src="img/banderas/macara.png"></div></li>

<li><div class="loc"><img src="img/banderas/delfin.png">DELFIN</div><div class="marc"><input tabindex="41" maxlength="2" pattern="\d*" type="number" data-eq="cl" value="1" disabled><span>--</span><input tabindex="42" pattern="\d*" maxlength="2" type="number" data-eq="ar" value="2" disabled></div><div class="vis">FUERZA AMARILLA<img src="img/banderas/fuerza.png"></div></li>

<li><div class="loc"><img src="img/banderas/nacional.png">NACIONAL</div><div class="marc"><input tabindex="43" maxlength="2" pattern="\d*" type="number" data-eq="br" value="2"  disabled><span>--</span><input tabindex="44" pattern="\d*" maxlength="2" type="number" data-eq="uy" value="2"  disabled></div><div class="vis">EMELEC<img src="img/banderas/emelec.png"></div></li>

<li><div class="loc"><img src="img/banderas/guayaquil.png">GUAYAQUIL CITY</div><div class="marc"><input tabindex="45" maxlength="2" pattern="\d*" type="number" data-eq="ec" value="2" disabled><span>--</span><input tabindex="46" pattern="\d*" maxlength="2" type="number" data-eq="py" value="2" disabled></div><div class="vis">DEP. CUENCA<img src="img/banderas/cuenta.png"></div></li>
 
<li><div class="loc"><img src="img/banderas/independiente.png">INDEPENDIENTE</div><div class="marc"><input tabindex="47" maxlength="2" pattern="\d*" type="number" data-eq="bo" value="2" disabled><span>--</span><input tabindex="48" pattern="\d*" maxlength="2" type="number" data-eq="co" value="3" disabled></div><div class="vis">U. CATOLICA<img src="img/banderas/ucatolica.png"></div></li>

<li><div class="loc"><img src="img/banderas/l.d.u.png">L.D.U(Q)</div><div class="marc"><input tabindex="49" maxlength="2" pattern="\d*" type="number" data-eq="pe" value="2"  disabled><span>--</span><input tabindex="50" pattern="\d*" maxlength="2" type="number" data-eq="ve" value="2"  disabled></div><div class="vis">CLAN JUVENIL<img src="img/banderas/clan.png"></div></li>

</ul>

</div>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="js/simulador.js"></script>
<!-- fin columnas -->
</div><!-- fin contenido -->
</div><!-- fin contenedor general -->


<?php
/*
mysqli_close($link);
*/
?>


<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
</div>

<script>

function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</body>
</html>

</form>

</body>
</html>