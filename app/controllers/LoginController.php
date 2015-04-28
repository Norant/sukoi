<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."SafModel.php");

class LoginController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{
		if ($_POST){
		$usuario = isset($_POST['usuario']) ? stringSeguro($_POST['usuario']) : "";
		$clave = isset($_POST['clave']) ? stringSeguro($_POST['clave']) : "";
		$token = array();
		if (!empty($_POST['auth_token'])) {
        $token = unserialize($_POST['auth_token']);
		}
		if (($usuario != "") && ($clave != "") && (isset($token))){	 
			 $safModel = new SafModel();
			 $testToken = verifyFormToken('validation', $token, 300);
			if($testToken){
			 $validar = $safModel->validarAdministrador($usuario, $clave); // buscamos en la base de datos
						}
		 }
		 if (isset($validar) && ($validar === TRUE))
		 {
			 $_SESSION['admin'] = sha1($usuario);
			 $_SESSION['token'] = generateAccessToken('oauth');	
			// $this->backupAction();	//hacemos backup de la bd cada vez que entra el admin, debe luego implementarse en un cronjob y enviar el .sql a un email	
			$data['no_visible_elements']=false; 
			header('Location:'.HTML_PATH.'index'); 
		 } 

		
		if (isset($_SESSION['admin']))
		{
			//$safModel = new SafModel();
			/*$marcas = $safModel->getAllMarcas();
			$data['marcas'] = $marcas;
			$data['view'] = "saf/index.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista */
		} 
		else {
			$this->logoutAction();
			 }		

			
		//$data['view']="login.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
		$data['no_visible_elements']=true;
		//$this->_view->render('../layouts/layout.php',$data);  
		//$this->_view->render('test/index.php',$data);
		} else {$data['no_visible_elements']=true; 
			$data['view'] = "login.php"; // Seteamos la vista
			$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista  	 
			}
	}
	
	public function logoutAction()
	{
		header('Location:'.HTML_PATH.'logout');	
		/*unset($_SESSION['admin']);
		$_SESSION['admin'] = "";
		$data['no_visible_elements']=true;
		$data['view'] = "login.php"; // Seteamos la vista
		$this->_view->render('../layouts/layout.php',$data);  */ // renderizamos la vista	
	}		 				
}