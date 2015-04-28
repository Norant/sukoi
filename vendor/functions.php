<?php
/* Archivo: functions.php
* Funciones usadas para el funcionamiento de todo el sitio.
*/
require(APP_ROOT_CLASES."class.phpmailer.php"); 

/*	
* @return string aleatorio
* @desc funcion que genera string aleatorio
* @autor noranterry@gmail.com
*/	
  function randomText($length) 
  {
	  $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
	  for($i=0;$i<$length;$i++) {
		$key .= $pattern{mt_rand(0,35)};
	  }
	  return $key;
  }


//*****************************************************************************************************
//*********************************************FUNCIONES DE CONEXION BASE DE DATOS*********************
//*****************************************************************************************************


/** @return void
*  @desc Abre una conexión con el servidor mysql.*/
/*------------------------------------------------------------------- */
function conn_abre ()
{
	global $conexion;
	$conexion=@mysql_pconnect(DB_SERVER, DB_USER, DB_PASS);
	@mysql_select_db(DB_NAME,$conexion);
}


/** @return void
*  @desc Cierra la conexión con el servidor mysql.*/
/*------------------------------------------------------------------- */
function conn_cierra ()
{
	global $conexion;
	@mysql_close($conexion);
}


/** @return array()
*  @param string $sql
*  @desc Ejecuta una consulta y devuelve el resultado. */
/*------------------------------------------------------------------- */
function conn_consulta ($sql)
{
	conn_abre();

	$rs = @mysql_query($sql);
	$fila = @mysql_fetch_array($rs);

	@mysql_free_result($rs);

	conn_cierra();

	return $fila;
}



/** @return void
*  @param string $sql
*  @desc Ejecuta un query en la base de datos. */
/*------------------------------------------------------------------- */
function conn_ejecuta ($sql)
{
	conn_abre();								//Abrimos la conexión

	@mysql_query($sql);							//Ejemcutamos query


	if (strpos($sql, "insert") !== false) {		//Devolvemos id insertado o filas afectadas.
	return (@mysql_insert_id());
	}
	else {
		return (@mysql_affected_rows());
	}
	conn_cierra();								//Cerramos la conexión
}

/*****************************/
function conn_array ($sql)
{
	conn_abre();
	$rs = mysql_query($sql) or die("MySQL Error:" . mysql_error() .  "<br><br>ERROR EN SQL: " . $sql);
	$matriz = array();												//Creamos el array
	while ($fila = mysql_fetch_array($rs)){
		$matriz[] = $fila;
	}
//	$fila = mysql_fetch_array($rs);
	conn_cierra();
	return $matriz;
}


/*****************************/
function conn_columna ($sql)
{
	conn_abre();
	$rs = mysql_query($sql) or die("MySQL Error:" . mysql_error() .  "<br><br>ERROR EN SQL: " . $sql);
	$matriz = array();												//Creamos el array
	while ($fila = mysql_fetch_array($rs)){
		$matriz[] = $fila[0];
	}
//	$fila = mysql_fetch_array($rs);
	conn_cierra();
	return $matriz;
}

/**------------------------------------------------------------------- */
/**
 * @return array()
 * @param string $tabla
 * @param string $columna
 * @desc Extra una columna entera de la tabla.
*/
function conn_extrae_columna($tabla, $columna, $orden = null, $direccion = "ASC")
{
	if (empty($orden)) 
		$orden = $columna;
		
	$sql = "SELECT * FROM ".$tabla." ORDER BY ".$orden." ".$direccion;
		
	conn_abre();

	$rs = mysql_query($sql);

	$matriz = array();
	$matriz2 = array();

	while ($fila = mysql_fetch_array($rs))
		$matriz[] = $fila[$columna];
	
	conn_cierra();
	return $matriz;
}

/**
* @return $campo
* @param string $tabla
* @param string $campo
* @param string $valor
* @desc Función para obtener un campo de un registro mediante su llave.

	$campos[0]="date_fecha";
	$campos[1]="2006-06-24";
	$campos[2]="txt_ciudad";
	$campos[3]="Moyobamba";		
	$valor=conn_obtiene_campo_condicion("tbl_diario", $campos, "pk_diario");
**/
/*------------------------------------------------------------------- */
function conn_obtiene_campo_condicion($tabla, $campos, $valor)
{

	$sql = "SELECT * FROM ".$tabla." WHERE ";	
	
	$k=0;
	$total_campos=(int)count($campos)/2;
	
	for($i=0;$i<$total_campos;$i++)
	{
	  $sql=$sql." ".$campos[$k]." = '".$campos[$k+1]."' ";	  
	  $k=$k+2;	
	  if(($total_campos-1)>$i)
	  {
	  	$sql=$sql." and ";
	  }
	  
	}
	
	conn_abre();

	$rs = mysql_query($sql);

	if(mysql_num_rows($rs) >= 1){
		while ($row = mysql_fetch_array($rs)) 
		{
			conn_cierra();
			return $row[$valor];
		}	
	}
	
	
	
}


//*****************************************************************************************************
//*********************************************FUNCIONES DE CADENAS************************************
//*****************************************************************************************************
/** @return string
*  @param string $str
*  @desc Convierte la primera letra a mayuscula y el resto a minuscula
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_convierte_primera_letra_mayuscula($str)
{
	$str = ucfirst(strtolower(trim($str)));
	return $str;
}
/** @return string
*  @param string $str
*  @desc Reemplaza los espacios en blanco por -
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_agregar_barra($str)
{
	for($i=0;$i<$cant;$i++)
	{
			$cad=$cad."&nbsp;";
	}
	return $str;
}
/** @return string
*  @param string $p_cadena
*  @desc Convierte las primeras letras de un texto en Mayusculas 
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_completar_blancos($cant)
{
	$cad="";
	for($i=0;$i<$cant;$i++)
	{
			$cad=$cad."&nbsp;";
	}
	return $cad;
}

/** @return string
*  @param string $p_cadena
*  @desc Convierte las primeras letras de un texto en Mayusculas 
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_primer_parrafo_mayuscula($p_cadena)
{
	$cadena=trim($p_cadena);
	$cadena=strtolower($cadena);		
	$palabras = explode(" ", $cadena); //Partimos la cadena en palabras
	
	$primerparrafo=ucwords($palabras[0]);
	$texto="";
	for($i=1;$i<count($palabras);$i++)
	{
		$texto=$texto.$palabras[$i]." ";
	}
	
	$texto=$primerparrafo." ".$texto;
	return $texto;
}



/** @return string
*  @param string $p_cadena
*  @desc Convierte las primeras letras de un texto en Mayusculas 
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_primeras_letras_mayuscula($p_cadena)
{
	$cadena=trim($p_cadena);
	$cadena=strtolower($cadena);	
	$cadena=ucwords($cadena);
	return $cadena;
}
/** @return string
*  @param string $p_cadena
*  @desc Devuelve una cadena de caracteres en minusculas. 
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_convierte_minuscula($p_cadena)
{
	$cadena=trim($p_cadena);	
	$cadena=strtolower($cadena);
	return $cadena;
}

/** @return string
*  @param string $p_cadena
*  @desc Devuelve una cadena de caracteres en mayusculas. 
*  Autor : Mario Alejandro Gonzales Flores*/
/*------------------------------------------------------------------- */
function inc_convierte_mayuscula($p_cadena)
{
	$cadena=trim($p_cadena);	
	$cadena=strtoupper($cadena);
	return $cadena;
}

