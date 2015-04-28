<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."IndexModel.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class ContactenosController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{  	
		$data['view']="contactenos/index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
		$data['nombre']='Mario';
		$data['variable']="<br />nueva variable";
		$this->_view->render('../layouts/layout.php',$data);  
		//$this->_view->render('test/index.php',$data);        	
	 }	 
	 
	 public function procesoAction()
		{ 
			//$name = $_POST['name'];
			//$apellido = $_POST['apellido'];
			//$email = $_POST['email'];
			//$comment = $_POST['comment'];			
		/*	if (($name != "") && ($apellido != "") && ($email != "") && ($comment != "")){
				$nombre = $name." " . $apellido;
			mail_phpmailer_masivo("Webmaster Anypsa", "noranterry@gmail.com", "Contacto vía Web", $comment, $nombre, $email, "", "");
			$_SESSION['error_contactanos'] = "<label class=\"exito\">Su Mensaje ha sido enviado Sr(a). " .$name. " " . $apellido."</label>";
			} else { $_SESSION['error_contactanos'] = "<label class=\"error\">No se ha enviado su mensaje.</label>";}*/
	
			//header("Location:".HTML_PATH."contactanos/");
			
			    //Create an array to store data that we will send back to the jQuery
    $data = array(
        'success' => false, //Flag whether everything was successful
        'errors' => array() //Provide information regarding the error(s)
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
        		case "nombres":
				if (strlen($value) < 6) {
					$msg = "Su Nombre o Razón Social debe tener más de 6 caracteres";
				} else { $nombres = secure($value);}				
				break;
        		case "correo":
        			//Use PHP filter to validate the E-Mail address
        			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        				$msg = "Debes darnos un correo válido.";
        			} else { $correo = secure($value);}
        			break;
				case "ruc":
        			//Ensure that they are both at least 4 characters long
        			if (strlen($value) == 11) {
						$ruct = secure($value);
						
						if (preg_match('/^\d+$/',$ruct)){
							$ruc = $ruct;
						}
						else {$msg = "No es un n&uacute;mero su RUC";}
        				//To make it more readable, replace the "-"'s with spaces and make the first character upper case       				
        			} else if((strlen($value) < 11) && (strlen($value) > 0)) { 
					$msg = "Tu " . str_replace("-", " ", $id) . " debe tener 11 n&uacute;meros";	
					}
					
        		break;	
				case "asunto":
        			//Ensure that they are both at least 4 characters long
        			if (strlen($value) < 4) {
        				//To make it more readable, replace the "-"'s with spaces and make the first character upper case
        				$msg = "Tu " . str_replace("-", " ", ucfirst($id)) . " debe tener más de 4 caracteres";
        			} else { $asunto = secure($value);}
        		break;
				case "mensaje":
				if (strlen($value) < 10) {
        				//To make it more readable, replace the "-"'s with spaces and make the first character upper case
        				$msg = "Tu " . str_replace("-", " ", ucfirst($id)) . " debe tener más de 10 caracteres";
        			} else { $mensaje = secure($value);}				
				break;
				case "suma-hidden":
				// aqui no mostramos mensaje
				break;
				case "suma":
				if ($value != $inputs[5]['value']){
					$msg = "suma incorrecta";
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
        //Validation over, was it successful?
        if (empty($data['errors'])) {
			if ($ruc != ""){
				$texto_ruc = '<tr><td><font color="#707070"><b>Número de RUC:</b></font></td><td> <font color="#707070">'.$ruc.'</font></td></tr>';
				} else {
				$texto_ruc = '';	
					}
				
			$msg='<table width="100%"><thead><tr><th colspan="2" align="left"><b>Mensaje enviado desde www.anypsa.com.pe</b></th></tr></thead>
<tr><td width="20%"><font color="#707070"><b>Nombre o Razón social: </b></font></td><td><font color="#707070">'.$nombres.'</font></td></tr>
<tr><td><font color="#707070"><b>Correo: </b></font></td><td><font color="#707070">'.$correo.'</font></td></tr>
<tr><td><font color="#707070"><b>Asunto:</b></font></td><td> <font color="#707070">'.$asunto.'</font></td></tr>'.$texto_ruc.'
<tr><td><font color="#707070"><b>Mensaje:</b> </font></td><td><font color="#707070">'.nl2br($mensaje).'</font></td></tr>
<tr><td><br /><br /><b>Fecha y Hora de envío: </b> </td><td><br /><br />'.date("d-m-Y H:i:s").'</td></tr>
<tr><td><b>IP: </b></td><td>'.$_SERVER['REMOTE_ADDR'].'</td></tr></table>';

			mail_phpmailer_masivo("ANYPSA", "venta@anypsa.com.pe", $asunto, $msg, $nombres, $correo, "", "");
			mail_phpmailer_masivo("ANYPSA OFICIAL", "anypsaoficial@gmail.com", $asunto, $msg, $nombres, $correo, "", "");
        	$data['success'] = true;
        }
        
    } else {
    	$data['errors'][] = "No se enviarón datos";
    }

    //Set the content type and charset to ensure the browser is expecting the correct data format, also ensure charset is set-to UTF-8 and not utf8 to prevent any IE issues
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode((object)$data); 	
		 }	 
}