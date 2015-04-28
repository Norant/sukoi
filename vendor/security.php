<?php
// Prevent any possible XSS attacks via $_GET. //actualizar esto a PHP 5.3+
foreach ($_GET as $check_get) {
    if ((preg_match("/\.<[^>]*script*\"?[^>]*>/i", $check_get)) || (preg_match("/\.<[^>]*object*\"?[^>]*>/i", $check_get)) ||
        (preg_match("/\.<[^>]*iframe*\"?[^>]*>/i", $check_get)) || (preg_match("/\.<[^>]*applet*\"?[^>]*>/i", $check_get)) ||
        (preg_match("/\.<[^>]*meta*\"?[^>]*>/i", $check_get)) || (preg_match("/\.<[^>]*style*\"?[^>]*>/i", $check_get)) ||
        (preg_match("/\.<[^>]*form*\"?[^>]*>/i", $check_get)) || (preg_match("/\([^>]*\"?[^)]*\)/i", $check_get)) ||
        (preg_match("/\.\"/i", $check_get))) {
									die ();
									}
}
unset($check_get);
function secure($string) { 
        $string = strip_tags($string); 
        $string = trim($string); 
       // $string = stripslashes($string); 
       // $string = mysql_real_escape_string($string); 
    return $string;  
    } 

function stringSeguro($cadena)
{
	addslashes(trim($cadena));	
	return $cadena;
}
function stringHtmlSeguro($html)
{
	addslashes(htmlentities(trim($html)));
	$html = str_replace('’','\'',$html);
	return $html;
}
function norant_sanitize($input,$link){

	if(is_array($input)){

		foreach($input as $k=>$i){
			$output[$k]=norant_sanitize($i,$link);
		}
	}
	else{
		 
		if(get_magic_quotes_gpc()){
			$input=stripslashes($input);
		}
		 
		$output=mysql_real_escape_string($input);
	}

	return $output;
}

function norant_clean( $value, $allow = '' ){

	$value = norant_sanitize( $value, NULL );
	if( empty($allow) ){
		$allow = '<p><a><b><i><div><span><img><u><i><br><hr><br/><hr/>';
	}
	$value = strip_tags($value,$allow);
	return $value;
}