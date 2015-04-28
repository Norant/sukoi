<?php
// seteamos en sesion la url
		$urlActual = getUrlActual();    
		$_SESSION['url'] = $urlActual;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$title_page = "" ? "Trilce" : "";
?>
<title><?php echo $title_page; ?></title>
<?php 
$meta_description = "" ? "Trilce description" : "";
$metaimage = "" ? HTML_PATH_IMAGES . "logo.jpg" : "";
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="<?php echo $meta_description;?>">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="HandheldFriendly" content="true">
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="stylesheet" href="<?php echo HTML_PATH_CSS;?>normalize.css">
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<link rel="stylesheet" href="<?php echo HTML_PATH_CSS;?>main.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>//<![CDATA[ 
!window.jQuery && document.write(unescape('%3Cscript src="<?php echo HTML_PATH_JS;?>vendor/jquery-1.9.1.min.js"%3E%3C/script%3E')); 
//]]</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script type='text/javascript'>
  window.Modernizr || document.write('<script src="<?php echo HTML_PATH_JS;?>vendor/modernizr-2.6.2.min.js">\x3C/script>');
</script>
<!-- Open Graph Meta Tags -->
<meta property="og:type" content='website' />
<meta property="og:title" content="<?php echo $title_page; ?>">
<meta property="og:site_name" content="TRILCE"/>
<meta property="og:description" content="<?php echo $meta_description;?>">
<meta property="og:image" content="<?php echo $metaimage;?>">
<meta property="og:url" content="<?php echo $urlActual;?>">
<!-- Fin Open Graph Meta Tags -->