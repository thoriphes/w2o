<?php

	abstract class TopDataAddition extends Decorator
	{
		public function run(&$data = null) 
		{
			$data = $this->generateData($data) . $data;
		}
		
		protected abstract function generateData($data = null);
	}

?>