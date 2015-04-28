<?php
require_once(APP_ROOT_CLASES."Database.php");
class ContenidoModel
{
	public function __construct(){}
	
	public function checkUrl($url_contenido)
	{
	 $dbh = Database::getInstance(); 
	 $sql = "SELECT * FROM contenido WHERE url_contenido = :url_contenido";
	 $sth = $dbh->prepare($sql);
	 $sth->bindParam(':url_contenido', $url_contenido, PDO::PARAM_STR);
	 $sth->execute();
	 $contenido = $sth->fetchObject();
	 return $contenido;		
	}
}