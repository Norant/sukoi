<?php
session_start();
//header ( "Cache-Control: must-revalidate");
//$offset = 60 * 60 * 24 * 3;
//$ExpireString = "Expires:". gmdate ( "D, d M Y H: i: s", time () + $offset). " GMT";
//header ($ExpireString); 
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}else{ob_start();}
if ($_SESSION['language'] == ""){$_SESSION['language'] = "es";} //IDIOMA ESPAÑOL POR DEFECTO español = es, ingles = es, quechua = qu
include("configs/web.config.php");//DATOS DE CONFIGURACION
require(APP_ROOT_CLASES."FrontController.php");//PATRON FRONT CONTROLLER PARA LA APLICACION
try{
FrontController::run();
}catch(Exception $e){
	//require_once(APP_ROOT."404.php");  //desarrollo
	$_SESSION['catch exception'] = $e->getMessage();
	echo utf8_encode("<b>Excepción capturada: </b>".$e->getMessage());	//producción
}
ob_end_flush();