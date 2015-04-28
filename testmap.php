<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script src="http://localhost/sukoi/static/scripts/jquery-1.7.2.min.js"></script>
   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
   <script>
 function initialize() {
	 var latitud = -12.07713366461836;
	 var longitud = -77.035826199913;
        var latlng = new google.maps.LatLng(latitud, longitud);
        var settings = {
            zoom: 14,
            center: latlng,
            mapTypeControl: true,
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
            navigationControl: true,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
            mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
			var companyPos = new google.maps.LatLng(latitud, longitud);
		  var companyMarker = new google.maps.Marker({
			   draggable: true,
 			   position: latlng, 
			   position: companyPos,
			   map: map,
			   title:"Ubica el puntero en el lugar de la sede"
		  });
		  google.maps.event.addListener(companyMarker, 'dragend', function (event) {
			document.getElementById("latbox").value = this.getPosition().lat();
			document.getElementById("lngbox").value = this.getPosition().lng();
				});
			};
$(document).ready(function(e) {
    initialize();
});
   </script>   

<body>
  <div id="map_canvas" style="width:500px; height:300px"></div>
  <div id="latlong">
    <p>Latitud: <input size="20" type="text" id="latbox" name="lat" ></p>
    <p>Longitud: <input size="20" type="text" id="lngbox" name="lng" ></p>
  </div>
</body>
</html>