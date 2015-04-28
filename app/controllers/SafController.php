<?php
/* Controlador del sistema de administracion funcional (saf) */
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."IndexModel.php");
require(APP_ROOT_MODELS."SafModel.php");
require(APP_ROOT_MODELS."ClienteModel.php");
class SafController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function indexAction()
	{
		if ($_POST['usuario'] && $_POST['clave'])
		{
			 $usuario = stringSeguro($_POST['usuario']);
			 $clave = stringSeguro($_POST['clave']);
			 if (($usuario != "") && ($clave != "")){
			 $safModel = new SafModel();
			 $validar = $safModel->validarAdministrador($usuario, $clave); // buscamos en la base de datos
		 }
		 if ($validar)
		 {
			 $_SESSION['admin'] = $usuario;	
			 $this->backupAction();	//hacemos backup de la bd cada vez que entra el admin, debe luego implementarse en un cronjob y enviar el .sql a un email	
			//$data['view'] = "saf/index.php"; // Seteamos la vista
			//$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  	 
		 } 
	} 
		if ($_SESSION['admin'] != "")
		{
			 $safModel = new SafModel();
			 $marcas = $safModel->getAllMarcas();
			$data['marcas'] = $marcas;
			$data['view'] = "saf/index.php"; // Seteamos la vista
		$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 
		} 
		else {
			$this->logoutAction();
			 }		
	}
	public function logoutAction()
	{
		unset($_SESSION['admin']);
		$_SESSION['admin'] = "";
		$data['view'] = "saf/login.php"; // Seteamos la vista
		$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista	
	}	
	/////////////////////////BACK UP BASE DE DATOS ///////////////////////////
	public function backupAction(){
/* backup the db OR just a table */
		function backup_tables($host,$user,$pass,$name,$tables = '*')
		{			
			$link = mysql_connect($host,$user,$pass);
			mysql_select_db($name,$link);
			
			//get all of the tables
			if($tables == '*')
			{
				$tables = array();
				$result = mysql_query('SHOW TABLES');
				while($row = mysql_fetch_row($result))
				{
					$tables[] = $row[0];
				}
			}
			else
			{
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			
			//cycle through
			foreach($tables as $table)
			{
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				$return.= 'DROP TABLE '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
			}			
			//save file
			$handle = fopen(APP_ROOT_PATH.'others/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
			fwrite($handle,$return);
			fclose($handle);
		}
		backup_tables(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_SERVER_DATABASE);
		}
	//MARCAS**************************************************************/
	public function marcasAction()
	{
		 $safModel = new SafModel();
		 $marcas = $safModel->getAllMarcas();
		 $data['marcas'] = $marcas;
		 $data['view'] = "saf/marca/marcas.php"; // Seteamos la vista
		 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
	}
	public function nueva_marcaAction()
	{
		 $safModel = new SafModel();
		 $lineas = $safModel->getAllLines();
		 $tipos_producto = $safModel->getAllTypesProducts();
		 $marcas = $safModel->getAllMarcas();
		 $data['lineas'] = $lineas;
		 $data['tipos_producto'] = $tipos_producto;
		 $data['marcas'] = $marcas;
		 $data['view'] = "saf/marca/nueva_marca.php"; // Seteamos la vista
		 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	

	}
		//guardamos una marca
		public function guardar_nueva_marcaAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$id_linea = $_POST['id_linea'];
					$id_tipo_producto = $_POST['id_tipo_producto'];
					$nombre_marca = $_POST['nombre_marca'];
					$nick_marca = $_POST['nick_marca'];
					$prefijo_marca = $_POST['prefijo_marca'];
					$imagen_marca = $_FILES['imagen']['name'];
					$descripcion_marca = $_POST['descripcion_marca'];
					$caracteristica_marca = $_POST['caracteristica_marca'];
					$recomendaciones_marca = $_POST['recomendaciones_marca'];
					$comoaplicar_marca = $_POST['comoaplicar_marca'];
					$pdf_marca = $_FILES['pdf']['name'];
					$pdf2_marca = $_FILES['pdf2']['name'];
					$url_marca = inc_formatea_cadena_get($nombre_marca);
					$url_marca = str_replace('Á','a',$url_marca);
					$url_marca = str_replace('É','e',$url_marca);
					$url_marca = str_replace('Í','i',$url_marca);
					$url_marca = str_replace('Ó','o',$url_marca);
					$url_marca = str_replace('Ú','u',$url_marca);
					$url_marca = str_replace('á','a',$url_marca);
					$url_marca = str_replace('é','e',$url_marca);
					$url_marca = str_replace('í','i',$url_marca);
					$url_marca = str_replace('ó','o',$url_marca);
					$url_marca = str_replace('ú','u',$url_marca);
					$url_marca = str_replace('Ñ','n',$url_marca);
					$url_marca = str_replace('ñ','n',$url_marca);
					$url_marca = str_replace('&','and',$url_marca);
					$url_marca = str_replace('?','',$url_marca);
					$url_marca = str_replace('¿','',$url_marca);
					$url_marca = str_replace('#','',$url_marca);
					$url_marca = str_replace('-','_',$url_marca);
					$url_marca = str_replace('|','',$url_marca);
					$url_marca = str_replace('°','',$url_marca);
					$url_marca = str_replace('!','',$url_marca);
					$url_marca = str_replace('¡','',$url_marca);
					$url_marca = str_replace('.','',$url_marca);
					$url_marca = str_replace('(','',$url_marca);
					$url_marca = str_replace(')','',$url_marca);
					$url_marca = stripslashes($url_marca);
					$check_url_marca = $safModel->checkUrlBrand($url_marca);
					$publicar = $_POST['publicar'];
					if ($publicar == ""){ $published_marca = "0"; } else { $published_marca = "1";}
					$position_marca = $safModel->getMaxPositionBrand() + 1;
					if (($nombre_marca =! "") && ($check_url_marca === FALSE)){
					if ($imagen_marca != ""){$responseimg = subir_imagen("imagen",APP_ROOT."static/images/lineas/marcas/"); $UploadImageBrand = true;} else {$responseimg = true; $UploadImageBrand = false;}
					if ($pdf_marca != ""){$responsepdf = subir_pdf("pdf",APP_ROOT."static/pdf/"); }
					if ($pdf2_marca != ""){$responsepdf2 = subir_pdf("pdf2",APP_ROOT."static/pdf/"); }
					if (($responseimg === true) && ($id_linea =! "") && ($id_tipo_producto =! "") && ($nombre_marca != ""))// verificamos que se guarde la imagen y el pdf y recien insertamos a la bd 
						{
							if ($UploadImageBrand){
								$pathToImage = APP_ROOT."static/images/lineas/marcas/".$imagen_marca;
								createThumbnail($pathToImage,150);
							}
							$insertarMarca = $safModel->saveBrand(utf8_decode($_POST['nombre_marca']), $nick_marca, $prefijo_marca, $imagen_marca,$descripcion_marca, $caracteristica_marca, $recomendaciones_marca,$comoaplicar_marca, $pdf_marca, $pdf2_marca, $url_marca, $published_marca, $position_marca, $_POST['id_linea'], $_POST['id_tipo_producto']);
						} else {
							$error .= "Error: no selecciono una linea o un tipo de producto o no ingreso un nombre de marca o <br />".$responseimg."<br />"; 
							}
					$respuesta = "";
					if ($insertarMarca){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La marca <strong>".$_POST['nombre_marca']."</strong> se guardó correctamente.
						</div>";
		} else {
			if ($UploadImageBrand){
		@unlink(APP_ROOT."static/images/lineas/marcas/".$imagen_marca);//eliminamos la imagen subida
		@unlink(APP_ROOT."static/images/lineas/marcas/thumb.".$imagen_marca);//eliminamos la imagen thumb generada
			}
		if ($responsepdf === true){
		@unlink(APP_ROOT."static/pdf/".$pdf_marca);//eliminamos el pdf si lo hubiera subido
		}
		if ($responsepdf2 === true){
		@unlink(APP_ROOT."static/pdf/".$pdf2_marca);//eliminamos el pdf si lo hubiera subido
		}
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la marca ".$_POST['nombre_marca'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}						
			$_SESSION['respuesta'] = $respuesta;
		?>
		 <script type="text/javascript"> window.location="nueva_marca"; </script> 
		 <?php	
		} else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre de esta última."; 
		}
		}
	
		}
		/// editamos marcas		
		public function editar_marcaAction()
		{
			$id_marca = (isset($_GET['id_marca']) ? (int)$_GET['id_marca'] : 0);
			if ($id_marca > 0)
			{
				 $safModel = new SafModel();
				 $lineas = $safModel->getAllLines();
				 $tipos_producto = $safModel->getAllTypesProducts();
				 $marca = $safModel->getBrandForId($id_marca);
				 $data['lineas'] = $lineas;
				 $data['tipos_producto'] = $tipos_producto;
				 $data['marca'] = $marca;
				 $data['view'] = "saf/marca/editar_marca.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php	}
		}
		
		public function editbrandAction()
		{
			if ($_POST){
			$error = "";
			$id_marca = $_POST['id_marca'];
			$nombre_marca = $_POST['nombre_marca'];
			$nick_marca = $_POST['nick_marca'];
			$prefijo_marca = $_POST['prefijo_marca'];
			$imagen_marca = $_POST['imagen_marca'];
			$descripcion_marca = str_replace('\\','',$_POST['descripcion_marca']);
			$caracteristica_marca = str_replace('\\','',$_POST['caracteristica_marca']);			
			$recomendaciones_marca = str_replace('\\','',$_POST['recomendaciones_marca']);
			$comoaplicar_marca = str_replace('\\','',$_POST['comoaplicar_marca']);
			$pdf_marca = $_POST['pdf_marca'];
			$deletefile = $_POST['deletefile'];
			$pdf2_marca = $_POST['pdf2_marca'];
			$deletefile2 = $_POST['deletefile2'];
			$published = $_POST['published_marca'];
			if ($published){
			$published_marca = "1";
			} else {
			$published_marca = "0";
			}						
			$id_linea = $_POST['id_linea'];
			$id_tipo_producto = $_POST['id_tipo_producto'];
			if ($_FILES['imagen_marca']['name'] != ""){
			$imageUploadBrand = subir_imagen("imagen_marca",APP_ROOT."static/images/lineas/marcas/");
			$imagen_marca = $_FILES['imagen_marca']['name'];
			$pathToImage = APP_ROOT."static/images/lineas/marcas/".$imagen_marca;
			createThumbnail($pathToImage,150);//generamos el thumbnail de esta imágen nueva
			if (($_POST['hidden_imagen_marca'] != "") && ($_POST['hidden_imagen_marca'] != $imagen_marca)){
				@unlink(APP_ROOT."static/images/lineas/marcas/".$_POST['hidden_imagen_marca']); //eliminamos la imagen subida anteriormente
				@unlink(APP_ROOT."static/images/lineas/marcas/thumb.".$_POST['hidden_imagen_marca']); // y su thumbnail
			}
			}else { $imagen_marca = $_POST['hidden_imagen_marca']; $imageUploadBrand = true;}

			if ($_FILES['pdf']['name'] != "") {			
			subir_pdf("pdf",APP_ROOT."static/pdf/");
			$pdf_marca = $_FILES['pdf']['name'];					
			}else { 
			if (!$deletefile){ $pdf_marca = $_POST['hidden_pdf']; }
			else {$pdf_marca = "";
			@unlink(APP_ROOT."static/pdf/".$_POST['hidden_pdf']); //eliminamos el pdf
			} 
			}
			
			if ($_FILES['pdf2']['name'] != ""){
			subir_pdf("pdf2",APP_ROOT."static/pdf/");
			$pdf2_marca = $_FILES['pdf2']['name'];
			}else { 
			if (!$deletefile2){$pdf2_marca = $_POST['hidden_pdf2'];} 
			else {$pdf2_marca = "";
			@unlink(APP_ROOT."static/pdf/".$_POST['hidden_pdf2']); //eliminamos el pdf
			}
			}
			
			if (($id_marca != "")){		
			$safModel = new SafModel();
			$updateBrand = $safModel->updateBrand($id_marca, $nombre_marca, $nick_marca, $prefijo_marca, $imagen_marca, $descripcion_marca, $caracteristica_marca,  $recomendaciones_marca, $comoaplicar_marca, $pdf_marca, $pdf2_marca, $published_marca,  $id_linea, $id_tipo_producto);
			}
			else { }
			if ($updateBrand){
				$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La marca <strong>".$_POST['nombre_marca']."</strong> se actualizó correctamente.
						</div>";
				} 
			else {
				$error .= $imageUploadBrand;
				$error .= "no hubo actualización";
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se actualizó la marca ".$_POST['nombre_marca'].".<br />CAUSAS: <br />".$error." 
						</div>";
				}
				$_SESSION['respuesta'] = $respuesta;
			?>
		 <script type="text/javascript"> window.location="editar_marca?id_marca=<?php echo $id_marca;?>"; </script> 
		 <?php
			}
		}
			
		/// vemos las marcas		
		public function ver_galeriaAction()
		{
			$id_marca = (isset($_GET['id_marca']) ? (int)$_GET['id_marca'] : 0);
			if ($id_marca > 0)
			{
				 $safModel = new SafModel();
				 $lineas = $safModel->getAllLines();
				 $tipos_producto = $safModel->getAllTypesProducts();
				 $marca = $safModel->getBrandForId($id_marca);
				 $galeria = $safModel->getGalleryForIdBrand($id_marca);
				 $colores = $safModel->getColorsPublishedOfBrand($id_marca);
				 $data['lineas'] = $lineas;
				 $data['tipos_producto'] = $tipos_producto;
				 $data['marca'] = $marca;
				 $data['colores'] = $colores;
				 $data['galeria'] = $galeria;
				 $data['view'] = "saf/marca/galeria.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php	}
		}
	
	//guardamos una galería
		public function guardar_nueva_galeriaAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$id_marca = $_POST['id_marca'];
					$titulo_galeria = $_POST['titulo_galeria'];
					$texto_galeria = $_POST['texto_galeria'];
					$imagen_galeria = $_FILES['imagen']['name'];
					$thumb_imagen_galeria = $_FILES['thumbimagen']['name'];
					$id_color1_galeria = $_POST['id_color1_galeria'];
					$id_color2_galeria = $_POST['id_color2_galeria'];
					$id_color3_galeria = $_POST['id_color3_galeria'];
					$id_color4_galeria = $_POST['id_color4_galeria'];
					$id_color5_galeria = $_POST['id_color5_galeria'];
					$publicar = $_POST['published_galeria'];
					if ($publicar == ""){ $published_galeria = "0"; } else { $published_galeria = "1";}
					$position_galeria_marca = $safModel->getMaxPositionGallery() + 1;
					if ($titulo_galeria =! ""){
						$aleatorio = time();
					if ($imagen_galeria != ""){$responseimg = subir_imagen_aleatoria("imagen",APP_ROOT."static/images/lineas/marcas/galerias/".$aleatorio); 
					$responseimg2 = subir_imagen_aleatoria("thumbimagen",APP_ROOT."static/images/lineas/marcas/galerias/thumbs/".$aleatorio); }
					$pathToImage = APP_ROOT."static/images/lineas/marcas/galerias/".$aleatorio.$imagen_galeria;
					$insertarNuevaGaleria = $safModel->saveGalleryBrand($_POST['id_marca'], $_POST['titulo_galeria'], $aleatorio.$imagen_galeria, $texto_galeria, $aleatorio.$thumb_imagen_galeria, $id_color1_galeria, $id_color2_galeria, $id_color3_galeria, $id_color4_galeria, $id_color5_galeria, $published_galeria, $position_galeria_marca);							
					$respuesta = "";
					if ($insertarNuevaGaleria){				
						$respuesta .= "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>La imágen se guardó correctamente.</div>";
		} else {
		if ($responseimg == true){
		@unlink(APP_ROOT."static/images/lineas/marcas/galerias/".$aleatorio.$imagen_galeria);//eliminamos la imagen subida
		@unlink(APP_ROOT."static/images/lineas/marcas/galerias/thumbs/".$aleatorio.$thumb_imagen_galeria);//eliminamos la imagen thumb subida
			}
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la imágen.<br />CAUSAS: <br />".$responseimg." 
						</div>";
		}									
		?>
		 <script type="text/javascript"> window.location="<?php echo HTML_PATH_ADMIN;?>ver_galeria?id_marca=<?php echo $_POST['id_marca'];?>"; </script> 
		 <?php	
		} else { $error .= "No ha ingresado un nombre"; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}

		$_SESSION['respuesta'] = $respuesta;
		}
	
		}
		
	// eliminamos la marca
		public function eliminar_elementogaleria_marcaAction()
		{
			$id_galeria = (isset($_GET['id_galeria']) ? (int)$_GET['id_galeria'] : 0);
			if ($id_galeria > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();		 
				$id_marca = $safModel->getBrandForIdGallery($id_galeria)->id_marca;
				 $elementogaleriaEliminada = $safModel->deleteItemOfGalleryBrand($id_galeria);
				 if ($elementogaleriaEliminada){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Eliminación correcta.
						</div>";					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó!
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=ver_galeria?id_marca=<?php echo $id_marca;?>">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=ver_galeria?id_marca=<?php echo $id_marca;?>">
			<?php
		}	
				
		/// vemos las marcas		
		public function ver_marcaAction()
		{
			$id_marca = (isset($_GET['id_marca']) ? (int)$_GET['id_marca'] : 0);
			if ($id_marca > 0)
			{
				 $safModel = new SafModel();
				 $lineas = $safModel->getAllLines();
				 $tipos_producto = $safModel->getAllTypesProducts();
				 $marca = $safModel->getBrandForId($id_marca);
				 $data['lineas'] = $lineas;
				 $data['tipos_producto'] = $tipos_producto;
				 $data['marca'] = $marca;
				 $data['view'] = "saf/marca/ver_marca.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php	}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		public function nueva_lineaAction()
		{
				 $safModel = new SafModel();
				 $lineas = $safModel->getAllLines();
				 $data['lineas'] = $lineas;
				 $data['view'] = "saf/linea/nueva_linea.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	

		}
		//guardamos una línea
		public function guardar_nueva_lineaAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$nombre_linea = $_POST['nombre_linea'];
					$imagen_linea = $_FILES['imagen']['name'];
					$detalle_linea = $_POST['detalle_linea'];
					$url_linea = inc_formatea_cadena_get($nombre_linea);
					$url_linea = str_replace('Á','a',$url_linea);
					$url_linea = str_replace('É','e',$url_linea);
					$url_linea = str_replace('Í','i',$url_linea);
					$url_linea = str_replace('Ó','o',$url_linea);
					$url_linea = str_replace('Ú','u',$url_linea);
					$url_linea = str_replace('á','a',$url_linea);
					$url_linea = str_replace('é','e',$url_linea);
					$url_linea = str_replace('í','i',$url_linea);
					$url_linea = str_replace('ó','o',$url_linea);
					$url_linea = str_replace('ú','u',$url_linea);
					$url_linea = str_replace('Ñ','n',$url_linea);
					$url_linea = str_replace('ñ','n',$url_linea);
					$url_linea = str_replace('&','and',$url_linea);
					$url_linea = str_replace('?','',$url_linea);
					$url_linea = str_replace('¿','',$url_linea);
					$url_linea = str_replace('-','_',$url_linea);
					$url_linea = str_replace('#','',$url_linea);
					$url_linea = str_replace('|','',$url_linea);
					$url_linea = str_replace('°','',$url_linea);
					$url_linea = str_replace('!','',$url_linea);
					$url_linea = str_replace('¡','',$url_linea);
					$url_linea = str_replace('.','',$url_linea);
					$url_linea = str_replace('(','',$url_linea);
					$url_linea = str_replace(')','',$url_linea);
					$url_linea = stripslashes($url_linea);
					$check_url_linea = $safModel->checkUrlLine($url_linea);
					$publicar = $_POST['publicar'];
					if ($publicar == ""){ $published_linea = "0"; } else { $published_linea = "1";}
					$position_linea = $safModel->getMaxPositionLine() + 1;
					if (($nombre_linea =! "") && ($check_url_linea === FALSE)){
					if ($imagen_linea != ""){$responseimg = subir_imagen("imagen",APP_ROOT."static/images/lineas/"); }
					if ($nombre_linea != "")// verificamos que tenga un nombre al menos la línea 
						{		
							$insertarLinea = $safModel->saveLine(utf8_decode($_POST['nombre_linea']), $imagen_linea, $detalle_linea , $url_linea, $published_linea, $position_linea);
						} else {
							$error .= "Error: no selecciono una linea o un tipo de producto o no ingreso un nombre de marca o <br />".$responseimg."<br />"; 
							}
					$respuesta = "";
					if ($insertarLinea){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La marca <strong>".$_POST['nombre_linea']."</strong> se guardó correctamente.
						</div>";
		} else {
		if ($responseimg == true){
		@unlink(APP_ROOT."static/images/lineas/".$imagen_linea);//eliminamos la imagen subida
			}
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la línea ".$_POST['nombre_linea'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}									
		?>
		 <script type="text/javascript"> window.location="nueva_linea"; </script> 
		 <?php	
		} else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre."; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}

		$_SESSION['respuesta'] = $respuesta;
		}
	
		}
		
		
		// eliminamos la marca
		public function eliminar_marcaAction()
		{
			$id_marca = (isset($_GET['id_marca']) ? (int)$_GET['id_marca'] : 0);
			if ($id_marca > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();
				 $marca = $safModel->getBrandForId($id_marca);	
				 $imagen_marca = $marca->imagen_marca;
				 if ($imagen_marca != ""){ @unlink(APP_ROOT."static/images/lineas/marcas/".$imagen_marca); }			 
				 $marcaEliminada = $safModel->deleteBrand($id_marca);
				 if ($marcaEliminada){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Marca eliminada correctamente.
						</div>";					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó la marca 
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php
		}
	/*@subimos las marcas de posición
	@public
	@function upmarcaAction
	@autor:
	@return: 
	*/
	public function upmarcaAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $subir = $safModel->orderUpRegister("marca",$id_table);
		 return $subir;
		// $_SESSION['mensaje'] = $subir;	
    }	
	public function downmarcaAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $bajar = $safModel->orderDownRegister("marca",$id_table);
		 echo $bajar;
		// $_SESSION['mensaje'] = $bajar;	
    }	
	/***************************LINEAS************************************************************/
		/*@subimos las lineas de posición
	@public
	@function upmarcaAction
	@autor:
	@return: 
	*/
	public function uplineaAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $subir = $safModel->orderUpRegister("linea",$id_table);
		 return $subir;
		// $_SESSION['mensaje'] = $subir;	
    }	
	public function downlineaAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $bajar = $safModel->orderDownRegister("linea",$id_table);
		 echo $bajar;
		// $_SESSION['mensaje'] = $bajar;	
    }
	public function lineasAction()
	{
		 $safModel = new SafModel();
		 $lineas = $safModel->getAllLines();
		 $data['lineas'] = $lineas;
		 $data['view'] = "saf/linea/lineas.php"; // Seteamos la vista
		 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
	}
	/// vemos las líneas		
		public function ver_lineaAction()
		{
			$id_linea = (isset($_GET['id_linea']) ? (int)$_GET['id_linea'] : 0);
			if ($id_linea > 0)
			{
				 $safModel = new SafModel();
				 $linea = $safModel->getLineForId($id_linea);
				 $data['linea'] = $linea;
				 $data['view'] = "saf/linea/ver_linea.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=lineas">
			<?php	}
		}
		
	/// editamos linea		***
		public function editar_lineaAction()
		{
			$id_linea = (isset($_GET['id_linea']) ? (int)$_GET['id_linea'] : 0);
			if ($id_linea > 0)
			{
				 $safModel = new SafModel();
				 $linea = $safModel->getLineForId($id_linea);
				 $data['linea'] = $linea;
				 $data['view'] = "saf/linea/editar_linea.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=lineas">
			<?php	}
		}
		
	public function editlineAction()
		{
			if ($_POST){
			$error = "";
			$id_linea = $_POST['id_linea'];
			$nombre_linea = $_POST['nombre_linea'];
			$detalle_linea = $_POST['detalle_linea'];
			$published = $_POST['published_linea'];
			if ($published){
			$published_linea = "1";
			} else {
			$published_linea = "0";
			}
			if ($_FILES['imagen_linea']['name'] != ""){
			$imageUploadLine = subir_imagen("imagen_linea",APP_ROOT."static/images/lineas/");
			$imagen_linea = $_FILES['imagen_linea']['name'];
			}else { $imagen_linea = $_POST['hidden_imagen_linea']; $imageUploadLine = true;}
			if ($id_linea != ""){		
			$safModel = new SafModel();
			$updateLine = $safModel->updateLine($id_linea, $nombre_linea, $imagen_linea, $detalle_linea, $published_linea);
			}
			else { $error .= $imageUploadLine;}
			if ($updateLine){
				$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La línea <strong>".$_POST['nombre_linea']."</strong> se actualizó correctamente.
						</div>";
				} 
			else {
				$error .= "no hubo actualización";
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se actualizó la línea ".$_POST['nombre_linea'].".<br />CAUSAS: <br />".$error." 
						</div>";
				}
				$_SESSION['respuesta'] = $respuesta;
			?>
		 <script type="text/javascript"> window.location="editar_linea?id_linea=<?php echo $id_linea;?>"; </script> 
		 <?php
			}
		}	
	// eliminamos la línea
	public function eliminar_lineaAction()
		{
			$id_linea = (isset($_GET['id_linea']) ? (int)$_GET['id_linea'] : 0);
			if ($id_linea > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();
				 $linea = $safModel->getLineForId($id_linea);
				 $imagen_linea = $linea->imagen_linea;				 
				 $lineaEliminada = $safModel->deleteLine($id_linea);
				 if ($imagen_linea != ""){ @unlink(APP_ROOT."static/images/lineas/".$imagen_linea); }
				 if ($lineaEliminada){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Línea eliminada correctamente.
						</div>";					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó la línea 
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=lineas">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=lineas">
			<?php
		}
	////////////// TIPO DE PRODUCTO ////////////////////////////	
	public function tiposAction()
		{
			 $safModel = new SafModel();
			 $tipos = $safModel->getAllTypesProducts();
			 $data['tipos'] = $tipos;
			 $data['view'] = "saf/tipo_producto/tipos.php"; // Seteamos la vista
			 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
		}
		/// vemos las líneas		
		public function ver_tipo_productoAction()
		{
			$id_tipo_producto = (isset($_GET['id_tipo_producto']) ? (int)$_GET['id_tipo_producto'] : 0);
			if ($id_tipo_producto > 0)
			{
				 $safModel = new SafModel();
				 $tipo_producto = $safModel->getTypeProductForId($id_tipo_producto);
				 $data['tipo_producto'] = $tipo_producto;
				 $data['view'] = "saf/tipo_producto/ver_tipo_producto.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=tipos">
			<?php	
			}	
			
		}

	/// editamos típo de producto ***
		public function editar_tipo_productoAction()
		{
			$id_tipo_producto = (isset($_GET['id_tipo_producto']) ? (int)$_GET['id_tipo_producto'] : 0);
			if ($id_tipo_producto > 0)
			{
				 $safModel = new SafModel();
				 $tipo_producto = $safModel->getTypeProductForId($id_tipo_producto);
				 $data['tipo_producto'] = $tipo_producto;
				 $data['view'] = "saf/tipo_producto/editar_tipo_producto.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=tipos">
			<?php	}
		}
		// actualizando tipo de producto
		public function edittypeproductAction()
		{
			if ($_POST){
			$error = "";
			$id_tipo_producto = $_POST['id_tipo_producto'];
			$nombre_tipo_producto = $_POST['nombre_tipo_producto'];
			$descripcion_tipo_producto = $_POST['descripcion_tipo_producto'];
			$published = $_POST['published_tipo_producto'];
			if ($published){
			$published_tipo_producto = "1";
			} else {
			$published_tipo_producto = "0";
			}
			if ($_FILES['imagen_tipo_producto']['name'] != ""){
			$imageUploadTypeProduct = subir_imagen("imagen_tipo_producto",APP_ROOT."static/images/tipo_producto/");
			$imagen_tipo_producto = $_FILES['imagen_tipo_producto']['name'];
			}else { $imagen_tipo_producto = $_POST['hidden_imagen_tipo_producto']; $imageUploadTypeProduct = true;}
			if ($id_tipo_producto != ""){		
			$safModel = new SafModel();
			$updateTypeProduct = $safModel->updateTypeProduct($id_tipo_producto, $nombre_tipo_producto, $imagen_tipo_producto, $descripcion_tipo_producto, $published_tipo_producto);
			}
			else { $error .= $imageUploadTypeProduct;}
			if ($updateTypeProduct){
				$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							El Típo de producto <strong>".$_POST['nombre_tipo_producto']."</strong> se actualizó correctamente.
						</div>";
				} 
			else {
				$error .= "no hubo actualización";
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se actualizó el típo de producto ".$_POST['nombre_tipo_producto'].".<br />CAUSAS: <br />".$error." 
						</div>";
				}
				$_SESSION['respuesta'] = $respuesta;
			?>
		 <script type="text/javascript"> window.location="editar_tipo_producto?id_tipo_producto=<?php echo $id_tipo_producto;?>"; </script> 
		 <?php
			}
		}	
		
		// eliminamos el típo de producto
	public function eliminar_tipo_productoAction()
		{
			$id_tipo_producto = (isset($_GET['id_tipo_producto']) ? (int)$_GET['id_tipo_producto'] : 0);
			if ($id_tipo_producto > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();
				 $tipo_producto = $safModel->getTypeProductForId($id_tipo_producto);
				 $imagen_tipo_producto = $tipo_producto->imagen_tipo_producto;				 
				 $tipoProductoEliminado = $safModel->deleteTypeProduct($id_tipo_producto);				 
				 if ($tipoProductoEliminado){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Típo de producto eliminado correctamente.
						</div>";
					if ($imagen_tipo_producto != ""){ @unlink(APP_ROOT."static/images/tipo_producto/".$imagen_tipo_producto); }					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó el típo de producto. 
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=tipos">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=tipos">
			<?php
		}
 		// action de nueva línea
		public function nuevo_tipo_productoAction()
			{	
				try{
				 $safModel = new SafModel();
				 $tipo_productos = $safModel->getAllTypesProducts();
				 $data['tipo_productos'] = $tipo_productos;
				 $data['view'] = "saf/tipo_producto/nuevo_tipo_producto.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 
				} catch (PDOException $e){die( 'Fail Action: ' .__METHOD__." - ". $e->getMessage() ); }
			}

		//guardamos un tipo de producto
		public function guardar_nuevo_tipoAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$nombre_tipo_producto = $_POST['nombre_tipo_producto'];
					$imagen_tipo_producto = $_FILES['imagen']['name'];
					$descripcion_tipo_producto = $_POST['descripcion_tipo_producto'];
					$url_tipo_producto = inc_formatea_cadena_get($nombre_tipo_producto);
					$url_tipo_producto = str_replace('Á','a',$url_tipo_producto);
					$url_tipo_producto = str_replace('É','e',$url_tipo_producto);
					$url_tipo_producto = str_replace('Í','i',$url_tipo_producto);
					$url_tipo_producto = str_replace('Ó','o',$url_tipo_producto);
					$url_tipo_producto = str_replace('Ú','u',$url_tipo_producto);
					$url_tipo_producto = str_replace('á','a',$url_tipo_producto);
					$url_tipo_producto = str_replace('é','e',$url_tipo_producto);
					$url_tipo_producto = str_replace('í','i',$url_tipo_producto);
					$url_tipo_producto = str_replace('ó','o',$url_tipo_producto);
					$url_tipo_producto = str_replace('ú','u',$url_tipo_producto);
					$url_tipo_producto = str_replace('Ñ','n',$url_tipo_producto);
					$url_tipo_producto = str_replace('ñ','n',$url_tipo_producto);
					$url_tipo_producto = str_replace('&','and',$url_tipo_producto);
					$url_tipo_producto = str_replace('?','',$url_tipo_producto);
					$url_tipo_producto = str_replace('¿','',$url_tipo_producto);
					$url_tipo_producto = str_replace('#','',$url_tipo_producto);
					$url_tipo_producto = str_replace('|','',$url_tipo_producto);
					$url_tipo_producto = str_replace('°','',$url_tipo_producto);
					$url_tipo_producto = str_replace('!','',$url_tipo_producto);
					$url_tipo_producto = str_replace('¡','',$url_tipo_producto);
					$url_tipo_producto = str_replace('.','',$url_tipo_producto);
					$url_tipo_producto = str_replace('(','',$url_tipo_producto);
					$url_tipo_producto = str_replace(')','',$url_tipo_producto);
                    $url_tipo_producto = str_replace(' ','',$url_tipo_producto);
                    $url_tipo_producto = str_replace('-','_',$url_tipo_producto);
					$url_tipo_producto = stripslashes($url_tipo_producto);
					$check_url_tipo_producto = $safModel->checkUrlTypeProduct($url_tipo_producto);
					$publicar = $_POST['publicar'];
					if ($publicar == ""){ $published_tipo_producto = "0"; } else { $published_tipo_producto = "1";}
					$position_tipo_producto = $safModel->getMaxPositionTypeProduct() + 1;
					if (($nombre_tipo_producto =! "") && ($check_url_tipo_producto === FALSE)){
					if ($nombre_tipo_producto != ""){$responseimg = subir_imagen("imagen",APP_ROOT."static/images/tipo_producto/"); }
					if ($nombre_tipo_producto != "")// verificamos que tenga un nombre al menos la línea 
						{		
							$insertarTipoProducto = $safModel->saveTypeProduct(utf8_decode($_POST['nombre_tipo_producto']), $imagen_tipo_producto, $descripcion_tipo_producto , $url_tipo_producto, $published_tipo_producto, $position_tipo_producto);
						} else {
							$error .= "Error: no ingreso un tipo de producto <br />".$responseimg."<br />"; 
							}
					$respuesta = "";
					if ($insertarTipoProducto){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							El tipo de producto <strong>".$_POST['nombre_tipo_producto']."</strong> se guardó correctamente.
						</div>";
		} else {
		if ($responseimg == true){
		@unlink(APP_ROOT."static/images/tipo_producto/".$imagen_tipo_producto);//eliminamos la imagen subida
			}
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó el tipo de producto ".$_POST['nombre_tipo_producto'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}									
		?>
		 <script type="text/javascript"> window.location="nuevo_tipo_producto"; </script> 
		 <?php	
		} else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre."; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}

		$_SESSION['respuesta'] = $respuesta;
		}
	
		}

	public function uptipoproductoAction()
		{
			$id_table = $_GET['subaction']; 
			 $safModel = new SafModel();
			 $subir = $safModel->orderUpRegister("tipo_producto",$id_table);
			 return $subir;
			// $_SESSION['mensaje'] = $subir;	
		}	
		public function downtipoproductoAction()
		{
			$id_table = $_GET['subaction']; 
			 $safModel = new SafModel();
			 $bajar = $safModel->orderDownRegister("tipo_producto",$id_table);
			 echo $bajar;
			// $_SESSION['mensaje'] = $bajar;	
		}
	// cambio de orden de las posiciones de la galeria
		public function upgaleriaAction()
		{
			$id_table = $_GET['subaction']; 
			 $safModel = new SafModel();
			 $subir = $safModel->orderUpRegister("galeria_marca",$id_table);
			 return $subir;
			// $_SESSION['mensaje'] = $subir;	
		}	
		public function downgaleriaAction()
		{
			$id_table = $_GET['subaction']; 
			 $safModel = new SafModel();
			 $bajar = $safModel->orderDownRegister("galeria_marca",$id_table);
			 return $bajar;
			// $_SESSION['mensaje'] = $bajar;	
		}
			
		
//////////////////////////////*PRODUCTO***********************************/
	public function productosAction()
		{
			 $safModel = new SafModel();
			 $productos = $safModel->getAllProducts();
			 $coloresdecorlast = $safModel->getAllProductsForIdBrand('28');
			 $coloressatinado = $safModel->getAllProductsForIdBrand('29');
			 $coloresduracolor = $safModel->getAllProductsForIdBrand('30');
			 $coloresmaestro = $safModel->getAllProductsForIdBrand('31');
			 $data['productos'] = $productos;
			 $data['coloresdecorlast'] = $coloresdecorlast;
			 $data['coloressatinado'] = $coloressatinado;
			 $data['coloresduracolor'] = $coloresduracolor;
			 $data['coloresmaestro'] = $coloresmaestro;
			 $data['view'] = "saf/producto/productos.php"; // Seteamos la vista
			 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
		}
	//mostramos los productos
	public function nuevo_productoAction()
		{
			 $safModel = new SafModel();
			 $lineas = $safModel->getAllLines();
			 $tipos_producto = $safModel->getAllTypesProducts();
			 $marcas = $safModel->getAllMarcas();
			 $colores = $safModel->getAllFamilyColorProduct();
			 $gammas = $safModel->getAllGammaColorProduct();
			 $data['lineas'] = $lineas;
			 $data['tipos_producto'] = $tipos_producto;
			 $data['marcas'] = $marcas;
			 $data['gammas'] = $gammas;
			 $data['colores'] = $colores;
			 $data['view'] = "saf/producto/nuevo_producto.php"; // Seteamos la vista
			 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 		
		}
	//guardamos una marca
		public function guardar_nuevo_productoAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$id_marca = $_POST['id_marca'];
					$nombre_producto = $_POST['nombre_producto'];
					$codigo_producto = $_POST['codigo_producto'];
					$id_familiacolorproducto = $_POST['id_familiacolorproducto'];
					$id_gamacolorproducto = $_POST['id_gamacolorproducto'];
					$tonalidad1_producto = $_POST['tonalidad1_producto'];
					$tonalidad2_producto = $_POST['tonalidad2_producto'];
					$tonalidad3_producto = $_POST['tonalidad3_producto'];
					$imagen_producto = $_FILES['imagen']['name'];
					$descripcion_producto = $_POST['descripcion_producto'];
					$pdf_producto = $_FILES['pdf']['name'];
					$url_producto = inc_formatea_cadena_get($nombre_producto);
					$url_producto = str_replace('Á','a',$url_producto);
					$url_producto = str_replace('É','e',$url_producto);
					$url_producto = str_replace('Í','i',$url_producto);
					$url_producto = str_replace('Ó','o',$url_producto);
					$url_producto = str_replace('Ú','u',$url_producto);
					$url_producto = str_replace('á','a',$url_producto);
					$url_producto = str_replace('é','e',$url_producto);
					$url_producto = str_replace('í','i',$url_producto);
					$url_producto = str_replace('ó','o',$url_producto);
					$url_producto = str_replace('ú','u',$url_producto);
					$url_producto = str_replace('Ñ','n',$url_producto);
					$url_producto = str_replace('ñ','n',$url_producto);
					$url_producto = str_replace('&','and',$url_producto);
					$url_producto = str_replace('?','',$url_producto);
					$url_producto = str_replace('¿','',$url_producto);
					$url_producto = str_replace('#','',$url_producto);
					$url_producto = str_replace('|','',$url_producto);
					$url_producto = str_replace('°','',$url_producto);
					$url_producto = str_replace('!','',$url_producto);
					$url_producto = str_replace('¡','',$url_producto);
					$url_producto = str_replace('.','',$url_producto);
					$url_producto = str_replace('(','',$url_producto);
					$url_producto = str_replace(')','',$url_producto);
					$url_producto = stripslashes($url_producto);
					if ($id_marca != ""){
					$prefijo_marca = $safModel->getPrefijoMarca($id_marca);
					}
					$url_producto = $prefijo_marca."-".$url_producto;
					$check_url_product = $safModel->checkUrlProduct($url_producto);
					$check_url_product = FALSE; //si vamos a usar la url de los colores debemos tratar la url
					$publicar = $_POST['publicar'];
					if ($publicar == ""){ $published_producto = "0"; } else { $published_producto = "1";}
					$position_producto = $safModel->getMaxPositionProduct() + 1;
					if (($nombre_producto =! "") && ($check_url_product === FALSE)){
					if ($imagen_producto != ""){$responseimg = subir_imagen("imagen",APP_ROOT."static/images/lineas/marcas/productos/"); }
					if ($pdf_marca != ""){$responsepdf = subir_pdf("pdf",APP_ROOT."static/pdf/"); }
					if (($id_marca != "") && ($id_familiacolorproducto =! "") && ($id_gamacolorproducto =! "") && ($nombre_producto != "") && ($tonalidad1_producto != ""))// verificamos que se haya seleccionado la marca, la familia de color, ingresado el nombre y escogido la tonalidad
						{	
							$insertarProducto = $safModel->saveProduct($_POST['nombre_producto'], $codigo_producto, $imagen_producto, $pdf_producto, $tonalidad1_producto, $tonalidad2_producto, $tonalidad3_producto, $descripcion_producto, $url_producto, $published_producto, $position_producto, $id_marca, $_POST['id_familiacolorproducto'], $_POST['id_gamacolorproducto']);
						} else {
							$error .= "Error: no seleccionó una marca o una familia de color o no ingreso un nombre del producto o su tonalidad <br />".$responseimg."<br />"; 
							}
					$respuesta = "";
					if ($insertarProducto){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							El producto <strong>".$_POST['nombre_producto']."</strong> se guardó correctamente.
						</div>";
		} else {
		if ($responseimg === true){
		@unlink(APP_ROOT."static/images/lineas/marcas/productos/".$imagen_producto);//eliminamos la imagen subida
			}
		if ($responsepdf === true){
		@unlink(APP_ROOT."static/pdf/".$pdf_producto);//eliminamos el pdf si lo hubiera subido
		}
		if ($error != ""){
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó el producto ".$_POST['nombre_producto'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}
		}						
			$_SESSION['respuesta'] = $respuesta;
		?>
		 <script type="text/javascript"> window.location="nuevo_producto"; </script> 
		 <?php	
		} else {?> 
		 <script type="text/javascript"> window.location="nuevo_producto"; </script> 
         <?php
		$error .= "No ha ingresado un nombre o la url ya existe cambie el nombre de esta última."; 
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó el producto ".$_POST['nombre_producto'].".<br />CAUSAS: <br />".$error." 
						</div>";
		
					
			$_SESSION['respuesta'] = $respuesta;
			
		
		}
		}
	
		}
		/// editamos productos
		public function editar_productoAction()
		{
			$id_producto = (isset($_GET['id_producto']) ? (int)$_GET['id_producto'] : 0);
			if ($id_producto > 0)
			{
				 $safModel = new SafModel();
				 $producto = $safModel->getProductForId($id_producto);
				 $marcas = $safModel->getAllMarcas();
				 $familiacolorproductos = $safModel->getAllFamilyColorProduct();
				 $gamacolorproductos = $safModel->getAllGammaColorProduct();
				 $data['marcas'] = $marcas;
				 $data['familiacolorproductos'] = $familiacolorproductos;
				 $data['gamacolorproductos'] = $gamacolorproductos;
				 $data['producto'] = $producto;
				 $data['view'] = "saf/producto/editar_producto.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=marcas">
			<?php	}
		}

	public function editproductAction()
			{
				if ($_POST){
				$error = "";
				$id_producto = $_POST['id_producto'];
				$id_marca = $_POST['id_marca'];
				$nombre_producto = $_POST['nombre_producto'];
				$codigo_producto = $_POST['codigo_producto'];
				$id_familiacolorproducto = $_POST['id_familiacolorproducto'];
				$id_gamacolorproducto = $_POST['id_gamacolorproducto'];
				$tonalidad1_producto = $_POST['tonalidad1_producto'];
				$tonalidad2_producto = $_POST['tonalidad2_producto'];
				if ($tonalidad2_producto == ""){ $tonalidad2_producto = $_POST['hidden_tonalidad2_producto'];}
				$tonalidad3_producto = $_POST['tonalidad3_producto'];
				if ($tonalidad3_producto == ""){ $tonalidad3_producto = $_POST['hidden_tonalidad3_producto'];}
				$descripcion_producto = $_POST['descripcion_producto'];
				$published = $_POST['publicar'];
				if ($published){
				$published_producto = "1";
				} else {
				$published_producto = "0";
				}
				if ($_FILES['imagen']['name'] != ""){
				$imageUploadProduct = subir_imagen("imagen",APP_ROOT."static/images/lineas/marcas/productos/");
				$imagen_producto = $_FILES['imagen']['name'];
				}else { $imagen_producto = $_POST['hidden_imagen_producto'];}
				if ($_FILES['pdf']['name'] != ""){
				$pdfupload = subir_pdf("pdf",APP_ROOT."static/pdf/");
				$pdf_producto = $_FILES['pdf']['name'];
				}else { $pdf_producto = $_POST['hidden_pdf'];}
				if (($id_marca != "") && ($nombre_producto != "") && ($codigo_producto != "") && ($id_familiacolorproducto != "") && ($id_gamacolorproducto != "") && ($tonalidad1_producto != "")){		
				$safModel = new SafModel();
				$updateProduct = $safModel->updateProduct($id_producto, $_POST['nombre_producto'], $_POST['codigo_producto'], $imagen_producto, $pdf_producto, $tonalidad1_producto, $tonalidad2_producto, $tonalidad3_producto, $descripcion_producto, $published_producto, $_POST['id_marca'], $_POST['id_familiacolorproducto'], $_POST['id_gamacolorproducto']);

				}
				else { $error .= $imageUploadProduct;}
				if ($updateProduct){
					$respuesta .= "<div class=\"alert alert-success\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								El producto <strong>".$_POST['nombre_producto']."</strong> se actualizó correctamente.
							</div>";
					} 
				else {
					if ($imageUploadProduct === true){
					@unlink(APP_ROOT."static/images/lineas/marcas/productos/".$imageUploadProduct);}
					if ($pdfupload === true){
					@unlink(APP_ROOT."static/pdf/".$pdf_producto);}
					$error .= "no hubo actualización";
					$respuesta .= "<div class=\"alert alert-error\">
								<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								<strong>Error!</strong> No se actualizó el producto ".$_POST['nombre_producto'].".<br />CAUSAS: <br />".$error." 
							</div>";
					}
					$_SESSION['respuesta'] = $respuesta;
				?>
			 <script type="text/javascript"> window.location="editar_producto?id_producto=<?php echo $id_producto;?>"; </script> 
			 <?php
				}
			}

	// eliminamos el típo de producto
	public function eliminar_productoAction()
		{
			$id_producto = (isset($_GET['id_producto']) ? (int)$_GET['id_producto'] : 0);
			if ($id_producto > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();
				 $producto = $safModel->getProductForId($id_producto);
				 $imagen_producto = $producto->imagen_producto;				 
				 $productoEliminado = $safModel->deleteProduct($id_producto);				 
				 if ($productoEliminado){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Producto eliminado correctamente.
						</div>";
					if ($imagen_producto != ""){ @unlink(APP_ROOT."static/images/lineas/marcas/productos/".$imagen_producto); }					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó el producto. 
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=productos">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=productos">
			<?php
		}

	/*@subimos las productos de posición
	@public
	@function upproductoAction
	@autor:
	@return: 
	*/
	public function upproductoAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $subir = $safModel->orderUpRegister("producto",$id_table);
		 return $subir;
		// $_SESSION['mensaje'] = $subir;	
    }
	/*@bajamos las productos de posición
	@public
	@function downproductoAction
	@autor:
	@return: 
	*/	
	public function downproductoAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $bajar = $safModel->orderDownRegister("producto",$id_table);
		 echo $bajar;
		// $_SESSION['mensaje'] = $bajar;	
    }
	
	/***************************NOVEDADES**************************************/
	public function nueva_novedadAction()
	{
		 $data['view'] = "saf/novedad/nueva_novedad.php"; // Seteamos la vista
		 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	

	}
	
	//guardamos una novedad
		public function guardar_nueva_novedadAction()
		{				 
		    if ($_POST)
				{
					$error = "";
					$safModel = new SafModel();
					$nombre_novedad = $_POST['nombre_novedad'];
					$imagen_novedad = $_FILES['imagen']['name'];
					$detalle_novedad = $_POST['detalle_novedad'];
					$url_novedad = inc_formatea_cadena_get($nombre_novedad);
					$url_novedad = str_replace('Á','a',$url_novedad);
					$url_novedad = str_replace('É','e',$url_novedad);
					$url_novedad = str_replace('Í','i',$url_novedad);
					$url_novedad = str_replace('Ó','o',$url_novedad);
					$url_novedad = str_replace('Ú','u',$url_novedad);
					$url_novedad = str_replace('á','a',$url_novedad);
					$url_novedad = str_replace('é','e',$url_novedad);
					$url_novedad = str_replace('í','i',$url_novedad);
					$url_novedad = str_replace('ó','o',$url_novedad);
					$url_novedad = str_replace('ú','u',$url_novedad);
					$url_novedad = str_replace('Ñ','n',$url_novedad);
					$url_novedad = str_replace('ñ','n',$url_novedad);
					$url_novedad = str_replace('&','and',$url_novedad);
					$url_novedad = str_replace('?','',$url_novedad);
					$url_novedad = str_replace('¿','',$url_novedad);
					$url_novedad = str_replace('-','_',$url_novedad);
					$url_novedad = str_replace('#','',$url_novedad);
					$url_novedad = str_replace('|','',$url_novedad);
					$url_novedad = str_replace('°','',$url_novedad);
					$url_novedad = str_replace('!','',$url_novedad);
					$url_novedad = str_replace('¡','',$url_novedad);
					$url_novedad = str_replace('.','',$url_novedad);
					$url_novedad = str_replace('(','',$url_novedad);
					$url_novedad = str_replace(')','',$url_novedad);
					$url_novedad = stripslashes($url_novedad);
					$check_url_novedad = $safModel->checkUrlNovedad($url_novedad);
					$publicar = $_POST['publicar'];
					if ($publicar == ""){ $published_novedad = "0"; } else { $published_novedad = "1";}
					$position_novedad = $safModel->getMaxPositionNovedad() + 1;
					if (($nombre_novedad =! "") && ($check_url_novedad === FALSE)){
					if ($imagen_novedad != ""){$responseimg = subir_imagen("imagen",APP_ROOT."static/images/novedades/"); }
					if ($nombre_novedad != "")// verificamos que tenga un nombre al menos la línea 
						{		
							$insertarNovedad = $safModel->saveNovelty(utf8_decode($_POST['nombre_novedad']), $imagen_novedad, $detalle_novedad, $url_novedad, $published_novedad, $position_novedad);
						} else {
							$error .= "Error: No hay nombre de esta novedad <br />".$responseimg."<br />"; 
							}
					$respuesta = "";
					if ($insertarNovedad){				
						$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La novedad <strong>".$_POST['nombre_novedad']."</strong> se guardó correctamente.
						</div>";
		} else {
		if ($responseimg == true){
		@unlink(APP_ROOT."static/images/novedades/".$imagen_novedad);//eliminamos la imagen subida
			}
		$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se guardó la novedad ".$_POST['nombre_novedad'].".<br />CAUSAS: <br />".$error." 
						</div>";
		}									
		?>
		 <script type="text/javascript"> window.location="nueva_novedad"; </script> 
		 <?php	
		} else { $error .= "No ha ingresado un nombre o la url ya existe cambie el nombre."; 
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />".$error." 
						</div>";
		}

		$_SESSION['respuesta'] = $respuesta;
		}
	
		}
	
	
	
	public function novedadesAction()
	{
		 $safModel = new SafModel();
		 $novedades = $safModel->getAllNoveltys();
		 $data['novedades'] = $novedades;
		 $data['view'] = "saf/novedad/novedades.php"; // Seteamos la vista
		 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
	}
	
	/*@subimos las productos de posición
	@public
	@function upproductoAction
	@autor:
	@return: 
	*/
	public function upnovedadAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $subir = $safModel->orderUpRegister("novedad",$id_table);
		 return $subir;
		// $_SESSION['mensaje'] = $subir;	
    }
	/*@bajamos las productos de posición
	@public
	@function downproductoAction
	@autor:
	@return: 
	*/	
	public function downnovedadAction()
	{
		$id_table = $_GET['subaction']; 
		 $safModel = new SafModel();
		 $bajar = $safModel->orderDownRegister("novedad",$id_table);
		 echo $bajar;
		// $_SESSION['mensaje'] = $bajar;	
    }
	
	/// vemos las líneas		
		public function ver_novedadAction()
		{
			$id_novedad = (isset($_GET['id_novedad']) ? (int)$_GET['id_novedad'] : 0);
			if ($id_novedad > 0)
			{
				 $safModel = new SafModel();
				 $novedad = $safModel->getNoveltyForId($id_novedad);
				 $data['novedad'] = $novedad;
				 $data['view'] = "saf/novedad/ver_novedad.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=novedades">
			<?php	}
		}
		
	/// editamos una novedad		***
		public function editar_novedadAction()
		{
			$id_novedad = (isset($_GET['id_novedad']) ? (int)$_GET['id_novedad'] : 0);
			if ($id_novedad > 0)
			{
				 $safModel = new SafModel();
				 $novedad = $safModel->getNoveltyForId($id_novedad);
				 $data['novedad'] = $novedad;
				 $data['view'] = "saf/novedad/editar_novedad.php"; // Seteamos la vista
				 $this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista 	
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=novedades">
			<?php	}
		}
		
	public function editnoveltyAction()
		{
			if ($_POST){
			$error = "";
			$id_novedad = $_POST['id_novedad'];
			$nombre_novedad = $_POST['nombre_novedad'];
			$detalle_novedad = $_POST['detalle_novedad'];
			$published = $_POST['published_novedad'];
			if ($published){
			$published_novedad = "1";
			} else {
			$published_novedad = "0";
			}
			if ($_FILES['imagen_novedad']['name'] != ""){
			$imageUploadNovelty = subir_imagen("imagen_novedad",APP_ROOT."static/images/novedades/");
			$imagen_novedad = $_FILES['imagen_novedad']['name'];
			}else { $imagen_novedad = $_POST['hidden_imagen_novedad']; $imageUploadNovelty = true;}
			if ($id_novedad != ""){		
			$safModel = new SafModel();
			$updateNovelty = $safModel->updateNovelty($id_novedad, $nombre_novedad, $imagen_novedad, $_POST['detalle_novedad'], $published_novedad);
			}
			else { $error .= $imageUploadNovelty;}
			if ($updateNovelty){
				$respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							La novedad <strong>".$_POST['nombre_novedad']."</strong> se actualizó correctamente.
						</div>";
				} 
			else {
				$error .= "no hubo actualización";
				$respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se actualizó la novedad ".$_POST['nombre_novedad'].".<br />CAUSAS: <br />".$error." 
						</div>";
				}
				$_SESSION['respuesta'] = $respuesta;
			?>
		 <script type="text/javascript"> window.location="editar_novedad?id_novedad=<?php echo $id_novedad;?>"; </script> 
		 <?php
			}
		}	
	// eliminamos la línea
	public function eliminar_novedadAction()
		{
			$id_novedad = (isset($_GET['id_novedad']) ? (int)$_GET['id_novedad'] : 0);
			if ($id_novedad > 0)
			{
				$respuesta = "";
				 $safModel = new SafModel();
				 $novedad = $safModel->getNoveltyForId($id_novedad);
				 $imagen_novedad = $novedad->imagen_novedad;				 
				 $novedadEliminada = $safModel->deleteNovelty($id_novedad);
				 if ($imagen_novedad != ""){ @unlink(APP_ROOT."static/images/novedades/".$imagen_novedad); }
				 if ($novedadEliminada){
					 $respuesta .= "<div class=\"alert alert-success\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							Novedad eliminada correctamente.
						</div>";					 
					 } else {
					 $respuesta .= "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong> No se eliminó la novedad
						</div>";	 
						 }
				 $_SESSION['respuesta'] = $respuesta;
			}else{ ?>
				 <meta http-equiv="refresh" content="0;url=novedades">
			<?php	}
			 ?>            
				 <meta http-equiv="refresh" content="0;url=novedades">
			<?php
		}
		










































	 
	public function articuloAction()
	{    
		$subaction = $_GET['subaction'];
		$safmodel = new SafModel(); 	
	switch($subaction){
		case "nuevo":
		if (isset($_POST['id_tipo_articulo'])){
			$id_tipo_articulo = stringHtmlSeguro($_POST['id_tipo_articulo']);
			$nombre_articulo = stringHtmlSeguro($_POST['nombre_articulo']);
			$descripcion_articulo = stringHtmlSeguro($_POST['descripcion_articulo']);
			$guardararticulo = $this->insertarNuevoArticulo($id_tipo_articulo, $nombre_articulo, $descripcion_articulo);
			$data['respuesta'] = $guardararticulo;
			}
			$data['tipo_articulo'] = $safmodel->obtenerTodosLosTiposDeArticulos();
			$data['view'] = "saf/articulo/index.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  			
		break;
		case "mostrar":
			$safmodel = new SafModel();
			$namex = $_GET['namex'];
			$articulos = $safmodel->obtenerTodosLosArticulos($namex);
			$categoria_namex = $namex;
			if ($categoria_namex == ""){$categoria_namex = "1";}
			$name_categoria = $safmodel->obtenerNombreCategoriaArticulo($categoria_namex);
			$data['name_categoria'] = $name_categoria;
			$data['categoria'] = $safmodel->obtenerTodosLosTiposDeArticulos();
			$data['articulos'] = $articulos;
			$data['view'] = "saf/articulo/mostrar.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  	
		break;
		case "editar":
		$_SESSION['respuesta'] = "";
		$safmodel = new SafModel();
		if ($_POST['id_articulo'] != ""){
			$id_articulo = stringSeguro($_POST['id_articulo']);
			$id_tipo_articulo = stringSeguro($_POST['id_tipo_articulo']);
			$nombre_articulo = stringSeguro($_POST['nombre_articulo']);  
			$descripcion_articulo = stringSeguro($_POST['descripcion_articulo']);  
			$pelicula_update = $safmodel->editarArticulo($id_articulo, $id_tipo_articulo, $nombre_articulo, $descripcion_articulo);
			$respuesta = "";
			if ($pelicula_update){
				$respuesta .= "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">Artículo $nombre_articulo actualizado correctamente</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";} else {$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se Actualizo el artículo \"$nombre_articulo\"</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";}
				$_SESSION['respuesta'] = $respuesta;
				header("Location:" . HTML_PATH . "saf/articulo/mostrar/");

			}
		$id_articulo = stringSeguro($_GET['namex']);
		
		if ($id_articulo != ""){
		$articulo = $safmodel->obtenerArticuloPorId($id_articulo);
		$categorias = $safmodel->obtenerTodosLosTiposDeArticulos();
		$idNombreCategoriaArticulo = $safmodel->obtenerIdNombreCategoriaArticulo($id_articulo);
		$data['categorias'] = $categorias;
		$data['idnombrecategoriarticulo']=$idNombreCategoriaArticulo;
		    $data['articulo'] = $articulo;
			$data['id_articulo'] = $id_articulo;
			$data['view'] = "saf/articulo/editar.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista
		}//else { echo "error";}
		break;
		default:
		}
	
	   //}
	} 
	
	private function insertarNuevoArticulo($id_tipo_articulo, $nombre_articulo, $descripcion_articulo)
	{
			$resultado = "";
			
			//verificar si existe el titulo de la pelicula
			if ($nombre_articulo != ""){
				$safmodel = new SafModel();
			if (($id_tipo_articulo !="") && ($nombre_articulo !="")){
				$safmodel = new SafModel();
			$artiguardada = $safmodel->insertarNuevoArticulo($id_tipo_articulo, $nombre_articulo, $descripcion_articulo);
			if ($artiguardada){ 
			$noerror =  "El artículo ".stripslashes($nombre_articulo)." se ha guardado satisfactoriamente.";
			$resultado = "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">".$noerror."</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
							  } else { $error =  "el artículo no se guardo";
							  $resultado .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">".$error."</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
							  }
							 }
						
				}
				return $resultado;
		}
		
	public function eliminararticuloAction()
	{
	$safmodel = new SafModel();
	$categoriax = stringSeguro($_GET['subaction']);
	$articulo_id = stringSeguro($_GET['namex']);
	if ($articulo_id != ""){
	 $articuloeliminado = $safmodel->eliminarArticulo($articulo_id);
	 
	 if ($articuloeliminado){
				$respuesta .= "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">Artículo eliminado</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";} else {$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se elimino el artículo</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";}
				$_SESSION['respuesta'] = $respuesta;
				header("Location:".HTML_PATH."saf/articulo/mostrar/".$categoriax);	
	 						}
												
	}
	
	//VESTIDO
	
		public function vestidoAction()
	{    
		$subaction = $_GET['subaction'];
		$safmodel = new SafModel(); 	
	switch($subaction){
		case "nuevo":
		if (isset($_POST['categoria_id'])){
			$categoria_id = stringHtmlSeguro(utf8_decode($_POST['categoria_id']));
			$nombre = stringHtmlSeguro(utf8_decode($_POST['nombre']));
			$colores = stringHtmlSeguro(utf8_decode($_POST['colores']));
			$coleccion = stringHtmlSeguro(utf8_decode($_POST['coleccion']));
			$imagen = $_FILES['imagen']['name'];
			$imagen_grande = $_FILES['imagen_grande']['name'];
			$precio = stringHtmlSeguro(utf8_decode($_POST['precio']));
			$descripcion = stringHtmlSeguro(utf8_decode($_POST['descripcion']));
			$guardararticulo = $this->insertarNuevoVestido($categoria_id, $nombre, $colores, $coleccion, $imagen ,$imagen_grande, $precio, $descripcion);
		if ($imagen != ""){ subir_jpg("imagen","static/images/catalogo/ropamaterna/"); } 
		if ($imagen_grande != ""){ subir_jpg("imagen_grande","static/images/catalogo/ropamaterna/"); }
		$data['respuesta'] = $guardararticulo;
			}

		$data['categoria'] = $safmodel->obtenerTodosLasCategoriasDeVestidos();
		$data['view'] = "saf/vestido/index.php"; // Seteamos la vista
		$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  			
		break;
		case "mostrar":
			$safmodel = new SafModel();
			$namex = $_GET['namex'];
			$vestidos = $safmodel->obtenerTodosLosVestidos($namex);
			$categoria_namex = $namex;
			if ($categoria_namex == ""){$categoria_namex = "1";}
			$name_categoria = $safmodel->obtenerNombreCategoriaVestido($categoria_namex);
			$data['namex'] = $_GET['namex'];
			$data['name_categoria'] = $name_categoria;
			$data['vestidos'] = $vestidos;
			$data['categoria'] = $safmodel->obtenerTodosLasCategoriasDeVestidos();
			$data['view'] = "saf/vestido/mostrar.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  	
		break;
		case "editar":
		$_SESSION['respuesta'] = "";
		$safmodel = new SafModel();
		$data['categoria'] = $safmodel->obtenerTodosLasCategoriasDeVestidos();
		if ($_POST['id'] != ""){
			$id = stringSeguro($_POST['id']);
			$categoria_id = stringSeguro($_POST['categoria_id']);
			$nombre = stringSeguro($_POST['nombre']);  
			$colores = stringSeguro($_POST['colores']);  
			$coleccion = stringSeguro($_POST['coleccion']);
			if ($_FILES['imagen']['name'] != ""){
			subir_jpg("imagen","static/images/catalogo/ropamaterna/");
			$imagen = $_FILES['imagen']['name'];
			}else { $imagen = $_POST['hidden_imagen'];}
			if ($_FILES['imagen_grande']['name'] != ""){
			subir_jpg("imagen_grande","static/images/catalogo/ropamaterna/");
			$imagen_grande = $_FILES['imagen_grande']['name'];
			}else { $imagen_grande = $_POST['hidden_imagen_grande'];}
			$precio = stringSeguro($_POST['precio']);
			$descripcion = stringSeguro($_POST['descripcion']);
			$pelicula_update = $safmodel->editarVestido($id, $categoria_id, $nombre, $colores, $coleccion, $imagen,$imagen_grande, $precio, $descripcion);
			$respuesta = "";
			if ($pelicula_update){
				$nombre_categoria = $safmodel->obtenerNombreCategoriaVestido($categoria_id);
				$respuesta .= "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">Vestido <a href=\"".HTML_PATH."catalogo/vestido/".$nombre_categoria."/".$id."\" target=\"_blank\">$nombre</a> actualizado correctamente  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ¿<a href=\"".HTML_PATH."saf/vestido/editar/".$id."/\">reeditar</a>?</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";} else {$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se Actualizo el vestido \"$nombre\"</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";}
				$_SESSION['respuesta'] = $respuesta;
				$cat_idx = $categoria_id;
				if ($cat_idx == ""){$cat_idx = "1";}
				header("Location:" . HTML_PATH . "saf/vestido/mostrar/".$cat_idx."/");
			}
		$id = stringSeguro($_GET['namex']);
		
		if ($id != ""){
		$vestido = $safmodel->obtenerVestidoPorId($id);
		    $data['vestido'] = $vestido;
			$data['id'] = $id;
			$data['view'] = "saf/vestido/editar.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista
		}//else { echo "error";}
		break;
		case "categoriavestido":
			$safmodel = new SafModel();
			$namex = $_GET['namex'];
			$articulos = $safmodel->obtenerTodosLosArticulos($namex);
			$categoria_namex = $namex;
			if ($categoria_namex == ""){$categoria_namex = "1";}
			$name_categoria = $safmodel->obtenerNombreCategoriaArticulo($categoria_namex);
			$data['name_categoria'] = $name_categoria;
			$data['categoria'] = $safmodel->obtenerTodosLosTiposDeArticulos();
			$data['articulos'] = $articulos;
			$data['view'] = "saf/vestido/categoriavestido.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista  	
		
		break;
		default:
		}
	
	   //}
	} 
	
	private function insertarNuevoVestido($categoria_id, $nombre, $colores, $coleccion, $imagen ,$imagen_grande, $precio, $descripcion)
	{
			$resultado = "";
			
			//verificar si existe el titulo de la pelicula
			if ($nombre != ""){
				$safmodel = new SafModel();
			if (($categoria_id !="") && ($nombre !="")){
				$safmodel = new SafModel();
			$guardada = $safmodel->insertarNuevoVestido($categoria_id, $nombre, $colores, $coleccion, $imagen ,$imagen_grande, $precio, $descripcion);
			if ($guardada){ 
			$noerror =  "El vestido ".stripslashes($nombre)." se ha guardado satisfactoriamente.";
			$resultado = "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">".$noerror."</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
							  } else { $error =  "el vestido no se guardo";
							  $resultado .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">".$error."</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
							  }
							 }
						
				}
				return $resultado;
		}
		
			public function eliminarvestidoAction()
	{
	$safmodel = new SafModel();
	$categoriax = stringSeguro($_GET['subaction']);
	$id = stringSeguro($_GET['namex']);
	$positionx = $safmodel->obtenerPosicionDeVestido($id,$categoriax);
	if ($id != ""){
	 $vestidoeliminado = $safmodel->eliminarVestido($id,$categoriax);
	 
	 if ($vestidoeliminado){
		 $actualizarposicion = $this->updatePosicionDeVestidos($categoriax,$positionx);
				$respuesta .= "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">Vestido eliminado</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";} else {$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se elimino el vestido</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";}
				$_SESSION['respuesta'] = $respuesta;
				header("Location:".HTML_PATH."saf/vestido/mostrar/".$categoriax);	
	 						}
												
	}
	
	public function micuentaAction()
	{
		$data['view'] = "saf/micuenta/editar.php"; // Seteamos la vista
			$this->_view->render('../layouts/saf/layout.php',$data);   // renderizamos la vista
		
		}
	public function cambiarpasswordAction()
	{
		$neopass1 = stringSeguro($_POST['pass1']);
		$neopass2 = stringSeguro($_POST['pass2']);
		if ($_SESSION['admin'] != ""){
		if (($neopass1 != "") && ($neopass2 != "") && ($neopass1 == $neopass2)){
			$safmodel = new SafModel();
			$actualizapass = $safmodel->actualizarPassDeAdministrador($_SESSION['admin'],sha1($neopass1));
			if ($actualizapass){
				$respuesta = "";
				$respuesta .= "<div id=\"message-green\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"green-left\">Password actualizado correctamente</td>
					<td class=\"green-right\"><a class=\"close-green\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_green.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
				} else {
					$respuesta = "";
					$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se actualizo el password</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
					}
			}
			else {
				$respuesta = "";
					$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">No se actualizo el password</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
				}
				$_SESSION['respuesta'] = $respuesta;
		}
		header("Location:" . HTML_PATH . "saf/micuenta");
		}
// PAGINA ROPA MATERNA		
	public function load_dataAction()
	{ if($_POST['page']){
		$indexModel = new IndexModel();
		$safModel = new SafModel();
		$page = $_POST['page'];
		$namex = $_POST['namex'];
		if ($namex == ""){$namex = 1;}
		$subaction = $safModel->obtenerUrlCategoriaVestido($namex);
		$categoria = $indexModel->obtenerIdDeUrlDeCategoria($namex);
				if ($categoria->id == ""){
		/* echo "<script> window.location=\"".HTML_PATH."catalogo\";</script>"; */
			}
		$pagination = new PaginasafvestidoHelper("vestido",12,$page,$namex,$subaction);
		$paginado = $pagination->generarestructura();
		echo $paginado;
		}
	 }	 
	 
	public function load_datapaginaAction()
	{ 
	if($_POST['page']){
		$indexModel = new IndexModel();
		$safModel = new SafModel();
		$page = $_POST['page'];
		$namex = $_POST['namex'];
		if ($namex == ""){$namex = 1;}
		$subaction = $safModel->obtenerUrlCategoriaVestido($namex);
		$categoria = $indexModel->obtenerIdDeUrlDeCategoria($namex);
		$paginationc = new PaginasafvestidoHelper("vestido",12,$page,$namex,$subaction);
		$linkspaginacion = $paginationc->obtenerLinksDePaginacion();
		echo $linkspaginacion; 
		}
	}
// FIN PAGINA ROPA MATERNA

// PAGINA CATEGORIA DE ROPA MATERNA
	public function load_datacategoriavestidoAction()
	{ if($_POST['page']){
		$indexModel = new IndexModel();
		$safModel = new SafModel();
		$page = $_POST['page'];
		$namex = $_POST['namex'];
		if ($namex == ""){$namex = 1;}
		$subaction = $safModel->obtenerUrlCategoriaVestido($namex);
		$categoria = $indexModel->obtenerIdDeUrlDeCategoria($namex);
				if ($categoria->id == ""){
		/* echo "<script> window.location=\"".HTML_PATH."catalogo\";</script>"; */
			}
		$pagination = new PaginaSafCategoriaVestidoHelper("categoria",12,$page,$namex,$subaction);
		$paginado = $pagination->generarestructura();
		echo $paginado;
		}
	 }	 
	 
	public function load_datapaginacategoriavestidoAction()
	{ 
	if($_POST['page']){
		$indexModel = new IndexModel();
		$safModel = new SafModel();
		$page = $_POST['page'];
		$namex = $_POST['namex'];
		if ($namex == ""){$namex = 1;}
		$subaction = $safModel->obtenerUrlCategoriaVestido($namex);
		$categoria = $indexModel->obtenerIdDeUrlDeCategoria($namex);
		$paginationc = new PaginaSafCategoriaVestidoHelper("categoria",12,$page,$namex,$subaction);
		$linkspaginacion = $paginationc->obtenerLinksDePaginacion();
		echo $linkspaginacion; 
		}
	}
// FIN PAGINA CATEGORIA DE ROPA MATERNA	
	public function upvestidoAction()
	{
		if ($_POST['id']){
			$id = $_POST['id'];
			$categoria_id = $_POST['categoria_id'];
			$safModel = new SafModel();
			$subevestido = $safModel->updatePositionUpVestido($categoria_id,$id);
			echo $subevestido;
		}
	}	
		
	public function downvestidoAction()
	{
		if ($_POST['id']){
			$id = $_POST['id'];
			$categoria_id = $_POST['categoria_id'];
			$safModel = new SafModel();
			$bajavestido = $safModel->updatePositionDownVestido($categoria_id,$id);
			echo $bajavestido;
			}
		}
	public function insertarNuevaCategoriaRopaMaternaAction()
	{
			$nombre = stringSeguro($_POST['nombre']);
			if ($nombre != ""){
			$namex = inc_formatea_cadena_get($nombre);
			$namex = str_replace('Á','A',$namex);
			$namex = str_replace('É','E',$namex);
			$namex = str_replace('Í','I',$namex);
			$namex = str_replace('Ó','O',$namex);
			$namex = str_replace('Ú','U',$namex);
			$namex = str_replace('á','a',$namex);
			$namex = str_replace('é','e',$namex);
			$namex = str_replace('í','i',$namex);
			$namex = str_replace('ó','o',$namex);
			$namex = str_replace('ú','u',$namex);
			$namex = str_replace('Ñ','n',$namex);
			$namex = str_replace('ñ','n',$namex);
			$namex = str_replace('&','and',$namex);
			$namex = str_replace('?','',$namex);
			$namex = str_replace('¿','',$namex);
			$namex = str_replace('#','',$namex);
			$namex = str_replace('|','',$namex);
			$namex = str_replace('°','',$namex);
			$namex = str_replace('!','',$namex);
			$namex = str_replace('¡','',$namex);
			$namex = str_replace('.','',$namex);
			$namex = str_replace('(','',$namex);
			$namex = str_replace(')','',$namex);
			$namex = stripslashes($namex);
			$safModel = new SafModel();
			$insertaCategoriaRopaMaterna = $safModel->insertarNuevaCategoriaRopaMaterna($nombre,$namex);
			?>
			 <script type="text/javascript"> window.location="<?php echo HTML_PATH."saf/vestido/categoriavestido/"; ?>"; </script>
			 <?php
			if ($insertaCategoriaRopaMaterna != 0){ return true;} else { return false;} 
			}
			?>
			 <script type="text/javascript"> window.location="<?php echo HTML_PATH."saf/vestido/categoriavestido/"; ?>"; </script>
			 <?php
		}
		public function eliminarcategoriaropamaternaAction()
		{
			$id = stringSeguro($_GET['subaction']);
		 $safmodel = new SafModel();
		 $eliminacategoria = $safmodel->eliminarCategoriaRopaMaterna($id);
		 $respuesta = "";
					$respuesta .= "<div id=\"message-red\">
				<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td class=\"red-left\">".$eliminacategoria."</td>
					<td class=\"red-right\"><a class=\"close-red\"><img src=\"".HTML_PATH_IMAGES."table/icon_close_red.gif\"   alt=\"\" /></a></td>
				</tr>
				</table>
				</div>";
				$_SESSION['respuesta'] = $respuesta;
				?>
			 <script type="text/javascript"> window.location="<?php echo HTML_PATH."saf/vestido/categoriavestido/"; ?>"; </script>
			 <?php	
			}
			
	public function actualizarPosicionDeVestidosAction()
	{//ESTE METODO ES PARA ACTUALIZAR LAS POSICIONES DE LA BASE DE DATOS
	$safModel = new SafModel();
	if ($categoria_id == ""){
		for ($z = 1; $z <=4; $z++){ //tomando en cuenta las 4 categorias
		$categoria_id = $z;
	$qty = $safModel->qtyvestidos($categoria_id);
	$vestidos = $safModel->obtenervestidos($categoria_id);
	for ($i = $qty; $i >= 0; $i--) {
	if ($i != $qty){
	$x = $i + 1;
	$actualizaposition = $safModel->cargarposiciones($categoria_id,$vestidos[$i]['id'],$x);
	 echo $x." - ".$vestidos[$i]['id']."<br />";
	} else { $x = ""; } 
									}
								   }
							}	
	}	
	
	public function updatePosicionDeVestidos($categoria_id,$positionx)
	{
	$safModel = new SafModel();
	if ($categoria_id != ""){
	//$cargar = $safModel->cargarpositionc();
	$qty = $safModel->qtyvestidos($categoria_id);
	$vestidos = $safModel->obtenerVestidosPosicionados($categoria_id);
	for ($i = $qty; $i >= 0; $i--) {
	if ($i != $qty){
	$x = $i + 1;
	$actualizaposition = $safModel->cargarpositionc($categoria_id,$vestidos[$i]['id'],$x,$positionx);
	//echo $x." - ".$vestidos[$i]['id']." - ".$vestidos[$i]['position']." - ".$positionx."<br />";
	// exit();
	} else { $x = "";} 
									}
							}	
	}						 		
}