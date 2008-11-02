<?php

	class MySQLEngine extends Engine
	{
		protected $mysqli;
		
		public function connect()
		{
			try {
				$this->mysqli = new mysqli($this->database->getHost(), $this->database->getUser(), $this->database->getPass(), $this->database->getName());
				$this->query("SET NAMES UTF-8");
				$this->query("SET CHARACTER SET UTF-8");
			}
			catch (Exception $e) {
				//AQUÍ IRÍAN NUESTROS LANZAMIENTOS DE EXCEPCIONES SEGÚN ERROR.
				$this->connection_error = mysqli_connect_errno();
			}
			return !(bool)$this->connection_error;
		}
		
		public function close()
		{
			if($this->mysqli instanceof mysqli)
			{
				$this->mysqli->close();
				$this->mysqli = null;
				return true;
			}
			return false;
		}
		
		public function query($query)
		{
			$time = microtime(true);
			$result = $this->mysqli->query($query);
			if($result instanceof mysqli_result)
			{
				$result->total_rows = array_pop($this->mysqli->query('SELECT FOUND_ROWS()')->fetch_row());
				$result->request_time = microtime(true) - $time;
			}
			
			if(count($this->decorators["query"])) foreach($this->decorators["query"] as $decorator)
				$decorator->run($result);
			
			$id = mysqli_insert_id($this->mysqli);
			
			if($result && $id)
				return $id;
				
			return $result; 
		}
		
		public function multi_query($query)
		{
			return $this->mysqli->multi_query($query);
		}
		
	}

?>