<?php
require(APP_ROOT_CLASES."Pagination.php");
class PaginasafcalaHelper extends Pagination
{
	public $result_pag_data;
	public function generarestructura()
	{
	$this->result_pag_data = parent::paginar();
	$msg = "";
	$msg .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" id=\"product-table\">";
	$msg .= "<tr><th class=\"table-header-check\"><a id=\"toggle-all\" ></a></th><th class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">Nombre o Razón social</a>	</th><th class=\"table-header-repeat line-left minwidth-1\"><a href=\"\">RUC</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Teléfono</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Email</a></th><th class=\"table-header-repeat line-left\"><a href=\"\">Dirección</a></th><th class=\"table-header-options line-left\"><a href=\"\">Opciones</a></th></tr>";
			foreach($this->result_pag_data as $row) 
			{ //ITERA		
				$msg .= "<tr><td></td><td>" . $row[1] . "</td><td> " . $row[2] . "</td><td> " . $row[3] . "</td><td> " . $row[4] . "</td><td> " . $row[5] . "</td><td class=\"options-width\"><a href=\"\" title=\"Ver\" class=\"icon-1 info-tooltip\"></a><a href=\"\" title=\"Editar\" class=\"icon-3 info-tooltip\"></a><a href=\"\" title=\"Eliminar\" class=\"icon-2 info-tooltip\"></a></td></tr>";
			}
	$msg .= "</table>";
	return $msg;
	 }
}