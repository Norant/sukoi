<?php
?>
<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>novedades">Novedades</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Novedades</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                              	  <th>Posición</th>
								  <th>Novedad</th>
                                  <th>Imágen</th>
								  <th>Url Novedad</th>								  
								  <th>Status</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($novedades as $n)
						  { 
						  if ($n['published_novedad'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicada</span>";
							 } 
						  else if($n['published_novedad'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicada</span>";
							  }
						  ?>
							<tr>
                            <td width="67"><a class="upactionnovedad" title="<?php echo $n['id_novedad']?>"></a> <a title="<?php echo $n['id_novedad']?>" class="downactionnovedad"></a></td>
								<td><?php echo $n['nombre_novedad']; ?></td>
                                <td class="center"><img src="<?php echo HTML_PATH_IMAGES."novedades/".$n['imagen_novedad']; ?>" width="50" /></td>
								<td class="center"><?php echo $n['url_novedad']; ?></td>
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_novedad?id_novedad=<?php echo $n['id_novedad'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_novedad?id_novedad=<?php echo $n['id_novedad'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo utf8_encode($n['id_novedad']);?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo utf8_encode($n['id_novedad']);?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar novedad <?php echo utf8_encode($n['nombre_novedad']);?></h3>
			</div>
			<div class="modal-body">
				<p>Los marcas y los productos de <b><?php echo utf8_encode($n['nombre_novedad']);?></b> también serán eliminados</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_novedad?id_novedad=<?php echo $n['id_novedad'];?>" class="btn btn-primary">Eliminar novedad <?php echo utf8_encode($n['nombre_novedad']);?></a>
			</div>
		</div>
								</td>
							</tr>
                            <?php
													  
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div><!--/row-->
            
</div><!--/#content.span10-->