<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
                     <li>
						<a href="<?php echo HTML_PATH_ADMIN;?>novedades">Novedades</a> <span class="divider">/</span></b>
					</li>
					<li>
						Editar Novedad <b><?php echo $novedad->nombre_novedad;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Editando Novedad <b><?php echo $novedad->nombre_novedad;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="editnovelty">
            <input type="hidden" name="id_novedad" id="id_novedad" value="<?php echo $novedad->id_novedad;?>"
				<fieldset>
                    <div class="control-group">
                      <label class="control-label" for="nombre_novedad">Nombre de la Novedad: * </label>
                      <div class="controls">
                        <input type="text" id="nombre_novedad" name="nombre_novedad" class="span6" value="<?php echo $novedad->nombre_novedad;?>">
                      </div>
                    </div>   
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."novedades/".$novedad->imagen_novedad;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" /> 
                    <input type="hidden" value="<?php echo $novedad->imagen_novedad; ?>" name="hidden_imagen_novedad" id="hidden_imagen_novedad" />                 
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la Novedad: *</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen_novedad" name="imagen_novedad" type="file">
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="detalle_novedad">Detalle de la Novedad:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="detalle_novedad" name="detalle_novedad" rows="3"> <?php echo $novedad->detalle_novedad;?></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="published_novedad" name="published_novedad" <?php if ($novedad->published_novedad == "1"){ echo "checked=\"checked\"";}else if($novedad->published_novedad == "0"){}?> />
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Actualizar Novedad" />
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
