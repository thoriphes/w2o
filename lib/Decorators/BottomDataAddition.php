<?php

	abstract class BottomDataAddition extends Decorator
	{
		public function run(&$data = null) 
		{
			$data .= $this->generateData();
		}
		
		protected abstract function generateData($data = null);
	}

?>