<?php
class ViewException extends Exception{}
class View
{	
	public $title;
	private $_path;
	private $_vars = array();
    function __construct(){
		$this->title = "Anypsa";
		$url = getUrlActual();
		if (file_exists(APP_ROOT_PATH."languages/".$_SESSION['language']."/".$_SESSION['language'].".php") && ($_SESSION['language'] != "")){
		 include(APP_ROOT_PATH."languages/".$_SESSION['language']."/".$_SESSION['language'].".php");
		}
		}
	private function _getPath(){
		$this->_path = APP_ROOT_VIEWS;
		if(!isset($this->_path))
		{ 
		throw new ViewException("No se ha definido la ruta de la vista en ".__METHOD__);
		}
		return $this->_path;
		}
    public function render($file, $vars = array())
   	    {
        //$file es el nombre de nuestra plantilla, por ej, index.php
        //$vars es el contenedor de nuestras variables, es un arreglo del tipo llave => valor, opcional.

        //Armamos la ruta al archivo
        $this->_path = $this->_getPath() . $file;
 
        //Si no existe el fichero en cuestion, lanzamos una excepcion
        if (file_exists($this->_path) == false)
        {
            throw new ViewException('el archivo: ' . $this->_path . ' no existe.', E_USER_NOTICE);
            return false;
        }
 
        //Si hay variables para asignar, las pasamos una a una.
		$this->_vars = $vars;
        if(is_array($this->_vars))
        {
			foreach ($this->_vars as $key => $value)
			{
			$$key = $value;
			}
        }
		
		//ob_start();
		//Finalmente, incluimos el archivo.
        include($this->_path);
		//return ob_get_clean();
    }
}
/*
Forma de uso:
$view = new View;
$data['nombre']='Pepe';
$view->render('index.php',$data); 
*/