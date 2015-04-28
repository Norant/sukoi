<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class FormController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function Client_accessAction()
	{  			 
		 $data = array(
        'success' => false, //Flag whether everything was successful
        'errors' => array(), //Provide information regarding the error(s)
		'url' => '',   // necesario para redirigir al cliente a la url de donde provino
		'razonsocial_cliente' => ''   // mostramos la razón social del cliente
    );
    //Check to make sure that the inputs variable has been posted
    if (isset($_POST['inputs'])) {
    	//Store the posted data into an array
        $inputs = $_POST['inputs'];
        //Loop through each input field
        foreach ($inputs as $input) {
			$msg = "";
        	$id = $input['id'];
        	$value = $input['value'];
        	//Determine what validation we need to be doing
        	switch($id) {
        		//Username and real name need the same validation, so only need one case block here
        		case "correo":
				if (strlen($value) < 6) {
					$msg = "usuario incorrecto";
				} else { $correo = secure($value);}				
				break;
        		case "pass":
        			if (strlen($value) < 40) {
        				$msg = "Contraseña incorrecta.";
        			} else { 
					
					$clave = secure($value);
					}
        			break;
				case "access_token":
        			if (strlen($value) < 6) {
        				$msg = "Error.";
        			} else { 

					}
        			break;	
					case "url":
        			if (strlen($value) < 13) {
        				$msg = "Error.";
        			} else { 
					$url = $value;
					if(!filter_var($url, FILTER_VALIDATE_URL))
					  {
					 $msg = "Error.";
					  }
					else
					  {
					
					  }
					}
        			break;	
					
        		default:
        			//If some field has been passed over, we report the error
        			$msg = "Disculpe, datos corruptos, inténtelo nuevamente.";
        			break;
        	}
        	//If there is an error, add it to the errors array with the field id
        	if (!empty($msg)) {
	        	$data['errors'][] = array(
	        		'msg' => $msg,
	        		'field' => $id
	        	);
        	}
        }
		 if (($correo != "") && ($clave != "")){
			 $clienteModel = new ClienteModel();
			 $validar = $clienteModel->validarCliente($correo, $clave); // buscamos en la base de datos			 
		 	 unset($_SESSION['access_token']);//limpiamos el token consumido
			 $_SESSION['access_token'] = generate_token();	// generamos un nuevo token para otra petición
			 							       }
		 if ($validar)
		 {
			 session_regenerate_id(true);// regeneramos el id de sesion para evitar ataques por fijamiento de sesion
			 $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; // registramos en sesion el agente de usuario para prevenir session hijacking
			 $_SESSION['cliente'] = $validar->correo_cliente;	// encriptamos la variable de sesion que se comprobara para acceder a informacion restringida
		 } else{ $data['errors'][] = array(
	        		'msg' => 'Usuario no encontrado',
	        		'field' => 'Error'
	        	);
				$data['errors']['token'] = $_SESSION['access_token'];	
				}	
			 										
        //Validation over, was it successful?
        if (empty($data['errors'])) {
			//mail_phpmailer_masivo("Webmaster Anypsa", "noranterry@gmail.com", "$asunto", $mensaje, $nombres, $correo, "", "");  // aqui enviamos el email
        	$data['success'] = true;
			$data['url'] = $url;
			 if ($validar->razonsocial_cliente != ""){
				 $data['razonsocial_cliente'] = $validar->razonsocial_cliente;} else {
					 $data['razonsocial_cliente'] = $validar->nombre_cliente;
					 }
			
        }
        
    } else {
    	$data['errors'][] = "No se enviarón datos";
    }
	
    //Set the content type and charset to ensure the browser is expecting the correct data format, also ensure charset is set-to UTF-8 and not utf8 to prevent any IE issues
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode((object)$data); 	
	
	 }
	 
	public function logoutAction()
	{
		unset($_SESSION['cliente']);
		$_SESSION['cliente'] = "";
		header('Location:'.HTML_PATH);
		//$data['view'] = "saf/login.php"; // Seteamos la vista
		//$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista	
	}
		 	
}