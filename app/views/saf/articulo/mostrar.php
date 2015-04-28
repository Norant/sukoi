<?php
require(APP_ROOT_MODELS."BuscadorModel.php");
		$buscadorModel = new BuscadorModel();
?><div id="content-outer">
<!-- start content -->
<div id="content">
	<div id="page-heading">
		<h1>Editar Artículos -> <?php echo $name_categoria;?></h1>
          <?php foreach ($categoria as $catego){
			echo "<a href=\"".HTML_PATH."saf/articulo/mostrar/".$catego['id_tipo_articulo']."/\">".utf8_encode($catego['nombre_tipo_articulo'])."</a> | ";
			}?>
	</div>
    <?php echo $_SESSION['respuesta']; ?>
    <br /><br />
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
<tr><th class="table-header-check"><!--<a id="toggle-all" ></a>--> </th><th class="table-header-repeat line-left minwidth-1"><a>Nombre</a></th><th class="table-header-repeat line-left"><a>Ver</a></th><th class="table-header-repeat line-left"><a>Editar</a></th><th class="table-header-repeat line-left"><a>Eliminar</a></th></tr>
<?php
foreach ($articulos as $arti)
{
$nombre_tipo_articulo = $buscadorModel->obtenerNombreTipoArticulo($arti['id_tipo_articulo']);
echo "<tr onMouseOver=\"this.bgColor = '#F0F0F0'\" onMouseOut =\"this.bgColor = '#FFFFFF'\"
    bgcolor=\"#FFFFFF\"><td></td><td><b>".utf8_encode(stripslashes($arti['nombre_articulo']))."</b></td><td><a title=\"Ver\" class=\"icon-3 info-tooltip\" href=\"".HTML_PATH."articulo/".$nombre_tipo_articulo->nombre_tipo_articulo."/".$arti['id_articulo']."\" target=\"_blank\"></a></td><td><a title=\"Editar\" class=\"icon-1 info-tooltip\" href=\"".HTML_PATH."saf/articulo/editar/".$arti['id_articulo']."/\"></a></td><td><a title=\"Eliminar\" class=\"icon-2 info-tooltip\" href=\"".HTML_PATH."saf/eliminararticulo/".$catego['id_tipo_articulo']."/".$arti['id_articulo']."/\"></a></td></tr>"; 
}
?>
</table></div></div>
<?php $_SESSION['respuesta'] = "";?>