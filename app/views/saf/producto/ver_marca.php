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
						Ver Marca <b><?php echo $marca->nombre_marca;?></b>
					</li>
				</ul>
			</div>
            <div id="mensaje"> </div>
            <div class="row-fluid sortable">
            <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-inbox"></i> Viendo Marca <b><?php echo $marca->nombre_marca;?></b></h2>
            </div>
            <div class="box-content">
            <?php echo $_SESSION['respuesta']; ?>
            <form class="form-horizontal" method="post">
            <input type="hidden" name="id_marca" id="id_marca" value="<?php echo $marca->id_marca;?>"
				<fieldset>
                	 <div class="control-group">
                        <label class="control-label" for="linea"> Línea </label>
                        <div class="controls">
                          <?php
							foreach ($lineas as $l){
								if (($marca->id_linea) == ($l['id_linea'])){
									echo "<span class=\"input-xlarge uneditable-input\">".$l['nombre_linea']."</span>";
									}
								}
							?>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label" for="tipo_producto">Típo de producto</label>
                        <div class="controls">
                           <?php
							foreach ($tipos_producto as $tp){
								if($marca->id_tipo_producto == $tp['id_tipo_producto']){
								echo "<span class=\"input-xlarge uneditable-input\">".$tp['nombre_tipo_producto']."</span>";
								}
								}
							?>
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label" for="nombre_marca">Nombre de la marca:</label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo $marca->nombre_marca;?></span>
                      </div>
                    </div>   
                    <div class="control-group">
                      <label class="control-label" for="nick_marca">Nick de la marca: </label>
                      <div class="controls">
                        <span class="input-xlarge uneditable-input"><?php echo $marca->nick_marca;?></span>
                      </div>
                    </div>  
                    <img id="imgmarca" src="<?php echo HTML_PATH_IMAGES."lineas/marcas/".$marca->imagen_marca;?>" width="100" height="100" style=" float:right; margin-top:-50px; margin-right:100px;" /> 
                    <input type="hidden" value="<?php echo $marca->imagen_marca; ?>" name="hidden_imagen_marca" id="hidden_imagen_marca" />                 
                    <div class="control-group">
                      <label class="control-label" for="imagen">Imágen de la marca: </label>
                      <div class="controls">
                       <span class="input-xlarge uneditable-input"><?php echo "static/images/lineas/marcas/".$marca->imagen_marca;?></span>
                      </div>
					</div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Descripción de la marca:</label>
                      <div class="controls">
                        <span style="border:1px solid #eeeeee; padding:7px;"> <?php echo $marca->descripcion_marca;?></span>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="pdf">PDF de la marca:</label>
                      <div class="controls">
                      <?php if ($marca->pdf_marca != ""){?>
                       <a target="_blank" href="<?php echo HTML_PATH_STATIC;?>pdf/<?php echo $marca->pdf_marca;?>"><?php echo $marca->pdf_marca." <img src=\"".HTML_PATH_IMAGES."pdf.jpg\" width=\"40\" />";?></a></span>
                        <?php } ?>
                      </div>
					</div> 
                    <div class="control-group">
                        <label class="control-label" for="publicar">Publicar</label>
                        <div class="controls">
                          <label class="checkbox">
                            <?php if ($marca->published_marca == "1"){ echo "<span class=\"label label-success\">Publicada</span>";}else if($marca->published_marca == "0"){echo "<span class=\"label label-important\">No publicada</span>";}?>
                           
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