/** @return string
*  @param string $p_mensaje
*  @desc reeemplaza caracteres especiales tildes, ñ, etc y los reemplaza por el contenido estandar
*  Autor : Mario Alejandro Gonzales Flores */
/*------------------------------------------------------------------- */
function inc_renombra_imagen($p_mensaje)
{
	$p_mensaje=str_replace(" ","",$p_mensaje);		
		$p_mensaje=str_replace("/","_",$p_mensaje);		
	return $p_mensaje;	
}

/** @return string
*  @param string $p_mensaje
*  @desc reeemplaza caracteres especiales tildes, ñ, etc y los reemplaza por el contenido estandar
*  Autor : Mario Alejandro Gonzales Flores */
/*------------------------------------------------------------------- */
function inc_caracteres_especiales_get($p_mensaje)
{
	$p_mensaje=str_replace("á","a",$p_mensaje);	
	$p_mensaje=str_replace("Á","a",$p_mensaje);			
	$p_mensaje=str_replace("é","e",$p_mensaje);	
	$p_mensaje=str_replace("É","e",$p_mensaje);			
	$p_mensaje=str_replace("í","i",$p_mensaje);	
	$p_mensaje=str_replace("Í","i",$p_mensaje);			
	$p_mensaje=str_replace("ó","o",$p_mensaje);	
	$p_mensaje=str_replace("Ó","o",$p_mensaje);			
	$p_mensaje=str_replace("ú","u",$p_mensaje);	
	$p_mensaje=str_replace("Ú","u",$p_mensaje);		
	$p_mensaje=str_replace("Ñ"," n",$p_mensaje);			
	$p_mensaje=str_replace("ñ","n",$p_mensaje);			
	$p_mensaje=str_replace("¿","_",$p_mensaje);				
	$p_mensaje=str_replace('\"',"",$p_mensaje);					
	$p_mensaje=str_replace('\'',"",$p_mensaje);
	$p_mensaje=str_replace(':',"",$p_mensaje);
	
	return $p_mensaje;	
}
/** @return string
*  @param string $cadena
*  @desc cambia el formato de una cadena para mostrarlo como url amigable
*  Autor : Mario Alejandro Gonzales Flores */

function strtolower_utf8($string) {

$result = utf8_decode($string);
$result = strtolower($result);
$result = utf8_encode($result);
return $result;

}

function inc_formatea_cadena_get($cadena)
{
$cadena = explode("/",$cadena);
$cadena = str_replace( ' ', '-', $cadena[0]);
$cadena = str_replace('"', '',$cadena);
$cadena = str_replace('\'','',$cadena);
$cadena = strtolower_utf8($cadena);
return $cadena; 
}

/** @return string
*  @param string $p_mensaje
*  @desc reeemplaza caracteres especiales tildes, ñ, etc y los reemplaza por el contenido estandar
*  Autor : Mario Alejandro Gonzales Flores */
/*------------------------------------------------------------------- */
function inc_caracteres_especiales($p_mensaje)
{
	$p_mensaje=str_replace("á","&aacute;",$p_mensaje);	
	$p_mensaje=str_replace("Á","&Aacute;",$p_mensaje);			
	$p_mensaje=str_replace("é","&eacute;",$p_mensaje);	
	$p_mensaje=str_replace("É","&Eacute;",$p_mensaje);			
	$p_mensaje=str_replace("í","&iacute;",$p_mensaje);	
	$p_mensaje=str_replace("Í","&Iacute;",$p_mensaje);			
	$p_mensaje=str_replace("ó","&oacute;",$p_mensaje);	
	$p_mensaje=str_replace("Ó","&Oacute;",$p_mensaje);			
	$p_mensaje=str_replace("ú","&uacute;",$p_mensaje);	
	$p_mensaje=str_replace("Ú","&Uacute;",$p_mensaje);		
	$p_mensaje=str_replace("Ñ","&Ntilde;",$p_mensaje);			
	$p_mensaje=str_replace("ñ","&ntilde;",$p_mensaje);			
	$p_mensaje=str_replace("¿","&iquest;",$p_mensaje);				
	$p_mensaje=str_replace('\"',"&ldquo;",$p_mensaje);					
	$p_mensaje=str_replace('\'',"&#8217;",$p_mensaje);		
	
	return $p_mensaje;	
}


/** @return string
*  @param string $p_cadena
*  @desc reeemplaza caracteres especiales y los escapa. 
*  Autor : Mario Alejandro Gonzales Flores */
/*------------------------------------------------------------------- */
function inc_escapar_caracteres($p_mensaje)
{	
//	$p_mensaje=addslashes($p_mensaje);
	$p_mensaje=str_replace("'","''",$p_mensaje);
	$p_mensaje=str_replace('"','\"',$p_mensaje);
	return $p_mensaje;	
}

function inc_escapar_caracteres2($p_mensaje)
{	
//	$p_mensaje=addslashes($p_mensaje);
	$p_mensaje=str_replace("'","''",$p_mensaje);
	$p_mensaje=str_replace('"','\"',$p_mensaje);
	return $p_mensaje;	
}


function inc_reemplaza_chat($p_mensaje)
{
	$p_mensaje=str_replace("<span style=\"font-family:Times New Roman; font-size:16px; font-style:normal; color: \">","",$p_mensaje);
	$p_mensaje=str_replace("</span>","",$p_mensaje);
	return $p_mensaje;	


}

/**
* @return $string
* @param string $archivo
* @desc Función para extraer la extensión del archivo.
*/
/*------------------------------------------------------------------- */
function inc_saca_extension($archivo) {
	$punto = strrpos($archivo, ".") + 1;
	$extension = substr($archivo, $punto);
	return $extension;
}  


/**
* @return void
* @desc Función para extrar una cantidad determinadas de palabras.
*/
/*------------------------------------------------------------------- */
function inc_saca_descripcion($cadena, $cantidad) {
	$palabras = explode(" ", $cadena); //Partimos la cadena en palabras
	$resultado = "";

	if (count($palabras) < $cantidad) {		//Verificamos que la cantidad de palabras pedidas no sea mayor
		$cantidad = count($palabras) - 1;	//a las que vienen en la cadena, si es así lo corregimos.
	}

	for ($i = 0; $i <= $cantidad; $i++) { //Concatenamos la cantidad de palabras deseadas
		$resultado = $resultado . $palabras[$i] . " ";
	}

	return $resultado."...";	//Devolvemos la cadena formada
}

/**
* @return string
* @desc Función que formatea saltos de un formato de texto a formato html
*/
/*------------------------------------------------------------------- */
function inc_formatea_saltos($texto) {
	$texto = str_replace("\n", "<br />", $texto);
	return $texto;
}

/**
* @return string
* @desc Función que formatea saltos de un formato de texto a formato html
*/
/*------------------------------------------------------------------- */
function inc_formatea_saltos2($texto) {
	$texto = str_replace("<br />", "\n", $texto);
	return $texto;
}
/**
* @return void
* @desc Función para quitar tags htmls de un texto
*/
/*------------------------------------------------------------------- */
function inc_quitahtml($texto) {
	$texto = strip_tags($texto);
	return $texto;
}

/**
* @return void
* @desc Función que verifica si un texto es numerico
*/
/*------------------------------------------------------------------- */
function inc_esnumerico($p_numero)
{
	$bol=true;
	for($i=0;$i<strlen($p_numero);$i++)
	{
			if(!(ord($p_numero[$i])<=57 && ord($p_numero[$i])>=48))
			{ $bol=false; 
			  break;
			}
	}	
	return $bol;
}

/**
* @return void
* @desc Función que devuelve un estado de 1 ó 0 a Si ó no
*/
/*------------------------------------------------------------------- */
function inc_devuelve_estado($p_estado)
{
	if($p_estado==1)
	{ return "Si"; }
	else{
	  return "No";
	}
}

