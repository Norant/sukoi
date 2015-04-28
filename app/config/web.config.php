<?php
  ini_set("display_errors", true);  define('APP_KEY_SECRET', '25c65e03183ac985805567b4b5a61badda31a291/');
  define('HTTP_SERVER', 'http://localhost/');
  define('HTTPS_SERVER', 'https://localhost//');
  define('ENABLE_SSL', false);
// Html Paths
  define('HTML_PATH', 'http://localhost/sukoi/');
  define('STATIC_SERVER', 'http://static.trilce.edu.pe');
  define('HTML_PATH_STATIC', 'http://localhost/sukoi/static/');
  define('HTML_PATH_IMAGES', 'http://localhost/sukoi/static/images/');
  define('HTML_PATH_CSS', 'http://localhost/sukoi/static/css/');
  define('HTML_PATH_JS', 'http://localhost/sukoi/static/scripts/');
  define('HTML_PATH_SWF', 'http://localhost/sukoi/static/swf/');
// Html Paths Administración
  define('HTML_PATH_ADMIN', 'http://localhost/sukoi/saf/');
  define('HTML_PATH_STATIC_ADMIN', 'http://localhost/sukoi/static/saf/');
  define('HTML_PATH_IMAGES_ADMIN', 'http://localhost/sukoi/static/saf/img/');
  define('HTML_PATH_CSS_ADMIN', 'http://localhost/sukoi/static/saf/css/');
  define('HTML_PATH_JS_ADMIN', 'http://localhost/sukoi/static/saf/js/');
  define('HTML_PATH_SWF_ADMIN', 'http://localhost/sukoi/static/saf/swf/');
// Paths
  define('APP_ROOT', 'C:/xampp/htdocs/sukoi/');
  define('APP_ROOT_PATH', 'C:/xampp/htdocs/sukoi/app/');
  define('APP_ROOT_CLASES', 'C:/xampp/htdocs/sukoi/vendor/clases/');
  define('APP_ROOT_HELPERS', 'C:/xampp/htdocs/sukoi/vendor/helpers/');
  define('APP_ROOT_CONFIG', 'C:/xampp/htdocs/sukoi/config/');
  define('APP_ROOT_VENDOR', 'C:/xampp/htdocs/sukoi/vendor/');
  define('APP_ROOT_CONTROLLERS', 'C:/xampp/htdocs/sukoi/app/controllers/');
  define('APP_ROOT_MODELS', 'C:/xampp/htdocs/sukoi/app/models/');
  define('APP_ROOT_VIEWS', 'C:/xampp/htdocs/sukoi/app/views/');
  define('APP_ROOT_LAYOUTS', 'C:/xampp/htdocs/sukoi/app/layouts/');
// Connexiones
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_SERVER_DATABASE', 'dbweb');
  define('DNS','mysql:dbname=dbweb;host=localhost');

  function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
// Manejo de errores
 set_exception_handler( 'handleException' );

  define('DB_ERROR_UPDATE', 'Error en update.');
  define('DB_ERROR_INSERT', 'Error en insert');
  define('DB_ERROR_DELETE', 'Error en delete');