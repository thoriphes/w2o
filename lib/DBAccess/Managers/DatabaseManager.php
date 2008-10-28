<?php

	abstract class DatabaseManager implements DBManager 
	{
		protected 
			$engine;
			
		public function __construct(Engine $engine)
		{
			$this->setEngine($engine);
			$this->engine->connect();
		}
		
		public function setEngine(Engine $engine)
		{
			$this->engine = $engine;
		}
		
		public function getEngine()
		{
			return $this->engine;
		}
		
		public function close()
		{
			$this->engine->close();
		}
		
		public function query($query)
		{
			return $this->engine->query($query);
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->engine->addDecorator($event, $decorator);
		}
		
		public function removeDecorator($event, Decorator $decorator)
		{
			$this->engine->remove($event, $decorator);
		}
	}

?>