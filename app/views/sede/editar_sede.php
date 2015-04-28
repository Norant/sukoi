<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH;?>index">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH;?>index/sedes">Editar Sede</a>
					</li>
				</ul>
			</div>
			<?php $respuesta = isset($_SESSION['respuesta']) ? $_SESSION['respuesta'] : "";
			echo $respuesta; ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Editando Sede : <b><?php echo $sede->nombre_sede;?></b></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="<?php echo HTML_PATH;?>index/editnovelty" enctype="multipart/form-data">
						  <fieldset>
                          <input type="hidden" name="id_sede" id="id_sede" value="<?php echo $sede->id_sede;?>" />
                            <div class="control-group">
                            <label class="control-label" for="ubicacion_sede">Escoja Ubicación </label>
								<div class="controls">
                               
								  <select id="ubicacion_sede"  name="ubicacion_sede" data-rel="chosen" style="width:150px;">
                                  <?php if ($sede->ubicacion_sede == "Lima"){?>
									<option value="Lima" selected="selected">Lima</option>
                                    <option value="Provincia">Provincia</option>
                                    <?php } 
									if ($sede->ubicacion_sede == "Provincia"){
										?>
                                    <option value="Lima">Lima</option>    
									<option value="Provincia" selected="selected">Provincia</option>
                                     <?php } ?>
								  </select>
								</div>
							  </div>
                              
                           <div class="control-group">
                            <label class="control-label" for="tipo_sede">Escoja Tipo de Sede</label>
								<div class="controls">
								  <select id="tipo_sede" name="id_tipo_sede" data-rel="chosen" style="width:120px">
                                  <?php
								  foreach ($tipos_sede as $ts)
								  	{
										if($ts['id_tipo_sede'] == $sede->id_tipo_sede){
										echo "<option value=\"".$ts['id_tipo_sede']."\" selected>".$ts['nombre_tipo_sede']."</option>";
										} else {echo "<option value=\"".$ts['id_tipo_sede']."\">".$ts['nombre_tipo_sede']."</option>";}
									}
								  ?>
								  </select>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="tipo_preparacion">Preparación para:</label>
								<div class="controls">
								  <select id="tipo_preparacion" name="tipo_preparacion[]" multiple data-rel="chosen" style="width:245px;">
                                  <?php
								  foreach ($tipos_preparacion as $tp){
									  if($tp['id_tipopreparacion_sede'] == $sede->id_tipo_preparacion_sede){
									  	echo "<option value=\"".$tp['id_tipopreparacion_sede']."\" selected>".$tp['nombre_tipopreparacion_sede']."</option>";
									  }else {
									  	  echo "<option value=\"".$tp['id_tipopreparacion_sede']."\">".$tp['nombre_tipopreparacion_sede']."</option>";
								 	 }
								  }
								  ?>
								  </select>
								</div>
							  </div>
                                 
							<div class="control-group">
							  <label class="control-label" for="titulo_noticia">Nombre de la Sede </label>
							  <div class="controls">
								<input type="text" class="span5" id="nombre_sede" name="nombre_sede" value="<?php echo $sede->nombre_sede; ?>">
                                <input type="hidden" name="nombre_sede_hidden" value="<?php echo $sede->nombre_sede; ?>" />
                                <input type="hidden" name="url_sede_hidden" value="<?php echo $sede->url_sede; ?>" />
							  </div>
							</div>
                            

                            
                            <div class="control-group">
							  <label class="control-label" for="direccion_sede">Dirección de la Sede </label>
							  <div class="controls">
								<input type="text" class="span5" id="direccion_sede" name="direccion_sede" value="<?php echo $sede->direccion_sede; ?>">
							  </div>
							</div>
                            	<div class="control-group">
							  <label class="control-label" for="telefono_sede">Teléfono de la Sede</label>
							  <div class="controls">
								<input type="text" class="span5" id="telefono_sede" name="telefono_sede" value="<?php echo $sede->telefono_sede; ?>">
							  </div>
							</div>  
                            <div class="control-group">
							  <label class="control-label" for="html_sede">HTML de la Sede</label>
							  <div class="controls">
								<textarea class="cleditor" name="html_sede" id="html_sede" rows="3"><?php echo $sede->html_sede; ?></textarea>
							  </div>
							</div>
        				   <div class="control-group">
							  <label class="control-label" for="imagen_noticia">Imágen de la Noticia </label>
							  <div class="controls">
                              <input class="input-file uniform_on" id="imagen_noticia" name="imagen_noticia" type="file">
                              <input type="hidden" name="hidden_imagen" id="hidden_imagen" value="<?php echo $noticia->imagen_noticia;?>" />
								<?php 
								$urlDeImagen = STATIC_SERVER."/web/noticias/fotos-noticias/".$noticia->imagen_noticia;
								$verificaimagen = checkFileInRemoteServer($urlDeImagen);
								if ($verificaimagen){
									echo "<img id=\"imagenx\" src=\"".$urlDeImagen."\" width=\"120\">";
									}
								else {
									echo "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />No hay imagen de la noticia en ".$urlDeImagen." 
						</div>";
									}	
								?>
                                <p> </b></p><a style="display:none;" title="" id="checkfileinremoteserver" href="#">Verificar imágen subida</a><div id="file_message"></div>
							  </div>
							</div>
                            
                           <!-- <div class="control-group">
							  <label class="control-label" for="imagen_thumb_noticia">Imágen Thumb(pequeña) de la Noticia </label>
							  <div class="controls">
                              <input class="input-file uniform_on" id="imagen_thumb_noticia" name="imagen_thumb_noticia" type="file">
                              <input type="hidden" name="hidden_imagen_thumb" id="hidden_imagen_thumb" value="<?php echo $noticia->imagen_noticia;?>" />
								
                                <p> <?php
									$urlThumbDeImagen = STATIC_SERVER."/web/noticias/tooltips/".$noticia->imagen_noticia;
								$verificaimagenthumb = checkFileInRemoteServer($urlThumbDeImagen);
								if ($verificaimagenthumb){
									echo "<img id=\"imagenthumb\" src=\"".$urlThumbDeImagen."\" width=\"120\">";
									}
								else {
									echo "<div class=\"alert alert-error\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
							<strong>Error!</strong><br />No hay imagen de la noticia en ".$urlThumbDeImagen." 
						</div>";
									}	
								 ?></p><a style="display:none;" title="" id="checkfilethumbinremoteserver" href="#">Verificar imágen thumb subida</a><div id="file_thumb_message"></div>
							  </div>
							</div> 
                            
                            <div class="span6"><div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Recuerde!</strong> Las imágenes deben tener el mismo nombre.
						</div></div>-->
                        <div class="clearfix"></div>
                          <div class="control-group">
							  <label class="control-label" for="video_noticia">Código Youtube de la noticia</label>
							  <div class="controls">
                              <input type="text" class="span5" id="video_noticia" name="video_noticia" value="<?php echo $noticia->video_noticia;?>">
							  </div>
                              <div style="display:none;" id="msgyt" class="alert span5">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span id="mensaje-vyt"></span>
                              </div>
							</div>
                            
                         
                         	<div class="control-group">
							  <label class="control-label" for="linkevento_noticia">Link de Fotos del evento </label>
							  <div class="controls">
								<input type="text" class="span5" id="linkevento_noticia" name="linkevento_noticia" value="<?php echo $noticia->linkevento_noticia; ?>">
							  </div>
							</div>
                               
                             <div class="control-group">
								<label class="control-label" for="published">Publicar </label>
								<div class="controls">
								  <label class="checkbox inline">
                                  <?php $publicado = (isset($noticia->published) && ($noticia->published != "")) ? "checked" : ""; ?>
									<input type="checkbox" id="published"  name="published" value="published" <?php echo $publicado; ?>>
								  </label>
								</div>
							  </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Editar Noticia</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php $_SESSION['respuesta'] = ""; ?>