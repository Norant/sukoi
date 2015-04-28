<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
class SetlanguageController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{ 
	// IDIOMA POR DEFECTO
	$_SESSION['language'] = "es";
	header('Location:'.$_SESSION['url']);
	}
	public function esAction()
	{  		 	
		//  IDIOMA ESPAÑOL 
		$_SESSION['language'] = "es";
		header('Location:'.$_SESSION['url']);	
	 }
	public function enAction()
	{  		 	
		//  IDIOMA INGLES
		$_SESSION['language'] = "en";	
		header('Location:'.$_SESSION['url']);
	 }	 
	public function quAction()
	{  		 	
		//  IDIOMA QUECHUA 
		$_SESSION['language'] = "qu";
		header('Location:'.$_SESSION['url']);
	}
}