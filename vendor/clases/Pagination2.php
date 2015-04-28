<?php
require_once(APP_ROOT_CLASES."Model.php");
class Pagination2  //ESTA PAGINACION USA LIMIT SI DESEA USAR OTRA BD DIFERENTE DE MYSQL CAMBIE LA LINEA(34) CORRESPONDIENTE
{
	protected $tabla;
	protected $xpags;
	protected $page;
	protected $cat;
	public function __construct($tabla,$xpags,$page,$cat="",$subaction=""){
		$this->tabla = $tabla;
		$this->xpags = $xpags;
		$this->page = $page;
		$this->cat = $cat;
		$this->subaction = $subaction;
		}

	public function paginar(){

		if ($this->tabla == ""){ throw new Exception("Tabla de paginación no encontrada en ".__METHOD__);}		
		//if($_POST['page'])
		//{
		//$page = $_POST['page']; //VARIABLE POST
		$page = $this->page;
		$cur_page = $page; //PAGINA ACTUAL
		$page -= 1; //PAGINA ADECUADA
		$per_page = $this->xpags; //REGISTROS POR PAGINA
		$start = $page * $per_page; //INICIO

		$model = new Model();
		$query_pag_data = "SELECT * FROM " . $this->tabla . " ORDER BY id DESC LIMIT $start, $per_page"; //SELECT CON LIMITES
		$result_pag_data = $model->executeQuery($query_pag_data);//EJECUTA EL SELECT CON LIMITES
		return $result_pag_data;
		}
		
		public function obtenerLinksDePaginacion(){
		$page = $this->page;
		$cur_page = $page; //PAGINA ACTUAL
		$page -= 1; //PAGINA ADECUADA
		$per_page = $this->xpags; //REGISTROS POR PAGINA
		$previous_btn = true; //BOTON ANTES
		$next_btn = true; //BOTON SIGUIENTE
		$first_btn = true; //PRIMER BOTON
		$last_btn = true; //ULTIMO BOTON
		$start = $page * $per_page; //INICIO
		$msg = "";
		/* --------------------------------------------- */
		$dbh = Database::getInstance();
		$query_pag_num = "SELECT * FROM " . $this->tabla." ORDER BY id DESC"; //CUENTA LOS REGISTROS
		$sth = $dbh->prepare($query_pag_num);
		$sth->execute(array($valor));
		$result_pag_num = $sth->fetchAll();
		$count = count($result_pag_num);
		$no_of_paginations = ceil($count / $per_page);  //OBTIENE EL NUMERO DE PAGINACION
		
		/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
		if ($cur_page >= 7) {
			$start_loop = $cur_page - 3;
			if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			} else {
				$end_loop = $no_of_paginations;
			}
		} else {
			$start_loop = 1;
			if ($no_of_paginations > 7)
				$end_loop = 7;
			else
				$end_loop = $no_of_paginations;
		}
		/* ----------------------------------------------------------------------------------------------------------- */
		$msg .= "<div class='pagination'><ul>"; //CIERRA EL MENSAJE
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1) {
			$msg .= "<li p='1' class='active'>Primero</li>";
		} else if ($first_btn) {
			$msg .= "<li p='1' class='inactive'>Primero</li>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1) {
			$pre = $cur_page - 1;
			$msg .= "<li p='$pre' class='active'>Anterior</li>";
		} else if ($previous_btn) {
			$msg .= "<li class='inactive'>Anterior</li>";
		}
		for ($i = $start_loop; $i <= $end_loop; $i++) {
		
			if ($cur_page == $i)
				$msg .= "<li p='$i' style='color:#fff;background-color:#B6C932;' class='active'>{$i}</li>";
			else
				$msg .= "<li p='$i' class='active'>{$i}</li>";
		}
		
		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations) {
			$nex = $cur_page + 1;
			$msg .= "<li p='$nex' class='active'>Siguiente</li>";
		} else if ($next_btn) {
			$msg .= "<li class='inactive'>Siguiente</li>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations) {
			$msg .= "<li p='$no_of_paginations' class='active'>Último</li>";
		} else if ($last_btn) {
			$msg .= "<li p='$no_of_paginations' class='inactive'>Último</li>";
		}
		$goto = "";
		$total_string = "";
		$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
		return $msg;
		// }
	}
}