function inc_formato_editor($texto)
{
	
	$texto = str_replace("<p >","<p>",$texto);							  
	$texto = str_replace("<p>","",$texto);
	$texto = str_replace("</p>","",$texto);
	$texto = str_replace("<br /><br />","<br />",$texto);	
	$texto = str_replace("<span style=\"font-size: 10pt\">","",$texto);
	$texto = str_replace("</span>","",$texto);	
	$texto = str_replace("<div>","<br />",$texto);
	$texto = str_replace("</div>","",$texto);		
	$texto = str_replace("<font face=\"ArialMT\" size=\"3\">","",$texto);			
	$texto = str_replace("</font>","",$texto);	
	$texto = str_replace("align=\"left\"","",$texto);		
		

	return $texto;
}

function inc_formato_editor2($texto)
{
	
	$texto = str_replace("</p>","",$texto);							  
	$texto = str_replace("<p>","<br><br>",$texto);
	return $texto;
}

//*****************************************************************************************************
//*********************************************FUNCIONES DE MANEJO DE ARCHIVOS Y CARPETAS**************
//*****************************************************************************************************

/** @return void
*  @param string $file , string ruta, string $pag, array $extensiones_
*  @desc Adjunta un archivo al sistema
*  Autor : Mario Alejandro Gonzales Flores
*/
/*------------------------------------------------------------------- */
function inc_cargar_datos($file,$ruta,$pag="",$extensiones_)
{	
$extensiones=$extensiones_;

	if (isset($_FILES[$file]['name']))
	{ 	// si estoy subiendo el archivo 
		$mensaje ="";
		$nombre=$_FILES[$file]['name'];			
		$var = explode(".",$nombre);
		$num = count($extensiones);
		$valor = $num-1;
		$admitido=false;

		for($i=0; $i<=$valor; $i++) {
			if($extensiones[$i] == $var[1]) {   
				$admitido=true;//es una extension valida
				break;
									}
		}
		
		$error=0;	
		
		if ($admitido)
			   {			   

					$nom1=str_replace(" ","",str_replace('.',"",microtime()));
//					$nombre=str_replace(" ","",inc_convierte_minuscula($nombre));					
//					$nombre = $nom. "." . inc_convierte_minuscula(inc_saca_extension($nombre));		   
					$ext=inc_convierte_minuscula(inc_saca_extension($nombre));		 
//					echo $ext;

//					$nombre = str_replace(".".$ext,"",$nombre)."_".$nom1.".".$ext;		
					$nombre = $nom1.".".$ext;		
//					echo $nombre;					
//					die();  					
					$ruta=$ruta.$nombre; 								   
							if (is_uploaded_file($_FILES[$file]['tmp_name']))
							 {	  
									inc_borrar_archivo($ruta); //borra el archivo en caso exista
									copy($_FILES[$file]['tmp_name'], "$ruta");
									//move_uploaded_file($_FILES[$file]['tmp_name'], "$ruta");
									$archivo = file($ruta);
									return $nombre;
							 }
							else 
							{      $txtmensaje= "Error al subir el archivo. el tamaño del archivo puede ser muy grande";	
									header ("location: $pag?mensaje=$txtmensaje"); 
									die();
							}	
				}
			else 
				{ 
					
					$txtmensaje= "El archivo no tiene el formato necesario "; 
					header ("location: $pag?mensaje=$txtmensaje"); 				
					die();
				}	
	}			
	else
	{
		$txtmensaje = "No se ha podido copiar el archivo al servidor" ; 
		header ("location: $pag?mensaje=$txtmensaje"); 		
		die();
	}
	

}

/**
 * @return void
 * @param void
 * @desc Elimina un archivo deseado
*/
/*------------------------------------------------------------------- */
function inc_borrar_archivo ($ruta)
{
	if($ruta != "")
	{
		if(file_exists($ruta))
		{
			unlink($ruta);
		}
	}
}

/**
 * @return void
 * @param void
 * @desc crea una carpeta
*/
/*------------------------------------------------------------------- */
function inc_crea_carpeta($p_nombre,$p_ruta)						
{	
    if (!file_exists($p_ruta.$p_nombre))
	{	$creo = mkdir($p_ruta.$p_nombre,0777);
		return $creo;	}
	else
	{	return 0 ;}
}


//*****************************************************************************************************
//*********************************************FUNCIONES DE MANEJO DE FECHAS***************************
//*****************************************************************************************************

/**
 * @return texto
 * @param dia, mes, anio
 * @desc funcion que escribe los dias en un combo
*/
/*------------------------------------------------------------------- */
function inc_muestra_dia($p_dia="",$p_mes="",$p_anio="",$titulo="",$idioma="")
{

 if($titulo==0){
	 if($p_dia==""){ $p_dia=date("d");}
 }else{
 	if($idioma==1){
	 	 echo "<option value='' >Day</option>";					   	
	  }else{
		 echo "<option value='' >Dia</option>";					   		  
	  }
 }



 if($p_mes!="" && $p_anio!="" && $p_mes!="00" && $p_anio!="0000")
 {	
	   for($i=1;$i<=inc_retorna_dias($p_mes,$p_anio);$i++)
	   {
			$value=$i; $selected="";
			if($i<10) { $value="0".$i;}
			if($p_dia==$i){ $selected="selected";}							
			echo "<option value='".$value."' ".$selected.">".$i."</option>";					  
	   }
  }else{
  
	   for($i=1;$i<32;$i++)
	   {
			$value=$i; $selected="";
			if($i<10) { $value="0".$i;}		
			if($p_dia==$i){ $selected="selected";}										
			echo "<option value='".$value."' ".$selected.">".$i."</option>";					  
	   }
  
  }
  
}

/**
 * @return texto
 * @param dia, mes, anio
 * @desc funcion que escribe los meses en un combo
*/
/*------------------------------------------------------------------- */

function inc_muestra_mes($p_mes="",$p_formato="",$titulo="")
{

 if($titulo==0){
	if($p_mes==""){ $p_mes=date("m"); }
 }else{
 	if($p_formato>2){
	 	 echo "<option value='' >Month</option>";					   	
	  }else{
		 echo "<option value='' >Mes</option>";					   		  
	  }
 }


 for($i=1;$i<=12;$i++)
   {
    	$value=$i; $selected="";
		if($i<10) { $value="0".$i;}
		if($p_mes==$i){ $selected="selected";}							
        echo "<option value='".$value."' ".$selected.">".inc_nombre_mes($i,$p_formato)."</option>";					  
   }
}

/**
 * @return texto
 * @param dia, mes, anio
 * @desc funcion que escribe los años en un combo
*/
/*------------------------------------------------------------------- */

function inc_muestra_anio($p_anio,$p_ini,$p_final,$titulo,$idioma)
{

 if($titulo==0){
	if($p_anio==""){ $p_anio=date("Y"); }
 }else{
 	if($idioma==1){
	 	 echo "<option value='' >Year</option>";					   	
	  }else{
		 echo "<option value='' >Año</option>";					   		  
	  }
 }
  
 for($i=$p_ini;$i<=$p_final;$i++)
   {
	    $selected="";
		if($p_anio==$i){ $selected="selected";}							
        echo "<option value='".$i."' ".$selected.">".$i."</option>";					  
   }
   
}

