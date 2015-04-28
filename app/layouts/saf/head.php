<?php 
if ($view == "saf/login.php"){
	$no_visible_elements=true;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>ANYPSA | ADMINISTRACIÓN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />

	<!-- The styles -->
	<link id="bs-css" href="<?php echo HTML_PATH_CSS_ADMIN;?>bootstrap-spacelab.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo HTML_PATH_CSS_ADMIN;?>bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo HTML_PATH_CSS_ADMIN;?>charisma-app.css" rel="stylesheet">
	<link href="<?php echo HTML_PATH_CSS_ADMIN;?>jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>chosen.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>uniform.default.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>colorbox.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>opa-icons.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS_ADMIN;?>uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo HTML_PATH_IMAGES_ADMIN;?>favicon.ico">
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><a style="margin-left:-180px;" href="<?php echo HTML_PATH_ADMIN; ?>"><img src="<?php echo HTML_PATH_IMAGES_ADMIN; ?>logo.jpg" /></a>
				
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> Administrador</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo HTML_PATH; ?>saf/logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a target="_blank" href="<?php echo HTML_PATH;?>">Ir a sitio web</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">LÍNEAS</li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>nueva_linea"><i class="icon-leaf"></i><span class="hidden-tablet"> Nueva Línea</span></a></li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>lineas"><i class="icon-leaf"></i><span class="hidden-tablet"> Editar Líneas</span></a></li>
						<li class="nav-header hidden-tablet">MARCAS</li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>nueva_marca"><i class="icon-inbox"></i><span class="hidden-tablet"> Nueva Marca</span></a></li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>marcas"><i class="icon-inbox"></i><span class="hidden-tablet"> Editar Marcas</span></a></li>
                        <li class="nav-header hidden-tablet">Tipos de Producto</li>
						<li><a href="<?php echo HTML_PATH_ADMIN;?>nuevo_tipo_producto"><i class="icon-folder-close"></i><span class="hidden-tablet"> Nuevo Típo</span></a></li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>tipos"><i class="icon-folder-close"></i><span class="hidden-tablet"> Editar Típos</span></a></li>
                        <li class="nav-header hidden-tablet">Colores</li>
						<li><a href="<?php echo HTML_PATH_ADMIN;?>nuevo_producto"><i class="icon-folder-close"></i><span class="hidden-tablet"> Nuevo Color</span></a></li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH_ADMIN;?>productos"><i class="icon-folder-close"></i><span class="hidden-tablet"> Editar Colores</span></a></li>
                        <li class="nav-header hidden-tablet">Clasificación colores</li>
						<li><a href="<?php echo HTML_PATH_ADMIN;?>colores"><i class="icon-folder-close"></i><span class="hidden-tablet"> Colores</span></a></li>
                        <li class="nav-header hidden-tablet">NOVEDADES</li>
						<li><a href="<?php echo HTML_PATH_ADMIN;?>nueva_novedad"><i class="icon-folder-close"></i><span class="hidden-tablet"> Nueva Novedad</span></a></li>
                        <li><a href="<?php echo HTML_PATH_ADMIN;?>novedades"><i class="icon-folder-close"></i><span class="hidden-tablet"> Novedades</span></a></li>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>Tú necesitas tener <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> activado para usar este sistema.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>