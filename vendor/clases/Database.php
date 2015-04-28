<?php
/** 
 * @author Mario Gonzales Flores noranterri@gmail.com
 * @capa de abstracción de base de datos usando Singleton
 * 
 */    
require_once APP_ROOT_CLASES.'Safepdo.php';
final class Database {
  private static $dns       = DNS;   
  private static $username  = DB_SERVER_USERNAME;
  private static $password  = DB_SERVER_PASSWORD;   
  private static $instance;
  private static $driver_options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;');   
       
  private function __construct() { }   
       
  /**  
   * Crea una instancia de la clase PDO  
   *   
   * @access public static  
   * @return object de la clase PDO  
   */   
  public static function getInstance()   
  {   
    if (!isset(self::$instance))   
    {   
      self::$instance = new SafePDO(self::$dns, self::$username, self::$password, self::$driver_options);   
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    }   
    return self::$instance;   
  }   
       
       
 /**  
  * Impide que la clase sea clonada  
  *   
  * @access public  
  * @return string trigger_error  
  */   
  public function __clone()   
  {   
    trigger_error('Clone is not allowed.', E_USER_ERROR);   
  }   
	
}
//$dbh = Database::getInstance();