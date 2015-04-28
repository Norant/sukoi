<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
                     <li>
						<a href="<?php echo HTML_PATH_ADMIN;?>lineas">Líneas</a> <span class="divider">/</span></b>
					</li>
					<li>
						Editar Línea <b><?php echo $linea->nombre_linea;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Editando Línea <b><?php echo $linea->nombre_linea;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="editline">
            <input type="hidden" name="id_linea" id="id_linea" value="<?php echo $linea->id_linea;?>"
				<fieldset>
                    <div class="control-group">
                      <label class="control-label" for="nombre_linea">Nombre de la Línea: * </label>
                      <div class="controls">
                        <input type="text" id="nombre_linea" name="nombre_linea" class="span6" value="<?php echo $linea->nombre_linea;?>">
                      </div>
                    </div>   
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."lineas/".$linea->imagen_linea;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" /> 
                    <input type="hidden" value="<?php echo $linea->imagen_linea; ?>" name="hidden_imagen_linea" id="hidden_imagen_linea" />                 
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la línea: *</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen_linea" name="imagen_linea" type="file">
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Detalle de la línea:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="detalle_linea" name="detalle_linea" rows="3"> <?php echo $linea->detalle_linea;?></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="published_linea" name="published_linea" <?php if ($linea->published_linea == "1"){ echo "checked=\"checked\"";}else if($linea->published_linea == "0"){}?> />
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Actualizar línea" />
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