<?php
class Html{
	public static function agregarCss($filecss,$rel = "stylesheet",$type = "text/css", $media=""){
		if ($media != ""){ $media = "media=\"".$media."\"";}
		$rel = "stylesheet";
		$type = "text/css";
	$css = "<link href=\"".HTML_PATH_CSS.$filecss."\" rel=\"".$rel."\" type=\"".$type."\" ".$media." />\n";
		echo $css;
		}
	
	public static function agregarJs($filejs){
		$js = "<script type=\"text/javascript\" src=\"".HTML_PATH_JS.$filejs."\"></script>\n";
		echo $js;
		}
	}
	