/**
 * @return texto
 * @param dia, mes, anio
 * @desc funcion que retorna los nombres de un mes segun el idioma
*/
/*------------------------------------------------------------------- */
function inc_nombre_mes($p_mes,$p_formato)
{

   switch ($p_mes)
	 	{			case 1 : $mes_esp = "Januar" ; $mes_esp_a="Ene"; $mes_eng="January"; $mes_eng_a="Jan"; break;
					case 2 : $mes_esp = "Februar" ; $mes_esp_a="Feb"; $mes_eng="February"; $mes_eng_a="Feb"; break;
					case 3 : $mes_esp = "März" ; $mes_esp_a="Mar"; $mes_eng="March"; $mes_eng_a="Mar"; break;
					case 4 : $mes_esp = "April" ; $mes_esp_a="Abr"; $mes_eng="April"; $mes_eng_a="Apr"; break;
					case 5 : $mes_esp = "Mai" ; $mes_esp_a="May"; $mes_eng="May"; $mes_eng_a="May"; break;
					case 6 : $mes_esp = "Juni" ; $mes_esp_a="Jun"; $mes_eng="June"; $mes_eng_a="Jun"; break;
					case 7 : $mes_esp = "Juli" ; $mes_esp_a="Jul"; $mes_eng="July"; $mes_eng_a="Jul"; break;
					case 8 : $mes_esp = "August" ; $mes_esp_a="Ago"; $mes_eng="August"; $mes_eng_a="Aug"; break;															
					case 9 : $mes_esp = "September" ; $mes_esp_a="Sep"; $mes_eng="September"; $mes_eng_a="Sep"; break;															
					case 10 : $mes_esp = "Oktober" ; $mes_esp_a="Oct"; $mes_eng="October"; $mes_eng_a="Oct"; break;															
					case 11 : $mes_esp = "November" ; $mes_esp_a="Nov"; $mes_eng="November"; $mes_eng_a="Nov"; break;															
					case 12 : $mes_esp = "Dezember" ; $mes_esp_a="Dic"; $mes_eng="December"; $mes_eng_a="Dec"; break;															
															
		}
		
	switch($p_formato)
	{
	         case 1 : $mes=$mes_eng; break;//January
	         case 2 : $mes=$mes_esp; break;//Enerox
	         case 3 : $mes=$mes_eng_a;	break;//Jan		  			 			 			 
	         case 4 : $mes=$mes_esp_a; break;//Enex
			 
	}	
		
		return $mes;
}


/**
 * @return texto
 * @param dia, mes, anio
 * @desc funcion que retorna los nombres de los dias
*/
/*------------------------------------------------------------------- */
function inc_nombre_dia($p_dia,$p_formato)
{

   switch ($p_dia)
	 	{	
					case 0 : $dia_esp = "Domingo" ; $dia_esp_a="Dom"; $dia_eng="Sunday"; $dia_eng_a="Sun"; break;
					case 1 : $dia_esp = "Lunes" ; $dia_esp_a="Lun"; $dia_eng="Monday"; $dia_eng_a="Mon"; break;
					case 2 : $dia_esp = "Martes" ; $dia_esp_a="Mar"; $dia_eng="Tuesday"; $dia_eng_a="Tue"; break;
					case 3 : $dia_esp = "Miercoles" ; $dia_esp_a="Mie"; $dia_eng="Wednesday"; $dia_eng_a="Wed"; break;
					case 4 : $dia_esp = "Jueves" ; $dia_esp_a="Jue"; $dia_eng="Thursday"; $dia_eng_a="Thu"; break;
					case 5 : $dia_esp = "Viernes" ; $dia_esp_a="Vie"; $dia_eng="Friday"; $dia_eng_a="Fri"; break;
					case 6 : $dia_esp = "Sabado" ; $dia_esp_a="Sab"; $dia_eng="Saturday"; $dia_eng_a="Sat"; break;

															
		}
		
	switch($p_formato)
	{
	         case 1 : $dia=$dia_esp; break;//Enero
	         case 2 : $dia=$dia_esp_a; break;//Ene
	         case 3 : $dia=$dia_eng; break;//January
	         case 4 : $dia=$dia_eng_a;	break;//Jan		  			 			 
	}	
		
		return $dia;
}


/**
 * @return numero de dias
 * @param mes, anio
 * @desc funcion que retorna el numero de dias del mes, dependiendo del año 
*/
/*------------------------------------------------------------------- */
function inc_retorna_dias($p_mes,$p_anio)
{
	switch($p_mes)
	{
		case "1" :  $mes=31;   break;
		case "2" :  
					if(($p_anio%4==0) || ($p_anio%400==0 && $p_anio%100==0))
					{
						$mes=29;   
					}
					else
					{
						$mes=28;   
					}
					break;
					
		case "3" :  $mes=31;   break;
		case "4" :  $mes=30;   break;
		case "5" :  $mes=31;   break;
		case "6" :  $mes=30;   break;
		case "7" :  $mes=31;   break;
		case "8" :  $mes=31;   break;
		case "9" :  $mes=30;   break;
		case "10" : $mes=31;   break;
		case "11" :	$mes=30;   break;
		case "12" :	$mes=31;   break;
	}
	return $mes;
}

/**
 * @return numero de dias
 * @param fecha1, fecha2
 * @desc obtiene la diferencia de en dias entre dos fechas
*/
/*------------------------------------------------------------------- */
function inc_resta_fechas($fecha1,$fecha2)
{
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
          list($anio1,$mes1,$dia1)=split("-",$fecha1);     	  
           
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
          list($anio2,$mes2,$dia2)=split("-",$fecha2);	  
     
	    $dif = mktime(0,0,0,$mes1,$dia1,$anio1) - mktime(0,0,0,$mes2,$dia2,$anio2);
        $ndias=abs(floor($dif/(24*60*60)));
        return($ndias);             
}

/**------------------------------------------------------------------- */
/**
 * @return string
 * @param string $fecha
 * @desc Obtiene el dia de la semana
*/
function inc_obtiene_dia_semana($fecha,$formato){

	$anno = substr($fecha, 0, 4);
	$mes = substr($fecha, 5, 2);
	$dia =  substr($fecha, 8, 2);

	$n_dia = date('w', mktime(0,0,0,$mes,$dia,$anno));
		
	$dia=inc_nombre_dia($n_dia,$formato);	
	return $dia;	
}

/*
* @return int
* @desc Obtiene el número de años dada una fecha.
*/
/*------------------------------------------------------------------- */	
function inc_obtiene_edad($fecha)
{
	//Datos fecha actual
	$anno_actual = date('Y');
	$mes_actual = date('m');
	$dia_actual = date('d');
		
	//Datos fecha dada
	$anno = substr($fecha, 0, 4);
	$mes = substr($fecha, 5, 2);
	$dia =  substr($fecha, 8, 2);

	//Obtiene la edad
	if($anno_actual > $anno)  
	{
		if($mes_actual >= $mes)
		{
			if($dia_actual >= $dia)
				$edad = $anno_actual - $anno;
			else
				$edad = ($anno_actual - $anno) - 1;
		}
		else 	
			$edad = ($anno_actual - $anno) - 1;
	}
	else
		$edad = 0;
		
	return $edad;
}


/* Obtiene las horas:minutos:segundos entre dos horas dadas */
/*************************************************/
function inc_diferencia_horas($hora1, $hora2){

	if($hora1<$hora2)
	{
		$hora3=$hora2;
		$hora2=$hora1;
		$hora1=$hora3;
	
	}
	//Extrae los datos (horas:minutos:segundos) de hora1
	$h1 = substr($hora1, 0, 2); 
	$m1 = substr($hora1, 3, 2); 
	$s1 = substr($hora1, 6, 2); 
	//Extrae los datos (horas:minutos:segundos) de hora2
	$h2 = substr($hora2, 0, 2); 
	$m2 = substr($hora2, 3, 2); 
	$s2 = substr($hora2, 6, 2); 
	if($s1>=$s2) {
		$s3 = $s1 - $s2;
		if($m1>=$m2) {
			$m3 = $m1 - $m2;
			$h3 = $h1 -  $h2;
		}
		else { 	
			$m3 = $m1 + (60-$m2);
			$h3 = $h1 -  $h2 - 1;
		}
	}
	else {
		$s3 = $s1 + (60-$s2);
		if($m1>=$m2) {
			$m3 = $m1 - $m2 - 1;
			$h3 = $h1 -  $h2;
		}
		else { 	
			$m3 = ($m1 + (60-$m2)) - 1;
			$h3 = $h1 -  $h2 - 1;
		}
	}
	if(strlen($h3)==1)
		$h3 = "0".$h3;
	if(strlen($m3)==1)
		$m3 = "0".$m3;
	if(strlen($s3)==1)
		$s3 = "0".$s3;
	
	$hora3 = $h3.":".$m3.":".$s3;
	
	return $hora3;
}

