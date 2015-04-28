$( function(){	
var html_path = 'http://160.132.105.210/anypsa/'; 
$('#sendnat').click( function()
{
		$("#cargando_x").css("display", "block");
			//persona natural 
		var nombreclientenat_value = $('#nombreclientenat').val();
		var docidnat_value = $('#docidnat').val();
		var numerodocnat_value = $('#numerodocnat').val();
		var correonat_value = $('#correonat').val();
		var contrasenanat_value = $('#contrasenanat').val();
		var contrasena2nat_value = $('#contrasena2nat').val();
		var telefononat_value = $('#telefononat').val();
		var suma_hiddennat_value = $('#suma-hiddennat').val();
		var sumanat_value = $('#sumanat').val();
		var direccionnat_value = $('#direccionnat').val();
		var distritonat_value = $('#distritonat').val();
		var provincianat_value = $('#provincianat').val();
		var departamentonat_value = $('#departamentonat').val();
		var terminosnat_value = $('#terminosnat').val();
		var boletinnat_value = $('#boletinnat').val();
		
		if ($('#boletinnat').prop('checked')){ 
		var boletinnat_value = "si";
		} else {boletinnat_value = "no";}
		
		if ($('#terminosnat').prop('checked')){
			
			}

	if ($('#terminosnat').prop('checked')){

								
	$("#statusx").html("");
	$(".responsespanmessage").html("");
	$.getJSON(html_path + "registerclient", {tiporegistro: 'natural', nombreclientenat: nombreclientenat_value, docidnat: docidnat_value, numerodocnat: numerodocnat_value, correonat: correonat_value, contrasenanat: contrasenanat_value, contrasena2nat: contrasena2nat_value, telefononat: telefononat_value, suma_hiddennat: suma_hiddennat_value, sumanat: sumanat_value, direccionnat: direccionnat_value, distritonat:distritonat_value, provincianat: provincianat_value, departamentonat: departamentonat_value, terminosnat: terminosnat_value, boletinnat: boletinnat_value},function(data) {
	
			// set variables based on the json response values
			var message = data.message;
			var successful = data.successful;
			if (data.nombreclientenat != ""){
				$('#nombreclientenatresponse').html(data.nombreclientenat);
				$('#nombreclientenat').addClass('error');
				} else {
					$('#nombreclientenat').removeClass('error');
				}
				
				if (data.docidnat != ""){
					$('#docidnatresponse').html(data.docidnat);
					$('#docidnat').addClass('error');
					}
				else {
					$('#docidnat').removeClass('error');
				}	
			if(data.numerodocnat != ""){
				$('#numerodocnatresponse').html(data.numerodocnat);
				$('#numerodocnat').addClass('error');
				} else { $('#numerodocnat').removeClass('error');}
				
				if(data.correonat != ""){
				$('#correonatresponse').html(data.correonat);
				$('#correonat').addClass('error');
				} else { $('#correonat').removeClass('error');}
				
				if(data.contrasenanat != ""){
				$('#contrasenanatresponse').html(data.contrasenanat);
				$('#contrasenanat').addClass('error');
				} else { $('#contrasenanat').removeClass('error');}
				
				if(data.contrasena2nat != ""){
				$('#contrasena2natresponse').html(data.contrasena2nat);
				$('#contrasena2nat').addClass('error');
				} else { $('#contrasena2nat').removeClass('error');}
				
				if (data.matchclaves != ""){
					$('#contrasenanatresponse').html(data.matchclaves);
					$('#contrasenanat').addClass('error');
					$('#contrasena2nat').addClass('error');
					} else {
						if(data.contrasenanat == ""){
						 $('#contrasenanat').removeClass('error');
						}
						if(data.contrasena2nat == ""){
						$('#contrasena2nat').removeClass('error');
						}
					}
					
				if(data.telefononat != ""){
				$('#telefononatresponse').html(data.telefononat);
				$('#telefononat').addClass('error');
				} else { $('#telefononat').removeClass('error');}
				
				if(data.sumanat != ""){
				$('#sumanatresponse').html(data.sumanat);
				$('#sumanat').addClass('error');
				} else { $('#sumanat').removeClass('error');}
				
				if(data.direccionnat != ""){
				$('#direccionnatresponse').html(data.direccionnat);
				$('#direccionnat').addClass('error');
				} else { $('#direccionnat').removeClass('error');}
				
				if(data.distritonat != ""){
				$('#distritonatresponse').html(data.distritonat);
				$('#distritonat').addClass('error');
				} else { $('#distritonat').removeClass('error');}
				
				if(data.provincianat != ""){
				$('#provincianatresponse').html(data.provincianat);
				$('#provincianat').addClass('error');
				} else { $('#provincianat').removeClass('error');}
				
				if(data.departamentonat != ""){
				$('#departamentonatresponse').html(data.departamentonat);
				$('#departamentonat').addClass('error');
				} else { $('#departamentonat').removeClass('error');}
				
					
			// if the success value is yes, then redirect
			if (successful == "Y") {
				$("#commentFormnat").hide("slow");
				$("#statusx").html('<center><br /><br /><br /><br /><br /><br /><br />Se ha enviado un email a <b>' + data.correo_cliente + '</b> para completar el proceso de registro.</center>');
				$('.responsespanmessage').html('');
				$('.default').each(function(){
				var defaultVal = $(this).attr('title');
				$(this).addClass('active').val(defaultVal);
				$(this).removeClass('error');
				});
			//window.location = "transferencias-vehiculares.php";
			} else {$("#statusx").html('<font color="#FF4325">' + data.msg_error + '</font>'); }
			
			
			// after login attempt update the status paragraph with the response message
			//$("#statusx").html(message);
			$("#cargando_x").css("display", "none");
			});
	} 
	else { 
		alert('Es necesario que lea y acepte los Términos y Condiciones de Uso para poder ser registrado.');
		$("#cargando_x").css("display", "none");
		}

});
$('#send').click( function()
{
	$("#cargando_x2").css("display", "block");
		//persona jurídica
		var razonsocial_value = $('#razonsocial').val();
		var ruc_value = $('#ruc').val();
		var correo_value = $('#correo').val();
		var contrasena_value = $('#contrasena').val();
		var contrasena2_value = $('#contrasena2').val();
		var telefono_value = $('#telefono').val();
		var suma_hidden_value = $('#suma-hidden').val();
		var suma_value = $('#suma').val();
		var direccion_value = $('#direccion').val();
		var distrito_value = $('#distrito').val();
		var provincia_value = $('#provincia').val();
		var departamento_value = $('#departamento').val();
		var representantelegal_value = $('#representantelegal').val();
		var tipodocreplegal_value = $('#tipodocreplegal').val();
		var numerodocreplegal_value = $('#numerodocreplegal').val();
		var terminos_value = $('#terminos').val();
		var boletin = $('#boletin').val();
		if ($('#boletin').prop('checked')){ 
		var boletin_value = "si";
		} else {boletin_value = "no";}
		
		if ($('#terminos').prop('checked')){
			$("#statusx").html("");
			$(".responsespanmessage").html("");
	$.getJSON(html_path + "registerclient", {tiporegistro: 'juridica', razonsocial: razonsocial_value, ruc: ruc_value, correo: correo_value, contrasena: contrasena_value, contrasena2: contrasena2_value, telefono: telefono_value, suma_hidden: suma_hidden_value, suma: suma_value, direccion: direccion_value, distrito: distrito_value, provincia:provincia_value, departamento: departamento_value, representantelegal: representantelegal_value, tipodocreplegal: tipodocreplegal_value, numerodocreplegal: numerodocreplegal_value, terminos: terminos_value, boletin:boletin_value},function(data) {
	
			// set variables based on the json response values
			var message = data.message;
			var successful = data.successful;
			
			if (data.razonsocial != ""){
				$('#razonsocialresponse').html(data.razonsocial);
				$('#razonsocial').addClass('error');
				} else {
					$('#razonsocial').removeClass('error');
				}
				
				if (data.ruc != ""){
				$('#rucresponse').html(data.ruc);
				$('#ruc').addClass('error');
				} else {
					$('#ruc').removeClass('error');
				}
				
				if(data.correo != ""){
				$('#correoresponse').html(data.correo);
				$('#correo').addClass('error');
				} else { $('#correo').removeClass('error');}
				
				if(data.contrasena != ""){
				$('#contrasenaresponse').html(data.contrasena);
				$('#contrasena').addClass('error');
				} else { $('#contrasena').removeClass('error');}
				
				if(data.contrasena2 != ""){
				$('#contrasena2response').html(data.contrasena2);
				$('#contrasena2').addClass('error');
				} else { $('#contrasena2').removeClass('error');}
				
				if (data.matchclaves != ""){
					$('#contrasenaresponse').html(data.matchclaves);
					$('#contrasena').addClass('error');
					$('#contrasena2').addClass('error');
					} else {
						if(data.contrasena == ""){
						 $('#contrasena').removeClass('error');
						}
						if(data.contrasena2 == ""){
						$('#contrasena2').removeClass('error');
						}
					}
					
				if(data.telefono != ""){
				$('#telefonoresponse').html(data.telefono);
				$('#telefono').addClass('error');
				} else { $('#telefono').removeClass('error');}
					
				if(data.suma != ""){
				$('#sumaresponse').html(data.suma);
				$('#suma').addClass('error');
				} else { $('#suma').removeClass('error');}	
				
				if(data.direccion != ""){
				$('#direccionresponse').html(data.direccion);
				$('#direccion').addClass('error');
				} else { $('#direccion').removeClass('error');}
				
				if(data.distrito != ""){
				$('#distritoresponse').html(data.distrito);
				$('#distrito').addClass('error');
				} else { $('#distrito').removeClass('error');}
				
				if(data.provincia != ""){
				$('#provinciaresponse').html(data.provincia);
				$('#provincia').addClass('error');
				} else { $('#provincia').removeClass('error');}
				
				if(data.departamento != ""){
				$('#departamentoresponse').html(data.departamento);
				$('#departamento').addClass('error');
				} else { $('#departamento').removeClass('error');}
				
				if (data.representantelegal != ""){
				$('#representantelegalresponse').html(data.representantelegal);
				$('#representantelegal').addClass('error');
				} else {
					$('#representantelegal').removeClass('error');
				}
				
				if (data.tipodocreplegal != ""){
					$('#tipodocreplegalresponse').html(data.tipodocreplegal);
					$('#tipodocreplegal').addClass('error');
					}
				else {
					$('#tipodocreplegal').removeClass('error');
				}
				
				if(data.numerodocreplegal != ""){
				$('#numerodocreplegalresponse').html(data.numerodocreplegal);
				$('#numerodocreplegal').addClass('error');
				} else { $('#numerodocreplegal').removeClass('error');}		
				
			
			// if the success value is yes, then redirect
			if (successful == "Y") {
				$("#commentForm").hide("slow");
				$("#statusx").html('Se ha enviado un email a ' + data.correo_cliente + ' para completar el proceso de registro.');
				$('.responsespanmessage').html('');
				$('.default').each(function(){
				var defaultVal = $(this).attr('title');
				$(this).addClass('active').val(defaultVal);
				$(this).removeClass('error');
				});
			//window.location = "transferencias-vehiculares.php";
			} else {$("#statusx").html('<font color="#FF4325">' + data.msg_error + '</font>'); }
			$("#cargando_x2").css("display", "none");
			
	});
			
			} else {
				alert('Es necesario que lea y acepte los Términos y Condiciones de Uso para poder ser registrado.');
				$("#cargando_x2").css("display", "none");
				}
		
});
		
	 	$('#docidnat').change( function(){
			$(this).removeClass('error');
			$('#docidnatresponse').html('');
			});
			
		$('#tipodocreplegal').change( function(){
			$(this).removeClass('error');
			$('#tipodocreplegalresponse').html('');
			});	
			
	 		$('.default').each(function(){
			var defaultVal = $(this).attr('title');
			$(this).focus(function(){
			  if ($(this).val() == defaultVal){
					$(this).removeClass('active').val('');
					$(this).removeClass('error');
					var input_id = $(this).attr('id');
					$('#'+ input_id + 'response').html('');
			  }
			})
		.blur(function(){
		  if ($(this).val() == ''){
				$(this).addClass('active').val(defaultVal);
		  }
		})
		.blur().addClass('active');
	  });
	  
	  $('#commentForm').hide();
	  $('#commentFormnat').hide();
	  
	  
	  $('#natural,#radionatural').click( function(){
		  $('#docidnat').removeClass('error');
		  $('#docidnatresponse').html('');
		  $('#tipodocreplegal').removeClass('error');
		  $('#tipodocreplegalresponse').html('');
		  $('.default').each(function(){
			$(this).removeClass('error');  
			var input_id = $(this).attr('id');
				$('#'+ input_id + 'response').html('');				
		  });
		  $('#natural').prop('checked',true);    
		// if(document.getElementById("natural").checked == true){
			 var t = new TimelineMax();
			 t.to($('#radiojuridico'),0.1,{ backgroundColor:'#A9B6BC', fontWeight : 'normal'})
			 .to($('#radionatural'),0.4,{ backgroundColor:'#43BFA7', fontWeight : 'bold'});
			 $('#commentForm').hide('fast');
			 $('#commentFormnat').show('slow');
			 $("#statusx").html("");
		// }
	 });
	 
	 $('#juridica, #radiojuridico').click( function(){
		 $('#docidnat').removeClass('error');
		 $('#docidnatresponse').html('');
		 $('#tipodocreplegal').removeClass('error');
		 $('#tipodocreplegalresponse').html('');
			  
		   $('.default').each(function(){
			$(this).removeClass('error');
			var input_id = $(this).attr('id');
				$('#'+ input_id + 'response').html('');  
		  });
		 	$('#juridica').prop('checked',true);   
		// if(document.getElementById("juridica").checked == true){
			  var t = new TimelineMax();
			 t.to($('#radionatural'),0.1,{ backgroundColor:'#A9B6BC', fontWeight : 'normal'})
			 .to($('#radiojuridico'),0.4,{ backgroundColor:'#43BFA7', fontWeight : 'bold'});
			 $('#commentFormnat').hide('fast');
			 $('#commentForm').show('slow');
			 $("#statusx").html("");
		 //}
	 });
		
	/* $('#clickfancy').click( function(e){
		 e.preventDefault();
		 self.parent.location.href=self.parent.location;
		 return false;
		 });*/
		 
	$('.fancybox3').fancybox({'padding':'0', 'width':'960', 'height':'750', helpers : { overlay : {closeClick: false, css : {
    'background':'transparent', 'filter':'progid:DXImageTransform.Microsoft.gradient(startColorstr=#e5000000,endColorstr=#e5000000)', 
            'zoom': '1',
                'background' : 'rgba(0, 0, 0, 0.85)'
            }}
}
});	 
	 });