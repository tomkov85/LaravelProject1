<?php
class Connect {
		private $connection;
		
		public function __construct() {
			try{
				$this->connection = new PDO('mysql:host=127.0.0.1;dbname=portfoliomanager', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die($e->getMessage());			
			}
		}
		
		public function getConnection() {
			return $this->connection;
		}
	}

	$connectionObj = new Connect();

?>