<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>nuevo_producto">Nuevo Color</a>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Ingresar Nuevo Color</h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta'] ;?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="guardar_nuevo_producto">
				<fieldset>
                       <div class="control-group">
                        <label class="control-label" for="id_marca">Seleccione Marca  *</label>
                        <div class="controls">
                          <select id="id_marca" name="id_marca" data-rel="chosen">
                           	<option></option>
                            <?php
							foreach ($marcas as $m){
								echo "<option data-prefijo=\"". $m['prefijo_marca']."\" value=\"".$m['id_marca']."\">".utf8_encode($m['nombre_marca'])."</option>";
								}
							?>
                          </select>
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label" for="nombre_producto">Nombre del Color: * </label>
                      <div class="controls">
                        <input type="text" id="nombre_producto" name="nombre_producto" class="span6"><span>ejemplo: (Gris Polar)</span>
                      </div>
                    </div>   
                    <div class="control-group">
                      <label class="control-label" for="codigo_producto">Código del Color: * </label>
                      <div class="controls">
                        <span id="textcodebrand" style="display:inline-block; vertical-align:middle; font-weight:bold;"></span> <input style="display:inline-block;  vertical-align:top; width:100px;" type="text" id="codigo_producto" name="codigo_producto" class="span6"> <span> <br />ejemplo: (1257, 3547, agregue el que será de este producto.)</span>
                      </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="id_familiacolorproducto">Seleccione Familia del Color *</label>
                        <div class="controls">
                          <select id="id_familiacolorproducto" name="id_familiacolorproducto" data-rel="chosen">
                           	<option></option>
                           <?php
							foreach ($colores as $co){
								echo "<option value=\"".$co['id_familiacolorproducto']."\">".utf8_encode($co['nombre_familiacolorproducto'])."</option>";
								}
							?>
                          </select><span> <br />ejemplo: (cálido, frío  o neutro, agregue el que será de este Color.)</span>
                        </div>
                      </div>  
                      <div class="control-group">
                        <label class="control-label" for="id_gamacolorproducto">Seleccione Grupo del Color *</label>
                        <div class="controls">
                          <select id="id_gamacolorproducto" name="id_gamacolorproducto" data-rel="chosen">
                           	<option></option>
                           <?php
							foreach ($gammas as $ga){
								echo "<option value=\"".$ga['id_gamacolorproducto']."\">".utf8_encode($ga['nombre_gamacolorproducto'])."</option>";
								}
							?>
                          </select><span> <br />ejemplo: (blanco, azúl, rojo, agregue el que será de este Color.)</span>
                        </div>
                      </div>   
                    <div class="control-group">
                      <label class="control-label" for="tonalidad1_producto">Tonalidad 1 : *</label>
                      <div class="controls">
                        <input type="text" id="tonalidad1_producto" name="tonalidad1_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7"> &nbsp;&nbsp;&nbsp;<div id="ton1" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px;"></div>
                      </div>
                    </div>  
                   <div class="control-group">
                      <label class="control-label" for="tonalidad2_producto">Tonalidad 2 :<br /> (1 color + 1 blanco) </label>
                      <div class="controls">
                        <input type="text" id="tonalidad2_producto" name="tonalidad2_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7"> &nbsp;&nbsp;&nbsp;<div id="ton2" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px;"></div>
                      </div>
                    </div>  
                    <div class="control-group">
                      <label class="control-label" for="tonalidad3_producto">Tonalidad 3 :<br /> (1 color + 4 blanco) </label>
                      <div class="controls">
                        <input type="text" id="tonalidad3_producto" name="tonalidad3_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7"> &nbsp;&nbsp;&nbsp;<div id="ton3" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px;"></div>
                      </div>
                    </div>   
                    <img id="imgmarca" src="" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />                  
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen del Color:</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen" name="imagen" type="file">
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Descripción del Color:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pdf">PDF del Color:</label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf" name="pdf" type="file">
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
                        <input type="submit" class="btn btn-primary" value="Guardar Color" />
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
function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgmarca').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>	