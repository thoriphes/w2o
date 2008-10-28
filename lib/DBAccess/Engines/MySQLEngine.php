<?php

	class MySQLEngine extends Engine
	{
		protected $mysqli;
		
		public function connect()
		{
			try {
				$this->mysqli = new mysqli($this->database->getHost(), $this->database->getUser(), $this->database->getPass(), $this->database->getName());
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
			$result = $this->mysqli->query($query);
			if(count($this->decorators["query"])) foreach($this->decorators["query"] as $decorator)
				$result = $decorator->run(&$result);
			return $result; 
		}
		
		public function multi_query($query)
		{
			return $this->mysqli->multi_query($query);
		}
		
	}

?>