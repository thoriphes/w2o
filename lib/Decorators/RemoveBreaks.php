<?php

	class RemoveBreaks extends Decorator 
	{
		public function run($data = null)
		{
			return str_replace("\n", "", $data);
		}
	}

?>