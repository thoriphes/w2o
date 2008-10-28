<?php

	abstract class TopDataAddition extends Decorator
	{
		public function run($data = null) 
		{
			return $this->generateData() . $data;
		}
		
		protected abstract function generateData();
	}

?>