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
        echo '<iframe class="youtube" width="560" height="315" src="https://www.youtube.com/embed/oPpEio5Fz2w" frameborder="0" allowfullscreen></iframe>';
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
       
  </body>
  
  
</html>
<?php


?>