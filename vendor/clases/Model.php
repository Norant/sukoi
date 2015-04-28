<?php
require_once(APP_ROOT_CLASES."Database.php");
class Model{ 
	function executeQuery($query='')
		{
		$dbh = Database::getInstance();
			try { 
			$result = $dbh->query($query);	      
			   } 
			catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error.<br />";
			echo $e->getMessage();
			//header("Location:".DIRECTORIO);
			}
		return $result;
		}
	function queryprepare($query=""){
		$dbh = Database::getInstance();
		if ($query =! ""){	
		try { 
		$sth = $dbh->prepare($query);
		$result = $sth->execute(array($valor));
		}
		catch (PDOException $e) {  
			echo "<br />Ha ocurrido un error en queryprepare.<br />";
			echo $e->getMessage();
			//header("Location:".DIRECTORIO);
			}
		}
		return $result;
		}
	
	}




