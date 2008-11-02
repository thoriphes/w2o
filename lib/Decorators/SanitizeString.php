<?php

	class SanitizeString extends Decorator 
	{
		public function run(&$data = null)
		{
			StripTags::run($data);
			RemoveBreaks::run($data);
		}
	}

?>