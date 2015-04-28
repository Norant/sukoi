<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH;?>index">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH;?>index/nueva_noticia">Nueva Noticia</a>
					</li>
				</ul>
			</div>
			<?php 
			$respuesta = isset($_SESSION['respuesta']) ? $_SESSION['respuesta'] : "";
			echo $respuesta; ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Guardar Nueva Noticia</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="<?php echo HTML_PATH;?>index/guardar_noticia" enctype="multipart/form-data">
						  <fieldset>
                            <div class="control-group">
								<label class="control-label" for="selectError">Escoja sede *</label>
								<div class="controls">
								  <select name="sede" id="sede" data-rel="chosen" data-placeholder="Escoge el colegio o academia">
                                  <option value="1">Central</option>
                                  <optgroup label="Colegios Lima">
                                  <?php foreach($colegioslima as $cl)
								  {
									  echo "<option value=\"".$cl['id_sede']."\">".utf8_encode($cl['nombre_sede'])."</option>";
									  }
								  ?>
                                  </optgroup>
                                   <optgroup label="Academias">
                                    <?php foreach($academiaslima as $al)
								  {
									  echo "<option value=\"".$al['id_sede']."\">".utf8_encode($al['nombre_sede'])."</option>";
									  }
								  ?>
                                   </optgroup>
                                    <optgroup label="Colegios Provincia">
                                    <?php foreach($colegiosprovincia as $cp)
								  		{
									  echo "<option value=\"".$cp['id_sede']."\">".utf8_encode($cp['nombre_sede'])."</option>";
									  }
								  ?>
                                   </optgroup>
								  </select>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="titulo_noticia">Título de la Noticia *</label>
							  <div class="controls">
								<input type="text" class="span5" id="titulo_noticia" name="titulo_noticia" >
							  </div>
							</div>
                            
                            <div class="control-group">
							  <label class="control-label" for="sinopsis_noticia">Sinopsis de la Noticia *</label>
							  <div class="controls">
								<input type="text" class="span5" id="sinopsis_noticia" name="sinopsis_noticia" >
							  </div>
							</div>
                            
                           <div class="control-group">
							  <label class="control-label" for="imagen_noticia">Imágen de la Noticia</label>
							  <div class="controls">
                              <input class="input-file uniform_on" id="imagen_noticia" name="imagen_noticia" type="file">
								
                                <p>Seleccione la imágen que subio al servidor estático en la carpeta: <b>/web/noticias/fotos-noticias/</b></p><a title="" id="checkfileinremoteserver" href="#">Verificar imágen subida</a><div id="file_message"></div>
							  </div>
							</div>
                            
                            <div class="control-group">
							  <label class="control-label" for="video_noticia">Código Youtube de la noticia</label>
							  <div class="controls">
                              <input type="text" class="span5" id="video_noticia" name="video_noticia">
							  </div>
                              <div style="display:none;" id="msgyt" class="alert span5">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span id="mensaje-vyt"></span>
                              </div>
							</div>
        
							<div class="control-group">
							  <label class="control-label" for="html_noticia">HTML de la noticia</label>
							  <div class="controls">
								<textarea class="cleditor" name="html_noticia" id="html_noticia" rows="6" cols="8"></textarea>
							  </div>
							</div>
                            
                            <div class="control-group">
							  <label class="control-label" for="linkevento_noticia">Link de Fotos de Evento </label>
							  <div class="controls">
								<input type="text" class="span5" id="linkevento_noticia" name="linkevento_noticia" >
							  </div>
							</div>
                             <div class="control-group">
								<label class="control-label" for="published">Publicar </label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="published"  name="published" value="published">
								  </label>
								</div>
							  </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" id="guardarnoticia">Guardar Noticia</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php $_SESSION['respuesta'] = ""; ?>