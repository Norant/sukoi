<?php
require(APP_ROOT_CLASES."Pagination.php");
class PaginacatalogoHelper extends Pagination
{
	public $result_pag_data;
	public function generarestructura()
	{
	$indexModel = new IndexModel();	
	$this->result_pag_data = parent::paginar();
	$subaction = $indexModel->obtenerNombreDeUrlDeCategoria($this->subaction);
	$msg = "";
	$msg .= "<div class=\"highslide-gallery\">";
			foreach($this->result_pag_data as $row) 
			{ //ITERA		
				$msg .= "<a class=\"highslide\" onclick=\"return hs.expand(this)\" href=\"".HTML_PATH_IMAGES."catalogo/ropamaterna/" . $row[5] ."\"><img src=".HTML_PATH_IMAGES."catalogo/ropamaterna/" . $row[4] . " /></a><div class=\"highslide-caption\"><h4>". utf8_encode($subaction->nombre)."</h4></div>";
			}
	$msg .= "</div>";
	return utf8_encode($msg);
	 }
}