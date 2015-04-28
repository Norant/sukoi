<div id="x"><img src="http://localhost/anypsa/static/images/simulador/techo.png" usemap="#Map" border="0" />
  <map name="Map" id="Map">
    <area shape="poly" coords="45,57" href="#" />
    <area shape="poly" coords="4,16,124,47,167,37,169,31,184,33,261,19,292,40,357,30,360,4,5,3" href="#" id="x1" />
    <area shape="poly" coords="46,132,51,85,187,93,158,156" href="#" id="y" />
  </map>
</div>

<style>
#xx{background-color:white;}
</style>

<div id="simulador">
<h4>SIMULADOR DE AMBIENTES</h4>
<div id="canvas"><img src="<?php echo HTML_PATH_IMAGES; ?>simulador/claro.png" />
<div id="techo"><img src="<?php echo HTML_PATH_IMAGES; ?>simulador/techo.png" /></div>
</div>
<a href="#" id="changecolor">Cambiar</a>
</div>
 <div id="colorpicker"></div>
<script>
$(function(){		
	TweenLite.to("#y", 1, {css:{top:"20px", backgroundColor:"#e6b559"}, ease:Power2.easeOut});
	$('#changecolor').click( function(){	
		});
	});
</script>
