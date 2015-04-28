<?php
include(APP_ROOT.'app/layouts/head.php');
?>
<!--CDN links for the latest TweenLite, CSSPlugin, and EasePack-->
<script src="<?php echo HTML_PATH_JS;?>TweenMax.min.js"></script>
<script src="<?php echo HTML_PATH_JS;?>CSSRulePlugin.min.js"></script>
<script src="<?php echo HTML_PATH_JS;?>RaphaelPlugin.min.js"></script>
<script src="<?php echo HTML_PATH_JS;?>ColorPropsPlugin.min.js"></script>
<script src="<?php echo HTML_PATH_JS;?>EaselPlugin.min.js"></script>
<script src="<?php echo HTML_PATH_JS;?>TextPlugin.min.js"></script>
<!--CDN links for the latest TweenLite, CSSPlugin, and EasePack END -->
<style>
#anpayintro{ border:1px solid #ccc; width:220px; height:350px;}
#bg_gaseosa{ background-color:transparent; width:210px; height:300px; position:relative; top:-340px; left:-40px; opacity:0; -moz-opacity: 0;  filter: alpha(opacity=0); visibility:hidden;  z-index:1; cursor:pointer;}
#gaseosa{ cursor:pointer; position:relative; z-index:1;}
.bkt-product__arrow {
   background:url("<?php echo HTML_PATH_IMAGES;?>details-flip.png") no-repeat scroll right top transparent;;
    height: 100px;
  position: relative;
    left: -130px;
    top: -600px;
    width: 188px;
    z-index: 25;
	opacity:0;
}
</style>
<div style="margin:0 auto; max-width:940px; padding:0;">
<div id="anpayintro">
<div id="contieneimagengaseosa">
<img id="gaseosa" src="<?php echo HTML_PATH_IMAGES;?>gaseosa.png" />
</div>
<div id="bg_gaseosa"><img src="<?php echo HTML_PATH_IMAGES;?>drops1.png" /></div>
<div class="bkt-product__arrow"></div>
</div>
</div>
<script>
function randomBetween(min, max) {
    if (min < 0) {
        return min + Math.random() * (Math.abs(min)+max);
    }else {
        return min + Math.random() * max;
    }
}
//TweenMax.to(gaseosa, 1, {opacity:0, repeat:-1, yoyo:true});


$( function(){
TweenMax.to($("#bg_gaseosa"), 0.1, {scale:0, autoAlpha:0});
});
$('#gaseosa').hover( function(){
var gaseosa = $(this);
var textArray = ['drops1.png','drops2.png','drops3.png','drops4.png'];
var randomNumber = Math.floor(Math.random()*textArray.length);
var rz = randomBetween(-15,15);
TweenLite.to(gaseosa, 0.3, {transform:"rotateX(0deg) rotateZ("+rz+"deg)",height:"415px"});
TweenMax.to($("#bg_gaseosa"), 0.3, {scale:0.8, autoAlpha:1,backgroundImage:"url('<?php echo HTML_PATH_IMAGES;?>"+textArray[randomNumber]+"')", ease:Elastic.easeInOut});
 TweenMax.to($(".bkt-product__arrow"), 0.3, {scale:1.1, autoAlpha:1,ease:Elastic.easeInOut});
	}, function(){
TweenLite.to(gaseosa, 0.3, {transform:"rotateX(0deg) rotateZ(0deg)",height:"390px"});
TweenMax.to($("#bg_gaseosa"), 0.3, {scale:0, autoAlpha:0, ease:Elastic.easeInOut});
TweenMax.to($(".bkt-product__arrow"), 0.3, {scale:1, autoAlpha:0,ease:Elastic.easeOutBack});
		});
</script>