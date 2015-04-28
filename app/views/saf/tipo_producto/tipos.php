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
						<a href="<?php echo HTML_PATH_ADMIN;?>tipos">Típos de Producto</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Típos de producto</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                              	  <th>Posición</th>
								  <th>Típo de producto</th>
                                  <th>Imágen</th>
								  <th>Url Típo de producto</th>								  
								  <th>Status</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  if ($tipos){
						  foreach ($tipos as $t)
						  { 
						  if ($t['published_tipo_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							 } 
						  else if($t['published_tipo_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                            <td width="67"><a class="upactiontipoproducto" title="<?php echo $t['id_tipo_producto']?>"></a> <a title="<?php echo $t['id_tipo_producto']?>" class="downactiontipoproducto"></a></td>
								<td><?php echo $t['nombre_tipo_producto']; ?></td>
                                <td class="center"><img src="<?php echo HTML_PATH_IMAGES."tipo_producto/".$t['imagen_tipo_producto']; ?>" width="50" /></td>
								<td class="center"><?php echo $t['url_tipo_producto']; ?></td>
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_tipo_producto?id_tipo_producto=<?php echo $t['id_tipo_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_tipo_producto?id_tipo_producto=<?php echo $t['id_tipo_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $t['id_tipo_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $t['id_tipo_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar  <?php echo $t['nombre_tipo_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Está por eliminar <?php echo $t['nombre_tipo_producto'];?></p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_tipo_producto?id_tipo_producto=<?php echo $t['id_tipo_producto'];?>" class="btn btn-primary">Eliminar Típo de producto <?php echo $t['nombre_tipo_producto'];?></a>
			</div>
		</div>
								</td>
							</tr>
                            <?php						  
						  	}
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div><!--/row-->
            
</div><!--/#content.span10-->