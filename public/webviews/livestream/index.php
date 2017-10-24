<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BSC en vivo</title>
    

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
li {
	list-style: none;
	list-style-image: none;
	padding-bottom: 20px;
}
iframe.youtube {
	width: 100%!important;
	min-height: auto!important;
}

ul {
	padding: 0px;
	margin: 0px;
}
body {
	background: #000;
	/* margin: auto; */
	/* position: relative; */
	/* min-width: 900px; */
	/* display: flex; */
	padding: 0px;
	margin: 0px;
}
.center {
	margin: auto;
	min-width: 100px;
	text-align: center;
}
.video {
	padding-top: 10px;
}
h2{
	font-size: 12px;
	color: #fff;
	font-family: 'Open Sans', sans-serif;
	text-align: left;
margin: 0px;
padding-left: 10px;
}
img.example-image {
	width: 100%;
	height: auto;
}
a:link   
{   
 text-decoration:none;   
}   

</style>

  </head>
  <body>
   
   
   
   <?php
   if($_GET['idvideo'])
   {
   echo "<div class=\"video\">";
   echo "<ul><li class=\"\">
      <a href=\"index.php\"><img src=\"cerrar.png\" width=\"30px\" height=\"30px\"></a>
    </li>
    </ul>
    ";
   
 

switch ($_GET['idvideo']) {
    case 1:
        echo "<blockquote class=\"twitter-video\" data-lang=\"es\"><p lang=\"es\" dir=\"ltr\">Hoy necesitamos de todos en el <a href=\"https://twitter.com/hashtag/MonumentalBP?src=hash&amp;ref_src=twsrc%5Etfw\">#MonumentalBP</a> <a href=\"https://twitter.com/hashtag/vamosidolo?src=hash&amp;ref_src=twsrc%5Etfw\">#vamosidolo</a> <a href=\"https://twitter.com/hashtag/BSCvsNAC?src=hash&amp;ref_src=twsrc%5Etfw\">#BSCvsNAC</a> <a href=\"https://t.co/YBMZM6wtUc\">pic.twitter.com/YBMZM6wtUc</a></p>&mdash; Barcelona S.C. (@BarcelonaSCweb) <a href=\"https://twitter.com/BarcelonaSCweb/status/920713216724013069?ref_src=twsrc%5Etfw\">18 de octubre de 2017</a></blockquote>
<script async src=\"//platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>";
        break;
    case 2:
        echo "<iframe class=\"youtube\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/qd1brdPy5yQ\" frameborder=\"0\" allowfullscreen></iframe>";
        break;
    case 3:
        echo "<iframe class=\"youtube\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Cfm2Vw5ScPs\" frameborder=\"0\" allowfullscreen></iframe>";
        break;
    case 4:
        echo "<iframe class=\"youtube\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/8LX6hRk5tYk\" frameborder=\"0\" allowfullscreen></iframe>";
        break;
    case 5:
        echo "<iframe class=\"youtube\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/0bRnzaZxLow\" frameborder=\"0\" allowfullscreen></iframe>";
        break;
     case 6:
        echo "<iframe class=\"youtube\" width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/9BddzJpLpyE\" frameborder=\"0\" allowfullscreen></iframe>";
        break;
     case 7:
        echo "<blockquote class=\"twitter-video\" data-lang=\"es\"><p lang=\"es\" dir=\"ltr\">¡No te quedes sin tu estadio, sin el Coloso de América en <a href=\"https://twitter.com/BSC_Puzzle3D?ref_src=twsrc%5Etfw\">@BSC_Puzzle3D</a>¡ | Reserva y compra ahora vía <a href=\"https://t.co/GTcoCTmQPn\">https://t.co/GTcoCTmQPn</a> <a href=\"https://twitter.com/hashtag/BSC?src=hash&amp;ref_src=twsrc%5Etfw\">#BSC</a> <a href=\"https://t.co/waXQiuF9Nn\">pic.twitter.com/waXQiuF9Nn</a></p>&mdash; Barcelona S.C. (@BarcelonaSCweb) <a href=\"https://twitter.com/BarcelonaSCweb/status/921458974377107461?ref_src=twsrc%5Etfw\">20 de octubre de 2017</a></blockquote>
<script async src=\"//platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>";
        break;
}
   
   
   echo "</div>";
    }   
   ?>
<div class="center">

<ul>
   
<?php

if(!isset($_GET['idvideo'])){
?>  
     
    <li>
      <a class="example-image-link" href="index.php?idvideo=1" >
       <img class="example-image" src="imagenes/1.jpg" alt="image-1" />
            <h2>No se pierden las ganas de alentarte</h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=2" >
       <img class="example-image" src="imagenes/2.jpg" alt="image-1" />
            <h2>Creo en ti </h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=3" >
       <img class="example-image" src="imagenes/3.jpg" alt="image-1" />
            <h2>Los clásicos no se juegan, se ganan</h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=4" >
       <img class="example-image" src="imagenes/4.jpg" alt="image-1" />
            <h2>92 años de gloria Amarilla</h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=5" >
       <img class="example-image" src="imagenes/5.jpg" alt="image-1" />
            <h2>Viernes de Revancha</h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=6" >
       <img class="example-image" src="imagenes/6.jpg" alt="image-1" />
            <h2>El domingo volvemos al monumental</h2>
       </a>
    </li>
    <li>
      <a class="example-image-link" href="index.php?idvideo=7" >
       <img class="example-image" src="imagenes/7.jpg" alt="image-1" />
            <h2>El Monumental siempre contigo</h2>
       </a>
    </li>

    
    <?php

}else{



}
?>  
</ul>
 
    </div>
       <link rel="stylesheet" href="dist/css/lightbox.min.css">
  </body>
  
  
</html>
<?php


?>