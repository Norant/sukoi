	function unloadAllJS() {
	  var jsArray = new Array();
	 	 jsArray = document.getElementsByTagName('script');
	  for (i = 0; i < jsArray.length; i++){
		if (jsArray[i].id){
		  unloadJS(jsArray[i].id)
		}else{
		  jsArray[i].parentNode.removeChild(jsArray[i]);
		}
	  }        
	} 


    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }
	
	function twShare(text, winWidth, winHeight){
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://twitter.com/intent/tweet?source=webclient&text=' + encodeURIComponent(text), 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }

	
	function sleepFor( sleepDuration ){
    var now = new Date().getTime();
    while(new Date().getTime() < now + sleepDuration){ /* do nothing */ } 
}

	function resizelements(){
			var heightwindow = $(window).height();
			var container = $('#container').height()+80;
		
			var w = $(window);
			var ww = w.width();
			if (ww > 1440)
			{$('#container').width(1420);
				//$('.dropdown_2columns').width(1420);
			}
			else if ((ww <= 1440) && (ww > 960))
				{$('#container').width(ww);	}
			else if(ww < 960)
				{$('#container').width(1024);}	
				$('#cabecera').width($('#container').width());	
				$('#cabecera_container').css({'margin':'0 auto'});
			
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

	$("img").error(function () {
	 	 $(this).unbind("error").attr("src", "../../static/images/xxx.jpg");
	});	

	$(window).resize(function(){
		resizelements();
		$('#ulmenumovil').slideUp('fast');
	});

	$(window).load(function() {
		resizelements();
	});

///////////////ready/////////////////////
$(document).ready( function(){	
	resizelements();
	//unloadAllJS();
	//jQuery.getScript('http://erkie.github.com/asteroids.min.js'); 
		//var html_path = 'http://www.anypsa.com.pe/';
		  var html_path = 'http://localhost/anypsa/';
		  var html_path_images = html_path + 'static/images/';
		  var column_height = $("body").height();
		  //  column_height = column_height + "px";
		  //  $("#container").css("height",column_height);
		  
		  var imgsArray = new Array(
				   html_path_images + 'logo.png',
				   html_path_images + 'search2.png',
				   html_path_images + 'home_hover.png',
				   html_path_images + 'home.png',
				   html_path_images + 'banner/control_banner_2.png',
				   html_path_images + 'banner/control_banner.png',
				   html_path_images + 'home/balde_dl.png',
				   html_path_images + 'banner/dl_char.png',
				   html_path_images + 'banner/SGS.png',
				   html_path_images + 'flecha-abajo.png',
				   html_path_images + 'home/flecha_azul.png',
				   html_path_images + 'banner/banx.jpg',
				   html_path_images + 'banner/banner_decorlast.jpg',
				   html_path_images + 'banner/bg_iso.jpg',
				   html_path_images + 'home/hogar.png',
				   html_path_images + 'home/auto.png'
			   );
	
			resizelements();
                        /*******************************/
        var ie_oldies = false;
		var ie = false;
		var ie_version;
		
		if($.browser.msie == true){ 
			ie = true;
			ie_version = parseInt($.browser.version, 10);
			if(ie_version <= 8) ie_oldies = true;
		}        
                        
                         function initLoading(){
							$('#loading_web').css({'display':'block'});
							var percentCounter = 0;
							var flager = 0;
                            $.each(imgsArray, function(index, value) {
							
                                $('<img></img>').attr('src', value )    //load image
                                    .load(function() {
									flager++;
									
                                        percentCounter = Math.ceil((flager / imgsArray.length) * 100);    //set the percentCounter after this image has loaded
                                        $('#progressContainer').html(percentCounter + '%');
                                    });
									
                            });
							
							for(i=0; i<imgsArray.length; i++) 
										{
											chargeImg(imgsArray[i]);
										}
                            
                   if (!ie_oldies){
                        rotateLoadingO();
                                }
                        
                    function rotateLoadingO(){
					// funcion de animación de intro
                    }

                } 
				if (ie_oldies){
				showeb();
				} else {
					if (html_path == document.URL) 
						{
							initLoading();
							} else  {
							showeb();
						}
					}
                /* --------- LOADING --------- */
                /*******************************/
                var nbImgChargees = 0;
                function chargeImg(url){
                    var date = '';
                    if(ie_oldies == true) date = "?"+new Date().getTime();
                    $('<img />').attr('src',url+date).load(function(){
                        nbImgChargees++;

                       if(nbImgChargees == imgsArray.length) {                        
                            showeb();
                        }
                    });
                }
                
            function showeb()
					{	
                  setTimeout(function(){
                        $('#loading_web').css({'display':'none'});
                     }, 10);
					    $('#container').stop(true).fadeIn(900);	//mostramos la web
					  //  clearInterval(intervalLoading);
					  // alert('cargado'); 
				}	
		/* CARGADOR */
		
		
		/* FIN CARGADOR */
		
		
		
		//$('#container').show();
		$('#menu2').click ( function(){
			 $('#ulmenumovil').slideToggle('fast', function() {
		// Animation complete.
	  });	
			});
			/*LAZY LOAD DE IMAGENES*/
			
			 $("img.lazy").lazyload({
				 effect: "fadeIn",
				 threshold : 200
			 }).trigger("lazyload");
			$(window).load(function()
								{
								$("html,body").trigger("scroll");
								});		 
			 /* FIN LAZY LOAD */	 
		
	/* $('#inside article').hover( function(){
			  var h5 = $(this).find('h5');
			  var lazy = $(this).find('.lazy');
			  var tlzz = new TimelineLite();
			 tlzz.to(lazy,0.4,{ scale:1.05, ease:Back.easeInOut});
			 h5.addClass('anytitle');
		 }, function(){
			var h5 = $(this).find('h5');
			var lazy = $(this).find('.lazy');
			var tlzz = new TimelineLite();
			tlzz.to(lazy,0.4,{ scale:1, ease:Back.easeInOut});
			h5.removeClass('anytitle');
		 });
	*/		
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
			//$('#inside article').hoversiblings();
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
				if(typeof href != 'undefined') {
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
			url: html_path + "buscador/search",
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
                
 $('.showproductsalfa li a, #showbrands article center a').hover(
 function() {
    TweenLite.to($(this).find('img'), 0.2, {
      scale: 1.02,
      ease: Expo.easeIn,
        force3D:true
    });
  },
 function() {
    TweenLite.to($(this).find('img'), 0.2, {
      scale: 1,
      ease: Expo.easeOut
    });
  }
);

		$("label.infield").inFieldLabels();
		
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
		$("#team3").click(function (e) {
			e.preventDefault();
			$(this).addClass('tab_over').siblings().removeClass('tab_over');
			$('#c3').showcontent();
			return false;
		});
			$("#team4").click(function (e) {
			e.preventDefault();
			$(this).addClass('tab_over').siblings().removeClass('tab_over');
			$('#c4').showcontent();
			return false;
		});
		
	/**/	
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
		   
			//alert($(this).siblings().html());
				var a = $(this).find("a.active:first");
				a.parent().siblings().find("a.active:first").stop(true,true).addClass('disabledborder');
		
		  // TweenMax.from(a, 1, {rotation:"-170_short", ease:Power2.easeOut});  
		   },    
		   function () {		   
			var a = $(this).find("a.active:first");
			a.parent().siblings().find("a.active:first").stop(true,true).removeClass('disabledborder');
		   //reset the top position
			// TweenMax.from(a, 1, {rotation:"170_short", ease:Power2.easeOut}); 
		   }
		  );
	  
	  
	// END MENU		
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
	//ICONOS SOCIALES
	$('#sociales_anypsa ul li').hover(  function() {
    TweenLite.to($(this).find("img"), 0.5, {scale:1.03, ease:Back.easeOut});
  },
  function() {
    TweenLite.to($(this).find("img"), 0.5, {scale:1, ease:Back.easeOut});  
  }
	);
	
	//FIN ICONOS SOCIALES
	
	  
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
				url: html_path+'form/client_access/',
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
					  $('#response_client').html("<i class='icon-ok'>Bienvenido(a), "+data.razonsocial_cliente+"</i> ").fadeIn();
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
	  //ANIMACION HOME
	  var arrow_home_banner = $('#arrow_gravity');
	  var tm = new TimelineMax({repeat:-1, yoyo:true, paused:true});
		tm.to(arrow_home_banner,1.5,{ autoAlpha:0.7,marginTop:'1px',scale:'1', force3D:true})
		.to(arrow_home_banner,1.5,{autoAlpha:1,marginTop:'-1px',scale:'1.05', force3D:true});	
		function playarrow()
			{
				tm.play();
			}	
			playarrow();
	  
	 // FIN ANIMACION HOME
	 // ANIMACION BANNER 
		var animationOne = $('#animationOne');
		var greatcircle = $('#greatcircle');
		var toolcircle1 = $('.toolcircle1');
		var toolcircle2 = $('.toolcircle2');
		var toolcircle3 = $('.toolcircle3');
		var toolcircle4 = $('.toolcircle4');
		var toolcircle5 = $('.toolcircle5');
		var toolcircle6 = $('.toolcircle6');
		var toolcircle7 = $('.toolcircle7');
		var toolcircle8 = $('.toolcircle8');
		var toolcircle9 = $('.toolcircle9');
		
		var animationTwo = $('#animationTwo');
		var greatcircleb = $('#greatcircleb');
		var toolcircle1b = $('.toolcircle1b');
		var toolcircle2b = $('.toolcircle2b');
		var toolcircle3b = $('.toolcircle3b');
		var toolcircle4b = $('.toolcircle4b');
		var toolcircle5b = $('.toolcircle5b');
		var toolcircle6b = $('.toolcircle6b');
		var toolcircle7b = $('.toolcircle7b');
		var toolcircle8b = $('.toolcircle8b');
		var toolcircle9b = $('.toolcircle9b');
		var imagen_decorlast = $('#imagen_decorlast');
		var meiners = $('#meiners');
		
		var animationThree = $('#animationThree');
		var greatcirclec = $('#greatcirclec');
		var toolcircle1c = $('.toolcircle1c');
		var toolcircle2c = $('.toolcircle2c');
		var toolcircle3c = $('.toolcircle3c');
		var toolcircle4c = $('.toolcircle4c');
		var toolcircle5c = $('.toolcircle5c');
		var toolcircle6c = $('.toolcircle6c');
		var toolcircle7c = $('.toolcircle7c');
		var toolcircle8c = $('.toolcircle8c');
		var toolcircle9c = $('.toolcircle9c');
		
		var control_iso_animation = $('#control_iso_animation');		
		var control_decorlast_animation = $('#control_decorlast_animation');
		var control_tool_animation = $('#control_tool_animation');
		
		var easeArray = [Cubic.easeInOut, Sine.easeInOut, Quint.easeInOut];
		var ramdonHeight = (Math.random() * 1) + 60;
		var randomduration = Math.random();
		var heightcv = $('#canvas_animation').height();
	  
		var toolAnimation = new TimelineLite({ paused:true, onComplete:hidetoolAnimation});
		toolAnimation.set(toolcircle1,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.2 });
		toolAnimation.set(toolcircle2,{ left:Math.floor((Math.random()*30)-50)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle3,{ left:Math.floor((Math.random()*30)-50)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle4,{ left:Math.floor((Math.random()*50)-60)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle5,{ left:Math.floor((Math.random()*50)-80)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle6,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle7,{ left:Math.floor((Math.random()*90)+1)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle8,{ left:Math.floor((Math.random()*30)+1)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(toolcircle9,{ left:Math.floor((Math.random()*30)+1)+'px', scale:Math.random()+0.1 });
		toolAnimation.set(imagen_decorlast,{ autoAlpha:0});
		
		toolAnimation
		.to(toolcircle1, 0.6, {scale:Math.random()+0.1,autoAlpha:1,opacity:1, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1")
		.from(toolcircle2, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle3, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle4, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle5, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle6, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle7, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle8, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(toolcircle9, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+="+ Math.random())
		.from(greatcircle, 0.6, {scale:0,autoAlpha:0,opacity:0, ease:Power2.easeOut},"circle1+=1.2")
		.from(greatcircle,1,{},"circle1+=6")
		.to(toolcircle1, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle2, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle3, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle4, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle5, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle6, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle7, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle8, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(toolcircle9, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle1+=6")
		.to(greatcircle, 0.6, {scale:1.5,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0], force3D:true},"circle1+=7");
		
		
		var decorlastAnimation = new TimelineLite({ paused:true, onComplete:hidedecorlastAnimation});
		decorlastAnimation.set(toolcircle1b,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle2b,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle3b,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle4b,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle5b,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle6b,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle7b,{ left:Math.floor((Math.random()*90)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle8b,{ left:Math.floor((Math.random()*110)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(toolcircle9b,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		decorlastAnimation.set(meiners,{ autoAlpha:0});
		
		decorlastAnimation
		.from(toolcircle1b, 0.6, {scale:1,autoAlpha:0,opacity:0,  ease:easeArray[Math.random() * easeArray.length | 0]},"circle2")
		.from(toolcircle2b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle3b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle4b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle5b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle6b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle7b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle8b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(toolcircle9b, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+="+ Math.random())
		.from(greatcircleb, 0.6, {scale:0,autoAlpha:0,opacity:0, ease:Power2.easeOut},"circle2+=1")
		.from(imagen_decorlast, 0.8, { autoAlpha:0, left:'-60px'},"circle2+=2")
		.from(meiners, 0.6, { autoAlpha:0, top:'15px'},"circle2+=2.6")
		.from(greatcircleb,1,{},"circle2+=6")
		.to(toolcircle1b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle2b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle3b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle4b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle5b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle6b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle7b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle8b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(toolcircle9b, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle2+=6")
		.to(greatcircleb, 0.6, {scale:1.5,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0], force3D:true},"circle2+=7");
		//if (ie_oldies){ alert('ie8');}
		
		var isoAnimation = new TimelineLite({ paused:true, onComplete:hideisoAnimation});
		isoAnimation.set(toolcircle1c,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle2c,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle3c,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle4c,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle5c,{ left:Math.floor((Math.random()*50)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle6c,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle7c,{ left:Math.floor((Math.random()*90)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle8c,{ left:Math.floor((Math.random()*110)+1)+'px', scale:Math.random()+0.1 });
		isoAnimation.set(toolcircle9c,{ left:Math.floor((Math.random()*100)+1)+'px', scale:Math.random()+0.1 });
		
		isoAnimation
		.from(toolcircle1c, 0.6, {scale:1,autoAlpha:0,opacity:0,  ease:easeArray[Math.random() * easeArray.length | 0]},"circle3")
		.from(toolcircle2c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle3c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle4c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle5c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle6c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle7c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle8c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(toolcircle9c, 0.5, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+="+ Math.random())
		.from(greatcirclec, 0.6, {scale:0,autoAlpha:0,opacity:0, ease:Power2.easeOut},"circle3+=1")
		.from(greatcirclec,1,{},"circle3+=6")
		.to(toolcircle1c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle2c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle3c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle4c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle5c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle6c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle7c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle8c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(toolcircle9c, 0.6, {scale:1,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0]},"circle3+=6")
		.to(greatcirclec, 0.6, {scale:1.5,autoAlpha:0,opacity:0, ease:easeArray[Math.random() * easeArray.length | 0], force3D:true},"circle3+=7");
		
		
		
		control_tool_animation.click( function(){
			animationOne.fadeIn("fast");
			animationTwo.fadeOut("fast");
			animationThree.fadeOut("fast");		
			$('#banner').stop().fadeOut("1000", function() {
				$('#banner').stop().css({"background":"url(http://www.anypsa.com.pe/static/images/banner/banx.jpg)   no-repeat 0 50%", "background-size": "cover"}).fadeIn('slow');
			});
			$(this).attr('src',html_path + 'static/images/banner/control_banner_2.png');
			$(this).siblings().attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner.png');	
			decorlastAnimation.pause(0);
			toolAnimation.pause(0);
			isoAnimation.pause(0);
			toolAnimation.restart();
			}); 
			
		
		control_decorlast_animation.click( function(){
			animationOne.fadeOut("fast");
			animationThree.fadeOut("fast");
			animationTwo.fadeIn("fast");
			$('#banner').stop().fadeOut("1000", function() {
				$('#banner').stop().css({"background":"url("+"http://www.anypsa.com.pe/static/images/banner/banner_decorlast.jpg)   no-repeat 0 50%", "background-size": "cover"}).fadeIn('slow');
			});
			$(this).attr('src',html_path + 'static/images/banner/control_banner_2.png');
			$(this).siblings().attr('src',html_path+'static/images/banner/control_banner.png');
			toolAnimation.pause(0);	
			isoAnimation.pause(0);
			decorlastAnimation.pause(0);
			decorlastAnimation.restart();
			}); 
			
		control_iso_animation.click( function(){
			animationOne.fadeOut("fast");
			animationTwo.fadeOut("fast");
			animationThree.fadeIn("fast");
			$('#banner').stop().fadeOut("1000", function() {
				$('#banner').stop().css({"background":"url("+"http://www.anypsa.com.pe/static/images/banner/bg_iso.jpg)   no-repeat 0 50%", "background-size": "cover"}).fadeIn('slow');
			});
			$(this).attr('src',html_path + 'static/images/banner/control_banner_2.png');
			$(this).siblings().attr('src',html_path+'static/images/banner/control_banner.png');
			toolAnimation.pause(0);	
			decorlastAnimation.pause(0);
			isoAnimation.pause(0);
			isoAnimation.restart();
			}); 	
		
			
			function hidetoolAnimation()
			{			
				var t=setTimeout(function(){
				$('#animationOne').fadeOut('fast');
				$('#animationTwo').fadeOut('fast');
				$('#banner').stop().fadeOut("1000", function() {
					$('#banner').stop().css({"background-image":"url(http://www.anypsa.com.pe/static/images/banner/bg_iso.jpg)"}).fadeIn(1000);
				});
					$('#control_iso_animation').attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner_2.png');
					$('#control_iso_animation').siblings().attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner.png');
					$('#animationThree').fadeIn();
					toolAnimation.pause(0);	
					isoAnimation.pause(0);
					decorlastAnimation.pause(0);
					isoAnimation.restart();
				},500);	
					
			}
				
			function hidedecorlastAnimation()
			{
				var t=setTimeout(function(){
				$('#animationThree').fadeOut('fast');
				$('#animationTwo').fadeOut('fast');
				$('#banner').stop().fadeOut("1000", function() {
					$('#banner').stop().css({"background-image":"url(http://www.anypsa.com.pe/static/images/banner/banx.jpg)"}).fadeIn(1000);
				});
				$('#control_tool_animation').attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner_2.png');
				$('#control_tool_animation').siblings().attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner.png');
				$('#animationOne').fadeIn();
				toolAnimation.pause(0);	
				isoAnimation.pause(0);
				decorlastAnimation.pause(0);
				toolAnimation.restart();
				},500);	
				
				}
				
			function hideisoAnimation()
			{
				var t=setTimeout(function(){
				$('#animationOne').fadeOut('fast');	
				$('#animationThree').fadeOut('fast');
				$('#banner').stop().fadeOut("1000", function() {
					$('#banner').stop().css({"background-image":"url(http://www.anypsa.com.pe/static/images/banner/banner_decorlast.jpg)"}).fadeIn(1000);
				});
				$('#control_decorlast_animation').attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner_2.png');
				$('#control_decorlast_animation').siblings().attr('src','http://www.anypsa.com.pe/static/images/banner/control_banner.png');
				$('#animationTwo').fadeIn();
				toolAnimation.pause(0);	
				isoAnimation.pause(0);
				decorlastAnimation.pause(0);
				decorlastAnimation.restart();
				},500);	
				
			}
			animationOne.fadeOut("fast");	
			isoAnimation.play();
			
		/*	.from(titulo1, 1, {top:30, autoAlpha:0, delay:0, ease:Power2.easeOut},"title1")
			.from(titulo2, 1, {top:200, autoAlpha:0, delay:0, ease:Power2.easeOut},"image1+=3.75")
			.to(titulo1, 0.5,{autoAlpha:0, delay:3})
			.to(titulo2, 0.5,{autoAlpha:0})
			.to(imagen1, 0.5,{right:800, autoAlpha:0,opacity:0, delay:0, ease:Back.easeOut});	*/
			
	 //FIN ANIMACION BANNER
	 //HOVER ITEMS BANNER
	 $('#greatcircleb').hover(function(){
	  TweenLite.to($(this), 0.9, {scale:1.03, backgroundColor:'#333333', ease:Back.easeOut});
	 },function(){
	  TweenLite.to($(this), 0.9, {scale:1, backgroundColor:'#FF0055', ease:Back.easeOut});
	 });
	 //FIN HOVER ITEMS BANNER
	  // ANIMACION DE TABS DE COLORES
	   var tabcalido = $('#tabcalido');
	   var tabfrio = $('#tabfrio');
	   var tabneutro = $('#tabneutro');
	   var corescalidos = $('#corescalidos');
	   var coresfrios = $('#coresfrios');
	   var coresneutros = $('#coresneutros');
	  
	  
		tabcalido.click( function(){
		    var t = new TimelineLite();
		    t.set(corescalidos,{autoAlpha:1});
		    t.to(coresfrios,0,{autoAlpha:0})
		    .to(coresneutros,0,{autoAlpha:0})
		    .from(corescalidos,2,{autoAlpha:0,delay:0.1});
		    tabcalido.addClass('tabcoreshover');
			tabfrio.removeClass('tabcoreshover');
			tabneutro.removeClass('tabcoreshover');
			tabfrio.find('.buletacores').css({'visibility':'hidden'});
			tabcalido.find('.buletacores').css({'visibility':'visible'});
			tabneutro.find('.buletacores').css({'visibility':'hidden'});
		  });
		  
		   tabfrio.click( function(){
			    var t = new TimelineLite();
			    t.set(coresfrios,{autoAlpha:1});
			    t.to(corescalidos,0,{autoAlpha:0})
			    .to(coresneutros,0,{autoAlpha:0})
			    .from(coresfrios,2,{autoAlpha:0,delay:0.1});
				tabcalido.removeClass('tabcoreshover');
				tabfrio.addClass('tabcoreshover');
				tabneutro.removeClass('tabcoreshover');
				tabfrio.find('.buletacores').css({'visibility':'visible'});
				tabcalido.find('.buletacores').css({'visibility':'hidden'});
				tabneutro.find('.buletacores').css({'visibility':'hidden'});
		  });
	
			tabneutro.click( function(){
		    var t = new TimelineLite();
		    t.set(coresneutros,{autoAlpha:1});
		    t.to(corescalidos,0,{autoAlpha:0})
		    .to(coresfrios,0,{autoAlpha:0})
		    .from(coresneutros,2,{autoAlpha:0,delay:0.1});
			tabcalido.removeClass('tabcoreshover');
			tabfrio.removeClass('tabcoreshover');
			tabneutro.addClass('tabcoreshover');
			tabfrio.find('.buletacores').css({'visibility':'hidden'});
			tabcalido.find('.buletacores').css({'visibility':'hidden'});
			tabneutro.find('.buletacores').css({'visibility':'visible'});
		  });
	
		  tabcalido.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
				if(corescalidos.css('visibility') == "visible")
					{
					  $(this).find('img').css({'visibility':'visible'});
					}
			  }); 
			  
		  tabfrio.hover( function(){
				  $(this).find('img').css({'visibility':'visible'});
				  },function(){
				$(this).find('img').css({'visibility':'hidden'});
					if(coresfrios.css('visibility') == "visible")
						{
						  $(this).find('img').css({'visibility':'visible'});
						}
			  }); 
			  
		  tabneutro.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
			if(coresneutros.css('visibility') == "visible")
				{
				  $(this).find('img').css({'visibility':'visible'});
				}
			  });
							  
		  
		  $('.contentcores').click( function(){
			  var bgcolor = $(this).css('background-color');
				$('#transferEffect').remove(); // Remove any existing one
				$(this).effect('transfer', { to: $('#banner_decorlast') }, 400);
				$('.ui-effects-transfer:last').css({
				  'background-color': $(this).css('background-color'),
				  'opacity': 0.4
					});
					TweenMax.to($('#banner_decorlast'),0.5,{backgroundColor:bgcolor});
			   });
			$('.contentcores').hover( function(){
				$(this).find('span').css({'visibility':'visible'});
				},function(){
				$(this).find('span').css({'visibility':'hidden'});
				});   
			   
		  
	  // FIN DE ANIMACION DE TABS DE COLORES
	  
	  //ANIMACION TABS ANYPSA
	  
		var tabeter1 = $('#tabeter1');
		var tabeter2 = $('#tabeter2');
		var tabeter3 = $('#tabeter3');
		var tabeter4 = $('#tabeter4');
		var content_tabeter1 = $('#content_tabeter1');
		var content_tabeter2 = $('#content_tabeter2');
		var content_tabeter3 = $('#content_tabeter3');
		var content_tabeter4 = $('#content_tabeter4');
		
		var tabcores = $('.tabcores');
		var inner_content_mediun = $('#inner_content_mediun');
		var content_mediun = $('#content_mediun');
		
		var cuadreter = new TimelineLite();
		
		var ht1 = content_tabeter1.height();
		var ht2 = content_tabeter2.height();
		var ht3 = content_tabeter3.height();
		var ht4 = content_tabeter4.height();
		
		cuadreter.to(content_tabeter1,0,{height:'100%'});
		cuadreter.to(content_tabeter2,0,{ height:0});
		cuadreter.to(content_tabeter3,0,{ height:0});
		cuadreter.to(content_tabeter4,0,{ height:0}); 
	  
		 tabeter1.click( function(){
		 var t = new TimelineLite();
		 t.set(content_tabeter1,{autoAlpha:1, height:'100%'});
		 t.to(content_tabeter2,0,{autoAlpha:0,height:0})
		 .to(content_tabeter3,0,{autoAlpha:0,height:0})
		 .to(content_tabeter4,0,{autoAlpha:0,height:0})
		 .from(content_tabeter1,1,{autoAlpha:0});
		 tabeter1.addClass('tabcoreshover');
		 tabeter2.removeClass('tabcoreshover');
		 tabeter3.removeClass('tabcoreshover');
		 tabeter4.removeClass('tabcoreshover');
		 tabeter1.find('.buletacores').css({'visibility':'visible'});
		 tabeter2.find('.buletacores').css({'visibility':'hidden'});
		 tabeter3.find('.buletacores').css({'visibility':'hidden'});
		 tabeter4.find('.buletacores').css({'visibility':'hidden'});
		 //tabcores.height(content_tabeter1.height());
		  });
		  
		  tabeter2.click( function(){
		  var t = new TimelineLite();
		  t.set(content_tabeter2,{autoAlpha:1, height:'100%'});
		  t.to(content_tabeter1,0,{autoAlpha:0,height:0})
		  .to(content_tabeter3,0,{autoAlpha:0,height:0})
		  .to(content_tabeter4,0,{autoAlpha:0,height:0})
		  .from(content_tabeter2,1,{autoAlpha:0});
			tabeter1.removeClass('tabcoreshover');
			tabeter2.addClass('tabcoreshover');
			tabeter3.removeClass('tabcoreshover');
			tabeter4.removeClass('tabcoreshover');
			tabeter2.find('.buletacores').css({'visibility':'visible'});
			tabeter1.find('.buletacores').css({'visibility':'hidden'});
			tabeter3.find('.buletacores').css({'visibility':'hidden'});
			tabeter4.find('.buletacores').css({'visibility':'hidden'});
		  });
	
		  tabeter3.click( function(){
			//var tabeterheight = content_tabeter1.height();
		  var t = new TimelineLite();
		  t.set(content_tabeter3,{autoAlpha:1, height:'100%'});
		  t.to(content_tabeter1,0,{autoAlpha:0,height:0})
		  .to(content_tabeter2,0,{autoAlpha:0,height:0})
		  .to(content_tabeter4,0,{autoAlpha:0,height:0})
		  .from(content_tabeter3,1,{autoAlpha:0})
		  .to(tabcores,0.5,{height:content_tabeter3.height()})
		  .to(inner_content_mediun,0.5,{height:content_tabeter3.height()})
		  .to(content_mediun,0.5,{height:content_tabeter3.height()});
			tabeter1.removeClass('tabcoreshover');
			tabeter2.removeClass('tabcoreshover');
			tabeter3.addClass('tabcoreshover');
			tabeter4.removeClass('tabcoreshover');
			tabeter1.find('.buletacores').css({'visibility':'hidden'});
			tabeter2.find('.buletacores').css({'visibility':'hidden'});
			tabeter3.find('.buletacores').css({'visibility':'visible'});
			tabeter4.find('.buletacores').css({'visibility':'hidden'});
		  });
		  
		  tabeter4.click( function(){
		  var tabeterheight = content_tabeter1.height();
		  var t = new TimelineLite();
		  t.set(content_tabeter4,{autoAlpha:1, height:'100%'});
		  t.to(content_tabeter1,0,{autoAlpha:0,height:0})
		  .to(content_tabeter2,0,{autoAlpha:0,height:0})
		  .to(content_tabeter3,0,{autoAlpha:0,height:0})
		  .from(content_tabeter4,1,{autoAlpha:0});
			tabeter1.removeClass('tabcoreshover');
			tabeter2.removeClass('tabcoreshover');
			tabeter3.removeClass('tabcoreshover');
			tabeter4.addClass('tabcoreshover');
			tabeter1.find('.buletacores').css({'visibility':'hidden'});
			tabeter2.find('.buletacores').css({'visibility':'hidden'});
			tabeter3.find('.buletacores').css({'visibility':'hidden'});
			tabeter4.find('.buletacores').css({'visibility':'visible'});
			//tabcores.height(content_tabeter4.height());
		  });
	
		  tabeter1.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
			if(content_tabeter1.css('visibility') == "visible")
				{
				  $(this).find('img').css({'visibility':'visible'});
				}
			  }); 
			  
		  tabeter2.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
			if(content_tabeter2.css('visibility') == "visible")
				{
				  $(this).find('img').css({'visibility':'visible'});
				}
			  }); 
			  
		  tabeter3.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
			if(content_tabeter3.css('visibility') == "visible")
				{
				  $(this).find('img').css({'visibility':'visible'});
				}
			  });
			  
			tabeter4.hover( function(){
			  $(this).find('img').css({'visibility':'visible'});
			  },function(){
			$(this).find('img').css({'visibility':'hidden'});
			if(content_tabeter4.css('visibility') == "visible")
				{
				  $(this).find('img').css({'visibility':'visible'});
				}
			  });  
			  
			  
	  // FIN ANIMACION TABS ANYPSA
	  //LOGOUT DE CLIENTE
	  $('#logout').click( function(e){
		  e.preventDefault();
			$.post(html_path+"logout", function(d){
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
						$('#response').html("<i class='icon-ok'></i> Sus datos han sido enviados!<br />Pronto nos pondremos en contacto con usted.").fadeIn('slow');
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
		
		$(".demo1 .filter a.active").trigger('click');
		$(".demo1 .filter a").click( function(){
		var target = $(this).attr('rel');
		var highttarget = $('.'+target).height();
		$('.container').height(highttarget);
		});	
		
		$(".demo2 .filter a.active").trigger('click');
		$(".demo2 .filter a").click( function(){
		var target = $(this).attr('rel');
		var highttarget = $('.'+target).height();
		//$('.container').height(highttarget);
		});	
		
		/************************* END FILTERABLE ITEMS *********************************/	
		
		/********************ZOOM*******************************/
		$('a.zoom').easyZoom();
		/*********************END ZOOM ****************************/
		/*********************EATABS***************************/
		 //$('#tab-container').easytabs({animate:true,animationSpeed:400,updateHash: false,  transitionIn:'fadeIn'});
		 /***************END EATABS******************************/
		 /******MENU DE NOTICIAS********************************/
	/*----------------------------------------------------*/
	/*	ShowBiz Carousel
	/*----------------------------------------------------*/
		 function is_mobile() {
			var agents = ['android', 'webos', 'iphone', 'ipad', 'blackberry','Android', 'webos', ,'iPod', 'iPhone', 'iPad', 'Blackberry', 'BlackBerry'];
			var ismobile=false;
			for(i in agents) {
				if (navigator.userAgent.split(agents[i]).length>1)
				ismobile = true;
			}
			return ismobile;
		}
		
			jQuery('#example2').showbizpro({
			dragAndScroll: (is_mobile() ? "on" : "off"),
			visibleElementsArray:[4,4,4,1],
			carousel:"on",
			heightOffsetBottom:10,
			entrySizeOffset:0,
			allEntryAtOnce:"off",
			rewindFromEnd:"on",
			speed:500,
			autoPlay:"on",
			delay:8000
			});
			// THE FANCYBOX PLUGIN INITALIZATION
			jQuery(".fancybox").fancybox();
				 /***************END MENU DE NOTICIAS*****************/	 			
			});
			
	/**/
		var height_banner = $(window).height() - 100;
		
		if (height_banner < 600){
			$('#banner').height(height_banner + 16);
			} else {
				$('#banner').height(600);
				}
		//$('#banner').height(600);
	
		var w = $(window);
		var headerHeight = (w.width() > 1440 ? 79 : 79);
		
		$(window).resize(function () { /* do something */
				var w = $(window);
				var height_banner = $(window).height() - 100;
		if (height_banner < 600){
				$('#banner').height(height_banner + 16);
			} else {
				$('#banner').height(600);
				}
				
				//slidercontentAlignMiddle();
			});
	
	
		
	$("#separator-tab").on('click', function(){	 
			if(w.scrollTop() < (w.height()/2 - 80)) {
				console.log(w.scrollTop());
				$(this).addClass("rotate");
				TweenLite.to($("#separator-tab"), 1, {rotation:180});
				$('html, body').animate({scrollTop: $(w).height() - headerHeight}, 800);
			}else{
				$(this).removeClass("rotate");
				TweenLite.to($("#separator-tab"), 1, {rotation:0});
				$('html, body').animate({scrollTop: 0});
			}
		});
	
		$(document).on('mousewheel DOMMouseScroll MozMousePixelScroll', function(){
			if(w.scrollTop() < (w.height()/2 - headerHeight)){
				
				$("#separator-tab").removeClass("rotate");
				TweenLite.to($("#separator-tab"), 1, {rotation:0});
			}else{
							
			   $("#separator-tab").addClass("rotate");
				TweenLite.to($("#separator-tab"), 1, {rotation:180});
			}
		});
		
	/**/
	
	
	/*MENU EMERGENTE ***********************************************************************************/
	$('#menu li').hover( function(){
		var offsetcontainer = $('#container').offset();
		var offsetleftcontainer = parseInt(offsetcontainer.left);
		var offsetthis = $(this).offset();
		var offsetleftthis = parseInt(offsetthis.left);
		var offsetleft = offsetleftthis - offsetleftcontainer + 4 ;
	
		var anchocontenedor = $('#container').width()-20;
		var $this = $(this).children('div');
			offsetleft = offsetleft;	
		var siblings = $(this).children('div').siblings('div').css({'top':'-999em'});
		 var timel = new TimelineMax();
		 timel.set($this,{autoAlpha:0,marginLeft:-offsetleft, width:anchocontenedor});
		 timel.to($this,1,{top:'-1px',top:'auto', autoAlpha:1, ease:Back.easeOut});
		}, function(){
			var $this = $(this).children('div');
			var siblings = $(this).children('div').siblings('div').css({'top':'-999em'});
			var timel2 = new TimelineMax();
			 timel2.to($this,1,{top:'-999em',autoAlpha:0, ease:Back.easeOut});	
		});
	/**/
	//background-color:rgba(238,238,238,0.9);
	//background:#EEEEEE\0/;
	/* ANIMACION MENU DE ACCESO RAPIDO*/
		// ----- HACK IE ------ //
		var ie_oldies = false;
		var ie = false;
		var ie_version;
		
		if($.browser.msie == true){ 
			ie = true;
			ie_version = parseInt($.browser.version, 10);
			if(ie_version <= 8) ie_oldies = true;
		}
		
		if (ie_oldies){
				$('.inner_maindex').css({'cursor':'pointer'});
				}
				
		$('.inner_maindex').click ( function(){
			if (ie_oldies){
					$(this).css({'cursor':'pointer'});
					var a = $(this).find('a').attr('href');
					if (typeof a != 'undefined'){
						window.location = a;
				}
				}
			});
			
			
		//if (ie_oldies){alert('ie8');}
		$('.inner_maindex a').hover( function(){
				var tmax = new TimelineMax();
				var $this = $(this);
				var bg = $this.data('bg');
				var img = $this.find('img');
				tmax.to($this,0.4,{ backgroundColor:'rgba('+bg+')'},"bg")
				.to(img,0.4,{autoAlpha:1},"bg");	
			}, function(){
				var tmaxx = new TimelineMax();
				var $this = $(this);
				var img = $this.find('img');
				tmaxx.to($this,0.4,{ backgroundColor:'none', autoAlpha:1},"bg")
				.to(img,0.4,{autoAlpha:0},"bg");
			});
													
			
	/**/	
	/*----------------------------------------------------*/
	/*	Fixed menu
	/*----------------------------------------------------*/		
	// Llamado cuando se cargue la página
		posMenu();
		$(window).scroll(function() { 
		   posMenu();
		});	
			var w = $(window);
			var ww = w.width();
			if (ww > 1440)
				{$('#container').width(1420);
			//$('.dropdown_2columns').width(1420);
			}
			else if ((ww <= 1440) && (ww > 960))
				{$('#container').width(ww);	}
			else if(ww < 960)
				{$('#container').width(1024);}	
		
		
		
		$('#cabecera').width($('#container').width());	
		$('#cabecera_container').css({'margin':'0 auto'});
				
	function posMenu() {
		var height_header = $('#cabecera').outerHeight(true)-50;
		var height_menu = $('ul#menu').outerHeight(true);
		var pos = $(window).scrollTop();
		//var buscadorclon = $('.clearable').clone();
		if (pos >= height_header){	
				
				if($(".fixedevent").css("display") == "none"){			
				var ancho_container = $('#container').width();
				var margin_medio = (ancho_container/2);
				
				var ancho_container = $('#container').width();
				if(ancho_container > 1440){
					$('#cabecera').width(1440);
					}
					else{
					$('#cabecera').width(ancho_container);
						}
					$('#cabecera').addClass('cabecera_fixed');
					var cabe = new TimelineMax();
					cabe.to($('#cabecera'),0.1,{css:{position:'fixed'}})
					.to($('#cabecera_container'),0.1,{css:{marginLeft:margin_medio}})
					.to($('#content_cabecera'),0.1,{ height:'80px'})
					.to($('#cabecera'),0.4,{height:'80px', ease:Power1.easeInOut},"cabecera")
					.to($('#logo_image'),0.4,{width:'140px', height:'36px'},"cabecera")
					.to($('#logo'),0.4,{marginTop:'22px'},"cabecera")
					.to($('#searchbox'),0.4,{marginTop:'-10px' },"cabecera")
					.to($('.lupa'),0.4,{marginTop:'-10px' },"cabecera")
					.to($('#menu'),0.4,{marginTop:'-35px'},"cabecera");
					//$('ul#menu').addClass('menu_fixed');
					//z.to($('#logo_menu'),0.2,{'height':'38px','width':'150px',top:'-12px', left:'-400px'});
					
					//$('#logo_inicio').css({'display':'none'});
					//$('.dropdown_3columns').addClass('volx3');
					//$('.dropdown_2columns').addClass('volx2');
					//$('.dropdown_5columns').addClass('volx5');
					//$('.content').css('margin-top', (height_menu) + 'px');		
					$('.fixedevent').css({'display':'block'});//necesary
					//$('.fixedevent').append($('#searchanypsa'));
					//$('#searchbox').addClass('fixedsearchbox');
					//$('.lupa').addClass('fixedlupa');		
				}
	
		} else {
				
		if($(".fixedevent").css("display") == "block"){
			var ancho_container = $('#container').width();
			var margin_medio = (ancho_container/2);
			
			var ancho_container = $('#container').width();
	if(ancho_container > 1440){
		$('#cabecera').width(1440);
		}
		else{
		$('#cabecera').width(ancho_container);
			}
			$('#cabecera').removeClass('cabecera_fixed');	
			var z = new TimelineMax();
			z.to($('#cabecera'),0.1,{css:{position:'static'}})
			.to($('#cabecera_container'),0.1,{css:{marginLeft:0}})
			.to($('#cabecera'),0.1,{height:'100px', ease:Power1.easeInOut},"cabecera")
			.to($('#content_cabecera'),0.1,{ height:'100px'})
			.to($('#logo_image'),0.4,{width:'192px', height:'54px'},"cabecera")
			.to($('#logo'),0.4,{marginTop:'33.5px'},"cabecera")
			.to($('#searchbox'),0.4,{marginTop:'0px' },"cabecera")
			.to($('.lupa'),0.4,{marginTop:'0px' },"cabecera")
			.to($('#menu'),0.1,{marginTop:'-30px'},"cabecera");
			//z.from($('#cabecera'),1,{css:{position:'static'}})
			//$('ul#menu').removeClass('menu_fixed');
			//z.to($('#logo_menu'),0.2,{'height':'48px','width':'186px', top:'-24px', left:'-264px'});
			//$('#logo_inicio').css('display','block');
			//$('.dropdown_3columns').removeClass('volx3');
			//$('.dropdown_5columns').removeClass('volx5');
			//$('.dropdown_2columns').removeClass('volx2');
			//$('.content').css('margin-top', '0');
			$('.fixedevent').css({'display':'none'});
			//$('#contentsearchanypsa').append($('#searchanypsa'));	
			//$('#searchbox').removeClass('fixedsearchbox');
			//$('.lupa').removeClass('fixedlupa');
			
			}
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
	//$('#foo2 li').hoversiblings();
	
});