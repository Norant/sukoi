<?php
//include(APP_ROOT_VENDOR."anti_ddos.php");//DEFENSA ANTE ATAQUE DDOS Y FLOODING
require(APP_ROOT_VENDOR."security.php");//FUNCIONES DE SEGURIDAD
require(APP_ROOT_VENDOR."functions.php");//HELPERS
//@PATRON FRONT-CONTROLLER USANDO SINGLETON
final class FrontController
{
	private function __construct() { } //constructor privado	
	public static function run()
	{	
		if (isset($_GET['controller'])) {
			$controller = inc_convierte_primera_letra_mayuscula($_GET['controller']);// obtengo el controlador	
		} else {
				if( empty($controller) ){ $controller = 'Index'; } // si no hay controlador tomo IndexController 
				
		}
		if (isset($_GET['subaction'])) {
			$subaction = inc_convierte_minuscula($_GET['subaction']);// obtengo el controlador	
		} else {
				if( empty($subaction) ){ $subaction = 'Index'; } // si no hay controlador tomo IndexController 	
		} 
		
		if (isset($_GET['namex'])) {
			$namex = inc_convierte_minuscula($_GET['namex']);// obtengo el controlador	
		} else {
				if( empty($namex) ){ $namex = 'Index'; } // si no hay controlador tomo IndexController 	
		} 
		
		if ($controller == ""){$controller = "Index";}

        if ($controller == "decoestilos"){ } else {

	if (isset($_GET['action'])) {
		$action = inc_convierte_minuscula($_GET['action']);// obtengo el action
		$action = $action."Action";	
		} else {
				if( empty($action) ) $action = 'indexAction';    // si no hay action tomo IndexAction       
				//else $action = $action."Action" ;  //asigno el action    
		}
	
   		if ($action == ""){$action = "IndexAction"; }
		
		$controllerLocation = APP_ROOT_CONTROLLERS . $controller . 'Controller.php'; 
		if(file_exists($controllerLocation)){                
		include($controllerLocation);} 
		else {
			//aqui se agregaria un else if para obtener la data de la bd, en caso de existir el file o el nombre en la bd le niega la creacion usando un metodo que busque lo que viene
			//si lo encuentra debe mostrarle la data del tipo cate padre - hijo, se crea un metodo que detecta si existe o no la seccion
			 include(APP_ROOT_CONTROLLERS.'GwyarController.php');//CONTROLADOR DE MANEJO DE CONTENIDO DINAMICO              
			if( class_exists("GwyarController", false)) {
				$contenido = new GwyarController();
				$contenido->IndexAction(); 
				}
			else{
			throw new Exception("No se encuentra el controlador $controllerLocation");          
			}
			 }
		if( class_exists( $controller."Controller", false )) {
			$controller = $controller."Controller";
			$cont = new $controller(); 
			if ($controller == "SafController"){ if ($_SESSION['admin'] == "") { $action = "IndexAction";}}
			} 
			else {
			throw new Exception( "Clase de Controlador no encontrada : $controller o no se encuentra Gwyarcontroller" );           
			}
			
		if (isset($cont)){	
			if( method_exists( $cont, $action )  ) {                  	
			$cont->$action();
			 } 
			else {
				$cont->indexAction();                   
			//throw new Exception( "No existe el Action: <b>$action</b> en el controlador: <b>$controller</b>" );           
				}
			}
		}
	}	
	public function __clone()    //impedimos la clonacion 
    {   
    	throw new Exception("la clonacion no es soportada.");   
    }  	
}