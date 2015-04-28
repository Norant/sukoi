<?php
class Modelo
{
	function __construct(){}
	
	public function obtenerTodosLasCamposDeTabla($table)
	{
	if ($table == "") throw new Exception("No se ha especificado una tabla en ".__METHOD__); 
	$dbh = Database::getInstance();
	$sth = $dbh->prepare("SELECT * FROM ".$table."");
	$sth->execute(array($valor));
	$campos = $sth->fetchAll();
	return $campos;	
	}
	
	public function obtenerTodosLasCamposDeTablaPorWhere($table, $where, $valor)
	{
	$dbh = Database::getInstance();
	$sth = $dbh->prepare("SELECT * FROM ".$table." WHERE ".$where." = ?");
	$sth->execute(array($valor));
	$campos = $sth->fetchAll();
	return $campos;	
	}
	
	public function obtenerDatosPorNamex($namex, $campo, $table)
	{
	$namex = stringSeguro($namex);//esta funcion esta en security.php
	$dbh = Database::getInstance();
	$sql = "SELECT * FROM ".$table." WHERE ".$campo." = ?" ;
	$sth= $dbh->prepare($sql); 
	$sth->execute(array($namex));
	$datos= $sth->fetchObject();
    return $datos;	 
	}	
	
	public function obtenerDatosPorId($id, $campo, $table)
	{
	$id = stringSeguro($id);//esta funcion esta en security.php
	$dbh = Database::getInstance();
	$sql = "SELECT * FROM ".$table." WHERE ".$campo." = ?" ;
	$sth= $dbh->prepare($sql); 
	$sth->execute(array($id));
	$datos= $sth->fetchObject();
    return $datos;	 
	}	
}