/*
* @return int
* @desc da formato a las fechas para mostrar al usuario o para los procesos del sistema
*/
function inc_invertir_fecha($fecha,$caso)
{	
	if($caso==1)
	{   //tipo de 01-12-2005 a 2005-04-10
		$fecha_invertida = substr($fecha,6,4) ."-". substr($fecha,3,2) ."-".substr($fecha,0,2);
	}elseif($caso==2)
	{  //tipo de 2006-12-04 a 10-04--2005
		$fecha_invertida = substr($fecha,8,2) ."-". substr($fecha,5,2) ."-".substr($fecha,0,4);
	}
	
	if($fecha_invertida=="--"){ $fecha_invertida=""; }
	return $fecha_invertida;
	
}

/*
* @return int
* @desc resta o suma n dias de una fecha dada y da la fecha encontrada
*/
function inc_obtenerfecha_con_dias($p_dia, $date,$operador) {

if (!isset($date)) 
{ 
	$date = time(); 
	list($hora, $min, $seg, $dia, $mes, $anno) = explode( " ", date( "H i s d m Y"));
}else{
	list($hora, $min, $seg, $dia, $mes, $anno) = explode( " ", date( "H i s d m Y",strtotime($date)));
}

if($operador=="-"){
	$d = $dia - $p_dia;
}elseif($operador=="+"){
	$d = $dia + $p_dia;
}

$fecha = date("Y-m-d", mktime($hora, $min, $seg, $mes, $d, $anno));

return $fecha;

}

/*
* @return int
* @desc resta o suma n dias de una fecha dada y da la fecha encontrada
*/

function inc_formato_fecha($p_fecha,$formato)
{  
	$timestamp=strtotime($p_fecha);
	
	$dia_semana=inc_nombre_dia(date('w',$timestamp),$formato);
	$mes=inc_nombre_mes(date('n',$timestamp),$formato);
	
	$dia  =	date('d',$timestamp);
	$anio = date('Y',$timestamp);
	$ampm = date('a',$timestamp);
	$hora = date('h',$timestamp);
	$min  =	date('i',$timestamp);
	$seg  =	date('s',$timestamp);	
	
	
	$fecha = $dia_semana." ".$dia." de ".$mes." ".$anio;
	return $fecha;
 
}


/*
* @return int
* @desc funcion que compara dos fechas y retorna si la primera es mayor que la segunda
*/
function inc_compara_fechas($fecha1,$fecha2="")
{

if($fecha2=="")// en caso no se envia la segunda fecha, la obtenemos del sistema
{
	$dia2=date("d");
	$mes2=date("m");
	$ano2=date("Y");												
}else
{
	$dia2=substr($fecha2,6,2);
	$mes2=substr($fecha2,3,2);
	$ano2=substr($fecha2,0,4);
}

	$dia1=substr($fecha1,8,2);
	$mes1=substr($fecha1,5,2);
	$ano1=substr($fecha1,0,4);
	

	$dif = mktime(0,0,0,$mes1,$dia1,$ano1) - mktime(0,0,0, $mes2,$dia2,$ano2);

	if($dif>0)
	{	
	//	echo "<br>fecha1 es mayor que fecha2";	t
		return 1;
	}else
	{	
		if($dif==0){
	//		echo "<br>fecha2 es igual que fecha 1";	
			return 0; 		
		}else{
	//		echo "<br>fecha2 es mayor que fecha 1";
			return -1; 		
		}
	}
}


/**------------------------------------------------------------------- */
/**/
//Función que me devuelve un array con todas las fechas intermedias
function obtiene_fechas($date_desde, $date_hasta)
{
	$arr_fechas = array();
	
	$desde_ano = substr($date_desde, 0, 4);
	$desde_mes = substr($date_desde, 5, 2);
	$desde_dia = substr($date_desde, 8, 2);
	
	$hasta_ano = substr($date_hasta, 0, 4);
	$hasta_mes = substr($date_hasta, 5, 2);
	$hasta_dia = substr($date_hasta, 8, 2);	
	
	
	while ($date_desde != $date_hasta) 
	{
		if (checkdate($desde_mes, $desde_dia, $desde_ano))
		{
			$arr_fechas[] = $desde_ano . "-" . inc_pone_ceros($desde_mes, 2) . "-" . inc_pone_ceros($desde_dia, 2);
		}
		
		$desde_dia++;
		
		if (!checkdate($desde_mes, $desde_dia, $desde_ano))
		{
			$desde_dia = 1;
			$desde_mes++;
			
			if (!checkdate($desde_mes, $desde_dia, $desde_ano))
			{
				$desde_mes = 1;
				$desde_ano++;
			}
		}
		
		$date_desde = $desde_ano . "-" . inc_pone_ceros($desde_mes, 2) . "-" . inc_pone_ceros($desde_dia, 2);
		
	}
	
	$arr_fechas[] = $desde_ano . "-" . inc_pone_ceros($desde_mes, 2) . "-" . inc_pone_ceros($desde_dia, 2);
	return $arr_fechas;
}


function inc_fecha($fecha,$tipo)
{

	if($tipo==1)
	{
		if($fecha!="0000-00-00")
		{
			$fecha = date("d-m-Y H:i:s",strtotime($fecha));
		}else{
			$fecha ="";
		}
		
	}elseif($tipo==2){
		// Agosto 2007
		$timestamp=strtotime($fecha);
		
		$dia_semana=inc_nombre_dia(date('w',$timestamp),1);
		$mes=inc_nombre_mes(date('n',$timestamp),$_SESSION['session_idioma']);
		
		$dia  =	date('d',$timestamp);
		$anio = date('Y',$timestamp);
		$ampm = date('a',$timestamp);
		$hora = date('h',$timestamp);
		$min  =	date('i',$timestamp);
		$seg  =	date('s',$timestamp);	
		
		
		$fecha = $mes."  ".$anio;
	
	}
	
	return $fecha;

}

/**------------------------------------------------------------------- */
/**/
//Función que pone ceros a la izquierda.
function inc_pone_ceros($numero, $cantidad)
{
	if(strlen($numero) < $cantidad)
	{
		$tmp_diferencia = $cantidad - strlen($numero);
		
		$tmp_ceros = "";
		for($x=0; $x<$tmp_diferencia; $x++)
		{
			$tmp_ceros = $tmp_ceros . "0";
		}
		
		$numero = $tmp_ceros . $numero;
	}
	
	return $numero;
}
//*****************************************************************************************************
//*********************************************FUNCIONES DE MANEJO DE NAVEGADOR************************
//*****************************************************************************************************


/*
* @return int
* @desc Esta función se encarga de obtener la dirección IP de la máquina
*/
/*******************************************************************/

function obtenerIp()
{
	if ($_SERVER["HTTP_X_FORWARDED_FOR"]) 
		$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else
		$realip = $_SERVER["REMOTE_ADDR"];
	
	return $realip;
}





