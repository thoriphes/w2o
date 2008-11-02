<?php

	abstract class Decorator {
		
		const DATA_MARKER = "{{DATA}}";
		
		protected $id;
		protected $params = array();
		
		public function getId()
		{
			return $this->id; 
		}
		
		public function setParams(array $params)
		{
			$this->params = $params;
		}
		
		public abstract function run(&$data = null);
		
	}

?>