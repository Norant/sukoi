<div id="content" class="span10">
<!-- content starts -->
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo HTML_PATH_ADMIN;?>">Inicio</a> <span class="divider">/</span>
					</li>
                     <li>
						<a href="<?php echo HTML_PATH_ADMIN;?>tipos">Típo de producto</a> <span class="divider">/</span></b>
					</li>
					<li>
						Editar Línea <b><?php echo $tipo_producto->nombre_tipo_producto;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Editando Típo de producto <b><?php echo $tipo_producto->nombre_tipo_producto;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="edittypeproduct">
            <input type="hidden" name="id_tipo_producto" id="id_tipo_producto" value="<?php echo $tipo_producto->id_tipo_producto;?>"
				<fieldset>
                    <div class="control-group">
                      <label class="control-label" for="nombre_tipo_producto">Nombre del Típo de Producto: * </label>
                      <div class="controls">
                        <input type="text" id="nombre_tipo_producto" name="nombre_tipo_producto" class="span6" value="<?php echo $tipo_producto->nombre_tipo_producto;?>">
                      </div>
                    </div>   
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."tipo_producto/".$tipo_producto->imagen_tipo_producto;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" /> 
                    <input type="hidden" value="<?php echo $tipo_producto->imagen_tipo_producto; ?>" name="hidden_imagen_tipo_producto" id="hidden_imagen_tipo_producto" />                 
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen del Típo de producto: *</label>
                      <div class="controls">
                        <input  onchange="readURL(this);" class="input-file uniform_on" id="imagen_tipo_producto" name="imagen_tipo_producto" type="file">
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="descripcion_tipo_producto">Descripción del Típo de producto:</label>
                      <div class="controls">
                        <textarea class="ckeditor" id="descripcion_tipo_producto" name="descripcion_tipo_producto" rows="3"> <?php echo $tipo_producto->descripcion_tipo_producto;?></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="published_tipo_producto">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox" id="published_tipo_producto" name="published_tipo_producto" <?php if ($tipo_producto->published_tipo_producto == "1"){ echo "checked=\"checked\"";}else if($tipo_producto->published_tipo_producto == "0"){}?> />
                           Esto lo mostrará en la web
                          </label>
                        </div>
                      </div>
                        <div class="control-group">
                        (*) campos obligatorios
                      </div>   
                       <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Actualizar Típo de producto" />
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