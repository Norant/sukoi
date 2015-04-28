<?php
require(APP_ROOT_CLASES . "Pagination.php");
class PaginasafvestidoHelper extends Pagination
{
	public $result_pag_data;
	public function generarestructura()
	{
	$this->result_pag_data = parent::paginar();
	
	$msg = "";
	$msg .= "<div id=\"msnajax\"></div>";
	$msg .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" id=\"product-table2\" style=\"margin-bottom:-1px;\">";
	$msg .= "<tr><th class=\"table-header-check\"><a id=\"toggle-all\" ></a></th><th width=\"630\" class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">Nombre</a>	</th><th width=\"195\" class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">Ver</a></th><th width=\"195\" class=\"table-header-repeat line-left\"><a href=\"\">Editar</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Eliminar</a></th></tr></table>";
	$msg .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" id=\"product-table\">";
			foreach($this->result_pag_data as $row) 
			{ //ITERA
	//$nombre_categoria = $buscadorModel->obtenerNombreCategoriaVestido($_GET['namex']);		
				$msg .= "<tr><td width=\"30\"><a style=\"cursor:pointer;\" class=\"upvestido\" alt=\"".$row['id']."\" title = \"".$row['categoria_id']."\" id=\"".$row['position']."\">&uarr;</a> &nbsp;&nbsp; <a style=\"cursor:pointer;\" class=\"downvestido\" alt=\"".$row['id']."\" title = \"".$row['categoria_id']."\" id=\"".$row['position']."\">&darr;</a></td><td width=\"630\">" . stripslashes($row[1]) . "</td><td width=\"195\"><a title=\"Ver\" class=\"icon-3 info-tooltip\" href=\"".HTML_PATH."catalogo/vestido/".$this->subaction."/".$row[0]."\" target=\"_blank\"></a></td><td width=\"195\"> <a title=\"Editar\" class=\"icon-1 info-tooltip\" href=\"".HTML_PATH."saf/vestido/editar/".$row[0]."/\"></a></td><td width=\"195\"> <a title=\"Eliminar\" class=\"icon-2 info-tooltip\" href=\"".HTML_PATH."saf/eliminarvestido/".$row['categoria_id']."/".$row[0]."/\"></a></td></tr>";
			}
	$msg .= "</table>";
	$msg .= "<script>			
	$('#product-table a.upvestido').live('click', function() {
		var id = $(this).attr('alt');
		var categoria_id = $(this).attr('title');
		var parent = $(this).parent().parent();
		var position = $(this).attr('id');
		var primertr = $('#product-table tr:first');
		if(parent.text() == primertr.text()){setTimeout(window.location.href='".HTML_PATH."saf/vestido/mostrar/'+categoria_id+'/', 1000); }

parent.prev().append().insertAfter(parent).show('slow');
FAjax('".HTML_PATH."saf/upvestido/','msnajax','id='+id+'&categoria_id='+categoria_id,'post');
return false;
});

$('#product-table a.downvestido').live('click', function() {
		var id = $(this).attr('alt');
		var categoria_id = $(this).attr('title');
		var parent = $(this).parent().parent();
		var position = $(this).attr('id');
		var ultimotr = $('#product-table tr:last');
		var pagina = $('#containerpagina .pagination li.active').attr('p');
		if ((parent.text() == ultimotr.text())  && (position == 1)){
			alert(' No puedes bajar este registro !');	}
			else if(parent.text() == ultimotr.text()){
			parent.remove();	
			FAjax('".HTML_PATH."saf/downvestido/','msnajax','id='+id+'&categoria_id='+categoria_id,'post');
				}
			else{
parent.next().append().insertBefore(parent).show('slow');
FAjax('".HTML_PATH."saf/downvestido/','msnajax','id='+id+'&categoria_id='+categoria_id,'post');
}
return false;
});		 
</script>";
		return utf8_encode($msg);
	 }
}
?>