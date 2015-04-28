<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class ConfirmregisterController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{  	
		if ($_GET['passkey'] != ""){
		$passkey = secure($_GET['passkey']);
		}
		if ($passkey != ""){
			$clienteModel = new ClienteModel();
			$validateCode = $clienteModel->validateConfirmCodeClient($passkey);
			if ($validateCode){
				$cliente = $clienteModel->getClientForConfirmCode($passkey);
				if ($cliente){
					$activarcliente = $clienteModel->activateAccountClient($passkey);
					if ($activarcliente){
						$data['clientemensaje'] = "ok";
						
						}
					} else {
						$data['clientemensaje'] = "";	
						}
				$data['cliente'] = $cliente;	
				
				$data['mensaje'] = "su registro ha sido completado satisfactoriamente.";
				
				} else {
					$data['clientemensaje'] = "";
					$data['mensaje'] = ": <font color=\"#FF4325\">ha ocurrido un error env&iacute;e un email a <a href='mailto:anypsaoficial@gmail.com'>anypsaoficial@gmail.com</a> con los detalles de su registro, disculpe por los inconvenientes.</font>";
					}
			$data['view']="cliente/mensaje.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT			
			$this->_view->render('../layouts/layout.php',$data);  
				//$this->_view->render('test/index.php',$data);        			
			
			} else {
				header('Location:'.HTML_PATH);
				}
			 	
		
	 }		 
}