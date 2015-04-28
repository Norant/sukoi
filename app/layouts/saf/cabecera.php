<!--Inicio estructura principal-->
<!--Inicio cabecera-->
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="<?php echo HTML_PATH_IMAGES;?>shared/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td><input type="text" value="Search" onblur="if (this.value=='') { this.value='Search'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
		<td>
		 
		<select  class="styledselect">
			<option value="">All</option>
			<option value="">Products</option>
			<option value="">Categories</option>
			<option value="">Clients</option>
			<option value="">News</option>
		</select> 
		 
		</td>
		<td>
		<input type="image" src="<?php echo HTML_PATH_IMAGES;?>shared/top_search_btn.gif"  />
		</td>
		</tr>
		</table>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>

<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><a id="login"><img src="<?php echo HTML_PATH_IMAGES;?>shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></a></div>
			<div class="nav-divider">&nbsp;</div>
			<a href="<?php echo HTML_PATH;?>saf/destroySession" id="logout"><img src="<?php echo HTML_PATH_IMAGES;?>shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		
			<!--  start account-content -->	
			<div class="account-content">
			<div class="account-drop-inner">
				<a href="<?php echo HTML_PATH;?>saf/micuenta" id="acc-settings">Settings</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-details">Personal details </a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-project">Project details</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-inbox">Inbox</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-stats">Statistics</a> 
			</div>
			</div>
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
        <?php if ($_GET['action'] == "vestido"){$menu_vestido = "current"; } else {$menu_vestido = "select";}?>
        <?php if ($_GET['subaction'] == "nuevo"){$submenu_vestido_nuevo = " class=\"sub_show\""; } else {$submenu_vestido_nuevo = "";}?>
        <?php if ($_GET['subaction'] == "mostrar"){$submenu_vestido_mostrar = " class=\"sub_show\""; } else {$submenu_vestido_mostrar = "";}?>
         <?php if ($_GET['subaction'] == "categoriavestido"){$submenu_categoriavestido_mostrar = " class=\"sub_show\""; } else {$submenu_categoriavestido_mostrar = "";}?>
		
		<ul class="<?php echo $menu_vestido; ?>"><li><a href="<?php echo HTML_PATH; ?>saf/vestido/mostrar/"><b>Ropa Materna</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li><a href="<?php echo HTML_PATH; ?>saf/vestido/mostrar/">Ver todo</a></li>
				<li<?php echo $submenu_vestido_nuevo; ?>><a href="<?php echo HTML_PATH; ?>saf/vestido/nuevo/">Añadir nueva ropa materna</a></li>
				<li<?php echo $submenu_vestido_mostrar; ?>><a href="<?php echo HTML_PATH; ?>saf/vestido/mostrar/">Editar ropa materna</a></li>
                <li<?php echo $submenu_categoriavestido_mostrar; ?>><a href="<?php echo HTML_PATH; ?>saf/vestido/categoriavestido/">Categorias de Ropa Materna</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		   <?php if ($_GET['action'] == "articulo"){$menu_vestido = "current"; } else {$menu_vestido = "select";}?>
        <?php if ($_GET['subaction'] == "nuevo"){$submenu_articulo_nuevo = " class=\"sub_show\""; } else {$submenu_articulo_nuevo = "";}?>
        <?php if ($_GET['subaction'] == "mostrar"){$submenu_articulo_mostrar = " class=\"sub_show\""; } else {$submenu_articulo_mostrar = "";}?>        
		<ul class="<?php echo $menu_vestido; ?>"><li><a href="<?php echo HTML_PATH; ?>saf/articulo/mostrar/"><b>Artículos</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li><a href="<?php echo HTML_PATH; ?>saf/articulo/mostrar/">Ver todos los artículos</a></li>
				<li<?php echo $submenu_articulo_nuevo; ?>><a href="<?php echo HTML_PATH; ?>saf/articulo/nuevo/">Añadir artículo</a></li>
                <li<?php echo $submenu_articulo_mostrar; ?>><a href="<?php echo HTML_PATH; ?>saf/articulo/mostrar/">Editar artículos</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
<!--final cabecera-->