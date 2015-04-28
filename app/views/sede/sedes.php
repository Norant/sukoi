			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Sedes</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Sedes</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Tipo de Sede</th>
								  <th>Nombre de Sede</th>
                                  <th>Ubicación</th>
								  <th>Latitud Sede</th>
								  <th>Longitud Sede</th>
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php 
						  $model = new SafModel();
						  $staticserver = empty($staticserver) ? "http://static.trilce.edu.pe/web/noticias/fotos-noticias/" : "";
						  foreach($sedes as $s){
							  $tSede = $s['id_tipo_sede'];
							  $tipoSede = "";
							  if ($tSede == "1" ){ $tipoSede = "Colegio"; }
							  if ($tSede == "2" ){$tipoSede = "Academia";}
							  $published = isset($n['published']) ? "<span class=\"label label-success\">Publicado</span>":"<span class=\"label\">No Publicado</span>";
							  echo "<tr>
							  <td class=\"center\">".$tipoSede."</td>
							  <td class=\"center\">".$s['nombre_sede']."</td>
							  <td class=\"center\">".$s['ubicacion_sede']."</td>
							  
							  <td class=\"center\">".$s['latitud_sede']."</td>
							  <td class=\"center\">".$s['longitud_sede']."</td>
							  <td class=\"center\">
									<a class=\"btn btn-info\" href=\"".HTML_PATH."index/editar_sede/".$s['id_sede']."\" style=\"margin-top:3px;\">
										<i class=\"icon-edit icon-white\"></i>  
										Editar                                            
									</a>
									<a class=\"btn btn-danger\" href=\"#\"  title=\"".$s['id_sede']."\" style=\"margin-top:3px;\">
										<i class=\"icon-trash icon-white\"></i> 
										Eliminar
									</a>
									   <div class=\"modal hide fade ".$s['id_sede'] ."\" id=\"myModal\">
			<div class=\"modal-header\">
				<button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
				<h3>Eliminar sede " . $s['nombre_sede'] . "</h3>
			</div>
			<div class=\"modal-body\">
				<p>Sera eliminada la sede:  <b>" .  $s['nombre_sede'] . "</b></p>
			</div>
			<div class=\"modal-footer\">
				<a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cancelar</a>
				<a href=\" ".HTML_PATH."index/eliminar_sede/" .$s['id_sede']."\" class=\"btn btn-primary\">Eliminar sede " . $s['nombre_sede']."</a>
			</div>
		</div>
								</td>
								 <td width=\"67\"><a class=\"upactionsede\" title=\"".$s['id_sede']."\"></a> <a title=". $s['id_sede']." class=\"downactionsede\"></a></td>";
							  }?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
