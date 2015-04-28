<?php
//require_once '../ubench/src/Ubench.php'; //benchmarking php code
error_reporting(E_ALL); //dev
ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE); //prod
//@author: noranterri@gmail.com
session_start(); // starts new or resumes existing session
@session_regenerate_id(true); // regenerates SESSIONID to prevent hijacking
//header ( "Cache-Control: must-revalidate");
//$offset = 60 * 60 * 24 * 3;
//$ExpireString = "Expires:". gmdate ( "D, d M Y H: i: s", time () + $offset). " GMT";
//header ($ExpireString);
//$bench = new Ubench;
//$bench->start();
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}else{ob_start();}
$_SESSION['language'] = "" ? "es":""; //IDIOMA ESPA�OL POR DEFECTO espanol = es, ingles = en, quechua = qu
include("app/config/web.config.php");//DATOS DE CONFIGURACION
//include(APP_ROOT_VENDOR."anti_ddos.php");
require(APP_ROOT_CLASES."FrontController.php");//PATRON FRONT CONTROLLER PARA LA APLICACION
try{
FrontController::run();
}catch(Exception $e){
	$_SESSION['catch exception'] = $e->getMessage();
	//require_once(APP_ROOT."404.php");  //producci�n
	echo utf8_encode("<b>Excepción capturada: </b>".$e->getMessage());	//desarrollo
}
ob_end_flush();
// Execute some code
//$bench->end();

// Get elapsed time and memory
//echo "<div style=\"background-color:black; color:#20de07; border-radius:6px; width:300px; margin-left:40px; padding:5px;\">";
//echo "Tiempo:".$bench->getTime()."<br />"; // 156ms or 1.123s
//echo "<h3>Benchmark</h3>Tiempo Transcurrido: ".$bench->getTime(true)." (".$bench->getTime().")"."<br />"; // elapsed microtime in float
//echo $bench->getTime(false, '%d%s')."<br />"; // 156ms or 1s

//echo "Pico de memoria: ".$bench->getMemoryPeak()."<br />"; // 152B or 90.00Kb or 15.23Mb
//echo "Pico de memoria: ".$bench->getMemoryPeak(true)." bytes (".$bench->getMemoryPeak(false, '%.3f%s').")<br />"; // memory peak in bytes
//echo $bench->getMemoryPeak(false, '%.3f%s')."<br />"; // 152B or 90.152Kb or 15.234Mb

// Returns the memory usage at the end mark
//echo "Uso de memoria: ".$bench->getMemoryUsage(); // 152B or 90.00Kb or 15.23Mb
//echo "</div>";