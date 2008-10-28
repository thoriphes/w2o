<?php

	class Model
	{
		protected $name;
		
		public function __construct($name = null)
		{
			$this->setName($name);
			Application::$dataManager->useManager($this->getName());
		}
		
		protected function setName($name)
		{
			$this->name = $name;
		}
		
		protected function getName()
		{
			return $this->name;
		}
		
		public function findAll()
		{
			return Application::$dataManager->query("SELECT * FROM $this->name");
		}
	}

?>