<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
                    <li>
						<a href="<?php echo HTML_PATH_ADMIN;?>marcas">Marcas</a> <span class="divider">/</span></b>
					</li>
					<li>
						Galería de Marca <b><?php echo utf8_encode($marca->nombre_marca);?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Galería de la Marca <b><?php echo utf8_encode($marca->nombre_marca);?></b> </h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="guardar_nueva_galeria">
            
            <input type="hidden" name="id_marca" id="id_marca" value="<?php echo $marca->id_marca;?>" />
				<fieldset>
                	 <div class="control-group">
                        <label class="control-label" for="titulo_galeria"> Título de la Imágen *</label>
                        <div class="controls">
                          <input type="text" id="titulo_galeria" name="titulo_galeria" class="span6">
                        </div>
                      </div>
                     
                    <div class="control-group">
                      <label class="control-label" for="texto_galeria">Texto de la imágen:</label>
                     <div class="controls">
                        <textarea id="texto_galeria" name="texto_galeria" rows="6"></textarea>
                      </div>
                    </div>
                    <img id="imgmarcathumb" src="" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />                  
                    <div class="control-group">
                      <label class="control-label" for="thumbimagen">Nueva Imágen Thumb de la Galería: *</label>
                      <div class="controls">
                        <input  onchange="readURL2(this);" class="input-file uniform_on" id="thumbimagen" name="thumbimagen" type="file"><br /><span>Ancho:506 px, Alto:319 px, Sólo .jpg, .gif o .png</span>
                      </div>
					</div>   
                     <img id="imgmarca" src="" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />                  
                    <div class="control-group">
                      <label class="control-label" for="imagen">Nueva Imágen de la Galería: *</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen" name="imagen" type="file"><br /><span>Ancho:405 px, Alto:255 px, Sólo .jpg, .gif o .png</span>
                      </div>
					</div>

                      
                       <div class="control-group">
                        <label class="control-label" for="linea"> Color Principal:  *</label>
                        <div class="controls">
                          <select id="id_color1_galeria" name="id_color1_galeria" data-rel="chosen">
                          <option></option>
                            <?php
							foreach ($colores as $c){
							echo "<option value=\"".$c['id_producto']."\">".$c['nombre_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                      
                       <div class="control-group">
                        <label class="control-label" for="linea"> Color 2:  *</label>
                        <div class="controls">
                          <select id="id_color2_galeria" name="id_color2_galeria" data-rel="chosen">
                          <option></option>
                            <?php
							foreach ($colores as $c){
							echo "<option value=\"".$c['id_producto']."\">".$c['nombre_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                      
                       <div class="control-group">
                        <label class="control-label" for="linea"> Color 3:  *</label>
                        <div class="controls">
                          <select id="id_color3_galeria" name="id_color3_galeria" data-rel="chosen">
                          <option></option>
                            <?php
							foreach ($colores as $c){
							echo "<option value=\"".$c['id_producto']."\">".$c['nombre_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                      
                        <div class="control-group">
                        <label class="control-label" for="linea"> Color 4:  *</label>
                        <div class="controls">
                          <select id="id_color4_galeria" name="id_color4_galeria" data-rel="chosen">
                          <option></option>
                            <?php
							foreach ($colores as $c){
							echo "<option value=\"".$c['id_producto']."\">".$c['nombre_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                      
                        <div class="control-group">
                        <label class="control-label" for="linea"> Color 5:  *</label>
                        <div class="controls">
                          <select id="id_color5_galeria" name="id_color5_galeria" data-rel="chosen">
                          <option></option>
                            <?php
							foreach ($colores as $c){
							echo "<option value=\"".$c['id_producto']."\">".$c['nombre_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                      
                       <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="published_galeria" name="published_galeria" />
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                      
                     <div class="control-group">
                     <div class="controls">
                        <input type="submit" class="btn btn-primary" value="Guardar nuevo elemento de galería de <?php echo utf8_encode($marca->nombre_marca);?>" />
                      </div> 
                      </div>                  
                </fieldset> 
            </form>
           <?php $_SESSION['respuesta'] = "" ;
		   if ($galeria){
			   ?>
               <hr  />
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                              	  <th>Posición</th>
								  <th>Título</th>								  
								  <th>Imágen</th>
								  <th>Texto de la imágen</th>
                                  <th>Eliminar</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php 
						  foreach ($galeria as $g){
						  ?>
                          <tr>
                          <td width="67"><a class="upgaleriaaction" title="<?php echo $g['id_galeria_marca']?>"></a> <a title="<?php echo $g['id_galeria_marca']?>" class="downgaleriaaction"></a></td>
                          <td><?php echo $g['titulo_galeria']; ?></td><td><img width="80" src="<?php echo HTML_PATH_IMAGES; ?>lineas/marcas/galerias/<?php echo $g['imagen_galeria'];?>" /></td><td><?php echo $g['texto_galeria'];?></td><td><a class="btn btn-danger btn-delete" title="<?php echo $g['id_galeria_marca'];?>" href="#">
										<i class="icon-trash icon-white"></i> 
										Eliminar
									</a><div class="modal hide fade <?php echo $g['id_galeria_marca'];?>" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar Imágen de Galería de <?php echo $marca->nombre_marca;?></h3>
			</div>
			<div class="modal-body">
				<p>Esta por eliminar este elemento, recuerde que esto no es reversible.</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="<?php echo HTML_PATH_ADMIN;?>eliminar_elementogaleria_marca?id_galeria=<?php echo $g['id_galeria_marca'];?>" class="btn btn-primary">Eliminar imágen <?php echo $g['nombre_galeria'];?></a>
			</div>
		</div></td></tr>
                          <?php } ?>
                          </tbody>
                          </table>
               <?php
		   } else {
			   echo "No hay imágenes de galería para esta marca.";
			   }
		   ?>
            </div><!--/box-content-->
            </div><!--/span-->
            
            </div><!--/row-->
            
</div><!--/#content.span10-->
<script>
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgmarca').attr('src', e.target.result);
				
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                   
					 $('#imgmarcathumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }		
</script>	