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
						Ver Línea <b><?php echo $linea->nombre_linea;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Viendo Línea <b><?php echo $linea->nombre_linea;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post">
				<fieldset>
                    <div class="control-group">
                      <label class="control-label" for="nombre_linea">Nombre de la línea: </label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo $linea->nombre_linea;?></span>
                      </div>
                    </div>     
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."lineas/".$linea->imagen_linea;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />               
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la Línea: </label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo "static/images/lineas/".$linea->imagen_linea;?></span>
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Detalle de la línea:</label>
                      <div class="controls">
                        <span style="border:1px solid #eeeeee; padding:7px;"> <?php echo $linea->detalle_linea;?></span>
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <?php if ($linea->published_linea == "1"){ echo "<span class=\"label label-success\">Publicada</span>";}else if($linea->published_linea == "0"){echo "<span class=\"label label-important\">No publicada</span>";}?>
                           
                          </label>
                        </div>
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