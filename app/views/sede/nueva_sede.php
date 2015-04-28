<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH;?>index">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH;?>index/nueva_sede">Nueva Sede</a>
					</li>
				</ul>
			</div>
			<?php 
			$respuesta = isset($_SESSION['respuesta']) ? $_SESSION['respuesta'] : "";
			echo $respuesta; ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Guardar Nueva Sede</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                            
						<form class="form-horizontal" method="post" action="<?php echo HTML_PATH;?>index/guardar_sede" enctype="multipart/form-data">
						  <fieldset>
                            <div class="control-group">
                            <label class="control-label" for="ubicacion_sede">Escoja Ubicación</label>
								<div class="controls">
								  <select id="ubicacion_sede"  name="ubicacion_sede" data-rel="chosen">
									<option value="Lima">Lima</option>
									<option value="Provincia">Provincia</option>
								  </select>
								</div>
							  </div>
                              
                            <div class="control-group">
                            <label class="control-label" for="tipo_sede">Escoja Tipo de Sede</label>
								<div class="controls">
								  <select id="tipo_sede" name="id_tipo_sede" data-rel="chosen">
                                  <?php
								  foreach ($tipos_sede as $ts)
								  	{
										echo "<option value=\"".$ts['id_tipo_sede']."\">".$ts['nombre_tipo_sede']."</option>";
									}
								  ?>
								  </select>
								</div>
							  </div> 
                           
                           <div class="control-group">
								<label class="control-label" for="tipo_preparacion">Preparación para:</label>
								<div class="controls">
								  <select id="tipo_preparacion" name="tipo_preparacion[]" multiple data-rel="chosen">
                                  <?php
								  foreach ($tipos_preparacion as $tp){
									  echo "<option value=\"".$tp['id_tipopreparacion_sede']."\">".$tp['nombre_tipopreparacion_sede']."</option>";
								  }
								  ?>
								  </select>
								</div>
							  </div>
                                 
							<div class="control-group">
							  <label class="control-label" for="nombre_sede">Nombre de la Sede * </label>
							  <div class="controls">
								<input type="text" class="span5" id="nombre_sede" name="nombre_sede" >
							  </div>
							</div>
                            

							<div class="control-group">
							  <label class="control-label" for="direccion_sede">Dirección de la Sede</label>
							  <div class="controls">
								<input type="text" class="span5" id="direccion_sede" name="direccion_sede" >
							  </div>
							</div>
                            
 							<div class="control-group">
							  <label class="control-label" for="telefono_sede">Teléfono de la Sede</label>
							  <div class="controls">
								<input type="text" class="span5" id="telefono_sede" name="telefono_sede" >
							  </div>
							</div>                           
        
							<div class="control-group">
							  <label class="control-label" for="html_sede">HTML de la sede</label>
							  <div class="controls">
								<textarea class="cleditor" name="html_sede" id="html_sede" rows="3"></textarea>
							  </div>
							</div>
                            <div id="map_canvas" style="width:640px; height:250px; position:relative; left:2.3%;"></div>
                            <br />
                             <div class="control-group">     
                                 <label class="control-label" for="latbox">Latitud:</label>
                                
                                <div class="controls">
                                         <input class="disabled" size="20" type="text" id="latbox" name="lat"  placeholder="-12.07713366461836"  >
                                 </div>
                              </div>
                              
                               <div class="control-group">     
                                 <label class="control-label" for="lngbox">Longitud:</label>
                                   <div class="controls">
                                 <input class="disabled" size="20" type="text" id="lngbox" name="lng"  placeholder="-77.035826199913">
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
                           
							  <button type="submit" class="btn btn-primary" id="guardarnoticia">Guardar Nueva Sede</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
                

			</div><!--/row-->
<?php $_SESSION['respuesta'] = ""; ?>