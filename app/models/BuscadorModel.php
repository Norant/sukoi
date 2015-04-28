<?php
require_once(APP_ROOT_CLASES."Database.php");
class BuscadorModel
{
	public function __construct(){}
	
	public function obtenerMarcasParaBuscador($querystring)
	//SELECT DISTINCT f.pelicula_id FROM pelicula p, funcion f WHERE p.pelicula_estado = 'no_publicada' AND f.pelicula_id != 0;
	{
	 $querystring = addcslashes($querystring,"%");
	 $dbh = Database::getInstance();
	 "SELECT * FROM test_user_data WHERE fname LIKE '%$q%' OR lname LIKE '%$q%' ORDER BY uid LIMIT 5";
	 
	 $sql = "SELECT id_marca,nombre_marca, url_marca, imagen_marca FROM marca  WHERE nombre_marca LIKE ? AND published_marca = '1' LIMIT 0,6";
	 $sth = $dbh->prepare($sql);
	 $querystring = '%'.trim($querystring).'%';
	 $sth->bindParam(1, $querystring);
	 $sth->execute();
	 $peliculas = $sth->fetchAll();
	 return $peliculas;		
	}
	//@return $getUrlTypeProductForIdBrand
	 public function getUrlTypeProductForIdBrand($id_marca){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT DISTINCT tp.url_tipo_producto FROM marca_has_tipo_producto mtp, tipo_producto tp, marca m WHERE mtp.id_marca = m.id_marca AND tp.id_tipo_producto = mtp.id_tipo_producto AND mtp.id_marca = :id_marca";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$urlTypeProduct = $sth->fetchObject();
			return $urlTypeProduct->url_tipo_producto;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
	//@return $getUrlLineForIdBrand
	 public function getUrlLineForIdBrand($id_marca){
		   try{
			$dbh = Database::getInstance();
			$sql = "SELECT l.url_linea FROM linea l, marca m WHERE m.id_marca = :id_marca AND l.id_linea = m.id_linea";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
			$sth->execute();
			$urlLine = $sth->fetchObject();
			return $urlLine->url_linea;
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}				
}