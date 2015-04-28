<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>nueva_marca">Nueva Marca</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Ingresar Nueva Marca</h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta'] ;?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="guardar_nueva_marca">
				<fieldset>
                	 <div class="control-group">
                        <label class="control-label" for="linea"><b>Seleccione Línea  *</b></label>
                        <div class="controls">
                          <select id="id_linea" name="id_linea" data-rel="chosen">
                           	<option></option>
                            <?php
							foreach ($lineas as $l){
								echo "<option value=\"".$l['id_linea']."\">".$l['nombre_linea']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label" for="tipo_producto"><b>Seleccione Típo de producto *</b></label>
                        <div class="controls">
                          <select id="tipo_producto" name="id_tipo_producto" data-rel="chosen">
                           	<option></option>
                           <?php
							foreach ($tipos_producto as $tp){
								echo "<option value=\"".$tp['id_tipo_producto']."\">".$tp['nombre_tipo_producto']."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label" for="nombre_marca"><b>Nombre de la marca: *</b></label>
                      <div class="controls">
                        <input type="text" id="nombre_marca" name="nombre_marca" class="span6">
                      </div>
                    </div>   
                    <div class="control-group">
                      <label class="control-label" for="nick_marca">Enunciado de la marca: </label>
                      <div class="controls">
                        <input type="text" id="nick_marca" name="nick_marca" class="span6">
                      </div>
                    </div> 
                   <div class="control-group">
                      <label class="control-label" for="prefijo_marca">Prefijo de la marca: </label>
                      <div class="controls">
                        <input type="text" id="prefijo_marca" name="prefijo_marca" class="span6"><span>ejemplo: (ST, DL, DC, LSM, agregue el que será de está marca.)</span>
                      </div>
                    </div>  
                    <img id="imgmarca" src="" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />                  
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la marca: </label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen" name="imagen" type="file"><br /><span><!--Ancho: 330 px, Alto: 300 px-->Sólo .jpg, .gif o .png</span>
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Descripción de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="descripcion_marca" name="descripcion_marca" rows="3"></textarea>
                      </div>
                    </div>
                                          <div class="control-group">
                      <label class="control-label" for="caracteristica_marca">Carácteristica de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="caracteristica_marca" name="caracteristica_marca" rows="3"></textarea>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="recomendaciones_marca">Recomendaciones de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="recomendaciones_marca" name="recomendaciones_marca" rows="3"></textarea>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="comoaplicar_marca">Como aplicar de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="comoaplicar_marca" name="comoaplicar_marca" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pdf">Ficha Técnica:<br />Formato PDF <img src="<?php echo HTML_PATH_IMAGES;?>pdf.jpg" width="25" height="25"  /></label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf" name="pdf" type="file">
                      </div>
					</div> 
                   <div class="control-group">
                      <label class="control-label" for="pdf2">Ficha de Seguridad:<br />Formato PDF <img src="<?php echo HTML_PATH_IMAGES;?>pdf.jpg" width="25" height="25"  /></label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf2" name="pdf2" type="file">
                      </div>
					</div> 
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="publicar" name="publicar" value="option1">
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Guardar marca" />
                        <button class="btn">Cancelar</button>
                      </div>                         
                </fieldset>
            </form>
           <?php $_SESSION['respuesta'] = "" ;?>
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
</script>	