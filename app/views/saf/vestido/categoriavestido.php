<?php
require(APP_ROOT_MODELS."BuscadorModel.php");
$buscadorModel = new BuscadorModel();
?><div id="content-outer">
<!-- start content -->
<div id="content">
	<div id="page-heading">
		<h1>Categorías de Ropa Materna</h1><br />
	</div>
    <a href="#" id="nuevacategoriaropamaterna">Nueva Categoría de Ropa Materna</a><div id="insertnuevacategoriaropamaterna"></div>
    <?php echo $_SESSION['respuesta']; ?>
    <br /><br />
   <div id="container"></div>
	<div id="loading"></div>
         
        <div id="containerpagina">
                <?php
				
				echo $linkspaginacion;
				?>
</div>

</div></div>
<?php $_SESSION['respuesta'] = "";?>
<script type="text/javascript">
$("#nuevacategoriaropamaterna").click (function(){
	$("#insertnuevacategoriaropamaterna").show();
	$("#insertnuevacategoriaropamaterna").html("<form name='form2' id='form2' method='post' action='<?php echo HTML_PATH;?>saf/insertarNuevaCategoriaRopaMaterna/'><table><tr><td>Nombre</td><td><input type='text' name='nombre' id='nombrenuevacategoria'></td><td><input class='go_button' type='submit' value='Guardar' id='guardarnuevacategoriaropamaterna' ></td></tr></table></form>");
	$("#nombrenuevacategoria").focus();
	return false;
	});

            $(document).ready(function(){
				$("#insertnuevacategoriaropamaterna").hide();				
                function loading_show(){
                    $('#loading').html("<img src='<?php echo HTML_PATH_IMAGES;?>loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();
					//$("#catalogue").fadeOut('fast');                
                    $.ajax
                    ({
                        type: "POST",
                        url: "<?php echo HTML_PATH;?>/saf/load_datacategoriavestido",
						cache: false,
                        data: "page="+page+"&namex=<?php echo $namex;?>",
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
								//$("#catalogue").fadeIn('slow');
				$("#catalogue li a img").css({border:"2px solid #CCC"});
				$("#catalogue li a img").hover( function(){
				$(this).css({border:"2px solid #FE7A25"});
				}, function (){
					$(this).css({border:"2px solid #CCC"});
					});
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
				
				 function loadDatapagina(page){
                    //loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "<?php echo HTML_PATH;?>/saf/load_datapaginacategoriavestido",
						cache: false,
                        data: "page="+page+"&namex=<?php echo $namex;?>",
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                //loading_hide();
                                $("#containerpagina").html(msg);
                            });
                        }
                    });
                }
				var pagina;
				if (pagina == null){pagina = 1;}
				loadDatapagina(pagina);
                $('#containerpagina .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
					loadDatapagina(page);
                    
                });         
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
						loadDatapagina(page);
                    }else{
                        alert('Ingrese una PAGINA entre 1 y '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
			$(window).load( function (){
				$("#catalogue li a img").css({border:"2px solid #CCC"});
				$("#catalogue li a img").hover( function(){
				$(this).css({border:"2px solid #FE7A25"});
				}, function (){
					$(this).css({border:"2px solid #CCC"});
					});
			});
        </script>