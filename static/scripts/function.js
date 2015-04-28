
function viewFla(ruta,ancho,alto)
{	document.write("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='" + ancho + "' height='" +  alto + "'>");
    document.write("<param name='movie' value='" + ruta + "'>");
    document.write("<param name='quality' value='high'>");
    document.write("<param name='wmode' value='transparent'>");
    document.write("<embed src='" + ruta + "' quality='high' wmode='transparent' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='" + ancho + "' height='" +  alto + "'></embed>");
    document.write("</object>");
}

function OpenSubmenu(sec) {
	if (document.getElementById(sec).style.display=="none")
	{
		//CierraSubMenus();
		document.getElementById(sec).style.display="";
	}
	else {document.getElementById(sec).style.display="none"}
}

function CierraSubMenu(sec){
	if (sec.style.display!="none") {sec.style.display="none"}
}

function CierraSubMenus(){
	for (x=0; x<T; x++) {
		sec = "sec";
		sec = eval("sec = sec" + x);
		CierraSubMenu(sec);
	}
}
function reloadCaptcha() {  
    document.images.captcha.src = "captcha.php?shadow=" + new Date().getSeconds(); 
}  

/*
*Esta libreria es una libreria AJAX creada por Javier Mellado con la inestimable
*colaboracion de Beatriz Gonzalez.
*descargada del portal AJAX Hispano http://www.ajaxhispano.com
*contacto javiermellado@gmail.com
*
*Puede ser utilizada, pasada, modificada pero no olvides mantener 
*el espiritu del software libre y respeta GNU-GPL
*/

function creaAjax(){
  var objetoAjax=false;
  try {
   /*Para navegadores distintos a internet explorer*/
   objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
   try {
     /*Para explorer*/
     objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
     } 
     catch (E) {
     objetoAjax = false;
   }
  }

  if (!objetoAjax && typeof XMLHttpRequest!='undefined') {
   objetoAjax = new XMLHttpRequest();
  }
  return objetoAjax;
}

 function FAjax (url,capa,valores,metodo)
{
   var ajax=creaAjax();
   var capaContenedora = document.getElementById(capa);

/*Creamos y ejecutamos la instancia si el metodo elegido es POST*/
 if(metodo.toUpperCase()=='POST'){
        document.write="hola pepe";
    ajax.open ('POST', url, true);
    ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                 capaContenedora.innerHTML="<img src=\"data/images/ajax-loader.gif\">";
         }
         else if (ajax.readyState==4){
            if(ajax.status==200)
            {
                 document.getElementById(capa).innerHTML=ajax.responseText; 
            }
            else if(ajax.status==404)
                 {

                     capaContenedora.innerHTML = "La direccion existe";
                 }
             else
                 {
                     capaContenedora.innerHTML = "Error: ".ajax.status;
                 }
        }
    }
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send(valores);
    return;
}
/*Creamos y ejecutamos la instancia si el metodo elegido es GET*/
if (metodo.toUpperCase()=='GET'){

    ajax.open ('GET', url, true);
    ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                 capaContenedora.innerHTML="Cargando.......";
         }
         else if (ajax.readyState==4){
            if(ajax.status==200){ 
                 document.getElementById(capa).innerHTML=ajax.responseText; 
            }
            else if(ajax.status==404)
                 {

                     capaContenedora.innerHTML = "La direccion existe";
                 }
                 else
                 {
                     capaContenedora.innerHTML = "Error: ".ajax.status;
                 }
        }
    }
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.send(null);
    return
}
}

