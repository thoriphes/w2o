<?php

	class Imploder extends Decorator
	{
		const DEFAULT_GLUE = " ";
		
		protected $glue;
		
		public function __construct($glue = self::DEFAULT_GLUE)
		{
			$this->glue = $glue;
		}
		
		public function run(&$data = null)
		{
			$data = implode($this->glue, $data);
		}
	}

?>