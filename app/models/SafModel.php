<?php
require_once(APP_ROOT_CLASES."Database.php");
class SafModel
{
	private $_table_administrador = "administrador";
	public function __construct(){}
	public function validarAdministrador($user, $pass)
	{
	try {
	$dbh = Database::getInstance();
	$sql = "SELECT id_administrador, nombre_administrador FROM ". $this->_table_administrador . " WHERE nombre_administrador = ? AND pass_administrador = ? ";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(1, trim($user));
	 $sth->bindParam(2, trim(sha1($pass)));
	 $sth->execute();
	$campos = $sth->fetchAll();
	if (count($campos) >= 1){ return true;} else { return false;}
	}catch (PDOException $e) {
      die( 'Fallo en query: ' . $e->getMessage() );}
	}
	
	/*
	@function actualizarPassDeAdministrador
	@return
	*/
	public function actualizarPassDeAdministrador($id_administrador,$nuevo_password)
	{
	try {
	$dbh = Database::getInstance();
	$sql = "UPDATE " . $this->_table_administrador . " SET administrador_clave = :administrador_clave WHERE id_administrador = :id_administrador";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(':id_administrador', $id_administrador, PDO::PARAM_STR);
	 $sth->bindParam(':administrador_clave', $nuevo_password, PDO::PARAM_STR);
	$campos = $sth->execute();
	return $campos; 
	}catch (PDOException $e) {
      die( 'Fallo en query: ' . $e->getMessage() );}
	}
	
