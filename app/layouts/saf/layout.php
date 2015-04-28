<?php
$head = APP_ROOT_LAYOUTS."saf/head.php";
if(file_exists($head)) {  
include($head); }
else { echo "no se encuentre el archivo: ".$head;}
?>
<!--Inicio estructura principal-->
<!--Inicio cabecera-->
<?php
// $cabecera = APP_ROOT_LAYOUTS."saf/cabecera.php";
// if(file_exists($cabecera)) { include($cabecera); }
// else { echo "no se encuentra el archivo: ".$cabecera;}?>

<!--Fin cabecera-->
<!--Inicio contenido-->
<?php
if ($view)
{
if (file_exists(APP_ROOT_VIEWS.$view)){
include(APP_ROOT_VIEWS.$view);}
else{ throw new Exception("vista no encontrada en layout");}
}
?>
 <!--Final contenido-->   

<!--Inicio Footer-->
<?php 
$pie = APP_ROOT_LAYOUTS."saf/pie.php";
if( file_exists($pie) ) { include($pie);}
else { echo "no se encuentre el archivo: ".$pie;}?>
<!--Final Footer-->
<!--Final estructura principal-->