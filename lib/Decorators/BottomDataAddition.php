<?php

	abstract class BottomDataAddition extends Decorator
	{
		public function run($data = null) 
		{
			return $data . $this->generateData();
		}
		
		protected abstract function generateData();
	}

?>