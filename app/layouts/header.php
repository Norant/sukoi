<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Trilce Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Grupo Trilce">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo HTML_PATH_CSS; ?>bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo HTML_PATH_CSS; ?>bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo HTML_PATH_CSS; ?>charisma-app.css" rel="stylesheet">
	<link href="<?php echo HTML_PATH_CSS; ?>jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo HTML_PATH_CSS; ?>fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo HTML_PATH_CSS; ?>chosen.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>uniform.default.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>colorbox.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>opa-icons.css' rel='stylesheet'>
	<link href='<?php echo HTML_PATH_CSS; ?>uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo HTML_PATH_IMAGES; ?>favicon.ico">
		
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
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Cambiar tema / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
                        <?php 
						//generamos el token de logout
						$token = generateActionToken('logout');
						?>
						<li><a href="<?php echo HTML_PATH;?>logout/<?php echo $token; ?>">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse" style="margin-left:30%;">
					<ul class="nav">
						<li><a href="http://www.trilce.edu.pe" target="_blank">Visita el Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Buscar" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
         <a class="logo"><img alt="Charisma Logo" src="http://static.trilce.edu.pe/web/imagenes/logos/trilce_oficial.png" /></a>
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
						<li class="nav-header hidden-tablet">Banner</li>
						<li><a class="ajax-link" href="#"><i class="icon-home"></i><span class="hidden-tablet"> Nuevo Banner</span></a></li>
						<li><a class="ajax-link" href="#"><i class="icon-eye-open"></i><span class="hidden-tablet"> Editar Banner</span></a></li>
						<li class="nav-header hidden-tablet">Noticias</li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH;?>index/nueva_noticia"><i class="icon-align-justify"></i><span class="hidden-tablet"> Nueva Noticia</span></a></li>
						<li><a class="ajax-link" href="<?php echo HTML_PATH;?>index/noticias"><i class="icon-calendar"></i><span class="hidden-tablet"> Todas las Noticias</span></a></li>
						 <li class="nav-header hidden-tablet">Sedes</li>
                         <li><a class="ajax-link" href="<?php echo HTML_PATH;?>index/sedes"><i class="icon-align-justify"></i><span class="hidden-tablet"> Sedes</span></a></li> 
						<li><a class="ajax-link" href="<?php echo HTML_PATH;?>index/nueva_sede"><i class="icon-align-justify"></i><span class="hidden-tablet"> Agregar Sede</span></a></li> 
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
