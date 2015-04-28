<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."SafModel.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class Buscador_coloresController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{
	  $data['view']="buscador_colores/index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
		$data['nombre']='Mario';
		$data['variable']="<br />nueva variable";
		
		$this->_view->render('../layouts/layout.php',$data);  
		//$this->_view->render('test/index.php',$data);        	 	 
		 
	 }
}