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
						<a href="<?php echo HTML_PATH_ADMIN;?>marcas">Marcas</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Marcas</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <?php echo $_SESSION['respuesta'] ;?>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                              	  <th>Posición</th>
								  <th>Marca</th>
                                  <th>Imágen</th>
								  <th>Galería</th>								  
								  <th>Status</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($marcas as $m)
						  { 
						  if ($m['published_marca'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicada</span>";
							 } 
						  else if($m['published_marca'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicada</span>";
							  }
						  ?>
							<tr>
                            <td width="67"><a class="upaction" title="<?php echo $m['id_marca']?>"></a> <a title="<?php echo $m['id_marca']?>" class="downaction"></a></td>
								<td><?php echo utf8_encode($m['nombre_marca']); ?></td>
                                <td class="center"><img src="<?php echo HTML_PATH_IMAGES."lineas/marcas/".$m['imagen_marca']; ?>" width="50" /></td>
								<td class="center"><a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_galeria?id_marca=<?php echo $m['id_marca'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Galería                                    
									</a></td>
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_marca?id_marca=<?php echo $m['id_marca'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_marca?id_marca=<?php echo $m['id_marca'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $m['url_marca'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $m['url_marca'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar marca <?php echo $m['url_marca'];?></h3>
			</div>
			<div class="modal-body">
				<p>Los productos de <b><?php echo $m['url_marca'];?></b> también serán eliminados</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_marca?id_marca=<?php echo $m['id_marca'];?>" class="btn btn-primary">Eliminar marca <?php echo $m['nombre_marca'];?></a>
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
<?php $_SESSION['respuesta'] = "";?>