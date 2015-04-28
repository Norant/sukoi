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
						Editar Marca <b><?php echo $marca->nombre_marca;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Editando Marca <b><?php echo $marca->nombre_marca;?></b></h2>
                <a class="btn btn-info" style="float:right; margin-right:120px;" href="<?php echo HTML_PATH_ADMIN;?>ver_galeria?id_marca=<?php echo $marca->id_marca;?>">
										<i class="icon-edit icon-white"></i>  
										Editar Galería                                            
									</a>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="editbrand">
            <input type="hidden" name="id_marca" id="id_marca" value="<?php echo $marca->id_marca;?>" />
				<fieldset>
                	 <div class="control-group">
                        <label class="control-label" for="linea"> <b>Línea:  *</b></label>
                        <div class="controls">
                          <select id="id_linea" name="id_linea" data-rel="chosen">
                            <?php
							foreach ($lineas as $l){
								if (($marca->id_linea) == ($l['id_linea'])){
									echo "<option value=\"".$l['id_linea']."\" selected>".$l['nombre_linea']."</option>";
									} else {
								echo "<option value=\"".$l['id_linea']."\">".$l['nombre_linea']."</option>";
									}
								}
							?>
                          </select>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label" for="tipo_producto"><b>Típo de producto: *</b></label>
                        <div class="controls">
                          <select id="tipo_producto" name="id_tipo_producto" data-rel="chosen">
                           	<option></option>
                           <?php
							foreach ($tipos_producto as $tp){
								if($marca->id_tipo_producto == $tp['id_tipo_producto']){
								echo "<option value=\"".$tp['id_tipo_producto']."\" selected>".$tp['nombre_tipo_producto']."</option>";
								} else {
									echo "<option value=\"".$tp['id_tipo_producto']."\">".$tp['nombre_tipo_producto']."</option>";
									}
								}
							?>
                          </select>
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label" for="nombre_marca"><b>Nombre de la marca:*</b> </label>
                      <div class="controls">
                        <input type="text" id="nombre_marca" name="nombre_marca" class="span6" value="<?php echo $marca->nombre_marca;?>">
                      </div>
                    </div>   
                    <div class="control-group">
                      <label class="control-label" for="nick_marca">Enunciado de la marca: </label>
                      <div class="controls">
                        <input type="text" id="nick_marca" name="nick_marca" class="span6" value="<?php echo $marca->nick_marca;?>">
                      </div>
                    </div> 
                      <div class="control-group">
                      <label class="control-label" for="prefijo_marca">Prefijo de la marca: </label>
                      <div class="controls">
                        <input type="text" id="prefijo_marca" name="prefijo_marca" class="span6" value="<?php echo $marca->prefijo_marca;?>">
                      </div>
                    </div>  
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."lineas/marcas/".$marca->imagen_marca;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" /> 
                    <input type="hidden" value="<?php echo $marca->imagen_marca; ?>" name="hidden_imagen_marca" id="hidden_imagen_marca" />                 
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la marca: </label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen_marca" name="imagen_marca" type="file">
                        <br /><span><!--Ancho: 330 px, Alto: 300 px--></span>
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Descripción de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="descripcion_marca" name="descripcion_marca" rows="3"> <?php echo $marca->descripcion_marca;?></textarea><b>Este campo de descripción se usará para SEO, Google solo usa de 150 a 155 caracteres, así que conviene afinar la cantidad.</b>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="caracteristica_marca">Carácteristica de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="caracteristica_marca" name="caracteristica_marca" rows="3"> <?php echo $marca->caracteristica_marca;?></textarea>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="recomendaciones_marca">Recomendaciones de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="recomendaciones_marca" name="recomendaciones_marca" rows="3"> <?php echo $marca->recomendaciones_marca;?></textarea>
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="comoaplicar_marca">Como aplicar de la marca:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="comoaplicar_marca" name="comoaplicar_marca" rows="3"> <?php echo $marca->comoaplicar_marca;?></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pdf">Ficha Técnica:<br />Formato PDF <img src="<?php echo HTML_PATH_IMAGES;?>pdf.jpg" width="25" height="25"  /></label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf" name="pdf" type="file"><span class="textpdf"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="deletefile" id="deletefile" /> Eliminar -><a id="showlinkpdf" target="_blank" href="<?php echo HTML_PATH_STATIC;?>pdf/<?php echo $marca->pdf_marca;?>"> <?php echo $marca->pdf_marca;?></a> </span> 
                        <input type="hidden" value="<?php echo $marca->pdf_marca; ?>" name="hidden_pdf" id="hidden_pdf" />
                       
                      </div>
					</div> 
                      <div class="control-group">
                      <label class="control-label" for="pdf">Hoja de Seguridad:<br />Formato PDF <img src="<?php echo HTML_PATH_IMAGES;?>pdf.jpg" width="25" height="25"  /></label>
                      <div class="controls">
                        <input class="input-file uniform_on" id="pdf2" name="pdf2" type="file"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="deletefile2" id="deletefile2" /> Eliminar -><span class="textpdf"> <a id="showlinkpdf2" target="_blank" href="<?php echo HTML_PATH_STATIC;?>pdf/<?php echo $marca->pdf2_marca;?>"><?php echo $marca->pdf2_marca;?></a></span>
                        <input type="hidden" value="<?php echo $marca->pdf2_marca; ?>" name="hidden_pdf2" id="hidden_pdf2" />
                      </div>
					</div> 
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="published_marca" name="published_marca" <?php if ($marca->published_marca == "1"){ echo "checked=\"checked\"";}else if($marca->published_marca == "0"){}?> />
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Actualizar marca" />
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