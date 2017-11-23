<?php

	/*
		slimPDO v1.0 
		(c) 2017 by Thielicious
		
		Just a small tweaked PDO extension for my own personal use.
	*/
	
	
	namespace Thielicious\utils\slimPDO;
	
	use PDO;

	
	interface slimStruct {

		public function prep(string $sql, array $bind = null);
		public function qry(string $sql);

	}


	if (!is_subclass_of("slimPDO","PDO")) {

		abstract class slimPDOInit extends PDO {

			public function prep(string $sql, array $bind = null) {
				$stmt = $this->prepare($sql);
				$stmt->execute($bind);
				return $stmt;
			}
			
			abstract public function qry(string $sql);

		}
		
		final class slimPDO extends slimPDOInit implements slimStruct {

			public function qry(string $sql) {
				return parent::prep($sql);
			}

		}
		
	}
	
	
	trait DB {
		
		protected
			$pdo;		

		protected function connect($host, $db, $user, $pass) {
			try {
				$this->pdo = new slimPDO(
					"mysql:host=".$host.";dbname=".$db, $user, $pass,
					[
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
					]
				);
			} catch (PDOException $e) {
				exit($e->getMessage());
			}
		}
		
	}
	
?>