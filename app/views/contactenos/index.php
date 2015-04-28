<style type="text/css">
#commentForm { width: 450px; float:left; }
#commentForm label { width: 435px; text-align:left; }
form.cmxform label {
	display: inline-block;
	vertical-align: top;
	cursor: hand;
}

#commentForm label.error, #commentForm input.submit {text-align:left; }
#commentForm input.submit:hover{ background-color:#FFF; color:#0F177A;}

form.cmxform { float:left;
	width: 450px !important;
	font-size: 1.0em;
	color: #333;
}

form.cmxform legend {
	padding-left: 0;
}

form.cmxform legend, form.cmxform label {
	color:#808080; font-size:14px;

}
form.cmxform label.error, label.error {
	/* remove the next line when you have trouble in IE6 with labels in list */
	color: red;
	font-style: italic;
	font-size:10px;
	display:inline;
	text-align:left;
}
label.exito {
	font-style: italic;
	font-size:11px;
	display:inline;
	text-align:left; color:#666666;}
div.error { display: none; }
textarea {border: 0px solid #C6C6C6; font-weight:bold; margin-right:10px;padding-left:5px; display:inline-block; background-color:#EFEFEF; width:435px;}
#mensaje{ width:435px !important;}
textarea:focus { border: 0px dotted #0F177A;display:inline-block; }
textarea.error { border: 1px dotted red; }
input {	border: 0px solid #C6C6C6; font-weight:bold; height:30px; width:435px; padding-left:5px; background-color:#EFEFEF;}
input.checkbox { border: none }
input:focus { border: 0px dotted #0F177A; }
input.error { border: 1px dotted red; }
form.cmxform .gray * { color: gray; }
input.submit:hover{ background-color:#FFF; color:#0E1679;}
a.submit-btn:hover{opacity:0.9; -moz-opacity: 0.90; filter: alpha(opacity=90);}
.default{ color:#808080; font-weight:bold; }
.active{ color:#CDCDCD; font-weight:bold;}
#menucontactenos{ list-style:none;}
#menucontactenos li{ display:inline-block; width:200px; }
p.parag{ font-size:18px !important;}
</style>
<!-- <aside class="patway"><a class="vermas" href="<?php echo HTML_PATH; ?>">Home</a> / Contáctenos </aside> -->
<div class="header_meiner">
    <ul id="menu_meiner">
        <li id="tab_contacto_o" style="background-color:#3EC0FF;">CONTACTO</li>
        <li id="tab_cotizacion_o" style="background-color:#C08181;">COTIZACIÓN</li>
        <li id="tab_consulta_o" style="background-color:#FFFF97;">CONSULTAS TÉCNICAS</li>
    </ul>
</div>
<div id="content_forms_contactenos">
<div class="content contact_contacto" id="contact_contacto" style="margin-top:15px;">
       <div class="derecha_info" style="display:inline-block; vertical-align:top; width:400px;">
       <form class="cmxform" id="commentForm">
		<p>
			<label for="nombres">&nbsp;Nombres y Apellidos:</label><br />
			<input class="default" title="Ingrese su nombre" id="nombres" name="nombres" /> 
        </p>   
		<p>
			<label for="correo">&nbsp;Correo Eléctronico:</label><br />
			<input class="default" title="Ingrese su correo" id="correo" name="correo" /> 
		</p>
         <p>
			<label for="ruc">&nbsp;Telefono de Contacto: </label><br />
			<input class="default" title="Ingrese su número de RUC" id="ruc" name="ruc" maxlength="11" /> 
        </p> 
	    <p>
			<label for="mensaje">&nbsp;Mensaje:</label><br />
			<textarea class="default" title="Ingrese su mensaje" id="mensaje" name="mensaje" style="width:230px;" cols="25" rows="7"></textarea>
		</p>
        <?php 
		$a = rand(0, 9); 
		$b = rand(0, 9);
		$c = $a + $b;
		?>
        <input type="hidden" name="suma-hidden" id="suma-hidden" value="<?php echo $c;?>" />
         <p>
			<label for="suma">&nbsp;Suma: <?php echo $a;?> + <?php echo $b;?>  </label>
			<input class="default" title="Ingrese la suma de <?php echo $a;?> + <?php echo $b;?>" id="suma" name="suma" style="width:150px; display:inline-block; " /> 
		<a class="submit-btn submit" style=" display:inline-block; position:relative; left:70px; top:-32px; cursor:pointer;margin-left:145px; width:150px !important; font-size:16px; text-align:center; background-color:#0142AA; border-radius:4px; color:#fff; font-weight:bold; padding-top:7px; width:70px; height:28px; display:block;">ENVIAR</a>           
		</p>
</form> 
</div>
 <div class="area2_i_info" style="width:350px; float:right;">
     <p class="parag">
 Autopista Trapiche Chillón Mz. s/n Lt. 73-2<br />Los Huertos de Tungasuca - Carabayllo ,<br /> Lima - Perú<br /><br />
TELÉFONO: (51-1) 613-9090 <br />FAX: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(51-1) 613-9091<br />
CORREO: <a class="tx_mas" href="mailto:ventas@anypsa.com.pe">venta@anypsa.com.pe</a><br /><br /></a>
 <img style="float:right; position:relative; " src="https://chart.googleapis.com/chart?chs=170x170&cht=qr&chl=http%3A%2F%2Fwww.anypsa.com.pe%2F&choe=UTF-8" title="Link a ANYPSA PERÚ S.A." /> 
 
</p>
<p>
<div id='response' class='alert alert-success'></div>
<?php //echo $_SESSION['error_contactanos'];?>
</p>  
</div>
</div>

<div class="content contact_cotization" id="contact_cotization" style="margin-top:15px; display:block;">
CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />CONTENIDO DE COTIZACIÓN<br />
</div>
<div class="content contact_consulta_tecnica" id="contact_consulta_tecnica" style="margin-top:15px;">
CONTENIDO DE CONSULTA TÉCNICA
</div>
</p>
</div>

<div id="gmapa"></div>
<div style="clear:both;"></div>

  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
var egglabs = new google.maps.LatLng(-11.892054296608533, -77.04601962995912);
var mapCoordinates = new google.maps.LatLng(-11.892054296608533, -77.04601962995912);


var markers = [];
var image = new google.maps.MarkerImage(
    '<?php echo HTML_PATH_IMAGES;?>logo_map.jpg',
    new google.maps.Size(84,56),
    new google.maps.Point(0,0),
    new google.maps.Point(42,56)
  );

function addMarker() 
{
      markers.push(new google.maps.Marker({
      position: egglabs,
      raiseOnDrag: false,
	  icon: image,
      map: map,
      draggable: false
      }));
      
}

function initialize() {
  var mapOptions = {
	backgroundColor: "#ffffff",
    zoom: 15,
	scrollwheel: false,
	disableDefaultUI: false,
    center: mapCoordinates,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
	styles: [
			  {
			    "featureType": "landscape.natural",
			    "elementType": "geometry.fill",
			    "stylers": [
			      { "color": "#ffffff" }
			    ]
			  },
			  {
				    "featureType": "landscape.man_made",
				    "stylers": [
				      { "color": "#ffffff" },
				      { "visibility": "off" }
				    ]
			  },
			  {
				    "featureType": "water",
				    "stylers": [
				       { "color": "#80C8E5" },
				      { "saturation": 0 }
				    ]
			  },
			  {
				    "featureType": "road.arterial",
				    "elementType": "geometry",
				    "stylers": [
				      { "color": "#999999" }
				    ]
			  }
			 ,{
				    "elementType": "labels.text.stroke",
				    "stylers": [
				      { "visibility": "off" }
				    ]
			  }
				,{
				    "elementType": "labels.text",
				    "stylers": [
				      { "color": "#333333" }
				    ]
				  }
				
				,{
				    "featureType": "road.local",
				    "stylers": [
				      { "color": "#dedede" }
				    ]
				  }
				,{
				    "featureType": "road.local",
				    "elementType": "labels.text",
				    "stylers": [
				      { "color": "#666666" }
				    ]
				  }
				,{
				    "featureType": "transit.station.bus",
				    "stylers": [
				      { "saturation": -57 }
				    ]
				  }
				,{
				    "featureType": "road.highway",
				    "elementType": "labels.icon",
				    "stylers": [
				      { "visibility": "off" }
				    ]
				  },{
				    "featureType": "poi",
				    "stylers": [
				      { "visibility": "off" }
				    ]
				  }
			
			]
    
  };
map = new google.maps.Map(document.getElementById('gmapa'),mapOptions);
addMarker();
 
}
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
<script src="<?php echo HTML_PATH_JS;?>contactenos_animation.js"></script>
<!--
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=es"></script>
<script type="text/javascript" src="<?php echo HTML_PATH_JS;?>gmap3.min.js"></script>
<script>
$(document).ready(function() {
//gmaps googlemaps	
$("#gmapa").gmap3({
  map:{
    options:{
      center:[-11.892054296608533,-77.04601962995912],
      zoom: 15,
	  streetViewControl: true
    }
  },
  marker:{
    
      latLng:[-11.892054296608533, -77.04601962995912], data:"<b>ANYPSA PERÚ S.A.</b>",
    options:{
      draggable: false
    },
    events:{
      mouseover: function(marker, event, context){
        var map = $(this).gmap3("get"),
          infowindow = $(this).gmap3({get:{name:"infowindow"}});
        if (infowindow){
          infowindow.open(map, marker);
          infowindow.setContent(context.data);
        } else {
          $(this).gmap3({
            infowindow:{
              anchor:marker, 
              options:{content: context.data}
            }
          });
        }
      },
      mouseout: function(){
        var infowindow = $(this).gmap3({get:{name:"infowindow"}});
        if (infowindow){
          infowindow.close();
        }
      }
    }
  }
});
-->
<!--
/*

var fenway = new google.maps.LatLng(-11.892054296608533,-77.04601962995912);
			$('#gmapa').gmap3({
			 map: {
				 options: {
				 center: [-11.892054296608533,-77.04601962995912],
				 streetViewControl: true,
				 center: fenway,
				  mapTypeId: google.maps.MapTypeId.ROADMAP,  
				  maxZoom: 16 ,
				  disableDefaultUI:true,
				   styles: [
					{
					  featureType: "road",
					  elementType: "geometry",
					  stylers: [
						{ hue: "#0041a6" },
						{ saturation: 100 },
						{ lightness: 1 },
						{ gamma: 1 }
					  ]
					}],
				}  
			 }/*,    
  streetviewpanorama:{
    options:{
      container: $(document.createElement("div")).addClass("googlemap").insertAfter($("#gmapa")),
      opts:{
        position: fenway,
        pov: {
          heading: 34,
          pitch: 10,
          zoom: 1
        }
      }
    }
  }*/
	/*		 ,
			 marker:{
				 latLng: [-11.892054296608533,-77.04601962995912],
				 options: {
					  draggable: false
					 				 
				/*icon: new google.maps.MarkerImage(
				   "<?php echo HTML_PATH_IMAGES;?>edificio.jpg",
				   new google.maps.Size(100, 120, "px", "px")
				 )*/
			/*	} ,
    events:{
      mouseover: function(marker, event, context){
        var map = $(this).gmap3("get"),
          infowindow = $(this).gmap3({get:{name:"infowindow"}});
        if (infowindow){
          infowindow.open(map, marker);
          infowindow.setContent(context.data);
        } else {
          $(this).gmap3({
            infowindow:{
              anchor:marker, 
              options:{content: context.data}
            }
          });
        }
      },
      mouseout: function(){
        var infowindow = $(this).gmap3({get:{name:"infowindow"}});
        if (infowindow){
          infowindow.close();
        }
      }
    }
			 }/*,trafficlayer:{}*/
	/*	},
			"autofit" );
			*/
});
</script>-->