//*****************************************************************************************************
//*********************************************FUNCIONES MANEJOR DE CORREOS ***************************
//*****************************************************************************************************


/*
* @return int
* @desc funcion que envia correos electronicos en formato html
*/
/*******************************************************************/
function inc_envio_mail($mail_destino,$asunto,$mensaje,$datos_remitente)
{
	//para el envío en formato HTML 
	$headers = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$headers .= "From: $datos_remitente\n"; 
	//$headers .= "Reply-To: $responder_a\r\n"; 
	
	$resultado=mail($mail_destino,$asunto,$mensaje,$headers);
	return $resultado;
}



function mail_phpmailer_masivo($a, $email_a, $asunto, $mensaje, $de, $correo_de, $archivo, $archivo_name)
{
  $mail = new phpmailer();

  //Con PluginDir le indicamos a la clase phpmailer donde se 
  //encuentra la clase smtp que como he comentado al principio de 
  //este ejemplo va a estar en el subdirectorio includes
  
  //$mail->PluginDir = "";

  //Con la propiedad Mailer le indicamos que vamos a usar un 
  //servidor smtp
  $mail->Mailer = "smtp";
  $mail->CharSet = 'UTF-8';
  //Asignamos a Host el nombre de nuestro servidor smtp
  $mail->Host = "50.87.150.102";								 

  //Le indicamos que el servidor smtp requiere autenticación
  $mail->SMTPAuth = false;

	$mail->IsHTML(true);

  //Le decimos cual es nuestro nombre de usuario y password
  //$mail->Username = "noranterry@gmail.com"; 
  //$mail->Password = "calapublicidad";

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = $correo_de;
  $mail->FromName = $de;

  //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
  //una cuenta gratuita, por tanto lo pongo a 30  
  $mail->Timeout=10;

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = $asunto;
  $mail->Body = $mensaje;


//	$archivo ="ficha.txt"; 
	if($archivo!="")
	{
			if ($archivo !="none")
			{ 
				$mail->AddAttachment($archivo,$archivo_name); 
			} 
	}
  //Definimos AltBody por si el destinatario del correo no admite email con formato html 
//  $mail->AltBody = "Estamos enviando correo spam....";
			$exito=0;

			if($email_a!="")
			{		
				$mail->AddAddress($email_a,$a);
				$exito = $mail->Send();
				while ((!$exito) && ($intentos < 2)) 
					 {
							sleep(1);
							//echo $mail->ErrorInfo;
							$exito = $mail->Send();
							$intentos=$intentos+1;			
					 }	
			}
			 if(!$exito)
			 {
				$error=$error."<br>".$email_a." Error : ".$mail->ErrorInfo;	
			 }
			 else
			 {
				$error="ok";
			 } 
		return $error;
}


//*****************************************************************************************************
//*********************************************FUNCIONES PROPIAS DEL SISTEMA **************************
//*****************************************************************************************************

function inc_completar_espacios($texto,$cantidad)
{
	$longitud=strlen($texto);
	$tamanio=$cantidad-$longitud;
	if($tamanio>0)
	{
			for($i=0;$i<$tamanio;$i++)
			{
				$espacios="&nbsp;".$espacios;			
			}	
	}
	
	return $texto.$espacios;

}


function inc_color($sw){
	if($sw==1){
		return "#B3CDA6";
	}else{
		return "#7DA93C";
	}
}

function inc_estado($sw)
{
	if($sw==1){
		return "Yes";
	}else{
		return "No";
	}

}

function inc_tipo($sw)
{
	if($sw==1){
		return "Video";
	}elseif($sw==2){
		return "Contacto";
	}

}

function comillas_inteligentes($valor)
{
		conn_abre();

    // Retirar las barras si es necesario
    if (get_magic_quotes_gpc()) {
        $valor = stripslashes($valor);
    }

    // Colocar comillas si no es un entero
    if (!is_int($valor)) {
        $valor = "'" .mysql_real_escape_string($valor) . "'";
    }

		conn_cierra();

    return $valor;
}
/*
* @return nombre de la imagen
* @desc funcion que sube un jpg
* @autor noranterry@gmail.com
*/
/*******************************************************************/
function subir_jpg($file,$ruta)
{
if ((($_FILES[$file]["type"] == "image/jpeg") ||($_FILES[$file]["type"] == "image/pjpeg")) && ($_FILES[$file]["size"] < 50000))
  {
  if ($_FILES[$file]["error"] > 0)
    {
    echo "Codigo de Error: " . $_FILES[$file]["error"] . "<br />";
    }
  else
    {

    if (file_exists($ruta . $_FILES[$file]["name"]))
      {
      echo $_FILES[$file]["name"] . " existe. ";
      }
    else
      {
      move_uploaded_file($_FILES[$file]["tmp_name"],
      $ruta . $_FILES[$file]["name"]);
      }
    }
  }
else
  {
  echo "Archivo de imagen inválido";
  }
  return true;
	}

function subir_pdf($file,$ruta)
{
if (($_FILES[$file]["type"] == "application/pdf") || ($_FILES[$file]["type"] == "application/x-pdf") || ($_FILES[$file]["type"] == "application/acrobat") || ($_FILES[$file]["type"] == "applications/vnd.pdf") || ($_FILES[$file]["type"] == "text/pdf") || ($_FILES[$file]["type"] == "text/x-pdf"))
  {
  if ($_FILES[$file]["error"] > 0)
    {
    return "Codigo de Error: " . $_FILES[$file]["error"] . "<br />";
    }
  else
    {

    if (file_exists($ruta . $_FILES[$file]["name"]))
      {
      return "Este archivo ".$_FILES[$file]["name"] . " existe, cambie el nombre o suba otro pdf<br />";
      }
    else
      {
      move_uploaded_file($_FILES[$file]["tmp_name"],
      $ruta . $_FILES[$file]["name"]);
	  return true;
      }
    }
  }
else
  {
  return "Archivo pdf inválido <br />";
  }
  
	}
		
function getVariable($vparam, $vdefault) {
	$result = $vdefault;
	if (isset($vparam)) {
  		$result = (get_magic_quotes_gpc()) ? $vparam : addslashes($vparam);
	}
	return $result;
}
function cortarCadena($cadena, $cortador){
	$texto = explode($cortador,$cadena);
	return $texto[0];
	}
function generarTelParaMovil($cadena){
	if (((strpos($cadena,"(") !== false) && ((strpos($cadena,")")) !== false))) 
	{
	$cadena=str_replace("(","",$cadena); $cadena=str_replace(")","",$cadena);
	$tel = explode("/",$cadena);
	$tel = $tel[0];
	$tel = str_replace(" ","",$tel);
	} else {
	$tel = explode("/",$cadena);
	$tel = $tel[0];
	$tel = "01".$tel; 
	}	
	return $tel;
	}
/*
* @return nombre de la imagen
* @desc funcion que sube una imágen
* @autor noranterry@gmail.com
*/
/*******************************************************************/
function subir_imagen($file,$ruta)
{
if ((($_FILES[$file]["type"] == "image/jpeg") ||($_FILES[$file]["type"] == "image/pjpeg")||($_FILES[$file]["type"] == "image/jpg")||($_FILES[$file]["type"] == "image/gif")||($_FILES[$file]["type"] == "image/x-png")||($_FILES[$file]["type"] == "image/png")) && ($_FILES[$file]["size"] < 900000))
  {
  if ($_FILES[$file]["error"] > 0)
    {
    return "Codigo de Error: " . $_FILES[$file]["error"] . "<br />";	
    }
  else
    {
    if (file_exists($ruta . $_FILES[$file]["name"]))
      {
      return "La imágen <b>".$_FILES[$file]["name"] . "</b> existe en ".$ruta.", renombre la imágen o use otra.<br />";
      }
    else
      {
      move_uploaded_file($_FILES[$file]["tmp_name"],
      $ruta . $_FILES[$file]["name"]);
	   return true;
      }
    }
  }
else
  {
  return "la Imágen no es .jpg, .gif, .png o es muy pesada no debe exceder más de 878 KB.<br />";
  } 
}

