	<script type="text/javascript" src="<?php echo HTML_PATH_STATIC;?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo HTML_PATH_STATIC;?>ckfinder/ckfinder.js"></script>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">
<?php $name_v = stripslashes(htmlentities($vestido->nombre));?>

<div id="page-heading"><h1>Editar Vestido <?php echo $name_v; ?></h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="<?php echo HTML_PATH_IMAGES;?>shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="<?php echo HTML_PATH_IMAGES;?>shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	  <?php echo $respuesta;?>
		<!-- start id-form -->
        <form enctype="multipart/form-data" method="post" action="<?php echo HTML_PATH; ?>saf/vestido/editar/<?php echo $id; ?>/" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Categoría:</th>
		<td>	
		<select  class="styledselect_pages" name="categoria_id" id="categoria_id">
			 <?php
			foreach ($categoria as $cat)
			{
				if ($vestido->categoria_id == $cat['id']){
					echo utf8_encode("<option value=\"".$cat['id']."\" selected=\"selected\">".$cat['nombre']."</option>");
					}else{
					echo utf8_encode("<option value=\"".$cat['id']."\">".$cat['nombre']."</option>");
					}
			}
			?>
		</select>
        <input type="hidden" name="id"  id="id" value="<?php echo $id; ?>" />
		</td>
		<td></td>
		</tr>
		<tr>
			<th valign="top">Nombre: </th>
			<td><input type="text" class="inp-form" name="nombre" id="nombre" value="<?php echo ($name_v); ?>" /></td>
			<td></td>
		</tr>
	<tr>
    <tr>
			<th valign="top">Colores:</th>
			<td><input type="text" class="inp-form" name="colores" id="colores" value="<?php echo stripslashes(htmlentities(utf8_encode($vestido->colores))); ?>" /></td>
			<td></td>
		</tr>
	<tr>
    <tr>
			<th valign="top">Colección:</th>
			<td><input type="text" class="inp-form" name="coleccion" id="coleccion" value="<?php echo stripslashes(htmlentities(utf8_encode($vestido->coleccion))); ?>" /></td>
			<td></td>
		</tr>
	<tr>
   <th>Imágen:</th>
	<td><input type="file" class="inp-form" name="imagen" id="imagen" />
    <input type="hidden" value="<?php echo $vestido->imagen;?>" name="hidden_imagen" id="hidden_imagen" />
    <input type="hidden" name="id" value="<?php echo $vestido->id; ?>" />
     <div style="position:relative; top:-10px;left:200px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<img src=\"".HTML_PATH_IMAGES."catalogo/ropamaterna/".utf8_encode($vestido->imagen)."\"";?></div></td>
	 <td></td>
     <td>
	</td>
     
	</tr>
    <th>Imágen Grande:</th>
	<td><input type="file" class="inp-form" name="imagen_grande" id="imagen_grande" />
    <input type="hidden" value="<?php echo $vestido->imagen_grande;?>" name="hidden_imagen_grande" id="hidden_imagen_grande" />
    <div style="position:relative; top:-10px; left:200px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<img src=\"".HTML_PATH_IMAGES."catalogo/ropamaterna/".utf8_encode($vestido->imagen_grande)."\" width=\"123\" height=\"143\">";
	?></div>
    </td>
	 <td></td>
     <td>
	</td>
   
	</tr>
    <tr>
			<th valign="top">Precio:</th>
			<td><input type="text" class="inp-form" name="precio" id="precio" value="<?php echo $vestido->precio; ?>" /></td>
			<td></td>
		</tr>
	<tr>
		<th valign="top">Descripción:</th>
		<td><textarea id="descripcion" name="descripcion" rows="10" class="form-textarea"><?php echo htmlentities(utf8_encode($vestido->descripcion)); ?></textarea></td>
		<td></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
        <input type="submit" class="form-submit" value="Guardar" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
	</table>
    </form>
	<!-- end id-form  -->

	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<img src="<?php echo HTML_PATH_IMAGES;?>forms/header_related_act.gif" width="271" height="43" alt="" />
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
			
				<div class="left"><a href=""><img src="<?php echo HTML_PATH_IMAGES;?>forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Add another product</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="<?php echo HTML_PATH_IMAGES;?>forms/icon_minus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Delete products</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="<?php echo HTML_PATH_IMAGES;?>forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Edit categories</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				<div class="clear"></div>
				
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="<?php echo HTML_PATH_IMAGES;?>shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>

<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
<script type="text/javascript">
//<![CDATA[
CKEDITOR.stylesSet.add( 'my_styles',
[
    // Block-level styles
    { name : 'H3', element : 'h3', styles : { 'color' : '#ea7931', 'font-family' : 'Arial,Helvetica,sans-serif', 'font-size' : '13px', 'margin-bottom' : '0em', 'margin-top' : '0em', 'padding-left' : '0px' , 'font-style' : 'normal', 'font-weight' : 'bold' , 'text-decoration' : 'none' } },
    { name : 'H2' , element : 'h2', styles : {  'color' : '#CCCCCC', 'font-family' : 'Arial,Helvetica,sans-serif', 'font-size' : '12px', 'margin-bottom' : '0em', 'margin-top' : '0em', 'padding-left' : '0px' , 'font-style' : 'normal', 'font-weight' : 'bold' , 'text-decoration' : 'none' } }
]);	
var editor = CKEDITOR.replace( 'descripcion',
					{
skin : 'kama',
filebrowserBrowseUrl : '<?php echo HTML_PATH_STATIC; ?>ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo HTML_PATH_STATIC; ?>ckfinder/ckfinder.html?type=Images&currentFolder=/images/',
filebrowserFlashBrowseUrl : '<?php echo HTML_PATH_STATIC; ?>ckfinder/ckfinder.html?type=Flash&currentFolder=/swf/',
filebrowserUploadUrl : 
 	   '<?php echo HTML_PATH_STATIC; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=/files/',
filebrowserImageUploadUrl : 
 	   '<?php echo HTML_PATH_STATIC; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=/images/',
filebrowserFlashUploadUrl : '<?php echo HTML_PATH_STATIC; ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
					});
CKFinder.setupCKEditor( editor, '<?php echo HTML_PATH_STATIC; ?>ckfinder/' );	
			//]]>
			</script>