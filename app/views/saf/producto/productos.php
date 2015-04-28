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
						<a href="<?php echo HTML_PATH_ADMIN;?>marcas">Productos</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> <?php echo $_SESSION['respuesta']; ?></div>
            
            
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Colores Decorlast</h2>
                <div class="box-icon">
                    <a href="#" class="colapsador btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
                <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>                            	 
								  <th>Nombre del Color</th>
                                  <th>Color</th>
                                  <th>Familia de Color</th>
                                  <th>Marca</th>								  								  
								  <th>Status</th>                                 
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($coloresdecorlast as $p)
						  { 
						  if ($p['published_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							  } 
						  else if($p['published_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                                <td><?php echo $p['nombre_producto']; ?></td> 
                                <td class="center"><div style="background-color:<?php echo $p['tonalidad1_producto']; ?>; width:60px; height:23px;"></div></td>
                                <td class="center"><?php 
								$safModel = new SafModel();
								$familiacolor = $safModel->getFamiliaColorProductoForId($p['id_familiacolorproducto']);
								echo utf8_encode($familiacolor); ?></td>
                                <td class="center"><?php
								$safModel = new SafModel();
								$marca = $safModel->getBrandForId($p['id_marca']);
								echo $marca->nombre_marca;                              
								?>
                                </td>								
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $p['id_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $p['id_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar producto <?php echo $p['nombre_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Eliminando <b><?php echo $p['nombre_producto'];?></b></p>
			</div>
			<div class="modal-footer">	
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_producto?id_producto=<?php echo $p['id_producto'];?>" class="btn btn-primary">Eliminar producto <?php echo $p['nombre_producto'];?></a>
			</div>
		</div>
								</td>
                          <td width="67"><a class="upactionproducto" title="<?php echo $p['id_producto']?>"></a> <a title="<?php echo $p['id_producto']?>" class="downactionproducto"></a></td>
								     
							</tr>
                            <?php													  
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div>
            <!---------------------------------------------------------------------------------------------------------------------- -->
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Colores Satinado</h2>
                <div class="box-icon">
                    <a href="#" class="colapsador btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>                            	 
								  <th>Nombre del Color</th>
                                  <th>Color</th>
                                  <th>Familia de Color</th>
                                  <th>Marca</th>								  								  
								  <th>Status</th>                                 
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($coloressatinado as $p)
						  { 
						  if ($p['published_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							  } 
						  else if($p['published_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                                <td><?php echo $p['nombre_producto']; ?></td> 
                                <td class="center"><div style="background-color:<?php echo $p['tonalidad1_producto']; ?>; width:60px; height:23px;"></div></td>
                                <td class="center"><?php 
								$safModel = new SafModel();
								$familiacolor = $safModel->getFamiliaColorProductoForId($p['id_familiacolorproducto']);
								echo utf8_encode($familiacolor); ?></td>
                                <td class="center"><?php
								$safModel = new SafModel();
								$marca = $safModel->getBrandForId($p['id_marca']);
								echo $marca->nombre_marca;                              
								?>
                                </td>								
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $p['id_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $p['id_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar producto <?php echo $p['nombre_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Eliminando <b><?php echo $p['nombre_producto'];?></b></p>
			</div>
			<div class="modal-footer">	
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_producto?id_producto=<?php echo $p['id_producto'];?>" class="btn btn-primary">Eliminar producto <?php echo $p['nombre_producto'];?></a>
			</div>
		</div>
								</td>
                          <td width="67"><a class="upactionproducto" title="<?php echo $p['id_producto']?>"></a> <a title="<?php echo $p['id_producto']?>" class="downactionproducto"></a></td>
								     
							</tr>
                            <?php													  
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div>
            
             <!---------------------------------------------------------------------------------------------------------------------- -->
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Colores Duracolor</h2>
                <div class="box-icon">
                    <a href="#" class="colapsador btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>                            	 
								  <th>Nombre del Color</th>
                                  <th>Color</th>
                                  <th>Familia de Color</th>
                                  <th>Marca</th>								  								  
								  <th>Status</th>                                 
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($coloresduracolor as $p)
						  { 
						  if ($p['published_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							  } 
						  else if($p['published_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                                <td><?php echo $p['nombre_producto']; ?></td> 
                                <td class="center"><div style="background-color:<?php echo $p['tonalidad1_producto']; ?>; width:60px; height:23px;"></div></td>
                                <td class="center"><?php 
								$safModel = new SafModel();
								$familiacolor = $safModel->getFamiliaColorProductoForId($p['id_familiacolorproducto']);
								echo utf8_encode($familiacolor); ?></td>
                                <td class="center"><?php
								$safModel = new SafModel();
								$marca = $safModel->getBrandForId($p['id_marca']);
								echo $marca->nombre_marca;                              
								?>
                                </td>								
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $p['id_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $p['id_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar producto <?php echo $p['nombre_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Eliminando <b><?php echo $p['nombre_producto'];?></b></p>
			</div>
			<div class="modal-footer">	
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_producto?id_producto=<?php echo $p['id_producto'];?>" class="btn btn-primary">Eliminar producto <?php echo $p['nombre_producto'];?></a>
			</div>
		</div>
								</td>
                          <td width="67"><a class="upactionproducto" title="<?php echo $p['id_producto']?>"></a> <a title="<?php echo $p['id_producto']?>" class="downactionproducto"></a></td>
								     
							</tr>
                            <?php													  
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div>
            
             <!---------------------------------------------------------------------------------------------------------------------- -->
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Colores Látex Superior Maestro</h2>
                <div class="box-icon">
                    <a href="#" class="colapsador btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>                            	 
								  <th>Nombre del Color</th>
                                  <th>Color</th>
                                  <th>Familia de Color</th>
                                  <th>Marca</th>								  								  
								  <th>Status</th>                                 
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($coloresmaestro as $p)
						  { 
						  if ($p['published_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							  } 
						  else if($p['published_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                                <td><?php echo $p['nombre_producto']; ?></td> 
                                <td class="center"><div style="background-color:<?php echo $p['tonalidad1_producto']; ?>; width:60px; height:23px;"></div></td>
                                <td class="center"><?php 
								$safModel = new SafModel();
								$familiacolor = $safModel->getFamiliaColorProductoForId($p['id_familiacolorproducto']);
								echo utf8_encode($familiacolor); ?></td>
                                <td class="center"><?php
								$safModel = new SafModel();
								$marca = $safModel->getBrandForId($p['id_marca']);
								echo $marca->nombre_marca;                              
								?>
                                </td>								
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $p['id_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $p['id_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar producto <?php echo $p['nombre_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Eliminando <b><?php echo $p['nombre_producto'];?></b></p>
			</div>
			<div class="modal-footer">	
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_producto?id_producto=<?php echo $p['id_producto'];?>" class="btn btn-primary">Eliminar producto <?php echo $p['nombre_producto'];?></a>
			</div>
		</div>
								</td>
                          <td width="67"><a class="upactionproducto" title="<?php echo $p['id_producto']?>"></a> <a title="<?php echo $p['id_producto']?>" class="downactionproducto"></a></td>
								     
							</tr>
                            <?php													  
						  }
							?>
                       </tbody>
                 </table>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div>
            
            <!----------------------------------------------------------------------------------------------------------------------- -->
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Todos los colores</h2>
                <div class="box-icon">
                    <a href="#" class="colapsador btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>                            	 
								  <th>Nombre del color</th>
                                  <th>Color</th>
                                  <th>Familia de Color</th>
                                  <th>Marca</th>								  								  
								  <th>Status</th>                                 
								  <th>Acciones</th>
                                  <th>Posición</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
						  foreach ($productos as $p)
						  { 
						  if ($p['published_producto'] == "1"){ 
						 	 $span_published = "<span class=\"label label-success\">Publicado</span>";
							  } 
						  else if($p['published_producto'] == "0"){ 
							  $span_published = "<span class=\"label label-important\">No publicado</span>";
							  }
						  ?>
							<tr>
                                <td><?php echo $p['nombre_producto']; ?></td> 
                                <td class="center"><div style="background-color:<?php echo $p['tonalidad1_producto']; ?>; width:60px; height:23px;"></div></td>
                                <td class="center"><?php 
								$safModel = new SafModel();
								$familiacolor = $safModel->getFamiliaColorProductoForId($p['id_familiacolorproducto']);
								echo utf8_encode($familiacolor); ?></td>
                                <td class="center"><?php
								$safModel = new SafModel();
								$marca = $safModel->getBrandForId($p['id_marca']);
								echo $marca->nombre_marca;                              
								?>
                                </td>								
								<td class="center">
									<?php echo $span_published;?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo HTML_PATH_ADMIN;?>ver_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-zoom-in icon-white"></i>  
										Ver                                         
									</a>
									<a class="btn btn-info" href="<?php echo HTML_PATH_ADMIN;?>editar_producto?id_producto=<?php echo $p['id_producto'];?>">
										<i class="icon-edit icon-white"></i>  
										Editar                                            
									</a>
									<a class="btn btn-danger btn-delete" title="<?php echo $p['id_producto'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a>
   <div class="modal hide fade <?php echo $p['id_producto'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar producto <?php echo $p['nombre_producto'];?></h3>
			</div>
			<div class="modal-body">
				<p>Eliminando <b><?php echo $p['nombre_producto'];?></b></p>
			</div>
			<div class="modal-footer">	
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_producto?id_producto=<?php echo $p['id_producto'];?>" class="btn btn-primary">Eliminar producto <?php echo $p['nombre_producto'];?></a>
			</div>
		</div>
								</td>
                          <td width="67"><a class="upactionproducto" title="<?php echo $p['id_producto']?>"></a> <a title="<?php echo $p['id_producto']?>" class="downactionproducto"></a></td>
								     
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
<?php $_SESSION['respuesta'] = ""; ?>