/*
* @return nombre de la imagen
* @desc funcion que sube una imágen
* @autor noranterry@gmail.com
*/
/*******************************************************************/
function subir_imagen_aleatoria($file,$ruta)
{
if ((($_FILES[$file]["type"] == "image/jpeg") ||($_FILES[$file]["type"] == "image/pjpeg")||($_FILES[$file]["type"] == "image/jpg")||($_FILES[$file]["type"] == "image/gif")||($_FILES[$file]["type"] == "image/x-png")||($_FILES[$file]["type"] == "image/png")) && ($_FILES[$file]["size"] < 900000))
  {
  if ($_FILES[$file]["error"] > 0)
    {
    return "Codigo de Error: " . $_FILES[$file]["error"] . "<br />";	
    }
  else
    {
    if (file_exists($ruta . $_FILES[$file]["name"]))
      {
      return "La imágen <b>".$_FILES[$file]["name"] . "</b> existe en ".$ruta.", renombre la imágen o use otra.<br />";
      }
    else
      {
	  
      move_uploaded_file($_FILES[$file]["tmp_name"], $ruta . $_FILES[$file]["name"]);
	   return true;
      }
    }
  }
else
  {
  return "la Imágen no es .jpg, .gif, .png o es muy pesada no debe exceder más de 878 KB.<br />";
  } 
}


function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
/* example
  $bad_string = "Hi! <script src='http://www.evilsite.com/bad_script.js'></script> It's a good day!";
  $good_string = sanitize($bad_string);
  // $good_string returns "Hi! It\'s a good day!"

  // Also use for getting POST/GET variables
  $_POST = sanitize($_POST);
  $_GET  = sanitize($_GET);
*/
//CALCULA LA DISTANCIA ENTRE 2 PUNTOS
function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters'); 
}
/*
Example:

$point1 = array('lat' => 40.770623, 'long' => -73.964367);
$point2 = array('lat' => 40.758224, 'long' => -73.917404);
$distance = getDistanceBetweenPointsNew($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
foreach ($distance as $unit => $value) {
    echo $unit.': '.number_format($value,4).'<br />';
}
*/
//OBTENER LOS TWEETS DE UN HASHTAG
function getTweets($hash_tag) {

    $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
    echo "<p>Connecting to <strong>$url</strong> ...</p>";
    $ch = curl_init($url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $xml = curl_exec ($ch);
    curl_close ($ch);

    //If you want to see the response from Twitter, uncomment this next part out:
    //echo "<p>Response:</p>";
    //echo "<pre>".htmlspecialchars($xml)."</pre>";

    $affected = 0;
    $twelement = new SimpleXMLElement($xml);
    foreach ($twelement->entry as $entry) {
        $text = trim($entry->title);
        $author = trim($entry->author->name);
        $time = strtotime($entry->published);
        $id = $entry->id;
        echo "<p>Tweet from ".$author.": <strong>".$text."</strong>  <em>Posted ".date('n/j/y g:i a',$time)."</em></p>";
    }

    return true ;
}

function shorten_string($oldstring, $wordsreturned)
{
  $retval = $string;
  $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $oldstring);
  $string = str_replace("\n", " ", $string);
  $array = explode(" ", $string);
  if (count($array)<=$wordsreturned)
  {
    $retval = $string;
  }
  else
  {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array)." ...";
  }
  return $retval;
}

/*EXAMPLE */
//getTweets('#cats');

/*Shortening URLs in PHP with the bit.ly API

If you have a Twitter application, chances are that you'll need a URL shortening service to generate links for it. You can either recreate the wheel and do this on your own or, instead, plug into one of the many services that will do this for you for free. Bit.ly is one of those services and has a really simple to use API. I've made it even easier here by creating this PHP function that does all the work for you. Simply replace yourusername with your bit.ly username and yourapikey with your API key, which can be found at http://bit.ly/a/your_api_key.*/

function shorten_url($url) {
    if (!$url) { return false; }
    $bitly_username = 'yourusername';
    $bitly_api_key = 'yourapikey';
    $url = urlencode(trim($url));
    $api_address = 'http://api.bitly.com/v3/shorten?login='.$bitly_username.'&apiKey='.$bitly_api_key.'&longUrl='.$url.'&format=txt';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_address);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    if (!$response) { return false; }
    elseif (substr($response,0,7) != 'http://') { return false; }
    else { return trim(strip_tags($response)); }
}
//With the above function defined, it's super simple to get your shortened URL:

//echo shorten_url('http://www.inkplant.com/code/');
//returns http://bit.ly/fdk8GQ
//There are more advanced elements of the API available should you need them. For more information, see bit.ly's API Documentation. http://dev.bitly.com/

/**
 * Creates data URI string of an image file for CSS image embedding.
 * @param  [string] $file path to the file
 * @return [string]       data URI string
 */
function data_uri($file, $mime) {
  $contents=file_get_contents($file);
  $base64=base64_encode($contents);
  echo "data:$mime;base64,$base64";
}

function format_hms($seconds,$precision=0) {

	//clean up the input
	$seconds = preg_replace('/[^0-9.-]/','',$seconds);
	$precision = intval($precision);
	$seconds = round($seconds,$precision);

	$hms = ''; //this is where we'll store the output
	
	//hours
	$h = floor($seconds / 3600);
	$seconds = $seconds - ($h * 3600);
	if ($h > 0) { $hms .= $h.':'; }

	//minutes
	$m = floor($seconds / 60);
	$seconds = $seconds - ($m * 60);
	if ($m > 0) {
		if (($h > 0) && ($m < 10)) { $m = '0'.$m; } //add a preceding 0 if necessary
		$hms .= $m.':';
	} elseif ($h > 0) { $hms .= '00:'; }
	
	//seconds
	$s = round($seconds,$precision);
	$s = number_format($s,$precision,'.','');
	if ((($h > 0) || ($m > 0)) && ($s < 10)) { $s = '0'.$s; }  //add a preceding 0 if necessary
	$hms .= $s;	

	return $hms;
}
/* So you can see how it works, I've included a few examples below:

//format_hms('11923',0)
3:18:43

//format_hms('2362.4',2)
39:22.40

//format_hms('3604.19',1)
1:00:04.2

//format_hms('4.2',2)
4.20

//format_hms('456',1)
7:36.0
You can try it yourself here. Simply enter the amount of seconds you'd like to format, and the precision you'd like to use.
*/
/*
PHP Script to Get Array of FTP Directories and Subdirectories

I was looking through my web host's documentation the other day trying to figure out if there was a way to modify my php.ini file even though I'm on a shared hosting package. I was guessing not, but thought it would be worth looking into. I found good news and bad news – I couldn't actually update the php.ini file, but I could place partial php.ini script in each directory and it would apply the specified changes. I'm trying to disable the on screen error reporting for security reasons. So, yes, it is possible (good news) but I'd have to upload a mini php.ini file into every single directory on my sites (bad news – I have hundreds of folders so that would involve a lot more busy work than I'm interested in.) So, I decided to outsmart the problem...

I created a script using PHP's FTP functions that goes through and uploads the necessary file into each directory. I set up a cronjob that runs this script every week (in case I forget the file when adding new directories, accidentally delete one, etc.) The code that I'm including here is the first part of this file. This code grabs a list of all directories and subdirectories underneath the root FTP directory and stores them in an array ($dir). The $depth variable controls how many levels deep the loop will go through looking for further directories. However, it will stop if it finds that no new directories have been added on any given loop so you can set the depth to an outlandishly high amount if you'd like.
$ftp_user_name = "username" ;
$ftp_user_pass = "password" ;
$ftp_server = "ftp.example.com" ;
$depth = 10;

$conn_id = ftp_connect($ftp_server) or (die("Couldn't connect to $ftp_server"));
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
if (!$login_result) { die("Couldn't log in to FTP account."); }

$dir = array(".");
$a = count($dir);
$i = 0;
while (($a != $b) && ($i < $depth)) {
  $i++;
  $a = count($dir) ;
  foreach ($dir as $d) {
    $ftp_dir = $d."/" ;
    $newdir = ftp_nlist($conn_id, $ftp_dir);
    foreach ($newdir as $key => $x) {
      if ((strpos($x,".")) || (strpos($x,".") === 0)) { unset($newdir[$key]); }
      elseif (!in_array($x,$dir)) { $dir[] = $x ; }
    }
  }
  $b = count($dir) ;
}

print_r($dir) ;

ftp_close($conn_id);
*/	
//DETECT BROWSER LANGUAGE
function get_client_language($availableLanguages, $default='en'){
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		$langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

		foreach ($langs as $value){
			$choice=substr($value,0,2);
			if(in_array($choice, $availableLanguages)){
				return $choice;
			}
		}
	} 
	return $default;
}
//METODOS SEO	
function obtenerMetaTitle($controller = "", $subaction = "")
{
$controlador = $_GET['controller'];
if (isset($controlador) && ($controlador != "")){
$tituloa = ucfirst($controlador);
$tituloa = ($tituloa . " | ");
$tituloa = str_replace('_',' ',$tituloa);
}
if (isset($subaction) && ($subaction != "")){
$titulob = ucfirst($subaction);
$titulob = (" | ".$titulob . " | ");
$titulob = str_replace('-',' ',$titulob);
}
$meta_title = $tituloa.$titulob."Anypsa";
return $meta_title;	
}

