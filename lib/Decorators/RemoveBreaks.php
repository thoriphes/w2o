<?php

	class RemoveBreaks extends Decorator 
	{
		public function run(&$data = null)
		{
			str_replace("\n", "", $data);
		}
	}

?>