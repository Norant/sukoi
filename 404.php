<?php //header("HTTP/1.1 404 Not Found"); 
require_once("configs/web.config.php");
require_once("library/security.php");
$yourdomain = HTML_PATH;
$oldref = $_SERVER['HTTP_REFERER'];
@mail('administrador@anypsa.com.pe', 'error 404: '
   .$_SERVER['REMOTE_ADDR'],'http://'.$yourdomain.' ERROR: '.$_SESSION['catch exception'].' '.$_SERVER['REMOTE_ADDR'].' at http://'.$yourdomain.$_SERVER['REQUEST_URI'].' from '.$oldref.' agent '.$_SERVER['HTTP_USER_AGENT'].' '
   , "From: ".$yourdomain."\n");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow">
<noscript>
<p>Activa javascript</p>
</noscript>
<script type="text/javascript">
count=5;
function countdown() 
	{
		if (count > 0)
		{
			count--;
			if(count == 0)
			{
				window.location="<?php echo $yourdomain;?>"; 
			}
			if(count > 0)
			{
				document.getElementById("countdown").innerHTML = count;
				setTimeout('countdown()',1000);
				 
			}
		}
	}
</script>
</head>
<body onLoad="countdown();">
<div class="error-404" align="center"><br /><br /><br /><h3>Ha ocurrido un error</h3><br /><br />
<noscript>
   Error: no tienes javascript activado.
</noscript>
</div>
<div align="center" style="width:auto; margin: 0 auto;">
<img src="404.jpg" />
<div class="error-404">Serás redireccionado en 
<div style="font-size:24px; font-weight: bold; font-family: arial;" id="countdown">&nbsp;</div> segundos</div>
</div>
</body>
</html>