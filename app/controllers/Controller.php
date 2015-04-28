<?php
require("ControllerInterface.php");
require(APP_ROOT_VIEWS)."View.php";
class ControllerException extends Exception {}
abstract class Controller implements ControllerInterface
{
 private $_view;

 public function __construct(){	 }
 public function indexAction(){}
  public function obtenerPeliculasParaBuscador()
  {
  $index = new IndexModel();
  $peliculas_buscador = $index->obtenerPeliculasParaBuscador();
  return $peliculas_buscador;
	  }
}