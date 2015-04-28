<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."SafModel.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class IntroController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{
	  $data['view']="intro/index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
	  $data['nombre']='Mario';
		
		//$this->_view->render('../layouts/layout.php',$data);  
		$this->_view->render($data['view'],$data);  	 
		 
	 }
	 	public function xAction()
	{
	  $data['view']="intro/index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
	  $data['nombre']='Mario';
		
		//$this->_view->render('../layouts/layout.php',$data);  
		$this->_view->render($data['view'],$data);  	 
		 
	 }
}