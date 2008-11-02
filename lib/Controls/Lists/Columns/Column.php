<?php

	class Column extends Decorator 
	{
		public function __construct($columnName)
		{
			$this->id = $columnName;
		}
		
		public function format(&$data)
		{
			$this->run($data);
		}
		
		public function run(&$data = null)
		{
			
		}
	}

?>