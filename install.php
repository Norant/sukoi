<?php
$puerto = $_SERVER['SERVER_PORT'];
if($puerto=="80")$puerto = ""; 
$http_url = parse_url("http://".$_SERVER['HTTP_HOST'].":".$puerto.$_SERVER['REQUEST_URI']);
 $http_server = $http_url['scheme'] . '://' . $http_url['host'];
 $folder = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }
echo "HTTP_SERVER: ".$http_server."/";
echo "<br />";
$https_url = parse_url('https://' . $_SERVER['HTTP_HOST']);
 $https_server = $https_url['scheme'] . '://' . $https_url['host'];
  if (isset($https_url['port']) && !empty($https_url['port'])) {
    $https_server .= ':' . $https_url['port'];
  }
$https_server = 'https://' . $_SERVER['HTTP_HOST']."/";
echo "HTTPS_SERVER: ".$https_server;
echo "<br />";
echo "ENABLE_SSL: false";
echo "<br />";
$folder = explode("install.php",$folder);
echo "ROOT_PATH: ".$http_server.$folder[0];
echo "<br />";
echo "HTML_PATH_IMAGES: ".$http_server.$folder[0]."data/images/";

echo "<br />";
echo "HTML_PATH_CSS: ".$http_server.$folder[0]."data/css/";
echo "<br />";
echo "HTML_PATH_JS: ".$http_server.$folder[0]."data/js/";
echo "<br />";
echo "APP_ROOT: ".$_SERVER['DOCUMENT_ROOT'].$folder[0];
echo "<br />";
echo "NOTA IMPORTANTE: CAMBIAR LA CONFIGURACION DE LA BASE DE DATOS EN EL ARCHIVO config/web.config.php";
$file_contents = '<?php' . "\n" .
				   '  ini_set("display_errors", true);'.
				   '  define(\'APP_KEY_SECRET\', \'' . sha1("zeropoint") . '/\');' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '/\');' . "\n" .
                   '  define(\'HTTPS_SERVER\', \'' . $https_server . '/\');' . "\n" .
                   '  define(\'ENABLE_SSL\', false);' . "\n" .
				   '// Html Paths'."\n".
                   '  define(\'HTML_PATH\', \'' .$http_server.$folder[0]. '\');' . "\n" .
				   '  define(\'STATIC_SERVER\', \'' .'http://static.trilce.edu.pe'. '\');' . "\n" .
				   '  define(\'HTML_PATH_STATIC\', \''.$http_server.$folder[0].'static/\');' . "\n" .
                   '  define(\'HTML_PATH_IMAGES\', \''.$http_server.$folder[0].'static/images/\');' . "\n" .
                   '  define(\'HTML_PATH_CSS\', \''.$http_server.$folder[0].'static/css/\');' . "\n" .
				   '  define(\'HTML_PATH_JS\', \''.$http_server.$folder[0].'static/scripts/\');' . "\n" .
				   '  define(\'HTML_PATH_SWF\', \''.$http_server.$folder[0].'static/swf/\');' . "\n" .
				   '// Html Paths Administración'."\n".
                   '  define(\'HTML_PATH_ADMIN\', \'' .$http_server.$folder[0]. 'saf/\');' . "\n" .
				   '  define(\'HTML_PATH_STATIC_ADMIN\', \''.$http_server.$folder[0].'static/saf/\');' . "\n" .
                   '  define(\'HTML_PATH_IMAGES_ADMIN\', \''.$http_server.$folder[0].'static/saf/img/\');' . "\n" .
                   '  define(\'HTML_PATH_CSS_ADMIN\', \''.$http_server.$folder[0].'static/saf/css/\');' . "\n" .
				   '  define(\'HTML_PATH_JS_ADMIN\', \''.$http_server.$folder[0].'static/saf/js/\');' . "\n" .
				   '  define(\'HTML_PATH_SWF_ADMIN\', \''.$http_server.$folder[0].'static/saf/swf/\');' . "\n" .
				   '// Paths'."\n".
				   '  define(\'APP_ROOT\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'\');' . "\n" . 
				   '  define(\'APP_ROOT_PATH\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'app/\');' . "\n" .		
                   '  define(\'APP_ROOT_CLASES\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'vendor/clases/\');' . "\n" .
				   '  define(\'APP_ROOT_HELPERS\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'vendor/helpers/\');' . "\n" .
				   '  define(\'APP_ROOT_CONFIG\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'config/\');' . "\n" .
				   '  define(\'APP_ROOT_VENDOR\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'vendor/\');' . "\n" .
				   '  define(\'APP_ROOT_CONTROLLERS\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'app/controllers/\');' . "\n" .
				   '  define(\'APP_ROOT_MODELS\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'app/models/\');' . "\n" .
				   '  define(\'APP_ROOT_VIEWS\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'app/views/\');' . "\n" .
				   '  define(\'APP_ROOT_LAYOUTS\', \''.$_SERVER['DOCUMENT_ROOT'].$folder[0].'app/layouts/\');' . "\n" .
				   '// Connexiones'."\n".
                   '  define(\'DB_SERVER\', \'localhost\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'root\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'pass\');' . "\n" .
                   '  define(\'DB_SERVER_DATABASE\', \'dbname\');' . "\n" .
                   '  define(\'DNS\',\'mysql:dbname=dbname;host=localhost\');'."\n" .
				   '  function handleException( $exception ) {'."\n" .
				   '  echo "Sorry, a problem occurred. Please try later.";'."\n" .
				   '  error_log( $exception->getMessage() );'."\n" .
				   '}'."\n" .
				   '// Manejo de errores'."\n".				 
				   ' set_exception_handler( \'handleException\' );'."\n" .
				   "\n" .
				   '  define(\'DB_ERROR_UPDATE\', \'Error en update.\');' . "\n" .
				   '  define(\'DB_ERROR_INSERT\', \'Error en insert\');' . "\n" .
				   '  define(\'DB_ERROR_DELETE\', \'Error en delete\');';

  $fp = fopen($_SERVER['DOCUMENT_ROOT'].$folder[0] . 'app/config/web.config.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);