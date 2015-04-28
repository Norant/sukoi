<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class RegisterclientController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{  	
		$tiporegistro = $_REQUEST['tiporegistro'];
		if (($tiporegistro != "natural") && ($tiporegistro != "juridica"))
			{
				header('location:'.HTML_PATH);
			}
		if ($tiporegistro == "natural"){
	 	$clienteModel = new ClienteModel();
		$data = array('successful' => '', 'message' => '', 'nombreclientenat' => '', 'docidnat' => '', 'numerodocnat' => '', 'numerodocnat' => '', 'correonat' => '', 'contrasenanat' => '', 'contrasena2nat' => '', 'matchclaves' => '', 'telefononat' => '', 'sumanat' => '', 'direccionnat' => '', 'distritonat' => '', 'provincianat' => '', 'departamentonat' => '', 'correo_cliente' => '', 'msg_error' => '');
		$nombreclientenat = secure(trim($_REQUEST['nombreclientenat']));
		$docidnat = secure(trim($_REQUEST['docidnat']));
		$numerodocnat = secure(trim($_REQUEST['numerodocnat']));
		$correonat = secure(trim($_REQUEST['correonat']));
		$contrasenanat = secure(trim($_REQUEST['contrasenanat']));
		$contrasena2nat = secure(trim($_REQUEST['contrasena2nat']));
		$telefononat = secure(trim($_REQUEST['telefononat']));
		$suma_hiddennat = secure(trim($_REQUEST['suma_hiddennat']));
		$sumanat = secure(trim($_REQUEST['sumanat']));
		$direccionnat = secure(trim($_REQUEST['direccionnat']));
		$distritonat = secure(trim($_REQUEST['distritonat']));
		$provincianat = secure(trim($_REQUEST['provincianat']));
		$departamentonat = secure(trim($_REQUEST['departamentonat']));
		$terminosnat = secure(trim($_REQUEST['terminosnat']));
		$boletinnat = secure(trim($_REQUEST['boletinnat']));
		//nombres y apellidos
		if (($nombreclientenat == "Ingrese su nombre y apellido") || ($nombreclientenat == "")){
		$data['nombreclientenat'] = "No haz ingresado tus nombres y apellidos";
		$data['message'] .= "error";
				} 
				else {
					/*** try to validate with the regex pattern ***/
					if(filter_var($nombreclientenat, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zñÑáéíóúÁÉÍÓÚ\s]{4,48}$/i"))) === false)							{
								/*** if there is no match ***/
								$data['nombreclientenat'] .= "Error";
								$data['message'] .= "error";
							}
					else
							{
								/*** if we match the pattern ***/
								//echo "The field is valid";
							}
					}
			// tipo de documento		
		if  ($docidnat == ""){
		$data['docidnat'] = "No haz escogido tu documento";
		$data['message'] .= "error";
				} 
			//número de documento	
		if ($numerodocnat == ""){
			$data['numerodocnat'] = "Ingresa tu n&uacute;mero de documento";
			$data['message'] .= "error";
			} else {
				if (!is_numeric($numerodocnat)){
					$data['numerodocnat'] = "Ingresa tu n&uacute;mero";
					$data['message'] .= "error";
					}
				}	
			//correo	
		if (($correonat == "") || ($correonat == "Ingrese su correo"))
		{
			$data['correonat'] = "Ingresa tu correo";
			$data['message'] .= "error";
		} else {
			if ($correonat != "")
			{
					if (!filter_var($correonat, FILTER_VALIDATE_EMAIL)) {
						$data['correonat'] .= "Debes darnos un correo válido.";
						$data['message'] .= "error";
					}
			}
		}
		//contraseñas
		if (($contrasenanat == "") || ($contrasenanat == "Ingrese contraseña")){
			$data['contrasenanat'] = "Ingrese su contraseña";
			$data['message'] .= "error";
			} 
			else{
			
			if (strlen($contrasenanat) < 6)	{
					$data['contrasenanat'] = "Su contraseña debe tener m&iacute;nimo 6 caracteres";
					$data['message'] .= "error";
				}
			if (strlen($contrasenanat) > 12)	{
					$data['contrasenanat'] = "Su contraseña debe tener m&aacute;ximo 12 caracteres";
					$data['message'] .= "error";
				}	
			}
			
			
		if (($contrasena2nat == "") || ($contrasena2nat == "Repita contraseña")){
			$data['contrasena2nat'] = "Ingrese su contraseña";
			$data['message'] .= "error";
			}
			else{
			
			if (strlen($contrasena2nat) < 6)	{
					$data['contrasena2nat'] = "Su contraseña debe tener m&iacute;nimo 6 caracteres";
					$data['message'] .= "error";
				}
			if (strlen($contrasena2nat) > 12)	{
					$data['contrasena2nat'] = "Su contraseña debe tener m&aacute;ximo 12 caracteres";
					$data['message'] .= "error";
				}	
			}
			
							
			if ($contrasenanat != $contrasena2nat){
				$data['matchclaves'] .= "Las contraseñas no coinciden";
				$data['message'] .= "error";
				}
			//telefono
			if (($telefononat == "") || ($telefononat == "Ingrese su telefono")){
				$data['telefononat'] = "Ingrese su tel&eacute;fono";
				$data['message'] .= "error";
			} else {
				if (strlen($telefononat) < 6){
					$data['telefononat'] = "N&uacute;mero muy corto";
					$data['message'] .= "error";
					} else {
							
					if (!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $telefononat)) { 
							$data['telefononat'] = "Error";
							$data['message'] .= "error";
							}
						}		
				if (strlen($telefononat) > 28){
					$data['telefononat'] = "N&uacute;mero muy largo";
					$data['message'] .= "error";
					}else{
							
					if (!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $telefononat)) { 
							$data['telefononat'] = "Error";
							$data['message'] .= "error";
							}
						}			
				}
				// captcha
			if ($suma_hiddennat != $sumanat){
			$data['sumanat'] = "Suma incorrecta";
			$data['message'] .= "error";
			}	
			//direccion
		if (($direccionnat == "") || ($direccionnat == "Ingrese su dirección")){
				$data['direccionnat'] = "No haz ingresado tu direcci&oacute;n";
				$data['message'] .= "error";
			} else { 
				if (strlen($direccionnat) < 3){
					$data['direccionnat'] = "muy corto";
					$data['message'] .= "error";
				}
			 }	
			//distrito
		if (($distritonat == "") || ($distritonat == "Ingrese su distrito")){
			$data['distritonat'] = "No haz ingresado tu distrito";
			$data['message'] .= "error";
		}	 else { 
				if (strlen($distritonat) < 3){
					$data['distritonat'] = "muy corto";
					$data['message'] .= "error";
				}
			 }	
		//provincia
		if (($provincianat == "") || ($provincianat == "Ingrese su provincia")){
			$data['provincianat'] = "No haz ingresado tu provincia";
			$data['message'] .= "error";
		}else { 
				if (strlen($provincianat) < 3){
					$data['provincianat'] = "muy corto";
					$data['message'] .= "error";
				}
			 }		
			//departamento	
		if (($departamentonat == "") || ($departamentonat == "Ingrese su departamento")){
			$data['departamentonat'] = "No haz ingresado tu departamento";
			$data['message'] .= "error";
		}else { 
				if (strlen($departamentonat) < 3){
					$data['departamentonat'] = "muy corto";
					$data['message'] .= "error";
				}
			 }
		
		if (($nombreclientenat != "") && ($docidnat != "") && ($numerodocnat != "") && ($correonat != "") && ($contrasenanat != "") && ($contrasena2nat != "") && ($telefononat != "")  && ($suma_hiddennat != "") && ($sumanat != "") && ($direccionnat != "") && ($distritonat != "") && ($provincianat != "") && ($departamentonat != "") && ($terminosnat != "") && ($boletinnat != "")){

			if ($data['message'] == ""){
				
				$searchTypeAndNumberDoc = $clienteModel->searchTypeAndNumberDocClient($numerodocnat, $docidnat);
				$searchMailClient = $clienteModel->searchMailAddressClient($correonat);
				if (!$searchTypeAndNumberDoc)
				{
					
				if (!$searchMailClient)
				{
				$confirm_code = substr(md5(uniqid(rand(), true)), 16, 16);
				$url = HTML_PATH.'confirmregister?passkey=' . urlencode($confirm_code);

				$msg = '<center><table width="100%" bgcolor="#F9F9F9"><tr><td>&nbsp;</td></tr><tr><td bgcolor="#0042AD" height="50"><center><font size="6" face="Arial, Helvetica, sans-serif" color="#ffffff"><strong>ANYPSA PER&Uacute;</strong></font></center></td></tr><tr><td bgcolor="#F9F9F9" height="20">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF"><center><font size="4" face="Arial, Helvetica, sans-serif" color="#818181"><b>'.$nombreclientenat.'</b>  solo le queda un paso m&aacute;s para completar su proceso de registro:</font></center><br /><br /></td></tr><tr><td bgcolor="#FFFFFF"><center><font color="#818181"><a href="' . $url . '"><font face="Arial, Helvetica, sans-serif" color="#0042AD">Para activar su cuenta haga clic Aqu&iacute;</font></a></font></center><br /><br /></td></tr><tr><td>Lea nuestro: <a href="http://www.anypsa.com.pe/aviso_de_privacidad/"><font>Aviso de Privacidad</font></a></td></tr></table></center>';

				$enviomail = mail_phpmailer_masivo($nombreclientenat, $correonat, "Activa tu registro en ANYPSA", $msg, "ANYPSA", "webadministrator@anypsa.com.pe", "", "");
									
				if ($enviomail == "ok"){
					
					$saveClient = $clienteModel->registerNaturalClient($nombreclientenat, $docidnat, $numerodocnat, $correonat, $contrasenanat, $telefononat,  $direccionnat, $distritonat, $provincianat, $departamentonat, $boletinnat, $confirm_code);	
							if ($saveClient){								
									$data['correo_cliente'] = $correonat; 
									$data['successful'] = "Y";
							} else { 
									$data['msg_error'] = "No se guardar&oacute;n sus datos, int&eacute;ntelo m&aacute;s tarde.";	
							 }	
								}
					else {  
							$data['msg_error'] = "Tenemos problemas técnicos, int&eacute;ntelo m&aacute;s tarde, gracias.";
					     }		
				
				} else {
					$data['msg_error'] = "Usted ya se ha registrado anteriormente.";
					$data['message'] .= "ingreso de persona natural duplicado";
					}
				} else {
					$data['msg_error'] = "Usted ya se ha registrado anteriormente.";
					$data['message'] .= "ingreso de persona natural duplicado";
					}
			}
			
			}  else{
		$data['successful'] = "N";
		$data['message'] .= "Campos Vaci&oacute;s";
			}
		 header("Content-Type: application/json; charset=UTF-8");
    	 echo json_encode((object)$data); 
	
		}
		if ($tiporegistro == "juridica"){
			$clienteModel = new ClienteModel();
		$data = array('successful' => '', 'message' => '', 'razonsocial' => '', 'ruc' => '', 'tipodocreplegal' => '', 'numerodocreplegal' => '', 'representantelegal' => '', 'correo' => '', 'contrasena' => '', 'contrasena2' => '', 'matchclaves' => '', 'telefono' => '', 'suma' => '', 'direccion' => '', 'distrito' => '', 'provincia' => '', 'departamento' => '', 'correo_cliente' => '', 'msg_error' => '');
		
		$razonsocial = secure(trim($_REQUEST['razonsocial']));
		$ruc = secure(trim($_REQUEST['ruc']));
		$correo = secure(trim($_REQUEST['correo']));
		$contrasena = secure(trim($_REQUEST['contrasena']));
		$contrasena2 = secure(trim($_REQUEST['contrasena2']));
		$telefono = secure(trim($_REQUEST['telefono']));
		$suma_hidden = secure(trim($_REQUEST['suma_hidden']));
		$suma = secure(trim($_REQUEST['suma']));
		$direccion = secure(trim($_REQUEST['direccion']));
		$distrito = secure(trim($_REQUEST['distrito']));
		$provincia = secure(trim($_REQUEST['provincia']));
		$departamento = secure(trim($_REQUEST['departamento']));
		$representantelegal = secure(trim($_REQUEST['representantelegal']));
		$tipodocreplegal = secure(trim($_REQUEST['tipodocreplegal']));
		$numerodocreplegal = secure(trim($_REQUEST['numerodocreplegal']));		
		$terminos = secure(trim($_REQUEST['terminos']));
		$boletin = secure(trim($_REQUEST['boletin']));
		
		if (($razonsocial == "Ingrese su Razón Social") || ($razonsocial == ""))
			{
				$data['razonsocial'] = "No ha ingresado la raz&oacute;n social";
				$data['message'] .= "error";
			} 
			
		if (($ruc == "Ingrese su número de RUC") || ($ruc == ""))
			{
				$data['ruc'] = "No ha ingresado su RUC";
				$data['message'] .= "error";
			}
	    else {
				 if ((strlen($ruc) != 11) || (!is_numeric($ruc)))
				 	{
						$data['ruc'] = "Ingrese su RUC";
						$data['message'] .= "error";
					}		
			} 
		//correo	
		if (($correo == "") || ($correo == "Ingrese su correo"))
		{
			$data['correo'] = "Ingresa tu correo";
			$data['message'] .= "error";
		} else {
			if ($correo != "")
			{
					if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) 
						{
							$data['correo'] .= "Debes darnos un correo válido.";
							$data['message'] .= "error";
						}
			}
		}	
			
		//contraseñas
		if (($contrasena == "") || ($contrasena == "Ingrese contraseña")){
			$data['contrasena'] = "Ingrese su contraseña";
			$data['message'] .= "error";
			} 
			else{
			
			if (strlen($contrasena) < 6)	{
					$data['contrasena'] = "Su contraseña debe tener m&iacute;nimo 6 caracteres";
					$data['message'] .= "error";
				}
			if (strlen($contrasena) > 12)	{
					$data['contrasena'] = "Su contraseña debe tener m&aacute;ximo 12 caracteres";
					$data['message'] .= "error";
				}	
			}
			
			
		if (($contrasena2 == "") || ($contrasena2 == "Repita su Contraseña")){
			$data['contrasena2'] = "Ingrese su contraseña";
			$data['message'] .= "error";
			}
			else{
			
			if (strlen($contrasena2) < 6)	{
					$data['contrasena2'] = "Su contraseña debe tener m&iacute;nimo 6 caracteres";
					$data['message'] .= "error";
				}
			if (strlen($contrasena2) > 12)	{
					$data['contrasena2'] = "Su contraseña debe tener m&aacute;ximo 12 caracteres";
					$data['message'] .= "error";
				}	
			}
			
							
			if ($contrasena != $contrasena2){
				$data['matchclaves'] .= "Las contraseñas no coinciden";
				$data['message'] .= "error";
				}
				
		//telefono
			if (($telefono == "") || ($telefono == "Ingrese Teléfono")){
				$data['telefono'] = "Ingrese su tel&eacute;fono";
				$data['message'] .= "error";
			} else {
				if (strlen($telefono) < 6){
					$data['telefono'] = "N&uacute;mero muy corto";
					$data['message'] .= "error";
					} else {
							
					if (!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $telefono)) { 
							$data['telefono'] = "Error";
							$data['message'] .= "error";
							}
						}		
				if (strlen($telefono) > 28){
					$data['telefono'] = "N&uacute;mero muy largo";
					$data['message'] .= "error";
					}else{
							
					if (!preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $telefono)) { 
							$data['telefono'] = "Error";
							$data['message'] .= "error";
							}
						}			
				}
				
		// captcha
			if ($suma_hidden != $suma){
			$data['suma'] = "Suma incorrecta";
			$data['message'] .= "error";
			}
						
			//direccion
		if (($direccion == "") || ($direccion == "Ingrese dirección")){
				$data['direccion'] = "No haz ingresado tu direcci&oacute;n";
				$data['message'] .= "error";
			} else { 
				if (strlen($direccion) < 3){
					$data['direccion'] = "muy corto";
					$data['message'] .= "error";
				}
			 }	
			//distrito
		if (($distrito == "") || ($distrito == "Ingrese distrito")){
			$data['distrito'] = "No haz ingresado tu distrito";
			$data['message'] .= "error";
		}	 else { 
				if (strlen($distrito) < 3){
					$data['distrito'] = "muy corto";
					$data['message'] .= "error";
				}
			 }	
		//provincia
		if (($provincia == "") || ($provincia == "Ingrese provincia")){
			$data['provincia'] = "No haz ingresado tu provincia";
			$data['message'] .= "error";
		}else { 
				if (strlen($provincia) < 3){
					$data['provincia'] = "muy corto";
					$data['message'] .= "error";
				}
			 }		
			//departamento	
		if (($departamento == "") || ($departamento == "Ingrese departamento")){
			$data['departamento'] = "No haz ingresado tu departamento";
			$data['message'] .= "error";
		}else { 
				if (strlen($departamento) < 3){
					$data['departamento'] = "muy corto";
					$data['message'] .= "error";
				}
			 }
			 
		//nombres y apellidos de representante legal
		if (($representantelegal == "Ingrese Nombres y Apellidos") || ($representantelegal == "")){
		$data['representantelegal'] = "No ha ingresado nombres y apellidos";
		$data['message'] .= "error";
				} 
				else {
					/*** try to validate with the regex pattern ***/
					if(filter_var($representantelegal, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zñÑáéíóúÁÉÍÓÚ\s]{4,48}$/i"))) === false)							{
								/*** if there is no match ***/
								$data['representantelegal'] .= "Error";
								$data['message'] .= "error";
							}
					else
							{
								/*** if we match the pattern ***/
								//echo "The field is valid";
							}
					}
			// tipo de documento de representante legal		
		if  ($tipodocreplegal == ""){
		$data['tipodocreplegal'] = "No ha escogido tipo de documento";
		$data['message'] .= "error";
				} 
				
			//número de documento de representante legal
		if ($numerodocreplegal == ""){
			$data['numerodocreplegal'] = "Ingrese N&uacute;mero de Documento";
			$data['message'] .= "error";
			} else {
				if (!is_numeric($numerodocreplegal)){
					$data['numerodocreplegal'] = "Ingresa tu n&uacute;mero";
					$data['message'] .= "error";
					}
				}
		if ($data['message'] == ""){
			
			$searchRucClient = $clienteModel->searchRucClient($ruc);
			$searchMailClient = $clienteModel->searchMailAddressClient($correo);
			if (!$searchRucClient){
				if (!$searchMailClient){
			$confirm_code = substr(md5(uniqid(rand(), true)), 16, 16);
			$url = HTML_PATH.'confirmregister?passkey=' . urlencode($confirm_code);

				$msg = '<center><table width="100%" bgcolor="#F9F9F9"><tr><td>&nbsp;</td></tr><tr><td bgcolor="#0042AD" height="50"><center><font size="6" face="Arial, Helvetica, sans-serif" color="#ffffff"><strong>ANYPSA PER&Uacute;</strong></font></center></td></tr><tr><td bgcolor="#F9F9F9" height="20">&nbsp;</td></tr><tr><td bgcolor="#FFFFFF"><center><font size="4" face="Arial, Helvetica, sans-serif" color="#818181"><b>'.$representantelegal.'</b>  solo le queda un paso m&aacute;s para completar su proceso de registro:</font></center><br /><br /></td></tr><tr><td bgcolor="#FFFFFF"><center><font color="#818181"><a href="' . $url . '"><font face="Arial, Helvetica, sans-serif" color="#0042AD">Para activar su cuenta haga clic Aqu&iacute;</font></a></font></center><br /><br /></td></tr><tr><td>Lea nuestro: <a href="http://www.anypsa.com.pe/aviso_de_privacidad/"><font>Aviso de Privacidad</font></a></td></tr></table></center>';

				$enviamail = mail_phpmailer_masivo($representantelegal, $correo, "Activa tu registro en ANYPSA", $msg, "ANYPSA", "webadministrator@anypsa.com.pe", "", "");
			if ($enviamail == "ok"){
				
				$saveClient = $clienteModel->registerJuridicClient($razonsocial, $ruc, $correo, $contrasena, $telefono, $direccion, $distrito, $provincia, $departamento, $boletin, $representantelegal, $tipodocreplegal, $numerodocreplegal, $confirm_code);	
			if ($saveClient){
				
				
				
					$data['correo_cliente'] = $correo; 
					$data['successful'] = "Y";}
			else { 
					$data['msg_error'] = "No se guardar&oacute;n sus datos, int&eacute;ntelo m&aacute;s tarde.";	
				 }		
				
			}
		}  
		else {
			$data['msg_error'] = "El correo que est&aacute; usando ya se encuentra registrado, use otro.";
					$data['message'] .= "ingreso de persona juridica duplicado";		 
		     }
			}	
			else {
			$data['msg_error'] .= "Esta empresa ya est&aacute; registrada en nuestra base de datos.";
					$data['message'] .= "ingreso de persona juridica duplicado";		 
		     }
		}
								
		header("Content-Type: application/json; charset=UTF-8");
    	 echo json_encode((object)$data); 		
			}
		
	 }	 	 
}