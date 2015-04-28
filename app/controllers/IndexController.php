<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."IndexModel.php");
require(APP_ROOT_MODELS."SafModel.php");
class IndexController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{ 
	if (isset($_SESSION['admin']))
		{
			$data['view']="index.php"; //MODO DE INCLUIR UNA VISTA DENTRO DEL LAYOUT	
			$this->_view->render('../layouts/layout.php',$data);  

			}else {
				header('Location:'.HTML_PATH.'login');
				 }	        	
	 }
	 //NOTICIAS
	public function nueva_noticiaAction()
		{
			if (isset($_SESSION['admin']))
			{
				$safModel = new SafModel();
				$data['colegioslima'] = $safModel->getSeatsSchoolLima();
				$data['academiaslima'] = $safModel->getSeatsAcademyLima();
				$data['colegiosprovincia'] = $safModel->getSeatsSchoolProvince();
				$data['academiasprovincia'] = $safModel->getSeatsAcademyProvince();
				$data['no_visible_elements']=false;
				$data['view'] = "noticia/nueva_noticia.php"; // Seteamos la vista
				$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
			} 
			else {
				$this->logoutAction();
				 }		
		}
		
	public function guardar_noticiaAction()
	{
		$error = isset($error) ? $error : "";
		$safModel = new SafModel();
		$id_sede = $_POST['sede'];
		$titulo_noticia = $_POST['titulo_noticia'];
		$sinopsis_noticia = $_POST['sinopsis_noticia'];
		$imagen_noticia = isset($imagen_noticia) ? "" : $_FILES['imagen_noticia']['name'];
		$video_noticia = $_POST['video_noticia'];
		$html_noticia = $_POST['html_noticia'];
		$linkevento_noticia = $_POST['linkevento_noticia'];
		$fecha_noticia = "";
		$url_noticia = inc_formatea_cadena_get($titulo_noticia);
		$url_noticia = str_replace('Á','a',$url_noticia);
		$url_noticia = str_replace('É','e',$url_noticia);
		$url_noticia = str_replace('Í','i',$url_noticia);
		$url_noticia = str_replace('Ó','o',$url_noticia);
		$url_noticia = str_replace('Ú','u',$url_noticia);
		$url_noticia = str_replace('á','a',$url_noticia);
		$url_noticia = str_replace('é','e',$url_noticia);
		$url_noticia = str_replace('í','i',$url_noticia);
		$url_noticia = str_replace('ó','o',$url_noticia);
		$url_noticia = str_replace('ú','u',$url_noticia);
		$url_noticia = str_replace('Ñ','n',$url_noticia);
		$url_noticia = str_replace('ñ','n',$url_noticia);
		$url_noticia = str_replace('&','and',$url_noticia);
		$url_noticia = str_replace('?','',$url_noticia);
		$url_noticia = str_replace('¿','',$url_noticia);
		$url_noticia = str_replace('-','-',$url_noticia);
		$url_noticia = str_replace('#','',$url_noticia);
		$url_noticia = str_replace('|','',$url_noticia);
		$url_noticia = str_replace(',','',$url_noticia);
		$url_noticia = str_replace('°','',$url_noticia);
		$url_noticia = str_replace('!','',$url_noticia);
		$url_noticia = str_replace('¡','',$url_noticia);
		$url_noticia = str_replace('.','',$url_noticia);
		$url_noticia = str_replace('(','',$url_noticia);
		$url_noticia = str_replace(')','',$url_noticia);
		$url_noticia = str_replace('"','',$url_noticia);
		$url_noticia = str_replace('”','',$url_noticia);
		$url_noticia = str_replace('“','',$url_noticia);
		$url_noticia = str_replace('�','',$url_noticia);
		$url_noticia = str_replace(':','',$url_noticia);
		$aleatorio = random_numbers(5);
		$url_noticia = stripslashes($url_noticia."-".$aleatorio);
	   
		$check_url_noticia = $safModel->checkUrlNotice($url_noticia);
		$published = isset($_POST['published']) ? $_POST['published'] : "";
		if ($published == ""){ $published_noticia = "0"; } else { $published_noticia = "1";}
			$position_noticia = $safModel->getMaxPositionNotice() + 1;
			if (($titulo_noticia =! "") && ($check_url_noticia === FALSE)){
				$insertarNoticia = $safModel->saveNotice($id_sede, $_POST['titulo_noticia'], $sinopsis_noticia, $imagen_noticia, $video_noticia, $html_noticia, $fecha_noticia, $url_noticia, $linkevento_noticia, $position_noticia, $published);	
					$respuesta = $respuesta = $_SESSION['respuesta']?"":"";
					if ($insertarNoticia){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La noticia <strong>".$_POST['titulo_noticia']."</strong> se guardó correctamente.
						</div>";
		} else {
			$error .= "Fallo con el metodo saveNotice";
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la noticia ".$_POST['titulo_noticia'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}									
		?>
		 <!-- <script type="text/javascript"> window.location="index/nueva_noticia"; </script> -->
         <?php
			}
			else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre.";
			$respuesta = $respuesta = $_SESSION['respuesta']?"":""; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}
		$_SESSION['respuesta'] = $respuesta;
		?>
        <script type="text/javascript"> window.location="<?php echo HTML_PATH;?>index/nueva_noticia"; </script> 
        <?php
		}	
		
		public function noticiasAction()
			{
				if (isset($_SESSION['admin']))
				{
					$safModel = new SafModel();
					$data['noticias'] = $safModel->getAllNotices();
					$data['no_visible_elements']=false;
					$data['view'] = "noticia/noticias.php"; // Seteamos la vista
					$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
				} 
				else {
					$this->logoutAction();
					 }		
			}
			
			public function editar_noticiaAction()
			{
				if (isset($_SESSION['admin']) && ($_GET['subaction'] != ""))
				{
					$safModel = new SafModel();
					$data['sedes'] = $safModel->getSeats();
					$data['noticia'] = $safModel->getNoticeForId($_GET['subaction']);
					$data['no_visible_elements']=false;
					$data['view'] = "noticia/editar_noticia.php"; // Seteamos la vista
					$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
				} 
				else {
					$this->logoutAction();
					 }		
			}	
		
			//@ reorden de posicion de las noticias
	public function upnoticiaAction()
		{
			$id_table = $_GET['subaction'];
			 $safModel = new SafModel();
			 $subir = $safModel->orderUpRegister("noticia",$id_table);
			 return $subir;
			// $_SESSION['mensaje'] = $subir;	
		}
			
		public function downnoticiaAction()
		{
			$id_table = $_GET['subaction']; 
			 $safModel = new SafModel();
			 $bajar = $safModel->orderDownRegister("noticia",$id_table);
			 echo $bajar;
			// $_SESSION['mensaje'] = $bajar;	
		}
		// ACTION PARA DETECTAR LA IMAGEN DE LAS NOTICIAS
		public function checkfileinstaticserverAction()
		{
			$staticserver = empty($staticserver) ? "http://static.trilce.edu.pe/web/noticias/fotos-noticias/" : "";
			$urlfile = isset($_POST['url']) ? $_POST['url'] : "";
			if ($urlfile != ""){
			$check = empty($check) ? checkFileInRemoteServer($staticserver . $_POST['url']) : FALSE;
			if ($check){ echo "<div class=\"alert alert-success span5\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Ok!</strong> Im&aacute;gen detectada en servidor est&aacute;tico.
						</div> ";
						echo "<img src=\"http://static.trilce.edu.pe/web/noticias/fotos-noticias/".$_POST['url']."\" width=\"100\">";
						} else { echo "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> im&aacute;gen no detectada en servidor est&aacute;tico
						</div> ";}	
				} else {  echo "<div class=\"alert alert-error span5\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No ha seleccionado una im&aacute;gen
						</div> ";}	
			}
			
		// ACTION PARA DETECTAR LA IMAGEN THUMB DE LAS NOTICIAS
		public function checkfilethuminstaticserverAction()
		{
			$staticserver = empty($staticserver) ? "http://static.trilce.edu.pe/web/noticias/videos/" : "";
			$urlfile = empty($urlfile) ? $_POST['url'] : "";
			if ($urlfile != ""){
			$check = empty($check) ? checkFileInRemoteServer($staticserver . $_POST['url']) : FALSE;
			if ($check){ echo "<div class=\"alert alert-success span5\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Ok!</strong> video detectado en servidor est&aacute;tico.
						</div> ";
						echo "<video><source=\"http://static.trilce.edu.pe/web/noticias/videos/".$_POST['url']." type=\"video/mp4; codecs=\"avc1.42E01E, mp4a.40.2\"\"></video>";
						} else { echo "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> im&aacute;gen no detectada en servidor est&aacute;tico
						</div> ";}	
				} else {  echo "<div class=\"alert alert-error span5\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No ha seleccionado una im&aacute;gen
						</div> ";}	
			}
		public function editnoveltyAction()
		{
			if (($_POST) && (isset($_SESSION['admin']))){
			$error = "";
			$respuesta = "";
			$published = "";
			$id_noticia = isset($_POST['id_noticia']) ? $_POST['id_noticia'] : "";
			$id_sede = isset($_POST['id_sede']) ? $_POST['id_sede'] : "";
			$titulo_noticia = isset($_POST['titulo_noticia']) ? $_POST['titulo_noticia'] : "";
			$titulo_noticia_hidden = isset($_POST['titulo_noticia_hidden']) ? $_POST['titulo_noticia_hidden'] : "";
			$url_noticia_hidden = isset($_POST['url_noticia_hidden']) ? $_POST['url_noticia_hidden'] : "";
			$sinopsis_noticia = isset($_POST['sinopsis_noticia']) ? $_POST['sinopsis_noticia'] : "";
			$html_noticia = isset($_POST['html_noticia']) ? $_POST['html_noticia'] : "";
			$linkevento_noticia = isset($_POST['linkevento_noticia']) ? $_POST['linkevento_noticia'] : "";
			$published = (isset($_POST['published'])) ? $_POST['published'] : "";
			$imagen_noticia = ($_FILES['imagen_noticia']['name'] != "") ? $_FILES['imagen_noticia']['name'] :  $_POST['hidden_imagen'];
			//$imagen_thumb_noticia = ($_FILES['imagen_thumb_noticia']['name']) ? $_FILES['imagen_thumb_noticia']['name'] : $_POST['hidden_imagen_thumb'];
			//if ($imagen_noticia != $imagen_thumb_noticia){ $error .= "el nombre de las imágenes no coincide";}
			$video_noticia = isset($_POST['video_noticia']) ? $_POST['video_noticia'] : "";
			if ($titulo_noticia != $titulo_noticia_hidden){
			$url_noticia = inc_formatea_cadena_get($titulo_noticia);
			$url_noticia = str_replace('Á','a',$url_noticia);
			$url_noticia = str_replace('É','e',$url_noticia);
			$url_noticia = str_replace('Í','i',$url_noticia);
			$url_noticia = str_replace('Ó','o',$url_noticia);
			$url_noticia = str_replace('Ú','u',$url_noticia);
			$url_noticia = str_replace('á','a',$url_noticia);
			$url_noticia = str_replace('é','e',$url_noticia);
			$url_noticia = str_replace('í','i',$url_noticia);
			$url_noticia = str_replace('ó','o',$url_noticia);
			$url_noticia = str_replace('ú','u',$url_noticia);
			$url_noticia = str_replace('Ñ','n',$url_noticia);
			$url_noticia = str_replace('ñ','n',$url_noticia);
			$url_noticia = str_replace('&','and',$url_noticia);
			$url_noticia = str_replace('?','',$url_noticia);
			$url_noticia = str_replace('¿','',$url_noticia);
			$url_noticia = str_replace('-','-',$url_noticia);
			$url_noticia = str_replace(',','',$url_noticia);
			$url_noticia = str_replace('#','',$url_noticia);
			$url_noticia = str_replace('|','',$url_noticia);
			$url_noticia = str_replace('°','',$url_noticia);
			$url_noticia = str_replace('!','',$url_noticia);
			$url_noticia = str_replace('¡','',$url_noticia);
			$url_noticia = str_replace('.','',$url_noticia);
			$url_noticia = str_replace('(','',$url_noticia);
			$url_noticia = str_replace(')','',$url_noticia);
			$url_noticia = str_replace('"','',$url_noticia);
			$url_noticia = str_replace('”','',$url_noticia);
			$url_noticia = str_replace('“','',$url_noticia);
			$url_noticia = str_replace('�','',$url_noticia);
			$url_noticia = str_replace(':','',$url_noticia);
			$aleatorio = random_numbers(5);
			$url_noticia = stripslashes($url_noticia."-".$aleatorio);
			$url_noticia = stripslashes($url_noticia);
			} else {$url_noticia = $url_noticia_hidden;}
			$safModel = new SafModel();
			$check_url_noticia = $safModel->checkUrlNoticeDisticnt($id_noticia, $url_noticia);
			if (($id_noticia != "") && ($check_url_noticia === FALSE)){		
			
			$updateNovelty = $safModel->updateNotice($id_noticia, $id_sede, $titulo_noticia, $sinopsis_noticia, $imagen_noticia, $video_noticia, $_POST['html_noticia'], $url_noticia, $_POST['linkevento_noticia'], $published);
			}
			else { $error .= "la url de esta noticia la tiene otra, por eso no se puede actualizar.";}
			if ($updateNovelty){
				$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La noticia <strong>".$_POST['titulo_noticia']."</strong> se actualizó correctamente.
						</div>";
				} 
			else {
				$error .= "no hubo actualización";
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se actualizó la noticia ".$_POST['titulo_noticia'].".<br />CAUSAS: <br />".$error." 
						</div>";
				}
				$_SESSION['respuesta'] = $respuesta;         
			?>
            <meta http-equiv="refresh" content="0;url=<?php echo HTML_PATH;?>index/editar_noticia/<?php echo $id_noticia;?>">
		 <?php
			} else { $this->logoutAction();}
		} 	
	// eliminamos la noticia
	public function eliminar_noticiaAction()
		{
			$id_noticia = (isset($_GET['subaction']) ? (int)$_GET['subaction'] : 0);
			if ($id_noticia > 0)
			{
				$respuesta = isset($respuesta) ? $respuesta : "";
				 $safModel = new SafModel();				 
				 $noticiaEliminada = $safModel->deleteNotice($id_noticia);
				 if ($noticiaEliminada){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Noticia eliminada correctamente.
						</div>";					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó la noticia
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=<?php echo HTML_PATH;?>index/noticias">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=<?php echo HTML_PATH;?>index/noticias">
			<?php
		}	
	//SEDES////////////////////////////////////////////////////////////////////////////////
			public function sedesAction()
			{
				if (isset($_SESSION['admin']))
				{
					$safModel = new SafModel();
					$data['sedes'] = $safModel->getSeats();
					$data['no_visible_elements']=false;
					$data['view'] = "sede/sedes.php"; // Seteamos la vista
					$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
				} 
				else {
					$this->logoutAction();
					 }		
			}
			//EDITAR SEDE
			public function editar_sedeAction()
			{
				if (isset($_SESSION['admin']) && ($_GET['subaction'] != ""))
				{
					$safModel = new SafModel();
					$data['tipos_sede'] = $safModel->getTypesSeat();
					$data['tipos_preparacion'] = $safModel->getTypesPreparationSeat();
					$data['sede'] = $safModel->getInfoSeatForId($_GET['subaction']);
					$data['no_visible_elements']=false;
					$data['view'] = "sede/editar_sede.php"; // Seteamos la vista
					$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
				} 
				else {
					$this->logoutAction();
					 }		
			}
		 //NUEVA SEDE
	public function nueva_sedeAction()
		{
			if (isset($_SESSION['admin']))
			{
				$safModel = new SafModel();
				$data['tipos_sede'] = $safModel->getTypesSeat();
				$data['tipos_preparacion'] = $safModel->getTypesPreparationSeat();
				$data['no_visible_elements']=false;
				$data['view'] = "sede/nueva_sede.php"; // Seteamos la vista
				$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	
			} 
			else {
				$this->logoutAction();
				 }		
		}
		
	public function guardar_sedeAction()
	{
		$error = isset($error) ? $error : "";
		$safModel = new SafModel();
		$ubicacion_sede = isset($_POST['ubicacion_sede']) ? $_POST['ubicacion_sede'] : "";
		$id_tipo_sede =  isset($_POST['id_tipo_sede']) ? $_POST['id_tipo_sede'] : "";
		$id_tipopreparacion_sede = isset($_POST['tipo_preparacion']) ? $_POST['tipo_preparacion'] : "";
		$nombre_sede = isset($_POST['nombre_sede']) ? $_POST['nombre_sede'] : "";
		$direccion_sede = isset($_POST['direccion_sede']) ? $_POST['direccion_sede'] : "";
		$telefono_sede = isset($_POST['telefono_sede']) ? $_POST['telefono_sede'] : "";
		$html_sede = isset($_POST['html_sede']) ? $_POST['html_sede'] : "";
		$coordenadas_sede = isset($_POST['lat']) ? $_POST['lat'].",".$_POST['lng'] : "";
		$url_sede = inc_formatea_cadena_get($nombre_sede);
		$url_sede = str_replace('Á','a',$url_sede);
		$url_sede = str_replace('É','e',$url_sede);
		$url_sede = str_replace('Í','i',$url_sede);
		$url_sede = str_replace('Ó','o',$url_sede);
		$url_sede = str_replace('Ú','u',$url_sede);
		$url_sede = str_replace('á','a',$url_sede);
		$url_sede = str_replace('é','e',$url_sede);
		$url_sede = str_replace('í','i',$url_sede);
		$url_sede = str_replace('ó','o',$url_sede);
		$url_sede = str_replace('ú','u',$url_sede);
		$url_sede = str_replace('Ñ','n',$url_sede);
		$url_sede = str_replace('ñ','n',$url_sede);
		$url_sede = str_replace('&','and',$url_sede);
		$url_sede = str_replace('?','',$url_sede);
		$url_sede = str_replace('¿','',$url_sede);
		$url_sede = str_replace('-','_',$url_sede);
		$url_sede = str_replace('#','',$url_sede);
		$url_sede = str_replace('|','',$url_sede);
		$url_sede = str_replace('°','',$url_sede);
		$url_sede = str_replace('!','',$url_sede);
		$url_sede = str_replace('¡','',$url_sede);
		$url_sede = str_replace('.','',$url_sede);
		$url_sede = str_replace('(','',$url_sede);
		$url_sede = str_replace(')','',$url_sede);
		$url_sede = stripslashes($url_sede);
		$check_url_sede = $safModel->checkUrlSeat($url_sede);
		$published = isset($_POST['published']) ? $_POST['published'] : "";
		if ($published == ""){ $published_sede = "0"; } else { $published_sede = "published";}
			$position_sede = $safModel->getMaxPositionTable('sede') + 1;
			if (($nombre_sede =! "") && ($check_url_sede === FALSE)){
				$insertarSede = $safModel->saveSeat($id_tipopreparacion_sede, $_POST['nombre_sede'], $direccion_sede, $telefono_sede, $html_sede, $ubicacion_sede, $coordenadas_sede, $url_sede, $position_sede, $published_sede, $id_tipo_sede);
					
				   $respuesta = $_SESSION['respuesta'] ? "" : "";
					if ($insertarSede){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La sede <strong>".$_POST['nombre_sede']."</strong> se guardó correctamente.
						</div>";
		} else {
			$error .= "Fallo con el metodo saveNotice";
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la noticia ".$_POST['nombre_sede'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}									
		?>
		 <!-- <script type="text/javascript"> window.location="index/nueva_noticia"; </script> -->
         <?php
			}
			else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre.";
			$respuesta = $respuesta = $_SESSION['respuesta']?"":""; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}
		$_SESSION['respuesta'] = $respuesta;
		?>
        <script type="text/javascript"> window.location="<?php echo HTML_PATH;?>index/nueva_sede"; </script> 
        <?php
		}
			
		
		//@salir de la aplicacion
		public function logoutAction()
			{ 	
			header('Location:'.HTML_PATH.'logout');	
				/*unset($_SESSION['admin']);
				session_destroy();
				$data['no_visible_elements'] = true;
				$data['view'] = "login.php"; // Seteamos la vista
				$this->_view->render('../layouts/layout.php',$data);   // renderizamos la vista	*/
			}		 
}