<?php
require_once("Controller.php");
class ErrorController  extends Controller 
{
	public function indexAction()
	{		
	$view = APP_ROOT."/404.php";
	include($view);
	}
}

	