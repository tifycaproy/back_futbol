<?php  
function Conectarse()  
{  


   $host = "awsfcf2waysports.co6n6hotu5cp.us-east-1.rds.amazonaws.com";
    $user = "admin";
    $pass = "Shok7788!";
    $database = "millonarios_produccion";


  if (!($link = mysqli_connect($host, $user, $pass, $database))) {
         echo "Error conectando a la base de datos.";
         exit();
     }
   
   return $link;  
}  
?>