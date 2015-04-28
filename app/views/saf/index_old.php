	<script type="text/javascript" src="<?php echo HTML_PATH_STATIC;?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo HTML_PATH_STATIC;?>ckfinder/ckfinder.js"></script>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Añadir artículo</h1></div>


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
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Categoría:</th>
		<td>	
		<select  class="styledselect_pages" name="categoria">
			<option value="">---</option>
			<option value="1">Noticia</option>
			<option value="2">tip</option>
		</select>
		</td>
		<td></td>
		</tr>
		<tr>
			<th valign="top">Título:</th>
			<td><input type="text" class="inp-form" /></td>
			<td></td>
		</tr>
	<tr>
		<th valign="top">Description:</th>
		<td><textarea id="editor_kama" name="editor_kama" rows="10" class="form-textarea"></textarea></td>
		<td></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" value="" class="form-submit" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
	</table>
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
var editor = CKEDITOR.replace( 'editor_kama',
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