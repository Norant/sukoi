<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."ClienteModel.php");
require(APP_ROOT_MODELS."ContenidoModel.php");
class GwyarController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{ 
	/*$url_contenido = $_GET['controller'];
	$action = isset($_GET['action'])? $_GET['action'] : 0;
	$url_sub_contenido = $action;
	$contenidoModel = new ContenidoModel();
	$contenido = $contenidoModel->checkUrl($url_contenido);
	$subcontenido = $contenidoModel->checkUrl($url_sub_contenido);
	if (!$contenido){
		// si no hay contenido de la sección padre no hay nada mas y lanzamos una excepción
		throw new Exception( "Gwyarcontroller: excepci&oacuten lanzada cuando se intento acceder a una secci&oacuten padre que no existe en la base de datos" );
		}
	if (($contenido->id_parent_contenido) == "0" && (!$subcontenido)){
		// AQUI VA EL CONTENIDO DE LA SECCION PADRE
		if ($url_sub_contenido == ""){
			
			echo $contenido->texto_contenido;	
			}
		}
		if ($subcontenido->id_parent_contenido != "0"){
				// AQUI VA EL CONTENIDO DE LA SECCION HIJO
					echo $subcontenido->texto_contenido;		
		} else{
		header("Location:".HTML_PATH.$url_contenido);
		}		
			
	
	
	 		
		//$data['view']="gwyar/index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT			
		//$this->_view->render('../layouts/layout.php',$data);  
		//$this->_view->render('test/index.php',$data);  
		*/      	
	 }	 	
}