<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php
require_once(APP_ROOT_MODELS."SafModel.php");
$safModel = new safModel();
$novedades = $safModel->getAllNoveltysPublished();
$head = APP_ROOT_LAYOUTS."header.php";
if(file_exists($head)) {  
include($head); }
else { echo "Por favor añada el archivo al layout: ".$head;}
?>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">Tú estas usando un  navegador <strong>obsoleto</strong>. Por favor <a href="http://browsehappy.com/">actualiza tu navegador</a> ó <a href="http://www.google.com/chromeframe/?redirect=true">usa Google Chrome Frame</a> para una mejor experiencia web.</p>
        <![endif]-->
<noscript>
<center>Este sitio web requiere javascript para trabajar correctamente<br /><br />
Para habilitar JavaScript, por favor, sigue los pasos que se enumeran a continuación correspondientes a tu navegador:<br /><br />
 <b>Internet Explorer</b><br />
  1. Selecciona Herramientas en el menú de la parte superior. <br />2. Elige Opciones de Internet. <br />3. Haz clic en la pestaña Seguridad. <br />4. Haz clic en Nivel personalizado.<br /> 5. Desplázate hasta llegar a la sección Automatización.<br /> 6. En Secuencias de comandos ActiveX, selecciona Activar y haz clic en Aceptar. <br /><br />
  <b>Mozilla Firefox</b> <br />1. Selecciona Herramientas en el menú de la parte superior. <br />2. Elige Opciones. <br />3. Selecciona Funciones de Web en el panel de navegación de la izquierda. <br />4. Selecciona la casilla junto a Activar JavaScript y haz clic en Aceptar. <br /><br />
  <b>Apple Safari</b> <br />1. Selecciona Safari en el menú de la parte superior. <br />2. Selecciona Preferencias. <br />3. Elige Seguridad. <br />4. Selecciona la casilla junto a Permitir JavaScript.<br /><br /> 
  <b>Google Chrome</b><br />
1. En el navegador web, haz click en el menú "Customize and control Google Chrome" y luego selecciona "Settings".<br />
2. En la sección "Settings" haz click en la opción "Show advanced settings..."<br />
3. Bajo la sección "Privacy" haz click en la opción "Content settings...".<br />
4. Cuando la ventana aparezca, dirigirse a la sección "JavaScript" y seleccionar la opción "Allow all sites to run JavaScript (recommended)".<br />
5. Luego haz click en el botón "OK" para cerrar la ventana.<br />
6. Cierra la pestaña "Settings".<br />
7. Finalmente haz click en el botón "Reload this page" del navegador web para refrescar la página.<br /><br />

  Por favor, ten en cuenta que si actualizas tu navegador o instalas un software o una revisión de seguridad nuevos, esto podría afectar a la configuración de JavaScript.
  
</center>
  
</noscript>
<!--Inicio estructura principal-->
<!--Inicio cabecera-->
<?php
$cabecera = APP_ROOT_LAYOUTS."cabecera.php";
if(file_exists($cabecera)) { include($cabecera); }
else { echo "No se encuentra: ".$cabecera;}?>
<!--Fin cabecera-->
<!--Inicio contenido-->
<?php
// agregamos el archivo de idioma si es que lo hubiera
if (isset($view))
{
	$language = (!isset($_SESSION['language'])) ? "es" : ""; 
if (file_exists(APP_ROOT_PATH."languages/".$language."/".$view) && ($language != "")){
		 include(APP_ROOT_PATH."languages/".$language."/".$view);		
} else if (!file_exists(APP_ROOT_PATH."languages/en/".$view) && ($language != "es") && ($language != "") && ($language == "en")){
	if (file_exists(APP_ROOT_PATH."languages/es/".$view)){
	 	include_once(APP_ROOT_PATH."languages/es/".$view);
	}
	}
	else if (!file_exists(APP_ROOT_PATH."languages/qu/".$view) && ($language != "es") && ($language != "") && ($language == "qu")){
		if (file_exists(APP_ROOT_PATH."languages/es/".$view)){
	 	include_once(APP_ROOT_PATH."languages/es/".$view);
		}
	}
if (file_exists(APP_ROOT_VIEWS.$view)){
include(APP_ROOT_VIEWS.$view);}
else{ throw new Exception("vista no encontrada en layout ".__FILE__);}
}
?>
 <!--Final contenido-->   
 <!--Inicio Footer-->
<?php 
$pie = APP_ROOT_LAYOUTS."footer.php";
if( file_exists($pie) ) { include($pie);}
else { echo "No se encuentra el archivo: ".$pie;}?>
<!--Final Footer-->
<!--Final estructura principal-->
</body>
</html>