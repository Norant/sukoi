<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						Guardar Color
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Guardar Color</h2>
            </div>
            <div class="box-content">
            <?php
				$safModel = new safModel();
				$marca = $safModel->getBrandForId($producto->id_marca);
				$familiacolorproducto = $safModel->getFamiliaColorProductoForId($producto->id_familiacolorproducto);
				echo $_SESSION['respuesta'];
			?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="editproduct">
				<fieldset>
                <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto->id_producto;?>" />
                       <div class="control-group">
                        <label class="control-label" for="id_marca"> Marca *</label>
                        <div class="controls">
                          <select id="id_marca" name="id_marca" data-rel="chosen">
                            <?php
							foreach ($marcas as $m){	
								if ($m['id_marca'] == $marca->id_marca){ echo "<option data-prefijo=\"". $m['prefijo_marca']."\" value=\"".$m['id_marca']."\" selected >".$m['nombre_marca']."</option>";
								}
								else{
									echo "<option data-prefijo=\"". $m['prefijo_marca']."\" value=\"".$m['id_marca']."\">".$m['nombre_marca']."</option>";
									}
							}
							?>
                          </select>
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label" for="nombre_producto">Nombre del Color: * </label>
                      <div class="controls">
                        <input type="text" id="nombre_producto" name="nombre_producto" class="span6" value="<?php echo $producto->nombre_producto;?>"><span>ejemplo: (Gris Polar)</span>
                      </div>
                    </div>   
                    <div class="control-group">
                      <label class="control-label" for="codigo_producto">Código del Color: *</label>
                      <div class="controls">
                        <span id="textcodebrand" style="display:inline-block; vertical-align:middle; font-weight:bold;"></span> <input style="display:inline-block;  vertical-align:top; width:100px;" type="text" id="codigo_producto" name="codigo_producto" class="span6" value="<?php echo $producto->codigo_producto;?>"> <span> <br />ejemplo: (1257, 3547, agregue el que será de este producto.)</span>
                      </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="id_familiacolorproducto">Familia del Color *</label>
                        <div class="controls">
                          <select id="id_familiacolorproducto" name="id_familiacolorproducto" data-rel="chosen">
                          <option value="">Seleccione una familia</option>
                           <?php
							foreach ($familiacolorproductos as $co){
								if ($producto->id_familiacolorproducto == $co['id_familiacolorproducto'])
								{echo "<option value=\"".$co['id_familiacolorproducto']."\" selected>".utf8_encode($co['nombre_familiacolorproducto'])."</option>";}else{
									echo "<option value=\"".$co['id_familiacolorproducto']."\">".utf8_encode($co['nombre_familiacolorproducto'])."</option>";
								}
								}
							?>
                          </select><span> <br />ejemplo: (cálido, frío o neutro, agregue el que será de este producto.)</span>
                        </div>
                      </div>  
                       <div class="control-group">
                        <label class="control-label" for="id_gamacolorproducto">Grupo del color *</label>
                        <div class="controls">
                          <select id="id_gamacolorproducto" name="id_gamacolorproducto" data-rel="chosen">
                           <option value="">Seleccione un grupo</option>
                           <?php
							foreach ($gamacolorproductos as $ga){
								if ($producto->id_gamacolorproducto == $ga['id_gamacolorproducto'])
								{echo "<option value=\"".$ga['id_gamacolorproducto']."\" selected>".utf8_encode($ga['nombre_gamacolorproducto'])."</option>";}else{
									echo "<option value=\"".$ga['id_gamacolorproducto']."\">".utf8_encode($ga['nombre_gamacolorproducto'])."</option>";
								}
								}
							?>
                          </select><span> <br />ejemplo: (blanco, azúl, rojo, agregue el que será de este color.)</span>
                        </div>
                      </div>  
                    <div class="control-group">
                      <label class="control-label" for="tonalidad1_producto">Tonalidad 1 : *</label>
                      <div class="controls">
                        <input type="text" id="tonalidad1_producto" name="tonalidad1_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7" value="<?php echo $producto->tonalidad1_producto;?>"> &nbsp;&nbsp;&nbsp;<div id="ton1" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px; background-color:<?php echo $producto->tonalidad1_producto;?>"></div>
                      </div>
                    </div>  
                   <div class="control-group">
                      <label class="control-label" for="tonalidad2_producto">Tonalidad 2 :<br /> (1 color + 1 blanco) </label>
                      <div class="controls">
                        <input type="hidden" value="<?php echo $producto->tonalidad2_producto; ?>" name="hidden_tonalidad2_producto" id="hidden_tonalidad2_producto" />
                        <input type="text" id="tonalidad2_producto" name="tonalidad2_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7" value="<?php echo $producto->tonalidad2_producto;?>"> &nbsp;&nbsp;&nbsp;<div id="ton2" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px; background-color:<?php echo $producto->tonalidad2_producto;?>""></div>
                      </div>
                    </div>  
                    <div class="control-group">
                      <label class="control-label" for="tonalidad3_producto">Tonalidad 3 :<br /> (1 color + 4 blanco) </label>
                      <div class="controls">
                      	<input type="hidden" value="<?php echo $producto->tonalidad3_producto; ?>" name="hidden_tonalidad3producto" id="hidden_tonalidad3_producto" />
                        <input type="text" id="tonalidad3_producto" name="tonalidad3_producto" class="span6" style="width:65px; display:inline-block;" maxlength="7" value="<?php echo $producto->tonalidad3_producto;?>"> &nbsp;&nbsp;&nbsp;<div id="ton3" style="display:inline-block; vertical-align:bottom; width:130px; height:28px; border:1px solid #999999; border-radius:8px; background-color:<?php echo $producto->tonalidad3_producto;?>""></div>
                      </div>
                    </div>   
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."lineas/marcas/productos/".$producto->imagen_producto;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />
                    <input type="hidden" value="<?php echo $producto->imagen_producto; ?>" name="hidden_imagen_producto" id="hidden_imagen_producto" />                  
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen del Color:</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen" name="imagen" type="file">
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Descripción del Color:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="descripcion_producto" name="descripcion_producto" rows="3"><?php echo $producto->descripcion_producto;?></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pdf">PDF del Color:</label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf" name="pdf" type="file">
                        <input type="hidden" value="<?php echo $producto->pdf_producto; ?>" name="hidden_pdf" id="hidden_pdf" />
                      </div>
					</div> 
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="publicar" name="publicar" value="option1"  <?php if ($producto->published_producto == "1"){ echo "checked=\"checked\"";}else if($marca->published_producto == "0"){}?>>
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Actualizar Color" />
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