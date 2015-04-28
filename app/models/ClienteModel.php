<?php
require_once(APP_ROOT_CLASES."Database.php");
class ClienteModel
{
	public function validarCliente($cliente,$pass)
	{
	try {
		 $dbh = Database::getInstance();
		 $sql = "SELECT id_cliente, nombre_cliente, razonsocial_cliente, correo_cliente, clave_cliente FROM cliente WHERE correo_cliente = ? AND activate_cliente = '1'";
		 $sth = $dbh->prepare($sql);
		 $sth->bindParam(1, trim($cliente));
		 $sth->execute();
		 $cliente = $sth->fetchObject();
		 if (count($cliente) == 1)
		 	{
		 if (sha1($cliente->clave_cliente.$_SESSION['access_token']) === (trim($pass)))
				{
					return $cliente;
				} 
			else 
				{	
					return false; 
				}
			}					
		 }catch (PDOException $e) {
		  die( 'Fallo en query: ' . $e->getMessage() );}
	}
	
	public function getClientForEmail($email)
	{
		 $dbh = Database::getInstance();
		 $sql = "SELECT * FROM cliente WHERE correo_cliente = ?";
		 $sth = $dbh->prepare($sql);
		 $sth->bindParam(1, trim($email));
		 $sth->execute();
		 $cliente = $sth->fetchObject();
		 if (count($cliente) == 1)
		 	{
				if ($_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'])//prevent Session Hijacking
				{
					return $cliente;
					} else {return false;}
			}
		else 
			{	
			return false; 
			}	
		}
		
	public function searchMailAddressClient($correo_cliente)
	{
		try{
			$dbh = Database::getInstance();
			$sql = "SELECT correo_cliente FROM cliente WHERE correo_cliente = :correo_cliente";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':correo_cliente', trim($correo_cliente), PDO::PARAM_STR);
			$sth->execute();
			$array = $sth->fetchObject();
			if ($array){ return true;} else { return false;}		
		}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }		
		}
		
	//@ buscamos que no exista en la bd alguien con el tipo de documento y el número, esto es para personas naturales.	
	public function searchTypeAndNumberDocClient($numerodoc_cliente, $tipodoc_cliente)
		{
		try{
			$dbh = Database::getInstance();
			$sql = "SELECT numerodoc_cliente FROM cliente WHERE numerodoc_cliente = :numerodoc_cliente AND tipodoc_cliente = :tipodoc_cliente";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':numerodoc_cliente', trim($numerodoc_cliente), PDO::PARAM_STR);
			$sth->bindParam(':tipodoc_cliente', trim($tipodoc_cliente), PDO::PARAM_STR);
			$sth->execute();
			$array = $sth->fetchObject();
			if ($array){ return true;} else { return false;}
		}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }	
		}
		
		public function searchRucClient($ruc_cliente)
		{
		try{
			$dbh = Database::getInstance();
			$sql = "SELECT ruc_cliente FROM cliente WHERE ruc_cliente = :ruc_cliente";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':ruc_cliente', trim($ruc_cliente), PDO::PARAM_STR);
			$sth->execute();
			$array = $sth->fetchObject();
			if ($array){ return true;} else { return false;}
		}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }	
		}
		
	//@registro de persona natural		
	public function registerNaturalClient($nombre_cliente, $tipodoc_cliente, $numerodoc_cliente, $correo_cliente, $clave_cliente, $telefono_cliente, $direccion_cliente, $distrito_cliente, $provincia_cliente, $departamento_cliente, $boletin_cliente, $confirmcode_cliente)
	{
		try{
			$dbh = Database::getInstance();
			$ip_cliente = $_SERVER['REMOTE_ADDR'];
			$activate_cliente = "0"; //listo para que active su cuenta con su correo
			$tipo_cliente = "natural";
			$sql = "INSERT INTO cliente (nombre_cliente, tipodoc_cliente, numerodoc_cliente, correo_cliente, clave_cliente, telefono_cliente, direccion_cliente, distrito_cliente, provincia_cliente, departamento_cliente, boletin_cliente, fechaingreso_cliente, ip_cliente, activate_cliente, confirmcode_cliente, tipo_cliente) VALUES (:nombre_cliente, :tipodoc_cliente, :numerodoc_cliente, :correo_cliente, :clave_cliente, :telefono_cliente, :direccion_cliente, :distrito_cliente, :provincia_cliente, :departamento_cliente, :boletin_cliente, now(), :ip_cliente, :activate_cliente, :confirmcode_cliente, :tipo_cliente)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
			$sth->bindParam(':tipodoc_cliente', $tipodoc_cliente, PDO::PARAM_STR);
			$sth->bindParam(':numerodoc_cliente', $numerodoc_cliente, PDO::PARAM_STR);
			$sth->bindParam(':correo_cliente', $correo_cliente, PDO::PARAM_STR);
			$sth->bindParam(':clave_cliente', sha1($clave_cliente), PDO::PARAM_STR);
			$sth->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
			$sth->bindParam(':direccion_cliente', $direccion_cliente, PDO::PARAM_STR);
			$sth->bindParam(':distrito_cliente', $distrito_cliente, PDO::PARAM_STR);
			$sth->bindParam(':provincia_cliente', $provincia_cliente, PDO::PARAM_STR);
			$sth->bindParam(':departamento_cliente', $departamento_cliente, PDO::PARAM_STR);
			$sth->bindParam(':boletin_cliente', $boletin_cliente, PDO::PARAM_STR);
			$sth->bindParam(':ip_cliente', $ip_cliente, PDO::PARAM_STR);
			$sth->bindParam(':activate_cliente', $activate_cliente, PDO::PARAM_STR);
			$sth->bindParam(':confirmcode_cliente', $confirmcode_cliente, PDO::PARAM_STR);
			$sth->bindParam(':tipo_cliente', $tipo_cliente, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
		}
		
		//@registro de persona jurídica
		public function registerJuridicClient($razonsocial_cliente, $ruc_cliente, $correo_cliente, $clave_cliente, $telefono_cliente, $direccion_cliente, $distrito_cliente, $provincia_cliente, $departamento_cliente, $boletin_cliente, $representantelegal_cliente, $tipodocrepresentantelegal_cliente, $numerodocrepresentantelegal_cliente, $confirmcode_cliente)
		{
			try{
				$dbh = Database::getInstance();
				$ip_cliente = $_SERVER['REMOTE_ADDR'];
				$activate_cliente = "0"; //listo para que active su cuenta con su correo
				$tipo_cliente = "juridica";
				$sql = "INSERT INTO cliente (razonsocial_cliente, ruc_cliente, correo_cliente, clave_cliente, telefono_cliente, direccion_cliente, distrito_cliente, provincia_cliente, departamento_cliente, boletin_cliente, representantelegal_cliente, tipodocrepresentantelegal_cliente, numerodocrepresentantelegal_cliente, fechaingreso_cliente, ip_cliente, activate_cliente, confirmcode_cliente, tipo_cliente) VALUES (:razonsocial_cliente, :ruc_cliente, :correo_cliente, :clave_cliente, :telefono_cliente, :direccion_cliente, :distrito_cliente, :provincia_cliente, :departamento_cliente, :boletin_cliente, :representantelegal_cliente, :tipodocrepresentantelegal_cliente, :numerodocrepresentantelegal_cliente,  now(), :ip_cliente, :activate_cliente, :confirmcode_cliente, :tipo_cliente )";
				$sth = $dbh->prepare($sql);
				$sth->bindParam(':razonsocial_cliente', $razonsocial_cliente, PDO::PARAM_STR);
				$sth->bindParam(':ruc_cliente', $ruc_cliente, PDO::PARAM_STR);
				$sth->bindParam(':correo_cliente', $correo_cliente, PDO::PARAM_STR);
				$sth->bindParam(':clave_cliente', sha1($clave_cliente), PDO::PARAM_STR);
				$sth->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
				$sth->bindParam(':direccion_cliente', $direccion_cliente, PDO::PARAM_STR);
				$sth->bindParam(':distrito_cliente', $distrito_cliente, PDO::PARAM_STR);
				$sth->bindParam(':provincia_cliente', $provincia_cliente, PDO::PARAM_STR);
				$sth->bindParam(':departamento_cliente', $departamento_cliente, PDO::PARAM_STR);
				$sth->bindParam(':boletin_cliente', $boletin_cliente, PDO::PARAM_STR);
				$sth->bindParam(':representantelegal_cliente', $representantelegal_cliente, PDO::PARAM_STR);
				$sth->bindParam(':tipodocrepresentantelegal_cliente', $tipodocrepresentantelegal_cliente, PDO::PARAM_STR);
				$sth->bindParam(':numerodocrepresentantelegal_cliente', $numerodocrepresentantelegal_cliente, PDO::PARAM_STR);
				$sth->bindParam(':ip_cliente', $ip_cliente, PDO::PARAM_STR);
				$sth->bindParam(':activate_cliente', $activate_cliente, PDO::PARAM_STR);
				$sth->bindParam(':confirmcode_cliente', $confirmcode_cliente, PDO::PARAM_STR);
				$sth->bindParam(':tipo_cliente', $tipo_cliente, PDO::PARAM_STR);
				$sth->execute();
				$count = $sth->rowCount();
				return $count;						
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }
			}
		
		public function validateConfirmCodeClient($confirmcode_cliente)
			{
				try{
					$dbh = Database::getInstance();
					 $sql = "SELECT confirmcode_cliente FROM cliente WHERE confirmcode_cliente = ?";
						 $sth = $dbh->prepare($sql);
						 $sth->bindParam(1, $confirmcode_cliente);
						 $sth->execute();
						 $code = $sth->fetchObject();
						 if ($code){ return true; }else{ return false; }	
					
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }	
			}	
			
			public function getClientForConfirmCode($confirmcode_cliente)
			{
				try{
					$dbh = Database::getInstance();
					 $sql = "SELECT * FROM cliente WHERE confirmcode_cliente = ?";
						 $sth = $dbh->prepare($sql);
						 $sth->bindParam(1, $confirmcode_cliente);
						 $sth->execute();
						 $code = $sth->fetchObject();
						return $code;					
				}catch (PDOException $e){ die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); }	
			}
			
		//DAMOS DE ALTA A UN CLIENTE
		public function activateAccountClient($confirmcode_cliente)
			{
			try {
			$dbh = Database::getInstance();
			$activate_cliente = "1";
			$sql = "UPDATE cliente SET activate_cliente = :activate_cliente WHERE confirmcode_cliente = :confirmcode_cliente";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':activate_cliente', $activate_cliente, PDO::PARAM_STR);
			 $sth->bindParam(':confirmcode_cliente', $confirmcode_cliente, PDO::PARAM_STR);
			 $cliente = $sth->execute();
			 if (!$cliente){ return false;} else { return true;}
			 }catch (PDOException $e) {
			  die( 'Fallo en query ' .__METHOD__.': '. $e->getMessage() );}
			 }	
			 			
						
} 