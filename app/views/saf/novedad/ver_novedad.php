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
						Ver Novedad <b><?php echo $novedad->nombre_novedad;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Viendo Novedad <b><?php echo $novedad->nombre_novedad;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post">
				<fieldset>
                    <div class="control-group">
                      <label class="control-label" for="nombre_novedad">Nombre de la novedad: </label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo $novedad->nombre_novedad;?></span>
                      </div>
                    </div>     
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."novedades/".$novedad->imagen_novedad;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" />               
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la Novedad: </label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo "static/images/novedades/".$novedad->imagen_novedad;?></span>
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Detalle de la novedad:</label>
                      <div class="controls">
                        <span style="border:1px solid #eeeeee; padding:7px;"> <?php echo $novedad->detalle_novedad;?></span>
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <?php if ($novedad->published_novedad == "1"){ echo "<span class=\"label label-success\">Publicada</span>";}else if($novedad->published_novedad == "0"){echo "<span class=\"label label-important\">No publicada</span>";}?>
                           
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