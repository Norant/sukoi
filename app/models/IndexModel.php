<?php
require_once(APP_ROOT_CLASES."Database.php");
class IndexModel
{
/**
* Obtiene los cines para un select.
*
* Obtiene los cines para el select del buscador
*
*
* @return array $cines
* <- @param array $cines
*/
	public function obtenerCinesParaSelect()
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT cine_id, cine_nombre FROM cine";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($valor));
	$cines = $sth->fetchAll();
		 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $cines;		
	}
	public function obtenerPeliculasParaBuscador()
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT * FROM pelicula";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($valor));
	$peliculas = $sth->fetchAll();
		 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $peliculas;		
	}
	
	public function obtenerIdDeUrlDeCategoria($urlname)
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT id FROM categoria WHERE url_category_name = ?";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($urlname));
	$id = $sth->fetchObject();
	 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $id;		
	}
	public function obtenerUrlDeIdDeCategoria($id)
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT url_category_name,nombre FROM categoria WHERE id = ?";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($id));
	$urlname = $sth->fetchObject();
	 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $urlname;		
	}
	
	public function obtenerNombreDeUrlDeCategoria($urlname)
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT nombre FROM categoria WHERE url_category_name = ?";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($urlname));
	$nombre = $sth->fetchObject();
	 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $nombre;		
	}
	
	public function obtenerCategoriasDeVestidos()
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT * FROM categoria";
	 $sth = $dbh->prepare($sql);
	 $sth->execute(array($valor));
	 $categorias = $sth->fetchAll();
	 } 
	catch (PDOException $e) {  
	echo "<br />Ha ocurrido un error.<br />";
	echo $e->getMessage();
			}
	return $categorias;		
	}
	
	public function obtenerDatosDeVestido($id)
	{
	 $dbh = Database::getInstance();
	 try{
	 $sql = "SELECT * FROM vestido WHERE id = ?";
	 $sth = $dbh->prepare($sql);
	$sth->execute(array($id));
	$nombre = $sth->fetchObject();
	 } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			}
	return $nombre;		
	}
} 