		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
			<!-- content ends -->
			</div><!--/#content.span10-->
		<?php } ?>
		</div><!--/fluid-row-->
		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
		
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://anypsa.com.pe" target="_blank">Anypsa</a> <?php echo date('Y') ?></p>
			<p class="pull-right">Powered by: <a href="http://anypsa.com.pe">Anypsa</a></p>
		</footer>
		<?php } ?>

	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo HTML_PATH_JS_ADMIN;?>fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo HTML_PATH_JS_ADMIN;?>jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>excanvas.js"></script>
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.flot.min.js"></script>
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.flot.pie.min.js"></script>
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.flot.stack.js"></script>
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>jquery.history.js"></script>
    
   
	<!-- application script for Charisma demo -->
	<script src="<?php echo HTML_PATH_JS_ADMIN;?>charisma.js"></script>
    
    <script src="<?php echo HTML_PATH_JS_ADMIN;?>destroy_session.js.php"></script>
    <script type="text/javascript" src="<?php echo HTML_PATH_STATIC_ADMIN;?>ckeditor/ckeditor.js"></script>
        <script>
$(window).load(function() {
  $('img').each(function() {
    if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
      // image was broken, replace with your new image
      this.src = '<?php echo HTML_PATH_IMAGES;?>no-imagen.jpg';
    }
  });
});
	</script>
</body>
</html>
