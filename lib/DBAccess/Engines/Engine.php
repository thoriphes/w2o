<?php

	abstract class Engine implements DBEngine
	{
		protected 
			$database,
			$connection_error = 0,
			$decorators = array();
		
		public function __construct(Database $database)
		{
			$this->setDatabase($database);
		}
		
		public function setDatabase(Database $database)
		{
			$this->close();
			$this->database = $database;
		}
		
		public function getDatabase()
		{
			return $this->database;
		}
		
		public function getConnectionError()
		{
			return $this->connection_error;
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->decorators[$event][$decorator->getId()] = $decorator;
		}
		
		public function removeDecorator($event, Decorator $decorator)
		{
			if(isset($this->decorators[$event][$decorator->getId()]))
				unset($this->decorators[$event][$decorator->getId()]);
		}
		
	}

?>