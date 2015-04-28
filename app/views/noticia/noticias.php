			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Noticias</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Noticias</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Sede</th>
								  <th>Título</th>
                                  <th>Imágen</th>
								  <th>Fecha</th>
								  <th>Status</th>
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php 
						  $model = new SafModel();
						  $staticserver = empty($staticserver) ? "http://static.trilce.edu.pe/web/noticias/fotos-noticias/" : "";
						  foreach($noticias as $n){
							  if ($n['video_noticia'] != ""){ $iconoVideo = "<i class=\"icon-facetime-video\"></i> ";}
							  else
							  {$iconoVideo = "";}
							  $sede = $model->getSeatForId($n['id_sede']);
							  $nombre_sede = isset($sede->nombre_sede) ? $sede->nombre_sede : "";
							  $id_noticia = isset($n['id_noticia']) ? $n['id_noticia'] : "";
							  $titulo_noticia = isset($n['titulo_noticia']) ? $n['titulo_noticia'] : "";
							 
							  $imagen_noticia = ($n['imagen_noticia'] != "") ? "<img width=\"80\" src=\"".$staticserver.$n['imagen_noticia']." \">" : "<span class=\"label label-warning\">No hay imágen</span>";
							  $published = isset($n['published']) ? "<span class=\"label label-success\">Publicado</span>":"<span class=\"label\">No Publicado</span>";
							  echo "<tr>
							  <td class=\"center\">".utf8_encode($nombre_sede)."</td>
							  <td class=\"center\">".$iconoVideo.$n['titulo_noticia']."</td>
							  <td class=\"center\">".$imagen_noticia."</td>
							  <td class=\"center\">".$n['fecha_noticia']."</td>
							  <td class=\"center\">".$published."</td>
							  <td class=\"center\">
									<a class=\"btn btn-info\" href=\"".HTML_PATH."index/editar_noticia/".$n['id_noticia']."\" style=\"margin-top:3px;\">
										<i class=\"icon-edit icon-white\"></i>  
										Editar                                            
									</a>
									<a class=\"btn btn-danger\" href=\"#\"  title=\"".$id_noticia."\" style=\"margin-top:3px;\">
										<i class=\"icon-trash icon-white\"></i> 
										Eliminar
									</a>
									   <div class=\"modal hide fade ". $id_noticia."\" id=\"myModal\">
			<div class=\"modal-header\">
				<button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
				<h3>Eliminar noticia " . $titulo_noticia."</h3>
			</div>
			<div class=\"modal-body\">
				<p>Sera eliminada la noticia:  <b>" . $titulo_noticia . "</b></p>
			</div>
			<div class=\"modal-footer\">
				<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cancelar</a>
				<a href=\" ".HTML_PATH."index/eliminar_noticia/" . $id_noticia."\" class=\"btn btn-primary\">Eliminar noticia " . utf8_encode($titulo_noticia)."</a>
			</div>
		</div>
								</td>
								 <td width=\"67\"><a class=\"upactionnoticia\" title=\"".$n['id_noticia']."\"></a> <a title=". $n['id_noticia']." class=\"downactionnoticia\"></a></td>";
							  }?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