				//@return $MaxPositionTable recursive method
	public function getMaxPositionTable($table){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_".$table.")) AS maximun FROM ".$table."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionTable = $sth->fetchObject();
			$MaxPositionTable = $ObjectMaxPositionTable->maximun;
			return $MaxPositionTable;
		}
	
	//@obtenemos todas las sedes
	   public function getSeats()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM sede ORDER BY ABS(position_sede) DESC";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//
		//@obtenemos todas las colegios de lima
	   public function getSeatsSchoolLima()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM sede WHERE ubicacion_sede = 'Lima' AND id_tipo_sede = '1'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//
	
			//@obtenemos todas las colegios de provincia
	   public function getSeatsSchoolProvince()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM sede WHERE ubicacion_sede = 'Provincia' AND id_tipo_sede = '1'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//
	
		//@obtenemos todas las academias de lima
	   public function getSeatsAcademyLima()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM sede WHERE ubicacion_sede = 'Lima' AND id_tipo_sede = '2'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//
	
		//@obtenemos todas las academias de provincia
	   public function getSeatsAcademyProvince()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM sede WHERE ubicacion_sede = 'Provincia' AND id_tipo_sede = '2'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//
	
	
		//@guardar noticia
		public function saveNotice($id_sede, $titulo_noticia, $sinopsis_noticia, $imagen_noticia, $video_noticia, $html_noticia, $fecha_noticia = "", $url_noticia, $linkevento_noticia, $position_noticia, $published)
			{
				try{
				$dbh = Database::getInstance();
				$sql = "INSERT INTO noticia (id_sede, titulo_noticia, sinopsis_noticia, imagen_noticia, video_noticia, html_noticia, fecha_noticia, fecha_update_noticia, url_noticia, linkevento_noticia, position_noticia, published) VALUES (:id_sede, :titulo_noticia, :sinopsis_noticia, :imagen_noticia, :video_noticia, :html_noticia, now(), now(), :url_noticia, :linkevento_noticia, :position_noticia, :published)";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':id_sede', $id_sede, PDO::PARAM_STR);
				$sth->bindParam(':titulo_noticia', $titulo_noticia, PDO::PARAM_STR);
				$sth->bindParam(':sinopsis_noticia', $sinopsis_noticia, PDO::PARAM_STR);
				$sth->bindParam(':imagen_noticia', $imagen_noticia, PDO::PARAM_STR);
				$sth->bindParam(':video_noticia', $video_noticia, PDO::PARAM_STR);
				$sth->bindParam(':html_noticia', $html_noticia, PDO::PARAM_STR);
				$sth->bindParam(':url_noticia', $url_noticia, PDO::PARAM_STR);
				$sth->bindParam(':linkevento_noticia', $linkevento_noticia, PDO::PARAM_STR);
				$sth->bindParam(':position_noticia', $position_noticia, PDO::PARAM_STR);
				$sth->bindParam(':published', $published, PDO::PARAM_STR);
				$sth->execute();
				$count = $sth->rowCount();
				return $count;						
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
	
			//@return $MaxPositionNotice
	public function getMaxPositionNotice(){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_noticia)) AS maximun FROM noticia";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionNotice = $sth->fetchObject();
			$MaxPositionNotice = $ObjectMaxPositionNotice->maximun;
			return $MaxPositionNotice;
		}	
			//@verificamos que no exista una url igual de noticia
		public function checkUrlNotice($url_noticia)
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT url_noticia FROM noticia WHERE url_noticia = ?";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(1, $url_noticia);
			 $sth->execute();
			 $url = $sth->fetchObject();
			 if ($url){ return true; }else{ return false; }	
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
			
		//@verificamos que no exista una url igual de noticia, esto es para que al actualizar la noticia con la misma url nos permita
		public function checkUrlNoticeDisticnt($id_noticia, $url_noticia)
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT url_noticia FROM noticia WHERE id_noticia != ? AND url_noticia = ?";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(1, $id_noticia);
			 $sth->bindParam(2, $url_noticia);
			 $sth->execute();
			 $url = $sth->fetchObject();
			 if ($url){ return true; }else{ return false; }	
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
			
			// obtenemos todas las noticias
			public function getAllNotices(){
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM noticia ORDER BY ABS(position_noticia) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayNoticias = $sth->fetchAll();
			return $arrayNoticias;
		}
		
			
		
		// obtenemos una sede por su id
			public function getSeatForId($id_sede)
				{
					$dbh = Database::getInstance();
					$sql = "SELECT nombre_sede FROM sede WHERE id_sede = ?";
					$sth = $dbh->prepare($sql);
					$sth->bindParam(1, $id_sede);
					$sth->execute();
					$seat = $sth->fetchObject();
					return $seat;
				}
				// obtenemos una sede por su id
			public function getInfoSeatForId($id_sede)
				{
					$dbh = Database::getInstance();
					$sql = "SELECT * FROM sede WHERE id_sede = ?";
					$sth = $dbh->prepare($sql);
					$sth->bindParam(1, $id_sede);
					$sth->execute();
					$seat = $sth->fetchObject();
					return $seat;
				}
			// obtenemos una noticia por su id
			public function getNoticeForId($id_noticia)
				{
					$dbh = Database::getInstance();
					$sql = "SELECT * FROM noticia WHERE id_noticia = ?";
					$sth = $dbh->prepare($sql);
					$sth->bindParam(1, $id_noticia);
					$sth->execute();
					$Noticia = $sth->fetchObject();
					return $Noticia;
				}
				
	//ACTUALIZAMOS UNA NOTICIA
		public function updateNotice($id_noticia, $id_sede, $titulo_noticia, $sinopsis_noticia, $imagen_noticia, $video_noticia, $html_noticia, $url_noticia, $linkevento_noticia, $published)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE noticia SET id_sede = :id_sede, titulo_noticia = :titulo_noticia, sinopsis_noticia = :sinopsis_noticia, imagen_noticia = :imagen_noticia, video_noticia = :video_noticia, html_noticia = :html_noticia, url_noticia = :url_noticia, linkevento_noticia = :linkevento_noticia, fecha_update_noticia = now(), published = :published WHERE id_noticia = :id_noticia";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_noticia', $id_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':id_sede', $id_sede, PDO::PARAM_STR);
			 $sth->bindParam(':titulo_noticia', $titulo_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':sinopsis_noticia', $sinopsis_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_noticia', $imagen_noticia, PDO::PARAM_STR);
			  $sth->bindParam(':video_noticia', $video_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':html_noticia', $html_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':url_noticia', $url_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':linkevento_noticia', $linkevento_noticia, PDO::PARAM_STR);
			 $sth->bindParam(':published', $published, PDO::PARAM_STR);
			 $novedad = $sth->execute();
			 if (!$novedad){ return false;} else { return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }	
			 
  			// metodo para eliminar una noticia
	    public function deleteNotice($id_noticia)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM noticia WHERE id_noticia = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_noticia));
			$deleteNoveltys = $sth->rowCount();
			return $deleteNoveltys;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}
			
  //////////////SEDE//////////////////////////////////////////////
  //@guardamos nueva sede
		public function saveSeat($id_tipopreparacion_sede, $nombre_sede, $direccion_sede, $telefono_sede, $html_sede, $ubicacion_sede, $coordenadas_sede, $url_sede, $position_sede, $published, $id_tipo_sede)
			{
				try{
				$dbh = Database::getInstance();
				$sql = "INSERT INTO sede (nombre_sede, direccion_sede, telefono_sede, html_sede, ubicacion_sede, coordenadas_sede, url_sede, position_sede, published, id_tipo_sede) VALUES (:nombre_sede, :direccion_sede, :telefono_sede, :html_sede, :ubicacion_sede, :coordenadas_sede, :url_sede, :position_sede, :published, :id_tipo_sede)";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':nombre_sede', $nombre_sede, PDO::PARAM_STR);
				$sth->bindParam(':direccion_sede', $direccion_sede, PDO::PARAM_STR);
				$sth->bindParam(':telefono_sede', $telefono_sede, PDO::PARAM_STR);
				$sth->bindParam(':html_sede', $html_sede, PDO::PARAM_STR);
				$sth->bindParam(':ubicacion_sede', $ubicacion_sede, PDO::PARAM_STR);
				$sth->bindParam(':coordenadas_sede', $coordenadas_sede, PDO::PARAM_STR);
				$sth->bindParam(':url_sede', $url_sede, PDO::PARAM_STR);
				$sth->bindParam(':position_sede', $position_sede, PDO::PARAM_STR);
				$sth->bindParam(':published', $published, PDO::PARAM_STR);
				$sth->bindParam(':id_tipo_sede', $id_tipo_sede, PDO::PARAM_STR);
				$sth->execute();
				$count = $sth->rowCount();
				$id_sede = $dbh->lastInsertId();

			if (($count) && ($id_sede != "")){
					$cuenta = 0;
				    $dbh = Database::getInstance();
				    $query = "INSERT INTO sede_has_tipopreparacion_sede (id_sede, id_tipopreparacion_sede) VALUES (:id_sede, :id_tipopreparacion_sede)"; 			
					$stmt = $dbh->prepare($query); 
					$stmt->bindParam(':id_sede', $id_sede, PDO::PARAM_STR);				
					foreach($id_tipopreparacion_sede as $val)
						{
						   $stmt->bindParam(':id_tipopreparacion_sede', $id_tipopreparacion_sede[$cuenta], PDO::PARAM_STR);
						   $stmt -> execute(); //execute
						   $cuenta++;				
						}
					$count = $stmt->rowCount();
					}
				return $count;						
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." linea:".__LINE__." - ". $e->getMessage() );
				 }
		}
		
		//@verificamos que no exista una url igual de sede
		public function checkUrlSeat($url_sede)
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT url_sede FROM sede WHERE url_sede = ?";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(1, $url_sede);
			 $sth->execute();
			 $url = $sth->fetchObject();
			 if ($url){ return true; }else{ return false; }	
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
		
		
			//@obtenemos todas los tipos de sede: colegio o academia
	   public function getTypesSeat()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM tipo_sede";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//	
	
				//@obtenemos todas los tipos de preparacion: UNI, San Marcos o Catolica
	   public function getTypesPreparationSeat()
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT * FROM tipopreparacion_sede";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $sedes = $sth->fetchAll();
			 return $sedes;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
	//	
		



		
	
	
	
	
	
	
	//
        public  function UpdateUrl(){
            try{
                $dbh = Database::getInstance();
                $sql = "UPDATE  tipo_producto SET  url_tipo_producto =  'recubrimientos_marinos_e_industriales' WHERE  id_tipo_producto = '8'";
                 $sth = $dbh->prepare($sql);
                $campos = $sth->execute();
	return $campos; 
            }  catch (PDOException $e){ die('Fail query');}
            
        }
   public function checkUrlBrand($url_marca)
	{
	try {
	 $dbh = Database::getInstance();
	 $sql = "SELECT url_marca FROM marca WHERE url_marca = ?";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(1, $url_marca);
	 $sth->execute();
	 $url = $sth->fetchObject();
	 if ($url){ return true; }else{ return false; }	
	 }catch (PDOException $e) {
      die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
	}
	//////////////////////// FRONT END METHODS /////////////////////////////////////////
	//@return $arrayLineas
	//@devuelve las líneas publicadas
	public function getAllLinesPublished(){
		try {
			$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}// manejo de idiomas aquí, cambiamos el sql	
			$sql = "SELECT * FROM linea WHERE published_linea = '1' ORDER BY abs(position_linea) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayLineas = $sth->fetchAll();
			return $arrayLineas;
			}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		
		public function buscarMarcasSinImagen(){
			try {
					$dbh = Database::getInstance();
					if ($_SESSION['language'] == "es"){}// manejo de idiomas aquí, cambiamos el sql	
					$sql = "SELECT nombre_marca FROM marca WHERE imagen_marca = ''";
					$sth = $dbh->prepare($sql);
					$sth->execute();
					$arrayLineas = $sth->fetchAll();
					return $arrayLineas;
					}catch (PDOException $e) {
					die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
			   }
		
	//@return $arrayMarcas
	//@devuelve las marcas publicadas	
		public function getAllBrandsPublished(){
		try {
		$dbh = Database::getInstance();
		$sql = "SELECT * FROM marca WHERE published_marca = '1' ORDER BY abs(position_marca) DESC";
		$sth = $dbh->prepare($sql);
		$sth->execute();
		$arrayMarcas = $sth->fetchAll();
		return $arrayMarcas;
		}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		public function getLineForUrl($url_linea){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM linea WHERE url_linea = :url_linea";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':url_linea', $url_linea, PDO::PARAM_STR);
			$sth->execute();
			$line = $sth->fetchObject();
			return $line;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
	//@return $arrayMarcas
	//@devuelve las marcas publicadas publicadas de una línea	
		public function getAllBrandsPublishedForUrlLine($url_linea){
		try {
		$linea = $this->getLineForUrl($url_linea);
		$id_linea = $linea->id_linea;
		$dbh = Database::getInstance();
		$sql = "SELECT * FROM marca WHERE id_linea = :id_linea AND published_marca = '1' ORDER BY abs(position_marca) DESC";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':id_linea', $linea->id_linea, PDO::PARAM_STR);
		$sth->execute();
		$arrayMarcas = $sth->fetchAll();
		return $arrayMarcas;
		}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		
	//@return $brand
		//@return $arrayMarcas
	//@devuelve las marcas publicadas publicadas por el tipo de producto
		public function getAllBrandsForUrlTypeProduct($url_tipo_producto){
		try {
		$dbh = Database::getInstance();
		$sql = "SELECT * FROM marca m, tipo_producto tp, marca_has_tipo_producto mtp WHERE tp.url_tipo_producto = :url_tipo_producto AND m.id_marca = mtp.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto AND m.published_marca = '1' ORDER BY abs(position_marca) DESC";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':url_tipo_producto', $url_tipo_producto, PDO::PARAM_STR);
		$sth->execute();
		$arrayMarcas = $sth->fetchAll();
		return $arrayMarcas;
		}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		
			//@devuelve las marcas publicadas publicadas por linea y tipo de producto	
		public function getAllBrandsForUrlTypeProductAndLine($url_tipo_producto, $url_linea){
		try {
		$dbh = Database::getInstance();
		$sql = "SELECT * FROM marca m, tipo_producto tp, marca_has_tipo_producto mtp, linea l WHERE tp.url_tipo_producto = :url_tipo_producto AND l.url_linea = :url_linea AND m.id_marca = mtp.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto AND m.published_marca = '1' ORDER BY abs(position_marca) DESC";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(':url_tipo_producto', $url_tipo_producto, PDO::PARAM_STR);
		$sth->bindParam(':url_linea', $url_linea, PDO::PARAM_STR);
		$sth->execute();
		$arrayMarcas = $sth->fetchAll();
		return $arrayMarcas;
		}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
	 public function getTypeProductsForUrlLine($id_linea){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT DISTINCT tp.id_tipo_producto, tp.nombre_tipo_producto, tp.url_tipo_producto FROM marca_has_tipo_producto mtp, tipo_producto tp, marca m WHERE m.id_linea = :id_linea AND mtp.id_marca = m.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto ORDER BY abs(position_tipo_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			$sth->execute();
			$brand = $sth->fetchAll();
			return $brand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}	
			//@return $typeProduct
	 public function getTypeProductForIdBrand($id_marca){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT tp.id_tipo_producto, tp.nombre_tipo_producto, tp.imagen_tipo_producto, tp.url_tipo_producto FROM marca_has_tipo_producto mtp, tipo_producto tp, marca m WHERE mtp.id_marca = m.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto AND mtp.id_marca = :id_marca ORDER BY abs(position_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$typeProduct = $sth->fetchObject();
			return $typeProduct;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
	//@return $brand
	//@devuelve una marca por su url	
	 public function getBrandForUrl($url_marca){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM marca WHERE url_marca = :url_marca";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':url_marca', $url_marca, PDO::PARAM_STR);
			$sth->execute();
			$brand = $sth->fetchObject();
			return $brand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
	//@return $arrayMarcas
	//@devuelve los productos publicados de una marca	
		public function getAllProductsPublishedForUrlBrand($url_marca){
		try {
			$marca = $this->getBrandForUrl($url_marca);
			$id_marca = $marca->id_marca;	
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_marca = :id_marca AND published_producto = '1' ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $marca->id_marca, PDO::PARAM_STR);
			$sth->execute();
			$arrayProductos = $sth->fetchAll();
			return $arrayProductos;
			}catch (PDOException $e){
		    die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		
			//@return $arrayLineas
	//@devuelve las marcas relacionadas
	public function getBrandsRelationed($id_marca, $id_tipo_producto){
		try {
			$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}// manejo de idiomas aquí, cambiamos el sql	
			$sql = "SELECT * FROM marca WHERE id_marca IN (SELECT id_marca FROM marca_has_tipo_producto WHERE id_tipo_producto = :id_tipo_producto) AND id_marca != :id_marca AND published_marca = '1' ORDER BY abs(position_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$arrayMarcas = $sth->fetchAll();
			return $arrayMarcas;
			}catch (PDOException $e) {
      		die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}	
		}
		
 //obtenemos un tipo de producto por url_tipo_producto
	   public function getTypeProductForUrl($url_tipo_producto){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM tipo_producto WHERE url_tipo_producto = :url_tipo_producto AND published_tipo_producto = '1'";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':url_tipo_producto', $url_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$line = $sth->fetchObject();
			return $line;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		//@verificamos que no exista una url igual de novedad
		public function checkUrlNovedad($url_novedad)
			{
			try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT url_novedad FROM novedad WHERE url_novedad = ?";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(1, $url_novedad);
			 $sth->execute();
			 $url = $sth->fetchObject();
			 if ($url){ return true; }else{ return false; }	
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
			}
			
			//@return $MaxPositionNotice
	public function getMaxPositionNovedad(){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_novedad)) AS maximun FROM novedad";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionNotice = $sth->fetchObject();
			$MaxPositionNotice = $ObjectMaxPositionNotice->maximun;
			return $MaxPositionNotice;
		}	
	
				//guardar novedad
	public function saveNovelty($nombre_novedad, $imagen_novedad, $detalle_novedad, $url_novedad, $published_novedad, $position_novedad)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO novedad (nombre_novedad, imagen_novedad, detalle_novedad, fecha_novedad, url_novedad, published_novedad, position_novedad) VALUES (:nombre_novedad, :imagen_novedad, :detalle_novedad, now(), :url_novedad, :published_novedad, :position_novedad)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_novedad', $nombre_novedad, PDO::PARAM_STR);
			$sth->bindParam(':imagen_novedad', $imagen_novedad, PDO::PARAM_STR);
			$sth->bindParam(':detalle_novedad', $detalle_novedad, PDO::PARAM_STR);
			$sth->bindParam(':url_novedad', $url_novedad, PDO::PARAM_STR);
			$sth->bindParam(':published_novedad', $published_novedad, PDO::PARAM_STR);
			$sth->bindParam(':position_novedad', $position_novedad, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	
	//ACTUALIZAMOS UNA NOVEDAD
		public function updateNovelty($id_novedad, $nombre_novedad, $imagen_novedad, $detalle_novedad, $published_novedad)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE novedad SET nombre_novedad = :nombre_novedad, imagen_novedad = :imagen_novedad, detalle_novedad = :detalle_novedad, published_novedad = :published_novedad WHERE id_novedad = :id_novedad";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_novedad', $id_novedad, PDO::PARAM_STR);
			 $sth->bindParam(':nombre_novedad', $nombre_novedad, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_novedad', $imagen_novedad, PDO::PARAM_STR);
			 $sth->bindParam(':detalle_novedad', $detalle_novedad, PDO::PARAM_STR);
			 $sth->bindParam(':published_novedad', $published_novedad, PDO::PARAM_STR);
			 $novedad = $sth->execute();
			 if (!$novedad){ return false;} else { return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }	
		public function getAllNoveltys(){	
			try{		
			$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}	
			$sql = "SELECT * FROM novedad ORDER BY abs(position_novedad) DESC";
			$sth = $dbh->prepare($sql);	
			$sth->execute();
			$arrayNovedades = $sth->fetchAll();
			return $arrayNovedades;
			} catch (PDOException $e){ die('Falla en: '.__METHOD__. ' | ' . $e->getMessage() );}
		}
		
		//@obtenemos la novedad por el id
		public function getNoveltyForId($id_novedad){
			   try{
				$dbh = Database::getInstance();
				$sql = "SELECT * FROM novedad WHERE id_novedad = :id_novedad";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':id_novedad', $id_novedad, PDO::PARAM_STR);
				$sth->execute();
				$novelty = $sth->fetchObject();
				return $novelty;
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			}
			// metodo para eliminar una marca
	    public function deleteNovelty($id_novedad)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM novedad WHERE id_novedad = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_novedad));
			$deleteNoveltys = $sth->rowCount();
			return $deleteNoveltys;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}
			//@return todas las noticias publicadas 
			public function getAllNoveltysPublished(){	
			try{		
			/*$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}	
			$sql = "SELECT * FROM novedad WHERE published_novedad = '1' ORDER BY abs(position_novedad) DESC";
			$sth = $dbh->prepare($sql);	
			$sth->execute();
			$arrayNovedades = $sth->fetchAll();
			return $arrayNovedades;*/
			} catch (PDOException $e){ die('Falla en: '.__METHOD__. ' | ' . $e->getMessage() );}
                        }
	//@return todas las noticias publicadas 
			public function getNoveltyForUrl($url_novedad){	
			try{		
			$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}	
			$sql = "SELECT * FROM novedad WHERE url_novedad = :url_novedad AND published_novedad = '1'";
			$sth = $dbh->prepare($sql);
                        $sth->bindParam(':url_novedad', $url_novedad, PDO::PARAM_STR);
			$sth->execute();
			$arrayNovedades = $sth->fetchObject();
			return $arrayNovedades;
			} catch (PDOException $e){ die('Falla en: '.__METHOD__. ' | ' . $e->getMessage() );}
		}

	public function cargarposiciones($categoria_id,$id,$position)
	{//METODO QUE AYUDA AL METODO DEL CONTROLADOR A ACTUALIZAR LAS POSICIONES DE ACUERDO A UN ID DE CATEGORIA
	$dbh = Database::getInstance();
	$sql = "UPDATE vestido SET position = :position WHERE categoria_id = :categoria_id AND id = :id";
	$sth = $dbh->prepare($sql);
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->bindParam(':categoria_id', $categoria_id, PDO::PARAM_STR);
	$sth->bindParam(':position', $position, PDO::PARAM_STR);
	$sth->execute();
	$cuenta = $sth->rowCount();	
		}
	
	public function cargarpositionc($categoria_id,$id,$position,$positionx)
	{
	$dbh = Database::getInstance();
	$sql = "UPDATE vestido SET position = :position WHERE categoria_id = :categoria_id AND id = :id AND position > :positionx";
	$sth = $dbh->prepare($sql);
	$sth->bindParam(':id', $id, PDO::PARAM_STR);
	$sth->bindParam(':categoria_id', $categoria_id, PDO::PARAM_STR);
	$sth->bindParam(':position', $position, PDO::PARAM_STR);
	$sth->bindParam(':positionx', $positionx, PDO::PARAM_STR);
	$sth->execute();
	$cuenta = $sth->rowCount();	
		}
		
	////////////////////////////////////////////////////////////////////////////	
	/*
	@function generic reoder up position
	@description up register in a table
	@autor: Mario Gonzales
	@email: noranterri@gmail.com
	@return: true or false
	@type prefix field $table_field
	@$table is a table
	@$id_table is id of field: id_table, position_table update
	*/
	public function orderUpRegister($table,$id_table)
		{
			try {
			$error = "";	
			//get the register position
			$dbh = Database::getInstance();
			$sql = "SELECT position_".$table." AS position FROM ".$table." WHERE id_".$table." = :id_table";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_table', $id_table, PDO::PARAM_STR);
			$sth->execute();
			$objectOldPosition = $sth->fetchObject();
			$old_position = $objectOldPosition->position;
			if(!$old_position){$error .= "error: No se encuentra la posición de este registro en ".__LINE__;}
			//get the maximun register
			$dbh = Database::getInstance();
			$sql = "SELECT MAX(abs(position_".$table.")) AS maximun FROM ".$table."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$Objectmaximum = $sth->fetchObject();
			$maximun = $Objectmaximum->maximun;
			if ($old_position <= $maximun)
			{
			//get the next register for deduct 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT min(abs(position_".$table.")) AS minimun FROM ".$table." WHERE position_".$table." > abs(".$old_position.")";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectOldPositionSuperior = $sth->fetchObject();
			$OldPositionSuperior = $ObjectOldPositionSuperior->minimun;
			//now the down superior register deducting - 1
			$newPositionRegisterSuperior = $OldPositionSuperior - 1;
			$dbh = Database::getInstance();
			$sql = "UPDATE ".$table." SET position_".$table." = ".$newPositionRegisterSuperior." WHERE position_".$table." = ".$OldPositionSuperior."";
			$sth = $dbh->prepare($sql);
		    $sth->execute();
			$countPositionOld = $sth->rowCount();		
			// finally register updated - finalmente ponemos a su registra ahi
			$dbh = Database::getInstance();
			$sql = "UPDATE ".$table." SET position_".$table." = ".$OldPositionSuperior." WHERE id_".$table." = ".$id_table."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$countPositioning = $sth->rowCount();
			if ($countPositioning >= 1){ return true; }
			else { $error.=" | No se actualizó ".__LINE__;}			
			}
			else
			{
				$error.=" | No se actualizó ".__LINE__;
			}
			if($error == ""){ return "ok";} else { return $error; }
				}catch (PDOException $e) {
      die( 'Fallo en query: ' .__METHOD__." - ".__LINE__. $e->getMessage() );}
			
		}	
		
			/*
	@function generic reoder down position
	@description down register in a table
	@autor: Mario Gonzales
	@email: noranterri@gmail.com
	@return: true or false
	@type prefix field $table_field
	@$table is a table
	@$id_table is id of field: id_table, position_table update
	*/
	public function orderDownRegister($table,$id_table)
		{
			try {
			//get the register position
			$dbh = Database::getInstance();
			$sql = "SELECT position_".$table." AS position FROM ".$table." WHERE id_".$table." = :id_table";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_table', $id_table, PDO::PARAM_STR);
			$sth->execute();
			$objectOldPosition = $sth->fetchObject();
			$old_position = $objectOldPosition->position;

			//get the minimun register
			$dbh = Database::getInstance();
			$sql = "SELECT MIN(abs(position_".$table.")) AS minimun FROM ".$table."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$Objectminimun = $sth->fetchObject();
			$minimun = $Objectminimun->minimun;	
			//check the minimun register	
			if (($old_position > $minimun) && ($old_position != 1))
			{
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_".$table.")) AS maximun FROM ".$table." WHERE abs(position_".$table.") < abs(".$old_position.")";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectOldPositionInferior = $sth->fetchObject();
			$OldPositionInferior = $ObjectOldPositionInferior->maximun;
			//now the down superior register deducting + 1
			$newPositionRegisterInferior = $OldPositionInferior + 1;
			$dbh = Database::getInstance();
			$sql = "UPDATE ".$table." SET position_".$table." = ".$newPositionRegisterInferior." WHERE position_".$table." = ".$OldPositionInferior."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$countPositionOld = $sth->rowCount();		
			// finally register updated - finalmente ponemos a su registra ahi
			$dbh = Database::getInstance();
			$sql = "UPDATE ".$table." SET position_".$table." = ".$OldPositionInferior." WHERE id_".$table." = ".$id_table."";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$countPositioning = $sth->rowCount();
			if ($countPositioning >= 1){ return true; }
				else { return false;}			
			} else { return false;}
			}catch (PDOException $e) {
   	      die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() );}			
		}
		///////////////////****************************///////MARCAS//////****************************************//////////////////////////////////////////////////////////////////////////////////
		public function getAllMarcas(){
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM marca ORDER BY abs(position_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayMarcas = $sth->fetchAll();
			return $arrayMarcas;
		}
		public function getPrefijoMarca($id_marca)
		{
			try{
				$dbh = Database::getInstance();
				$sql = "SELECT prefijo_marca FROM marca WHERE id_marca = ?";
				$sth = $dbh->prepare($sql);
				$sth->execute(array($id_marca));
				$sth->execute();
				$prefijo_marca = $sth->fetchObject();
				return $prefijo_marca->prefijo_marca;
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			}
			 public function deleteRelationTypeProductBrand($id_marca)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM marca_has_tipo_producto WHERE id_marca = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_marca));
			$deleteProducts = $sth->rowCount();			
			return $deleteProducts;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}		
	//guardar marca	
	public function saveBrand($nombre_marca, $nick_marca, $prefijo_marca, $imagen_marca, $descripcion_marca, $caracteristica_marca, $comoaplicar_marca, $recomendaciones_marca, $pdf_marca, $pdf2_marca, $url_marca, $published_marca, $position_marca, $id_linea, $id_tipo_producto)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO marca (nombre_marca, nick_marca, prefijo_marca, imagen_marca, descripcion_marca, caracteristica_marca, recomendaciones_marca, comoaplicar_marca, pdf_marca, pdf2_marca, url_marca, published_marca, position_marca, id_linea) VALUES (:nombre_marca, :nick_marca, :prefijo_marca, :imagen_marca, :descripcion_marca, :caracteristica_marca, :recomendaciones_marca, :comoaplicar_marca, :pdf_marca, :pdf2_marca, :url_marca, :published_marca, :position_marca, :id_linea)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_marca', $nombre_marca, PDO::PARAM_STR);
			$sth->bindParam(':nick_marca', $nick_marca, PDO::PARAM_STR);
			$sth->bindParam(':prefijo_marca', $prefijo_marca, PDO::PARAM_STR);
			$sth->bindParam(':imagen_marca', $imagen_marca, PDO::PARAM_STR);
			$sth->bindParam(':descripcion_marca', $descripcion_marca, PDO::PARAM_STR);
			$sth->bindParam(':caracteristica_marca', $caracteristica_marca, PDO::PARAM_STR);
			$sth->bindParam(':recomendaciones_marca', $recomendaciones_marca, PDO::PARAM_STR);
			$sth->bindParam(':comoaplicar_marca', $comoaplicar_marca, PDO::PARAM_STR);
			$sth->bindParam(':pdf_marca', $pdf_marca, PDO::PARAM_STR);
			$sth->bindParam(':pdf2_marca', $pdf2_marca, PDO::PARAM_STR);
			$sth->bindParam(':url_marca', $url_marca, PDO::PARAM_STR);
			$sth->bindParam(':published_marca', $published_marca, PDO::PARAM_STR);
			$sth->bindParam(':position_marca', $position_marca, PDO::PARAM_STR);
			$sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			//guardamos el tipo de producto de esta marca
			$id_marca = $dbh->lastInsertId();
			$dbh = Database::getInstance();
			$sql = "INSERT INTO marca_has_tipo_producto (id_marca, id_tipo_producto) VALUES (:id_marca, :id_tipo_producto)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	//OBTIENE LA MÁXIMA POSICIÓN DE UNA MARCA
	//@return $MaxPositionBrand
	public function getMaxPositionBrand(){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_marca)) AS maximun FROM marca";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionBrand = $sth->fetchObject();
			$MaxPositionBrand = $ObjectMaxPositionBrand->maximun;
			return $MaxPositionBrand;
		}
	//ACTUALIZAMOS LA MARCA
		public function updateBrand($id_marca, $nombre_marca, $nick_marca, $prefijo_marca, $imagen_marca, $descripcion_marca, $caracteristica_marca, $recomendaciones_marca, $comoaplicar_marca, $pdf_marca, $pdf2_marca, $published_marca,  $id_linea, $id_tipo_producto)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE marca SET nombre_marca = :nombre_marca, nick_marca = :nick_marca, prefijo_marca = :prefijo_marca, imagen_marca = :imagen_marca, descripcion_marca = :descripcion_marca, caracteristica_marca = :caracteristica_marca, recomendaciones_marca = :recomendaciones_marca, comoaplicar_marca = :comoaplicar_marca, pdf_marca = :pdf_marca,  pdf2_marca = :pdf2_marca, published_marca = :published_marca, id_linea = :id_linea WHERE id_marca = :id_marca";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			 $sth->bindParam(':nombre_marca', $nombre_marca, PDO::PARAM_STR);
			 $sth->bindParam(':nick_marca', $nick_marca, PDO::PARAM_STR);
			 $sth->bindParam(':prefijo_marca', $prefijo_marca, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_marca', $imagen_marca, PDO::PARAM_STR);
			 $sth->bindParam(':descripcion_marca', $descripcion_marca, PDO::PARAM_STR);
			 $sth->bindParam(':caracteristica_marca', $caracteristica_marca, PDO::PARAM_STR);
			 $sth->bindParam(':recomendaciones_marca', $recomendaciones_marca, PDO::PARAM_STR);
			 $sth->bindParam(':comoaplicar_marca', $comoaplicar_marca, PDO::PARAM_STR);
			 $sth->bindParam(':pdf_marca', $pdf_marca, PDO::PARAM_STR);
			 $sth->bindParam(':pdf2_marca', $pdf2_marca, PDO::PARAM_STR);
			 $sth->bindParam(':published_marca', $published_marca, PDO::PARAM_STR);
			 $sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			 $marca = $sth->execute();
			 if (!$marca){ return false;}
			 //actualizamos el id_tipo_producto en marca_has_tipo_producto
			 $dbh = Database::getInstance();
			 $sql = "UPDATE marca_has_tipo_producto SET id_tipo_producto = :id_tipo_producto WHERE id_marca = :id_marca";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			 $sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			 $campos = $sth->execute();
			 if (!$campos){ return false;}
			 if (($marca) && ($campos)){ return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }
			 //obtenemos una marca por id_marca
	   public function getBrandForId($id_marca){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT m.id_marca, m.nombre_marca, m.nick_marca, m.prefijo_marca, m.imagen_marca, m.descripcion_marca, m.caracteristica_marca, m.recomendaciones_marca, m.comoaplicar_marca, m.pdf_marca, m.pdf2_marca, m.url_marca, m.published_marca, m.id_linea, m.id_familia_marca, mtp.id_tipo_producto FROM marca m, marca_has_tipo_producto mtp WHERE m.id_marca = :id_marca AND m.id_marca = mtp.id_marca";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$brand = $sth->fetchObject();
			return $brand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		//obtenemos las marcas publicadas de un tipo de producto
	   public function getAllBrandsForUrlTypeProductPublished($url_tipo_producto){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT m.id_marca, m.nombre_marca, m.nick_marca, m.prefijo_marca, m.imagen_marca, m.descripcion_marca, m.caracteristica_marca, m.recomendaciones_marca, m.comoaplicar_marca, m.pdf_marca, m.pdf2_marca, m.url_marca, m.published_marca, m.id_linea, m.id_familia_marca, mtp.id_tipo_producto, tp.url_tipo_producto, tp.nombre_tipo_producto, tp.descripcion_tipo_producto FROM marca m, tipo_producto tp, marca_has_tipo_producto mtp WHERE tp.url_tipo_producto = :url_tipo_producto AND m.id_marca = mtp.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto AND tp.published_tipo_producto = '1' AND m.published_marca = '1'";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':url_tipo_producto', $url_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$brand = $sth->fetchAll();
			return $brand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		// obtenemos todas las marcas de una línea
			public function getBrandForLine($id_linea){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM marca WHERE id_linea = :id_linea ORDER BY abs(position_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			$sth->execute();
			$brands = $sth->fetchAll();
			return $brands;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		// metodo para eliminar una marca
	    public function deleteBrand($id_marca)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM producto WHERE id_marca = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_marca));
			$deleteProducts = $sth->rowCount();
			//eliminamos la marca
			$dbh = Database::getInstance();
			$sql = "DELETE FROM marca WHERE id_marca = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_marca));
			$count = $sth->rowCount();
			// eliminamos la relación entre el tipo de producto y la marca
			$dbh = Database::getInstance();
			$this->deleteRelationTypeProductBrand($id_marca);
			
			return $count;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}		
	////////////////////////////////////LINEA//////////////////////////////////////////////////////////////////////////////////////////
		 //obtenemos una linea por id_linea
	   public function getLineForId($id_linea){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM linea WHERE id_linea = :id_linea";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			$sth->execute();
			$line = $sth->fetchObject();
			return $line;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
			public function getAllLines(){	
			try{		
			$dbh = Database::getInstance();
			if ($_SESSION['language'] == "es"){}	
			$sql = "SELECT * FROM linea ORDER BY abs(position_linea) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayLineas = $sth->fetchAll();
			return $arrayLineas;
			} catch (PDOException $e){ die('Falla en: '.__METHOD__. ' | ' . $e->getMessage() );}
		}
					//OBTIENE LA MÁXIMA POSICIÓN DE UNA LÍNEA
	//@return $MaxPositionLine
	public function getMaxPositionLine(){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_linea)) AS maximun FROM linea";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionLine = $sth->fetchObject();
			$MaxPositionLine = $ObjectMaxPositionLine->maximun;
			return $MaxPositionLine;
		}
		
	//verificamos si existe esta url para este nivel
	public function checkUrlLine($url_linea)
	{
	try {
	 $dbh = Database::getInstance();
	 $sql = "SELECT url_linea FROM linea WHERE url_linea = ?";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(1, $url_linea);
	 $sth->execute();
	 $url = $sth->fetchObject();
	 if ($url){ return true; }else{ return false; }	
	 }catch (PDOException $e) {
      die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
	}
			//guardar línea	
	public function saveLine($nombre_linea, $imagen_linea, $detalle_linea, $url_linea, $published_linea, $position_linea)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO linea (nombre_linea, imagen_linea, detalle_linea, url_linea, published_linea, position_linea) VALUES (:nombre_linea, :imagen_linea, :detalle_linea, :url_linea, :published_linea, :position_linea)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_linea', $nombre_linea, PDO::PARAM_STR);
			$sth->bindParam(':imagen_linea', $imagen_linea, PDO::PARAM_STR);
			$sth->bindParam(':detalle_linea', $detalle_linea, PDO::PARAM_STR);
			$sth->bindParam(':url_linea', $url_linea, PDO::PARAM_STR);
			$sth->bindParam(':published_linea', $published_linea, PDO::PARAM_STR);
			$sth->bindParam(':position_linea', $position_linea, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	
		//ACTUALIZAMOS LA LÍNEA
		public function updateLine($id_linea, $nombre_linea, $imagen_linea, $detalle_linea, $published_linea)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE linea SET nombre_linea = :nombre_linea, imagen_linea = :imagen_linea, detalle_linea = :detalle_linea, published_linea = :published_linea WHERE id_linea = :id_linea";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_linea', $id_linea, PDO::PARAM_STR);
			 $sth->bindParam(':nombre_linea', $nombre_linea, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_linea', $imagen_linea, PDO::PARAM_STR);
			 $sth->bindParam(':detalle_linea', $detalle_linea, PDO::PARAM_STR);
			 $sth->bindParam(':published_linea', $published_linea, PDO::PARAM_STR);
			 $marca = $sth->execute();
			 if (!$marca){ return false;} else { return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }	
		// metodo para eliminar una línea
	    public function deleteLine($id_linea)
			{
			try {
			$marcas = $this->getBrandForLine($id_linea);				
			// eliminamos los productos relacionados
			foreach($marcas as $m){
			$dbh = Database::getInstance();
			$sql = "DELETE FROM producto WHERE id_linea = ? AND id_marca = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_linea,$m['id_marca']));
			$deleteProducts = $sth->rowCount();
			}
			// eliminamos las marcas relacionadas
			$dbh = Database::getInstance();
			$sql = "DELETE FROM marca WHERE id_linea = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_linea));
			$deleteProducts = $sth->rowCount();
			//eliminamos las líneas
			$dbh = Database::getInstance();
			$sql = "DELETE FROM linea WHERE id_linea = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_linea));
			$lineaEliminada = $sth->rowCount();
			if ($lineaEliminada){$lineaEliminada = true;} else {$lineaEliminada = "no se eliminó la línea";}
			return $lineaEliminada;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}
	
	////////////////////////////////////TIPO DE PRODUCTO//////////////////////////////////////////////
	 //obtenemos un tipo de producto por id_tipo_producto
	   public function getTypeProductForId($id_tipo_producto){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM tipo_producto WHERE id_tipo_producto = :id_tipo_producto";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$line = $sth->fetchObject();
			return $line;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
			public function getAllTypesProducts(){
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM tipo_producto ORDER BY abs(position_tipo_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayTiposProducto = $sth->fetchAll();
			return $arrayTiposProducto;
		}
		//@return $MaxPositionLine
		public function getMaxPositionTypeProduct(){
			try{
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_tipo_producto)) AS maximun FROM tipo_producto";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionTypeProduct = $sth->fetchObject();
			$MaxPositionTypeProduct = $ObjectMaxPositionTypeProduct->maximun;
			return $MaxPositionTypeProduct;
			} catch (PDOException $e){ die('Fallo en query: ' . __METHOD__." - ". $e->getMessage());}
		}
		
		//verificamos si existe esta url para este tipo de producto
	public function checkUrlTypeProduct($url_tipo_producto)
	{
	try {
	 $dbh = Database::getInstance();
	 $sql = "SELECT url_tipo_producto FROM tipo_producto WHERE url_tipo_producto = ?";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(1, $url_tipo_producto);
	 $sth->execute();
	 $url = $sth->fetchObject();
	 if ($url){ return true; }else{ return false; }	
	 }catch (PDOException $e) {
      die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
	}
		//guardar el tipo de producto
	public function saveTypeProduct($nombre_tipo_producto, $imagen_tipo_producto, $descripcion_tipo_producto, $url_tipo_producto, $published_tipo_producto, $position_tipo_producto)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO tipo_producto (nombre_tipo_producto, imagen_tipo_producto, descripcion_tipo_producto, url_tipo_producto, published_tipo_producto, position_tipo_producto) VALUES (:nombre_tipo_producto, :imagen_tipo_producto, :descripcion_tipo_producto, :url_tipo_producto, :published_tipo_producto, :position_tipo_producto)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_tipo_producto', $nombre_tipo_producto, PDO::PARAM_STR);
			$sth->bindParam(':imagen_tipo_producto', $imagen_tipo_producto, PDO::PARAM_STR);
			$sth->bindParam(':descripcion_tipo_producto', $descripcion_tipo_producto, PDO::PARAM_STR);
			$sth->bindParam(':url_tipo_producto', $url_tipo_producto, PDO::PARAM_STR);
			$sth->bindParam(':published_tipo_producto', $published_tipo_producto, PDO::PARAM_STR);
			$sth->bindParam(':position_tipo_producto', $position_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	
		//ACTUALIZAMOS EL TIPO DE PRODUCTO
		public function updateTypeProduct($id_tipo_producto, $nombre_tipo_producto, $imagen_tipo_producto, $descripcion_tipo_producto, $published_tipo_producto)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE tipo_producto SET nombre_tipo_producto = :nombre_tipo_producto, imagen_tipo_producto = :imagen_tipo_producto, descripcion_tipo_producto = :descripcion_tipo_producto, published_tipo_producto = :published_tipo_producto WHERE id_tipo_producto = :id_tipo_producto";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			 $sth->bindParam(':nombre_tipo_producto', $nombre_tipo_producto, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_tipo_producto', $imagen_tipo_producto, PDO::PARAM_STR);
			 $sth->bindParam(':descripcion_tipo_producto', $descripcion_tipo_producto, PDO::PARAM_STR);
			 $sth->bindParam(':published_tipo_producto', $published_tipo_producto, PDO::PARAM_STR);
			 $tipo = $sth->execute();
			 if (!$tipo){ return false;} else { return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }	
		// metodo para eliminar un tipo de producto
	    public function deleteTypeProduct($id_tipo_producto)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "DELETE FROM tipo_producto WHERE id_tipo_producto = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_tipo_producto));
			$tipoProductoEliminado = $sth->rowCount();
			if ($tipoProductoEliminado){$tipoProductoEliminado = true;} else {$tipoProductoEliminado = "no se eliminó el tipo de producto";}
			return $tipoProductoEliminado;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}
			
			///////////////////****************************///////*PRODUCTO*//////****************************************//////////////////////////////////////////////////////////////////////////////////
			//obtenemos todos los productos
		public function getAllProducts(){
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$arrayProductos = $sth->fetchAll();
			return $arrayProductos;
		}
		
		//obtenemos todos los colores por id de la marca
		public function getAllProductsForIdBrand($id_marca){
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_marca = :id_marca ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$arrayProductos = $sth->fetchAll();
			return $arrayProductos;
		}
		
				//verificamos si existe esta url para este producto
	public function checkUrlProduct($url_producto)
	{
	try {
	 $dbh = Database::getInstance();
	 $sql = "SELECT url_producto FROM producto WHERE url_producto = ?";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(1, $url_producto);
	 $sth->execute();
	 $url = $sth->fetchObject();
	 if ($url){ return true; }else{ return false; }	
	 }catch (PDOException $e) {
      die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}	
	}
	//guardar producto	
	public function saveProduct($nombre_producto, $codigo_producto, $imagen_producto, $pdf_producto, $tonalidad1_producto, $tonalidad2_producto, $tonalidad3_producto, $descripcion_producto, $url_producto, $published_producto, $position_producto, $id_marca, $id_familiacolorproducto, $id_gamacolorproducto)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO producto (nombre_producto, codigo_producto, imagen_producto, pdf_producto, tonalidad1_producto, tonalidad2_producto, tonalidad3_producto, descripcion_producto, url_producto, published_producto, position_producto, id_marca, id_familiacolorproducto, id_gamacolorproducto) VALUES (:nombre_producto, :codigo_producto, :imagen_producto, :pdf_producto, :tonalidad1_producto, :tonalidad2_producto, :tonalidad3_producto, :descripcion_producto, :url_producto, :published_producto, :position_producto, :id_marca, :id_familiacolorproducto, :id_gamacolorproducto)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
			$sth->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR);
			$sth->bindParam(':imagen_producto', $imagen_producto, PDO::PARAM_STR);
			$sth->bindParam(':pdf_producto', $pdf_producto, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad1_producto', $tonalidad1_producto, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad2_producto', $tonalidad2_producto, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad3_producto', $tonalidad3_producto, PDO::PARAM_STR);
			$sth->bindParam(':descripcion_producto', $descripcion_producto, PDO::PARAM_STR);
			$sth->bindParam(':url_producto', $url_producto, PDO::PARAM_STR);
			$sth->bindParam(':published_producto', $published_producto, PDO::PARAM_STR);
			$sth->bindParam(':position_producto', $position_producto, PDO::PARAM_STR);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':id_familiacolorproducto', $id_familiacolorproducto, PDO::PARAM_STR);
			$sth->bindParam(':id_gamacolorproducto', $id_gamacolorproducto, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
	}
	//OBTIENE LA MÁXIMA POSICIÓN DE UN PRODUCTO
	//@return $MaxPositionProduct
	public function getMaxPositionProduct(){
			//get the next register for sum 1 in controller and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_producto)) AS maximun FROM producto";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionProduct = $sth->fetchObject();
			$MaxPositionProduct = $ObjectMaxPositionProduct->maximun;
			return $MaxPositionProduct;
		}
	//ACTUALIZAMOS UN PRODUCTO - EJEMPLO DE PRODUCTO: 1234
		public function updateProduct($id_producto, $nombre_producto, $codigo_producto, $imagen_producto, $pdf_producto, $tonalidad1_producto, $tonalidad2_producto, $tonalidad3_producto, $descripcion_producto, $published_producto, $id_marca, $id_familiacolorproducto, $id_gamacolorproducto)
			{
			try {
			$dbh = Database::getInstance();
			$sql = "UPDATE producto SET nombre_producto = :nombre_producto, codigo_producto = :codigo_producto, imagen_producto = :imagen_producto, pdf_producto = :pdf_producto, tonalidad1_producto = :tonalidad1_producto, tonalidad2_producto = :tonalidad2_producto, tonalidad3_producto = :tonalidad3_producto, descripcion_producto = :descripcion_producto, published_producto = :published_producto, id_marca = :id_marca, id_familiacolorproducto = :id_familiacolorproducto, id_gamacolorproducto = :id_gamacolorproducto WHERE id_producto = :id_producto";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
			 $sth->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
			 $sth->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR);
			 $sth->bindParam(':imagen_producto', $imagen_producto, PDO::PARAM_STR);
			 $sth->bindParam(':pdf_producto', $pdf_producto, PDO::PARAM_STR);
			 $sth->bindParam(':tonalidad1_producto', $tonalidad1_producto, PDO::PARAM_STR);
			 $sth->bindParam(':tonalidad2_producto', $tonalidad2_producto, PDO::PARAM_STR);
			 $sth->bindParam(':tonalidad3_producto', $tonalidad3_producto, PDO::PARAM_STR);
			 $sth->bindParam(':descripcion_producto', $descripcion_producto, PDO::PARAM_STR);
			 $sth->bindParam(':published_producto', $published_producto, PDO::PARAM_STR);
			 $sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			 $sth->bindParam(':id_familiacolorproducto', $id_familiacolorproducto, PDO::PARAM_STR);
			 $sth->bindParam(':id_gamacolorproducto', $id_gamacolorproducto, PDO::PARAM_STR);
			 $productoActualizado = $sth->execute();
			 if (!$productoActualizado){ return false;}
			 if ($productoActualizado){ return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }
			 
			 //obtenemos una marca por id_marca
	   public function getProductForId($id_producto){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_producto = :id_producto";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
			$sth->execute();
			$product = $sth->fetchObject();
			return $product;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		// obtenemos todos los productos publicados de una marca por su tonalidad
			public function getPublishedProductForBrandAndTonalidad1($id_marca,$tonalidad1_producto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_marca = :id_marca AND tonalidad1_producto = :tonalidad1_producto AND published_producto = '1' ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad1_producto', $tonalidad1_producto, PDO::PARAM_STR);
			$sth->execute();
			$product = $sth->fetchObject();
			return $product;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		// obtenemos todos los productos publicados de una marca
			public function getPublishedNameProductsForBrandAndTonalidad1($id_marca,$tonalidad1_producto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT nombre_producto FROM producto WHERE id_marca = :id_marca AND tonalidad1_producto = :tonalidad1_producto AND published_producto = '1' ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad1_producto', $tonalidad1_producto, PDO::PARAM_STR);
			$sth->execute();
			$product = $sth->fetchObject();
			return $product->nombre_producto;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
				// obtenemos todos los productos publicados de una marca
			public function getPublishedCodeProductsForBrandAndTonalidad1($id_marca,$tonalidad1_producto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT codigo_producto FROM producto WHERE id_marca = :id_marca AND tonalidad1_producto = :tonalidad1_producto AND published_producto = '1' ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':tonalidad1_producto', $tonalidad1_producto, PDO::PARAM_STR);
			$sth->execute();
			$product = $sth->fetchObject();
			return $product->codigo_producto;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
			// obtenemos todos los productos publicados de una marca
			public function getPublishedProductsForBrandAndFamilyColor($id_marca){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto p, gamacolorproducto gcp WHERE p.id_marca = :id_marca AND gcp.id_gamacolorproducto = p.id_gamacolorproducto AND p.published_producto = '1' ORDER BY abs(gcp.position_gamacolorproducto) ASC,  abs(p.position_producto) DESC ";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
                
                
                public function getPublishedProductsForFamilyColor($id_gamacolorproducto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto p, gamacolorproducto gcp, marca m WHERE m.id_marca = p.id_marca AND p.id_gamacolorproducto = :id_gamacolorproducto AND gcp.id_gamacolorproducto = p.id_gamacolorproducto AND p.published_producto = '1' ORDER BY abs(gcp.position_gamacolorproducto) ASC,  abs(p.position_producto) DESC ";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_gamacolorproducto', $id_gamacolorproducto, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
                
                	// obtenemos todos los productos publicados de una marca
			public function getAllPublishedGammaColors(){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM gamacolorproducto WHERE published_gamacolorproducto = '1' ORDER BY abs(position_gamacolorproducto) ASC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
                
                // obtenemos todos los productos publicados de una marca
			public function getPublishedProductsForBrand($id_marca){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto  WHERE id_marca = :id_marca AND published_producto = '1' ORDER BY  abs(position_producto) DESC ";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
                
		
		// obtenemos todos los productos de una marca
			public function getProductsForBrand($id_marca){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_marca = :id_marca ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
				// obtenemos todos los productos de una marca
		public function getProductsForLine($id_linea){
		   	try{
			$marcas = $this->getBrandForLine($id_linea);
			$productos = array();
			foreach ($marcas as $m)	
			{
				$dbh = Database::getInstance();
				$sql = "SELECT * FROM producto WHERE id_marca = :id_marca ORDER BY abs(position_producto) DESC";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':id_marca', $m['id_marca'], PDO::PARAM_STR);
				$sth->execute();
				$products = $sth->fetchAll();
				$productos .= $products;
			}			
			return $productos;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		// obtenemos todos los productos de un color
		public function getProductsForFamilyColorProduct($id_familiacolorproducto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_familiacolorproducto = :id_familiacolorproducto ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_familiacolorproducto', $id_familiacolorproducto, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		// obtenemos todos los productos de un tipo de producto
		public function getProductsForTypeProduct($id_tipo_producto){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM producto WHERE id_tipo_producto = :id_tipo_producto ORDER BY abs(position_producto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
			$sth->execute();
			$products = $sth->fetchAll();
			return $products;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		// metodo para eliminar una marca
	    public function deleteProduct($id_producto)
			{
			try {
				// eliminamos los productos relacionados
				$dbh = Database::getInstance();
				$sql = "DELETE FROM producto WHERE id_producto = ?";
				$sth = $dbh->prepare($sql);
				$sth->execute(array($id_producto));
				$deleteProduct = $sth->rowCount();			
				return $deleteProduct;
			}catch(PDOException $e){  die( 'Fallo en query: ' . $e->getMessage() );}
			}
			/////////////////////////////gama de color ////////////////////////////////////////////	
			public function getAllGammaColorProduct(){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM gamacolorproducto ORDER BY abs(position_gamacolorproducto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$gammas = $sth->fetchAll();
			return $gammas;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		////////////////////////////////////end gama de color ///////////////////////////////////////
			
			/////////////////////////////familia de color ////////////////////////////////////////////	
			public function getAllFamilyColorProduct(){
		   	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM familiacolorproducto ORDER BY abs(position_familiacolorproducto) DESC";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$colors = $sth->fetchAll();
			return $colors;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		public function getFamiliaColorProductoForId($id_familiacolorproducto)
		{
			 	try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM familiacolorproducto WHERE id_familiacolorproducto = :id_familiacolorproducto";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_familiacolorproducto', $id_familiacolorproducto, PDO::PARAM_STR);
			$sth->execute();
			$familyproducts = $sth->fetchObject();
			return $familyproducts->nombre_familiacolorproducto;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			
			}
			
		public function getFamilyColorProductForId($id_familiacolorproducto)
			{
					try{
				$dbh = Database::getInstance();
				$sql = "SELECT * FROM familiacolorproducto WHERE id_familiacolorproducto = :id_familiacolorproducto";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':id_familiacolorproducto', $id_familiacolorproducto, PDO::PARAM_STR);
				$sth->execute();
				$familyproducts = $sth->fetchObject();
				return $familyproducts;
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			
			}
			
	//
	public function getColorsPublishedOfBrand($id_marca)
			{
					try{
				$dbh = Database::getInstance();
				$sql = "SELECT * FROM producto WHERE id_marca = :id_marca AND published_producto = '1'";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
				$sth->execute();
				$familyproducts = $sth->fetchAll();
				return $familyproducts;
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			
			}
			
			//obtenemos la maxima galeria para ubicar las posiciones
				//@return $MaxPositionGallery
	public function getMaxPositionGallery(){
			//get the next register for sum 1 and positioning here
			$dbh = Database::getInstance();
			$sql = "SELECT max(abs(position_galeria_marca)) AS maximun FROM galeria_marca";
			$sth = $dbh->prepare($sql);
			$sth->execute();
			$ObjectMaxPositionGallery = $sth->fetchObject();
			$MaxPositionLine = $ObjectMaxPositionGallery->maximun;
			return $MaxPositionGallery;
		}				
	// guardamos una imágen en la galería de una marca		
	 public function saveGalleryBrand($id_marca, $titulo_galeria, $imagen_galeria, $texto_galeria, $thumb_imagen_galeria, $id_color1_galeria, $id_color2_galeria, $id_color3_galeria, $id_color4_galeria, $id_color5_galeria, $published_galeria,  $position_galeria_marca)
	 {
		 try{
			 $dbh = Database::getInstance();
			 $sql = "INSERT INTO galeria_marca (id_marca, titulo_galeria, texto_galeria, imagen_galeria, thumb_imagen_galeria, id_color1_galeria, id_color2_galeria, id_color3_galeria, id_color4_galeria, id_color5_galeria, published_galeria, position_galeria_marca) VALUES(:id_marca, :titulo_galeria, :texto_galeria, :imagen_galeria, :thumb_imagen_galeria, :id_color1_galeria, :id_color2_galeria, :id_color3_galeria, :id_color4_galeria, :id_color5_galeria, :published_galeria, :position_galeria_marca)";
			 $sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->bindParam(':titulo_galeria', $titulo_galeria, PDO::PARAM_STR);
			$sth->bindParam(':texto_galeria', $texto_galeria, PDO::PARAM_STR);
			$sth->bindParam(':imagen_galeria', $imagen_galeria, PDO::PARAM_STR);
			$sth->bindParam(':thumb_imagen_galeria', $thumb_imagen_galeria, PDO::PARAM_STR);
			$sth->bindParam(':id_color1_galeria', $id_color1_galeria, PDO::PARAM_STR);
			$sth->bindParam(':id_color2_galeria', $id_color2_galeria, PDO::PARAM_STR);
			$sth->bindParam(':id_color3_galeria', $id_color3_galeria, PDO::PARAM_STR);
			$sth->bindParam(':id_color4_galeria', $id_color4_galeria, PDO::PARAM_STR);
			$sth->bindParam(':id_color5_galeria', $id_color5_galeria, PDO::PARAM_STR);
			$sth->bindParam(':published_galeria', $published_galeria, PDO::PARAM_STR);
			$sth->bindParam(':position_galeria_marca', $position_galeria_marca, PDO::PARAM_STR);
			$sth->execute();
			$gallery = $sth->rowCount(); 
			return $gallery;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); } 
		 }
		 //obtenemos las imagenes de la galería de una marca
	public function getGalleryForIdBrand($id_marca)
			{
			try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM galeria_marca WHERE id_marca = :id_marca ORDER BY abs(position_galeria_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$gallerybrand = $sth->fetchAll();
			return $gallerybrand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }		
		}
				 //obtenemos las imagenes publicadas de la galería de una marca
	public function getGalleryPublishedForIdBrand($id_marca)
			{
			try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM galeria_marca WHERE id_marca = :id_marca AND published_galeria = '1'  ORDER BY abs(position_galeria_marca) DESC";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$gallerybrand = $sth->fetchAll();
			return $gallerybrand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }		
		}
		
				 //obtenemos la marca de una galeria
	public function getBrandForIdGallery($id_galeria_marca)
			{
			try{
			$dbh = Database::getInstance();
			$sql = "SELECT * FROM galeria_marca WHERE id_galeria_marca = :id_galeria_marca";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_galeria_marca', $id_galeria_marca, PDO::PARAM_STR);
			$sth->execute();
			$brand = $sth->fetchObject();
			return $brand;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }		
		}
		
		public function deleteItemOfGalleryBrand($id_galeria)
			{
			try {
				// eliminamos los productos relacionados
			$dbh = Database::getInstance();
			$sql = "DELETE FROM galeria_marca WHERE id_galeria_marca = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($id_galeria));
			$delete = $sth->rowCount();			
			return $delete;
			}catch (PDOException $e) {
			  die( 'Fallo en query: ' . $e->getMessage() );}
			}			 		
						
} 