function obtenerMetaDescription($description = "")
{	
	if ($description == ""){
	$meta_description = "Anypsa";
	} else  {$meta_description = $description;	}
	return $meta_description;			
}	
//@ obtiene la url actual
function getUrlActual()
{
	$http_url = parse_url("http://".$_SERVER['HTTP_HOST'].":".$_SERVER['REQUEST_URI']);
	$http_server = $http_url['scheme'] . '://' . $http_url['host'].$_SERVER['REQUEST_URI'];
	return $http_server;
	}
function current_page_url(){
    $page_url   = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $page_url .= 's';
    }
    return $page_url.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
	
	
///////////////////////////////////////////////////////////////////////////
/******************hacer thumbnail de imagen***************/

function createThumbnail($pathToImage, $thumbWidth = 180) {
    $result = 'Failed';
    if (is_file($pathToImage)) {
        $info = pathinfo($pathToImage);

        $extension = strtolower($info['extension']);
        if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

            switch ($extension) {
                case 'jpg':
                    $img = imagecreatefromjpeg("{$pathToImage}");
                    break;
                case 'jpeg':
                    $img = imagecreatefromjpeg("{$pathToImage}");
                    break;
                case 'png':
                    $img = imagecreatefrompng("{$pathToImage}");
                    break;
                case 'gif':
                    $img = imagecreatefromgif("{$pathToImage}");
                    break;
                default:
                    $img = imagecreatefromjpeg("{$pathToImage}");
            }
            // load image and get image size

            $width = imagesx($img);
            $height = imagesy($img);

            // calculate thumbnail size
            $new_width = $thumbWidth;
            $new_height = floor($height * ( $thumbWidth / $width ));

            // create a new temporary image
            $tmp_img = imagecreatetruecolor($new_width, $new_height);
			if ($extension == "png" || $extension == "gif" ){
				imagealphablending($tmp_img, false);
				imagesavealpha($tmp_img, true);
				imagealphablending($img, true);
				}

            // copy and resize old image into new image
            imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$fichero_t = explode($info['basename'], $pathToImage);
				$directory = $fichero_t[0];
                $pathToImage = $directory . 'thumb.' .$info['basename'];
            // save thumbnail into a file
			if ($extension == "png"){
				imagepng($tmp_img, "{$pathToImage}");
			}else if ($extension == "gif")
			{
            imagegif($tmp_img, "{$pathToImage}");
			} else{
			imagejpeg($tmp_img, "{$pathToImage}");
				}
            $result = $pathToImage;
        } else {
            $result = 'Failed|Not an accepted image type (JPG, PNG, GIF).';
        }
    } else {
        $result = 'Failed|Image file does not exist.';
    }
    return $result;
}

function generate_token(){
	$token = sha1(uniqid(mt_rand(), true));
	return $token;
	}

function generateActionToken($action) {
 
   // generar token de forma aleatoria
   $token = md5(uniqid(microtime(), true));
 
   // escribir la información del token en sesión para poder
   // comprobar su validez cuando se reciba un token desde un formulario
   $_SESSION['csrf'][$action.'_token'] = array('token'=>$token);
 
   return $token;
}

function verifyActionToken($action, $token) {
 
   // comprueba si hay un token registrado en sesión para el formulario
   if(!isset($_SESSION['csrf'][$action.'_token'])) {
       return false;
   }
 
   // compara el token recibido con el registrado en sesión
   if ($_SESSION['csrf'][$action.'_token']['token'] !== $token) {
       return false;
   }
   
   return true;
}


function generateAccessToken($form){
   $secret = APP_KEY_SECRET;
   // generar fecha de generación del token
   $token_time = time();
   $token_key = sha1($secret.$form);
   $token = array();
   $token = array('alfa'=>$token_key, 'beta'=>$token_time);
   $token = htmlspecialchars(serialize($token));
   return $token;
}	

function verifyFormToken($form, $token, $delta_time=0) {
   $secret = APP_KEY_SECRET;
   $correct = sha1($secret.$form);
   if (!isset($token)){ return false;}
	$tk = isset($token) ? $token : "";
   $token_key = (isset($tk['alfa'])) ? $tk['alfa'] : "";
   // validamos la llave de acceso
   if ($token['alfa'] != $correct){ return false;}
   // validamos el tiempo de acceso no mayor a $delta_time
   if($delta_time > 0){
       $token_age = time() - $token['beta'];
      if($token_age >= $delta_time){
      return false;
      }
   } else { return false;}
   return true;
}
	
 function checkFileInRemoteServer($urlfile)
 {
	 if (filter_var($urlfile, FILTER_VALIDATE_URL)) {
	 $ch = curl_init($urlfile);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_exec($ch);
	$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// $retcode >= 400 -> not found, $retcode = 200, found.
	if ($retcode == 200){return true;} else { return false;}
		curl_close($ch);
	}
		else {
	  	return false;
			}
	
	 }
	 
function urlExists($url) {
  $handle = curl_init($url);
  curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($handle);

  $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  if($httpCode == 200) {
    curl_close($handle);
    return true;
  }
  curl_close($handle);
  return false;
}
function random_numbers($digits) {
    $min = pow(10, $digits - 1);
    $max = pow(10, $digits) - 1;
    return mt_rand($min, $max);
}
//calling the function
/*$result = explode('|',createThumbnail($sourceImagePath, 180));
            if ($result[0] != 'Failed'){
                header('Location: /thumbnails/' . basename($result[0]));
            } else {
                header('Location: error.gif');
            }*/