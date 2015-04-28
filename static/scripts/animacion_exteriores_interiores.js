a$(function(){
	//home
		var ie_oldies = false;
	var ie = false;
	var ie_version;
	
	if($.browser.msie == true){ 
		ie = true;
		ie_version = parseInt($.browser.version, 10);
		if(ie_version <= 8) ie_oldies = true;
	}
	
	var baldeinit = $('#imagen_insignia');
	var idea = $('#idea_btn');
	var detalles = $('.btn_detalles');
	var toolters = $('#toolters');
	var botoleft = $('.botonerahl');
	var botoright = $('.botonerah');
	
	var td = new TimelineLite();
	td.from(idea,0.7,{marginRight:'-20px',autoAlpha:0,delay:1})
	.from(baldeinit,0.7,{marginLeft:'-20px',autoAlpha:0,delay:0})
	.from(toolters,0.7,{top:'10px',autoAlpha:0,delay:0})
	.from(botoleft,0.5,{right:'200px',autoAlpha:0,delay:0, ease:Elastic.easeOut})
	.from(botoright,0.5,{left:'200px',autoAlpha:0,delay:0, ease:Elastic.easeOut})
	.from(detalles,0.5,{marginRight:'-20px',autoAlpha:0,delay:0, ease:Elastic.easeOut});
	//detalles
	var balde = $('#insignia_banner_decorlast');
	var p1 = $('#propertytwodecorlast');
	var p2 = $('#propertyonedecorlast');
        var p3 = $('#propertythreedecorlast');
	var misces = $('#misces');
	var t1 = $('#title1_banner_decorlast');
	var t2 = $('#title2_banner_decorlast');
	var soc = $('.ulsocialbannerdec');
	
	var t = new TimelineLite();
	t.from(balde,0.7,{left:'-20px',autoAlpha:0,delay:1})
        .from(p3,0.4,{left:'-20px',autoAlpha:0,delay:0})
	.from(p1,0.4,{left:'-20px',autoAlpha:0,delay:0})
	.from(p2,0.4,{left:'-20px',autoAlpha:0})
	.from(misces,0.4,{top:'15px',autoAlpha:0})
	.from(t1,0.7,{top:'-15px',autoAlpha:0})
	.from(t2,0.7,{top:'15px',autoAlpha:0})
	.from(soc,0.7,{top:'15px',autoAlpha:0});
	//FIN DETALLES
	/* PARA LA GALERIA DE IMAGENES*/
	$('#gallery_product li:even').css({'float':'left'});
    $('#gallery_product li:odd').css({'float':'right'});
	/* FIN DE LA GALERIA DE IMAGENES */
	
});