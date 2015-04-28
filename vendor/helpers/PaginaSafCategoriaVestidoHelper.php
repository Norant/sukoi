<?php
require_once(APP_ROOT_CLASES . "Pagination2.php");
class PaginaSafCategoriaVestidoHelper extends Pagination2
{  
	public $result_pag_data;
	public function generarestructura()
	{
	$this->result_pag_data = parent::paginar();
	
	$msg = "";
	$msg .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" id=\"product-table\">";
	$msg .= "<tr><th class=\"table-header-check\"><a id=\"toggle-all\" ></a></th><th class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">Nombre</a>	</th><th class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">Ver</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Editar</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Eliminar</a></th></tr>";
			foreach($this->result_pag_data as $row) 
			{ //ITERA
	//$nombre_categoria = $buscadorModel->obtenerNombreCategoriaVestido($_GET['namex']);		
				$msg .= "<tr><td><a class=\"upvestido\" alt=\"".$row['id']."\" title = \"".$row['id']."\" id=\"".$row['position']."\">&uarr;</a>  <a class=\"downvestido\" alt=\"".$row['id']."\" title = \"".$row['id']."\" id=\"".$row['position']."\">&darr;</a></td><td>" . stripslashes($row[1]) . "</td><td><a title=\"Ver\" class=\"icon-3 info-tooltip\" href=\"".HTML_PATH."catalogo/ropamaterna/".$this->subaction."/".$row[0]."\" target=\"_blank\"></a></td><td> <a title=\"Editar\" class=\"icon-1 info-tooltip\" href=\"".HTML_PATH."saf/vestido/editar/".$row[0]."/\"></a></td><td> <a title=\"Eliminar\" class=\"icon-2 info-tooltip\" href=\"".HTML_PATH."saf/eliminarcategoriaropamaterna/".$row[0]."/\"></a></td></tr>";
			}
	$msg .= "</table>";
		return utf8_encode($msg);
	 }
}
?>