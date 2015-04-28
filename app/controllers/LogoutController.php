<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."SafModel.php");

class LogoutController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{
		$subaction = isset($_GET['subaction']) ? $_GET['subaction'] : "";
		$verifiedToken = verifyActionToken('logout', $subaction);
		if ($verifiedToken){			
		if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		unset($_SESSION['admin']);
		session_unset();
        session_destroy();
		$data['no_visible_elements']=true;
		$data['view'] = "login.php"; // Seteamos la vista
		$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista
		} else {
		unset($_SESSION['admin']);
		session_unset();
        session_destroy();
		$data['no_visible_elements'] = true;
		$data['view'] = "login.php"; // Seteamos la vista
		$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista
			}
	}	
}