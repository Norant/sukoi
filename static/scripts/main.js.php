<?php
include('../../configs/web.config.php');
$http_url = parse_url("http://".$_SERVER['HTTP_HOST'].":".$_SERVER['REQUEST_URI']);
 $http_server = $http_url['scheme'] . '://' . $http_url['host'].$_SERVER['REQUEST_URI'];
	// Check URL ( This below url is just for demo. You need to replace it by your full url of index page before testing )
	if (($http_server==HTML_PATH_JS."main.js.php")) {
		header('Content-Type: text/javascript');
?>
<!--<script>-->
jQuery.fn.extend({
    hoversiblings: function () {
	this.each( function(){
		$(this).hover(
			function (){
				$(this).siblings().stop().fadeTo(300, 0.7);
						},
			function (){
				$(this).siblings().stop().fadeTo(300, 1);
					   });
		});
		return this;
    }		
});
function resizelements(){
var heightwindow = $(window).height();
var container = $('#container').height()+80;
/*if (heightwindow > container){
$('#container').css('height', heightwindow+'px');
$('#subdown').css('height', heightwindow+'px');
} */
}
/*$(document).on('propertychange keyup input paste', 'input.search', function(){
    var io = $(this).val().length ? 1 : 0 ;
    $(this).next('.icon_clear').stop().fadeTo(300,io);
}).on('click', '.icon_clear', function() {

    $(this).delay(300).fadeTo(300,0).prev('input').val('');	
});*/
	
$(window).resize(function() {
resizelements();
$('#ulmenumovil').slideUp('fast');
});
$(window).load(function() {
resizelements();
});
///////////////ready/////////////////////
$(document).ready( function(){			
	  var column_height = $("body").height();
      //  column_height = column_height + "px";
      //  $("#container").css("height",column_height);

		resizelements();	
	$('#container').stop(true).fadeIn(900);	//mostramos la web
	$('#menu2').click ( function(){
		 $('#ulmenumovil').slideToggle('fast', function() {
    // Animation complete.
  });	
		});
		
$('html.lt-ie9').each( function() {
	$('.showbiz li').find('.sb-icon-link').hide();
$('.showbiz li').hover ( function(){
	$(this).find('.sb-icon-link').show().css({'cursor':'pointer'});
	$(this).find('.hovercover').css({'background-color':'#000'});
	$(this).find('.hovercover').fadeTo('slow', '0.5');
	}, function (){
	$(this).find('.sb-icon-link').hide();
	$(this).find('.hovercover').css({'background-color':'transparent'});
	});
});		
	/*$('#menu2').hover( function (){
		$(this).find('ul').css({'display':'block'});
		}, function (){
		$(this).find('ul').css({'display':'none'});
		});*/
		$('#inside article').hoversiblings();
	////////////////BUSCADOR////////////
$("#searchbox").Watermark("Buscar");
$('.search').keypress(function(e){
   // if ( e.which == 13 ) return false;
    //or...
    if ( e.which == 13 ){ 
	//$('#result li.selected').find('a').attr('href','');
	e.preventDefault(); return false;}
});

$(".search").keyup(function(e){
var searchbox = $(this).val();
var key = (e.keyCode ? e.keyCode : e.which);
 if (key == 13) {
		var href = $('#result li.selected').find('a').attr('href');	  
	    if(href != "") {
		    window.location.href=href;			
					   }
  				 }
if (key == 27) { $("#display").fadeOut(); }				 
var dataString = 'searchword='+ searchbox;
//$('#result li.selected').keyup(function(e) {
 //					 if (e.keyCode == 13) { alert('o0'); }     // enter
					//  if (e.keyCode == 27) { $('.cancel').click(); }   // esc
	//					});	
if(searchbox=='')
{
	$("#display").fadeOut();
}
else
{
	if (key != 40 && key != 38) {
		$.ajax({
		type: "POST",
		url: "<?php echo HTML_PATH;?>buscador/search",
		data: dataString,
		cache: false,
		success: function(html)
{
$("#display").html(html).show();	
	}
});
   } else {
			$('#result li').mouseover(function(){
				$('#result li').siblings().removeClass('selected');
				$(this).addClass('selected');
				});
	  
            if ($('#result li').hasClass("selected")) {
                var sel = $("#result li.selected");
                sel.removeClass('selected');
                // check if this is a last element in the list
                // if so then add selected class to the first element in the list
				
                if (key == 40) {
                    if (sel.next().length == 0) {
                        $("#result li:first").addClass("selected");
						 
                    } else {
                        sel.next().addClass('selected');						
                        // remove class selected from previous item										
                    }
                } else {
                    if (sel.prev().length == 0) {
                        $("#result li:last").addClass("selected");
                    } else {
                        sel.prev().addClass('selected');
                        // remove class selected from previous item
                    }
                }
            } else {
                $("#result li:first").addClass("selected");
            }
        }			 		
}return false;    
});
	///////////////END BUSCADOR//////////
$("label").inFieldLabels();
	
	//$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

/*if (!Modernizr.canvas) {
    //alert("No canvas here");
  }
  "use strict";
*/
    // Detecting IE
    var oldIE;
    if ($('html').is('.lt-ie9')) {
        oldIE = true;
    }
    if (oldIE) {
       // alert('ie 8 detected');
    }
	

  
 jQuery.fn.extend({
        showcontent: function () {
            this.each(function () {
				var effect = "clip";             
                var options = {
                    direction: 'vertical'
                };
               $(':animated', $(this).parent()).stop(true, true);			   
                if ($(this).is(':visible')) {
                    $(this).siblings('li').hide();
                } else {
                    $(this).siblings('li').hide();
                    if (!$(this).is(":animated")) {
                        $(this).toggle(effect, options, 400);
                    }
                }
            });
            return this;
        }
    });

    $("#team1").addClass('tab_over');
	
    $("#team1").click(function (e) {
        e.preventDefault();
        $(this).addClass('tab_over').siblings().removeClass('tab_over');
        $('#c1').showcontent();
        return false;
    });
    $("#team2").click(function (e) {
        e.preventDefault();
        $(this).addClass('tab_over').siblings().removeClass('tab_over');
        $('#c2').showcontent();
        return false;
    });
	
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
//end panel

//MENU
$('#menu li').hover(
  function(){
   //convert current height to negative value
   
   //$(a).clone().appendTo($(this).parent());
   
var a = $(this).find("a:first");
 // TweenMax.from(a, 1, {rotation:"-170_short", ease:Power2.easeOut});  
   },    
   function () {
var a = $(this).find("a:first");
   //reset the top position
// TweenMax.from(a, 1, {rotation:"170_short", ease:Power2.easeOut}); 
   }
  );
// END MENU		
		
//	mark menu
var box1 = $("#clip1");
clipTween1 = TweenLite.from(box1, 0.2, {clip:"rect(50px 50px 50px 130px)",opacity:1, paused:true});
box1.parent().mouseenter(function() {
    clipTween1.play();   
    });  
box1.parent().mouseleave(function() {
    clipTween1.reverse();
});

var box2 = $("#clip2");
clipTween2 = TweenLite.from(box2, 0.2, {clip:"rect(50px 50px 50px 130px)",opacity:1, paused:true});
box2.parent().mouseenter(function() {
    clipTween2.play();   
    });  
box2.parent().mouseleave(function() {
    clipTween2.reverse();
});

var box3 = $("#clip3");
clipTween3 = TweenLite.from(box3, 0.2, {clip:"rect(50px 50px 50px 130px)",opacity:1, paused:true});
box3.parent().mouseenter(function() {
    clipTween3.play();   
    });  
box3.parent().mouseleave(function() {
    clipTween3.reverse();
});

var box4 = $("#clip4");
clipTween4 = TweenLite.from(box4, 0.2, {clip:"rect(50px 100px 50px 0px)",opacity:1, paused:true});
box4.parent().mouseenter(function() {
    clipTween4.play();   
    });  
box4.parent().mouseleave(function() {
    clipTween4.reverse();
});

var box5 = $("#clip5");
clipTween5 = TweenLite.from(box5, 0.2, {clip:"rect(0px 100px 100px 100px)",opacity:1, paused:true});
box5.parent().mouseenter(function() {
    clipTween5.play();   
    });  
box5.parent().mouseleave(function() {
    clipTween5.reverse();
});

var box6 = $("#clip6");
clipTween6 = TweenLite.from(box6, 0.2, {clip:"rect(50px 100px 50px 0px)",opacity:1, paused:true});
box6.parent().mouseenter(function() {
    clipTween6.play();   
    });  
box6.parent().mouseleave(function() {
    clipTween6.reverse();
});

	
$('.mark-menu li a .image').hover( function(){	
	var tlx = new TimelineLite();
	tlx.to($('#inside-mark-menu1'), 1, {scale:1.5, autoAlpha:1,	ease:Elastic.easeOutBack});
	}, function(){
	var tlx = new TimelineLite();
	tlx.to($('#inside-mark-menu1'), 0.2, {scale:1, autoAlpha:1});
	}	
	);
// end mark menu	
// JCARROUSEL
//$('#sliderclientes').css('display','block');
//$('#sliderclientes').jcarousel({	auto: 4,	visible: 5,	scroll: 1,	wrap: 'circular'    });	
//END JCARROUSEL
//carrousel cslider	
			//	$('#da-slider').cslider({
			//		autoplay	: true,
			//		bgincrement	: 450
			//	});	
//carrousel cslider	
//carrousel carouFredSel
/*		
				$('#foo2').carouFredSel({
					responsive: true,
					width   : "100%",
					scroll      : 5,
				items       : {
				visible     : 1,
				width       : 200
    }

				});
				*/
//end carrousel carouFredSel
//$('.bxslider').bxSlider({  });
	 //subir página
	var height_container = $('#container').outerHeight(true);
	var height_screen = $(window).height()-800;
	$(window).scroll(function () 
	{		
		if($(window).scrollTop() > height_screen)
			{				
		     	$("#subir").fadeIn("slow");			
			 } 
		else {
		    	$("#subir").fadeOut("slow");
			 }
	 });			
		$('#subir').click(function()
			{
        		$('html, body').animate({scrollTop:0}, 1000);
       	 		return false;
   		 	});
			
			//////////////////////////////CONTACTENOS
			// insert help message into form
	$('.default').each(function(){
    var defaultVal = $(this).attr('title');
    $(this).focus(function(){
      if ($(this).val() == defaultVal){
        $(this).removeClass('active').val('');
      }
    })
    .blur(function(){
      if ($(this).val() == ''){
        $(this).addClass('active').val(defaultVal);
      }
    })
    .blur().addClass('active');
  });
  
$("#correo,#pass").keydown(function (e) {
	e.stopPropagation();
	var code = e.keyCode || e.which; 	 
   if(code === 13) {
     $('#enter_client').trigger('click');
   }
});
  
  //VALIDACION DEL CLIENTE
  	var tlc = new TimelineMax({repeat:3, yoyo:true, paused:true, repeatDelay:1});
	var enter_client = $('#enter_client');
	tlc.from(enter_client,0.1,{left:'-5px'}).from(enter_client,0.1,{right:'-10px'});
    $('#response_client').hide();
    $('#enter_client, .iniciar_sesion').click(function(e){
		e.stopPropagation();
        //Hide the reponse from last time
        $('#response_client').hide();
        var formInputs = new Array();
        $('#client_access input').each(function(){
            //Remove any previously set errors
            $(this).removeClass('error');
            //Create a temp object that holds the input data
			if ($(this).attr('id') == 'pass')
			{
				var token = $('#access_token').val();
				var shapass = SHA1($(this).val());
				var access_token = SHA1(shapass+token);
				$(this).val(access_token);
			}
            var obj = {
                'value': $(this).val(),
                'id': $(this).attr('id')
            };
            //Add the object to the array
            formInputs.push(obj); 
        });
		
        $.ajax({
            url: '<?php echo HTML_PATH; ?>form/client_access/',
            type: 'POST',
            data: {'inputs': formInputs},
            success: function(data) {
                //Check to see if the validation was successful
                if (data.success) {
                    //Turn the response alert into a success alert
                    $('#response_client').addClass('alert-success');
                    $('#response_client').removeClass('alert-error');
                    //Add the success message text into the alert
                   // 
				   //var tl = new TimelineLite();
				   var inner_session = $('#inner_session');
				   var correo = $('#correo');
				   var pass = $('#pass');
				   var enter_client = $('#enter_client');
				   var iniciar_sesion = $('.iniciar_sesion');
				   var cerrar_sesion = $('.cerrar_sesion');
				   enter_client.fadeOut();
				   correo.fadeOut();
				   pass.fadeOut();
				   iniciar_sesion.fadeOut();
				   cerrar_sesion.fadeIn();				   
				   /*tl.to(inner_session,1,{autoAlpha:0, height:0},"inner")
				  .to(enter_client,0.5,{autoAlpha:0, height:0},"-=0.8")
				  .to(iniciar_sesion,0.1,{autoAlpha:0, height:0},"-=1")
				  .to(cerrar_sesion,0.1,{autoAlpha:1, width:"100%"},"-=1");*/
				  $('#response_client').html("<i class='icon-ok'>Bienvenido, "+data.razonsocial_cliente+"</i> ").fadeIn();
				   //alert('aqui debe haber efecto de ocultar los inputs y mostrar info del cliente y cerrar sesión');
					//window.location.href = data.url;
                } else {
					$('#access_token').attr('value', data.errors.token);
					  if(tlc.progress() != 1){
						tlc.play();
					  } else {
						tlc.restart();
					  }
					$('#pass').val('');
					
                    //There were some errors
					$('.default').each(function(){
					if ($(this).val() == ''){
						 var defaultVal = $(this).attr('title');
						$(this).addClass('active').val(defaultVal);
					  }
					});
                    //Turn the response alert into an error alert			
                    $('#response_client').removeClass('alert-success');
                    $('#response_client').addClass('alert-error');
                    //Create a message and a HTML list to display in the response alert
                    var list = "<p><i class='icon-remove-sign'></i> Ocurrierón los siguientes errores: </p><ul>";
                    //Loop through each error message and add it to the list
                    $.each(data.errors, function(){
                        $('#' + this.field).addClass('error');
                        list += "<li>- " + this.msg + "</li>";
                    });
                    list += "</ul>";
                    //Add the HTML to the response alert and fade it in
                   // $('#response_client').html(list).fadeIn();
                }
            }
        });
    });
  
  // FIN DE VALIDACION DEL CLIENTE
  
  //LOGOUT DE CLIENTE
  $('#logout').click( function(e){
	  e.preventDefault();
	    $.post("<?php echo HTML_PATH;?>logout", function(d){
            if(d.logout){
				   var inner_session = $('#inner_session');
				   var correo = $('#correo');
				   var pass = $('#pass');
				   var enter_client = $('#enter_client');
				   var iniciar_sesion = $('.iniciar_sesion');
				   var cerrar_sesion = $('.cerrar_sesion');
				   var client_access = $('#client_access');
				   var texto_cliente_access = $('#texto_cliente_access');
				   var response_client = $('#response_client');
				    $('#texto_cliente_access').hide(); 
					$('.icon-ok').hide();
				   correo.val('');
				   correo.trigger('blur');
				   pass.val('');
				   pass.trigger('blur');
				   setTimeout(function(){  correo.focus(); }, 1); 
				  response_client.fadeOut();
				  
				   
				    cerrar_sesion.fadeOut();
					client_access.fadeIn();
				    enter_client.fadeIn();
				    correo.fadeIn();
				    pass.fadeIn();				  
				    iniciar_sesion.fadeIn();
					
				 
                 //window.location.href = '<?php echo $_SESSION['url_actual']; ?>';
            }
		});
	  });
  // FIN DE LOGOUT DE CLIENTE
  
	//Hide the error/success message response on load
    $('#response').hide();
    $('.submit-btn').click(function(e){
		e.preventDefault();
		$('.default').each(function(){
      var defaultVal = $(this).attr('title');
      if ($(this).val() == defaultVal){
        $(this).val('');
    	  }
   	 });
        //Hide the reponse from last time
        $('#response').hide();
        var formInputs = new Array();
        $('#commentForm input, #commentForm textarea').each(function(){
            //Remove any previously set errors
            $(this).removeClass('error');
            //Create a temp object that holds the input data
            var obj = {
                'value': $(this).val(),
                'id': $(this).attr('id')
            };
            //Add the object to the array
            formInputs.push(obj); 
        });
        $.ajax({
            url: 'contactenos/proceso/',
            type: 'POST',
			cache:false,
            data: {'inputs': formInputs},
            success: function(data) {
                //Check to see if the validation was successful
                if (data.success) {
                    //Turn the response alert into a success alert
                    $('#response').addClass('alert-success');
                    $('#response').removeClass('alert-error');
					$('#commentForm input, #commentForm textarea').each(function(){
						 $(this).removeClass('error');
						 $(this).val('');
					});
                    //Add the success message text into the alert
                    $('#response').html("<i class='icon-ok'></i> Sus datos han sido enviados!<br />Pronto nos pondremos en contacto con usted.").fadeIn();
                } else {
                    //There were some errors
					$('.default').each(function(){
					if ($(this).val() == ''){
						 var defaultVal = $(this).attr('title');
						$(this).addClass('active').val(defaultVal);
					  }
					});
                    //Turn the response alert into an error alert
					if ($('#commentForm textarea').val().length < 10){ $('#commentForm textarea').addClass('error');}					
                    $('#response').removeClass('alert-success');
                    $('#response').addClass('alert-error');
                    //Create a message and a HTML list to display in the response alert
                    var list = "<p><i class='icon-remove-sign'></i> Ocurrierón los siguientes errores: </p><ul>";
                    //Loop through each error message and add it to the list
                    $.each(data.errors, function(){
                        $('#' + this.field).addClass('error');
                        list += "<li>- " + this.msg + "</li>";
                    });
                    list += "</ul>";
                    //Add the HTML to the response alert and fade it in
                    $('#response').html(list).fadeIn();
                }
            }
        });
    });
	// END CONTACTENOS
	
	/******************FILTERABLE ITEMS ***************************************/
	/* $('.filters.demo1').filters();
	
	$('.filters.demo2').filters({
		css3: {
			init: false
		},
		move: {
			easing: 'easeOutBack',
			duration: 400
		},
		fade: {
			duration: [400, 400]
		}
	});
	
	$('.filters.demo3').filters({
		move: {
			init: false
		},
		css3: {
			init: false
		},
		fade: {
			opacity: [.1, 1]
		}
	});
	
	$('.filters.demo4').filters({
		css3: {
			transform: {
				scale: '0',
				rotate: '-90deg',
				skew: '45deg'
			}
		}
	});*/
	$('.filters.demo1').filters({
		css3: {
			init: false
		},
		move: {
			easing: 'easeOutBack',
			duration: 400
		},
		fade: {
			duration: [400, 400]
		}
	});
$(".filter a.active").trigger('click');
	
	/************************* END FILTERABLE ITEMS *********************************/	
	
	/********************ZOOM*******************************/
	$('a.zoom').easyZoom();
	/*********************END ZOOM ****************************/
	/*********************EATABS***************************/
	 $('#tab-container').easytabs();
	 /***************END EATABS******************************/
	 /******MENU DE NOTICIAS********************************/
jQuery('#example2').showbizpro({
dragAndScroll:"off",
visibleElementsArray:[5,4,3,1],
carousel:"on",
heightOffsetBottom:10,
mediaMaxHeight:[150,150,150,150],
entrySizeOffset:0,
allEntryAtOnce:"off",
speed:500,
autoPlay:"on",
rewindFromEnd:"on",
delay:8000
});
 
$('.bottom-session').click ( function(){ 

});

// THE FANCYBOX PLUGIN INITALISATION
jQuery(".fancybox").fancybox();
	 /***************END MENU DE NOTICIAS*****************/	 			
});
		
// Llamado cuando se cargue la página
posMenu();
$(window).scroll(function() { 
   posMenu();
});	
function posMenu() {
    var height_header = $('#cabecera').outerHeight(true)-50;
    var height_menu = $('ul#menu').outerHeight(true);
	var pos = $(window).scrollTop();		
    if (pos >= height_header){				
		$('ul#menu').addClass('menu_fixed').delay(300).animate({"opacity": 1 },1000,'easeOutElastic');
		$('#logo_menu').css({'display':'inline-block','margin-top':'-5px'});
		$('#logo_inicio').css({'display':'none'});
		$('.dropdown_3columns').addClass('volx3');
		$('.dropdown_2columns').addClass('volx2');
		$('.dropdown_5columns').addClass('volx5');
		$('.content').css('margin-top', (height_menu) + 'px');					      
    } else {		
		$('ul#menu').removeClass('menu_fixed');
		$('#logo_menu').css('display','none');
		$('#logo_inicio').css('display','block');
		$('.dropdown_3columns').removeClass('volx3');
		$('.dropdown_5columns').removeClass('volx5');
		$('.dropdown_2columns').removeClass('volx2');
		$('.content').css('margin-top', '0');		               
   	 }
	}	
	//slider clientes
 /*TweenLite.from('#logo', .7, {scale:0.5, autoAlpha:0});
TweenLite.to('#menu', 2, { scale:1, marginTop:-25, ease:Bounce.easeOut});
TweenMax.staggerFrom('#menu li', 0.5,{scale:0, autoAlpha:0}, 0.2);*/
$( function(){	
var tl = new TimelineLite(); 
tl.to("#alfa",2,{height:0, autoAlpha:0},2)
.to($("#beta"), 1, { opacity:1});
$('#foo2 li').hoversiblings();
});
<!--</script>-->
<?php }
// If strange domain
else { ?>
    Lo sentimos señor Leecher. Pero no puedes piratear nuestros scripts  <a href="http://www.anypsa.com.pe">anypsa.com.pe</a> @_@;<br />
<?php } ?>