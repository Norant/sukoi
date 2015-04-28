<?php
$language = (!isset($_SESSION['language']))?"es":""; 
switch ($language){
	case "es":
	$selected1 = "selected"; $selected2 = "";$selected3 = "";
	break;
	case "en":
	$selected1 = "";$selected2 = "";$selected3 = "selected";
	break;
	default:
	$selected1 = "selected"; $selected2 = "";$selected3 = "";
	break;
	}
		$logedin = false;
		$cliente = "" ? $_SESSION['cliente'] : "";
		if ($cliente != ""){
			$logedin = true;
			 $clienteModel = new ClienteModel();
	 		 $getCliente = $clienteModel->getClientForEmail($_SESSION['cliente']);
			 if ($getCliente){ $cliente = $getCliente;} else{ ?> 
			 <script>window.location.href='<?php echo HTML_PATH;?>form/logout';</script>
			 <?php }
		}
?>
<!-- start subdown -->  