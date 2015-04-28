<?php
require(APP_ROOT_CONTROLLERS."Controller.php");
require(APP_ROOT_MODELS."BuscadorModel.php");

class BuscadorController extends Controller
{
	public function __construct(){$this->_view = new View();}
	public function IndexAction()
	{
	 }
	public function searchAction()
	{	
		if ($_POST['searchword']){
			$querystring = $_POST['searchword'];
			$buscadorModel = new BuscadorModel();
			$marcas = $buscadorModel->obtenerMarcasParaBuscador($querystring);
			$reg = false;
			$flag = 0;
			echo "<ul id=\"result\">";
			foreach($marcas as $m){
				$flag += 1;
				if ($flag == 1)
				{
					//echo "<li class=\"search_aside\"><div id=\"header_search\"><a href=\"".HTML_PATH."linea_decorativa\">Marcas</a></div></li>";
				}
				$url_linea = $buscadorModel->getUrlLineForIdBrand($m['id_marca']);
				$url_tipo_producto = $buscadorModel->getUrlTypeProductForIdBrand($m['id_marca']);
				$href =  HTML_PATH.$url_tipo_producto."/".$m['url_marca'];
				$nombre_marca = $m['nombre_marca'];
				$nombre_marca = shorten_string($nombre_marca, 5);
				$re_fname='<b>'.$querystring.'</b>';
				$final_fname = str_ireplace($querystring, $re_fname, $nombre_marca);
				$reg = true;
				?>
                <li>
                <?php 
				$imgProduct = ($m['imagen_marca'] != "") ? HTML_PATH_IMAGES.'lineas/marcas/thumb.'.$m['imagen_marca'] : HTML_PATH_IMAGES.'xxx.jpg';
				?>
        <a href="<?php echo $href;?>">
        <img width="50" height="50" src="<?php echo $imgProduct;?>" style="display:inline-block; margin-right:6px" />
        <div style="float:right; width:95px; height:47px;"><?php echo $final_fname; ?></div><br/>
        <span style="font-size:9px; color:#999999"></span>
        </a>
        </li>
        <?php
						
				}
				if ($flag != 0)
				{
					// echo "<li class=\"search_aside\"><div id=\"bottom_search\"><a href=\"".HTML_PATH."linea_decorativa\">Ver más</a></div></li>";
				}
				if (!$reg){
	echo "<div id=\"bottom_search\"  style=\"color:#999999\">No se encontrarón resultados</div>";
	}
	echo "</ul>";			
		}
		else
			{
				
			}
	 }	 
}